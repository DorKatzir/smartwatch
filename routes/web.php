<?php

use App\Http\Controllers\SmartwatchController;
use Illuminate\Support\Facades\Route;

Route::get('/', [SmartwatchController::class, 'index'])->name('home');

Route::get('/single_product/{id}', [SmartwatchController::class, 'single_product'])->name('single_product');

Route::get('/single_product', function(){ return redirect('/'); });

Route::get('/products', function () {
    return view('products');
});

Route::get('/about', function () {
    return view('about');
});

