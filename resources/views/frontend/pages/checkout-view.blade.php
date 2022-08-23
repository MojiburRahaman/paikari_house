@extends('frontend.master')

@section('content')
<section>
    <div class="container">
        <div class="row mt-5 mb-5">

            <div class="col-md-5 col-lg-4 order-md-last">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-primary">Your cart</span>
                    <span class="badge bg-primary rounded-pill">{{ $carts->count() }}</span>
                </h4>
                <ul class="list-group mb-3">
                    @php

                    $total = 0;

                    $collect = Collect($carts);
                    $total_vendor =$collect->unique('vendor_id')->count();
                    $delivery_charge = 60 * $total_vendor;


                    @endphp
                    @foreach ($carts as $cart)
                    <li class="list-group-item d-flex justify-content-between lh-sm">
                        <div>
                            <div class="row">
                                <div class="col-3">
                                    <img src="{{asset('thumbnail_img/'.$cart->Product->thumbnail_img)}}" lazy="load"
                                        class="img-fit size-60px rounded" alt="{{$cart->Product->title}}">
                                </div>
                                <div class="col-9 ">

                                    <h6 class="my-0">{{ $cart->Product->title }} </h6>
                                </div>
                            </div>
                        </div>
                        @if($cart->Product->sale_price != '')

                        @php
                        $total += round($cart->Product->sale_price *$cart->quantity);
                        @endphp

                        <span class="text-muted">${{ $cart->Product->sale_price }}</span>
                        @else

                        @php
                        $total += round($cart->Product->regular_price * $cart->quantity);
                        @endphp

                        <span class="text-muted">${{ $cart->Product->regular_price }}</span>

                        @endif
                    </li>
                    @endforeach

                    <li class="list-group-item d-flex justify-content-between bg-light">
                        <div class="text-success">
                            <h6 class="my-0">Total</h6>
                        </div>
                        <span class="text-success">${{ $total }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between bg-light">
                        <div class="text-success">
                            <h6 class="my-0">Promo code</h6>
                            <small id="coupon"> </small>
                        </div>
                        <span id="discount" class="text-success">−$0</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between bg-light">
                        <div class="text-success">
                            <h6 class="my-0">Delivery Charge</h6>
                        </div>
                        <span id="discount" class="text-success">+ ${{ $delivery_charge }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>SubTotal (USD)</span>
                        <strong id="total_amount">${{ round( $subtotal =$total + $delivery_charge) }}</strong>
                    </li>
                </ul>

                <form class="card p-2" id="couponForm">
                    <div class="input-group">
                        @csrf
                        <input type="text" name="coupon" class="form-control" placeholder="Promo code">
                        <button type="submit" class="btn btn-secondary">Redeem</button>
                    </div>
                    <span class="text-danger" id="coupon_err"></span>
                </form>
            </div>
            <div class="col-md-7 col-lg-8">
                <h4 class="mb-3">Billing address</h4>
                <form action="{{ route('CheckoutPost') }}" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-sm-12">
                            <label for="firstName" class="form-label">Name</label>
                            <input name="billing_user_name" type="text"
                                class="form-control @error('billing_user_name') is-invalid @enderror" id="firstName"
                                placeholder="" value="" required="">
                            @error('billing_user_name')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>

                        <div class="col-12 mt-4">
                            <label for="number" class="form-label">Number</label>
                            <input type="number" class="form-control @error('billing_number') is-invalid @enderror"
                                id="number" name="billing_number" required="">

                            @error('billing_number')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>

                        <div class="col-md-6 mt-4">
                            <label for="divisions_name" class="form-label"><span
                                    class="text-danger">*</span>Division</label>
                            <select name="division_name"
                                class="form-control @error('division_name') is-invalid @enderror form-control"
                                id="divisions_name">
                                <option value=>Select One</option>
                                @foreach ($divisions as $division)
                                <option value="{{$division->id}}">{{$division->name}}</option>
                                @endforeach
                            </select>

                            @error('division_name')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="col-6 col-sm-6 mt-4">
                            <label for="disctrict_name" class="form-label"><span
                                    class="text-danger">*</span>District</label>
                            <select class="@error('district_name') is-invalid @enderror form-control"
                                name="district_name" id="disctrict_name">

                            </select>
                            @error('district_name')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="col-12 mt-4">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control @error('billing_address') is-invalid @enderror"
                                id="address" name="billing_address" placeholder="1234 Main St" required="">

                            @error('billing_address')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="col-12 mt-4">
                            <label for="order_note" class="form-label">Order Note</label>
                            <textarea name="billing_order_note" id="order_note" class="form-control"></textarea>

                        </div>

                    </div>

                    <hr class="my-4">


                    <button class="w-100 btn btn-primary btn-lg" type="submit">Continue to checkout</button>
                </form>
            </div>

        </div>
    </div>
</section>

@php
session()->put('total_price',round($total));
session()->put('subtotal_price',round($subtotal));
session()->put('shipping',round($delivery_charge));

@endphp

@endsection

@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('script_js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
    $('#divisions_name').select2();
    $('#disctrict_name').select2();

});

// District fetch by division start 


$('#divisions_name').change(function(){
var division_id = $(this).val();

if (division_id) {
   
        $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        }),
            $.ajax({
                type: 'POST',
                url: '{{ route('GetDiistrict') }}' ,
                data :{division_id: division_id},
                success: function(res) {
                    if (res) {
                        $("#upozila_name").empty();
                        $("#disctrict_name").empty();
                        $("#disctrict_name").append('<option value=>Select One</option>');
                        $.each(res, function(key, value) {
                            $("#disctrict_name").append('<option value="' + value.id + '" >' +
                                value.name + '</option>');
                        });
                    } else {
                        $("disctrict_name").empty();
                    }
                }
            });
        }
        else{
            $("#disctrict_name").empty();
            $("#upozila_name").empty();
            $('#shipping_id').html(0);
        }
    });



// coupon part start
    jQuery(document).ready(function($) {

     $("#couponForm").submit(function(e) {

    e.preventDefault(); // avoid to execute the actual submit of the form.
    var form = $(this);
    var actionUrl = form.attr('action');

    $.ajax({
        type: "POST",
        url: "{{route('CouponPost')}}",
        data: form.serialize(), // serializes the form's elements.
        success: function(data)
    {

        $('#coupon_err').html('');
        $('#total_amount').html('$'+({{ $subtotal }} - data.discount));
        $('#discount').html( '-$'+ data.discount);
        $('#coupon').html(' {{ session()->get('coupon') }}');
        @php
        $discount = session()->get('discount');
session()->put('subtotal_price',round($subtotal) - $discount);
            
        @endphp
    
    },
    error:function (response) {
          $('#coupon_err').text(response.responseJSON.errors.coupon);
        }
            });
        });
     });
</script>

@endsection