<?php

// Dedicated file for API routes, web.php is dedicated to UI routes
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// Lecture 12
use App\Http\Controllers\Api\AlbumController;
// Assignment 9
use App\Http\Controllers\Api\ArtistController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('albums', AlbumController::class); // Creates routes for a lit of verbs with urls that map to actions (also assigns route names)
Route::resource('artists', ArtistController::class);
// Route::get('/artists/{q?}', [ArtistController::class, 'query'])->name('artists.query');
