<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function cart(Request $request)
    {
        $pageName = __('Cart');
        return view('cart', compact('pageName'));
    }
    public function checkout(Request $request)
    {
        $pageName = __('Checkout');
        return view('checkout', compact('pageName'));
    }
}
