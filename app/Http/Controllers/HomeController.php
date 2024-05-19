<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
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
    public function index(Request $request)
    {
        if($request->page) {
            if($request->category) {
                if($request->post) {
                    $post = Post::whereStatus(1)->whereCode($request->post)->first();
                    if($post) {
                        $pageName = $post->title;
                        return view('post', compact('pageName'));
                    } else {
                        abort(404);
                    }
                } else {
                    $category = Category::with('posts')->whereStatus(1)->whereCode($request->category)->first();
                    if($category) {
                        $pageName = $category->name;
                        return view('category', compact('pageName'));
                    } else {
                        abort(404);
                    }
                }
            } else {
                $page = Post::whereType('page')->whereStatus(1)->whereCode($request->page)->first();
                if($page) {
                    $pageName = $page->title;
                    return view('page', compact('pageName'));
                } else {
                    abort(404);
                }
            }
        } else {
            $pageName = __('Home');
            return view('index', compact('pageName'));
        }
    }

    public function contact() {
        $pageName = __('Contact');
        return view('contact', compact('pageName'));
    }

    public function changeLanguage(Request $request)
    {
        app()->setLocale($request->language, config('app.locale'));
        Session::put('language', $request->language);
        return redirect()->back();
    }
}
