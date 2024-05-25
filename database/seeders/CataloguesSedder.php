<?php

namespace Database\Seeders;

use App\Models\Catalogue;
use Illuminate\Database\Seeder;

class CataloguesSedder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $catalogues = [
            [1, 'Sinh phẩm', 'sinh-pham', NULL, 'sinh-pham-home.png', 8, 1, NULL],
            [2, 'Hóa chất PCR', 'hoa-chat-pcr', NULL, NULL, 2, 1, 1],
            [3, 'Sinh phẩm chẩn đoán', 'sinh-pham-chan-doan', NULL, NULL, 3, 1, 1],
            [4, 'Hóa chất điện di', 'hoa-chat-dien-di', NULL, NULL, 4, 1, 1],
            [5, 'SARS-CoV-2', 'sars-cov-2', NULL, NULL, 5, 1, 3],
            [6, 'Monkeypox', 'monkeypox', NULL, NULL, 6, 1, 3],
            [7, 'Hóa chất tạo dòng', 'hoa-chat-tao-dong', NULL, NULL, 7, 1, 1],
            [11, 'Thiết bị', 'thiet-bi', NULL, 'thiet-bi-home.png', 1, 1, NULL],
            [12, 'Máy PCR', 'may-pcr', NULL, NULL, 9, 1, 11],
            [13, 'Máy điện di', 'may-dien-di', NULL, NULL, 10, 1, 11],
            [14, 'Máy tách chiết', 'may-tach-chiet', NULL, NULL, 11, 1, 11],
            [15, 'Máy spot check', 'may-spot-check', NULL, NULL, 12, 1, 11],
            [16, 'Thiết bị khác', 'thiet-bi-khac', NULL, NULL, 13, 1, 11],
            [18, 'Gói tiện ích', 'goi-tien-ich', NULL, 'goi-tien-ich-home.png', 14, 1, NULL],
            [19, 'Combo thực hành', 'combo-thuc-hanh', NULL, NULL, 15, 1, 18],
            [21, 'Dịch vụ', 'dich-vu', NULL, 'dich-vu-home.png', 19, 1, NULL],
            [22, 'Tổng hợp gene', 'tong-hop-gene', NULL, NULL, 17, 1, 21],
            [24, 'Dịch vụ khác', 'dich-vu-khac', NULL, NULL, 18, 1, 21],
            [25, 'Kit chẩn đoán', 'kit-chan-doan', NULL, 'kit-chan-doan-home.png', 16, 1, NULL],
            [26, 'Kit chẩn đoán bệnh tôm', 'kit-chan-doan-benh-tom', NULL, NULL, 20, 1, 25],
            [27, 'Kit chẩn đoán bệnh cá tra', 'kit-chan-doan-benh-ca-tra', NULL, NULL, 21, 1, 25],
            [28, 'Kit chẩn đoán bệnh cá rô phi', 'kit-chan-doan-benh-ca-ro-phi', NULL, NULL, 22, 1, 25],
            [29, 'Kit phát hiện GMO', 'kit-phat-hien-gmo', NULL, NULL, 23, 1, 25],
            [30, 'Kit phát hiện DNA động vật', 'kit-phat-hien-dna-dong-vat', NULL, NULL, 24, 1, 25],
        ];

        foreach ($catalogues as $key => $catalogue) {
            Catalogue::create([
                'id' => $catalogue[0],
                'name' => $catalogue[1],
                'slug' => $catalogue[2],
                'description' => $catalogue[3],
                'image' => $catalogue[4],
                'sort' => $catalogue[5],
                'status' => $catalogue[6],
                'parent_id' => $catalogue[7],
            ]);
        }
    }
}
