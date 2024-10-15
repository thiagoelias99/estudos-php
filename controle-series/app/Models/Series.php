<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Series extends Model
{
    use HasFactory;
    protected $fillable = ['nome', 'cover'];
    protected $with = ['seasons'];
    protected $appends = ['links'];

    public function seasons()
    {
        return $this->hasMany(Season::class, 'series_id', 'id');
    }

    public function episodes()
    {
        return $this->hasManyThrough(Episode::class, Season::class);
    }

    // This method is called when the model is booted
    protected static function booted()
    {
        self::addGlobalScope('orderByName', function (Builder $query) {
            $query->orderBy('nome', 'asc');
        });
    }

    protected function links(): Attribute
    {
        return new Attribute(
            get: fn() => [
                [
                    'rel' => 'self',
                    'href' => '/api/series/' . $this->id,
                ],
                [
                    'rel' => 'seasons',
                    'href' => '/api/series/' . $this->id . '/seasons',
                ],
                [
                    'rel' => 'episodes',
                    'href' => '/api/series/' . $this->id . '/episodes',
                ]
            ],
        );
    }
}
