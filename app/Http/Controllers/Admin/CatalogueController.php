<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Catalogue;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class CatalogueController extends Controller
{
    const NAME = 'danh mục',
        RULES = [
            'name' => ['required', 'string', 'min:2', 'max:191'],
            'description' => ['nullable', 'string', 'min:2', 'max:191'],
            'parent_id' => ['nullable', 'numeric'],
            'avatar' => ['nullable', 'string'],
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
                    $obj = Catalogue::orderBy('sort', 'ASC')->when(count($ids), function ($query) use ($ids) {
                        $query->whereIn('id', $ids);
                    })->get();
                    return response()->json($obj, 200);
                    break;
                case 'tree':
                    $catalogues = Catalogue::whereNull('parent_id')->where('status', 1)->with('children')->get();
                    return view('admin.includes.catalogue_recursion', ['catalogues' => $catalogues]);
                    break;
                case 'find':
                    return Catalogue::whereStatus(1)
                        ->where('name', 'LIKE', '%' . $request->q . '%')
                        ->orWhere('description', 'LIKE', '%' . $request->q . '%')
                        ->orderByDesc('id')
                        ->distinct()
                        ->get()
                        ->map(function ($obj) {
                            return [
                                'id' => $obj->id,
                                'text' => $obj->name
                            ];
                        })
                        ->push(['id' => " ", 'text' => 'Không có']);
                    break;
                default:
                    $obj = Catalogue::with('parent')->find($request->key);
                    if ($obj) {
                        return response()->json($obj, 200);
                    } else {
                        abort(404);
                    }
                    break;
            }
        } else {
            if ($request->ajax()) {
                $catalogues = Catalogue::whereNull('revision');
                return DataTables::of($catalogues)
                    ->addColumn('checkboxes', function ($obj) {
                        if (!empty(Auth::user()->can(User::DELETE_CATALOGUES))) {
                            return '<input class="form-check-input choice" type="checkbox" name="choices[]" value="' . $obj->id . '">';
                        }
                    })
                    ->editColumn('name', function ($obj) {
                        if (!empty(Auth::user()->can(User::UPDATE_CATALOGUE))) {
                            return '<a class="btn btn-link text-decoration-none text-start btn-update-catalogue" data-id="' . $obj->id . '">' . $obj->name . '</a>';
                        } else {
                            return $obj->name;
                        }
                    })
                    ->editColumn('image', function ($obj) {
                        return '<img src="' . $obj->imageUrl . '" class="thumb cursor-pointer object-fit-cover" style="width: 60px; height: 60px">';
                    })
                    ->editColumn('status', function ($obj) {
                        return '<span class="badge bg-' . ($obj->status ? 'success' : 'danger') . '">' . $obj->statusStr . '</span>';
                    })
                    ->addColumn('parent', function ($obj) {
                        return $obj->parent ? $obj->parent->name : 'Không có';
                    })
                    ->addColumn('action', function ($obj) {
                        if (!empty(Auth::user()->can(User::DELETE_CATALOGUE))) {
                            return '
                        <form action="' . route('admin.catalogue.remove') . '" method="post" class="save-form">
                            <input type="hidden" name="_token" value="' . csrf_token() . '"/>
                            <input type="hidden" name="choices[]" value="' . $obj->id . '" data-id="'  . $obj->id . '"/>
                            <button type="submit" class="btn btn-link text-decoration-none btn-remove">
                                <i class="bi bi-trash3"></i>
                            </button>
                        </form>';
                        }
                    })
                    ->rawColumns(['checkboxes', 'name', 'image', 'status', 'action'])
                    ->make(true);
            } else {
                $pageName = 'Quản lý ' . self::NAME;
                return view('admin.catalogues', compact('pageName'));
            }
        }
    }

    public function sort(Request $request)
    {
        $ids = $request->input('sort');
        if (count($ids) == Catalogue::all()->count()) {
            foreach ($ids as $index => $id) {
                Catalogue::where('id', $id)->update(['sort' => $index + 1]);
            }
        } else {
            $sorts = Catalogue::whereIn('id', $ids)->orderBy('sort', 'ASC')->pluck('sort');
            foreach ($sorts as $index => $sort) {
                Catalogue::find($ids[$index])->update(['sort' => $sort]);
            }
        }
        return response()->json(['msg' => 'Thứ tự đã được cập nhật thành công']);
    }

    public function create(Request $request)
    {
        $request->validate(self::RULES);
        if (!empty(Auth::user()->can(User::CREATE_CATALOGUE))) {
            $catalogue = $this->sync([
                'name' => $request->name,
                'sort' => Catalogue::max('sort') + 1,
                'slug' => Str::slug($request->name),
                'parent_id' => $request->parent_id,
                'description' => $request->description,
                'image' => $request->image,
                'status' => $request->has('status'),
            ], $request->ip());
            $response = array(
                'status' => 'success',
                'msg' => 'Đã tạo ' . self::NAME . ' ' . $catalogue->name
            );
        } else {
            $response = array(
                'status' => 'danger',
                'msg' => 'Thao tác chưa được cấp quyền!'
            );
        }
        return response()->json($response, 200);
    }

    public function update(Request $request)
    {
        $request->validate(self::RULES);
        if (!empty(Auth::user()->can(User::UPDATE_CATALOGUE))) {
            if ($request->has('id')) {
                $catalogue = $this->sync([
                    'name' => $request->name,
                    'slug' => Str::slug($request->name),
                    'parent_id' => $request->parent_id,
                    'description' => $request->description,
                    'image' => $request->image,
                    'status' => $request->has('status'),
                ], $request->ip(), $request->id);

                $response = array(
                    'status' => 'success',
                    'msg' => 'Đã cập nhật ' . $catalogue->name
                );
            } else {
                $response = array(
                    'status' => 'danger',
                    'msg' => 'Đã có lỗi xảy ra, vui lòng tải lại trang và thử lại!'
                );
            }
        } else {
            $response = array(
                'status' => 'danger',
                'msg' => 'Thao tác chưa được cấp quyền!'
            );
        }
        return response()->json($response, 200);
    }

    public function remove(Request $request)
    {
        $msg = [];
        foreach ($request->choices as $key => $id) {
            $obj = Catalogue::find($id);
            $obj->revision();
            $obj->delete();
            array_push($msg, $obj->name);
            LogController::create("xóa", self::NAME, $obj->id, $request->ip());
        }
        $response = array(
            'status' => 'success',
            'msg' => 'Đã xóa ' . self::NAME . ' ' . implode(', ', $msg)
        );
        return  response()->json($response, 200);
    }


    public static function sync($array, $ip = null, $id = null)
    {
        $obj = Catalogue::updateOrCreate(['id' => $id], $array);
        LogController::create($id ? 'sửa' : 'tạo', self::NAME, $obj->id, $ip);
        return $obj;
    }
}
