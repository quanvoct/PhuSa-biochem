<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Log extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'logs';
    protected $fillable = [
        'user_id', 'action', 'type', 'object', 'ip', 'location', 'country',
        'isp', 'referred', 'agent', 'platform', 'device', 'revision'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function revisions()
    {
        return $this->hasMany(Log::class, 'revision');
    }

    public function revision()
    {
        $revision = $this->replicate();
        $revision->created_at = Carbon::now();
        $revision->revision = $this->id;
        $revision->save();
        return true;
    }

    public function createAt() {
        return Carbon::parse($this->created_at)->format('d/m/Y');
    }
}
