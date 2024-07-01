<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SmartwatchController extends Controller
{
    public function index() {
        $products =  DB::table('products')->limit(4)->get();
        return view('index', [ 'products' => $products ]);
    }

    public function products() {
        $products =  DB::table('products')->limit(4)->get();
        return view('products', [ 'products' => $products ]);
    }

    public function single_product(Request $request, $id) {
        $product_arr =  DB::table('products')->where('id', $id)->get();
        return view('single_product', [ 'product' => $product_arr ]);
    }

}
