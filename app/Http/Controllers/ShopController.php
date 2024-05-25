<?php

namespace App\Http\Controllers;

use App\Models\Catalogue;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ShopController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function shop(Request $request)
    {
        if ($request->catalogue) {
            if ($request->product) {
                $product = Product::whereStatus(1)->whereSlug($request->product)->first();
                if ($product) {
                    $pageName = $product->name;
                    return view('product', compact('pageName'));
                } else {
                    abort(404);
                }
            } else {
                $catalogue = Catalogue::whereStatus(1)->whereSlug($request->catalogue)->first();
                if ($catalogue) {
                    $pageName = $catalogue->name;
                    return view('catalogue', compact('pageName'));
                } else {
                    abort(404);
                }
            }
        } else {
            $pageName = __('Shop');
            return view('shop', compact('pageName'));
        }
    }

    public function changeLanguage(Request $request)
    {
        app()->setLocale($request->language, config('app.locale'));
        Session::put('language', $request->language);
        return redirect()->back();
    }
}
