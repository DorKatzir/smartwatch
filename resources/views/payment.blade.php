@extends('layouts/main')

@section('content')

    <section class="container mt-2 my-3 py-5">
        <div class="container text-center mt-2">
            <h4 class="my-5">Payment</h4>
            
            @if(Session::has('total') && Session::get('total') != null)
                @if (Session::has('order_id') && Session::get('order_id') != null)
                    <h4 class="my-5" style="color:blue">
                        Total: ${{ Session::get('total') }}
                    </h4>
                @endif
            @endif

            
        </div>
    </section>

@endsection