<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $pageName = 'My Account';
        return view('account', compact('pageName'));
    }

    public function settings(Request $request)
    {
        $rules = [
            'password' => ['required', 'min: 8', 'max: 32'],
            'password' => [function ($attribute, $value, $fail) {
                if (!Hash::check($value, Auth::user()->password)) {
                    return $fail(__('Mật khẩu hiện tại không đúng'));
                }
            }],
            'name' => ['required', 'string', 'min: 3', 'max:125'],
            'email' => ['required', 'email', 'min: 5', 'max:125', Rule::unique('users')->ignore($request->id)],
            'phone' => ['required', 'numeric', 'digits:10', 'regex:/^(0|\+84)(\s|\.)?((3[2-9])|(5[689])|(7[06-9])|(8[1-689])|(9[0-46-9]))(\d)(\s|\.)?(\d{3})(\s|\.)?(\d{3})$/', Rule::unique('users')->ignore($request->id)],
            'address' => ['string', 'max:191']
        ];
        $messages = [
            'name.required' => 'Thông tin này không thể trống.',
            'email.required' => 'Thông tin này không thể trống.',
            'password.required' => 'Thông tin này không thể trống.',
            'phone.required' => 'Thông tin này không thể trống.',

            'name.string' => 'Thông tin không hợp lệ.',
            'email.email' => 'Vui lòng nhập đúng định dạng email',
            // 'password.string' => 'Thông tin không hợp lệ.',
            'address.string' => 'Thông tin không hợp lệ.',
            'phone.numeric' => 'Số điện thoại không đúng.',

            'name.min' => 'Tối thiểu 3 kí tự',
            'email.min' => 'Tối thiểu 5 kí tự',
            'password.min' => 'Tối thiểu 8 kí tự',
            'phone.digit' => 'Vui lòng nhập đúng số điện thoại',

            'name.max' => 'Tối đa 125 kí tự.',
            'email.max' => 'Tối đa 125 kí tự.',
            'address.max' => 'Tối đa 191 kí tự.',

            'email.unique' => 'Email đã tồn tại.',
            'phone.regex' => 'Vui lòng nhập đúng số điện thoại',
            'password.max' => 'Mật khẩu tối đa dưới 32 kí tự',
            'phone.unique' => 'Số điện thoại đã được đăng kí',
        ];
        $request->validate($rules, $messages);
        try {
            $user = User::find($request->id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->address = $request->address;
            $user->save();
            $response = array(
                'status' => 'success',
                'msg' => 'Đã cập nhật thông tin cá nhân của bạn',
            );
            return back()->with('response', $response);
        } catch (\Exception $exception) {
            return back()->withErrors($exception)->withInput();
        }
    }

    public function password(Request $request)
    {
        $rules = [
            'current_password' => ['required', 'min: 8', 'max: 32'],
            'current_password' => [function ($attribute, $value, $fail) {
                if (!Hash::check($value, Auth::user()->password)) {
                    return $fail(__('Mật khẩu hiện tại không đúng'));
                }
            }],
            'password' => ['required', 'min:8', 'max:32', 'different:current_password'],
            'password_confirmation' => ['required', 'min:8', 'max:32', 'same:password'],
        ];

        $messages = [
            'current_password.required' => 'Thông tin này không thể trống',
            'current_password.min' => 'Mật khẩu tối đa 8 ký tự',
            'current_password.max' => 'Mật khẩu tối đa 32 ký tự',

            'password.required' => 'Thông tin này không thể trống',
            'password.min' => 'Tối thiểu 8 kí tự',
            'password.max' => 'Mật khẩu tối đa dưới 32 kí tự',
            'password.different' => 'Mật khẩu mới không được trùng mật khẩu cũ',

            'password_confirmation.required' => 'Thông tin này không thể trống',
            'password_confirmation.min' => 'Tối thiểu 8 kí tự',
            'password_confirmation.max' => 'Mật khẩu tối đa dưới 32 kí tự',
            'password_confirmation.same' => 'Mật khẩu mới phải trùng khớp với mật khẩu bạn đặt'
        ];
        $request->validate($rules, $messages);

        try {
            $user = User::find($request->id);
            $user->password = Hash::make($request->password);
            $user->save();

            $response = [
                'status' => 'success',
                'msg' => 'Mật khẩu đã được cập nhật thành công.',
            ];
            return back()->with('response', $response);
        } catch (\Exception $exception) {
            return back()->withErrors($exception)->withInput();
        }
    }

    public function avatar(Request $request)
    {
        try {
            $image = $request->image;
            $filename = Str::slug(Auth::user()->name) . '.' . $image->extension();
            $image->storeAs('public/user/', $filename);
            $user = User::find($request->id);
            $user->image = $filename;
            $user->save();

            $response = array(
                'status' => 'success',
                'msg' => 'Đã cập nhật thành công ảnh đại diện',
            );
            return response()->json($response, 200);
        } catch (\Exception $exception) {
            return back()->withErrors($exception)->withInput();
        }
    }
}
