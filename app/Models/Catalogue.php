<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Catalogue extends Model
{
    use HasFactory;
    protected $table = 'catalogs';
    protected $fillable = [
        'name', 'slug', 'description', 'image', 'order',
        'status', 'parent_id', 'revision'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class)->whereNull('revision');
    }

    public function children()
    {
        return $this->hasMany(Catalogue::class, 'parent_id')->whereNull('revision');
    }

    public function parent()
    {
        return $this->belongsTo(Catalogue::class, 'parent_id');
    }

    public function revisions()
    {
        return $this->hasMany(Catalogue::class, 'revision');
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

    public function createdAt()
    {
        return ($this->created_at != null) ? Carbon::parse($this->created_at)->format('d/m/Y H:i:s') : '';
    }

    public function statusName()
    {
        switch ($this->status) {
            case '1':
                $name = 'Hoạt động';
                break;

            default:
                $name = 'Bị khoá';
                break;
        }
        return $name;
    }

    public function imageUrl()
    {
        $path = 'public/' . $this->image;
        if (Image::where('name', $this->image)->first()) {
            $image = asset(env('FILE_STORAGE', '/storage') . '/' . $this->image);
        } else {
            $image = asset('/images/placeholder.jpg');
        }
        return $image;
    }
}
