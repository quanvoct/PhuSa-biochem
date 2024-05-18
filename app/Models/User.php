<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasRoles, HasFactory, Notifiable, SoftDeletes;
    protected $table = 'users';
    const ACCESS_ADMIN = 'Truy cập trang Quản trị';

    const READ_ORDERS = 'Xem danh sách đơn hàng';
    const READ_ORDER = 'Xem chi tiết đơn hàng';
    const CREATE_ORDER = 'Thêm đơn hàng';
    const EDIT_ORDER = 'Sửa đơn hàng';
    const DEL_ORDER = 'Xoá đơn hàng';
    const DEL_ORDERS = 'Xoá hàng loạt đơn hàng';

    const READ_DETAIL = 'Xem danh sách chi tiết đơn hàng';
    const EDIT_DETAIL = 'Sửa chi tiết đơn hàng';
    const DEL_DETAIL = 'Xoá chi tiết đơn hàng';
    const DEL_DETAILS = 'Xoá hàng loạt chi tiết đơn hàng';

    const READ_TRANSACTIONS = 'Xem danh sách thanh toán';
    const READ_TRANSACTION = 'Xem chi tiết thanh toán';
    const CREATE_TRANSACTION = 'Thêm thanh toán';
    const EDIT_TRANSACTION = 'Sửa thanh toán';
    const DEL_TRANSACTION = 'Xoá thanh toán';
    const DEL_TRANSACTIONS = 'Xoá hàng loạt thanh toán';

    const READ_PROMOTIONS = 'Xem danh sách khuyến mãi';
    const READ_PROMOTION = 'Xem chi tiết khuyến mãi';
    const CREATE_PROMOTION = 'Thêm khuyến mãi';
    const EDIT_PROMOTION = 'Sửa khuyến mãi';
    const DEL_PROMOTION = 'Xoá khuyến mãi';
    const DEL_PROMOTIONS = 'Xoá hàng loạt khuyến mãi';

    const READ_PRODUCTS = 'Xem danh sách sản phẩm';
    const READ_PRODUCT = 'Xem chi tiết sản phẩm';
    const CREATE_PRODUCT = 'Thêm sản phẩm';
    const EDIT_PRODUCT = 'Sửa sản phẩm';
    const DEL_PRODUCT = 'Xoá sản phẩm';
    const DEL_PRODUCTS = 'Xoá hàng loạt sản phẩm';
    
    const READ_CATALOGS = 'Xem danh sách danh mục';
    const READ_CATALOG = 'Xem chi tiết danh mục';
    const CREATE_CATALOG = 'Thêm danh mục';
    const EDIT_CATALOG = 'Sửa danh mục';
    const DEL_CATALOG = 'Xoá danh mục';
    const DEL_CATALOGS = 'Xoá hàng loạt danh mục';

    const READ_ATTRIBUTES = 'Xem danh sách thuộc tính';
    const READ_ATTRIBUTE = 'Xem chi tiết thuộc tính';
    const CREATE_ATTRIBUTE = 'Thêm thuộc tính';
    const EDIT_ATTRIBUTE = 'Sửa thuộc tính';
    const DEL_ATTRIBUTE = 'Xoá thuộc tính';
    const DEL_ATTRIBUTES = 'Xoá hàng loạt thuộc tính';

    const READ_REVIEWS = 'Xem danh sách đánh giá';
    const READ_REVIEW = 'Xem chi tiết đánh giá';
    const CREATE_REVIEW = 'Thêm đánh giá';
    const EDIT_REVIEW = 'Sửa đánh giá';
    const DEL_REVIEW = 'Xoá đánh giá';
    const DEL_REVIEWS = 'Xoá hàng loạt đánh giá';

    const READ_POSTS = 'Xem danh sách bài viết';
    const READ_POST = 'Xem chi tiết bài viết';
    const CREATE_POST = 'Thêm bài viết';
    const EDIT_POST = 'Sửa chi tiết bài viết';
    const DEL_POST = 'Xoá bài viết';
    const DEL_POSTS = 'Xoá hàng loạt bài viết';

    const READ_CATEGORIES = 'Xem danh sách chuyên mục';
    const READ_CATEGORY = 'Xem chi tiết chuyên mục';
    const CREATE_CATEGORY = 'Thêm chuyên mục';
    const EDIT_CATEGORY = 'Sửa chi tiết chuyên mục';
    const DEL_CATEGORY = 'Xoá chuyên mục';
    const DEL_CATEGORIES = 'Xoá hàng loạt chuyên mục';

    const READ_IMAGES = 'Xem tất cả hình ảnh';
    const READ_IMAGE = 'Xem chi tiết hình ảnh';
    const CREATE_IMAGE = 'Thêm hình ảnh';
    const EDIT_IMAGE = 'Sửa chi tiết hình ảnh';
    const DEL_IMAGE = 'Xoá hình ảnh';
    const DEL_IMAGES = 'Xoá hàng loạt hình ảnh';

    const READ_CONTENT = 'Xem chi tiết nội dung';
    const EDIT_CONTENT = 'Sửa chi tiết nội dung';

    const READ_USERS = 'Xem danh sách tài khoản';
    const READ_USER = 'Xem chi tiết tài khoản';
    const CREATE_USER = 'Thêm tài khoản';
    const EDIT_USER = 'Sửa chi tiết tài khoản';
    const BLOCK_USER = 'Khoá tài khoản';
    const DEL_USER = 'Xoá tài khoản';
    const DEL_USERS = 'Xoá hàng loạt tài khoản';

    const READ_ROLES = 'Xem danh sách nhóm quyền';
    const READ_ROLE = 'Xem chi tiết nhóm quyền';
    const CREATE_ROLE = 'Thêm nhóm quyền';
    const EDIT_ROLE = 'Sửa chi tiết nhóm quyền';
    const DEL_ROLE = 'Xoá nhóm quyền';

    const READ_LOGS = 'Xem danh sách nhật ký hệ thống';
    const READ_LOG = 'Xem chi tiết nhật ký hệ thống';
    const DEL_LOG = 'Xoá nhật ký hệ thống';

    const READ_SETTINGS = 'Xem chi tiết thiết lập hệ thống';
    const EDIT_SETTINGS = 'Sửa chi tiết thiết lập hệ thống';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 'email', 'address', 'local_id', 'phone', 'birthday', 'gender', 'tax_name', 'tax_add', 'tax_id', 'password', 'alert',
        'revision', 'status', 'email_verified_at', 'last_login_at'
    ];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_login_at' => 'datetime',
        'birthday' => 'date'
    ];

    public function local() {
        return $this->belongsTo(Local::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'author_id');
    }
    
    public function products()
    {
        return $this->hasMany(Product::class, 'author_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function orders_dealed()
    {
        return $this->hasMany(Order::class, 'dealer_id');
    }
    
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
    
    public function transactions_cashed()
    {
        return $this->hasMany(Transaction::class, 'cashier_id');
    }
    
    public function preferences()
    {
        return $this->hasMany(Preference::class);
    }
    
    public function revisions()
    {
        return $this->hasMany(User::class, 'revision');
    }

    public function revision()
    {
        $revision = $this->replicate();
        $revision->created_at = Carbon::now();
        $revision->revision = $this->id;
        $revision->save();
        return true;
    }

    public function shortName() {
        $shortName = explode(' ', $this->name);
        return $shortName[count($shortName) - 1];
    }
    
    public function districts()
    {
        return Local::whereCity($this->local->city)->pluck('district', 'id');
    }

    public function reviews() {
        return $this->hasMany(Review::class);
    }

    public function promotions() {
        return $this->belongsToMany(Promotion::class);
    }

    public function lastLoginAt() {
        return Carbon::parse($this->last_login_at)->format('d/m/Y');
    }

    public function createdAt() {
        return Carbon::parse($this->created_at)->format('d/m/Y');
    }

    public function phoneFriendly() {
        if (preg_match('/^(\d{4})(\d{3})(\d{3})$/', $this->phone, $matches)) {
            $formattedPhone = $matches[1] . ' ' . $matches[2] . ' ' . $matches[3];
        } else {
            $formattedPhone = $this->phone; // Giữ nguyên số điện thoại nếu không khớp
        }
        return $formattedPhone;
    }
}
