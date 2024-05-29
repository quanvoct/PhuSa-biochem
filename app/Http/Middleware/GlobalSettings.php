<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Catalogue;
use App\Models\Category;
use App\Models\Setting;
use Jenssegers\Agent\Agent;

class GlobalSettings
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Session::has('categories')) {
            Session::put('categories', Category::whereNull('revision')->whereStatus(1)->orderBy('sort', 'ASC')->get());
        }
        if (!Session::has('catalogues')) {
            Session::put('catalogues', Catalogue::whereNull('revision')->whereStatus(1)->orderBy('sort', 'ASC')->get());
        }
        if (!Session::has('settings')) {
            Session::put('settings', Setting::pluck('value', 'key'));
        }
        return $next($request);
    }
}