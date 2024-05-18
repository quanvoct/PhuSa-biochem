<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Promotion extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'promotions';
    protected $fillable = [
        'name',
        'type',
        'coupon',
        'condition_users',
        'condition_products',
        'condition_min',
        'condition_max',
        'result_products',
        'result_value',
        'date_begin',
        'date_end',
        'times',
        'separate_apply',
        'separate_account',
        'status',
        'revision',
    ];

    public function orders()
    {
        return $this->belongsToMany(Order::class)->whereNull('revision');
    }

    public function dateBegin()
    {
        return Carbon::parse($this->date_begin)->format('d/m/Y');
    }

    public function dateEnd()
    {
        return Carbon::parse($this->date_end)->format('d/m/Y');
    }

    public function applyName()
    {
        return ($this->separate_apply) ? 'Riêng lẻ' : 'Đồng thời';
    }

    public function revisions()
    {
        return $this->hasMany(Promotion::class, 'revision');
    }

    public function revision()
    {
        $revision = $this->replicate();
        $revision->created_at = Carbon::now();
        $revision->revision = $this->id;
        $revision->save();
        return true;
    }
}
