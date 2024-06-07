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
    protected $appends = array('typeStr', 'imageUrl', 'statusStr');
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

    public function post_translations() //các bản dịch của bài viết
    {
        return $this->hasMany(PostTranslation::class);
    }

    public function translation_posts() //các bài viết của bản dịch
    {
        return $this->hasMany(PostTranslation::class, 'translate_id');
    }

    public function translated() //bài dịch
    {
        return $this->hasManyThrough(
            Post::class,
            PostTranslation::class,
            'post_id',
            'id',
            'id',
            'translate_id'
        );
    }

    public function languages()
    {
        return $this->belongsToMany(Language::class, 'post_translations');
    }

    public function language()
    {
        return $this->hasOneThrough(
            Language::class,
            PostTranslation::class,
            'post_id',
            'id',
            'id',
            'language_id'
        )->where('translate_id', $this->id);
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

    public function assignLanguage($language, $post)
    {
        if ($language && $post) {
            $result = DB::table('post_translations')->insert([
                'post_id' => $this->id,
                'language_id' => $language,
                'translate_id' => $post
            ]);
            return $result;
        }
    }

    public function syncLanguages($languages, $posts = null)
    {
        if ($posts) {
            foreach ($languages as $key => $language) {
                $this->assignLanguage($language, $posts[$key]);
            }
            return true;
        } else {
            PostTranslation::wherePost_id($this->id)->get()->each(function ($translate, $key) {
                $translate->delete();
            });
            PostTranslation::whereTranslate_id($this->id)->get()->each(function ($translate, $key) {
                $translate->delete();
            });
            foreach ($languages as $key => $language) {
                $this->assignLanguage($language, $this->id);
            }
        }
    }

    public function linkLanguages($languages, $posts)
    {
        //clear all link
        PostTranslation::whereIn('post_id', $posts)->get()->each(function ($translate, $key) {
            $translate->delete();
        });
        PostTranslation::whereIn('translate_id', $posts)->get()->each(function ($translate, $key) {
            $translate->delete();
        });
        Post::whereIn('id', $posts)->get()->each(function ($post, $key) use ($languages, $posts) {
            $post->syncLanguages($languages, $posts);
        });
    }

    public function getStatusStrAttribute()
    {
        switch ($this->status) {
            case '2':
                $name = __('Featured');
                break;
            case '1':
                $name = __('Published');
                break;

            default:
                $name = __('Hidden');
                break;
        }
        return $name;
    }

    public function getTypeStrAttribute()
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

    public function getImageUrlAttribute()
    {
        $path = 'public/' . $this->image;
        if (Image::where('name', $this->image)->count() && Storage::exists($path)) {
            $image = asset(env('FILE_STORAGE', '/storage') . '/' . $this->image);
        } else {
            $image = asset('admin/images/placeholder.webp');
        }
        return $image;
    }
}
