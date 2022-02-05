@extends('layouts.app')
@section('title')
    <title>single products</title>
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            <div class="dropdown pull-right">

                <a href="{{ route('products.index') }}" class="btn btn-sm btn-primary"> &laquo; All Product</a>
                @if ($product->user_id == auth()->id())
                    <a href="{{ route('products.edit', Crypt::encrypt($product->id)) }}" class="btn btn-sm btn-info">Edit Product</a>
                @endif
            </div>
            <h4 class="header-title m-t-0 m-b-30">Product BY - ({{ $product->relationwithuser->name }})</h4>
            <span><b>Published: </b> {{ $product->created_at->format('d M, y') }}</span>
            <div class="table-responsive">
                <table class="table m-0">
                    <tbody>
                        <tr>
                            <th>Product Name</th>
                            <td>{{ $product->name }}</td>
                        </tr>
                        <tr>
                            <th>Category</th>
                            <td> <div class="badge badge-success">{{ $product->relationwithcategory->name }}</div> </td>
                        </tr>
                        <tr>
                            <th>Brand</th>
                            <td> <div class="badge badge-primary">{{ $product->brands }}</div> </td>
                        </tr>
                        <tr>
                            <th>Price</th>
                            <td>{{ $product->price }} TK.</td>
                        </tr>
                        <tr>
                            <th>Stock</th>
                            <td>{{ $product->stock }}</td>
                        </tr>
                        <tr>
                            <th style="width: 20%">Description</th>
                            <td>{!! $product->description !!}</td>
                        </tr>
                        <tr>
                            <th>Product Image</th>
                            <td><img style="width: 80px; border:3px solid #aaa; border-radius:5px" src="{{ asset('image/product') }}/{{  $product->image  }}" alt="image"></td>
                        </tr>
                        <tr>
                            <th>Product Image</th>
                            <td>
                                @foreach ($thumbnails as $thumbnail)
                                    <img style="width: 80px; padding: 5px; border:3px solid #aaa; border-radius:5px" src="{{ asset('image/thumbnails') }}/{{  $thumbnail->thumbnails  }}" alt="thumbnail">
                                @endforeach
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div><!-- end col -->
</div>
@endsection
@section('footer_script')
    {{-- @if (session('success'))
        <script>
            Swal.fire({
            toast:true,
            position: 'top-end',
            icon: 'success',
            title: '{{ session('success') }}',
            showConfirmButton: false,
            timer: 1500
            });
        </script>
    @endif --}}
@endsection
