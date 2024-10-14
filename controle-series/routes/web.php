<?php

use App\Http\Controllers\EpisodesController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SeasonsController;
use App\Http\Controllers\SeriesController;
use App\Http\Controllers\UsersController;
use App\Http\Middleware\Autenticador;
use App\Mail\SeriesCreated;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/series');
});


Route::get('/series', SeriesController::class . '@index')->name('series.index');

Route::middleware([Autenticador::class])->group(function () {
    Route::resource('/series', SeriesController::class)
        ->except(['show', 'index']);
    Route::get('/series/{series}/seasons', SeasonsController::class . "@index")->name('seasons.index');
    Route::get('/seasons/{season}/episodes', [EpisodesController::class, 'index'])->name('episodes.index');
    Route::post('/seasons/{season}/episodes', [EpisodesController::class, 'update'])->name('episodes.update');
    Route::get('/logout', [LoginController::class, 'destroy'])->name('logout');
});

Route::get('/login', LoginController::class . '@index')->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('sign-in');
Route::get('/register', [UsersController::class, 'create'])->name('users.create');
Route::post('/register', [UsersController::class, 'store'])->name('users.create');


Route::get('/mail', function (){
    return new SeriesCreated(
        nomeSerie: 'Nome da Série',
        idSerie: 1,
        qtdTemporadas: 1,
        episodiosPorTemporada: 10
    );
});
