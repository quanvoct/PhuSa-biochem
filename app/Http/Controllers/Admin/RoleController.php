<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\Datatables\Datatables;
use Illuminate\Validation\Rule;

class RoleController extends Controller
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
    public function index(Request $request)
    {
        if ($request->key) {
            $result = Role::with('permissions')->find($request->key);
            if($result) {
                return response()->json($result, 200);
            } else {
                abort(404);
            }
        } else {
            if ($request->ajax()) {
                $users = Role::all();
                return DataTables::of($users)
                    ->addColumn('checkbox', function ($obj) {
                        if (!empty(Auth::user()->can(User::DELETE_ROLES))) {
                            return '<input class="form-check-input choice" type="checkbox" name="choices[]" value="' . $obj->id . '">';
                        }
                    })
                    ->editColumn('name', function ($obj) {
                        if (!empty(Auth::user()->can(User::READ_ROLE))) {
                            return '<a class="btn btn-link text-decoration-none text-start btn-update-role" data-id="' . $obj->id . '">' . $obj->name . '</a>';
                        } else {
                            return $obj->name;
                        }
                    })
                    ->addColumn('action', function ($obj) {
                        if (!empty(Auth::user()->can(User::DELETE_ROLE))) {
                            return '
                        <form method="post" action="' . route('admin.role.remove') . '" class="save-form">
                            <input type="hidden" name="choices[]" value="' . $obj->id . '"/>
                            <button type="submit" class="btn btn-link text-decoration-none btn-remove cursor-pointer">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>';
                        }
                    })
                    ->editColumn('permissions', function ($obj) {
                        return $obj->permissions->count() ? implode(' ', json_decode($obj->permissions->take(15)->map(function ($permission) {
                            return '<span class="badge bg-primary">' . $permission->name . '</span>';
                        }))) . ' và còn nhiều quyền khác' : 'Chưa được cấp quyền';
                    })
                    ->rawColumns(['checkbox', 'name', 'permissions', 'action'])
                    ->make(true);
            } else {
                $pageName = 'Quản lý nhóm quyền';
                return view('admin.roles', compact('pageName'));
            }
        }
    }

    public function create(Request $request)
    {
        $rules = [
            'name' => ['required', 'string', 'min: 3', 'max:125', 'unique:roles'],
        ];
        $messages = [
            'name.unique' => 'Tên này đã tồn tại.',
            'name.required' => 'Thông tin này không thể trống.',
            'name.string' => 'Thông tin không hợp lệ.',
            'name.min' => 'Tối thiểu 3 kí tự',
            'name.max' => 'Tối đa 125 kí tự.',
        ];
        $request->validate($rules, $messages);

        if (!empty(Auth::user()->can(User::CREATE_ROLE))) {
            $role = new Role([
                'name' => $request->name,
                'guard_name' => 'web',
            ]);
            $role->save();

            if ($role) {
                if ($request->permissions != null) {
                    foreach ($request->permissions as $key => $id) {
                        $permission = Permission::find($id);
                        $role->givePermissionTo($permission);
                    }
                }
                LogController::create("tạo", "nhóm quyền", $role->id);
                $response = [
                    'status' => 'success',
                    'msg' => 'Đã tạo nhóm quyền ' . $role->name,
                ];
            }
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
            'name' => Rule::unique('roles')->ignore($request->id),
        ];
        $messages = [
            'name.required' => 'Thông tin này không thể trống.',
            'name.string' => 'Thông tin không hợp lệ.',
            'name.min' => 'Tối thiểu 3 kí tự',
            'name.max' => 'Tối đa 125 kí tự.',
        ];
        $request->validate($rules, $messages);
        if (!empty(Auth::user()->can(User::UPDATE_ROLE))) {
            if ($request->has('id')) {
                $role = Role::find($request->id);
                $role->name = $request->name;
                $role->save();
                if ($role) {
                    $permissions = Permission::all();
                    foreach ($permissions as $key => $permission) {
                        $role->revokePermissionTo($permission);
                    }
                    if ($request->permissions != null) {
                        foreach ($request->permissions as $key => $permission) {
                            $role->givePermissionTo($permission);
                        }
                    }
                    LogController::create("sửa", "nhóm quyền", $role->id);
                    $response = [
                        'status' => 'success',
                        'msg' => 'Đã sửa nhóm quyền ' . $role->name,
                    ];
                }
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
        $names = [];
        foreach ($request->choices as $key => $id) {
            $role = Role::find($id);
            $role->delete();
            array_push($names, $role->name);
            LogController::create("xóa", "nhóm quyền", $role->id);
        }
        return response()->json([
            'status' => 'success',
            'msg' => 'Đã xóa nhóm quyền ' . $role->name,
        ], 200);
    }
}
