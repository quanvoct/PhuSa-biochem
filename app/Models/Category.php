<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'code',
        'name',
        'order',
        'status',
        'note',
        'revision'
    ];

    
    public function posts()
    {
        return $this->hasMany(Post::class)->whereNull('revision');
    }

    public function statusName()
    {
        switch ($this->status) {
            case '1':
                $status = 'Hoạt động';
                break;

            default:
                $status = 'Bị khoá';
                break;
        }
        return $status;
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
}
