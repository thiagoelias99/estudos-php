<?php

namespace App\Providers;

use App\Repositories\EloquentSeriesRepository;
use App\Repositories\SeriesRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public array $bindings = [
        SeriesRepository::class => EloquentSeriesRepository::class,
    ];

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
