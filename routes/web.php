<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SmartwatchController;
use Illuminate\Support\Facades\Route;

Route::get('/', [SmartwatchController::class, 'index'])->name('home');

Route::get('/single_product/{id}', [SmartwatchController::class, 'single_product'])->name('single_product');

Route::get('/single_product', function(){ return redirect('/'); });

Route::get('/products', [SmartwatchController::class, 'products'])->name('products');

Route::get('/cart', [CartController::class, 'cart'])->name('cart');

Route::get('/about', function () { return view('about'); });

Route::post('/add_to_cart', [CartController::class, 'add_to_cart'])->name('add_to_cart');
Route::get('/add_to_cart', function(){ return redirect('/'); });

Route::post('/remove_from_cart', [CartController::class, 'remove_from_cart'])->name('remove_from_cart');
Route::get('/remove_from_cart', function(){ return redirect('/'); });

Route::post('/edit_product_quantity', [CartController::class, 'edit_product_quantity'])->name('edit_product_quantity');
Route::get('/edit_product_quantity', function(){ return redirect('/'); });

Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');

Route::post('/place_order', [CartController::class, 'place_order'])->name('place_order');
Route::get('/place_order', function(){ return redirect('/'); });

Route::get('/payment', [PaymentController::class, 'index'])->name('payment');



