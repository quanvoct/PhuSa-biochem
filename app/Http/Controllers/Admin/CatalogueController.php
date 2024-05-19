<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Catalogue;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class CatalogueController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
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
    public function index()
    {
        $pageName = 'Quản lý danh mục';
        $options = Controller::options();
        return view('catalogue', compact('pageName', 'options'));
    }
    public function load(Request $request)
    {
        $attributes = Catalogue::all();
        return DataTables::of($attributes)
            ->addColumn('checkbox', function ($obj) {
                if (!empty(Auth::user()->hasAnyPermission(User::DELETE_CATALOGUES))) {
                    return '<input class="form-check-input choice" type="checkbox" name="choices[]" value="' . $obj->id . '">';
                }
            })
            ->editColumn('name', function ($obj) {
                if (!empty(Auth::user()->hasAnyPermission(User::READ_CATALOGUE))) {
                    return '<a class="btn btn-link text-decoration-none text-start btn-update-catalogue" data-id="' . $obj->id . '">' . $obj->name . '</a>';
                } else {
                    return $obj->name;
                }
            })
            ->editColumn('status', function ($obj) {
                return $obj->statusName();
            })
            ->addColumn('action', function ($obj) {
                if (!empty(Auth::user()->hasAnyPermission(User::DELETE_CATALOGUE))) {
                    return '
                        <form action="' . route('catalogue.remove') . '" method="post" class="save-form">
                            <input type="hidden" name="_token" value="' . csrf_token() . '"/>
                            <input type="hidden" name="choices[]" value="' . $obj->id . '" data-id="'  . $obj->id . '"/>
                            <button type="submit" class="btn btn-link text-decoration-none btn-remove">
                                <i class="bi bi-trash3"></i>
                            </button>
                        </form>';
                }
            })
            ->rawColumns(['checkbox', 'slug', 'name', 'note', 'action'])
            ->make(true);
    }

    public function get(Request $request)
    {
        $objs = Catalogue::query();
        switch ($request->id) {
            case 'list':
                $result = $objs->orderBy('sort', 'ASC')->get();
                break;
            case 'find':
                $result = $objs->whereStatus(1)
                    ->where('name', 'LIKE', '%' . $request->q . '%')
                    ->orWhere('note', 'LIKE', '%' . $request->q . '%')
                    ->orderByDesc('id')
                    ->distinct()
                    ->get()
                    ->map(function ($obj) {
                        return [
                            'id' => $obj->id,
                            'text' => $obj->name
                        ];
                    });
                break;
            default:
                $obj = $objs->find($request->id);
                if ($obj) {
                    $result = $obj;
                } else {
                    abort(404);
                }
                break;
        }
        return response()->json($result, 200);
    }

    public function create(Request $request)
    {

        $rules = [
            'name' => ['required', 'string', 'min: 3', 'max:125'],

        ];
        $messages = [
            'name.required' => 'Thông tin này không thể trống.',
            'name.string' => 'Dữ liệu không hợp lệ!',
            'name.min' => 'Tối thiểu từ 3 ký tự!',
            'name.max' => 'Tối đa được 125 ký tự!',
        ];

        $request->validate($rules, $messages);
        if (!empty(Auth::user()->can(User::CREATE_CATALOGUE))) {
            $catalogue = $this->sync([
                'name' => $request->name,
                'note' => $request->note,
                'status' => $request->has('status'),
            ]);
            $response = array(
                'status' => 'success',
                'msg' => 'Đã tạo danh mục ' . $catalogue->name
            );
        } else {
            $response = array(
                'status' => 'error',
                'msg' => 'Thao tác chưa được cấp quyền!'
            );
        }
        return response()->json($response, 200);
    }
    public function update(Request $request)
    {

        $rules = [
            'name' => ['required', 'string', 'min: 3', 'max:125'],

        ];
        $messages = [
            'name.required' => 'Thông tin này không thể trống.',
            'name.string' => 'Dữ liệu không hợp lệ',
            'name.required' => 'Tối thiểu từ 3 ký tự',
            'name.required' => 'Tối đa 125 ký tự',
        ];
        $request->validate($rules, $messages);
        if (!empty(Auth::user()->can(User::UPDATE_CATALOGUE))) {
            if ($request->has('id')) {
                $catalogue = $this->sync([
                    'name' => $request->name,
                    'note' => $request->note,
                    'status' => $request->has('status'),
                ], $request->id);

                $response = array(
                    'status' => 'success',
                    'msg' => 'Đã cập nhật ' . $catalogue->name
                );
            } else {
                $response = array(
                    'status' => 'error',
                    'msg' => 'Đã có lỗi xảy ra, vui lòng tải lại trang và thử lại!'
                );
            }
        } else {
            $response = array(
                'status' => 'error',
                'msg' => 'Thao tác chưa được cấp quyền!'
            );
        }
        return response()->json($response, 200);
    }

    public function remove(Request $request)
    {
        $catalogues = [];
        foreach ($request->choices as $key => $id) {
            $catalogue = Catalogue::find($id);
            $catalogue->delete();
            array_push($catalogues, $catalogue->id);
        }
        LogController::create("xóa", "danh mục", $catalogue->id);
        $response = array(
            'status' => 'success',
            'msg' => 'Đã xóa danh mục ' . implode(', ', $catalogues)
        );
        return  response()->json($response, 200);
    }


    public static function sync($array, $id = null)
    {
        $obj = Catalogue::updateOrCreate(['id' => $id], $array);
        LogController::create($id ? 'sửa' : 'tạo', "danh mục", $obj->id);
        return $obj;
    }
}
