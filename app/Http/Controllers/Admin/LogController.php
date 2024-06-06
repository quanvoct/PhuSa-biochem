<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Catalogue;
use App\Models\Detail;
use App\Models\Log;
use App\Models\Order;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Variable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Jenssegers\Agent\Agent;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class LogController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $pageName = 'Nhật ký hệ thống';
        return view('log', compact('pageName', 'options'));
    }
    public function load(Request $request)
    {
        $logs = Log::all();
        return DataTables::of($logs)
            ->editColumn('user_id', function ($obj) {
                return $obj->user->name;
            })
            ->editColumn('type', function ($obj) {
                $name = '';
                switch ($obj->type) {
                    case 'đơn hàng':
                        $type = Order::withTrashed()->find($obj->object);
                        if (!empty(Auth::user()->can(User::READ_ORDER))) {
                            $name = '<a class="cursor-pointer btn-update-order" data-id="' . $type->id . '">' . $type->id . '</a>';
                        } else {
                            $name = $type->id;
                        }
                        break;
                    case 'giao dịch':
                        $type = Transaction::withTrashed()->find($obj->object);
                        if (!empty(Auth::user()->can(User::READ_TRANSACTION))) {
                            $name = '<a class="cursor-pointer btn-update-transaction" data-id="' . $type->id . '">' . $type->id . '</a>';
                        } else {
                            $name = $type->id;
                        }
                        break;
                    case 'sản phẩm':
                        $type = Product::withTrashed()->find($obj->object);
                        if (!empty(Auth::user()->can(User::READ_PRODUCT))) {
                            $name = '<a class="cursor-pointer btn-update-product" data-id="' . $type->id . '">' . $type->name . '</a>';
                        } else {
                            $name = $type->name;
                        }
                        break;
                    case 'biến thể':
                        $type = Variable::withTrashed()->find($obj->object);
                        if (!empty(Auth::user()->can(User::READ_PRODUCT))) {
                            $name = '<a class="cursor-pointer btn-update-product" data-id="' . $type->_product->id . '">' . $type->name . '</a>';
                        } else {
                            $name = $type->name;
                        }
                        break;
                    case 'danh mục':
                        $type = Catalogue::withTrashed()->find($obj->object);
                        if (!empty(Auth::user()->can(User::READ_CATALOGUE))) {
                            $name = '<a class="cursor-pointer btn-update-catalogue" data-id="' . $type->id . '">' . $type->name . '</a>';
                        } else {
                            $name = $type->name;
                        }
                        break;
                    case 'chi tiết đơn hàng':
                        $detail = Detail::withTrashed()->find($obj->object);
                        $type = $detail->quantity . ' ' . $detail->_stock->_variable->unit . ' ' . $detail->_stock->_variable->_product->name . ' - ' . $detail->_stock->_variable->name;
                        if (!empty(Auth::user()->can(User::READ_ORDER))) {
                            $name = '<a class="cursor-pointer btn-update-order" data-id="' . $detail->_order->id . '">' . $type . '</a>';
                        } else {
                            $name = $detail->id;
                        }
                        break;
                    case 'tài khoản':
                        $type = User::withTrashed()->find($obj->object);
                        if (!empty(Auth::user()->can(User::READ_ORDER))) {
                            $name = '<a class="cursor-pointer btn-update-user" data-id="' . $type->id . '">' . $type->name . '</a>';
                        } else {
                            $name = $type->name;
                        }
                        break;
                    case 'nhóm quyền':
                        if (Role::find($obj->object)) {
                            $type = Role::find($obj->object)->name;
                        } else {
                            $type = $obj->object;
                        }
                        break;
                    case 'cài đặt':
                        $type = Setting::withTrashed()->find($obj->object)->key;
                        break;
                    case 'nhật ký':
                        $type = Log::withTrashed()->find($obj->object)->id;
                        break;

                    default:
                        $name = 'Không xác định';
                        break;
                }
                return $obj->type . ' ' . $name;
            })
            ->editColumn('location', function ($obj) {
                return $obj->location . ', ' . $obj->country;
            })
            ->rawColumns(['action', 'type'])
            ->make(true);
    }

    public static function create(string $action, string $type, int $object)
    {
        $agent = new Agent();
        $ip = Session::get('ip');
        $geolocation = Http::get('https://ipinfo.io/' . $ip . '/json?token=d89e4a0555c438')->json();
        $product = new log([
            "user_id" => Auth::User()->id,
            'action' => $action,
            'type' => $type,
            'object' => $object,
            'browser' => $agent->browser() . ' ' . $agent->version($agent->browser()),
            'platform' => $agent->platform() . ' ' . $agent->version($agent->platform()),
            'device' => $agent->device(),
            'ip' => $ip,
            'location' => (isset($geolocation['city'])) ? $geolocation['city'] . ' - ' . $geolocation['region'] : null,
            'country' => (isset($geolocation['country'])) ? $geolocation['country'] : null,
        ]);
        $product->save();
    }
}
