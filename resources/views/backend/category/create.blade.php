@extends('layouts.app')
@section('title')
    <title>Create Category</title>
@endsection
@section('content')
    <div class="col-xl-10 m-auto">
        <div class="card-box">
            <div class="dropdown pull-right">
                <a href="{{ route('category.index') }}" class="btn btn-sm btn-info"> &laquo; Categories</a>
            </div>
            <h4 class="header-title m-t-0 m-b-30">Add A New Category</h4>
            <form class="form-horizontal" role="form" action="{{ route('category.store') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <label for="category_name" class="col-sm-4 col-form-label">Category Name*</label>
                    <div class="col-sm-7">
                        <input type="text" name="category_name" class="form-control @error('category_name') ? parsley-error : '' @enderror" id="category_name"
                            placeholder="Category name" data-parsley-id="17">
                        <ul class="parsley-errors-list filled" id="parsley-id-17">
                            @error('category_name')
                                <li class="parsley-required">{{ $message }}</li>
                            @enderror
                        </ul>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="category_price" class="col-sm-4 col-form-label">Category Pricing*</label>
                    <div class="col-sm-7">
                        <input type="text" name="category_price" class="form-control @error('category_price') ? parsley-error : '' @enderror" id="category_price"
                            placeholder="Category pricing" data-parsley-id="17">
                        <ul class="parsley-errors-list filled" id="parsley-id-17">
                            @error('category_price')
                                <li class="parsley-required">{{ $message }}</li>
                            @enderror
                        </ul>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="category_image" class="col-sm-4 col-form-label">Category Image*</label>
                    <div class="col-sm-7">
                        <input type="file" name="category_image" class="form-control @error('category_image') ? parsley-error : '' @enderror" id="category_image">
                        <ul class="parsley-errors-list filled" id="parsley-id-17">
                            @error('category_image')
                                <li class="parsley-required">{{ $message }}</li>
                            @enderror
                        </ul>
                    </div>
                </div>
                <div class="form-group">
                    <div class="offset-sm-4 col-sm-8">
                        <button type="submit" class="btn btn-primary waves-effect waves-light">
                            Add Category
                        </button>
                    </div>
                </div>
            </form>
        </div>
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
@endsection
