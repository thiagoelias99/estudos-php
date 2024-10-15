<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Series extends Model
{
    use HasFactory;
    protected $fillable = ['nome', 'cover'];
    protected $with = ['seasons'];

    public function seasons()
    {
        return $this->hasMany(Season::class, 'series_id', 'id');
    }

    // This method is called when the model is booted
    protected static function booted()
    {
        self::addGlobalScope('orderByName', function (Builder $query) {
            $query->orderBy('nome', 'asc');
        });
    }
}
