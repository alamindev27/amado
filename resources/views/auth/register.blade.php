@extends('layouts.authform')
@section('title')
<title>REGISTER-</title>
@endsection
@section('auth_form')
<div class="m-t-40 card-box">
    <div class="text-center">
        <h4 class="text-uppercase font-bold m-b-0">Sign Up</h4>
    </div>
    <div class="p-20">
        <form class="form-horizontal m-t-20" action="{{ route('register') }}" method="POST">
            @csrf
            <div class="form-group">
                <div class="col-xs-12">
                    <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" placeholder="Enter Name">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-12">
                    <input class="form-control @error('email') is-invalid @enderror" type="text" name="email" placeholder=" Enter Email">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-12">
                    <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" placeholder="Enter Password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-12">
                    <input class="form-control @error('password_confirmation') is-invalid @enderror" type="password" name="password_confirmation" placeholder="Enter Confirm Password">
                </div>
            </div>
            <div class="form-group text-center m-t-30">
                <div class="col-xs-12">
                    <button class="btn btn-custom btn-bordred btn-block waves-effect waves-light" type="submit">Log In</button>
                </div>
            </div>
            <div class="form-group m-t-30 m-b-0">
                <div class="col-sm-12">
                    <a href="{{ route('password.request') }}" class="text-muted"><i class="fa fa-lock m-r-5"></i> Forgot your password?</a>
                </div>
            </div>
        </form>
    </div>
</div>


@endsection
