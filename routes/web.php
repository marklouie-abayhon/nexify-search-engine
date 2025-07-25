<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SearchController; 
use App\Http\Controllers\CategoryController;

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

Route::get('/category/{id}', [CategoryController::class, 'show'])->name('category.show');
Route::get('/', [SearchController::class, 'index'])->name('search.index');
Route::get('/go', [SearchController::class, 'redirect'])->name('search.redirect');


// Toggle dark mode
Route::get('/toggle-dark', function () {
    session(['dark' => !session('dark', false)]);
    return response()->noContent();
});

// Toggle RTL mode
Route::get('/toggle-rtl', function () {
    session(['rtl' => !session('rtl', false)]);
    return response()->noContent();
});
