<?php

// use Illuminate\Support\Facades\DB; // query builder
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PlaylistController;

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
// Route::get('/invoices', function() {
//     $invoices = DB::table('invoices')->get(); // = SELECT * FROM invoices, getting the data
//     return view('invoices', [
//         'invoices' => $invoices // passing data into the view
//     ]);
// });