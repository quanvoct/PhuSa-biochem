<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasRoles, HasFactory, Notifiable, SoftDeletes;
    protected $appends = ['phoneStr', 'statusStr', 'genderStr', 'fullAddress', 'imageUrl'];
    protected $table = 'users';
    
    const READ_ORDERS = 'Xem danh sách đơn hàng';
    const READ_ORDER = 'Xem chi tiết đơn hàng';
    const CREATE_ORDER = 'Thêm đơn hàng';
    const UPDATE_ORDER = 'Sửa đơn hàng';
    const DELETE_ORDER = 'Xoá đơn hàng';
    const DELETE_ORDERS = 'Xoá hàng loạt đơn hàng';

    const READ_DETAIL = 'Xem danh sách chi tiết đơn hàng';
    const UPDATE_DETAIL = 'Sửa chi tiết đơn hàng';
    const DELETE_DETAIL = 'Xoá chi tiết đơn hàng';
    const DELETE_DETAILS = 'Xoá hàng loạt chi tiết đơn hàng';

    const READ_DEBTS = 'Xem danh sách công nợ';
    const READ_TRANSACTIONS = 'Xem danh sách thanh toán';
    const READ_TRANSACTION = 'Xem chi tiết thanh toán';
    const CREATE_TRANSACTION = 'Thêm thanh toán';
    const UPDATE_TRANSACTION = 'Sửa thanh toán';
    const DELETE_TRANSACTION = 'Xoá thanh toán';
    const DELETE_TRANSACTIONS = 'Xoá hàng loạt thanh toán';

    const READ_PROMOTIONS = 'Xem danh sách khuyến mãi';
    const READ_PROMOTION = 'Xem chi tiết khuyến mãi';
    const CREATE_PROMOTION = 'Thêm khuyến mãi';
    const UPDATE_PROMOTION = 'Sửa khuyến mãi';
    const DELETE_PROMOTION = 'Xoá khuyến mãi';
    const DELETE_PROMOTIONS = 'Xoá hàng loạt khuyến mãi';

    const READ_PRODUCTS = 'Xem danh sách sản phẩm';
    const READ_PRODUCT = 'Xem chi tiết sản phẩm';
    const CREATE_PRODUCT = 'Thêm sản phẩm';
    const UPDATE_PRODUCT = 'Sửa sản phẩm';
    const DELETE_PRODUCT = 'Xoá sản phẩm';
    const DELETE_PRODUCTS = 'Xoá hàng loạt sản phẩm';

    const CREATE_VARIABLE = 'Thêm biến thể';
    const UPDATE_VARIABLE = 'Sửa biến thể';
    const DELETE_VARIABLE = 'Xoá biến thể';
    
    const READ_CATALOGUES = 'Xem danh sách danh mục';
    const READ_CATALOGUE = 'Xem chi tiết danh mục';
    const CREATE_CATALOGUE = 'Thêm danh mục';
    const UPDATE_CATALOGUE = 'Sửa danh mục';
    const DELETE_CATALOGUE = 'Xoá danh mục';
    const DELETE_CATALOGUES = 'Xoá hàng loạt danh mục';

    const READ_ATTRIBUTES = 'Xem danh sách thuộc tính';
    const READ_ATTRIBUTE = 'Xem chi tiết thuộc tính';
    const CREATE_ATTRIBUTE = 'Thêm thuộc tính';
    const UPDATE_ATTRIBUTE = 'Sửa thuộc tính';
    const DELETE_ATTRIBUTE = 'Xoá thuộc tính';
    const DELETE_ATTRIBUTES = 'Xoá hàng loạt thuộc tính';

    const READ_REVIEWS = 'Xem danh sách đánh giá';
    const READ_REVIEW = 'Xem chi tiết đánh giá';
    const CREATE_REVIEW = 'Thêm đánh giá';
    const UPDATE_REVIEW = 'Sửa đánh giá';
    const DELETE_REVIEW = 'Xoá đánh giá';
    const DELETE_REVIEWS = 'Xoá hàng loạt đánh giá';

    const READ_POSTS = 'Xem danh sách bài viết';
    const READ_POST = 'Xem chi tiết bài viết';
    const CREATE_POST = 'Thêm bài viết';
    const UPDATE_POST = 'Sửa chi tiết bài viết';
    const DELETE_POST = 'Xoá bài viết';
    const DELETE_POSTS = 'Xoá hàng loạt bài viết';

    const READ_CATEGORIES = 'Xem danh sách chuyên mục';
    const READ_CATEGORY = 'Xem chi tiết chuyên mục';
    const CREATE_CATEGORY = 'Thêm chuyên mục';
    const UPDATE_CATEGORY = 'Sửa chi tiết chuyên mục';
    const DELETE_CATEGORY = 'Xoá chuyên mục';
    const DELETE_CATEGORIES = 'Xoá hàng loạt chuyên mục';

    const READ_IMAGES = 'Xem tất cả hình ảnh';
    const READ_IMAGE = 'Xem chi tiết hình ảnh';
    const CREATE_IMAGE = 'Thêm hình ảnh';
    const UPDATE_IMAGE = 'Sửa chi tiết hình ảnh';
    const DELETE_IMAGE = 'Xoá hình ảnh';
    const DELETE_IMAGES = 'Xoá hàng loạt hình ảnh';
    
    const READ_USERS = 'Xem danh sách tài khoản';
    const READ_USER = 'Xem chi tiết tài khoản';
    const CREATE_USER = 'Thêm tài khoản';
    const UPDATE_USER = 'Sửa chi tiết tài khoản';
    const BLOCK_USER = 'Khoá tài khoản';
    const DELETE_USER = 'Xoá tài khoản';
    const DELETE_USERS = 'Xoá hàng loạt tài khoản';

    const READ_ROLES = 'Xem danh sách nhóm quyền';
    const READ_ROLE = 'Xem chi tiết nhóm quyền';
    const CREATE_ROLE = 'Thêm nhóm quyền';
    const UPDATE_ROLE = 'Sửa chi tiết nhóm quyền';
    const DELETE_ROLE = 'Xoá nhóm quyền';
    const DELETE_ROLES = 'Xoá hàng loạt nhóm quyền';

    const READ_LOGS = 'Xem danh sách nhật ký hệ thống';
    const READ_LOG = 'Xem chi tiết nhật ký hệ thống';
    const DELETE_LOG = 'Xoá nhật ký hệ thống';

    const ACCESS_ADMIN = 'Truy cập trang Quản trị';
    const READ_SETTINGS = 'Xem chi tiết thiết lập hệ thống';
    const UPDATE_SETTINGS = 'Sửa chi tiết thiết lập hệ thống';
    const UPDATE_CONFIG = 'Xem chi tiết cài đặt cửa hàng';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 'email', 'address', 'country', 'city', 'zip', 'phone', 'birthday', 'gender', 'password', 'image',
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

    public function getGenderStrAttribute()
    {
        $result = '';
        if ($this->gender == 2) {
            $result = 'Khác';
        } else if ($this->gender == 1) {
            $result = 'Nữ';
        } else {
            $result = 'Nam';
        }
        return $result;
    }

    public function getPhoneStrAttribute() {
        if (preg_match('/^(\d{4})(\d{3})(\d{3})$/', $this->phone, $matches)) {
            $formattedPhone = $matches[1] . ' ' . $matches[2] . ' ' . $matches[3];
        } else {
            $formattedPhone = $this->phone; // Giữ nguyên số điện thoại nếu không khớp
        }
        return $formattedPhone;
    }

    public function getStatusStrAttribute()
    {
        return ($this->status) ? 'Kích hoạt' : 'Đã khóa';
    }

    public function getFullAddressAttribute()
    {
        $address = $this->address ? $this->address . ', ' : '';
        $location = $this->local ? ($this->local->district . ', ' . $this->local->city) : '';
        $fullAddress = $address . $location;
        return $fullAddress ?: "Không có";
    }

    public function getImageUrlAttribute()
    {
        $path = 'public/user/' . $this->image;
        if ($this->image && Storage::exists($path)) {
            $image = asset(env('FILE_STORAGE') . '/user/' . $this->image);
        } else {
            $image = asset('admin/images/placeholder.webp');
        }
        return $image;
    }
}