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
        if ($request->page) {
            if ($request->category) {
                $category = Category::with('posts')->whereStatus(1)->whereCode($request->category)->first();
                if ($request->post) {
                    $post = Post::whereStatus(1)->where('category_id', $category->id)->whereCode($request->post)->first();
                    if ($post) {
                        $pageName = $post->title;
                        return view('post', compact('pageName', 'post'));
                    } else {
                        abort(404);
                    }
                } else {
                    if ($category) {
                        $pageName = $category->name;
                        return view('category', compact('pageName', 'category'));
                    } else {
                        abort(404);
                    }
                }
            } else {
                $page = Post::whereType('page')->whereStatus(1)->whereCode($request->page)->first();
                if ($page) {
                    $pageName = $page->title;
                    return view('page', compact('pageName', 'page'));
                } else {
                    abort(404);
                }
            }
        } else {
            $categories = Category::whereNull('revision')->with(['posts' => function ($query) {
                $query->whereStatus(1)->orderBy('created_at', 'DESC');
            }])->orderBy('id', 'DESC')->get();
            $pageName = __('Home');
            return view('index', compact('pageName', 'categories'));
        }
    }

    public function contact()
    {
        $settings = Controller::getSettings();
        $pageName = __('Contact');
        return view('contact', compact('settings', 'pageName'));
    }

    public function changeLanguage(Request $request)
    {
        app()->setLocale($request->language, config('app.locale'));
        Session::put('language', $request->language);
        return redirect()->back();
    }
}
