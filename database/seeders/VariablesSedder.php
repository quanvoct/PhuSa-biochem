<?php

namespace Database\Seeders;

use App\Models\Variable;
use Illuminate\Database\Seeder;

class VariablesSedder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $variables = [
            [null, 1, null, 'Trọn bộ máy điện di đứng VE100', 've100.png', 22000000, 20, 14, 30, 4, 1],
            [null, 6, null, 'Trọn bộ máy điện di DNS E100', NULL, 27500000, 18, 14, 25, 2.7, 1],
            ['E gen Positive Control', 13, 'E gen Positive Control', '<table class="table table-striped table-hover"> <tr> <td>Mã sản phẩm</td> <td>E gen Positive Control</td> </tr> <tr> <td>Quy cách</td> <td>50 µl</td> </tr> <tr> <td>Thời gian giao hàng</td> <td>5-7 ngày</td> </tr> </table>', NULL, 2000000, NULL, NULL, NULL, 2.5, 1],
            ['RdRp gen Positive Control', 13, 'RdRp gen Positive Control', '<table class="table table-striped table-hover"> <tr> <td>Mã sản phẩm</td> <td>RdRp gen Positive Control </td> </tr> <tr> <td>Quy cách</td> <td>50 µl </td> </tr> <tr> <td>Thời gian giao hàng</td> <td>5-7 ngày </td> </tr> </table>', NULL, 2000000, NULL, NULL, NULL, 2.5, 1],
            ['RP gen Positive Control', 13, 'RP gen Positive Control', '<table class="table table-striped table-hover"> <tr> <td>Mã sản phẩm</td> <td>RP gen Positive Control </td> </tr> <tr> <td>Quy cách</td> <td>50 µl </td> </tr> <tr> <td>Thời gian giao hàng</td> <td>5-7 ngày </td> </tr> </table>', NULL, 2000000, NULL, NULL, NULL, 2.5, 1],
            ['E gen Primer-Probe Mix', 14, 'E gen Primer-Probe Mix', '<table class="table table-striped table-hover"> <tr> <td>Mã sản phẩm</td> <td>E gen Primer-Probe Mix </td> </tr> <tr> <td>Quy cách</td> <td>500 preps </td> </tr> <tr> <td>Thời gian giao hàng</td> <td>5-7 ngày </td> </tr> </table>', NULL, 3000000, NULL, NULL, NULL, 0.5, 1],
            ['RdRP gen Primer-Probe Mix', 14, 'RdRP gen Primer-Probe Mix', '<table class="table table-striped table-hover"> <tr> <td>Mã sản phẩm</td> <td>RdRP gen Primer-Probe Mix </td> </tr> <tr> <td>Quy cách</td> <td>500 preps </td> </tr> <tr> <td>Thời gian giao hàng</td> <td>5-7 ngày </td> </tr> </table>', NULL, 3000000, NULL, NULL, NULL, 0.5, 1],
            ['RP gen Primer-Probe Mix', 14, 'RP gen Primer-Probe Mix', '<table class="table table-striped table-hover"> <tr> <td>Mã sản phẩm</td> <td>RP gen Primer-Probe Mix </td> </tr> <tr> <td>Quy cách</td> <td>500 preps </td> </tr> <tr> <td>Thời gian giao hàng</td> <td>5-7 ngày </td> </tr> </table>', NULL, 3000000, NULL, NULL, NULL, 0.5, 1],
        ];
        foreach ($variables as $key => $variable) {
            Variable::create([
                'name' => $variable[0],
                'product_id' => $variable[1],
                'sub_sku' => $variable[2],
                'description' => $variable[3],
                'image' => $variable[4],
                'price' => $variable[5],
                'height' => $variable[6],
                'width' => $variable[7],
                'length' => $variable[8],
                'weight' => $variable[9],
                'status' => $variable[10],
            ]);
        }
    }
}
