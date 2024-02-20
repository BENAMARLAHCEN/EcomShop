<?php

use App\Http\Controllers\FilterController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use TCG\Voyager\Facades\Voyager;

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

Route::get('/',[ProductController::class,'index']);

Route::get('/checkout', function () {
    return view('products.checkout-page');
});
Route::get('/show', function () {
    return view('products.show');
});
// Route::get('/search', function () {
// return view('products.search');
// });

Route::get('/filter',[FilterController::class,'index']);
Route::get('/search', [FilterController::class, 'search']);

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
