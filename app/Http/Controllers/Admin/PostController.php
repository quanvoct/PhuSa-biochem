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
    const NAME = 'bài viết';
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
        $categories = Category::where('status', 1)->get();
        if (isset($request->key)) {
            switch ($request->key) {
                case 'new':
                    $pageName = 'Bài viết mới';
                    return view('admin.post', compact('pageName', 'categories'));
                    break;
                case 'list':
                    $ids = json_decode($request->ids);
                    $obj = Post::orderBy('sort', 'ASC')->when(count($ids), function ($query) use ($ids) {
                        $query->whereIn('id', $ids);
                    })->get();
                    return response()->json($obj, 200);
                    break;
                default:
                    $post = Post::find($request->key);
                    if ($post) {
                        if ($request->ajax()) {
                            return response()->json($post, 200);
                        } else {
                            $pageName = $post->title;
                            return view('admin.post', compact('pageName', 'post', 'categories'));
                        }
                    } else {
                        return redirect()->route('admin.post', ['key' => 'new'], );
                    }
                    break;
            }
        } else {
            $posts = Post::get();
            if ($request->ajax()) {
                return DataTables::of($posts)
                    ->addColumn('checkboxes', function ($obj) {
                        if (!empty (Auth::user()->can(User::DELETE_POSTS))) {
                            return '<input class="form-check-input choice" type="checkbox" name="choices[]" value="' . $obj->id . '">';
                        }
                    })
                    ->editColumn('title', function ($obj) {
                        if (!empty (Auth::user()->can(User::UPDATE_POST))) {
                            return (!empty(Auth::user()->can(User::READ_POST))) ? '<a href="' . route('admin.post', ['key' => $obj->id]) . '" class="btn btn-link text-decoration-none text-start">' . $obj->title . '</a>' : $obj->title;
                        } else {
                            return $obj->title;
                        }
                    })
                    ->editColumn('author', function ($obj) {
                        if (!empty (Auth::user()->can(User::UPDATE_POST))) {
                            return '<a class="btn btn-link text-decoration-none text-start btn-update-user" data-id="' . $obj->author->id . '">' . $obj->author->name . '</a>';
                        } else {
                            return $obj->author->name;
                        }
                    })
                    ->editColumn('image', function ($obj) {
                        return '<img src="' . $obj->imageUrl . '" class="thumb cursor-pointer object-fit-cover" alt="Ảnh ' . $obj->name . '" width="60px" height="60px">';
                    })
                    ->editColumn('category', function ($obj) {
                        if (!empty (Auth::user()->can(User::UPDATE_POST))) {
                            return '<a class="btn btn-link text-decoration-none text-start btn-update-category" data-id="' . $obj->category->id . '">' . $obj->category->name . '</a>';
                        } else {
                            return $obj->category->name;
                        }
                    })
                    ->editColumn('type', function ($obj) {
                        return $obj->typeStr;
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
                $pageName = 'Quản lý ' . self::NAME;
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
        $messages = [
            'title.required' => 'Tên dịch vụ: ' . Controller::VALIDATE['required'],
            'title.string' => 'Tên dịch vụ: ' . Controller::VALIDATE['invalid'],
            'title.max' => 'Tên dịch vụ: ' . Controller::VALIDATE['max191'],
            'excerpt.string' => 'Mô tả ngắn: ' . Controller::VALIDATE['invalid'],
            'excerpt.max' => 'Mô tả ngắn: ' . Controller::VALIDATE['max191'],
            'status.numeric' => 'Trạng thái: ' . Controller::VALIDATE['required'],
            'status.required' => 'Trạng thái: ' . Controller::VALIDATE['invalid'],
            'category_id.numeric' => 'Chuyên mục: ' . Controller::VALIDATE['invalid'],
            'category_id.required' => 'Chuyên mục: ' . Controller::VALIDATE['required'],
            'image.string' => 'Ảnh: ' . Controller::VALIDATE['invalid'],
        ];
        $request->validate($rules, $messages);
        if (!empty(Auth::user()->can(User::UPDATE_POST)) || !empty(Auth::user()->can(User::CREATE_POST))) {
            $post = $this->sync([
                'code' => Str::slug($request->title),
                'title' => $request->title,
                'author_id' => Auth::user()->id,
                'category_id' => $request->category_id,
                'excerpt' => $request->excerpt,
                'content' => strip_tags($request->input('content')),  //Loại bỏ các thẻ html
                'type' => 'post',
                'image' => $request->image,
                'status' => $request->status,
            ], $request->ip(), $request->id);
            if (isset($request->image)) {
                $post->image = $request->image;
                $post->save();
            }
            $action = ($request->id) ? 'Đã sửa' : 'Đã thêm';
            $response = array(
                'status' => 'success',
                'msg' => $action . ' ' . self::NAME . ' ' . $post->name
            );
        } else {
            $response = array(
                'status' => 'danger',
                'msg' => 'Thao tác chưa được cấp quyền!'
            );
        }
        return redirect()->route('admin.post', ['key' => $post->id])->with('response', $response);
    }

    public function remove(Request $request)
    {
        $success = [];
        $fail = [];
        if (Auth::user()->can(User::DELETE_POST)) {
            foreach ($request->choices as $key => $id) {
                $obj = Post::find($id);
                if ($obj->canRemove()) {
                    $obj->revision();
                    $obj->delete();
                    LogController::create("xóa", self::NAME, $obj->id, $request->ip());
                    array_push($success, $obj->name);
                } else {
                    array_push($fail, $obj->name);
                }
            }
            if (count($success)) {
                $msg = 'Đã xóa ' . self::NAME . ' ' . implode(', ', $success);
            }
            if (count($fail) && count($success)) {
                $msg .= ' ngoại trừ ' . implode(', ', $fail) . '!';
            } else if (count($fail)) {
                $msg = 'Không thể xóa ' . self::NAME . ' ' . implode(', ', $fail) . '!';
            }
            $response = array(
                'status' => 'success',
                'msg' => $msg
            );
        } else {
            $response = array(
                'status' => 'danger',
                'msg' => 'Thao tác chưa được cấp quyền!'
            );
        }
        return response()->json($response, 200);
    }

    public static function sync($array, $ip = null, $id = null)
    {
        $obj = Post::updateOrCreate(['id' => $id], $array);
        LogController::create($id ? 'sửa' : 'tạo', self::NAME, $obj->id, $ip);
        return $obj;
    }
}
