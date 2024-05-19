<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ExportDetail;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;

class OrderDetailController extends Controller
{
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
    public function index()
    {
        $pageName = 'Quản lý hàng bán';
        $options = Controller::options();
        return view('order_detail', compact('pageName', 'options'));
    }

    public function load(Request $request)
    {
        $orderDetails = OrderDetail::whereHas('order', function ($query) {
            $query->whereIn('store_id', Auth::user()->stores->pluck('id'));
        })->get();
        return DataTables::of($orderDetails)
            ->addColumn('customer', function ($obj) {
                if (!empty(Auth::user()->can(User::READ_ORDER))) {
                    return '<a class="btn btn-link text-decoration-none text-start btn-update-customer" data-id="' . $obj->_order->_customer->id . '">' . $obj->_order->_customer->name . '</a>';
                } else {
                    return $obj->_order->_customer->name;
                }
            })
            ->editColumn('order', function ($obj) {
                $textColor = $obj->paid < $obj->total ? 'danger' : 'success';
                if (!empty(Auth::user()->can(User::READ_ORDER))) {
                    return '<a class="btn btn-link text-decoration-none text-start btn-update-order text-' . $textColor . '" data-id="' . $obj->_order->id . '">' . $obj->_order->id . '</a>';
                } else {
                    return '<span class="text-' . $textColor . '">' . $obj->_order->id . '</span>';
                }
            })
            ->editColumn('product', function ($obj) {
                if (!empty(Auth::user()->can(User::READ_ORDER))) {
                    return '<a class="btn btn-link text-decoration-none text-start btn-update-product" data-id="' . $obj->_stock->_variable->_product->id . '">' . $obj->_stock->_variable->_product->sku . $obj->_stock->_variable->sub_sku . ' - ' . $obj->_stock->_variable->_product->name . ' ' . $obj->_stock->_variable->name . '</a>';
                } else {
                    return $obj->_stock->_variable->_product->sku . $obj->_stock->_variable->sub_sku . ' - ' . $obj->_stock->_variable->_product->name . ' ' . $obj->_stock->_variable->name;
                }
            })
            ->editColumn('quantity', function ($obj) {
                return number_format($obj->quantity);
            })
            ->editColumn('price', function ($obj) {
                return number_format($obj->price) . 'đ';
            })
            ->addColumn('total', function ($obj) {
                return number_format($obj->price * $obj->quantity) . 'đ';
            })
            ->addColumn('action', function ($obj) {
                $str = '';

                if (!empty(Auth::user()->can(User::DELETE_ORDER))) {
                    $str .=
                        '<form action="' . route('order.remove') . '" method="post" class="d-inline-block">
                            <input type="hidden" name="_token" value="' . csrf_token() . '"/>
                            <input type="hidden" name="choices[]" value="' . $obj->id . '" data-id="'  . $obj->id . '"/>
                            <button type="submit" class="btn btn-link text-decoration-none btn-remove"><i class="bi bi-trash3"></i></button>
                        </form>';
                }
                return $str;
            })
            ->rawColumns(['customer', 'order',  'product', 'action'])
            ->make(true);
    }

    public function get(Request $request)
    {
        $obj = OrderDetail::with('_stock._variable._product')->find($request->id);
        return response()->json($obj, 200);
    }

    public static function sync($array, $id = null)
    {
        $obj = OrderDetail::updateOrCreate(['id' => $id], $array);
        LogController::create($id ? 'sửa' : 'tạo', "chi tiết đơn hàng", $obj->id);
        return $obj;
    }

    public function remove(Request $request)
    {
        $names = [];
        foreach ($request->choices as $key => $id) {
            $obj = $this->remove_exec($id);
            array_push($names, $obj->quantity . ' ' . $obj->_stock->_variable->unit . ' ' . $obj->_stock->_variable->_product->name . ' - ' . $obj->_stock->_variable->name);
        }
        return response()->json([
            'status' => 'success',
            'msg' => 'Đã xóa chi tiết đơn hàng ' . implode(', ', $names),
        ], 200);
    }

    static function remove_exec($id)
    {
        $obj = OrderDetail::find($id);
        if($obj) {
            $obj->delete();
            LogController::create("xóa", "chi tiết đơn hàng", $obj->id);
            $referenceId = ExportDetail::where('note', 'Xuất bán theo đơn ' . $obj->order_id)->where('stock_id', $obj->stock_id)->first()->id;
            ExportDetailController::remove_exec($referenceId);
            return $obj;
        } else {
            return false;
        }
    }
}
