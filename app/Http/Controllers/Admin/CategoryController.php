<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    const RULES = [
            'name' => ['required', 'string', 'max:191'],
            'note' => ['nullable', 'string'],
        ];

    public function __construct()
    {
        $this->middleware('auth');
        // $this->middleware(['verified','auth']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if (isset($request->key)) {
            switch ($request->key) {
                case 'list':
                    $ids = json_decode($request->ids);
                    $obj = Category::whereNull('revision')->orderBy('sort', 'ASC')->when(count($ids), function ($query) use ($ids) {
                        $query->whereIn('id', $ids);
                    })->get();
                    return response()->json($obj, 200);
                    break;

                default:
                    $category = Category::find($request->key);
                    if ($category) {
                        return response()->json($category, 200);
                    } else {
                        abort(404);
                    }
                    break;
            }
        } else {
            if ($request->ajax()) {
                $categories = Category::whereNull('revision');
                return DataTables::of($categories)
                    ->addColumn('checkboxes', function ($obj) {
                        if (!empty(Auth::user()->can(User::DELETE_CATEGORIES))) {
                            return '<input class="form-check-input choice" type="checkbox" name="choices[]" value="' . $obj->id . '">';
                        }
                    })
                    ->editColumn('name', function ($obj) {
                        if (!empty(Auth::user()->can(User::UPDATE_CATEGORY))) {
                            return '<a class="btn btn-link text-decoration-none text-start btn-update-category" data-id="' . $obj->id . '">' . $obj->name . '</a>';
                        } else {
                            return $obj->name;
                        }
                    })
                    ->editColumn('status', function ($obj) {
                        return '<span class="badge bg-' . ($obj->status ? 'success' : 'danger') . '">' . $obj->statusStr . '</span>';
                    })
                    ->addColumn('action', function ($obj) {
                        if (!empty(Auth::user()->can(User::DELETE_CATEGORY))) {
                            return '
                            <form action="' . route('admin.category.remove') . '" method="post" class="save-form">
                                <input type="hidden" name="_token" value="' . csrf_token() . '"/>
                                <input type="hidden" name="choices[]" value="' . $obj->id . '" data-id="' . $obj->id . '"/>
                                <button type="submit" class="btn btn-link text-decoration-none btn-remove">
                                    <i class="bi bi-trash3"></i>
                                </button>
                            </form>';
                        }
                    })
                    ->rawColumns(['checkboxes', 'name', 'status', 'action'])
                    ->make(true);
            } else {
                $pageName = __('Categories');
                return view('admin.categories', compact('pageName'));
            }
        }
    }

    public function sort(Request $request)
    {
        $sort = $request->input('sort');
        foreach ($sort as $index => $id) {
            Category::where('id', $id)->update(['sort' => $index + 1]);
        }
        return response()->json(['msg' => __('The order has been updated successfully')]);
    }

    public function create(Request $request)
    {
        $request->validate(self::RULES);
        if (!empty(Auth::user()->can(User::CREATE_CATEGORY))) {
            $category = $this->sync([
                'name' => $request->name,
                'code' => Str::slug($request->name),
                'note' => $request->note,
                'status' => $request->has('status'),
            ]);
            $response = array(
                'status' => 'success',
                'msg' => __('Successfully created :name :title', ['name' => $category->name, 'title' => __('category')])
            );
        } else {
            $response = array(
                'status' => 'danger',
                'msg' => __('The operation is not authorized')
            );
        }
        return response()->json($response, 200);
    }

    public function update(Request $request)
    {
        $request->validate(self::RULES);
        if (!empty(Auth::user()->can(User::UPDATE_CATEGORY))) {
            if ($request->has('id')) {
                $category = $this->sync([
                    'name' => $request->name,
                    'code' => Str::slug($request->name),
                    'note' => $request->note,
                    'status' => $request->has('status'),
                ], $request->id);

                $response = array(
                    'status' => 'success',
                    'msg' => __('Successfully updated :name :title', ['name' => $category->name, 'title' => __('category')])
                );
            } else {
                $response = array(
                    'status' => 'danger',
                    'msg' => __('An error has occurred') . '. ' . __('Please try again later') .'!'
                );
            }
        } else {
            $response = array(
                'status' => 'danger',
                'msg' => __('The operation is not authorized')
            );
        }
        return response()->json($response, 200);
    }

    public function remove(Request $request)
    {
        $success = [];
        $fail = [];
        $msg = '';
        
        if (Auth::user()->can(User::DELETE_CATEGORY)) {
            foreach ($request->choices as $key => $id) {
                $obj = Category::find($id);
                if ($obj->canRemove()) {
                    $obj->revision();
                    $obj->delete();
                    LogController::create("xóa", 'category', $obj->id);
                    array_push($success, $obj->name);
                } else {
                    array_push($fail, $obj->name);
                }
            }
            if (count($success)) {
                $status = 'success';
                $msg = __('Successfully removed :name :title.', ['name' => implode(', ', $success), 'title' => __('category')]);
            }
            if (count($fail)) {
                $status = 'danger';
                $msg .= __(':name are in use and cannot be deleted', ['name' => implode(', ', $fail)]);
            }
            $response = array(
                'status' => $status,
                'msg' => $msg
            );
        } else {
            $response = array(
                'status' => 'danger',
                'msg' => __('The operation is not authorized')
            );
        }
        return response()->json($response, 200);
    }


    public static function sync($array, $id = null)
    {
        if ($id) {
            Category::find($id)->revision();
        }
        $obj = Category::updateOrCreate(['id' => $id], $array);
        LogController::create($id ? 'sửa' : 'tạo', 'category', $obj->id);
        return $obj;
    }
}
