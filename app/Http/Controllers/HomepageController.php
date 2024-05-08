<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomepageController extends Controller
{
    public function index(Request $request)
    {
        $pageName = 'Home';
        return view('index', compact('pageName'));
    }
    public function about(Request $request)
    {
        $pageName = 'About';
        return view('about', compact('pageName'));
    }
    public function shop(Request $request)
    {
        $pageName = 'Shop';
        return view('shop', compact('pageName'));
    }
    public function product(Request $request)
    {
        $pageName = 'Product';
        return view('product', compact('pageName'));
    }
    public function posts(Request $request)
    {
        $pageName = 'Posts';
        return view('posts', compact('pageName'));
    }
    public function post(Request $request)
    {
        $pageName = 'Post';
        return view('post', compact('pageName'));
    }
    public function contact(Request $request)
    {
        $pageName = 'Contact';
        return view('contact', compact('pageName'));
    }
    public function cart(Request $request)
    {
        $pageName = 'Cart';
        return view('cart', compact('pageName'));
    }
    public function checkout(Request $request)
    {
        $pageName = 'Checkout';
        return view('checkout', compact('pageName'));
    }
}
