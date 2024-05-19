<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Catalogue;
use App\Models\Customer;
use App\Models\Export;
use App\Models\ExportDetail;
use App\Models\Import;
use App\Models\Log;
use App\Models\Order;
use App\Models\Origin;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Stock;
use App\Models\Supplier;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Variable;
use App\Models\Warehouse;
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
        $options = Controller::options();
        return view('log', compact('pageName', 'options'));
    }
    public function load(Request $request)
    {
        $logs = Log::all();
        return DataTables::of($logs)
            ->editColumn('user_id', function ($obj) {
                return $obj->user->name;
            })
            ->editColumn('object', function ($obj) {
                $name = '';
                switch ($obj->object) {
                    case 'đơn hàng':
                        $object = Order::withTrashed()->find($obj->object_id);
                        if (!empty(Auth::user()->can(User::READ_ORDER))) {
                            $name = '<a class="cursor-pointer btn-update-order" data-id="' . $object->id . '">' . $object->id . '</a>';
                        } else {
                            $name = $object->id;
                        }
                        break;
                    case 'giao dịch':
                        $object = Transaction::withTrashed()->find($obj->object_id);
                        if (!empty(Auth::user()->can(User::READ_TRANSACTION))) {
                            $name = '<a class="cursor-pointer btn-update-transaction" data-id="' . $object->id . '">' . $object->id . '</a>';
                        } else {
                            $name = $object->id;
                        }
                        break;
                    case 'khách hàng':
                        $object = Customer::withTrashed()->find($obj->object_id);
                        if (!empty(Auth::user()->can(User::READ_CUSTOMER))) {
                            $name = '<a class="cursor-pointer btn-update-order" data-id="' . $object->id . '">' . $object->name . '</a>';
                        } else {
                            $name = $object->name;
                        }
                        break;
                    case 'sản phẩm':
                        $object = Product::withTrashed()->find($obj->object_id);
                        if (!empty(Auth::user()->can(User::READ_PRODUCT))) {
                            $name = '<a class="cursor-pointer btn-update-product" data-id="' . $object->id . '">' . $object->name . '</a>';
                        } else {
                            $name = $object->name;
                        }
                        break;
                    case 'biến thể':
                        $object = Variable::withTrashed()->find($obj->object_id);
                        if (!empty(Auth::user()->can(User::READ_PRODUCT))) {
                            $name = '<a class="cursor-pointer btn-update-product" data-id="' . $object->_product->id . '">' . $object->name . '</a>';
                        } else {
                            $name = $object->name;
                        }
                        break;
                    case 'danh mục':
                        $object = Catalogue::withTrashed()->find($obj->object_id);
                        if (!empty(Auth::user()->can(User::READ_CATALOGUE))) {
                            $name = '<a class="cursor-pointer btn-update-catalogue" data-id="' . $object->id . '">' . $object->name . '</a>';
                        } else {
                            $name = $object->name;
                        }
                        break;
                    case 'nhà cung cấp':
                        $object = Supplier::withTrashed()->find($obj->object_id);
                        if (!empty(Auth::user()->can(User::READ_SUPPLIER))) {
                            $name = '<a class="cursor-pointer btn-update-supplier" data-id="' . $object->id . '">' . $object->name . '</a>';
                        } else {
                            $name = $object->name;
                        }
                        break;
                    case 'tồn kho':
                        $stock = Stock::withTrashed()->find($obj->object_id);
                        $object = $stock->quantity . ' ' . $stock->_variable->unit . ' ' . $stock->_variable->_product->name . ' - ' . $stock->_variable->name;
                        if (!empty(Auth::user()->can(User::READ_STOCK))) {
                            $name = '<a class="cursor-pointer btn-update-stock" data-id="' . $stock->id . '">' . $object . '</a>';
                        } else {
                            $name = $stock->id;
                        }
                        break;
                    case 'chi tiết xuất hàng':
                        $detail = ExportDetail::withTrashed()->find($obj->object_id);
                        $object = $detail->quantity . ' ' . $detail->_stock->_variable->unit . ' ' . $detail->_stock->_variable->_product->name . ' - ' . $detail->_stock->_variable->name;
                        if (!empty(Auth::user()->can(User::READ_EXPORT))) {
                            $name = '<a class="cursor-pointer btn-update-export" data-id="' . $detail->_export->id . '">' . $object . '</a>';
                        } else {
                            $name = $detail->id;
                        }
                        break;
                    case 'chi tiết đơn hàng':
                        $detail = OrderDetail::withTrashed()->find($obj->object_id);
                        $object = $detail->quantity . ' ' . $detail->_stock->_variable->unit . ' ' . $detail->_stock->_variable->_product->name . ' - ' . $detail->_stock->_variable->name;
                        if (!empty(Auth::user()->can(User::READ_ORDER))) {
                            $name = '<a class="cursor-pointer btn-update-order" data-id="' . $detail->_order->id . '">' . $object . '</a>';
                        } else {
                            $name = $detail->id;
                        }
                        break;
                    case 'nhập hàng':
                        $object = Import::withTrashed()->find($obj->object_id);
                        if (!empty(Auth::user()->can(User::READ_IMPORT))) {
                            $name = '<a class="cursor-pointer btn-update-import" data-id="' . $object->id . '">' . $object->id . '</a>';
                        } else {
                            $name = $object->id;
                        }
                        break;
                    case 'xuất hàng':
                        $object = Export::withTrashed()->find($obj->object_id);
                        if (!empty(Auth::user()->can(User::READ_EXPORT))) {
                            $name = '<a class="cursor-pointer btn-update-export" data-id="' . $object->id . '">' . $object->id . '</a>';
                        } else {
                            $name = $object->id;
                        }
                        break;
                    case 'kho hàng':
                        $object = Warehouse::withTrashed()->find($obj->object_id);
                        if (!empty(Auth::user()->can(User::READ_WAREHOUSE))) {
                            $name = '<a class="cursor-pointer btn-update-warehouse" data-id="' . $object->id . '">' . $object->name . '</a>';
                        } else {
                            $name = $object->name;
                        }
                        break;
                    case 'xuất xứ':
                        $object = Origin::withTrashed()->find($obj->object_id);
                        if (!empty(Auth::user()->can(User::READ_ORDER))) {
                            $name = '<a class="cursor-pointer btn-update-origin" data-id="' . $object->id . '">' . $object->name . '</a>';
                        } else {
                            $name = $object->name;
                        }
                        break;
                    case 'tài khoản':
                        $object = User::withTrashed()->find($obj->object_id);
                        if (!empty(Auth::user()->can(User::READ_ORDER))) {
                            $name = '<a class="cursor-pointer btn-update-user" data-id="' . $object->id . '">' . $object->name . '</a>';
                        } else {
                            $name = $object->name;
                        }
                        break;
                    case 'nhóm quyền':
                        if (Role::find($obj->object_id)) {
                            $object = Role::find($obj->object_id)->name;
                        } else {
                            $object = $obj->object_id;
                        }
                        break;
                    case 'cài đặt':
                        $object = Setting::withTrashed()->find($obj->object_id)->key;
                        break;
                    case 'nhật ký':
                        $object = Log::withTrashed()->find($obj->object_id)->id;
                        break;

                    default:
                        $name = 'Không xác định';
                        break;
                }
                return $obj->object . ' ' . $name;
            })
            ->editColumn('location', function ($obj) {
                return $obj->location . ', ' . $obj->country;
            })
            ->rawColumns(['action', 'object'])
            ->make(true);
    }

    public static function create(string $action, string $object, int $object_id)
    {
        $agent = new Agent();
        $ip = Session::get('ip');
        $geolocation = Http::get('https://ipinfo.io/' . $ip . '/json?token=d89e4a0555c438')->json();
        $product = new log([
            "user_id" => Auth::User()->id,
            'action' => $action,
            'object' => $object,
            'object_id' => $object_id,
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
