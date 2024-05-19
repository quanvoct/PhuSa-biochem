<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class DebtController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        // $this->middleware(['verified','auth']);
    }
    public function index()
    {
        $pageName = 'Quản lý công nợ';
        $options = Controller::options();
        return view('debt', compact('pageName', 'options'));
    }

    public function load(Request $request)
    {
        $debts = Customer::whereHas('orders', function ($query) {
            $query->whereRaw('(
                SELECT COALESCE(SUM(quantity * price), 0) - orders.discount
                FROM order_details
                WHERE order_id = orders.id AND orders.deleted_at IS NULL AND orders.status <> 0
            ) > (
                SELECT COALESCE(SUM(amount), 0)
                FROM transactions
                WHERE order_id = orders.id AND transactions.deleted_at IS NULL AND transactions.status <> 0
            )');
        })->get();
        return DataTables::of($debts)
            ->addColumn('customer', function ($obj) {
                if (!empty(Auth::user()->can(User::READ_ORDER))) {
                    return '<a class="btn btn-link text-decoration-none text-start btn-update-customer" data-id="' . $obj->id . '">' . $obj->name . '</a>';
                } else {
                    return $obj->name;
                }
            })
            ->editColumn('debt', function ($obj) {
                return number_format($obj->orders->sum('total') - $obj->orders->sum('discount') - $obj->orders->sum('paid')) . 'đ';
            })
            ->editColumn('first_debt_order', function ($obj) {
                $first_debt_order = $obj->orders->filter(function ($order) {
                    return $order->paid < $order->total;
                })->sortByDesc('created_at')->first();
                if($first_debt_order) {
                    $result = '<a class="btn btn-link text-decoration-none text-start btn-update-order" data-id="' . $first_debt_order->id . '">' . $first_debt_order->created_at->format('d/m/Y') . ' - Đơn hàng ' . $first_debt_order->id . '</a>';
                } else {
                    $result = 'Không xác định';
                }
                return $result;
            })
            ->addColumn('action', function ($obj) {
                $amount = $obj->orders->sum('total') - $obj->orders->sum('discount') - $obj->orders->sum('paid');
                $str = '
                <a class="btn btn-info text-start btn-create-transaction" data-customer="' . $obj->id . '" data-amount="' . $amount . '">
                    <i class="bi bi-cash-coin"></i> Thanh toán
                </a>';
                if (!empty(Auth::user()->can(User::READ_ORDERS))) {
                $str .= '
                <a class="btn btn-outline-info text-start" href="' . route('order', ['customer_id' => $obj->id]) . '">
                    <i class="bi bi-receipt-cutoff"></i> Đơn hàng
                </a>';
                }
                return $str;
            })
            ->rawColumns(['customer', 'first_debt_order', 'action'])
            ->make(true);
    }
}
