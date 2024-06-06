<?php

namespace App\Models;

use App\Http\Controllers\Admin\PostController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;
    protected $table = 'languages';
    protected $fillable = [
        'name', 'code'
    ];

    const LANG = [
        'en' => 'English',
        'fr' => 'Français',
        'es' => 'Español',
        'tl' => 'Filipino',
        'pt' => 'Português',
        'de' => 'Deutsch',
        'ru' => 'Русский',
        'it' => 'Italiano',
        'tr' => 'Türkçe',
        'ro' => 'Română',
        'sk' => 'Slovenčina',
        'sr' => 'Српски',
        'zh' => '中文（简体）',
        'ja' => '日本語',
        'ko' => '한국어',
        'vn' => 'Tiếng Việt',
    ];

    public function settings() {
        return $this->hasMany(Setting::class);
    }

    public function post_translations() {
        return $this->hasMany(PostTranslation::class);
    }

    public function product_translations() {
        return $this->hasMany(ProductTranslation::class);
    }
}
