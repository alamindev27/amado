@extends('layouts.app')
@section('title')
    <title>Countries</title>
@endsection
@section('content')
    <div class="col-xl-10 m-auto">
        <div class="card-box">
            <div class="dropdown pull-right">
                {{-- <a href="{{ route('brand.index') }}" class="btn btn-sm btn-info"> &laquo; Brands</a> --}}
            </div>
            <h4 class="header-title m-t-0 m-b-30">Add Country</h4>
            <form class="form-horizontal" role="form" action="{{ route('country.store') }}" method="POST">
                @csrf
                <div class="form-group row">
                    <label for="brand_name" class="col-sm-4 col-form-label">Country*</label>
                    <div class="col-sm-7">
                        <select name="country_id[]" id="country" multiple="multiple" class="form-control">
                            <option value="">------Select Country</option>
                            @foreach ($countries as $country)
                                <option {{ $country->status == 1 ? 'selected' : '' }} value="{{ $country->id }}">{{ $country->name }}</option>
                            @endforeach
                        </select>
                        <ul class="parsley-errors-list filled" id="parsley-id-17">
                            @error('country_id')
                                <li class="parsley-required">{{ $message }}</li>
                            @enderror
                        </ul>
                    </div>
                </div>
                <div class="form-group">
                    <div class="offset-sm-4 col-sm-8">
                        <button type="submit" class="btn btn-primary waves-effect waves-light">
                            Add Country
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('footer_script')
    <script>
        $(document).ready(function() {
            $('#country').select2();
        });
    </script>
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
