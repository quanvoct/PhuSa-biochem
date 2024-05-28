<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Models\User;
use App\Mail\SendMail;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Queue;

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
                            $str .= '<a class="btn text-primary btn-update-user_password" data-id="' . $obj->id . '">
                                <i class="bi bi-key" data-bs-toggle="tooltip" data-bs-title="Đổi mật khẩu"></i>
                            </a>
                            <a class="btn text-primary btn-update-user_role" data-id="' . $obj->id . '">
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
                    ->rawColumns(['checkboxes', 'name', 'status', 'action'])
                    ->make(true);
            } else {
                $pageName = 'Quản lý ' . self::NAME;
                return view('admin.users', compact('pageName'));
            }
        }
    }

    public function get(Request $request)
    {
        $objs = User::query();
        switch ($request->id) {
            case 'list':
                $result = $objs->orderBy('sort', 'ASC')->get();
                break;
            case 'find':
                $result = $objs->whereStatus(1)
                    ->where('name', 'LIKE', '%' . $request->q . '%')
                    ->orWhere('email', 'LIKE', '%' . $request->q . '%')
                    ->orWhere('phone', 'LIKE', '%' . $request->q . '%')
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
                $obj = $objs->with('roles', 'stores')->find($request->id);
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
            'name' => ['required', 'string', 'min: 2', 'max:191'],
            'email' => ['required', 'email', 'min: 2', 'max:191'],
            'email' => Rule::unique('users')->whereNull('revision')->whereNull('deleted_at'),
            'phone' => ['required', 'numeric'],
            'phone' => Rule::unique('users')->whereNull('revision')->whereNull('deleted_at'),
            'address' => ['string', 'max:191'],
            'birthday' => ['date_format:Y-m-d'],
            'gender' => ['required', 'numeric'],
        ];
        $messages = [
            'name.required' => Controller::VALIDATE['required'],
            'name.string' => Controller::VALIDATE['invalid'],
            'name.min' => Controller::VALIDATE['min2'],
            'name.max' => Controller::VALIDATE['max191'],
            'phone.required' => Controller::VALIDATE['required'],
            'phone.numeric' => Controller::VALIDATE['invalid'],
            'phone.unique' => Controller::VALIDATE['unique'],
            'gender.required' => Controller::VALIDATE['required'],
            'gender.numeric' => Controller::VALIDATE['invalid'],
            'birthday.date_format' => Controller::VALIDATE['invalid'],
            'email.required' => Controller::VALIDATE['required'],
            'email.email' => Controller::VALIDATE['invalid'],
            'email.min' => Controller::VALIDATE['min2'],
            'email.max' => Controller::VALIDATE['max191'],
            'email.unique' => Controller::VALIDATE['unique'],
            'address.string' => Controller::VALIDATE['invalid'],
            'address.max' => Controller::VALIDATE['max191'],
        ];
        $request->validate($rules, $messages);

        if (!empty(Auth::user()->can(User::CREATE_USER))) {
            $password = $request->has('password') ? $request->password : Str::random(8);
            $user = $this->sync([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'birthday' => $request->birthday,
                'address' => $request->address,
                'country' => $request->country,
                'password' => Hash::make($password),
                'city' => $request->city,
                'zip' => $request->zip,
                'gender' => $request->has('gender') ? $request->gender : 0,
                'status' => $request->has('status'),
            ]);
            if ($user) {
                if ($request->image) {
                    $imageInfo = pathinfo($request->image->getClientOriginalName());
                    $filename = Str::slug($user->name) . '.' . $imageInfo['extension'];
                    $request->image->storeAs('public/user/', $filename);
                    $user->update(['image' => $filename]);
                }
                $emailData = [
                    'user' => $user,
                    'password' => $password,
                    'settings' => Controller::getSettings(),
                ];
                Mail::to($user->email)->later(
                    now()->addMinutes(5),
                    new SendMail('admin.exports.mail.user_created', $emailData, 'Tài khoản của bạn tại ' . $emailData['settings']['company_brandname'])
                );
                $response = [
                    'status' => 'success',
                    'msg' => 'Đã tạo tài khoản ' . $user->name,
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
            'name' => ['required', 'string', 'min: 2', 'max:191'],
            'email' => ['required', 'email', 'min: 2', 'max:191'],
            'email' => Rule::unique('users')->whereNull('revision')->whereNull('deleted_at')->ignore($request->id),
            'phone' => ['required', 'numeric'],
            'phone' => Rule::unique('users')->whereNull('revision')->whereNull('deleted_at')->ignore($request->id),
            'address' => ['string', 'max:191'],
            'birthday' => ['date_format:Y-m-d'],
            'gender' => ['required', 'numeric'],
        ];
        $messages = [
            'name.required' => Controller::VALIDATE['required'],
            'name.string' => Controller::VALIDATE['invalid'],
            'name.min' => Controller::VALIDATE['min2'],
            'name.max' => Controller::VALIDATE['max191'],
            'phone.required' => Controller::VALIDATE['required'],
            'phone.numeric' => Controller::VALIDATE['invalid'],
            'phone.unique' => Controller::VALIDATE['unique'],
            'gender.required' => Controller::VALIDATE['required'],
            'gender.numeric' => Controller::VALIDATE['invalid'],
            'birthday.date_format' => Controller::VALIDATE['invalid'],
            'email.required' => Controller::VALIDATE['required'],
            'email.email' => Controller::VALIDATE['invalid'],
            'email.min' => Controller::VALIDATE['min2'],
            'email.max' => Controller::VALIDATE['max191'],
            'email.unique' => Controller::VALIDATE['unique'],
            'address.string' => Controller::VALIDATE['invalid'],
            'address.max' => Controller::VALIDATE['max191'],
        ];
        $request->validate($rules, $messages);

        if (!empty(Auth::user()->can(User::UPDATE_USER))) {
            if ($request->has('id')) {
                $user = $this->sync([
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'birthday' => $request->birthday,
                    'address' => $request->address,
                    'country' => $request->country,
                    'city' => $request->city,
                    'zip' => $request->zip,
                    'gender' => $request->has('gender') ? $request->gender : 0,
                    'status' => $request->has('status'),
                ], $request->id);
                if ($user) {
                    if ($request->image) {
                        $imageInfo = pathinfo($request->image->getClientOriginalName());
                        $filename = Str::slug($user->name) . '.' . $imageInfo['extension'];
                        $request->image->storeAs('public/user/', $filename);
                        $user->update(['image' => $filename]);
                    }
                    $response = [
                        'status' => 'success',
                        'msg' => 'Đã cập nhật tài khoản ' . $user->name,
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

    public function updateRole(Request $request)
    {
        $rules = [
            'id' => ['required', 'numeric'],
            'role_id' => ['required', 'numeric'],
        ];
        $messages = [
            'id.required' => 'Đã có lỗi xảy ra. Hãy tải lại trang và thử lại',
            'id.numeric' => 'Dữ liệu không hợp lệ',
            'role_id.required' => 'Phải chọn một vai trò',
            'role_id.numeric' => 'Dữ liệu không hợp lệ',
        ];
        $request->validate($rules, $messages);

        $user = User::find($request->id);
        $user->syncRoles($request->role_id);
        $roles = $user->getRoleNames()->implode(', ');
        LogController::create('cập nhật vai trò ' . $roles, "tài khoản", $user->id);
        $response = array(
            'status' => 'success',
            'msg' => 'Đã cập nhật vai trò ' . $roles . ' cho ' . $user->name . '!'
        );
        return response()->json($response, 200);
    }

    public function updatePassword(ChangePasswordRequest $request)
    {
        $rules = [
            'id' => ['required', 'numeric'],
            'password' => ['required'],
        ];
        $messages = [
            'id.required' => 'Đã có lỗi xảy ra. Hãy tải lại trang và thử lại',
            'id.numeric' => 'Dữ liệu không hợp lệ',
            'password.required' => 'Vui lòng nhập mật khẩu hợp lệ',
        ];
        $request->validate($rules, $messages);

        $user = User::find($request->id);
        if (!$user) {
            return back()->withErrors(['user_id' => 'User không tồn tại']);
        }
        $user->password = Hash::make($request->password);
        $user->save();

        LogController::create('cập nhật mật khẩu', "tài khoản", $user->id);
        $response = array(
            'status' => 'success',
            'msg' => 'Đã cập nhật mật khẩu cho ' . $user->name . '!'
        );
        return response()->json($response, 200);
    }

    public static function sync($array, $id = null)
    {
        if ($id) {
            User::find($id)->revision();
        }
        $obj = User::updateOrCreate(['id' => $id], $array);
        LogController::create($id ? 'sửa' : 'tạo', "tài khoản", $obj->id);
        return $obj;
    }

    public function remove(Request $request)
    {
        $names = [];
        foreach ($request->choices as $key => $id) {
            $obj = User::find($id);
            $obj->revision();
            $obj->delete();
            array_push($names, $obj->name);
            LogController::create("xóa", "tài khoản", $obj->id);
        }
        return response()->json([
            'status' => 'success',
            'msg' => 'Đã xóa tài khoản ' . implode(', ', $names),
        ], 200);
    }
}
