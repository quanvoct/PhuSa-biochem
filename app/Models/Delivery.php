<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Delivery extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'deliveries';
    protected $fillable = [
        'order_id', 'name', 'address', 'local_id', 'phone',
        'email', 'bol_no', 'service', 'fee', 'status',
        'revision'
    ];

    public function order() {
        return $this->belongsTo(Order::class);
    }

    public function local() {
        return $this->belongsTo(Local::class);
    }
    
    public function revisions()
    {
        return $this->hasMany(Delivery::class, 'revision');
    }

    public function revision()
    {
        $revision = $this->replicate();
        $revision->created_at = Carbon::now();
        $revision->revision = $this->id;
        $revision->save();
        return true;
    }
    
    public function districts()
    {
        return Local::whereCity($this->local->city)->pluck('district', 'id');
    }

    public function shortName() {
        $shortName = explode(' ', $this->name);
        return $shortName[count($shortName) - 1];
    }

    public function phoneFriendly() {
        if (preg_match('/^(\d{4})(\d{3})(\d{3})$/', $this->phone, $matches)) {
            $formattedPhone = $matches[1] . ' ' . $matches[2] . ' ' . $matches[3];
        } else {
            $formattedPhone = $this->phone; // Giữ nguyên số điện thoại nếu không khớp
        }
        return $formattedPhone;
    }

    public function feeFriendly() {
        return number_format($this->fee);
    }

    public function statusName()
    {
        switch ($this->status) {
            case '1':
                $status = 'Đã gửi';
                break;

            default:
                $status = 'Đang chờ';
                break;
        }
        return $status;
    }
}
