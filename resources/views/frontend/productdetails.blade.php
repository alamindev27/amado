@extends('layouts.app_frontend')
@section('title')
    <title>Product | Details | {{ $product->name }}</title>
@endsection
@section('products')
<div class="single-product-area section-padding-100 clearfix">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mt-50">

                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('shop', $product->relationwithcategory->slug) }}">{{ $product->relationwithcategory->name }}</a></li>
                        <li class="breadcrumb-item"><a href="javascript:viod(0)">product</a></li>
                        <li class="breadcrumb-item"><a href="javascript:viod(0)">{{ $product->name }}</a></li>

                    </ol>
                </nav>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-lg-7">
                <div class="single_product_thumb">
                    <div id="product_details_slider" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            @foreach ($productThumbnails as $productThumbnail)
                                <li class="{{ $loop->index == 0 ? 'active' : '' }}" data-target="#product_details_slider" data-slide-to="{{ $loop->index }}" style="background-image: url({{ asset('image/thumbnails') }}/{{ $productThumbnail->thumbnails }});">
                                </li>
                            @endforeach
                        </ol>
                        <div class="carousel-inner">
                            @foreach ($productThumbnails as $productThumbnail)
                            <div class="carousel-item {{ $loop->index == 0 ? 'active' : '' }}">
                                <a class="gallery_img" href="{{ asset('image/thumbnails') }}/{{ $productThumbnail->thumbnails }}">
                                    <img class="d-block w-100" src="{{ asset('image/thumbnails') }}/{{ $productThumbnail->thumbnails }}" alt="First slide">
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-5">
                <div class="single_product_desc">
                    <!-- Product Meta Data -->
                    <div class="product-meta-data">
                        <div class="line"></div>
                        <p class="product-price">{{ $product->price }} TK.</p>
                        <a href="javascript:viod(0)">
                            <h6>{{ $product->name }}</h6>
                        </a>
                        <!-- Ratings & Review -->
                        <div class="ratings-review mb-15 d-flex align-items-center justify-content-between">
                            <div class="ratings">
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                            </div>
                            <div class="review">
                                <a href="#">Write A Review</a>
                            </div>
                        </div>
                        <!-- Avaiable -->
                        @if ($product->stock > 1)
                            <p class="avaibility"><i class="fa fa-circle"></i> In Stock</p>
                        @else
                            <p class="unaibility"><i class="fa fa-circle"></i> Stock Out</p>
                        @endif
                    </div>

                    <div class="short_overview my-5">
                        {!! $product->description !!}
                    </div>

                    <!-- Add to Cart Form -->
                    <form class="cart clearfix" method="post" action="" id="addToCartForm">
                        <div class="cart-btn d-flex mb-50">
                            <p>Qty</p>
                            <div class="quantity">
                                <span class="qty-minus" onclick="var effect = document.getElementById('quentity'); var qty = effect.value; if( !isNaN( qty ) &amp;&amp; qty &gt; 1 ) effect.value--;return false;"><i class="fa fa-caret-down" aria-hidden="true"></i></span>
                                <input type="number" class="qty-text" id="quentity" step="1" min="1" max="300" name="quantity" value="1">
                                <span class="qty-plus" onclick="var effect = document.getElementById('quentity'); var qty = effect.value; if( !isNaN( qty )) effect.value++;return false;"><i class="fa fa-caret-up" aria-hidden="true"></i></span>
                            </div>
                        </div>
                        {{-- <button type="submit" name="addtocart" value="5" class="btn amado-btn">Add to cart</button> <br><br> --}}
                        <button type="submit" name="addtocart" value="5" class="btn amado-btn">Add to cart</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('footer_script')

<script>
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
</script>

@endsection
