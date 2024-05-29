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
            $catalogue = Catalogue::whereNull('revision')->whereStatus(1)->whereSlug($request->catalogue)
                ->with(['products' => function ($query) {
                    $query->whereNull('revision')
                        ->where('status', '>', 0)
                        ->orderBy('sort', 'DESC');
                }])->first();
            if ($request->product) {
                $product = Product::whereNull('revision')->whereStatus(1)->whereSlug($request->product)->first();
                if ($product) {
                    $pageName = $product->name;
                    return view('product', compact('pageName', 'product', 'catalogue'));
                } else {
                    abort(404);
                }
            } else {
                if ($catalogue) {
                    $pageName = $catalogue->name;
                    $products = $catalogue->products()->paginate(1);
                    return view('catalogue', compact('pageName', 'catalogue', 'products'));
                } else {
                    abort(404);
                }
            }
        } else {
            $catalogues = Catalogue::whereNull('revision')
                ->where('status', 1)
                ->orderBy('id', 'DESC')
                ->get();

            $products = Product::whereNull('revision')
                ->where('status', '>', 0)
                ->orderBy('sort', 'DESC')
                ->paginate(1);

            $pageName = __('Shop');
            return view('shop', compact('pageName', 'catalogues', 'products'));
        }
    }
}
