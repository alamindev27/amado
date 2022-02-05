@extends('layouts.app')
@section('title')
    <title>Products</title>
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            <div class="dropdown pull-right">
                <a href="{{ route('products.create') }}" class="btn btn-sm btn-primary">Add Product</a>
            </div>
            <h4 class="header-title m-t-0 m-b-30">All Products</h4>
            <div class="table-responsive">
                <table class="table m-0" id="datatable">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th style="width: 20%">Product Name</th>
                        <th style="width: 15%">Category</th>
                        <th style="width: 15%">Price</th>
                        <th style="width: 30%">Image</th>
                        <th style="width: 25%">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                            <tr>
                                <th>{{ ++$loop->index }}</th>
                                <td>{{ $product->name }}</td>
                                <td class="text-center">
                                    <div class="badge badge-success">{{ $product->relationwithcategory->name }}</div>
                                </td>
                                <td class="text-center">{{ $product->price }}</td>
                                <td>
                                    <img style="width:40%" src="{{ asset('image/product') }}/{{ $product->image }}" alt="category image">
                                </td>
                                <td class="text-center">
                                    @if ($product->user_id == auth()->id())
                                        <form method="POST" action="{{ route('products.destroy', Crypt::encrypt($product->id)) }}" class="text-center">
                                            <a href="{{ route('products.show', Crypt::encrypt($product->id)) }}" class="btn-success p-1"><i class="fa fa-eye"></i></a>
                                            <a href="{{ route('products.edit', Crypt::encrypt($product->id)) }}" class="btn-info p-1"> <i class="fa fa-edit"></i></a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-danger"><i class="fa fa-trash"></i></button>
                                        </form>
                                    @else
                                        <a href="{{ route('products.show', Crypt::encrypt($product->id)) }}" class="btn-success p-1"><i class="fa fa-eye"></i></a>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="50">No Product</td></tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </div><!-- end col -->
</div>
@endsection
@section('footer_script')
    @if (session('success'))
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
    @endif
    <script>
        $(document).ready( function () {
            $('#datatable').DataTable();
        });
    </script>
@endsection
