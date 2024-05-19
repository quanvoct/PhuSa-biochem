<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Env;
use Illuminate\Support\Facades\Http;

class SettingController extends Controller
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
        $pageName = 'Cài đặt hệ thống';
        $options = Controller::options();
        $banks = Http::get('https://api.vietqr.io/v2/banks')->json();
        return view('setting', compact('pageName', 'options', 'banks'));
    }
    public function setEnv(array $values)
    {
        $envFile = app()->environmentFilePath();
        $str = file_get_contents($envFile);
        if (count($values) > 0) {
            foreach ($values as $envKey => $envValue) {
                $keyPosition = strpos($str, "{$envKey}=");
                $endOfLinePosition = strpos($str, "\n", $keyPosition);
                $oldLine = substr($str, $keyPosition, $endOfLinePosition - $keyPosition);
                // If key does not exist, add it
                if (!$keyPosition || !$endOfLinePosition || !$oldLine) {
                    $str .= "{$envKey}='{$envValue}'\n";
                } else {
                    $str = str_replace($oldLine, "{$envKey}='{$envValue}'", $str);
                }
            }
        }
        $str = substr($str, 0, -1);
        $str .= "\n";
        if (!file_put_contents($envFile, $str)) {
            return false;
        }
        return true;
    }

    public function updateMail(Request $request)
    {
        try {
            foreach ($request->all() as $key => $value) {
                if ($key != "_token") {
                    Setting::updateOrCreate(['key' => $key], ['value' => $value]);
                    if (Setting::whereKey($key)->first()) {
                        LogController::create("sửa", "cài đặt", Setting::whereKey($key)->first()->id);
                    }
                }
            }
            $this->setEnv(array(
                'MAIL_MAILER' => $request->mail_mailer,
                'MAIL_HOST' => $request->mail_host,
                'MAIL_PORT' => $request->mail_port,
                'MAIL_USERNAME' => $request->mail_username,
                'MAIL_PASSWORD' => $request->mail_password,
                'MAIL_ENCRYPTION' => $request->mail_encryption,
                'MAIL_FROM_ADDRESS' => $request->mail_from_address,
            ));
            $response = [
                'status' => 'success',
                'msg' => 'Đã cập nhật cài đặt email'
            ];
        } catch (\Throwable $th) {
            $response = [
                'status' => 'error',
                'msg' => 'Đã có lỗi xảy ra trong quá trình thực thi. Vui lòng liên hệ đơn vị phát triển phần mềm để khắc phục'
            ];
        }
        return  redirect()->route('setting')->with('response', $response);
    }

    public function updateCompany(Request $request)
    {
        try {
            foreach ($request->all() as $key => $value) {
                if ($key != "_token") {
                    Setting::updateOrCreate(['key' => $key], ['value' => $value]);
                    if (Setting::whereKey($key)->first()) {
                        LogController::create("sửa", "cài đặt", Setting::whereKey($key)->first()->id);
                    }
                }
            }
            $response = [
                'status' => 'success',
                'msg' => 'Đã cập nhật cài đặt cửa hàng'
            ];
        } catch (\Throwable $th) {
            $response = [
                'status' => 'error',
                'msg' => 'Đã có lỗi xảy ra trong quá trình thực thi. Vui lòng liên hệ đơn vị phát triển phần mềm để khắc phục'
            ];
        }
        return  redirect()->route('setting')->with('response', $response);
    }

    public function updatePay(Request $request)
    {
        try {
            foreach ($request->all() as $key => $value) {
                if ($key != "_token") {
                    Setting::updateOrCreate(['key' => $key], ['value' => $value]);
                    if (Setting::whereKey($key)->first()) {
                        LogController::create("sửa", "cài đặt", Setting::whereKey($key)->first()->id);
                    }
                }
            }
            $response = [
                'status' => 'success',
                'msg' => 'Đã cập nhật cài đặt thanh toán'
            ];
        } catch (\Throwable $th) {
            $response = [
                'status' => 'error',
                'msg' => 'Đã có lỗi xảy ra trong quá trình thực thi. Vui lòng liên hệ đơn vị phát triển phần mềm để khắc phục'
            ];
        }
        return  redirect()->route('setting')->with('response', $response);
    }
}
