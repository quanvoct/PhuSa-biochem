<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function cart(Request $request)
    {
        $settings = Controller::getSettings();
        $pageName = 'Cart';
        return view('cart', compact('pageName', 'settings'));
    }
    public function checkout(Request $request)
    {
        $settings = Controller::getSettings();
        $pageName = 'Checkout';
        return view('checkout', compact('pageName', 'settings'));
    }
}
