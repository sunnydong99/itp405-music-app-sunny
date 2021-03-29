<?php

// use Illuminate\Support\Facades\DB; // query builder
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\TrackController;
use App\Http\Controllers\NewAlbumController;
// Lecture week 6
use App\Models\Artist;
use App\Models\Track;
use App\Models\Album;
use App\Models\Genre;
// Lecture week 7
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;
// Assignment 6
use App\Http\Controllers\AdminController;


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

Route::get('/eloquent', function() {
    // QUERYING
    // tracks
    // return view('eloquent.tracks', [
    //     'tracks' => Track::where('unit_price','>',0.99)->orderBy('name')->get(), 
    //     // behind the scenes: eloquent is taking class name to put into FROM clause for SQL statement
    // ]);

    // return view('eloquent.artists', [
    //     'artists' => Artist::orderBy('name', 'desc')->get(), 
    //     // fetched all artists from artists table, have a bunch of Artist obejcts, can access column names as properties
    //     // same as SELECT * FROM artists -> how to add orderBy() clause? change all() to orderBy()
    // ]);

    // single record
    // return view('eloquent.artist', [
    //     'artist' => Artist::find(3),
    // ]);

    // CREATING NEW RECORD
    // $genre = new Genre();
    // $genre->name = 'Hip Hop'; // assign property
    // $genre->save(); // insert into table

    // DELETING
    // $genre = Genre::find(59); // find by ID
    // $genre->delete();

    // UPDATING
    // $genre = Genre::where('name', '=', 'Alternative and Punk')->first();
    // $genre->name = 'Alternative & Punk';
    // $genre->save();

    // RELATIONSHIPS
    // return view('eloquent.has-many', [
    //     'artist' => Artist::find(50), // Metallica
    // ]);

    // return view('eloquent.belongs-to', [
    //     'album' => Album::find(152), // Master of Puppets, should belong to Metallica
    // ]);

    // EAGER LOADING
    return view('eloquent.eager-loading', [
        // Has the N+1 problem
        // 'tracks' => Track::where('unit_price', '>', 0.99)
        //     ->orderBy('name') // get 5 tracks, want to see corresponding album name
        //     ->limit(5)
        //     ->get(),

        // Fixes the N+1 problem via eager loading
        'tracks' => Track::with(['album'])
            ->where('unit_price', '>', 0.99)
            ->orderBy('name') // get 5 tracks, want to see corresponding album name
            ->limit(5)
            ->get(),
    ]);
});

Route::get('/', function () {
    
    return view('welcome');
});

// MVC - Model View Controller model=data, view=present to user, controller=util
// Frameworks allow us to separate these things from one file
// A program would be unmaintainable if you listed all routes here in one file

// NEW
// Route::get('/invoices', [InvoiceController::class, 'index'])->name('invoice.index');
// Route::get('/invoices/{id}', [InvoiceController::class, 'show'])->name('invoice.show');

// Maintenance mode middleware
Route::view('/maintenance', 'maintenance')->name('maintenance');
Route::middleware(['maintenance'])->group(function () {
    // should check for all unauthenticated routes except login (GET/POST), logout
    
    Route::get('/playlists', [PlaylistController::class, 'index'])->name('playlist.index');
    Route::get('/playlists/{id}', [PlaylistController::class, 'show'])->name('playlist.show');
    // Lecture 4 CRUD, validation, flash messages
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


    // Assignment 5 eloquent album routes (CRUD)
    Route::get('/new-albums', [NewAlbumController::class, 'index'])->name('new-album.index');
    // Route::get('/new-albums/create', [NewAlbumController::class, 'create'])->name('new-album.create');
    // Route::post('/new-albums',[NewAlbumController::class, 'store'])->name('new-album.store');
    // Route::get('/new-albums/{id}/edit',[NewAlbumController::class, 'edit'])->name('new-album.edit');
    // Route::post('/new-albums/{id}', [NewAlbumController::class, 'update'])->name('new-album.update');


    // Lecture week 7 routes (Migrations)
    Route::get('/register', [RegistrationController::class, 'index'])->name('registration.index');
    Route::post('/register', [RegistrationController::class, 'register'])->name('registration.create');
    
});



// Lecture week 7 routes (Migrations)
Route::get('/login', [AuthController::class, 'loginForm'])->name('auth.loginForm'); // shown the log in form
Route::post('/login', [AuthController::class, 'login'])->name('auth.login'); // process the actual log in 


// Attaching custom-auth middleware to routes we want
Route::middleware(['custom-auth'])->group(function () {

    // Assignment 7 - custom-auth check for album create/edit routes
    Route::get('/new-albums/create', [NewAlbumController::class, 'create'])->name('new-album.create');
    Route::post('/new-albums',[NewAlbumController::class, 'store'])->name('new-album.store');
    Route::get('/new-albums/{id}/edit',[NewAlbumController::class, 'edit'])->name('new-album.edit');
    Route::post('/new-albums/{id}', [NewAlbumController::class, 'update'])->name('new-album.update');


    Route::middleware(['not-blocked'])->group(function () {
        // can only access these pages if you're not blocked
        Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
        Route::get('/invoices', [InvoiceController::class, 'index'])->name('invoice.index');
        Route::get('/invoices/{id}', [InvoiceController::class, 'show'])->name('invoice.show');
    });
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
    Route::view('/blocked', 'blocked')->name('blocked');

    // Admin middleware nested in auth middleware
    Route::middleware(['admin-priv'])->group(function() {
        Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
        Route::post('/admin', [AdminController::class, 'update'])->name('admin.update');
    });
});
// middleware = classes with a handle method that run before a set of routes


// // Admin middleware - not nested in custom-auth
// Route::middleware(['admin-priv'])->group(function() {
//     // Route::view('/admin', 'admin')->name('admin');
//     Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
//     Route::post('/admin', [AdminController::class, 'update'])->name('admin.update');
// });

if (env('APP_ENV') !== 'local') {
    URL::forceScheme('https');
}