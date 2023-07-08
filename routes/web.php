<?php

use App\Http\Controllers\PharmacyController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('products',ProductController::class);
Route::resource('pharmacies',PharmacyController::class);

Route::get('/search', [ProductController::class,'search'])->name('products.search');
// Route::post('/api/create', 'ProductController@create')->withoutMiddleware(['csrf']);
