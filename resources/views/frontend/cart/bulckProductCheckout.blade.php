@extends('frontend.layouts.app')
@section('title', env('DEFAULT_TITLE') . ' | ' . 'Sinlge | Checkout')
@section('content')
    @php
        $pid = Str::random(25) . rand(0000, 9999);
    @endphp
    <section id="checkOut_wrapper" class="mt mb">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="form_wrapper">
                        <div class="cart_table_head">
                            <h3>Delivery Detail</h3>
                        </div>
                        <form action="{{ route('guest-alldirect-checkout') }}" id="myForm" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="text" name="newly_generated_pid" id="" value="{{ $pid }}"
                                hidden>
                            <input type="text" name="guestCheckout" id="" value="true" hidden>
                            <h3>Add Shipping Address</h3>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        {{ Form::label('name', 'Name') }}
                                        {{ Form::text('name', '', ['class' => 'form-control form-control-sm ' . ($errors->has('name') ? 'is-invalid' : ''), 'placeholder' => 'Enter Your Name Here.....', 'required' => true]) }}
                                        <span id="nameError" hidden class="text-danger"></span>
                                        @error('name')
                                            <div class="invalid-feedback">
                                                <i class="bx bx-radio-circle"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        {{ Form::label('email', 'Email') }}
                                        {{ Form::email('email', '', ['class' => 'form-control form-control-sm ' . ($errors->has('email') ? 'is-invalid' : ''), 'required' => true, 'placeholder' => 'Enter Your Email Here.....']) }}
                                        <span id="emailError" hidden class="text-danger"></span>
                                        @error('email')
                                            <div class="invalid-feedback">
                                                <i class="bx bx-radio-circle"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        {{ Form::label('phone', 'Phone') }}
                                        {{ Form::text('phone', '', ['class' => 'form-control form-control-sm ' . ($errors->has('phone') ? 'is-invalid' : ''), 'required' => true, 'placeholder' => 'Enter Your Phone Num Here.....']) }}
                                        <span id="phoneError" hidden class="text-danger"></span>
                                        @error('phone')
                                            <div class="invalid-feedback">
                                                <i class="bx bx-radio-circle"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        {{ Form::label('country', 'Country') }}
                                        <input type="text" name="country" id="country" value=""
                                            class="form-control" required>
                                        <span id="countryError" hidden class="text-danger"></span>
                                        @error('country')
                                            <div class="invalid-feedback">
                                                <i class="bx bx-radio-circle"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                {{-- <div class="col-lg-6">
                                    <div class="form-group">
                                        {{ Form::label('state', 'State') }}
                                        <input type="text" name="state" id="state" value=""
                                            class="form-control" required>
                                        <span id="stateError" hidden class="text-danger"></span>
                                        @error('state')
                                            <div class="invalid-feedback">
                                                <i class="bx bx-radio-circle"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div> --}}
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        {{ Form::label('province', 'State/Province') }}
                                        <input type="text" name="province" id="province" class="form-control" required>
                                        <span id="provinceError" hidden class="text-danger"></span>
                                        @error('province')
                                            <div class="invalid-feedback">
                                                <i class="bx bx-radio-circle"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        {{ Form::label('area', 'Area') }}
                                        <input type="text" name="area" id="area" class="form-control" required>
                                        <span id="areaError" hidden class="text-danger"></span>
                                        @error('area')
                                            <div class="invalid-feedback">
                                                <i class="bx bx-radio-circle"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                {{-- <div class="col-lg-6">
                                    <div class="form-group">
                                        {{ Form::label('additional_address', 'Additional Area') }}
                                        <input type="text" class="form-control additional_address" name="additional_address" id="additional_address" value="{{ @$s_address->additional_address }}">
                                        @error('additional_address')
                                            <div class="invalid-feedback">
                                                <i class="bx bx-radio-circle"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div> --}}
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        {{ Form::label('zip', 'Postal/Zip Code') }}
                                        {{-- <select name="zip" class="form-control zip_code_new" disabled>
                                            <option value="">--Your Zip Code---</option>
                                        </select> --}}
                                        <input type="text" class="form-control zip" name="zip" id="zip"
                                            value="{{ @$s_address->zip }}" required>
                                        <span id="zipError" hidden class="text-danger"></span>
                                        @error('zip')
                                            <div class="invalid-feedback">
                                                <i class="bx bx-radio-circle"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="shiping_address">
                                <div class="form-check">
                                    <input class="form-check-input same same_address" name="same_address" type="checkbox"
                                        value="1" id="flexCheckDefault">
                                    <label class="form-check-label same_address_text" for="flexCheckDefault">
                                        Billing address is the same as my shipping address
                                    </label>
                                </div>
                            </div>
                            <div class="row billingAddressField">
                                <h3>Add Billing Address</h3>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        {{ Form::label('nameB', 'Name') }}
                                        {{ Form::text('nameB', '', ['class' => 'form-control form-control-sm ' . ($errors->has('nameB') ? 'is-invalid' : ''), 'placeholder' => 'Enter Your Name Here.....', 'required' => true]) }}
                                        <span id="nameErrorB" hidden class="text-danger"></span>
                                        @error('nameB')
                                            <div class="invalid-feedback">
                                                <i class="bx bx-radio-circle"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        {{ Form::label('emailB', 'Email') }}
                                        {{ Form::email('emailB', '', ['class' => 'form-control form-control-sm ' . ($errors->has('emailB') ? 'is-invalid' : ''), 'required' => true, 'placeholder' => 'Enter Your Email Here.....']) }}
                                        <span id="emailErrorB" hidden class="text-danger"></span>
                                        @error('emailB')
                                            <div class="invalid-feedback">
                                                <i class="bx bx-radio-circle"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        {{ Form::label('phoneB', 'Phone') }}
                                        {{ Form::text('phoneB', '', ['class' => 'form-control form-control-sm ' . ($errors->has('phoneB') ? 'is-invalid' : ''), 'required' => true, 'placeholder' => 'Enter Your Phone Num Here.....']) }}
                                        <span id="phoneErrorB" hidden class="text-danger"></span>
                                        @error('phoneB')
                                            <div class="invalid-feedback">
                                                <i class="bx bx-radio-circle"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        {{ Form::label('countryB', 'Country') }}
                                        <input type="text" name="countryB" id="countryB" value=""
                                            class="form-control" required>
                                        <span id="countryErrorB" hidden class="text-danger"></span>
                                        @error('countryB')
                                            <div class="invalid-feedback">
                                                <i class="bx bx-radio-circle"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                {{-- <div class="col-lg-6">
                                    <div class="form-group">
                                        {{ Form::label('stateB', 'State') }}
                                        <input type="text" name="stateB" id="stateB" value=""
                                            class="form-control" required>
                                        <span id="stateErrorB" hidden class="text-danger"></span>
                                        @error('stateB')
                                            <div class="invalid-feedback">
                                                <i class="bx bx-radio-circle"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div> --}}
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        {{ Form::label('provinceB', 'State/Province') }}
                                        <input type="text" name="provinceB" id="provinceB" class="form-control" required>
                                        <span id="provinceErrorB" hidden class="text-danger"></span>
                                        @error('provinceB')
                                            <div class="invalid-feedback">
                                                <i class="bx bx-radio-circle"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        {{ Form::label('areaB', 'Area') }}
                                        <input type="text" name="areaB" id="areaB" class="form-control" required>
                                        <span id="areaErrorB" hidden class="text-danger"></span>
                                        @error('areaB')
                                            <div class="invalid-feedback">
                                                <i class="bx bx-radio-circle"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        {{ Form::label('zipB', 'Postal/Zip Code') }}
    
                                        <input type="text" class="form-control zip" name="zipB" id="zipB">
                                        <span id="zipErrorB" hidden class="text-danger"></span>
                                        @error('zipB')
                                            <div class="invalid-feedback">
                                                <i class="bx bx-radio-circle"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            
                            <div class="payment-options">
                                <h2 class="inner-title">Payment</h2>
                                
                                <div class="row">
                                    {{-- <div class="col-lg-4 col-md-4 col-sm-4">
                                        <div class="form-check">
                                            <input class="form-check-input paymentMethod" type="radio" name="payment"
                                                value="Hbl" id="flexRadioDefault2" checked>
                                            <label for="flexRadioDefault2" class="form-check-label"><img
                                                    src="{{ asset('frontend/vgjh.png') }}" alt=""></label>
                                        </div>
                                    </div> --}}

                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                        <div class="form-check">
                                            <input class="form-check-input paymentMethod" type="radio" name="payment"
                                                value="cod" id="flexRadioDefault2" checked>
                                            <label for="flexRadioDefault2" class="form-check-label"><img
                                                    src="{{ asset('frontend/images/cash.png') }}" alt=""></label>
                                        </div>
                                    </div>

                                    {{-- <div class="col-lg-4 col-md-4 col-sm-4">
                                        <div class="form-check">
                                            <input class="form-check-input paymentMethod" type="radio" name="payment"
                                                value="paypal" id="flexRadioDefault2">
                                            <label for="flexRadioDefault2" class="form-check-label paypal"><img
                                                    src="{{ asset('frontend/paypal.png') }}" alt=""></label>
                                        </div>
                                    </div> --}}
                                    <div class="col-lg-4 col-md-4 col-sm-4 qrImage" id="qrImage" style="display: none;">
                                        <img src="{{ asset('frontend/Celermart-QR.jpg') }}" alt=""
                                            style="width: 100%; height:250px;">
                                        <em class="text text-danger">Please provide your name and order id in the remarks
                                            section *</em>
                                    </div>
                                    
                                    
                                    <input type="hidden" id="shipping_charge" name="shipping_charge"
                                        value="{{ @$shipping_charge }}">

                                    <input type="hidden" class="coupoon_code" name="coupoon_code">
                                    <input type="hidden" class="coupon_name" name="coupon_name">
                                    <input type="hidden" class="coupon_code_name" name="coupon_code_name">

                                </div>
                                <div class="global-btns">
                                    <button type="button" class="btns checkout-one"> Continue to Checkout</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="checkout_detail_wrap">
                        <div class="cart_table_head">
                            <h3>Total Product</h3>
                            <div class="custom_badge">1</div>
                        </div>
                        <div class="pt-table-head">
                            <ul>
                                @foreach (request()->session()->get('guest_cart')['cart_item'] as $key => $item)
                                <li>
                                    <div class="tp-left">
                                        <h3>
                                            <a href="{{ route('product.details', $item['product_name']) }}">{{ $item['product_name'] }}
                                                * {{ $item['qty'] }}</a>
                                        </h3>
                                    </div>
                                    <div class="tp-right">
                                        <b>Rs.{{ $item['sub_total_price'] }}</b>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="pt-totals">
                            <ul>
                                <li>
                                    <span>Sub Total</span>
                                    <b class="all_sub_total">Rs.{{ request()->session()->get('guest_cart')['total_price'] ?? 0 }}</b>
                                </li>

                                {{-- <li>
                                    <span>Sub Total</span>
                                    <b class="">${{ @$sub_total - @$vatAmount }}</b>
                                </li> --}}
                                <li>
                                    <span>Shipping Charge</span>
                                    <b class="shipping_charge">Rs.{{ request()->session()->get('guest_cart')['shipping_charge'] ?? 0 }}</b>
                                </li>
                                {{-- @if ($material_charge)
                                    <li>
                                        <span>Material Charge</span>
                                        <b class="material_charge">${{ @$material_charge }}</b>
                                    </li>
                                @endif --}}
                                <li>
                                    <span>Coupon Price</span>
                                    <b class="found"></b>
                                </li>
                                {{-- @if ($vatAmount != 0 && $vatAmount > 0)
                                <li>
                                    <span>Vat %</span>
                                    <b>{{$vatAmount}}</b>
                                </li>
                                @endif --}}
                                <li>
                                    <span>Total</span>
                                    <b class="allTotal"
                                        data-totalAmount="{{ @request()->session()->get('guest_cart')['total_price'] ?? 0 }}">Rs. {{(request()->session()->get('guest_cart')['total_price'] + (request()->session()->get('guest_cart')['shipping_charge'] ?? 0)) ?? 0}}
                                    </b>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="" id="totalamountValue">
                        <input type="hidden" name="payment_amount" value="{{ @$total_amount }}"
                            data-payAmounts="{{ @$total_amount }}" id="payAmount">
                    </div>
                  
                </div>
            </div>
        </div>
    </section>

 

@endsection


@push('script')
    <script src="https://khalti.s3.ap-south-1.amazonaws.com/KPG/dist/2020.12.17.0.0.0/khalti-checkout.iffe.js"></script>
    <script type="text/javascript">
    $(document).ready(function(){
        $(document).on('click','#flexCheckDefault',function(){
            if ($('#flexCheckDefault').is(":checked"))
            {
                $(".billingAddressField").attr('hidden',true);
            }else{
                $(".billingAddressField").removeAttr('hidden');
            }
                
        });
        
            
    });
        function valueChanged() {
            if ($('#flexCheckDefault').is(":checked"))
                $(".ans").hide();
            else
                $(".ans").show();
        }
    </script>
    


    
    <script>
        var strRandom = function(length) {
            var result = '';
            var characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            var charactersLength = characte$.length;
            for (var i = 0; i < length; i++) {
                result += characte$.charAt(Math.floor(Math.random() * charactersLength));
            }
            return result;
        }
    </script>
    
    <script type="text/javascript">
        function valueChanged() {
            if ($('#flexCheckDefault').is(":checked"))
                $(".ans").hide();
            else
                $(".ans").show();
        }
    </script>
   
    
 

    

    <script>
        $('.billing_address').click(function() {
            $('.same_address').toggleClass('d-none');
            $('.same_address_text').toggleClass('d-none');
        });
        $('.same_address').click(function() {
            $('.billing_field').toggleClass('d-none');
        });
    </script>

   

    <script>
        $(document).ready(function() {
            $('.checkout-one').click(function() {

                let form = document.getElementById('myForm');
                var same = null;
                var coupoon_code = form['coupoon_code'].value;
                var coupon_name = form['coupon_name'].value;
                var coupon_code_name = form['coupon_code_name'].value;

                $('#nameError').attr('hidden',true);
                $('#nameError').text('');
                var shippingName=form['name'].value;
                if(!shippingName){
                    $('#nameError').removeAttr('hidden');
                    $('#nameError').text('Name Field Required....');
                }
                $('#emailError').attr('hidden',true);
                $('#emailError').text('');
                var shippingEmail=form['email'].value;
                if(!shippingEmail){
                    $('#emailError').removeAttr('hidden');
                    $('#emailError').text('Email Field Required....');
                }
                $('#phoneError').attr('hidden',true);
                $('#phoneError').text('');
                var shippingPhone=form['phone'].value;
                if(!shippingPhone){
                    $('#phoneError').removeAttr('hidden');
                    $('#phoneError').text('Phone Field Required....');
                }
                // $('#stateError').attr('hidden',true);
                // $('#stateError').text('');
                // var shippingState=form['state'].value;
                // if(!shippingState){
                //     $('#stateError').removeAttr('hidden');
                //     $('#stateError').text('State Field Required....');
                // }
                $('#provinceError').attr('hidden',true);
                $('#provinceError').text('');
                var shippingProvince=form['province'].value;
                if(!shippingProvince){
                    $('#provinceError').removeAttr('hidden');
                    $('#provinceError').text('Province Field Required....');
                }
                $('#areaError').attr('hidden',true);
                $('#areaError').text('');
                var shippingArea=form['area'].value;
                if(!shippingArea){
                    $('#areaError').removeAttr('hidden');
                    $('#areaError').text('Area Field Required....');
                }
                $('#zipError').attr('hidden',true);
                $('#zipError').text('');
                var shippingZip=form['zip'].value;
                if(!shippingZip){
                    $('#zipError').removeAttr('hidden');
                    $('#zipError').text('Zip Field Required....');
                }

               
                if ($('.same_address').is(":checked")) {
                    same = 1;
                } else {
                    same = null;
                };
                if(same ==null){
                    
                    $('#nameErrorB').attr('hidden',true);
                    $('#nameErrorB').text('');
                    var billingName=form['nameB'].value;
                    if(!billingName){
                        $('#nameErrorB').removeAttr('hidden');
                        $('#nameErrorB').text('Name Field Required....');
                        return false;
                    }
                    $('#emailErrorB').attr('hidden',true);
                    $('#emailErrorB').text('');
                    var billingEmail=form['emailB'].value;
                    if(!billingEmail){
                        $('#emailErrorB').removeAttr('hidden');
                        $('#emailErrorB').text('Email Field Required....');
                        return false;
                    }
                    $('#phoneErrorB').attr('hidden',true);
                    $('#phoneErrorB').text('');
                    var billingPhone=form['phoneB'].value;
                    if(!billingPhone){
                        $('#phoneErrorB').removeAttr('hidden');
                        $('#phoneErrorB').text('Phone Field Required....');
                        return false;
                    }
                    // $('#stateErrorB').attr('hidden',true);
                    // $('#stateErrorB').text('');
                    // var billingState=form['stateB'].value;
                    // if(!billingState){
                    //     $('#stateErrorB').removeAttr('hidden');
                    //     $('#stateErrorB').text('State Field Required....');
                    //     return false;
                    // }
                    $('#provinceErrorB').attr('hidden',true);
                    $('#provinceErrorB').text('');
                    var billingProvince=form['provinceB'].value;
                    if(!billingProvince){
                        $('#provinceErrorB').removeAttr('hidden');
                        $('#provinceErrorB').text('Province Field Required....');
                        return false;
                    }
                    $('#areaErrorB').attr('hidden',true);
                    $('#areaErrorB').text('');
                    var billingArea=form['areaB'].value;
                    if(!billingArea){
                        $('#areaErrorB').removeAttr('hidden');
                        $('#areaErrorB').text('Area Field Required....');
                        return false;
                    }
                    $('#zipErrorB').attr('hidden',true);
                    $('#zipErrorB').text('');
                    var billingZip=form['zipB'].value;
                    if(!billingZip){
                        $('#zipErrorB').removeAttr('hidden');
                        $('#zipErrorB').text('Zip Field Required....');
                        return false;
                    }
                    // return false;
                }
                // let data = {
                //     shipping_address: form['shippingAddress'].value,
                //     newly_generated_pid: form['newly_generated_pid'].value,
                //     billing_address: billing_address,
                //     same: same,
                //     coupoon_code: coupoon_code,
                //     coupon_name: coupon_name,
                //     coupon_code_name: coupon_code_name
                // }
                // var payment = $("input[name = 'payment']:checked").val();
                $('#myForm').submit();
            })
        });

        
    </script>
    

    
    <script>
        $(document).ready(function() {
            $(document).on('change', '.paymentMethod', function() {
                let payment_method = $(this).val();
                if (payment_method == 'Fonepay') {
                    $('.qrImage').show();
                } else {
                    $('.qrImage').hide();
                }
            });
        });
    </script>
@endpush
