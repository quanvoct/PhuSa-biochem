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
    const NAME = 'biến thể';
    const RULES = [
        'sub_sku' => ['required', 'min:3', 'max:125'],
        'name' => ['required', 'min:3', 'max:125'],
        'product_id' => ['required'],
        'description' => ['required', 'string'],
        'price' => ['required', 'numeric'],
        'width' => ['nullable', 'numeric', 'min:0', 'max:999.99'],
        'height' => ['nullable', 'numeric', 'min:0', 'max:999.99'],
        'length' => ['nullable', 'numeric', 'min:0', 'max:999.99'],
        'weight' => ['nullable', 'numeric', 'min:0', 'max:999.99'],
    ];
    const MESSAGES = [
        'sub_sku.required' => Controller::VALIDATE['required'],
        'sub_sku.min' => Controller::VALIDATE['min2'],
        'sub_sku.max' => Controller::VALIDATE['max191'],
        'name.required' => Controller::VALIDATE['required'],
        'name.min' => Controller::VALIDATE['min2'],
        'name.max' => Controller::VALIDATE['max191'],
        'product_id.required' => Controller::VALIDATE['required'],
        'description.required' => Controller::VALIDATE['required'],
        'description.string' => Controller::VALIDATE['invalid'],
        'price.required' => Controller::VALIDATE['required'],
        'price.numeric' => Controller::VALIDATE['invalid'],
        'width.numeric' => Controller::VALIDATE['invalid'],
        'width.min' => Controller::VALIDATE['min2'],
        'width.max' => Controller::VALIDATE['max191'],
        'height.numeric' => Controller::VALIDATE['invalid'],
        'height.min' => Controller::VALIDATE['min2'],
        'height.max' => Controller::VALIDATE['max191'],
        'length.numeric' => Controller::VALIDATE['invalid'],
        'length.min' => Controller::VALIDATE['min2'],
        'length.max' => Controller::VALIDATE['max191'],
        'weight.numeric' => Controller::VALIDATE['invalid'],
        'weight.min' => Controller::VALIDATE['min2'],
        'weight.max' => Controller::VALIDATE['max191'],
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
    public function index(Request $request)
    {
        if ($request->key) {
            $objs = Variable::query();
            switch ($request->key) {
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
                    $obj = $objs->with('product')->find($request->key);
                    if ($obj) {
                        $result = $obj;
                    } else {
                        abort(404);
                    }
                    break;
            }
            return response()->json($result, 200);
        } else {
            if ($request->ajax()) {
                $objs = Variable::when(isset($request->product_id), function ($query) use ($request) {
                    $query->where('product_id', $request->product_id);
                })->get();
                if ($objs) {
                    return DataTables::of($objs)
                        ->editColumn('sub_sku', function ($obj) {
                            if (Auth::user()->can(User::UPDATE_VARIABLE)) {
                                return '<a class="btn btn-update-variable text-info fw-bold" data-id="' . $obj->id . '">' . $obj->sub_sku . '</a>';
                            }
                            return '<span class="fw-bold">' . $obj->code . '</span>';
                        })
                        ->editColumn('price', function ($obj) {
                            return '<span>' . number_format($obj->price) . '</span>';
                        })
                        ->editColumn('status', function ($obj) {
                            return '<span class="badge bg-' . ($obj->status ? 'success' : 'danger') . '">' . $obj->statusStr . '</span>';
                        })
                        ->addColumn('action', function ($obj) {
                            if (!empty(Auth::user()->can(User::DELETE_VARIABLE))) {
                                return '
                                    <form action="' . route('admin.variable.remove') . '" method="post" class="save-form">
                                        <input type="hidden" name="_token" value="' . csrf_token() . '"/>
                                        <input type="hidden" name="choice" value="' . $obj->id . '" data-id="'  . $obj->id . '"/>
                                        <button class="btn btn-link text-decoration-none btn-remove">
                                            <i class="bi bi-trash3"></i>
                                        </button>
                                    </form>';
                            }
                        })
                        ->rawColumns(['checkboxes', 'sub_sku', 'price', 'status', 'action'])
                        ->make(true);
                }
            } else {
                $pageName = 'Quản lý ' . self::NAME;
                return view('variable', compact('pageName', 'options'));
            }
        }
    }

    public function create(Request $request)
    {
        $request->validate(self::RULES, self::MESSAGES);

        $variable = $this->sync([
            'sub_sku' => $request->sub_sku,
            'name' => $request->name,
            'image' => $request->image,
            'length' => $request->length,
            'width' => $request->width,
            'height' => $request->height,
            'weight' => $request->weight,
            'price' => $request->price,
            'description' => $request->description,
            'product_id' => $request->product_id,
            'status' => $request->has('status'),
        ]);
        $response = [
            'status' => 'success',
            'msg' => 'Đã cập nhật ' . self::NAME . ' ' . $variable->name
        ];
        return response()->json($response, 200);
    }


    public function update(Request $request)
    {
        $request->validate(self::RULES, self::MESSAGES);

        if ($request->id) {
            $variable = $this->sync([
                'sub_sku' => $request->sub_sku,
                'name' => $request->name,
                'image' => $request->image,
                'length' => $request->length,
                'width' => $request->width,
                'height' => $request->height,
                'weight' => $request->weight,
                'price' => $request->price,
                'description' => $request->description,
                'product_id' => $request->product_id,
                'status' => $request->has('status'),
            ], $request->id);
            $response = [
                'status' => 'success',
                'msg' => 'Đã cập nhật ' . self::NAME . ' ' . $variable->name
            ];
        } else {
            $response = [
                'status' => 'error',
                'msg' => 'Đã có lỗi xảy ra, vui lòng tải lại trang và thử lại!'
            ];
        }
        return response()->json($response, 200);
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
            'msg' => 'Đã xóa ' . self::NAME . ' ' . implode(', ', $names),
        ], 200);
    }

    public static function sync($array, $id = null)
    {
        if ($id) {
            Variable::find($id)->revision();
        }
        $obj = Variable::updateOrCreate(['id' => $id], $array);
        LogController::create($id ? 'sửa' : 'tạo', self::NAME, $obj->id);
        return $obj;
    }

    static function remove_exec($id)
    {
        $obj = Variable::find($id);
        $obj->revision();
        $obj->delete();
        LogController::create("xóa", self::NAME, $obj->id);
        return $obj;
    }
}
