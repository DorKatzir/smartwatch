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
                <div class="col-md-3">
                    <div class="product-single">
                        <div class="product-img">
                            <img src="{{ asset('img/product-1.png') }}" alt="Product Image">
                        </div>
                        <div class="product-content">
                            <h2>Sports Edition</h2>
                            <h3>$149</h3>
                            <a class="btn" href="#">Buy Now</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- Products End -->
    
@endsection