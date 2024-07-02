@extends('layouts/main')

@section('content')

    <!-- ProductsStart -->
 @foreach($product as $product) 
    <div id="products">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="product-single">
                        <div class="product-img">
                            <img src="{{ asset('img/'. $product->image) }}" alt="Product Image">
                        </div>
                        <div class="product-content">
                            <h2>{{ $product->name }}</h2>
                            @if($product->sale_price !== null)
                                <h3>${{ $product->sale_price }}</h3>
                                <h3 style="text-decoration: line-through">{{ $product->price }}</h3>
                            @else
                                <h3>{{ $product->price }}</h3>
                            @endif

                            <p>{{ $product->description }}</p>
                            <p>{{ $product->category }} - {{ $product->type }}</p>

                            <x-form_add_to_cart :product='$product' />
                            
                        </div>
                    </div>
                </div>
                
            </div>

        </div>
    </div>
    @endforeach
<!-- Products End -->

@endsection