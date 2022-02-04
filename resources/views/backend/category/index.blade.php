@extends('layouts.app')
@section('title')
    <title>Categories</title>
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            <div class="dropdown pull-right">
                <a href="{{ route('category.create') }}" class="btn btn-sm btn-primary">Add Category</a>
            </div>
            <h4 class="header-title m-t-0 m-b-30">All Categories</h4>
            <div class="table-responsive">
                <table class="table m-0" id="datatable">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th style="width: 20%">Category Name</th>
                        <th style="width: 15%">Category price</th>
                        <th style="width: 30%">Category Image)</th>
                        <th style="width: 15%">Status</th>
                        <th style="width: 25%">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $category)
                            <tr>
                                <th>{{ ++$loop->index }}</th>
                                <td>{{ $category->name }}</td>
                                <td class="text-center">{{ $category->price }}</td>
                                <td>
                                    <img style="width:40%" src="{{ asset('image/category') }}/{{ $category->image }}" alt="category image">
                                </td>
                                <td class="text-center">
                                    @if ($category->status == 1)
                                        <div class="badge badge-success">Active</div>
                                    @else
                                        <div class="badge badge-secondary">Deactive</div>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <form method="POST" action="{{ route('category.destroy', Crypt::encrypt($category->id)) }}" class="text-center">
                                        <a href="" class="btn-success p-1"><i class="fa fa-eye"></i></a>
                                        <a href="{{ route('category.edit', Crypt::encrypt($category->id)) }}" class="btn-info p-1"> <i class="fa fa-edit"></i></a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-danger"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty

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
