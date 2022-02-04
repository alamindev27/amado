@extends('layouts.app')
@section('title')
    <title>Settings </title>
@endsection
@section('content')
<div class="row">
    <div class="col-xl-8 m-auto">
        <div class="card-box">
            <h4 class="header-title m-t-0 m-b-30">Edit Profile</h4>
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name">Name*</label>
                    <input type="text" name="name" placeholder="Enter name" class="form-control" id="name" value="{{ auth()->user()->name }}">
                    <span class="text-danger">
                        @error('name')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="profile">Profile</label>
                            <input type="file" name="profile" class="form-control" id="profile"onchange="document.getElementById('image_id').src = window.URL.createObjectURL(this.files[0])">
                            <span class="text-danger">
                                @error('profile')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <img src="{{ asset('image/profile') }}/{{ auth()->user()->profile }}" alt="profile photo" style="width: 100px;height:100px; border-radius:50%; border:1px solid #aaa;padding:3px" id="image_id">
                    </div>
                </div>
                <div class="form-group  text-center m-b-0">
                    <button class="btn btn-primary waves-effect waves-light" type="submit">
                        UPDATE PROFILE
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-xl-8 m-auto">
        <div class="card-box">
            <h4 class="header-title m-t-0 m-b-30">Change Password</h4>
            <form action="" method="POST" id="passwordForm">
                @csrf
                <div class="form-group">
                    <label for="password">Current Password*</label>
                    <input type="password" name="password" placeholder="Enter current password" class="form-control" id="password">
                    <span class="text-danger" id="passwordError"></span>
                </div>
                <div class="form-group">
                    <label for="newPassword">New Password*</label>
                    <input type="password" name="newPassword" placeholder="Enter new password" class="form-control" id="newPassword">
                    <span class="text-danger" id="newpasswordError"></span>
                </div>
                <div class="form-group">
                    <label for="conPassword">Confirm Password*</label>
                    <input type="password" name="conPassword" placeholder="Enter confirm password" class="form-control" id="conPassword">
                    <span class="text-danger" id="conpasswordError"></span>
                </div>
                <div class="form-group  text-center m-b-0">
                    <button class="btn btn-primary waves-effect waves-light" type="submit">
                        UPDATE PASSWORD
                    </button>
                </div>
            </form>
        </div>
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
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        function clearValue(){
            $('#password').val('');
            $('#newPassword').val('');
            $('#conPassword').val('');

            $('#passwordError').text('');
            $('#newpasswordError').text('');
            $('#conpasswordError').text('');
        }
        $('#passwordForm').submit(function(e){
            e.preventDefault();
            var password = $('#password').val();
            var newPassword = $('#newPassword').val();
            var conPassword = $('#conPassword').val();

            $.ajax({
                type:'POST',
                url: "/update/password",
                data:{password:password, newPassword:newPassword, conPassword:conPassword},
                success:function(data){
                    if(data == 'current'){
                        $('#passwordError').text('current password not match');
                    }
                    if(data == 'cpassnot'){
                        $('#newpasswordError').text('new password and confirm password not match');
                    }
                    if(data == 'done'){
                        clearValue();
                        Swal.fire({
                        toast:true,
                        position: 'top-end',
                        icon: 'success',
                        title: 'Password Update successfull',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    }
                },error:function(error){
                    $('#passwordError').text(error.responseJSON.errors.password);
                    $('#newpasswordError').text(error.responseJSON.errors.newPassword);
                    $('#conpasswordError').text(error.responseJSON.errors.conPassword);
                }
            });
        })

    </script>
@endsection
