<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'orders';
    protected $fillable = [
        'customer_id', 'name', 'phone', 'email', 'address', 'local_id', 'dealer_id', 'method', 'status', 'note',
        'revision', 'created_at'
    ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function local()
    {
        return $this->belongsTo(Local::class);
    }

    public function dealer()
    {
        return $this->belongsTo(User::class, 'dealer_id');
    }

    public function delivery()
    {
        return $this->hasOne(Delivery::class);
    }

    public function details()
    {
        return $this->hasMany(Detail::class)->whereNull('revision');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class)->whereNull('revision');
    }

    public function revisions()
    {
        return $this->hasMany(Order::class, 'revision');
    }
    
    public function districts()
    {
        return Local::whereCity($this->local->city)->pluck('district', 'id');
    }

    public function revision()
    {
        $revision = $this->replicate();
        $revision->created_at = Carbon::now();
        $revision->revision = $this->id;
        $revision->save();
        return true;
    }

    public function promotions() {
        return $this->belongsToMany(Promotion::class);
    }

    public function total() {
        return $this->details->where('status', 1)->sum('quantity * unit_price');
    }

    public function paid() {
        return $this->transactions->where('status', 1)->sum('amount');
    }

    public function createdAt() {
        return Carbon::parse($this->created_at)->format('d/m/Y');
    }

    public function statusName()
    {
        switch ($this->status) {
            case '3':
                $status = 'Hoàn thành';
                break;
            case '2':
                $status = 'Đang xử lý';
                break;
            case '1':
                $status = 'Đã đặt hàng';
                break;
            default:
                $status = 'Đã huỷ';
                break;
        }
        return $status;
    }

    static function statusStr($num)
    {
        switch ($num) {
            case '3':
                $status = 'Hoàn thành';
                break;
            case '2':
                $status = 'Đang xử lý';
                break;
            case '1':
                $status = 'Đã đặt hàng';
                break;
            default:
                $status = 'Đã huỷ';
                break;
        }
        return $status;
    }

    public function methodName()
    {
        switch ($this->method) {
            case '2':
                $method = 'Công nợ';
                break;
            case '1':
                $method = 'Thanh toán sau';
                break;
            default:
                $method = 'Thanh toán trước';
                break;
        }
        return $method;
    }

    static function methodStr($num)
    {
        switch ($num) {
            case '2':
                $method = 'Công nợ';
                break;
            case '1':
                $method = 'Thanh toán sau';
                break;
            default:
                $method = 'Thanh toán trước';
                break;
        }
        return $method;
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
