@extends('layouts.app')
@section('title')
    <title>Edit Brands</title>
@endsection
@section('content')
    <div class="col-xl-10 m-auto">
        <div class="card-box">
            <div class="dropdown pull-right">
                <a href="{{ route('brand.index') }}" class="btn btn-sm btn-info"> &laquo; Brands</a>
            </div>
            <h4 class="header-title m-t-0 m-b-30">Edit Brand</h4>
            <form class="form-horizontal" role="form" action="{{ route('brand.update', Crypt::encrypt($data->id)) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="form-group row">
                    <label for="brand_name" class="col-sm-4 col-form-label">Brand Name*</label>
                    <div class="col-sm-7">
                        <input type="text" name="name" class="form-control @error('name') ? parsley-error : '' @enderror" id="brand_name" placeholder="Brand name" data-parsley-id="17" value="{{ $data->name }}">
                        <ul class="parsley-errors-list filled" id="parsley-id-17">
                            @error('name')
                                <li class="parsley-required">{{ $message }}</li>
                            @enderror
                        </ul>
                    </div>
                </div>
                <div class="form-group">
                    <div class="offset-sm-4 col-sm-8">
                        <button type="submit" class="btn btn-primary waves-effect waves-light">
                            Update Brand
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
