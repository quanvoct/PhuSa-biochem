<?php

namespace App\Http\Controllers;

use App\Models\Catalogue;
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
        $settings = Controller::getSettings();
        $options = Controller::options();
        if ($request->page) {
            if ($request->category) {
                $category = Category::with('posts')->whereStatus(1)->whereCode($request->category)->first();
                if ($request->post) {
                    $post = Post::whereStatus(1)->where('category_id', $category->id)->whereCode($request->post)->first();
                    if ($post) {
                        $pageName = $post->title;
                        return view('post', compact('pageName','settings','options', 'post'));
                    } else {
                        abort(404);
                    }
                } else {
                    if ($category) {
                        $pageName = $category->name;
                        return view('category', compact('pageName','settings','options', 'category'));
                    } else {
                        abort(404);
                    }
                }
            } else {
                $page = Post::whereType('page')->whereStatus(1)->whereCode($request->page)->first();
                if ($page) {
                    $pageName = $page->title;
                    return view('page', compact('pageName','settings','options', 'page'));
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
                        ->orderBy('sort', 'DESC');
                }])
                ->orderBy('id', 'DESC')
                ->get();

            $categories = Category::whereNull('revision')
                ->where('status', 1)
                ->with(['posts' => function ($query) {
                    $query->where('status', 1)
                        ->orderBy('created_at', 'DESC');
                }])
                ->orderBy('id', 'DESC')
                ->get();

            // Lấy tất cả sản phẩm duy nhất từ danh sách catalogues
            $uniqueProducts = $catalogues->pluck('products')->flatten()->unique('id');
            $pageName = __('Home');
            return view('index', compact('pageName','settings','options', 'catalogues', 'categories', 'uniqueProducts'));
        }
    }

    public function contact()
    {
        $settings = Controller::getSettings();
        $options = Controller::options();
        $pageName = __('Contact');
        return view('contact', compact('settings','options', 'pageName'));
    }
    public function about(Request $request)
    {
        $settings = Controller::getSettings();
        $options = Controller::options();
        $categories = Category::whereNull('revision')
            ->where('status', 1)
            ->with(['posts' => function ($query) {
                $query->where('status', 1)
                    ->orderBy('created_at', 'DESC');
            }])
            ->orderBy('id', 'DESC')
            ->get();
        $pageName = 'About';
        return view('about', compact('pageName','settings','options', 'categories'));
    }
    public function changeLanguage(Request $request)
    {
        app()->setLocale($request->language, config('app.locale'));
        Session::put('language', $request->language);
        return redirect()->back();
    }
}
