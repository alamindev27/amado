@extends('layouts.app_frontend')
@section('title')
    <title> Checkout</title>
@endsection
@section('products')
<div class="cart-table-area section-padding-100">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="checkout_details_area mt-50 clearfix">

                    <div class="cart-title">
                        <h2>Checkout</h2>
                    </div>

                    <form action="{{ route('checkout.store') }}" method="post" id="checkoutForm">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                @csrf
                                <input type="text" name="fname" class="form-control" value="" placeholder="Full Name" id="fname">
                                <span class="text-danger" id="fnameError">
                                    @error('fname')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="col-md-6 mb-3">
                                <input type="email" name="email" class="form-control" placeholder="Email" value="" id="email">
                                <span class="text-danger" id="emailError">
                                    @error('email')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="col-12 mb-3">
                                <select class="w-100" name="countryid" id="country_id">
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                    @endforeach
                            </select>
                            <span class="text-danger" id="countryidError">
                                @error('countryid')
                                        {{ $message }}
                                    @enderror
                            </span>
                            </div>
                            <div class="col-12 mb-3">
                                <input type="text" name="address" class="form-control mb-3" placeholder="Address" value="" id="address">
                                <span class="text-danger" id="addressError">
                                    @error('address')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="col-12 mb-3">
                                <input type="text" name="town" class="form-control" placeholder="Town" value="" id="town">
                                <span class="text-danger" id="townError">
                                    @error('town')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="col-md-6 mb-3">
                                <input type="number" name="postcode" class="form-control" placeholder="Post Code" value="" id="postcode">
                                <span class="text-danger" id="postcodeError">
                                    @error('postcode')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="col-md-6 mb-3">
                                <input type="number" name="number" class="form-control" min="0" placeholder="Phone No" value="" id="number">
                                <span class="text-danger" id="numberError">
                                    @error('number')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="col-12 mb-3">
                                <textarea name="message" class="form-control w-100" cols="30" rows="10" placeholder="Leave a comment about your order" id="message"></textarea>
                                <span class="text-danger" id="messageError">
                                    @error('message')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                </div>
            </div>
            <div class="col-12 col-lg-4">
                <div class="cart-summary">
                    <h5>Cart Total</h5>
                    <ul class="summary-table">
                        <li><span>subtotal:</span> <span>{{ session()->get('cartTotal') }} TK.</span></li>
                        <li><span>delivery:</span> <span>Free</span></li>
                        <li><span>total:</span> <span>{{ session()->get('cartTotal') }} TK.</span></li>
                    </ul>

                    <div class="payment-method">

                        <select name="payment" id="payment" class="form-control">
                            <option value="1">Cash on Delivery</option>
                            <option value="2">Online Payment</option>
                        </select>
                        <!-- Cash on delivery -->
                        {{-- <div class="custom-control custom-checkbox mr-sm-2">
                            <input type="checkbox" class="custom-control-input" id="cod" checked>
                            <label class="custom-control-label" for="cod">Cash on Delivery</label>
                        </div>
                        <!-- Paypal -->
                        <div class="custom-control custom-checkbox mr-sm-2">
                            <input type="checkbox" class="custom-control-input" id="paypal">
                            <label class="custom-control-label" for="paypal">Paypal <img class="ml-15" src="{{ asset('frontend') }}/img/core-img/paypal.png" alt=""></label>
                        </div> --}}
                    </div>

                    <div class="cart-btn mt-100">
                        <button type="submit" class="btn amado-btn w-100">PLACE ORDER</button>
                    </div>

                </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
@section('footer_script')
    <script>
        // $.ajaxSetup({
        //     headers: {
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     }
        // });
        // $('#checkoutForm').submit(function(e){
        //     e.preventDefault();
        //     var fname = $('#fname').val();
        //     var lname = $('#lname').val();
        //     var email = $('#email').val();
        //     var country_id = $('#country_id').val();
        //     var address = $('#address').val();
        //     var town = $('#town').val();
        //     var postcode = $('#postcode').val();
        //     var number = $('#number').val();
        //     var message = $('#message').val();
        //     var payment = $('#payment').val();
        //     $.ajax({
        //         type:'POST',
        //         url: "/checkout/store",
        //         data:{fname:fname, lname:lname, email:email, countryid: country_id, address:address, town:town,  postcode:postcode, number:number, message:message, payment:payment},
        //         success:function(data){
        //             console.log(data);
        //         },error(error){
        //             $('#fnameError').text(error.responseJSON.errors.fname);
        //             $('#lnameError').text(error.responseJSON.errors.lname);
        //             $('#emailError').text(error.responseJSON.errors.email);
        //             $('#countryidError').text(error.responseJSON.errors.countryid);
        //             $('#addressError').text(error.responseJSON.errors.address);
        //             $('#townError').text(error.responseJSON.errors.town);
        //             $('#postcodeError').text(error.responseJSON.errors.postcode);
        //             $('#numberError').text(error.responseJSON.errors.number);
        //             $('#messageError').text(error.responseJSON.errors.message);
        //         }
        //     });
        // });

    </script>
@endsection
