<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = ['cart_id', 'variable_id', 'quantity', 'price', 'options'];

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function variable()
    {
        return $this->belongsTo(Variable::class);
    }

    public function promotion()
    {
        return $this->belongsTo(Promotion::class);
    }
}

