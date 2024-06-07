<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Language;
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
    public function index(Request $request)
    {
        $pageName = __('Settings');
        if (isset($request->key) && $request->key != 'general') {
            $language = Language::whereCode($request->key)->first();
            $settings = Setting::whereLanguage_id($language->id)->pluck('value', 'key')->put('language_id', $language->id);
        } else {
            $settings = Setting::whereNull('language_id')->pluck('value', 'key');
        }
        return view('admin.settings', compact('pageName', 'settings'));
    }

    public function updateSetting($key, $value, $language_id = null)
    {
        if ($language_id) {
            $language = Language::find($language_id);
            $settings = Setting::whereLanguage_id($language->id)->pluck('value', 'key');
        } else {
            $settings = Setting::whereNull('language_id')->pluck('value', 'key');
        }
        if (isset($settings[$key])) {
            if ($value != $settings[$key]) {
                if ($language_id) {
                    Setting::where('language_id', $language_id)->whereKey($key)->update(['value' => $value]);
                } else {
                    Setting::where('key', $key)->update(['value' => $value]);
                }
            }
        } else {
            Setting::create(['language_id' => $language_id, 'key' => $key, 'value' => $value]);
        }
    }

    public static function setEnv(array $values)
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

    public function updateEmail(Request $request)
    {
        try {
            $this->setEnv(array(
                'APP_NAME' => $request->app_name,
                'MAIL_DRIVER' => $request->mail_driver,
                'MAIL_HOST' => $request->mail_host,
                'MAIL_PORT' => $request->mail_port,
                'MAIL_USERNAME' => $request->mail_username,
                'MAIL_PASSWORD' => $request->mail_password,
                'MAIL_ENCRYPTION' => $request->mail_encryption,
                'MAIL_FROM_ADDRESS' => $request->mail_from_address,
            ));
            $response = [
                'status' => 'success',
                'msg' => __('Successfully updated email settings')
            ];
        } catch (\Throwable $th) {
            $response = [
                'status' => 'error',
                    'msg' => __('An error has occurred') . '. ' . __('Please try again later') .'!'
            ];
        }
        return  redirect()->back()->with('response', $response);
    }

    public function updateRecaptcha(Request $request)
    {
        try {
            $this->setEnv(array(
                'RECAPTCHAV3_SECRET' => $request->recaptchav3_secret,
                'RECAPTCHAV3_SITEKEY' => $request->recaptchav3_sitekey,
                'RECAPTCHAV3_ORIGIN' => $request->recaptchav3_origin,
                'RECAPTCHAV3_LOCALE' => $request->recaptchav3_locale,
            ));
            $response = [
                'status' => 'success',
                'msg' => __('Successfully updated Google Recaptcha v3 settings')
            ];
        } catch (\Throwable $th) {
            $response = [
                'status' => 'error',
                    'msg' => __('An error has occurred') . '. ' . __('Please try again later') .'!'
            ];
        }
        return  redirect()->back()->with('response', $response);
    }

    public function updateSocial(Request $request)
    {
        try {
            $this->updateSetting('social_facebook', $request->social_facebook);
            $this->updateSetting('social_zalo', $request->social_zalo);
            $this->updateSetting('social_youtube', $request->social_youtube);
            $this->updateSetting('social_whatsapp', $request->social_whatsapp);
            $this->updateSetting('social_telegram', $request->social_telegram);

            $response = [
                'status' => 'success',
                'msg' => __('Successfully updated social links settings')
            ];
        } catch (\Throwable $th) {
            $response = [
                'status' => 'error',
                    'msg' => __('An error has occurred') . '. ' . __('Please try again later') .'!'
            ];
        }
        return  redirect()->back()->with('response', $response);
    }

    public function updatePopup(Request $request)
    {
        $rules = [
            'popup_delay' => 'required|numeric|digits_between:3,5',
            'popup_content' => 'required',
        ];
        $request->validate($rules);

        try {
            $this->updateSetting('popup_enabled', $request->has('popup_enabled'), $request->language_id);
            $this->updateSetting('popup_delay', $request->popup_delay, $request->language_id);
            $this->updateSetting('popup_visibility', $request->popup_visibility, $request->language_id);
            $this->updateSetting('popup_content', $request->popup_content, $request->language_id);

            $response = [
                'status' => 'success',
                'msg' => __('Successfully updated popup settings')
            ];
            return redirect()->back()->with('response', $response);
        } catch (\Exception  $exception) {
            return back()->withError($exception)->withInput();
        }
    }

    public function updateCompany(Request $request)
    {
        $rules = [
            'company_name' => 'required|string|min:2|max:191',
            'company_address' => 'required|string|min:2|max:191',
            'company_hotline' => 'required|string|min:2|max:191',
            'company_phone' => 'required|string|min:2|max:191',
            'company_tax_id' => 'required|string|min:2|max:191',
            'company_tax_meta' => 'required|string|min:2|max:191',
            'company_email' => 'required|email|min:2|max:191',
        ];
        $request->validate($rules);
        try {
            $this->updateSetting('company_name', $request->company_name, $request->language_id);
            $this->updateSetting('company_address', $request->company_address, $request->language_id);
            $this->updateSetting('company_hotline', $request->company_hotline, $request->language_id);
            $this->updateSetting('company_phone', $request->company_phone, $request->language_id);
            $this->updateSetting('company_tax_id', $request->company_tax_id, $request->language_id);
            $this->updateSetting('company_tax_meta', $request->company_tax_meta, $request->language_id);
            $this->updateSetting('company_email', $request->company_email, $request->language_id);
            $response = [
                'status' => 'success',
                'msg' => __('Successfully updated company information settings')
            ];
        } catch (\Throwable $th) {
            $response = [
                'status' => 'error',
                    'msg' => __('An error has occurred') . '. ' . __('Please try again later') .'!'
            ];
        }
        return  redirect()->back()->with('response', $response);
    }

    public function updateCode(Request $request)
    {
        try {
            $this->updateSetting('head_code', $request->head_code);
            $this->updateSetting('body_top_code', $request->body_top_code);
            $this->updateSetting('body_bottom_code', $request->body_bottom_code);
            $this->updateSetting('contact_map', $request->contact_map);

            $response = [
                'status' => 'success',
                'msg' => __('Successfully updated additional code settings')
            ];
        } catch (\Throwable $th) {
            $response = [
                'status' => 'error',
                    'msg' => __('An error has occurred') . '. ' . __('Please try again later') .'!'
            ];
        }
        return  redirect()->back()->with('response', $response);
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
                'msg' => __('Successfully updated payment settings')
            ];
        } catch (\Throwable $th) {
            $response = [
                'status' => 'error',
                    'msg' => __('An error has occurred') . '. ' . __('Please try again later') .'!'
            ];
        }
        return  redirect()->route('setting')->with('response', $response);
    }
}
