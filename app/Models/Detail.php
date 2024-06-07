<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Detail extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'details';
    protected $appends = array('statusStr');
    protected $fillable = [
        'order_id', 'variable_id', 'quantity', 
        'unit_price', 'status', 'revision', 'appointmented_at'
    ];
    
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function variable()
    {
        return $this->belongsTo(Variable::class);
    }

    public function revisions()
    {
        return $this->hasMany(Detail::class, 'revision');
    }

    public function revision()
    {
        $revision = $this->replicate();
        $revision->created_at = Carbon::now();
        $revision->revision = $this->id;
        $revision->save();
        return true;
    }

    public function total()
    {
        return $this->quantity * $this->unit_price;
    }

    public function totalFriendly()
    {
        return number_format($this->quantity * $this->unit_price);
    }

    public function appointmentedAt() {
        return Carbon::parse($this->appointmented_at)->format('d/m/Y');
    }

    public function getStatusStrAttribute()
    {
        switch ($this->status) {
            case '1':
                $name = __('Enable');
                break;

            default:
                $name = __('Disabled');
                break;
        }
        return $name;
    }
}
