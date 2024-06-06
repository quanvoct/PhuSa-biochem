<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostTranslation extends Model
{
    use HasFactory;
    protected $table = 'post_translations';

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function language()
    {
        return $this->belongsTo(Language::class);
    }

    public function translate()
    {
        return $this->belongsTo(Post::class, 'translate_id');
    }
}
