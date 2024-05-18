<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            ['guard_name' => 'web', 'section' => 'Đơn hàng', 'name' => 'Xem danh sách đơn hàng'],
            ['guard_name' => 'web', 'section' => 'Đơn hàng', 'name' => 'Xem chi tiết đơn hàng'],
            ['guard_name' => 'web', 'section' => 'Đơn hàng', 'name' => 'Thêm đơn hàng'],
            ['guard_name' => 'web', 'section' => 'Đơn hàng', 'name' => 'Sửa đơn hàng'],
            ['guard_name' => 'web', 'section' => 'Đơn hàng', 'name' => 'Xoá đơn hàng'],
            ['guard_name' => 'web', 'section' => 'Đơn hàng', 'name' => 'Xoá hàng loạt đơn hàng'],

            ['guard_name' => 'web', 'section' => 'Chi tiết đơn hàng', 'name' => 'Xem danh sách chi tiết đơn hàng'],
            ['guard_name' => 'web', 'section' => 'Chi tiết đơn hàng', 'name' => 'Sửa chi tiết đơn hàng'],
            ['guard_name' => 'web', 'section' => 'Chi tiết đơn hàng', 'name' => 'Xoá chi tiết đơn hàng'],
            ['guard_name' => 'web', 'section' => 'Chi tiết đơn hàng', 'name' => 'Xoá hàng loạt chi tiết đơn hàng'],

            ['guard_name' => 'web', 'section' => 'Thanh toán', 'name' => 'Xem danh sách thanh toán'],
            ['guard_name' => 'web', 'section' => 'Thanh toán', 'name' => 'Xem chi tiết thanh toán'],
            ['guard_name' => 'web', 'section' => 'Thanh toán', 'name' => 'Thêm thanh toán'],
            ['guard_name' => 'web', 'section' => 'Thanh toán', 'name' => 'Sửa thanh toán'],
            ['guard_name' => 'web', 'section' => 'Thanh toán', 'name' => 'Xoá thanh toán'],
            ['guard_name' => 'web', 'section' => 'Thanh toán', 'name' => 'Xoá hàng loạt thanh toán'],

            ['guard_name' => 'web', 'section' => 'Khuyến mãi', 'name' => 'Xem danh sách khuyến mãi'],
            ['guard_name' => 'web', 'section' => 'Khuyến mãi', 'name' => 'Xem chi tiết khuyến mãi'],
            ['guard_name' => 'web', 'section' => 'Khuyến mãi', 'name' => 'Thêm khuyến mãi'],
            ['guard_name' => 'web', 'section' => 'Khuyến mãi', 'name' => 'Sửa khuyến mãi'],
            ['guard_name' => 'web', 'section' => 'Khuyến mãi', 'name' => 'Xoá khuyến mãi'],
            ['guard_name' => 'web', 'section' => 'Khuyến mãi', 'name' => 'Xoá hàng loạt khuyến mãi'],

            ['guard_name' => 'web', 'section' => 'Sản phẩm', 'name' => 'Xem danh sách sản phẩm'],
            ['guard_name' => 'web', 'section' => 'Sản phẩm', 'name' => 'Xem chi tiết sản phẩm'],
            ['guard_name' => 'web', 'section' => 'Sản phẩm', 'name' => 'Thêm sản phẩm'],
            ['guard_name' => 'web', 'section' => 'Sản phẩm', 'name' => 'Sửa sản phẩm'],
            ['guard_name' => 'web', 'section' => 'Sản phẩm', 'name' => 'Xoá sản phẩm'],
            ['guard_name' => 'web', 'section' => 'Sản phẩm', 'name' => 'Xoá hàng loạt sản phẩm'],
            
            ['guard_name' => 'web', 'section' => 'Danh mục', 'name' => 'Xem danh sách danh mục'],
            ['guard_name' => 'web', 'section' => 'Danh mục', 'name' => 'Xem chi tiết danh mục'],
            ['guard_name' => 'web', 'section' => 'Danh mục', 'name' => 'Thêm danh mục'],
            ['guard_name' => 'web', 'section' => 'Danh mục', 'name' => 'Sửa danh mục'],
            ['guard_name' => 'web', 'section' => 'Danh mục', 'name' => 'Xoá danh mục'],
            ['guard_name' => 'web', 'section' => 'Danh mục', 'name' => 'Xoá hàng loạt danh mục'],

            ['guard_name' => 'web', 'section' => 'Thuộc tính', 'name' => 'Xem danh sách thuộc tính'],
            ['guard_name' => 'web', 'section' => 'Thuộc tính', 'name' => 'Xem chi tiết thuộc tính'],
            ['guard_name' => 'web', 'section' => 'Thuộc tính', 'name' => 'Thêm thuộc tính'],
            ['guard_name' => 'web', 'section' => 'Thuộc tính', 'name' => 'Sửa thuộc tính'],
            ['guard_name' => 'web', 'section' => 'Thuộc tính', 'name' => 'Xoá thuộc tính'],
            ['guard_name' => 'web', 'section' => 'Thuộc tính', 'name' => 'Xoá hàng loạt thuộc tính'],

            ['guard_name' => 'web', 'section' => 'Đánh giá', 'name' => 'Xem danh sách đánh giá'],
            ['guard_name' => 'web', 'section' => 'Đánh giá', 'name' => 'Xem chi tiết đánh giá'],
            ['guard_name' => 'web', 'section' => 'Đánh giá', 'name' => 'Thêm đánh giá'],
            ['guard_name' => 'web', 'section' => 'Đánh giá', 'name' => 'Sửa đánh giá'],
            ['guard_name' => 'web', 'section' => 'Đánh giá', 'name' => 'Xoá đánh giá'],
            ['guard_name' => 'web', 'section' => 'Đánh giá', 'name' => 'Xoá hàng loạt đánh giá'],

            ['guard_name' => 'web', 'section' => 'Bài viết', 'name' => 'Xem danh sách bài viết'],
            ['guard_name' => 'web', 'section' => 'Bài viết', 'name' => 'Xem chi tiết bài viết'],
            ['guard_name' => 'web', 'section' => 'Bài viết', 'name' => 'Thêm bài viết'],
            ['guard_name' => 'web', 'section' => 'Bài viết', 'name' => 'Sửa chi tiết bài viết'],
            ['guard_name' => 'web', 'section' => 'Bài viết', 'name' => 'Xoá bài viết'],
            ['guard_name' => 'web', 'section' => 'Bài viết', 'name' => 'Xoá hàng loạt bài viết'],

            ['guard_name' => 'web', 'section' => 'Chuyên mục', 'name' => 'Xem danh sách chuyên mục'],
            ['guard_name' => 'web', 'section' => 'Chuyên mục', 'name' => 'Xem chi tiết chuyên mục'],
            ['guard_name' => 'web', 'section' => 'Chuyên mục', 'name' => 'Thêm chuyên mục'],
            ['guard_name' => 'web', 'section' => 'Chuyên mục', 'name' => 'Sửa chi tiết chuyên mục'],
            ['guard_name' => 'web', 'section' => 'Chuyên mục', 'name' => 'Xoá chuyên mục'],
            ['guard_name' => 'web', 'section' => 'Chuyên mục', 'name' => 'Xoá hàng loạt chuyên mục'],

            ['guard_name' => 'web', 'section' => 'Hình ảnh', 'name' => 'Xem tất cả hình ảnh'],
            ['guard_name' => 'web', 'section' => 'Hình ảnh', 'name' => 'Xem chi tiết hình ảnh'],
            ['guard_name' => 'web', 'section' => 'Hình ảnh', 'name' => 'Thêm hình ảnh'],
            ['guard_name' => 'web', 'section' => 'Hình ảnh', 'name' => 'Sửa chi tiết hình ảnh'],
            ['guard_name' => 'web', 'section' => 'Hình ảnh', 'name' => 'Xoá hình ảnh'],
            ['guard_name' => 'web', 'section' => 'Hình ảnh', 'name' => 'Xoá hàng loạt hình ảnh'],

            ['guard_name' => 'web', 'section' => 'Tài khoản', 'name' => 'Xem danh sách tài khoản'],
            ['guard_name' => 'web', 'section' => 'Tài khoản', 'name' => 'Xem chi tiết tài khoản'],
            ['guard_name' => 'web', 'section' => 'Tài khoản', 'name' => 'Thêm tài khoản'],
            ['guard_name' => 'web', 'section' => 'Tài khoản', 'name' => 'Sửa chi tiết tài khoản'],
            ['guard_name' => 'web', 'section' => 'Tài khoản', 'name' => 'Khoá tài khoản'],
            ['guard_name' => 'web', 'section' => 'Tài khoản', 'name' => 'Xoá tài khoản'],
            ['guard_name' => 'web', 'section' => 'Tài khoản', 'name' => 'Xoá hàng loạt tài khoản'],

            ['guard_name' => 'web', 'section' => 'Cấp quyền', 'name' => 'Xem danh sách nhóm quyền'],
            ['guard_name' => 'web', 'section' => 'Cấp quyền', 'name' => 'Xem chi tiết nhóm quyền'],
            ['guard_name' => 'web', 'section' => 'Cấp quyền', 'name' => 'Thêm nhóm quyền'],
            ['guard_name' => 'web', 'section' => 'Cấp quyền', 'name' => 'Sửa chi tiết nhóm quyền'],
            ['guard_name' => 'web', 'section' => 'Cấp quyền', 'name' => 'Xoá nhóm quyền'],

            ['guard_name' => 'web', 'section' => 'Nhật ký', 'name' => 'Xem danh sách nhật ký hệ thống'],
            ['guard_name' => 'web', 'section' => 'Nhật ký', 'name' => 'Xem chi tiết nhật ký hệ thống'],
            ['guard_name' => 'web', 'section' => 'Nhật ký', 'name' => 'Sửa chi tiết nhật ký hệ thống'],
            ['guard_name' => 'web', 'section' => 'Nhật ký', 'name' => 'Xoá nhật ký hệ thống'],

            ['guard_name' => 'web', 'section' => 'Thiết lập', 'name' => 'Truy cập trang Quản trị'],
            ['guard_name' => 'web', 'section' => 'Thiết lập', 'name' => 'Xem chi tiết thiết lập hệ thống'],
            ['guard_name' => 'web', 'section' => 'Thiết lập', 'name' => 'Sửa chi tiết thiết lập hệ thống'],
            ['guard_name' => 'web', 'section' => 'Thiết lập', 'name' => 'Xem chi tiết cài đặt cửa hàng'],
            ['guard_name' => 'web', 'section' => 'Thiết lập', 'name' => 'Sửa chi tiết cài đặt cửa hàng'],
        ];

        foreach ($permissions as $permission) {
            DB::table('permissions')->insert($permission);
        }
    }
}
