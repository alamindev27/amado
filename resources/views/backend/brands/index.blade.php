@extends('layouts.app')
@section('title')
    <title>Add Brand</title>
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card-box m-auto"  style=" width:80%">
            <div class="dropdown pull-right">
                <a href="{{ route('brand.create') }}" class="btn btn-sm btn-primary">Add Brand</a>
            </div>
            <h4 class="header-title m-t-0 m-b-30">All Brand</h4>
            <div class="table-responsive">
                <table class="table m-0" id="datatable">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Brand Name</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @forelse ($brands as $brand)
                            <tr>
                                <th>{{ ++$loop->index }}</th>
                                <td>{{ $brand->name }}</td>
                                <td class="text-center">
                                    <form method="POST" action="{{ route('brand.destroy', Crypt::encrypt($brand->id)) }}" class="text-center">
                                        <a href="{{ route('brand.edit', Crypt::encrypt($brand->id)) }}" class="btn-info p-1"> <i class="fa fa-edit"></i></a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-danger"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                        <tr><td colspan="50">No Brands</td></tr>

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
