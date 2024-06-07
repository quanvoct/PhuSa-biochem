<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $appends = array('statusStr');
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'code',
        'name',
        'sort',
        'status',
        'note',
        'revision'
    ];
    
    public function posts()
    {
        return $this->hasMany(Post::class)->whereNull('revision');
    }

    public function getStatusStrAttribute()
    {
        switch ($this->status) {
            case '1':
                $name = __('Enable');
                break;

            default:
                $name = __('Disabled');
                break;
        }
        return $name;
    }
    
    public function revisions()
    {
        return $this->hasMany(Category::class, 'revision');
    }

    public function revision()
    {
        $revision = $this->replicate();
        $revision->created_at = Carbon::now();
        $revision->revision = $this->id;
        $revision->save();
        return true;
    }

    public function canRemove() {
        return $this->posts->count() ? false : true;
    }
}
