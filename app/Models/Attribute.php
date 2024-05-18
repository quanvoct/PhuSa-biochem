<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Attribute extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'attributes';
    protected $fillable = [
        'key', 'value', 'slug', 'revision'
    ];

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

    public function variables() {
        return $this->belongsToMany(Variable::class);
    }

    public function assignVariable($variable)
    {
        DB::table('attribute_variable')->insert([
            'attribute_id' => $variable,
            'variable_id' => $this->id,
        ]);
        return true;
    }

    public function syncVariables($variables)
    {
        DB::table('attribute_variable')->where('variable_id', $this->id)->delete();
        foreach ($variables as $key => $variable) {
            $this->assignStore($variable);
        }
    }
}
