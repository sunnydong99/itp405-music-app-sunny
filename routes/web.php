<?php

// use Illuminate\Support\Facades\DB; // query builder
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\TrackController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// MVC - Model View Controller model=data, view=present to user, controller=util
// Frameworks allow us to separate these things from one file
// A program would be unmaintainable if you listed all routes here in one file

// NEW
Route::get('/invoices', [InvoiceController::class, 'index'])->name('invoice.index');
Route::get('/invoices/{id}', [InvoiceController::class, 'show'])->name('invoice.show');

Route::get('/playlists', [PlaylistController::class, 'index'])->name('playlist.index');
Route::get('/playlists/{id}', [PlaylistController::class, 'show'])->name('playlist.show');

Route::get('/albums', [AlbumController::class, 'index'])->name('album.index');
// these were all get requests
// 2 requests: page to show form, and submission (GET then POST)
Route::get('/albums/create', [AlbumController::class, 'create'])->name('album.create');
// it's ok to use the same url twice for 2 different requests
Route::post('/albums',[AlbumController::class, 'store'])->name('album.store');
// edit
Route::get('/albums/{id}/edit',[AlbumController::class, 'edit'])->name('album.edit');
Route::post('/albums/{id}', [AlbumController::class, 'update'])->name('album.update');



// Assignment 3 tracks routes
Route::get('/tracks',[TrackController::class, 'index'])->name('track.index');
Route::get('/tracks/new', [TrackController::class, 'create'])->name('track.create');
Route::post('/tracks', [TrackController::class,'store'])->name('track.store');

Route::get('/playlists/{id}/edit', [PlaylistController::class, 'edit'])->name('playlist.edit');
Route::post('/playlists/{id}', [PlaylistController::class, 'update'])->name('playlist.update');
