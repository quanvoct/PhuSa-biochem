<?php

namespace App\Models;

use Carbon\Carbon;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'products';
    protected $fillable = [
        'name', 'sku', 'slug', 'author_id', 'excerpt', 'description',
        'image', 'images', 'order', 'stock', 'unit', 'specs',
        'keyword', 'status', 'allow_review', 'upsales', 'revision'
    ];

    public function catalogues()
    {
        return $this->belongsToMany(Catalogue::class)->whereNull('revision');
    }

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'attribute_product_variable')->whereNull('revision');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class)->whereNull('revision');
    }

    public function variables()
    {
        return $this->hasMany(Variable::class)->whereNull('revision');
    }

    public function promotions()
    {
        return $this->belongsToMany(Promotion::class)->whereNull('revision');
    }

    public function revisions()
    {
        return $this->hasMany(Product::class, 'revision');
    }

    public function revision()
    {
        $revision = $this->replicate();
        $revision->created_at = Carbon::now();
        $revision->revision = $this->id;
        $revision->save();
        return true;
    }

    public function createdAt()
    {
        return ($this->created_at) ? Carbon::parse($this->created_at)->format('H:i:s d/m/Y') : '';
    }

    public function createdDate()
    {
        return ($this->created_at) ? Carbon::parse($this->created_at)->format('Y-m-d') : '';
    }

    public function createdTime()
    {
        return ($this->created_at) ? Carbon::parse($this->created_at)->format('H:i:s') : '';
    }

    public function statusName()
    {
        switch ($this->status) {
            case '2':
                $status = 'Nổi bật';
                break;

            case '1':
                $status = 'Hiển thị';
                break;

            default:
                $status = 'Không hiển thị';
                break;
        }
        return $status;
    }

    public function keywords()
    {
        return explode(',', $this->keyword);
    }

    public function upsales()
    {
        $upsales = explode('|', $this->upsales);
        foreach ($upsales as $key => $upsale) {
            $upsale = self::find($upsale);
        }
        return $upsales;
    }

    public function imagesUrl()
    {
        $images = explode('|', $this->images);
        foreach ($images as $key => $image) {
            $path = 'public/' . $image;
            if (Image::where('name', $image)->first() && Storage::exists($path)) {
                $images[$key] = asset(env('FILE_STORAGE', '/storage') . '/' . $image);
            } else {
                $images[$key] = asset('/images/placeholder.jpg');
            }
        }
        array_shift($images);
        return $images;
    }

    public function imageUrl()
    {
        $path = 'public/' . $this->image;
        if (Image::where('name', $this->image)->count() && Storage::exists($path)) {
            $image = asset(env('FILE_STORAGE', '/storage') . '/' . $this->image);
        } else {
            $image = asset('/images/placeholder.jpg');
        }
        return $image;
    }

    public function assignCatalog($catalog)
    {
        $result = DB::table('catalog_product')->insert([
            'product_id' => $this->id,
            'catalog_id' => $catalog
        ]);
        return $result;
    }

    public function syncCatalogs($catalogs) {
        $delete = DB::table('catalog_product')->where('product_id', $this->id)->delete();
        if($delete) {
            foreach ($catalogs as $key => $catalog) {
                $this->assignCatalog($catalog);
            }
            return true;
        } else {
            return false;
        }
    }
    
    public function catalogsName() {
        $catalogs = [];
        foreach ($this->catalogs->pluck('name', 'slug') as $slug => $name) {
            $text = '<a href="' . route('catalog.index', ['cata' => $slug]) . '">' . $name . '</a>';
            array_push($catalogs, $text);
        }
        return implode(', ', $catalogs);
    }
    
    public function relatedProducts() {
        $relatedProducts = [];
        foreach ($this->catalogs as $key => $catalog) {
            foreach ($catalog->products as $key => $product) {
                if($product->id != $this->id && !in_array($product->id, array_column($relatedProducts, 'id'))) {
                    array_push($relatedProducts, $product);
                }
            }
        }
        return $relatedProducts;
    }

    public function displayPrice() {
        if ($this->variables->min('price') == $this->variables->max('price')) {
            $price = number_format($this->variables->min('price')) . 'đ';
        } else {
            $price = number_format($this->variables->min('price')) . '₫ - ' . number_format($this->variables->max('price')) . '₫';
        }
        return $price;
    }

    public function minPrice() {
        return number_format($this->variables->min('price')) . '₫';
    }

    public function maxPrice() {
        return number_format($this->variables->max('price')) . '₫';
    }

    public function salePrice() {
        return number_format($this->variables->min('price')) . '₫';
    }
}