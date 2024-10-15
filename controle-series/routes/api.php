<?php

use App\Http\Controllers\Api\SeriesController;
use App\Models\Episode;
use App\Models\Series;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('/series', SeriesController::class);
    Route::get('/series/{id}/episodes', function (int $id) {
        $series = Series::find($id);
        return $series->episodes;
    });
    Route::patch('/episodes/{episode}', function (Episode $episode, Request $request) {
        $episode->watched = $request->watched;
        $episode->save();
        return $episode;
    });
});

Route::post('/login', function (Request $request) {
    $credentials = $request->only('email', 'password');
    if (Auth::attempt($credentials) == false) {
        return response()->json([
            'message' => 'Unauthorized'
        ], 401);
    }

    $user = Auth::user();
    $user->tokens()->delete(); // Remove all previous tokens
    $token = $user->createToken('token', ['series:create', 'series:delete'])->plainTextToken;
    return response()->json([
        'token' => $token
    ]);
});
