@extends('layouts.app_frontend')
@section('title')
    <title> Home</title>
@endsection
@section('products')
    <!-- Product Catagories Area Start -->
    <div class="products-catagories-area clearfix">
        <div class="amado-pro-catagory clearfix">
            @forelse ($categories as $category)
                <!-- Single Catagory -->
                <div class="single-products-catagory clearfix">
                    <a href="{{ route('shop', $category->slug) }}">
                        <img src="{{ asset('image/category') }}/{{ $category->image }}" alt="Category Image">
                        <!-- Hover Content -->
                        <div class="hover-content">
                            <div class="line"></div>
                            <p>From {{ $category->price }} TK.</p>
                            <h4>{{ $category->name }}</h4>
                        </div>
                    </a>
                </div>
            @empty
                <h2>No Products</h2>
            @endforelse
        </div>
    </div>
    <!-- Product Catagories Area End -->
@endsection
