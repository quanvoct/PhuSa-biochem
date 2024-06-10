<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class Language
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        Session::put('ip', $request->ip());
        $geolocation = Http::get('https://ipinfo.io/' . $request->ip() . '/json?token=d89e4a0555c438')->json();
        $code = isset($geolocation['country']) && strtolower($geolocation['country']) == 'vn' ? 'vn' : 'en';
        $language = Session::get('language', $code);
        app()->setLocale($language, $code);
        Session::put('language', $language);

        return $next($request);
    }
}
