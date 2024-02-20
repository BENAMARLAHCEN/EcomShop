<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

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



Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});



Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/remove', [CartController::class, 'removeFromCart'])->name('cart.remove');
Route::post('/cart/update', [CartController::class, 'updateCartItemQuantity'])->name('cart.update');
Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.view');
Route::post('/cart/clear', [CartController::class, 'clearCart'])->name('cart.clear');


Route::get('/login', [AuthController::class, 'index'])->name('login.index');
Route::get('/register', [AuthController::class, 'create'])->name('register.index');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'store'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/products/{name}', [ProductController::class, 'show'])->name('products.show');

Route::get('/orders/place', [OrderController::class, 'index'])->name('orders.index');
Route::post('/orders/place', [OrderController::class, 'placeOrder'])->name('orders.place');