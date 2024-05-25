<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Catalogue;
use App\Models\Product;
use App\Models\User;
use App\Models\Variable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

use function PHPSTORM_META\type;

class ProductController extends Controller
{
    const NAME = 'sản phẩm',
        MESSAGES = [
            'barcode.required' => Controller::VALIDATE['required'],
            'barcode.string' => Controller::VALIDATE['invalid'],
            'barcode.max' => Controller::VALIDATE['max191'],
            'barcode.unique' => 'Mã vạch không khả dụng!',
            'sku.required' => Controller::VALIDATE['required'],
            'sku.string' => Controller::VALIDATE['invalid'],
            'sku.max' => Controller::VALIDATE['max191'],
            'sku.unique' => 'Mã vạch không khả dụng!',
            'name.required' => Controller::VALIDATE['required'],
            'name.string' => Controller::VALIDATE['invalid'],
            'name.max' => Controller::VALIDATE['max191'],
            'unit.required' => Controller::VALIDATE['required'],
            'unit.string' => Controller::VALIDATE['invalid'],
            'unit.max' => Controller::VALIDATE['max191'],
            'status.numeric' => Controller::VALIDATE['invalid'],
            'catalogues.required' => 'Danh mục không thể bỏ trống',
            'catalogues.array' => 'Danh mục: ' . Controller::VALIDATE['invalid'],

            'variable_names.required' => 'Tên biến thể: ' . Controller::VALIDATE['required'],
            'variable_names.array' => 'Tên biến thể: ' . Controller::VALIDATE['invalid'],
            'sub_skus.required' => 'Mã phụ: ' . Controller::VALIDATE['required'],
            'sub_skus.array' => 'Mã phụ: ' . Controller::VALIDATE['invalid'],
            'prices.required' => 'Giá biến thể: ' . Controller::VALIDATE['required'],
            'prices.array' => 'Giá biến thể: ' . Controller::VALIDATE['invalid'],

            'variable_names.*.required' => 'Tên biến thể: ' . Controller::VALIDATE['required'],
            'variable_names.*.min' => 'Tên biến thể: ' . Controller::VALIDATE['min2'],
            'variable_names.*.max' => 'Tên biến thể: ' . Controller::VALIDATE['max191'],
            'sub_skus.*.required' => 'Mã biến thể: ' . Controller::VALIDATE['required'],
            'sub_skus.*.min' => 'Mã biến thể: ' . Controller::VALIDATE['min2'],
            'sub_skus.*.max' => 'Mã biến thể: ' . Controller::VALIDATE['max191'],
            'prices.*.required' => 'Giá biến thể: ' . Controller::VALIDATE['required'],
            'prices.*.numeric' => 'Giá biến thể: ' . Controller::VALIDATE['invalid'],
        ];

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
            $catalogues = Catalogue::whereNull('parent_id')->where('status', 1)->with('children')->get();
            $catalogues = Controller::getCatalogueChildren($catalogues);
            switch ($request->key) {
                case 'new':
                    $pageName = 'Thêm ' . self::NAME;
                    return view('admin.product', compact('pageName', 'catalogues'));
                    break;
                case 'list':
                    $ids = json_decode($request->ids);
                    $obj = Product::orderBy('sort', 'ASC')->when(count($ids), function ($query) use ($ids) {
                        $query->whereIn('id', $ids);
                    })->get();
                    return response()->json($obj, 200);
                    break;
                case 'find':
                    $result = Product::where('status', '>', 0)
                        ->where('name', 'LIKE', '%' . $request->q . '%')
                        ->orWhere('sku', 'LIKE', '%' . $request->q . '%')
                        ->orWhereHas('variables', function ($query) use ($request) {
                            $query->where('name', 'LIKE', '%' . $request->q . '%');
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
                            return response()->json($product, 200);
                        } else {
                            if ($product) {
                                $pageName = 'Chi tiết ' . self::NAME;
                                return view('admin.product', compact('pageName', 'catalogues', 'product'));
                            }
                        }
                    } else {
                        return redirect()->route('admin.product', ['key' => 'new']);
                    }
                    break;
            }
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
                $pageName = 'Quản lý ' . self::NAME;
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
        return response()->json(['msg' => 'Thứ tự đã được cập nhật thành công']);
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
        $messages = [
            'sku.required' => 'Mã sản phẩm: ' . Controller::VALIDATE['required'],
            'sku.string' => 'Mã sản phẩm: ' . Controller::VALIDATE['invalid'],
            'sku.max' => 'Mã sản phẩm: ' . Controller::VALIDATE['max191'],
            'sku.unique' => 'Mã sản phẩm:' . Controller::VALIDATE['unique'],
            'specs_key.array' => 'Thông số kỹ thuật: ' . Controller::VALIDATE['invalid'],
            'specs_value.array' => 'Thông số kỹ thuật: ' . Controller::VALIDATE['invalid'],
            'specs_key.*.required' => 'Thông số kỹ thuật: ' . Controller::VALIDATE['required'],
            'specs_key.*.min' => 'Thông số kỹ thuật: ' . Controller::VALIDATE['min2'],
            'specs_key.*.max' => 'Thông số kỹ thuật: ' . Controller::VALIDATE['max191'],
            'specs_value.*.required' => 'Thông số kỹ thuật: ' . Controller::VALIDATE['required'],
            'specs_value.*.min' => 'Thông số kỹ thuật: ' . Controller::VALIDATE['min2'],
            'specs_value.*.max' => 'Thông số kỹ thuật: ' . Controller::VALIDATE['max191'],
            'name.required' => 'Tên sản phẩm: ' . Controller::VALIDATE['required'],
            'name.string' => 'Tên sản phẩm: ' . Controller::VALIDATE['invalid'],
            'name.max' => 'Tên sản phẩm: ' . Controller::VALIDATE['max191'],
            'unit.required' => 'Đơn vị tính: ' .  Controller::VALIDATE['required'],
            'unit.string' => 'Đơn vị tính: ' .  Controller::VALIDATE['invalid'],
            'unit.max' => 'Đơn vị tính: ' .  Controller::VALIDATE['max191'],
            'status.numeric' => 'Trạng thái: ' . Controller::VALIDATE['invalid'],
            'catalogues.required' => 'Danh mục: ' . Controller::VALIDATE['required'],
            'catalogues.array' => 'Danh mục: ' . Controller::VALIDATE['invalid'],
        ];
        $request->validate($rules, $messages);

        if (!empty(Auth::user()->hasAnyPermission(User::CREATE_PRODUCT, User::UPDATE_PRODUCT))) {
            if ($request->id) {
                Product::find($request->id)->revision();
            }
            if($request->has('specs_key') && $request->has('specs_value')) {
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
                'status' => $request->status,
            ], $request->id);
            if ($obj) {
                $obj->syncCatalogues($request->catalogues);
            }
            $action = ($request->id) ? 'Đã sửa' : 'Đã thêm';
            $response = array(
                'status' => 'success',
                'msg' => $action . ' ' . self::NAME . ' ' . $obj->name
            );
        } else {
            $response = array(
                'status' => 'danger',
                'msg' => 'Thao tác chưa được cấp quyền!'
            );
        }
        return redirect()->route('admin.product', ['key' => $obj->id])->with('response', $response);
    }

    public function create(Request $request)
    {
        $rules = [
            'sku' => ['required', 'string', 'max:191', 'unique:products'],
            'name' => ['required', 'string', 'max:191'],
            'unit' => ['required', 'string', 'max:191'],
            'status' => ['nullable', 'numeric'],
            'catalogues' => ['required', 'array'],

            'variable_names' => ['required', 'array'],
            'sub_skus' => ['required', 'array'],
            'prices' => ['required', 'array'],

            'variable_names.*' => ['required', 'min:2', 'max:191'],
            'sub_skus.*' => ['required', 'min:2', 'max:191'],
            'prices.*' => ['required', 'numeric'],
        ];

        $request->validate($rules, self::MESSAGES);

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
                'msg' => 'Đã tạo ' . self::NAME . ' ' . $obj->name
            );
        } else {
            $response = array(
                'status' => 'danger',
                'msg' => 'Thao tác chưa được cấp quyền!'
            );
        }
        return response()->json($response, 200);
    }

    public function update(Request $request)
    {
        $rules = [
            'sku' => ['required', 'string', 'max:191', Rule::unique('products')->ignore($request->id)],
            'name' => ['required', 'string', 'max:191'],
            'unit' => ['required', 'string', 'max:191'],
            'status' => ['nullable', 'numeric'],
            'catalogues' => ['required', 'array'],

            'variable_names' => ['required', 'array'],
            'sub_skus' => ['required', 'array'],
            'prices' => ['required', 'array'],

            'variable_names.*' => ['required', 'min:2', 'max:191'],
            'sub_skus.*' => ['required', 'min:2', 'max:191'],
            'prices.*' => ['required', 'numeric'],
        ];

        $request->validate($rules, self::MESSAGES);

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
                'status' => $request->status,
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
                'msg' => 'Đã cập nhật ' . self::NAME . ' ' . $obj->name
            );
        } else {
            $response = array(
                'status' => 'danger',
                'msg' => 'Thao tác chưa được cấp quyền!'
            );
        }
        return response()->json($response, 200);
    }

    public function remove(Request $request)
    {
        $success = [];
        $fail = [];
        if (Auth::user()->can(User::DELETE_PRODUCT)) {
            foreach ($request->choices as $key => $id) {
                $obj = Product::find($id);
                if ($obj->canRemove()) {
                    DB::table('catalogue_product')->where('product_id', $obj->id)->delete();
                    $obj->delete();
                    LogController::create("xóa", self::NAME, $obj->id);
                    array_push($success, $obj->name);
                } else {
                    array_push($fail, $obj->name);
                }
            }
            $msg = '';
            if (count($success)) {
                $msg .= 'Đã xóa ' . self::NAME . ' ' . implode(', ', $success) . '. ';
            }
            if (count($fail)) {
                $msg .= implode(', ', $fail) . ' đang sử dụng, không thể xóa!';
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

    public static function sync($array, $id = null)
    {
        $obj = Product::updateOrCreate(['id' => $id], $array);
        LogController::create($id ? 'sửa' : 'tạo', self::NAME, $obj->id);
        return $obj;
    }
}
