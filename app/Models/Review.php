<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Review extends Model
{
    
    use HasFactory, SoftDeletes;
    protected $table = 'reviews';
    protected $fillable = [
        'product_id', 'name', 'phone', 'user_id', 'rating', 'images',
        'content', 'parent_id', 'status', 'revision'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function images()
    {
        return $this->belongsToMany(Image::class)->whereNull('revision');
    }

    public function children()
    {
        return $this->hasMany(Review::class, 'parent_id')->whereNull('revision');
    }

    public function parent()
    {
        return $this->belongsTo(Review::class, 'parent_id');
    }
    
    public function revisions()
    {
        return $this->hasMany(Review::class, 'revision');
    }

    public function revision()
    {
        $revision = $this->replicate();
        $revision->created_at = Carbon::now();
        $revision->revision = $this->id;
        $revision->save();
        return true;
    }
    
    public function statusName()
    {
        switch ($this->status) {
            case '1':
                $status = __('Enable');
                break;

            default:
                $status = __('Disabled');
                break;
        }
        return $status;
    }
    public function createdAt() {
        return Carbon::parse($this->created_at)->format('d/m/Y');
    }

    public function phoneFriendly() {
        if (preg_match('/^(\d{4})(\d{3})(\d{3})$/', $this->phone, $matches)) {
            $formattedPhone = $matches[1] . ' ' . $matches[2] . ' ' . $matches[3];
        } else {
            $formattedPhone = $this->phone; // Giữ nguyên số điện thoại nếu không khớp
        }
        return $formattedPhone;
    }
}
