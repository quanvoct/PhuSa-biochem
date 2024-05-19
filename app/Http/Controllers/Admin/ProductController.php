<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use App\Models\Variable;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    const RULES = [
        'sku' => ['nullable', 'min: 2', 'max:125'],
        'name' => ['required', 'min: 3', 'max:125'],
        'catalogue_id' => ['required'],
        'note' => ['max:255'],

        'variable_unit' => ['required', 'array'],
        'variable_unit.*' => ['nullable', 'max:125'],
        'variable_sub_sku' => ['array', 'min:1'],
        'variable_sub_sku.*' => ['nullable', 'max:125'],
        'variable_name' => ['required', 'array'],
        'variable_name.*' => ['required', 'max:125'],
        'variable_origin_id.*' => ['required', 'numeric'],
    ];
    const MESSAGES = [
        'sku.min' => 'Tối thiểu 2 kí tự.',
        'sku.max' => 'Tối đa 125 kí tự.',
        'name.required' => 'Thông tin này không thể trống.',
        'name.min' => 'Tối thiểu phải 3 kí tự.',
        'name.max' => 'Tối đa 125 kí tự.',
        'catalogue_id.required' => 'Phải có một danh mục',
        'note.max' => 'Tối đa 255 kí tự.',
        'variable_unit.required' => 'Phải có ít nhất một biến thể',
        'variable_unit.array' => 'Dữ liệu không hợp lệ',
        'variable_unit.*.max' => 'Tối đa 125 kí tự.',
        'variable_sub_sku.*.max' => 'Tối đa 125 kí tự',
        'variable_name.*.required' => 'Tên biến thể không được trống.',
        'variable_name.*.max' => 'Tối đa 125 kí tự',
        'variable_origin_id.*.required' => 'Thông tin này không thể trống',
        'variable_origin_id.*.numeric' => 'Dữ liệu không hợp lệ'
    ];
    /**
     * Create a new controller instance.
     *
     * @return void
     */
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
    public function index()
    {
        $pageName = 'Quản lý sản phẩm';
        $product = Product::all();
        $options = Controller::options();
        return view('product', compact('pageName', 'options'));
    }

    public function load(Request $request)
    {
        $products = Product::all();
        return DataTables::of($products)
            ->addColumn('checkbox', function ($obj) {
                if (!empty(Auth::user()->hasAnyPermission(User::DELETE_PRODUCTS))) {
                    return '<input class="form-check-input choice" type="checkbox" name="choices[]" value="' . $obj->id . '">';
                }
            })
            ->editColumn('name', function ($obj) {
                if (!empty(Auth::user()->hasAnyPermission(User::READ_PRODUCT))) {
                    return '<a class="btn btn-link text-decoration-none text-start btn-update-product" data-id="' . $obj->id . '">' . $obj->name . '</a>';
                } else {
                    return $obj->name;
                }
            })
            ->editColumn('status', function ($obj) {
                return $obj->statusName();
            })
            ->addColumn('action', function ($obj) {
                if (!empty(Auth::user()->hasAnyPermission(User::DELETE_PRODUCT))) {
                    return '
                        <form method="post" action="' . route('product.remove') . '" class="save-form">
                            <input type="hidden" name="choices[]" value="' . $obj->id . '"/>
                            <button type="submit" class="btn btn-link text-decoration-none btn-remove cursor-pointer">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>';
                }
            })
            ->rawColumns(['checkbox', 'name', 'action'])
            ->make(true);
    }

    public function get(Request $request)
    {
        return Product::with(['catalogues', 'variables'])->find($request->id);
    }

    public function create(Request $request)
    {
        $request->validate(self::RULES, self::MESSAGES);

        if (!empty(Auth::user()->can(User::CREATE_PRODUCT))) {
            $product = $this->sync([
                "author_id" => Auth::User()->id,
                'sku' => $request->sku,
                'name' => $request->name,
                'note' => $request->note,
                'status' => $request->has('status'),
            ]);
            if ($product) {
                $product->syncCatalogues($request->catalogue_id);
                if (count($request->variable_name)) {
                    foreach ($request->variable_name as $key => $name) {
                        VariableController::sync([
                            'product_id' => $product->id,
                            'sub_sku' => $request->variable_sub_sku[$key],
                            'name' => $request->variable_name[$key],
                            'unit' => $request->variable_unit[$key],
                            'origin_id' => $request->variable_origin_id[$key],
                            'status' => 1
                        ]);
                    }
                }
                $response = [
                    'status' => 'success',
                    'msg' => 'Đã tạo sản phẩm ' . $product->name,
                ];
            }
        } else {
            $response = array(
                'status' => 'error',
                'msg' => 'Thao tác chưa được cấp quyền!'
            );
        }
        return response()->json($response, 200);
    }

    public function update(Request $request)
    {
        $request->validate(self::RULES, self::MESSAGES);
        if (!empty(Auth::user()->can(User::UPDATE_PRODUCT))) {
            if ($request->has('id')) {
                $product = $this->sync([
                    "author_id" => Auth::User()->id,
                    'sku' => $request->sku,
                    'name' => $request->name,
                    'note' => $request->note,
                    'status' => $request->has('status'),
                ], $request->id);
                if ($product) {
                    $product->syncCatalogues($request->catalogue_id);
                    LogController::create("sửa", "sản phẩm", $product->id);
                    if (count($request->variable_name)) {
                        foreach ($request->variable_name as $key => $productData) {
                            $variable = VariableController::sync([
                                'product_id' => $product->id,
                                'sub_sku' => $request->variable_sub_sku[$key],
                                'name' => $request->variable_name[$key],
                                'unit' => $request->variable_unit[$key],
                                'origin_id' => $request->variable_origin_id[$key],
                            ], $request->variable_id[$key]);
                        }
                    }
                    $response = [
                        'status' => 'success',
                        'msg' => 'Đã cập nhật sản phẩm ' . $product->name,
                    ];
                }
            } else {
                $response = array(
                    'status' => 'error',
                    'msg' => 'Đã có lỗi xảy ra, vui lòng thử lại!'
                );
            }
        } else {
            $response = array(
                'status' => 'error',
                'msg' => 'Thao tác chưa được cấp quyền!'
            );
        }
        return response()->json($response, 200);
    }

    public static function sync($array, $id = null)
    {
        $obj = Product::updateOrCreate(['id' => $id], $array);
        LogController::create($id ? 'sửa' : 'tạo', "sản phẩm", $obj->id);
        return $obj;
    }

    public function remove(Request $request)
    {
        $names = [];
        foreach ($request->choices as $key => $id) {
            $obj = Product::find($id);
            $obj->delete();
            array_push($names, $obj->name);
            foreach ($obj->variables as $key => $variable) {
                VariableController::remove_exec($variable->id);
            }
            LogController::create("xóa", "sản phẩm", $obj->id);
        }
        return response()->json([
            'status' => 'success',
            'msg' => 'Đã xóa sản phẩm ' . implode(', ', $names),
        ], 200);
    }
}
