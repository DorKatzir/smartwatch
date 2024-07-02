@extends('layouts.main')


@section('content')

 <!-- Cart Start -->
    <div class="container-fluid pt-5">
        <div class="container">
        
             

    <section class="cart container mt-2 my-3 py-5">
        <div class="container mt-2">
            <h4>Your Cart</h4>
        </div>

        <table class="pt-5">
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Subtotal</th>
            </tr>


            @if(Session::has('cart'))

               @foreach(Session::get('cart') as $id=>$product)

                    <tr>
                        <td>
                            <div class="product-info">
                                <img style="width: 75px; height: 75px" src="{{asset('img/'.$product['image'])}}">
                                <div>
                                    <p>{{$product['name']}}</p>
                                    <small><span>$</span>{{$product['price']}}</small>
                                    <br>
                                    <form method="POST" action="remove_from_cart">
                                        @csrf   
                                        <input type="hidden" name="id" value="{{ $product['id'] }}">
                                        <input type="submit" name="remove_btn" class="remove-btn" value="remove">
                                    </form>
                                </div>
                            </div>
                        </td>

                        <td>
                            <form>
                                <input type="text" name="quantity" value="{{$product['quantity']}}" readonly>
                               
                                <input type="submit" value="edit" class="edit-btn" name="edit_product_quantity_btn">
                            </form>
                        </td>

                        <td>
                            <span class="product-price">$ {{ $product['quantity'] * $product['price']}}</span>
                        </td>
                    </tr>
                @endforeach 

             @endif     

        </table>


        <div class="cart-total">
            <table>
                @if(Session::has('cart'))
                <tr>
                    <td>Total</td>
                    @if(Session::has('total'))
                        <td>${{ Session::get('total') }}</td>    
                    @endif
                 </tr>   
                @endif
            </table>
        </div>
        

        <div class="checkout-container">

            <form>
                <input type="submit" class="btn checkout-btn" value="Checkout" name="">
            </form>
           
        </div>





    </section>

              
        
        </div>
    </div>
    <!-- Cart End -->




@endsection