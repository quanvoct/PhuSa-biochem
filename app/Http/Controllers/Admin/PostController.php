<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        // $this->middleware(['verified','auth']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $categories = Category::whereNull('revision')->where('status', 1)->get();
        if (isset($request->key)) {
            switch ($request->key) {
                case 'new':
                    $pageName = __('New post');
                    return view('admin.post', compact('pageName', 'categories'));
                    break;
                case 'list':
                    $ids = json_decode($request->ids);
                    $obj = Post::orderBy('sort', 'ASC')->when(count($ids), function ($query) use ($ids) {
                        $query->whereIn('id', $ids);
                    })->get();
                    return response()->json($obj, 200);
                    break;
                case 'find':
                    $result = Post::where('status', '>', 0)
                        ->where('title', 'LIKE', '%' . $request->q . '%')
                        ->when(isset($request->link_language_id), function ($query) use ($request) {
                            $query->whereHas('translation_posts', function ($query) use ($request) {
                                $query->where('language_id', $request->link_language_id);
                            })->whereDoesntHave('translation_posts', function ($query) use ($request) {
                                $query->where('language_id', $request->language_id);
                            });
                        })
                        ->orderByDesc('id')
                        ->distinct()
                        ->get()
                        ->map(function ($obj) {
                            return [
                                'id' => $obj->id,
                                'text' => $obj->title
                            ];
                        });
                    break;
                default:
                    $post = Post::find($request->key);
                    if ($post) {
                        if ($request->ajax()) {
                            $result = $post;
                        } else {
                            $pageName = $post->title;
                            return view('admin.post', compact('pageName', 'post', 'categories'));
                        }
                    } else {
                        return redirect()->route('admin.post', ['key' => 'new']);
                    }
                    break;
            }
            return response()->json($result, 200);
        } else {
            $posts = Post::whereNull('revision');
            if ($request->ajax()) {
                return DataTables::of($posts)
                    ->addColumn('checkboxes', function ($obj) {
                        if (!empty(Auth::user()->can(User::DELETE_POSTS))) {
                            return '<input class="form-check-input choice" type="checkbox" name="choices[]" value="' . $obj->id . '">';
                        }
                    })
                    ->editColumn('title', function ($obj) {
                        if (!empty(Auth::user()->can(User::UPDATE_POST))) {
                            return (!empty(Auth::user()->can(User::READ_POST))) ? '<a href="' . route('admin.post', ['key' => $obj->id]) . '" class="btn btn-link text-decoration-none text-start">' . $obj->title . '</a>' : $obj->title;
                        } else {
                            return $obj->title;
                        }
                    })
                    ->editColumn('author', function ($obj) {
                        if (!empty(Auth::user()->can(User::UPDATE_POST))) {
                            return '<a class="btn btn-link text-decoration-none text-start btn-update-user" data-id="' . $obj->author->id . '">' . $obj->author->name . '</a>';
                        } else {
                            return $obj->author->name;
                        }
                    })
                    ->editColumn('image', function ($obj) {
                        return '<img src="' . $obj->imageUrl . '" class="thumb cursor-pointer object-fit-cover" alt="Ảnh ' . $obj->name . '" width="60px" height="60px">';
                    })
                    ->editColumn('category', function ($obj) {
                        if (!empty(Auth::user()->can(User::UPDATE_POST))) {
                            return '<a class="btn btn-link text-decoration-none text-start btn-update-category" data-id="' . $obj->category->id . '">' . $obj->category->name . '</a>';
                        } else {
                            return __($obj->category->name);
                        }
                    })
                    ->addColumn('language', function ($obj) {
                        return $obj->language->name;
                    })
                    ->editColumn('status', function ($obj) {
                        return $obj->statusStr;
                    })
                    ->addColumn('action', function ($obj) {
                        $str = '';
                        if (Auth::user()->can(User::DELETE_POST)) {
                            $str .= '<div class="d-flex justify-content-center">
                            <form method="post" action="' . route('admin.post.remove') . '" class="save-form">
                                    <input type="hidden" name="choices[]" value="' . $obj->id . '"/>
                                    <button class="btn btn-link text-decoration-none btn-remove" data-bs-toggle="tooltip" data-bs-placement="top"
                                    data-bs-title="Xóa">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>';
                        }
                        return $str;
                    })
                    ->rawColumns(['checkboxes', 'title', 'author', 'category', 'image', 'status', 'action'])
                    ->make(true);
            } else {
                $pageName = __('Posts');
                return view('admin.posts', compact('pageName'));
            }
        }
    }

    public function save(Request $request)
    {
        $rules = [
            'title' => ['required', 'string', 'max:191'],
            'excerpt' => ['nullable', 'string', 'max:191'],
            'status' => ['required', 'numeric'],
            'image' => ['nullable', 'string'],
            'category_id' => ['required', 'numeric'],
            'description' => ['nullable'],
        ];
        //strip_tags($request->input('content'))  //Loại bỏ các thẻ html
        $request->validate($rules);
        if (Auth::user()->can(User::UPDATE_POST, User::CREATE_POST)) {
            $post = $this->sync([
                'code' => Str::slug($request->title),
                'title' => $request->title,
                'author_id' => Auth::user()->id,
                'category_id' => $request->category_id,
                'excerpt' => $request->excerpt,
                'content' => $request->input('content'),
                'type' => 'post',
                'image' => $request->image,
                'status' => $request->status,
            ], $request->id);
            if ($post && $request->has('language_id')) {
                if ($request->has('translate_id')) {
                    $translate_id = $request->translate_id;
                    array_unshift($translate_id, $post->id);
                    $post->linkLanguages($request->language_id, $translate_id);
                } else {
                    $post->syncLanguages($request->language_id);
                }
            }
            $action = ($request->id) ? 'updated' : 'created';
            $response = array(
                'status' => 'success',
                'msg' => __('Successfully ' . $action . ' :name :title', ['name' => $post->title, 'title' => __('post')])
            );
        } else {
            $response = array(
                'status' => 'danger',
                'msg' => __('The operation is not authorized')
            );
        }
        return redirect()->route('admin.post', ['key' => $post->id])->with('response', $response);
    }

    public function remove(Request $request)
    {
        $success = [];
        if (Auth::user()->can(User::DELETE_POST)) {
            foreach ($request->choices as $key => $id) {
                $obj = Post::find($id);
                    $obj->revision();
                    $obj->delete();
                    LogController::create("xóa", 'post', $obj->id, $request->ip());
                    array_push($success, $obj->title);
            }
            if (count($success)) {
                $status = 'success';
                $msg = __('Successfully removed :name :title', ['name' => implode(', ', $success), 'title' => __('post')]);
            }
            $response = array(
                'status' => $status,
                'msg' => $msg
            );
        } else {
            $response = array(
                'status' => 'danger',
                'msg' => __('The operation is not authorized')
            );
        }
        return response()->json($response, 200);
    }

    public static function sync($array, $id = null)
    {
        $obj = Post::updateOrCreate(['id' => $id], $array);
        LogController::create($id ? 'sửa' : 'tạo', 'post', $obj->id);
        return $obj;
    }
}
