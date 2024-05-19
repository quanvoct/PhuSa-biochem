<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Session;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getSettings() {
        if(Session::has('settings')) {
            $settings = Session::get('settings', Setting::pluck('value', 'key'));
        } else {
            $settings = Setting::pluck('value', 'key');
        }
        Session::put('settings', $settings);
        return $settings;
    }
}
