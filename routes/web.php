<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\SmartwatchController;
use Illuminate\Support\Facades\Route;

Route::get('/', [SmartwatchController::class, 'index'])->name('home');

Route::get('/single_product/{id}', [SmartwatchController::class, 'single_product'])->name('single_product');

Route::get('/single_product', function(){ return redirect('/'); });

Route::get('/products', [SmartwatchController::class, 'products'])->name('products');

Route::get('/cart', [CartController::class, 'cart'])->name('cart');

Route::get('/about', function () { return view('about'); });

Route::post('/add_to_cart', [CartController::class, 'add_to_cart'])->name('add_to_cart');
Route::get('/add_to_cart', function(){
    return redirect('/');
});


