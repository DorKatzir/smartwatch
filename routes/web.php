<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/single_product', function () {
    return view('single_product');
});

Route::get('/products', function () {
    return view('products');
});

Route::get('/about', function () {
    return view('about');
});

