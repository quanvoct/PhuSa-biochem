<?php

namespace App\Http\Controllers;

use App\Models\Catalogue;
use App\Models\Category;
use Jenssegers\Agent\Agent;
use App\Models\Setting;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Session;

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
