@extends('frontend.master')
@section('title',@config('app.name') .' - Cart')
@section('content')

<section id="cart-summary" class="mb-4 pt-5">
    <div class="container">
        <div class="row">
            <div class="col-xxl-8 col-xl-10 mx-auto">
                <div class="shadow-sm bg-white p-3 p-lg-4 rounded text-left">
                    <div class="mb-4">
                        <div class="row gutters-5 d-none d-lg-flex border-bottom mb-3 pb-3">
                            <div class="col-md-5 fw-600">Product</div>
                            <div class="col fw-600">Price</div>
                            <div class="col fw-600">Quantity</div>
                            <div class="col fw-600">Total</div>
                            <div class="col-auto fw-600">Remove</div>
                        </div>
                        <ul class="list-group list-group-flush">
                            @php
                            $subtotal = 0;
                            @endphp
                            @forelse ($carts as $cart)

                            <li class="list-group-item px-0 px-lg-3" id="cart_view{{$cart->id}}">
                                <div class="row gutters-5">
                                    <div class="col-lg-5 d-flex">
                                        <span class="mr-2 ml-0">
                                            <img src="{{asset('thumbnail_img/'.$cart->Product->thumbnail_img)}}"
                                                lazy="load" class="img-fit size-60px rounded"
                                                alt="{{$cart->Product->title}}">
                                        </span>
                                        <span class="fs-14 opacity-60">{{$cart->Product->title}}</span>
                                    </div>
                                    <div class="col-lg col-4 order-2 order-lg-0 my-3 my-lg-0">
                                        {{-- <span class="opacity-60 fs-12 d-block d-lg-none">Tax</span> --}}
                                        @if ($cart->Product->sale_price != '')

                                        <span class="fw-600 fs-16">৳{{$cart->Product->sale_price}}</span>
                                        @else
                                        <span class="fw-600 fs-16">৳{{$cart->Product->regular_price}}</span>

                                        @endif
                                    </div>

                                    <div class="col-lg col-6 order-4 order-lg-0">
                                        <div class="row no-gutters align-items-center aiz-plus-minus mr-2 ml-0">


                                            <button class="btn col-auto btn-icon btn-sm btn-circle btn-light"
                                                type="button" data-type="minus" data-field="quantity[{{$cart->id}}]">
                                                <i class="las la-minus"></i>
                                            </button>
                                            <input type="number" name="quantity[{{$cart->id}}]"
                                                class="col border-0 text-center flex-grow-1 fs-16 input-number"
                                                placeholder="1" value="{{$cart->quantity}}" min="1" max="88"
                                                onchange="updateQuantity({{$cart->id}}, this)">
                                            <button class="btn col-auto btn-icon btn-sm btn-circle btn-light"
                                                type="button" data-type="plus" data-field="quantity[{{$cart->id}}]">
                                                <i class="las la-plus"></i>
                                            </button>

                                        </div>
                                    </div>
                                    <div class="col-lg col-4 order-3 order-lg-0 my-3 my-lg-0 ">
                                        <span class="opacity-60 fs-12 d-block d-lg-none">Total</span>
                                        @if ($cart->Product->sale_price != '')

                                        @php
                                        $subtotal += $cart->Product->sale_price * $cart->quantity;

                                        @endphp

                                        <span class="fw-600 fs-16 text-primary ">
                                            ৳{{$cart->Product->sale_price * $cart->quantity}}
                                        </span>
                                        @else

                                        @php
                                        $subtotal += $cart->Product->regular_price * $cart->quantity;

                                        @endphp

                                        <span class="fw-600 fs-16 text-primary ">
                                            ৳{{$cart->Product->regular_price * $cart->quantity}}
                                        </span>

                                        @endif
                                    </div>
                                    <div class="col-lg-auto col-6 order-5 order-lg-0 text-right">
                                        <a href="javascript:void(0)" onclick="removeFromCartView(event, {{$cart->id}})"
                                            class="btn btn-icon btn-sm btn-soft-primary btn-circle">
                                            <i class="las la-trash"></i>
                                        </a>
                                    </div>
                                </div>
                            </li>
                            @empty
                            <li class="list-group-item px-0 px-lg-3">
                                <div class="row">
                                    <div class="col-12">
                                        <span class="text-center">
                                            no items
                                        </span>
                                    </div>
                                </div>
                            </li>
                            @endforelse
                        </ul>
                    </div>

                    <div class="px-3 py-2 mb-4 border-top d-flex justify-content-between cart_total">
                        <span class="opacity-60 fs-15">Subtotal</span>
                        <span class="fw-600 fs-17 cart_total ">৳{{$subtotal}}</span>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-md-6 text-center text-md-left order-1 order-md-0">
                            <a href="https://paikarihouse.com" class="btn btn-link">
                                <i class="las la-arrow-left"></i>
                                Return to shop
                            </a>
                        </div>
                        <div class="col-md-6 text-center text-md-right">
                            <a class="btn btn-primary fw-600" href="{{route('CheckoutView')}}">Continue to
                                Shipping</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('script_js')
<script>
    function removeFromCartView(e, key) {
            e.preventDefault();
            removeFromCart(key);
        }

        function updateQuantity(key, element) {
            $.post('{{route('CartUpdate')}}', {
                _token: '{{csrf_token()}}',
                id: key,
                quantity: element.value
            }, function(data) {
                updateNavCart(data.nav_cart_view, data.cart_count);
                $('#cart-summary').html(data.cart_view);
               
                
            });
        }
</script>
@endsection