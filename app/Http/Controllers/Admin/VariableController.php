<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Stock;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Variable;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class VariableController extends Controller
{
    const RULES = [
        'sub_sku' => ['required', 'min: 3', 'max:125'],
        'name' => ['required', 'min: 3', 'max:125'],
        'product_id' => ['required'],
        'unit' => ['required', 'string'],
        'origin_id' => ['required', 'numeric'],
    ];
    const MESSAGES = [
        'sub_sku.required' => 'Thông tin này không thể trống.',
        'sub_sku.min' => 'Tối thiểu 3 kí tự trở lên.',
        'sub_sku.max' => 'Tối đa 125 kí tự.',
        'name.required' => 'Thông tin này không thể trống.',
        'name.min' => 'Tối thiểu 3 kí tự trở lên.',
        'name.max' => 'Tối đa 125 kí tự.',
        'product_id.required' => 'Thông tin này không thể trống.',
        'unit.required' => 'Thông tin này không thể trống.',
        'unit.string' => 'Dữ liệu không hợp lệ',
        'origin_id.required' => 'Thông tin này không thể trống.',
        'origin_id.numeric' => 'Dữ liệu không hợp lệ',
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
        $pageName = 'Quản lý biến thể';
        $options =  Controller::options();
        return view('variable', compact('pageName', 'options'));
    }

    public function load(Request $request)
    {
        $variables = Variable::all();
        return DataTables::of($variables)
            ->addColumn('checkbox', function ($obj) {
                return '<input class="form-check-input choice" type="checkbox" name="choices[]" value="' . $obj->id . '">';
            })
            ->editColumn('name', function ($obj) {
                return '<a class="btn btn-link text-decoration-none text-start btn-update-variable" data-id="' . $obj->id . '">' . $obj->name . '</a>';
            })
            ->addColumn('action', function ($obj) {
                return '
                    <form method="post" action="' . route('variable.remove') . '" class="save-form">
                        <input type="hidden" name="choices[]" value="' . $obj->id . '"/>
                        <button type="submit" class="btn btn-link text-decoration-none btn-remove cursor-pointer">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>';
            })
            ->editColumn('product_id', function ($obj) {
                return '<span>' . Product::find($obj->product_id)->name . '</span>';
            })
            ->rawColumns(['checkbox', 'name', 'action', 'product_id'])
            ->make(true);
    }

    public function get(Request $request)
    {
        $objs = Variable::query();
        switch ($request->id) {
            case 'list':
                $result = $objs->orderBy('sort', 'ASC')->get();
                break;
            case 'find':
                $result = $objs
                    ->where('name', 'LIKE', '%' . $request->q . '%')
                    ->orWhere('sub_sku', 'LIKE', '%' . $request->q . '%')
                    ->orWhereHas('_product', function ($query) use ($request) {
                        $query
                            ->where('name', 'LIKE', '%' . $request->q . '%')
                            ->orWhere('sku', 'LIKE', '%' . $request->q . '%');
                    })
                    ->orderByDesc('id')
                    ->get()
                    ->map(function ($obj) {
                        return [
                            'id' => $obj->id,
                            'text' => $obj->_product->sku . $obj->sub_sku . ' - ' . $obj->_product->name . ' - ' . $obj->name
                        ];
                    })->push([
                        'id' => 0,
                        'text' => 'Thêm sản phẩm mới'
                    ]);
                break;
            default:
                $obj = $objs->with('_product')->find($request->id);
                if ($obj) {
                    if(isset($request->supplier_id) && is_numeric($request->supplier_id)) {
                        $lastestStockOfVariable = Stock::where('variable_id', $obj->id)
                        ->whereHas('import', function($query) use ($request) {
                            $query->where('supplier_id', $request->supplier_id);
                        })->orderBy('created_at', 'DESC')->first();
                        if($lastestStockOfVariable) {
                            $obj->price = $lastestStockOfVariable->price;
                        } else {
                            $obj->price = 0;
                        }
                    } else {
                        $obj->price = 0;
                    }
                    $result = $obj;
                } else {
                    abort(404);
                }
                break;
        }
        return response()->json($result, 200);
    }

    public function create(Request $request)
    {
        $request->validate(self::RULES, self::MESSAGES);

        $variable = $this->sync([
            'sub_sku' => $request->sub_sku,
            'name' => $request->name,
            'unit' => $request->unit,
            'product_id' => $request->product_id,
            'origin_id' => $request->origin_id,
        ]);

        return response()->json([
            'status' => 'success',
            'msg' => 'Đã tạo biến thể ' . $variable->name
        ], 200);
    }


    public function update(Request $request)
    {
        $request->validate(self::RULES, self::MESSAGES);

        if ($request->has('id')) {
            $variable = $this->sync([
                'sub_sku' => $request->sub_sku,
                'name' => $request->name,
                'unit' => $request->unit,
                'product_id' => $request->product_id,
                'origin_id' => $request->origin_id,
            ], $request->id);
            return response()->json([
                'status' => 'success',
                'msg' => 'Đã cập nhật biến thể ' . $variable->name
            ], 200);
        } else {
            $response = array(
                'status' => 'error',
                'msg' => 'Đã có lỗi xảy ra, vui lòng tải lại trang và thử lại!'
            );
        }
    }

    public function remove(Request $request)
    {
        $names = [];
        foreach ($request->choices as $key => $id) {
            $obj = $this->remove_exec($id);
            array_push($names, $obj->name);
        }
        return response()->json([
            'status' => 'success',
            'msg' => 'Đã xóa biến thể ' . implode(', ', $names),
        ], 200);
    }

    public static function sync($array, $id = null)
    {
        $obj = Variable::updateOrCreate(['id' => $id], $array);
        LogController::create($id ? 'sửa' : 'tạo', "biến thể", $obj->id);
        return $obj;
    }

    static function remove_exec($id)
    {
        $obj = Variable::find($id);
        $obj->delete();
        LogController::create("xóa", "biến thể", $obj->id);
        return $obj;
    }
}
