<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class Post extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'posts';
    protected $with = ['author', 'category'];
    protected $fillable = [
        'code', 'title', 'author_id', 'category_id',
        'excerpt', 'content', 'image', 'type',
        'revision', 'status', 'created_at'
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function revisions()
    {
        return $this->hasMany(Post::class, 'revision');
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
            case '1':
                $status = 'xuất bản';
                break;
            default:
                $status = 'không hiển thị';
                break;
        }
        return $status;
    }

    public function typeName()
    {
        switch ($this->type) {
            case 'page':
                $type = 'trang';
                break;
            default:
                $type = 'bài viết';
                break;
        }
        return $type;
    }

    public function imageUrl()
    {
        $path = 'public/images/' . $this->image;
        if (Image::where('name', $this->image)->count() && Storage::exists($path)) {
            $image = asset(env('FILE_STORAGE', '/storage') . '/images/' . $this->image);
        } else {
            $image = asset('/img/placeholder.jpg');
        }
        return $image;
    }
}
