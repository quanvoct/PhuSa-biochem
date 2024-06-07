<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    const RULES = [
        'note' => ['required', 'string', 'min: 3', 'max:125'],
        'customer_id' => ['required', 'numeric'],
        'cashier_id' => ['required', 'numeric'],
        'payment' => ['required', 'numeric'],
        'amount' => ['required', 'numeric'],
        'status' => ['required', 'numeric'],
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
        $pageName = __('Transactions');
        return view('transaction', compact('pageName'));
    }

    public function load(Request $request)
    {
        $transaction = Transaction::whereHas('order', function ($query) {
            $query->whereIn('store_id', Auth::user()->stores->pluck('id'));
        })->get();
        return DataTables::of($transaction)
            ->addColumn('checkbox', function ($obj) {
                if (!empty(Auth::user()->can(User::DELETE_TRANSACTIONS))) {
                    return '<input class="form-check-input choice" type="checkbox" name="choices[]" value="' . $obj->id . '">';
                }
            })
            ->editColumn('note', function ($obj) {
                if (!empty(Auth::user()->can(User::READ_TRANSACTION))) {
                    return '<a class="btn btn-link text-decoration-none text-start btn-update-transaction" data-id="' . $obj->id . '">' . $obj->note . '</a>';
                } else {
                    return $obj->note;
                }
            })
            ->addColumn('order_id', function ($obj) {
                if (!empty(Auth::user()->can(User::READ_ORDER))) {
                    return '<a class="btn btn-link text-decoration-none text-start btn-update-order" data-id="' . $obj->_order->id . '">Đơn hàng ' . $obj->order_id . '</a>';
                } else {
                    return $obj->order_id;
                }
            })
            ->addColumn('customer', function ($obj) {
                if (!empty(Auth::user()->can(User::READ_CUSTOMER))) {
                    return '<a class="btn btn-link text-decoration-none text-start btn-update-customer" data-id="' . $obj->_customer->id . '">' . $obj->_customer->name . '</a>';
                } else {
                    return $obj->customer->name;
                }
            })
            ->addColumn('cashier', function ($obj) {
                if (!empty(Auth::user()->can(User::READ_USER))) {
                    return '<a class="btn btn-link text-decoration-none text-start btn-update-user" data-id="' . $obj->_cashier->id . '">' . $obj->_cashier->name . '</a>';
                } else {
                    return $obj->cashier->name;
                }
            })
            ->editColumn('payment', function ($obj) {
                return $obj->paymentName();
            })
            ->editColumn('status', function ($obj) {
                return $obj->statusName();
            })
            ->addColumn('date', function ($obj) {
                return $obj->created_at->format('Y-m-d');
            })
            ->addColumn('action', function ($obj) {
                if (!empty(Auth::user()->can(User::DELETE_TRANSACTION))) {
                    $str = '
                        <form action="' . route('transaction.remove') . '" method="post" class="save-form">
                            <input type="hidden" name="_token" value="' . csrf_token() . '"/>
                            <input type="hidden" name="choices[]" value="' . $obj->id . '" data-id="'  . $obj->id . '"/>
                            <button type="submit" class="btn btn-link text-decoration-none btn-remove">
                                <i class="bi bi-trash3"></i>
                            </button>
                        </form>';
                    return $str;
                }
            })
            ->rawColumns(['checkbox', 'note', 'order_id', 'customer', 'cashier', 'payment', 'status', 'action'])
            ->make(true);
    }

    public function get(Request $request)
    {
        if ($request->id === 'amountOfDate') {
            if ($request->date) {
                $transactions = Transaction::whereDate('created_at', $request->date)->sum('amount');
                $result = [$request->date, $transactions];
            }
        } else {
            $result = Transaction::with('_customer')->find($request->id);
        }
        return response()->json($result, 200);
    }

    public function create(Request $request)
    {
        $request->validate(self::RULES);
        if (!empty(Auth::user()->can(User::CREATE_TRANSACTION))) {
            if ($request->has('order_id') && $request->order_id != null) {
                $transaction = $this->sync([
                    'order_id' => $request->order_id,
                    'customer_id' => $request->customer_id,
                    'cashier_id' => $request->cashier_id,
                    'payment' => $request->payment,
                    'amount' => $request->amount,
                    'status' => $request->status,
                    'note' => $request->note,
                ]);
                $response = array(
                    'status' => 'success',
                    'msg' => 'Đã thêm giao dịch ' . $transaction->id
                );
            } else {
                $debtOrders = Order::where('customer_id', $request->customer_id)
                    ->whereRaw('(
                            SELECT SUM(quantity * price) - discount
                            FROM order_details
                            WHERE order_id = orders.id AND orders.deleted_at IS NULL AND orders.status <> 0
                        ) > (
                            SELECT IFNULL(SUM(amount), 0)
                            FROM transactions
                            WHERE order_id = orders.id AND transactions.deleted_at IS NULL AND transactions.status <> 0
                        )')
                    ->get();
                $totalAmount = $request->amount;
                $ids = [];
                foreach ($debtOrders as $key => $order) {
                    if ($totalAmount > 0) {
                        $amount = $order->total - $order->paid < $totalAmount ? $order->total - $order->paid : $totalAmount;
                        $transaction = $this->sync([
                            'order_id' => $order->id,
                            'customer_id' => $request->customer_id,
                            'cashier_id' => $request->cashier_id,
                            'payment' => $request->payment,
                            'amount' => $amount,
                            'status' => $request->status,
                            'note' => $request->note,
                        ]);
                        $totalAmount -= $amount;
                        array_push($ids, $order->id);
                    }
                }
                $response = array(
                    'status' => 'success',
                    'msg' => 'Đã thanh toán cho các đơn hàng ' . implode(', ', $ids)
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

    public function update(Request $request)
    {
        $request->validate(self::RULES);
        if (!empty(Auth::user()->can(User::UPDATE_TRANSACTION))) {
            if ($request->has('id')) {
                $transaction = $this->sync([
                    'order_id' => $request->order_id,
                    'customer_id' => $request->customer_id,
                    'cashier_id' => $request->cashier_id,
                    'payment' => $request->payment,
                    'amount' => $request->amount,
                    'status' => $request->status,
                    'note' => $request->note,
                ], $request->id);

                $response = array(
                    'status' => 'success',
                    'msg' => 'Đã cập nhật giao dịch ' . $transaction->id
                );
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
        $obj = Transaction::updateOrCreate(['id' => $id], $array);
        LogController::create($id ? 'sửa' : 'tạo', "giao dịch", $obj->id);
        return $obj;
    }

    public function remove(Request $request)
    {
        $names = [];
        foreach ($request->choices as $key => $id) {
            $obj = Transaction::find($id);
            $obj->delete();
            array_push($names, $obj->id);
            LogController::create("xóa", "giao dịch", $obj->id);
        }
        $response = array(
            'status' => 'success',
            'msg' => 'Đã xóa giao dịch ' . implode(', ', $names)
        );

        return response()->json($response, 200);
    }
}
