@extends('layouts.authform')
@section('title')
<title>Set New Passwors</title>
@endsection
@section('auth_form')
@if (session('status'))
<div class="alert alert-success" role="alert">
    {{ session('status') }}
</div>
@endif
<div class="m-t-40 card-box">
    <div class="text-center">
        <h4 class="text-uppercase font-bold m-b-0">New Password</h4>
        <p class="text-muted m-b-0 font-13 m-t-20">Enter your email address and we'll send you an email with instructions to reset your password.  </p>
    </div>
    <div class="p-20">
        <form method="POST" action="{{ route('password.update') }}" class="form-horizontal m-t-20">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
            <div class="form-group">
                <div class="col-xs-12">
                    <input class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" type="email" placeholder="Enter email">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-12">
                    <input class="form-control @error('password') is-invalid @enderror" name="password" type="password" placeholder="Enter New Password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-12">
                    <input class="form-control" name="password_confirmation" type="password" placeholder="Enter Confirm Password">
                </div>
            </div>
            <div class="form-group text-center m-t-20 m-b-0">
                <div class="col-xs-12">
                    <button class="btn btn-custom btn-bordred btn-block waves-effect waves-light" type="submit">Send Email</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
