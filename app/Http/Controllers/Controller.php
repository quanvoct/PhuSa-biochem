<?php

namespace App\Http\Controllers;

use App\Models\Catalogue;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\Setting;
use App\Models\User;
use App\Models\Variable;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Jenssegers\Agent\Agent;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    const VALIDATE = [
        'required' => 'Không được để trống thông tin này!',
        'invalid' => 'Dữ liệu không hợp lệ!',
        'unique' => 'Thông tin đã tồn tại!',
        'min2' => 'Tối thiểu phải từ 2 ký tự!',
        'max191' => 'Tối đa được 191 ký tự!',
    ];
    public function options(): array
    {
        return array(
            'categories' => Category::whereNull('revision')->where('status', 1)->orderBy('sort', 'ASC')
            ->with(['posts' => function($query) {
                $query->where('status', 1);
            }])
            ->get(),
            'variables' => Variable::whereNull('revision')->get(),
            'catalogue' => Catalogue::whereNull('revision')->whereStatus(1)->orderBy('sort', 'ASC')->get(),
        );
    }


    public function getSettings()
    {
        if (Session::has('settings')) {
            $settings = Session::get('settings', Setting::pluck('value', 'key'));
        } else {
            $settings = Setting::pluck('value', 'key');
        }
        Session::put('settings', $settings);
        return $settings;
    }

    public function getCatalogueChildren($catalogues)
    {
        foreach ($catalogues as $key => $catalogue) {
            if (count($catalogue->children)) {
                $this->getCatalogueChildren(($catalogue->children));
            }
        }
        return $catalogues;
    }
}
