<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Export;
use App\Models\ExportDetail;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;

class OrderController extends Controller
{
    const RULES = [
        'customer_id' => ['required', 'numeric'],
        'dealer_id' => ['required', 'numeric'],
        'created_at' => ['required', 'date_format:Y-m-d'],
        'discount' => ['required', 'numeric'],
        'status' => ['required', 'numeric'],
        'note' => ['max:255'],

        'detail_stock_id' => ['array', 'min:1'],
        'detail_stock_id.*' => ['required', 'numeric'],
        'detail_quantity.*' => ['required', 'numeric'],
        'detail_price.*' => ['required', 'numeric'],
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
        $pageName = __('Orders');
        return view('order', compact('pageName'));
    }

    public function load(Request $request)
    {
        $orders = Order::whereIn('store_id', Auth::user()->stores->pluck('id'))
        ->when(isset($request->customer_id), function ($query) use ($request) {
            $query->where('customer_id', $request->customer_id);
        })->get();
        return DataTables::of($orders)
            ->addColumn('checkbox', function ($obj) {
                if (!empty(Auth::user()->hasAnyPermission(User::DELETE_ORDERS))) {
                    return '<input class="form-check-input choice" type="checkbox" name="choices[]" value="' . $obj->id . '">';
                }
            })
            ->addColumn('customer', function ($obj) {
                $textColor = $obj->paid < $obj->total ? 'danger' : 'success';
                if (!empty(Auth::user()->can(User::READ_ORDER))) {
                    return '<a class="btn btn-link text-decoration-none text-start btn-update-order text-' . $textColor . '" data-id="' . $obj->id . '">' . $obj->_customer->name . '</a>';
                } else {
                    return '<span class="text-' . $textColor . '">' . $obj->_customer->name . '</span>';
                }
            })
            ->editColumn('status', function ($obj) {
                return $obj->status();
            })
            ->addColumn('dealer', function ($obj) {
                if (!empty(Auth::user()->can(User::READ_USER))) {
                    return '<a class="btn btn-link text-decoration-none text-start btn-update-user" data-id="' . $obj->_dealer->id . '">' . $obj->_dealer->name . '</a>';
                } else {
                    return $obj->_dealer->name;
                }
            })
            ->editColumn('paid', function ($obj) {
                return  number_format($obj->paid) . '/<strong>' . number_format($obj->total) . '</strong>';
            })
            ->addColumn('action', function ($obj) {
                $str = '
                    <div class="dropstart d-inline-block">
                        <button class="btn btn-link text-decoration-none dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-printer-fill"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li><button type="button" class="dropdown-item btn-print-order" data-type="company" data-id="' . $obj->id . '"><small>Công ty</small></button></li>
                            <li><button type="button" class="dropdown-item btn-print-order" data-type="store" data-id="' . $obj->id . '"><small>Cửa hàng</small></button></li>
                        </ul>
                    </div>';

                if (!empty(Auth::user()->hasAnyPermission(User::DELETE_ORDER))) {
                    $str .=
                        '<form action="' . route('order.remove') . '" method="post" class="d-inline-block">
                            <input type="hidden" name="_token" value="' . csrf_token() . '"/>
                            <input type="hidden" name="choices[]" value="' . $obj->id . '" data-id="'  . $obj->id . '"/>
                            <button type="submit" class="btn btn-link text-decoration-none btn-remove"><i class="bi bi-trash3"></i></button>
                        </form>';
                }
                return $str;
            })
            ->rawColumns(['checkbox', 'customer', 'dealer', 'status', 'discount', 'paid', 'action'])
            ->make(true);
    }
    public function get(Request $request)
    {
        $order = Order::withTrashed()->with(['_customer', '_dealer', 'details._stock._variable._product', 'transactions'])->find($request->id);
        return $order;
    }

    public function create(Request $request)
    {
        $request->validate(self::RULES);
        if (!empty(Auth::user()->can(User::CREATE_ORDER))) {
            $order = $this->sync([
                'customer_id' => $request->customer_id,
                'dealer_id' => $request->dealer_id,
                'store_id' => Auth::user()->store,
                'status' => $request->status,
                'discount' => $request->discount,
                'note' => $request->note,
                'created_at' => $request->created_at
            ]);

            if ($order) {
                $export = ExportController::sync([
                    'receiver_id' => Auth::user()->id,
                    'user_id' => Auth::user()->id,
                    'date' => date('Y-m-d'),
                    'status' => 1,
                    'note' => 'Xuất bán theo đơn ' . $order->id,
                ]);
                $total = 0;
                foreach ($request->detail_stock_id as $key => $stock_id) {
                    if ($export) {
                        ExportDetailController::sync([
                            'export_id' => $export->id,
                            'stock_id' => $request->detail_stock_id[$key],
                            'quantity' => $request->detail_quantity[$key],
                            'note' => 'Xuất bán theo đơn ' . $order->id,
                        ]);
                    }
                    $total += $request->detail_quantity[$key] * $request->detail_price[$key];
                    OrderDetailController::sync([
                        'order_id' => $order->id,
                        'stock_id' => $request->detail_stock_id[$key],
                        'quantity' => $request->detail_quantity[$key],
                        'price' => $request->detail_price[$key],
                    ]);
                }
                // if ($request->has('paid')) {
                //     TransactionController::sync([
                //         'order_id' => $order->id,
                //         'customer_id' => $request->customer_id,
                //         'cashier_id' => Auth::user()->id,
                //         'payment' => 1,
                //         'amount' => $total - $request->discount,
                //         'status' => 1,
                //         'note' => 'Thanh toán đơn hàng ' . $order->id,
                //     ]);
                // }
                $response = [
                    'status' => 'success',
                    'msg' => 'Đã tạo đơn hàng ' . $order->id,
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
        $request->validate(self::RULES);
        if (!empty(Auth::user()->can(User::UPDATE_ORDER))) {
            if ($request->has('id')) {
                $order = $this->sync([
                    'customer_id' => $request->customer_id,
                    'dealer_id' => $request->dealer_id,
                    'status' => $request->status,
                    'discount' => $request->discount,
                    'note' => $request->note,
                    'created_at' => $request->created_at
                ], $request->id);

                if ($order) {
                    foreach ($request->detail_stock_id as $key => $stock_id) {
                        if ($request->detail_id[$key]) {
                            $exportDetail = ExportDetail::whereNote('Xuất bán theo đơn ' . $order->id)->where('stock_id', $request->detail_stock_id[$key])->first();
                            ExportDetailController::sync([
                                'quantity' => $request->detail_quantity[$key]
                            ], $exportDetail->id);
                        } else {
                            $export = ExportController::sync([
                                'receiver_id' => Auth::user()->id,
                                'user_id' => Auth::user()->id,
                                'date' => date('Y-m-d'),
                                'status' => 1,
                                'note' => 'Xuất bán theo đơn ' . $order->id,
                            ]);

                            ExportDetailController::sync([
                                'export_id' => $export->id,
                                'stock_id' => $request->detail_stock_id[$key],
                                'quantity' => $request->detail_quantity[$key],
                                'note' => 'Xuất bán theo đơn ' . $order->id,
                            ]);
                        }

                        OrderDetailController::sync([
                            'order_id' => $order->id,
                            'stock_id' => $request->detail_stock_id[$key],
                            'quantity' => $request->detail_quantity[$key],
                            'price' => $request->detail_price[$key],
                        ], $request->detail_id[$key]);
                    }
                    $response = array(
                        'status' => 'success',
                        'msg' => 'Đã cập nhật đơn hàng ' . $request->id
                    );
                }
            } else {
                $response = array(
                    'status' => 'error',
                    'msg' => 'Đã có lỗi xảy ra, vui lòng tải lại trang và thử lại!'
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
        $obj = Order::updateOrCreate(['id' => $id], $array);
        LogController::create($id ? 'sửa' : 'tạo', "đơn hàng", $obj->id);
        return $obj;
    }

    public function remove(Request $request)
    {
        $orders = [];
        foreach ($request->choices as $key => $id) {
            $obj = $this->remove_exec($id);
            array_push($orders, $obj->id);
        }
        $response = array(
            'status' => 'success',
            'msg' => 'Đã xóa đơn hàng ' . implode(', ', $orders)
        );
        return  response()->json($response, 200);
    }

    static function remove_exec($id)
    {
        $obj = Order::find($id);
        if($obj) {
            $obj->delete();
            LogController::create("xóa", "đơn hàng", $obj->id);
            foreach ($obj->details as $key => $order_detail) {
                OrderDetailController::remove_exec($order_detail->id);
            }
            $exports = Export::where('note', 'Xuất bán theo đơn ' . $obj->id)->get();
            foreach ($exports as $key => $export) {
                ExportController::remove_exec($export->id);
            }
            return $obj;
        } else {
            return false;
        }
    }
}
