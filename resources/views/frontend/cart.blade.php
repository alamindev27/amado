@extends('layouts.app_frontend')
@section('title')
    <title> Carts</title>
@endsection
@section('products')
    <div class="cart-table-area section-padding-100">
            <div class="container-fluid">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                <div class="row">
                    <div class="col-12 col-lg-8">
                        <form action="{{ route('cart.update') }}" method="POST">
                            @csrf
                            <div class="cart-title mt-50">
                                <h2>Shopping Cart</h2>
                            </div>
                            <div class="cart-table clearfix">
                                <table class="table table-responsive">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Name</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $subTotal = 0;
                                            $flag = false;
                                        @endphp
                                        @forelse ($carts as $cart)
                                            <tr>
                                                <td class="cart_product_img">
                                                    <a href="{{ route('product.details', $cart->relationwithproduct->slug) }}">
                                                        <img src="{{ asset('image/product') }}/{{ $cart->relationwithproduct->image }}" alt="Product">
                                                    </a>
                                                </td>
                                                <td class="cart_product_desc">
                                                    <h5>{{ $cart->relationwithproduct->name }}</h5>
                                                    @if ($cart->relationwithproduct->stock < 1)
                                                    @php
                                                        $flag = true
                                                    @endphp
                                                        <p class="avaibility text-danger"><i class="fa fa-circle"></i> Stock Out</p>
                                                    @else
                                                        <p class="avaibility text-success"><i class="fa fa-circle"></i> In Stock</p>
                                                    @endif
                                                </td>
                                                <td class="price">
                                                    <span>{{ $cart->quantity .'*'. $cart->relationwithproduct->price }} TK.</span>
                                                    @php
                                                        $subTotal += $cart->quantity * $cart->relationwithproduct->price
                                                    @endphp
                                                </td>
                                                <td class="qty">
                                                    <div class="qty-btn d-flex">
                                                        <p>Qty</p>
                                                        <div class="quantity">
                                                            <span class="qty-minus" onclick="var effect = document.getElementById('qty{{ $cart->id }}'); var qty = effect.value; if( !isNaN( qty ) &amp;&amp; qty &gt; 1 ) effect.value--;return false;"><i class="fa fa-minus" aria-hidden="true"></i></span>
                                                            <input type="number" class="qty-text" id="qty{{ $cart->id }}" step="1" min="1" max="300" name="quantity[{{ $cart->relationwithproduct->id }}]" value="{{ $cart->quantity }}">
                                                            <span class="qty-plus" onclick="var effect = document.getElementById('qty{{ $cart->id }}'); var qty = effect.value; if( !isNaN( qty )) effect.value++;return false;"><i class="fa fa-plus" aria-hidden="true"></i></span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="{{ route('remove.cart', $cart->relationwithproduct->slug) }}">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                        <h4 class="text-info">No Product Adding to Cart</h4>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            @if (count($carts) < 1)
                                <a href="{{ url('/') }}" class="btn amado-btn w-100">CONTINUE SHOPING</a>
                            @else
                                <button type="submit" class="btn amado-btn w-100">UPDATE SHOPING CART</button>
                            @endif
                        </form>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="cart-summary">
                            <h5>Cart Total</h5>
                            <ul class="summary-table">
                                <li><span>subtotal:</span> <span>{{ $subTotal }} TK</span></li>
                                <li><span>delivery:</span> <span>Free</span></li>
                                <li><span>total:</span> <span>{{ $subTotal }} TK</span></li>
                                {{ Session::put('cartTotal', $subTotal) }}
                            </ul>
                            <div class="cart-btn mt-100">
                                @if ($flag)
                                <div class="alert alert-danger">
                                    Remove Stock out Product
                                </div>
                                @else
                                    <a href="{{ route('checkout') }}" class="btn amado-btn w-100">CHECKOUT</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>


@endsection
@section('footer_script')
    @if (session('CartError'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '{{ session('CartError') }}'
            });
        </script>
    @endif
@endsection
