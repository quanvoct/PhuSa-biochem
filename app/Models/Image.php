<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    protected $table = 'images';
    protected $appends = array('link');
    protected $fillable = [
        'name', 'alt', 'caption', 'author_id', 'created_at'
    ];
    
    public function variables()
    {
        return $this->belongsToMany(Variable::class)->whereNull('revision');
    }

    public function reviews()
    {
        return $this->belongsToMany(Review::class)->whereNull('revision');
    }

    public function author() {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function getLinkAttribute()
    {
        $path = 'public/' . $this->name;
        if (Image::where('name', $this->name)->count() && Storage::exists($path)) {
            $url = asset(env('FILE_STORAGE', 'storage') . '/' . $this->name);
        } else {
            $url = asset('admin/images/placeholder.webp');
        }
        return $url;
    }

    public function createdAt() {
        return Carbon::parse($this->created_at)->format('d/m H:i');
    }
}
