<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    const NAME = 'tài khoản';
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if (isset($request->key)) {
            $objs = User::query();
            switch ($request->key) {
                case 'list':
                    $result = $objs->whereStatus(1)->get();
                case 'find':
                    $result = $objs->whereStatus(1)
                        ->where('id', 'LIKE', '' . $request->q . '%')
                        ->where('name', 'LIKE', '' . $request->q . '%')
                        ->orWhere('phone', 'LIKE', '%' . $request->q . '%')
                        ->orWhere('email', 'LIKE', '%' . $request->q . '%')
                        ->get()
                        ->map(function ($obj) {
                            return [
                                'id' => $obj->id,
                                'text' => $obj->name . ' - ' . $obj->phone
                            ];
                        });
                    break;
                default:
                    $result = $objs->with(['roles'])->find($request->key);
                    break;
            }
            return response()->json($result, 200);
        } else {
            if ($request->ajax()) {
                $objs = User::all();
                return DataTables::of($objs)
                    ->addColumn('checkboxes', function ($obj) {
                        if (!empty(Auth::user()->can(User::DELETE_USERS))) {
                            return '<input class="form-check-input choice" type="checkbox" name="choices[]" value="' . $obj->id . '">';
                        }
                    })
                    ->editColumn('name', function ($obj) {
                        if (!empty(Auth::user()->can(User::UPDATE_USER))) {
                            return '<a class="btn btn-update-user key-primary text-decoration-none text-start" data-id="' . $obj->id . '">' . $obj->name . '</a>';
                        } else {
                            return $obj->name;
                        }
                    })
                    ->editColumn('roles', function ($obj) {
                        return $obj->getRoleNames()->first();
                    })
                    ->editColumn('local', function ($obj) {
                        return $obj->fullAddress;
                    })
                    ->editColumn('status', function ($obj) {
                        return '<span class="badge bg-' . ($obj->status ? 'success' : 'danger') . '">' . $obj->statusStr . '</span>';
                    })
                    ->addColumn('action', function ($obj) {
                        $str = '<div class="d-flex justify-content-end">';
                        if (Auth::user()->can(User::UPDATE_USER)) {
                            $str .= '<a class="btn text-primary btn-password-user" data-id="' . $obj->id . '">
                                <i class="bi bi-key" data-bs-toggle="tooltip" data-bs-title="Đổi mật khẩu"></i>
                            </a>
                            <a class="btn text-primary btn-role-user" data-id="' . $obj->id . '">
                                <i class="bi bi-person-lock" data-bs-toggle="tooltip" data-bs-title="Phân quyền"></i>
                            </a>';
                        }
                        if (Auth::user()->can(User::DELETE_USER)) {
                            $str .= '<form method="post" action="' . route('admin.user.remove') . '" class="save-form">
                                    <input type="hidden" name="choices[]" value="' . $obj->id . '"/>
                                    <button class="btn btn-link text-decoration-none btn-remove" data-bs-toggle="tooltip" data-bs-placement="top"
                                    data-bs-title="Xóa">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>';
                        }
                        return $str . '</div>';
                    })
                    ->rawColumns(['checkboxes', 'name', 'status', 'action', 'pet'])
                    ->make(true);
            } else {
                $pageName = 'Quản lý ' . self::NAME;
                return view('admin.users', compact('pageName'));
            }
        }
    }
}
