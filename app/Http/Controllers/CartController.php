<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
                echo "<script> 
                    alert('Product is already in Cart') ;
                    window.location.pathname = '/cart';
                </script>";
                exit;
            }

            $this->calculateTotalCart($request);
            return redirect('cart');
        }
        // check if we dont have a cart in session
        else {
            $cart = [];

            $id = $request->input('id');
            $name = $request->input('name');
            $price = $request->input('price'); // original price
            $sale_price = $request->input('sale_price'); // discounted price
            $quantity = $request->input('quantity');
            $image = $request->input('image');

            if ($sale_price !== null) {
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

            $this->calculateTotalCart($request);
            return redirect('cart');
        }

        return redirect('cart');

    }

    private function calculateTotalCart(Request $request) {
    
        $cart = $request->session()->get('cart');
    
        $totalPrice = 0;
        $totalQuantitly = 0;
    
        foreach ($cart as $id => $product) {
            $product  = $cart[$id];
    
            $price = $product['price'];
            $quantity = $product['quantity'];
    
            $totalPrice = $totalPrice + ($price * $quantity);
            $totalQuantitly = $totalQuantitly + $quantity;
        }
    
        $request->session()->put('total', $totalPrice);
        $request->session()->put('quantity', $totalQuantitly);
    }


    public function remove_from_cart(Request $request){

        if ($request->session()->has('cart')) {
            
            $id = $request->input('id');
            $cart = $request->session()->get('cart');

            unset($cart[$id]); // removes item from cart
            $request->session()->put('cart', $cart); // updates the cart
            $this->calculateTotalCart($request); // update the cart total price
        } 

        return redirect('cart');

    }

    public function edit_product_quantity(Request $request){

        if ( $request->session()->has('cart')) {
            
            $product_id = $request->input('id');
            $product_quantity = $request->input('quantity');

            if ($request->has('decrease_product_quantity_btn')){
                // if($product_quantity > 1){
                //     $product_quantity-=1;  
                // }
                $product_quantity -= 1;
            } 

            if ($request->has('increase_product_quantity_btn')) {
                $product_quantity+=1;
            } 

            if($product_quantity <= 0){
                $this->remove_from_cart($request);
            }

            $cart = $request->session()->get('cart');

            if( array_key_exists($product_id, $cart) ) {

                $cart[$product_id]['quantity'] = $product_quantity;
                $request->session()->put('cart', $cart);

                $this->calculateTotalCart($request);
            }
        }
        return redirect('cart');
    }

    public function checkout() {
        return view('checkout');
    }

    public function place_order(Request $request){
        if ( $request->session()->has('cart') ) { 

            $name = $request->input('name');
            $email = $request->input('email');
            $phone = $request->input('phone');
            $city = $request->input('city');
            $address = $request->input('addrress');

            $cost = $request->session()->get('total');
            $status = 'not paid';
            $date = date('d-M-Y');
            
            $cart = $request->session()->get('cart');

            $order_id = DB::table('orders')->InsertGetId([
                                                'cost' => $cost,	
                                                'name' => $name,
                                                'email' => $email,	
                                                'status' => $status,	
                                                'city'	=> $city,
                                                'address' => $address,	
                                                'phone'	=> $phone,
                                                'date' => $date	  
                                            ], 'id');

            
            foreach ($cart as $id => $product) {
                $product = $cart[$id];
                $product_id = $product['id'];
                $product_name = $product['name'];
                $product_price = $product['price'];
                $product_quantity = $product['quantity'];
                $product_image = $product['image'];
                $product_order_date = $product['order_date'];

                DB::table('order_items')->insert([
                                            'order_id' => $order_id,
                                            'product_id' => $product_id,
                                            'product_name' => $product_name,
                                            'product_price' => $product_price,
                                            'product_image' => $product_image,
                                            'product_quantity' => $product_quantity,
                                            'product_order_date' => $product_order_date
                                        ]);

            }

            $request->session()->put('order_id', $order_id);

            return view('payment');
        }
        else {
            return redirect('/');
        }
    }


}
