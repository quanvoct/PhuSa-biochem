<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class Variable extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'variables';
    protected $fillable = [
        'name', 'product_id', 'sub_sku', 'description', 'price',
        'stock', 'length', 'width', 'height', 'weight', 'image', 'revision'
    ];
    public function images()
    {
        return $this->belongsToMany(Image::class, 'product_image')->whereNull('revision');
    }
    public function details()
    {
        return $this->hasMany(Detail::class)->whereNull('revision');
    }
    public function attribute()
    {
        return $this->hasMany(Attribute::class);
    }
    
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    
    public function revisions()
    {
        return $this->hasMany(Variable::class, 'revision');
    }

    public function revision()
    {
        $revision = $this->replicate();
        $revision->created_at = Carbon::now();
        $revision->revision = $this->id;
        $revision->save();
        return true;
    }

    public function price()
    {
        return number_format($this->price);
    }

    public function assignAttribute($attribute, $product)
    {
        $result = DB::table('attribute_product_variable')->insert([
            'attribute_id' => $attribute,
            'product_id' => $product,
            'variable_id' => $this->id,
        ]);
        return $result;
    }
}
