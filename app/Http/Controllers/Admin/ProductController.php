<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Catalogue;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProductController extends Controller
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
            $catalogues = Catalogue::whereNull('revision')->whereNull('parent_id')->where('status', 1)->with('children')->get();
            $catalogues = Controller::getCatalogueChildren($catalogues);
            switch ($request->key) {
                case 'new':
                    $pageName = __('New product');
                    return view('admin.product', compact('pageName', 'catalogues'));
                    break;
                case 'list':
                    $ids = json_decode($request->ids);
                    $obj = Product::whereNull('revision')->orderBy('sort', 'ASC')->when(count($ids), function ($query) use ($ids) {
                        $query->whereIn('id', $ids);
                    })->get();
                    return response()->json($obj, 200);
                    break;
                case 'find':
                    $result = Product::whereNull('revision')->where('status', '>', 0)
                        ->where(function ($query) use ($request) {
                            $query->where('name', 'LIKE', '%' . $request->q . '%')
                                ->orWhere('sku', 'LIKE', '%' . $request->q . '%')
                                ->orWhereHas('variables', function ($query) use ($request) {
                                    $query->where('name', 'LIKE', '%' . $request->q . '%');
                                });
                        })
                        ->when(isset($request->link_language_id), function ($query) use ($request) {
                            $query->whereHas('translation_products', function ($query) use ($request) {
                                $query->where('language_id', $request->link_language_id);
                            })->whereDoesntHave('translation_products', function ($query) use ($request) {
                                $query->where('language_id', $request->language_id);
                            });
                        })
                        ->when(!isset($request->link_language_id), function ($query) use ($request) {
                            $query->whereHas('translation_products', function ($query) use ($request) {
                                $query->where('language_id', $request->language_id);
                            });
                        })
                        ->orderByDesc('id')
                        ->distinct()
                        ->get()
                        ->map(function ($obj) {
                            return [
                                'id' => $obj->id,
                                'text' => $obj->sku . ' - ' . $obj->name
                            ];
                        });
                    break;
                default:
                    $product = Product::with('catalogues', 'variables')->find($request->key);
                    if ($product) {
                        if ($request->ajax()) {
                            $result = $product;
                        } else {
                            $pageName = $product->name;
                            return view('admin.product', compact('pageName', 'catalogues', 'product'));
                        }
                    } else {
                        return redirect()->route('admin.product', ['key' => 'new']);
                    }
                    break;
            }
            return response()->json($result, 200);
        } else {
            if ($request->ajax()) {
                $objs = Product::whereNull('revision');
                return DataTables::of($objs)
                    ->addColumn('checkboxes', function ($obj) {
                        if (Auth::user()->can(User::DELETE_PRODUCTS)) {
                            return '<input class="form-check-input choice" type="checkbox" name="choices[]" value="' . $obj->id . '">';
                        }
                    })
                    ->editColumn('sku', function ($obj) {
                        if (Auth::user()->can(User::UPDATE_PRODUCT)) {
                            return '<a href="' . route('admin.product', ['key' => $obj->id]) . '" class="btn btn-update-product text-info fw-bold text-start" data-id="' . $obj->id . '">' . $obj->sku . '</a>';
                        }
                        return '<span class="fw-bold">' . $obj->sku . '</span>';
                    })
                    ->addColumn('image', function ($obj) {
                        return '<img src="' . $obj->imageUrl . '" class="thumb cursor-pointer object-fit-cover" alt="Ảnh ' . $obj->name . '" width="60px" height="60px">';
                    })
                    ->addColumn('catalogues', function ($obj) {
                        return $obj->cataloguesName();
                    })
                    ->editColumn('status', function ($obj) {
                        return '<span class="badge bg-' . ($obj->status ? 'success' : 'danger') . '">' . $obj->statusStr . '</span>';
                    })
                    ->addColumn('action', function ($obj) {
                        if (!empty(Auth::user()->can(User::DELETE_PRODUCT))) {
                            return '
                                <form action="' . route('admin.product.remove') . '" method="post" class="save-form">
                                    <input type="hidden" name="_token" value="' . csrf_token() . '"/>
                                    <input type="hidden" name="choices[]" value="' . $obj->id . '" data-id="'  . $obj->id . '"/>
                                    <button class="btn btn-link text-decoration-none btn-remove">
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                </form>';
                        }
                        return '';
                    })
                    ->rawColumns(['checkboxes', 'sku', 'image', 'catalogues', 'status', 'action'])
                    ->make(true);
            } else {
                $pageName = __('Products');
                return view('admin.products', compact('pageName'));
            }
        }
    }

    public function sort(Request $request)
    {
        $ids = $request->input('sort');
        if (count($ids) == Product::all()->count()) {
            foreach ($ids as $index => $id) {
                Product::where('id', $id)->update(['sort' => $index + 1]);
            }
        } else {
            $sorts = Product::whereIn('id', $ids)->orderBy('sort', 'ASC')->pluck('sort');
            foreach ($sorts as $index => $sort) {
                Product::find($ids[$index])->update(['sort' => $sort]);
            }
        }
        return response()->json(['msg' => __('The order has been updated successfully')]);
    }


    public function save(Request $request)
    {
        $rules = [
            'sku' => ['required', 'string', 'max:191', Rule::unique('products')->whereNull('revision')->ignore($request->id ?? 0)],
            'name' => ['required', 'string', 'max:191'],
            'unit' => ['required', 'string', 'max:191'],
            'specs_key' => ['array'],
            'specs_value' => ['array'],
            'specs_key.*' => ['required', 'min: 2', 'max: 191'],
            'specs_value.*' => ['required', 'min: 2', 'max: 191'],
            'status' => ['nullable', 'numeric'],
            'catalogues' => ['required', 'array'],
        ];
        $request->validate($rules);

        if (!empty(Auth::user()->can(User::CREATE_PRODUCT, User::UPDATE_PRODUCT))) {
            if ($request->has('specs_key') && $request->has('specs_value')) {
                $specs = collect($request->specs_key)->zip($request->specs_value)->map(function ($item) {
                    return [$item[0] => $item[1]];
                })->collapse()->toJson();
            } else {
                $specs = null;
            }
            $obj = $this->sync([
                'sku' => $request->sku,
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'author_id' => Auth::user()->id,
                'excerpt' => $request->excerpt,
                'description' => $request->description,
                'specs' => $specs,
                'keyword' => $request->keyword,
                'unit' => $request->unit,
                'sort' => Product::max('sort') + 1,
                'gallery' => $request->gallery,
                'allow_review' => $request->has('allow_review'),
                'status' => $request->has('status') ? $request->status : 0,
            ], $request->id);
            if ($obj) {
                $obj->syncCatalogues($request->catalogues);
                if ($request->has('language_id')) {
                    if ($request->has('translate_id')) {
                        $translate_id = $request->translate_id;
                        array_unshift($translate_id, $obj->id);
                        $obj->linkLanguages($request->language_id, $translate_id);
                    } else {
                        $obj->syncLanguages($request->language_id);
                    }
                }
            }
            $action = ($request->id) ? 'updated' : 'created';
            $response = array(
                'status' => 'success',
                'msg' => __('Successfully ' . $action . ' :name :title', ['name' => $obj->name, 'title' => __('product')])
            );
        } else {
            $response = array(
                'status' => 'danger',
                'msg' => __('The operation is not authorized')
            );
        }
        return redirect()->route('admin.product', ['key' => $obj->id])->with('response', $response);
    }

    public function create(Request $request)
    {
        $rules = [
            'sku' => ['required', 'string', 'max:191', Rule::unique('products')->whereNull('revision')->ignore($request->id ?? 0)],
            'name' => ['required', 'string', 'max:191'],
            'unit' => ['required', 'string', 'max:191'],
            'specs_key' => ['array'],
            'specs_value' => ['array'],
            'specs_key.*' => ['required', 'min: 2', 'max: 191'],
            'specs_value.*' => ['required', 'min: 2', 'max: 191'],
            'status' => ['nullable', 'numeric'],
            'catalogues' => ['required', 'array'],
        ];
        $request->validate($rules);

        if (!empty(Auth::user()->can(User::CREATE_PRODUCT))) {
            $obj = $this->sync([
                'sku' => $request->sku,
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'excerpt' => $request->excerpt,
                'description' => $request->description,
                'specs' => $request->specs,
                'keyword' => $request->keyword,
                'unit' => $request->unit,
                'gallery' => $request->gallery,
                'allow_review' => $request->has('allow_review'),
                'status' => $request->status,
            ]);
            if ($obj) {
                $obj->syncCatalogues($request->catalogues);
                foreach ($request->variable_names as $index => $variable_name) {
                    VariableController::sync([
                        'product_id' => $obj->id,
                        'sub_sku' => $request->sub_skus[$index],
                        'name' => $request->variable_names[$index],
                        'price' => $request->prices[$index],
                        'status' => 1,
                    ]);
                }
            }
            $response = array(
                'status' => 'success',
                'msg' => __('Successfully created :name :title', ['name' => $obj->name, 'title' => __('product')])
            );
        } else {
            $response = array(
                'status' => 'danger',
                'msg' => __('The operation is not authorized')
            );
        }
        return response()->json($response, 200);
    }

    public function update(Request $request)
    {
        $rules = [
            'sku' => ['required', 'string', 'max:191', Rule::unique('products')->whereNull('revision')->ignore($request->id ?? 0)],
            'name' => ['required', 'string', 'max:191'],
            'unit' => ['required', 'string', 'max:191'],
            'specs_key' => ['array'],
            'specs_value' => ['array'],
            'specs_key.*' => ['required', 'min: 2', 'max: 191'],
            'specs_value.*' => ['required', 'min: 2', 'max: 191'],
            'status' => ['nullable', 'numeric'],
            'catalogues' => ['required', 'array'],
        ];
        $request->validate($rules);

        if (!empty(Auth::user()->can(User::UPDATE_PRODUCT))) {
            $obj = $this->sync([
                'barcode' => $request->barcode,
                'sku' => $request->sku,
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'excerpt' => $request->excerpt,
                'description' => $request->description,
                'specs' => $request->specs,
                'keyword' => $request->keyword,
                'unit' => $request->unit,
                'gallery' => $request->gallery,
                'allow_review' => $request->has('allow_review'),
                'status' => $request->has('status') ? $request->status : 0,
            ], $request->id);
            if ($obj) {
                $obj->syncCatalogues($request->catalogues);
                foreach ($request->variable_names as $index => $variable_name) {
                    VariableController::sync([
                        'product_id' => $obj->id,
                        'sub_sku' => $request->sub_skus[$index],
                        'name' => $request->variable_names[$index],
                        'price' => $request->prices[$index],
                        'status' => 1,
                    ], $request->variable_ids[$index]);
                }
            }
            $response = array(
                'status' => 'success',
                'msg' => __('Successfully updated :name :title', ['name' => $obj->name, 'title' => __('product')])
            );
        } else {
            $response = array(
                'status' => 'danger',
                'msg' => __('The operation is not authorized')
            );
        }
        return response()->json($response, 200);
    }

    public function remove(Request $request)
    {
        $success = [];
        if (Auth::user()->can(User::DELETE_PRODUCT)) {
            foreach ($request->choices as $key => $id) {
                $obj = Product::find($id);
                $obj->revision();
                DB::table('catalogue_product')->where('product_id', $obj->id)->delete();
                $obj->delete();
                LogController::create("xóa", 'product', $obj->id);
                array_push($success, $obj->name);
            }
            $response = array(
                'status' => 'success',
                'msg' => __('Successfully removed :name :title', ['name' => $obj->name, 'title' => __('product')])
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
        if ($id) {
            Product::find($id)->revision();
        }
        $obj = Product::updateOrCreate(['id' => $id], $array);
        LogController::create($id ? 'sửa' : 'tạo', 'product', $obj->id);
        return $obj;
    }
}
