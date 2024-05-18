<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'order_id', 'amount', 'payment', 'user_id', 'cashier_id', 'note', 'status', 'revision', 'date'
    ];
    
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cashier()
    {
        return $this->belongsTo(User::class, 'cashier_id');
    }
    
    public function revisions()
    {
        return $this->hasMany(Transaction::class, 'revision');
    }

    public function revision()
    {
        $revision = $this->replicate();
        $revision->created_at = Carbon::now();
        $revision->revision = $this->id;
        $revision->save();
        return true;
    }

    public function paymentName() {
        return ($this->payment) ? 'Chuyển khoản' : 'Tiền mặt';
    }

    public function statusName() {
        return ($this->status) ? 'Thành công' : 'Hoàn tiền';
    }

    public function paymentStr($boolean) {
        return ($boolean) ? 'Chuyển khoản' : 'Tiền mặt';
    }

    public function statusStr($boolean) {
        return ($boolean) ? 'Thành công' : 'Hoàn tiền';
    }

    public function amountFriendly() {
        return number_format($this->amount);
    }

    public function createdAt() {
        return Carbon::parse($this->created_at)->format('d/m/Y');
    }
}
