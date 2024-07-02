@extends('layouts/main')

@section('content')

    <!-- Products Start -->
    <div id="products">
        <div class="container">
            <div class="section-header">
                <h2>Get Your Products</h2>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec viverra at massa sit amet ultricies
                </p>
            </div>
            <div class="row align-items-center">
                @foreach($products as $product)
                    <div class="col-md-3">
                        <div class="product-single">
                            <div class="product-img">
                                <img src="{{ asset('img/'.$product->image) }}" width="100" alt="Product Image">
                            </div>
                            <div class="product-content">
                            <h2>
                                <a href="{{ 'single_product/'.$product->id }}">
                                    {{ $product->name }}
                                </a>
                            </h2>
                            @if($product->sale_price !== null)
                                <h3>${{ $product->sale_price }}</h3>
                                <h3 style="text-decoration: line-through">{{ $product->price }}</h3>
                            @else
                                <h3>{{ $product->price }}</h3>
                            @endif
                                <x-form_add_to_cart :product='$product' />
                            </div>
                        </div>
                    </div> 
                @endforeach
            </div>

        </div>
    </div>
    <!-- Products End -->
    
@endsection