<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function cart() {
        return view('cart');
    }

    public function add_to_cart(Request $request){

        // check if we have a cart in session
        if($request->session()->has('cart')) {
            // get the cart
            $cart = $request->session()->get('cart');
            // get all the ids that exists in cart
            $products_ids = array_column($cart, 'id');
            // get the id send from the form
            $id = $request->input('id');

            // Add product to cart if id NOT in cart
            if( !in_array($id, $products_ids)) {
                $name = $request->input('name');
                $price = $request->input('price'); // original price
                $sale_price = $request->input('sale_price'); // discounted price
                $quantity = $request->input('quantity');
                $image = $request->input('image');

                if($sale_price !== null) {
                    $price_to_charge = $sale_price;
                } else {
                    $price_to_charge = $price;
                }

                $product_arr = [
                    'id' => $id,
                    'name' => $name,
                    'price' => $price_to_charge,
                    'quantity' => $quantity,
                    'image' => $image
                ];

                $cart[$id] = $product_arr;
                $request->session()->put('cart', $cart);

            } 
            // if product alreay in cart
            else {

            }

        }
        // check if we dont have a cart in session
        else {
            //
        }
    }

}
