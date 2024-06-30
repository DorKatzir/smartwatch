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
}
