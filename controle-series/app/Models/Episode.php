<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Episode extends Model
{
    use HasFactory;
    protected $fillable = ['number'];

    public $timestamps = false;

    public function season()
    {
        return $this->belongsTo(Season::class);
    }

    public function scopeWatched(Builder $query)
    {
        return $query->where('watched', true);
    }

    protected $casts = ['watched' => 'boolean'];
}
