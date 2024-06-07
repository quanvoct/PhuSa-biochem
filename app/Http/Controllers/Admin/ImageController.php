<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageController extends Controller
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
        if (isset($request->key)) {
            switch ($request->key) {
                default:
                    $image = Image::find($request->key);
                    if ($image) {
                        return response()->json($image);
                    } else {
                        abort(404);
                    }
                    break;
            }
        } else {
            if ($request->ajax()) {
                $images = Image::select('images.*')->with('author')->orderBy('id', 'DESC')->get();
                return DataTables::of($images->toArray())->make(true);
            } else {
                $pageName = __('Images');
                return view('admin.images', compact('pageName'));
            }
        }
    }

    public function upload(Request $request)
    {
        try {
            $images = $request->file('images');
            $uploadedImages = [];

            foreach ($images as $index => $image) {
                $imageName = $image->getClientOriginalName();
                $tmp = explode('.', $imageName);
                $path = 'public/' . Str::slug($tmp[0]) . '.' . $tmp[count($tmp) - 1];
                $imageName = Str::slug($tmp[0]) . ((Storage::exists($path)) ? Carbon::now()->format('-YmdHis.') : '.') . $tmp[count($tmp) - 1];
                $uploadedImages[] = $image->storeAs('public/', $imageName);

                $image = Image::create([
                    'name' => $imageName,
                    'author_id' => Auth::user()->id
                ]);
                LogController::create('tạo', 'image',  $image->id);
            }
            return response()->json(['images' => $uploadedImages]);
        } catch (\Exception $exception) {
            return back()->withError($exception)->withInput();
        }
    }

    public function update(Request $request)
    {
        $rules = [
            'name' => 'required|regex:/^[a-zA-Z0-9\-]+$/',
        ];
        $request->validate($rules);
        try {
            $image = Image::find($request->id);
            $ext = explode('.', $image->name);
            $newName = $request->name . '.' . $ext[count($ext) - 1];
            if ($image) {
                if ($newName == $image->name) {
                    $imageName = $image->name;
                } else {
                    $checkPath = 'public/' . $newName;
                    if (Storage::exists($checkPath)) {
                        $imageName = $request->name . Carbon::now()->format('YmdHis') . '.' . $ext[count($ext) - 1];
                    } else {
                        $imageName = $newName;
                    }
                    $currentPath = 'public/' . $image->name;
                    $newPath = 'public/' . $imageName;
                    // Đổi tên tệp trong thư mục storage
                    Storage::move($currentPath, $newPath);
                }
                $image->name = $imageName;
                $image->alt = $request->alt;
                $image->caption = $request->caption;
                $image->save();
                LogController::create('xóa', 'image',  $image->id, $request->ip());
            } else {
                $image->delete();
                $response = array(
                    'status' => 'error',
                    'msg' => __('The file no longer exists! File data will be deleted from the system.'),
                );
            }
            $response = array(
                'status' => 'success',
                'msg' => __('Successfully updated :name :title', ['name' => $image->name, 'title' => __('image')]),
            );
            return response()->json($response, 200);
        } catch (\Exception $exception) {
            return back()->withError($exception)->withInput();
        }
    }

    public function delete(Request $request)
    {
        if ($request->ajax() && $request->choices) {
            $names = [];
            foreach ($request->choices as $id) {
                if ($this->delete_exec($id, $request->ip())) {
                    array_push($names, $id);
                } else {
                    $response = array(
                        'status' => 'error',
                        'msg' => __('Cannot delete :id', ['id' => $id]),
                    );
                    return response()->json($response, 200);
                    break;
                }
            }
            $response = array(
                'status' => 'success',
                'msg' => __('Successfully removed :name :title', ['name' => implode(', ', $names), 'title' => __('image')])
            );
        } else {
            $response = array(
                'status' => 'error',
                'msg' => __('The request could not be complete'),
            );
        }
        return response()->json($response, 200);
    }

    static function delete_exec($id, $ip)
    {
        $image = Image::find($id);
        if ($image) {
            $path = 'public/' . $image->name;
            LogController::create('xóa', 'image',  $image->id, $ip);
            $image->delete();
            if (Storage::exists($path)) {
                Storage::delete($path);
            }
            return true;
        } else {
            return false;
        }
    }
}
