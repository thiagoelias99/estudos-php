<?php

use App\Http\Controllers\Api\SeriesController;
use App\Models\Episode;
use App\Models\Series;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::apiResource('/series', SeriesController::class);
Route::get('/series/{id}/episodes', function (int $id){
    $series = Series::find($id);
    return $series->episodes;
});

Route::patch('/episodes/{episode}', function (Episode $episode, Request $request){
    $episode->watched = $request->watched;
    $episode->save();
    return $episode;
});
