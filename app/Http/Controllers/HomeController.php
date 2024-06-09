<?php

namespace App\Http\Controllers;

use App\Models\Catalogue;
use App\Models\Category;
use App\Models\Language;
use App\Models\Post;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
                if ($category) {
                    if ($request->post) {
                        $post = Post::whereStatus(1)->where('category_id', $category->id)->whereCode($request->post)->first();
                        if ($post) {
                            $pageName = $post->title;
                            return view('post', compact('pageName', 'post'));
                        } else {
                            abort(404);
                        }
                    } else {
                        $pageName = __($category->name);
                        return view('category', compact('pageName', 'category'));
                    }
                } else {
                    abort(404);
                }
            } else {
                if ($request->page == 'posts') {
                    $categories = Category::whereNull('revision')
                        ->where('status', 1)
                        ->with(['posts' => function ($query) {
                            $query->where('status', 1)
                                ->orderBy('created_at', 'DESC');
                        }])
                        ->orderBy('sort', 'ASC')
                        ->get();
                    $pageName = __('Posts');
                    return view('posts', compact('pageName', 'categories'));
                } else {
                    abort(404);
                }
            }
        } else {
            $catalogues = Catalogue::whereNull('revision')
                ->where('status', 1)
                ->with(['products' => function ($query) {
                    $query->whereNull('revision')
                        ->where('status', '>', 0)
                        ->orderBy('sort', 'ASC');
                }])
                ->orderBy('sort', 'ASC')
                ->get();
            $categories = Category::whereNull('revision')
                ->where('status', 1)
                ->with(['posts' => function ($query) {
                    $query->where('status', 1)
                        ->orderBy('created_at', 'DESC');
                }])
                ->orderBy('sort', 'ASC')
                ->get();

            // Lấy tất cả sản phẩm duy nhất từ danh sách catalogues
            $uniqueProducts = $catalogues->pluck('products')->flatten()->unique('id');
            $pageName = __('Home');
            return view('index', compact('pageName', 'catalogues', 'categories', 'uniqueProducts'));
        }
    }

    public function contact()
    {
        $pageName = __('Contact');
        return view('contact', compact('pageName'));
    }

    public function about(Request $request)
    {
        $categories = Category::whereNull('revision')
            ->where('status', 1)
            ->with(['posts' => function ($query) {
                $query->where('status', 1)
                    ->orderBy('created_at', 'DESC');
            }])
            ->orderBy('id', 'DESC')
            ->get();
        $pageName = __('About');
        return view('about', compact('pageName', 'categories'));
    }
    public function change(Request $request)
    {
        app()->setLocale($request->language, config('app.locale'));
        Session::put('language', $request->language);
        $language = Language::whereCode($request->language)->first();
        Session::put('settings', Setting::where('language_id', $language->id)->pluck('value', 'key'));
        return redirect()->back();
    }
}
