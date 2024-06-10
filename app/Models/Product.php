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
    protected $appends = array('url', 'imageUrl', 'imagesUrl', 'statusStr');
    protected $fillable = [
        'name', 'sku', 'slug', 'author_id', 'excerpt', 'description',
        'gallery', 'sort', 'unit', 'specs',
        'keyword', 'status', 'allow_review', 'revision'
    ];

    public function catalogues()
    {
        return $this->belongsToMany(Catalogue::class)->whereNull('revision');
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

    public function product_translations() //các bản dịch của sản phẩm
    {
        return $this->hasMany(ProductTranslation::class);
    }

    public function translation_products() //các sản phẩm của bản dịch
    {
        return $this->hasMany(ProductTranslation::class, 'translate_id');
    }

    public function translates() //bài dịch
    {
        return $this->hasManyThrough(
            Product::class,
            ProductTranslation::class,
            'product_id',
            'id',
            'id',
            'translate_id'
        );
    }

    public function getTranslateByLanguageCode($languageCode)
    {
        return $this->product_translations()
            ->whereHas('language', function($query) use ($languageCode) {
                $query->where('code', $languageCode);
            })->first();
    }

    public function languages()
    {
        return $this->belongsToMany(Language::class, 'product_translations');
    }

    public function language()
    {
        return $this->hasOneThrough(
            Language::class,
            ProductTranslation::class,
            'product_id',
            'id',
            'id',
            'language_id'
        )->where('translate_id', $this->id);
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

    public function getStatusStrAttribute()
    {
        switch ($this->status) {
            case '2':
                $status = __('Featured');
                break;

            case '1':
                $status = __('Published');
                break;

            default:
                $status = __('Hidden');
                break;
        }
        return $status;
    }

    public function keywords()
    {
        return explode(',', $this->keyword);
    }

    public function getUrlAttribute()
    {
        return route('shop.index', ['catalogue' => $this->catalogues->first()->slug, 'product' => $this->slug]);
    }

    public function getImagesUrlAttribute()
    {
        $gallery = explode('|', $this->gallery);
        foreach ($gallery as $key => $image) {
            $path = 'public/' . $image;
            if (Image::where('name', $image)->first() && Storage::exists($path)) {
                $gallery[$key] = asset(env('FILE_STORAGE', '/storage') . '/' . $image);
            } else {
                $gallery[$key] = asset('admin/images/placeholder.webp');
            }
        }
        array_shift($gallery);
        return $gallery;
    }

    public function getImageUrlAttribute()
    {
        $images = explode('|', $this->gallery);
        $path = 'public/' . $images[1];
        if (Image::where('name', $images[1])->count() && Storage::exists($path)) {
            $image = asset(env('FILE_STORAGE', '/storage') . '/' . $images[1]);
        } else {
            $image = asset('admin/images/placeholder.webp');
        }
        return $image;
    }

    public function assignCatalogue($catalogue)
    {
        $result = DB::table('catalogue_product')->insert([
            'product_id' => $this->id,
            'catalogue_id' => $catalogue
        ]);
        return $result;
    }

    public function syncCatalogues($catalogues) {
        $delete = DB::table('catalogue_product')->where('product_id', $this->id)->delete();
        if($delete || !$this->catalogues->count()) {
            foreach ($catalogues as $key => $catalogue) {
                $this->assignCatalogue($catalogue);
            }
            return true;
        } else {
            return false;
        }
    }

    public function assignLanguage($language, $product)
    {
        if($language && $product) {
            $result = DB::table('product_translations')->insert([
                'product_id' => $this->id,
                'language_id' => $language,
                'translate_id' => $product
            ]);
            return $result;
        }
    }

    public function syncLanguages($languages, $products = null)
    {
        if ($products) {
            foreach ($languages as $key => $language) {
                $this->assignLanguage($language, $products[$key]);
            }
            return true;
        } else {
            ProductTranslation::whereProduct_id($this->id)->get()->each(function ($translate, $key) {
                $translate->delete();
            });
            ProductTranslation::whereTranslate_id($this->id)->get()->each(function ($translate, $key) {
                $translate->delete();
            });
            foreach ($languages as $key => $language) {
                $this->assignLanguage($language, $this->id);
            }
        }
    }

    public function linkLanguages($languages, $products)
    {
        //clear all link
        ProductTranslation::whereIn('product_id', $products)->get()->each(function ($translate, $key) {
            $translate->delete();
        });
        ProductTranslation::whereIn('translate_id', $products)->get()->each(function ($translate, $key) {
            $translate->delete();
        });
        Product::whereIn('id', $products)->get()->each(function ($product, $key) use ($languages, $products) {
            $product->syncLanguages($languages, $products);
        });
    }
    
    public function cataloguesName() {
        $catalogues = [];
        foreach ($this->catalogues->pluck('name', 'slug') as $slug => $name) {
            $text = '<a href="' . route('admin.catalogue', ['cata' => $slug]) . '">' . $name . '</a>';
            array_push($catalogues, $text);
        }
        return implode(', ', $catalogues);
    }
    
    public function relatedProducts() {
        $relatedProducts = [];
        foreach ($this->catalogues as $key => $catalogue) {
            foreach ($catalogue->products as $key => $product) {
                if($product->id != $this->id && !in_array($product->id, array_column($relatedProducts, 'id'))) {
                    array_push($relatedProducts, $product);
                }
            }
        }
        return array_slice($relatedProducts, 0, 4);
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