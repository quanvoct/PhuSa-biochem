<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Session;

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
        $language = Session::get('language', config('app.locale'));
        app()->setLocale($language, config('app.locale'));
        Session::put('language', $language);

        return $next($request);
    }
}
