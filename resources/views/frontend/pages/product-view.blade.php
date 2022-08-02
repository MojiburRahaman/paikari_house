@extends('frontend.master')
@section('title',$product->title)
@section('content')
<section class="mb-4 pt-3">
    <div class="container">
        <div class="bg-white shadow-sm rounded p-3">
            <div class="row">
                <div class="col-xl-5 col-lg-6 mb-4">
                    <div class="sticky-top z-3 row gutters-10">
                        <div class="col order-1 order-md-2">
                            <div class="aiz-carousel product-gallery" data-nav-for='.product-gallery-thumb'
                                data-fade='true' data-auto-height='true'>
                                @foreach ($product->Gallery as $Gallery)

                                <div class="carousel-box img-zoom rounded">
                                    <img class="img-fluid lazyload" src="../public/assets/img/placeholder.jpg"
                                        data-src="{{asset('product_image/'.$Gallery->product_image)}}"
                                        onerror="this.onerror=null;this.src='{{asset('product_image/'.$Gallery->product_image)}}';">
                                </div>
                                @endforeach
                                {{-- <div class="carousel-box img-zoom rounded">
                                    <img class="img-fluid lazyload" src="../public/assets/img/placeholder.jpg"
                                        data-src="../public/uploads/all/llTbWld6KQ6t8jTqwBJDQu7JTiv8bbQGysqpBGqZ.jpg"
                                        onerror="this.onerror=null;this.src='../public/assets/img/placeholder.jpg';">
                                </div>
                                <div class="carousel-box img-zoom rounded">
                                    <img class="img-fluid lazyload" src="../public/assets/img/placeholder.jpg"
                                        data-src="../public/uploads/all/QeIiBXeA7sEBkLQMNercxnf1FCGa9etUSMiakXQq.jpg"
                                        onerror="this.onerror=null;this.src='../public/assets/img/placeholder.jpg';">
                                </div> --}}
                            </div>
                        </div>
                        <div class="col-12 col-md-auto w-md-80px order-2 order-md-1 mt-3 mt-md-0">
                            <div class="aiz-carousel product-gallery-thumb" data-items='5'
                                data-nav-for='.product-gallery' data-vertical='true' data-vertical-sm='false'
                                data-focus-select='true' data-arrows='true'>
                                @foreach ($product->Gallery as $Gallery)
                                <div class="carousel-box c-pointer border p-1 rounded">
                                    <img class="lazyload mw-100 size-50px mx-auto"
                                        src="{{asset('product_image/'.$Gallery->product_image)}}"
                                        data-src="../public/uploads/all/YXM9slPSq5LZl5rjRxpL6MRJaWxff4rcjG6z8gLV.jpg"
                                        onerror="this.onerror=null;this.src='{{asset('product_image/'.$Gallery->product_image)}}';">
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-7 col-lg-6">
                    <div class="text-left">
                        <h1 class="mb-2 fs-20 fw-600">
                            {{$product->title}}
                        </h1>

                        <div class="row align-items-center">
                            <div class="col-12">
                                <span class="rating">
                                    <i class='las la-star'></i><i class='las la-star'></i><i class='las la-star'></i><i
                                        class='las la-star'></i><i class='las la-star'></i>
                                </span>
                                <span class="ml-1 opacity-50">(0 reviews)</span>
                            </div>
                        </div>

                        <hr>

                        <div class="row align-items-center">
                            <div class="col-auto">
                                <small class="mr-2 opacity-50">Sold by: </small><br>
                                {{$product->Vendor->shop_name}}
                            </div>
                            <div class="col-auto">
                                <button class="btn btn-sm btn-soft-primary" onclick="show_chat_modal()">Message
                                    Seller</button>
                            </div>

                            <div class="col-auto">
                                <a href="../brand/baesus-gm7sl.html">
                                    <img src="../public/uploads/all/3uVU32TRa4Y9iQ2Sfgn7dJuPC4bmau1ypniHg5PY.gif"
                                        alt="Baesus" height="30">
                                </a>
                            </div>
                        </div>

                        <hr>
                        @if ($product->discount!= '')

                        <div class="row no-gutters mt-3">
                            <div class="col-sm-2">
                                <div class="opacity-50 my-2">Price:</div>
                            </div>
                            <div class="col-sm-10">
                                <div class="fs-20 opacity-60">
                                    <del>
                                        ৳{{$product->regular_price}}
                                        <span>/1</span>
                                    </del>
                                </div>
                            </div>
                        </div>

                        <div class="row no-gutters my-2">
                            <div class="col-sm-2">
                                <div class="opacity-50">Discount Price:</div>
                            </div>
                            <div class="col-sm-10">
                                <div class="">
                                    <strong class="h2 fw-600 text-primary">
                                        ৳{{$product->sale_price}}
                                    </strong>
                                    <span class="opacity-70">/1</span>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="row no-gutters my-2">
                            <div class="col-sm-2">
                                <div class="opacity-50"> Price:</div>
                            </div>
                            <div class="col-sm-10">
                                <div class="">
                                    <strong class="h2 fw-600 text-primary">
                                        ৳{{$product->regular_price}}
                                    </strong>
                                    <span class="opacity-70">/1</span>
                                </div>
                            </div>
                        </div>
                        @endif


                        <hr>

                        <form id="option-choice-form">
                            @csrf
                            <input type="hidden" name="vendor_id" value="{{$product->vendor_id}}">
                            <input type="hidden" name="product_id" value="{{$product->id}}">
                            <input type="hidden" name="brand_id" value="{{$product->brand_id}}">


                            <!-- Quantity + Add to cart -->
                            <div class="row no-gutters">
                                <div class="col-sm-2">
                                    <div class="opacity-50 my-2">Quantity:</div>
                                </div>
                                <div class="col-sm-10">
                                    <div class="product-quantity d-flex align-items-center">
                                        <div class="row no-gutters align-items-center aiz-plus-minus mr-3"
                                            style="width: 130px;">
                                            <button class="btn col-auto btn-icon btn-sm btn-circle btn-light"
                                                type="button" data-type="minus" data-field="quantity" disabled="">
                                                <i class="las la-minus"></i>
                                            </button>
                                            <input type="number" name="quantity"
                                                class="col border-0 text-center flex-grow-1 fs-16 input-number"
                                                placeholder="1" value="1" min="1" max="10">
                                            <button class="btn  col-auto btn-icon btn-sm btn-circle btn-light"
                                                type="button" data-type="plus" data-field="quantity">
                                                <i class="las la-plus"></i>
                                            </button>
                                        </div>
                                        <div class="avialable-amount opacity-60">
                                            (<span id="available-quantity">100</span> available)
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <div class="row no-gutters pb-3 d-none" id="chosen_price_div">
                                <div class="col-sm-2">
                                    <div class="opacity-50 my-2">Total Price:</div>
                                </div>
                                <div class="col-sm-10">
                                    <div class="product-price">
                                        <strong id="chosen_price" class="h4 fw-600 text-primary">

                                        </strong>
                                    </div>
                                </div>
                            </div>

                        </form>

                        <div class="mt-3">
                            <button type="button" class="btn btn-soft-primary mr-2 add-to-cart fw-600"
                                onclick="addToCart()">
                                <i class="las la-shopping-bag"></i>
                                <span class="d-none d-md-inline-block"> Add to cart</span>
                            </button>
                            <button type="button" class="btn btn-primary buy-now fw-600" onclick="buyNow()">
                                <i class="la la-shopping-cart"></i> Buy Now
                            </button>
                            <button type="button" class="btn btn-secondary out-of-stock fw-600 d-none" disabled>
                                <i class="la la-cart-arrow-down"></i> Out of Stock
                            </button>
                        </div>



                        <div class="d-table width-100 mt-3">
                            <div class="d-table-cell">
                                <!-- Add to wishlist button -->
                                <button type="button" class="btn pl-0 btn-link fw-600" onclick="addToWishList(2)">
                                    Add to wishlist
                                </button>
                                <!-- Add to compare button -->
                                <button type="button" class="btn btn-link btn-icon-left fw-600"
                                    onclick="addToCompare(2)">
                                    Add to compare
                                </button>
                            </div>
                        </div>


                        <div class="row no-gutters mt-4">
                            <div class="col-sm-2">
                                <div class="opacity-50 my-2">Share:</div>
                            </div>
                            <div class="col-sm-10">
                                <div class="aiz-share"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="mb-4">
    <div class="container">
        <div class="row gutters-10">
            <div class="col-xl-3 order-1 order-xl-0">
                <div class="bg-white rounded shadow-sm mb-3">
                    <div class="p-3 border-bottom fs-16 fw-600">
                        Trending Products
                    </div>
                    <div class="p-3">
                        <ul class="list-group list-group-flush">
                            @foreach ($trending_product as $product)
                                
                            <li class="py-3 px-0 list-group-item border-light">
                                <div class="row gutters-10 align-items-center">
                                    <div class="col-5">
                                        <a href="{{route('ProductView',['vendor'=>$product->vendor->slug,'product'=>$product->slug])}}"
                                            class="d-block text-reset">
                                            <img class="img-fit lazyload h-xxl-110px h-xl-80px h-120px"
                                                src="{{(asset('thumbnail_img/'.$product->thumbnail_img))}}"
                                                data-src="{{(asset('thumbnail_img/'.$product->thumbnail_img))}}"
                                                alt="{{$product->title}}"
                                                onerror="this.onerror=null;this.src='{{(asset('thumbnail_img/'.$product->thumbnail_img))}}';">
                                        </a>
                                    </div>
                                    <div class="col-7 text-left">
                                        <h4 class="fs-13 text-truncate-2">
                                            <a href="{{route('ProductView',['vendor'=>$product->vendor->slug,'product'=>$product->slug])}}"
                                                class="d-block text-reset">{{$product->title}}</a>
                                        </h4>
                                        <div class="rating rating-sm mt-1">
                                            <i class='las la-star'></i><i class='las la-star'></i><i
                                                class='las la-star'></i><i class='las la-star'></i><i
                                                class='las la-star'></i>
                                        </div>
                                        <div class="mt-2">
                                            @if ($product->discount != '')
                                                
                                            <span class="fs-17 fw-600 text-primary">৳{{$product->sale_price}}</span>
                                            @else

                                            <span class="fs-17 fw-600 text-primary">৳{{$product->regular_price}}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xl-9 order-0 order-xl-1">
                <div class="bg-white mb-3 shadow-sm rounded">
                    <div class="nav border-bottom aiz-nav-tabs">
                        <a href="#tab_default_1" data-toggle="tab"
                            class="p-3 fs-16 fw-600 text-reset active show">Description</a>
                        <a href="#tab_default_4" data-toggle="tab" class="p-3 fs-16 fw-600 text-reset">reviews</a>
                    </div>

                    <div class="tab-content pt-0">
                        <div class="tab-pane fade active show" id="tab_default_1">
                            <div class="p-4">
                                <div class="mw-100 overflow-hidden text-left aiz-editor-data">
                                    <div class="html-content pdp-product-highlights"
                                        style="margin: 0px; padding: 11px 0px 16px; word-break: break-word; border-bottom: 1px solid rgb(239, 240, 245); overflow: hidden; font-family: Roboto, -apple-system, BlinkMacSystemFont, &quot;Helvetica Neue&quot;, Helvetica, sans-serif;">
                                        {!!$product->product_description!!}
                                    </div>
                                    <div class="html-content detail-content"
                                        style="margin: 16px 0px 0px; padding: 0px 0px 16px; word-break: break-word; position: relative; height: auto; line-height: 19px; overflow-y: hidden; border-bottom: 1px solid rgb(239, 240, 245); font-family: Roboto, -apple-system, BlinkMacSystemFont, &quot;Helvetica Neue&quot;, Helvetica, sans-serif;">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="tab_default_2">
                            <div class="p-4">
                                <div class="embed-responsive embed-responsive-16by9">
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab_default_4">
                            <div class="p-4">
                                <ul class="list-group list-group-flush">
                                </ul>

                                <div class="text-center fs-18 opacity-70">
                                    There have been no reviews for this product yet.
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
                <div class="bg-white rounded shadow-sm">
                    <div class="border-bottom p-3">
                        <h3 class="fs-16 fw-600 mb-0">
                            <span class="mr-4">Related products</span>
                        </h3>
                    </div>
                    <div class="p-3">
                        <div class="aiz-carousel gutters-5 half-outside-arrow" data-items="5" data-xl-items="3"
                            data-lg-items="4" data-md-items="3" data-sm-items="2" data-xs-items="2" data-arrows='true'
                            data-infinite='true'>
                            @foreach ($similar_product as $product)
                            <div class="carousel-box">
                                <div class="aiz-card-box border border-light rounded hov-shadow-md my-2 has-transition">
                                    <div class="">
                                        <a href="{{route('ProductView',['vendor'=>$product->vendor->slug,'product'=>$product->slug])}}"
                                            class="d-block">
                                            <img class="img-fit lazyload mx-auto h-140px h-md-210px"
                                                src="{{(asset('thumbnail_img/'.$product->thumbnail_img))}}"
                                                data-src="{{(asset('thumbnail_img/'.$product->thumbnail_img))}}"
                                                alt="{{$product->title}}"
                                                onerror="this.onerror=null;this.src='{{(asset('thumbnail_img/'.$product->thumbnail_img))}}';">
                                        </a>
                                    </div>
                                    <div class="p-md-3 p-2 text-left">
                                        <div class="fs-15">
                                            @if ($product->discount != '')
                                                
                                            <del class="fw-600 opacity-50 mr-1">৳{{$product->sale_price}}</del>
                                            @endif
                                            <span class="fw-700 text-primary">৳{{$product->regular_price}}</span>
                                        </div>
                                        <div class="rating rating-sm mt-1">
                                            <i class='las la-star'></i><i class='las la-star'></i><i
                                                class='las la-star'></i><i class='las la-star'></i><i
                                                class='las la-star'></i>
                                        </div>
                                        <h3 class="fw-600 fs-13 text-truncate-2 lh-1-4 mb-0 h-35px">
                                            <a href="{{route('ProductView',['vendor'=>$product->vendor->slug,'product'=>$product->slug])}}"
                                                class="d-block text-reset">{{$product->title}}</a>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                                
                            @endforeach
                            {{-- <div class="carousel-box">
                                <div class="aiz-card-box border border-light rounded hov-shadow-md my-2 has-transition">
                                    <div class="">
                                        <a href="m29-wireless-earbuds-sp2kf.html" class="d-block">
                                            <img class="img-fit lazyload mx-auto h-140px h-md-210px"
                                                src="../public/assets/img/placeholder.jpg"
                                                data-src="../public/uploads/all/dXZHP3Az6rNyyjzoIOk6hgTf1HWia2lbqUqYxer3.jpg"
                                                alt="M29 Wirelss Earbuds with LED Display"
                                                onerror="this.onerror=null;this.src='../public/assets/img/placeholder.jpg';">
                                        </a>
                                    </div>
                                    <div class="p-md-3 p-2 text-left">
                                        <div class="fs-15">
                                            <del class="fw-600 opacity-50 mr-1">৳1,550.00</del>
                                            <span class="fw-700 text-primary">৳1,400.00</span>
                                        </div>
                                        <div class="rating rating-sm mt-1">
                                            <i class='las la-star'></i><i class='las la-star'></i><i
                                                class='las la-star'></i><i class='las la-star'></i><i
                                                class='las la-star'></i>
                                        </div>
                                        <h3 class="fw-600 fs-13 text-truncate-2 lh-1-4 mb-0 h-35px">
                                            <a href="m29-wireless-earbuds-sp2kf.html" class="d-block text-reset">M29
                                                Wirelss Earbuds with LED Display</a>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-box">
                                <div class="aiz-card-box border border-light rounded hov-shadow-md my-2 has-transition">
                                    <div class="">
                                        <a href="oraimo-2a-fast-charging-cable-type-c-1-metre.html" class="d-block">
                                            <img class="img-fit lazyload mx-auto h-140px h-md-210px"
                                                src="../public/assets/img/placeholder.jpg"
                                                data-src="../public/uploads/all/PpYTcSfTA1ObpyFJXcxNV2FDJXnu7vl730H67jjs.png"
                                                alt="Oraimo 2A Fast Charging Cable TYPE-C (1 metre)"
                                                onerror="this.onerror=null;this.src='../public/assets/img/placeholder.jpg';">
                                        </a>
                                    </div>
                                    <div class="p-md-3 p-2 text-left">
                                        <div class="fs-15">
                                            <del class="fw-600 opacity-50 mr-1">৳250.00</del>
                                            <span class="fw-700 text-primary">৳150.00</span>
                                        </div>
                                        <div class="rating rating-sm mt-1">
                                            <i class='las la-star'></i><i class='las la-star'></i><i
                                                class='las la-star'></i><i class='las la-star'></i><i
                                                class='las la-star'></i>
                                        </div>
                                        <h3 class="fw-600 fs-13 text-truncate-2 lh-1-4 mb-0 h-35px">
                                            <a href="oraimo-2a-fast-charging-cable-type-c-1-metre.html"
                                                class="d-block text-reset">Oraimo 2A Fast Charging Cable TYPE-C (1
                                                metre)</a>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-box">
                                <div class="aiz-card-box border border-light rounded hov-shadow-md my-2 has-transition">
                                    <div class="">
                                        <a href="one-plus-warp-charge-65w-fast-charging-power-adapter.html"
                                            class="d-block">
                                            <img class="img-fit lazyload mx-auto h-140px h-md-210px"
                                                src="../public/assets/img/placeholder.jpg"
                                                data-src="../public/uploads/all/fnGCnyVZRvCv4CfGPpeeZvl7aF7mzNDoFTQ9FMZY.png"
                                                alt="One Plus Warp Charge 65W Fast Charging Power Adapter"
                                                onerror="this.onerror=null;this.src='../public/assets/img/placeholder.jpg';">
                                        </a>
                                    </div>
                                    <div class="p-md-3 p-2 text-left">
                                        <div class="fs-15">
                                            <del class="fw-600 opacity-50 mr-1">৳1,200.00</del>
                                            <span class="fw-700 text-primary">৳1,100.00</span>
                                        </div>
                                        <div class="rating rating-sm mt-1">
                                            <i class='las la-star'></i><i class='las la-star'></i><i
                                                class='las la-star'></i><i class='las la-star'></i><i
                                                class='las la-star'></i>
                                        </div>
                                        <h3 class="fw-600 fs-13 text-truncate-2 lh-1-4 mb-0 h-35px">
                                            <a href="one-plus-warp-charge-65w-fast-charging-power-adapter.html"
                                                class="d-block text-reset">One Plus Warp Charge 65W Fast Charging Power
                                                Adapter</a>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-box">
                                <div class="aiz-card-box border border-light rounded hov-shadow-md my-2 has-transition">
                                    <div class="">
                                        <a href="awei-3-in-1-usb-cable-cl-971-for-micro-iphone-type-c-12-meter.html"
                                            class="d-block">
                                            <img class="img-fit lazyload mx-auto h-140px h-md-210px"
                                                src="../public/assets/img/placeholder.jpg"
                                                data-src="../public/uploads/all/JDmVHlWN6kLpSnLRSlVt2hQsgDn1qER6nXkTKXZT.jpg"
                                                alt="Awei 3 in 1 USB cable CL-971 for Micro, Iphone, Type-C (1.2 meter)"
                                                onerror="this.onerror=null;this.src='../public/assets/img/placeholder.jpg';">
                                        </a>
                                    </div>
                                    <div class="p-md-3 p-2 text-left">
                                        <div class="fs-15">
                                            <del class="fw-600 opacity-50 mr-1">৳350.00</del>
                                            <span class="fw-700 text-primary">৳300.00</span>
                                        </div>
                                        <div class="rating rating-sm mt-1">
                                            <i class='las la-star'></i><i class='las la-star'></i><i
                                                class='las la-star'></i><i class='las la-star'></i><i
                                                class='las la-star'></i>
                                        </div>
                                        <h3 class="fw-600 fs-13 text-truncate-2 lh-1-4 mb-0 h-35px">
                                            <a href="awei-3-in-1-usb-cable-cl-971-for-micro-iphone-type-c-12-meter.html"
                                                class="d-block text-reset">Awei 3 in 1 USB cable CL-971 for Micro,
                                                Iphone, Type-C (1.2 meter)</a>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-box">
                                <div class="aiz-card-box border border-light rounded hov-shadow-md my-2 has-transition">
                                    <div class="">
                                        <a href="two-in-one-otg-converter-usb-to-type-c--micro-port-fast-data-transfer.html"
                                            class="d-block">
                                            <img class="img-fit lazyload mx-auto h-140px h-md-210px"
                                                src="../public/assets/img/placeholder.jpg"
                                                data-src="../public/uploads/all/7oJqt9SiGVwSGLSvkEEbsXuwlhiMFzQoQjaQPR8O.jpg"
                                                alt="Two in One OTG Converter USB to Type-C &amp; Micro port Fast Data Transfer"
                                                onerror="this.onerror=null;this.src='../public/assets/img/placeholder.jpg';">
                                        </a>
                                    </div>
                                    <div class="p-md-3 p-2 text-left">
                                        <div class="fs-15">
                                            <del class="fw-600 opacity-50 mr-1">৳350.00</del>
                                            <span class="fw-700 text-primary">৳299.00</span>
                                        </div>
                                        <div class="rating rating-sm mt-1">
                                            <i class='las la-star'></i><i class='las la-star'></i><i
                                                class='las la-star'></i><i class='las la-star'></i><i
                                                class='las la-star'></i>
                                        </div>
                                        <h3 class="fw-600 fs-13 text-truncate-2 lh-1-4 mb-0 h-35px">
                                            <a href="two-in-one-otg-converter-usb-to-type-c--micro-port-fast-data-transfer.html"
                                                class="d-block text-reset">Two in One OTG Converter USB to Type-C &amp;
                                                Micro port Fast Data Transfer</a>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-box">
                                <div class="aiz-card-box border border-light rounded hov-shadow-md my-2 has-transition">
                                    <div class="">
                                        <a href="senmai-is-200-stereo-sport-headphones.html" class="d-block">
                                            <img class="img-fit lazyload mx-auto h-140px h-md-210px"
                                                src="../public/assets/img/placeholder.jpg"
                                                data-src="../public/uploads/all/QCZxrddGSAyyllGYfSgg4frICXpANpb3Sb3IQmon.jpg"
                                                alt="SENMAI iS-200 Stereo Sport Headphones"
                                                onerror="this.onerror=null;this.src='../public/assets/img/placeholder.jpg';">
                                        </a>
                                    </div>
                                    <div class="p-md-3 p-2 text-left">
                                        <div class="fs-15">
                                            <del class="fw-600 opacity-50 mr-1">৳1,000.00</del>
                                            <span class="fw-700 text-primary">৳990.00</span>
                                        </div>
                                        <div class="rating rating-sm mt-1">
                                            <i class='las la-star'></i><i class='las la-star'></i><i
                                                class='las la-star'></i><i class='las la-star'></i><i
                                                class='las la-star'></i>
                                        </div>
                                        <h3 class="fw-600 fs-13 text-truncate-2 lh-1-4 mb-0 h-35px">
                                            <a href="senmai-is-200-stereo-sport-headphones.html"
                                                class="d-block text-reset">SENMAI iS-200 Stereo Sport Headphones</a>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-box">
                                <div class="aiz-card-box border border-light rounded hov-shadow-md my-2 has-transition">
                                    <div class="">
                                        <a href="xiaomi-67-watt-fast-charger-type-c-adapter--cable.html"
                                            class="d-block">
                                            <img class="img-fit lazyload mx-auto h-140px h-md-210px"
                                                src="../public/assets/img/placeholder.jpg"
                                                data-src="../public/uploads/all/8rKbVyVkLBn0bGvVP0MQhkDOfilLD2QquW6vPcjS.png"
                                                alt="Xiaomi 67 Watt Fast Charger (Type-C) Adapter + Cable"
                                                onerror="this.onerror=null;this.src='../public/assets/img/placeholder.jpg';">
                                        </a>
                                    </div>
                                    <div class="p-md-3 p-2 text-left">
                                        <div class="fs-15">
                                            <del class="fw-600 opacity-50 mr-1">৳2,990.00</del>
                                            <span class="fw-700 text-primary">৳2,500.00</span>
                                        </div>
                                        <div class="rating rating-sm mt-1">
                                            <i class='las la-star'></i><i class='las la-star'></i><i
                                                class='las la-star'></i><i class='las la-star'></i><i
                                                class='las la-star'></i>
                                        </div>
                                        <h3 class="fw-600 fs-13 text-truncate-2 lh-1-4 mb-0 h-35px">
                                            <a href="xiaomi-67-watt-fast-charger-type-c-adapter--cable.html"
                                                class="d-block text-reset">Xiaomi 67 Watt Fast Charger (Type-C) Adapter
                                                + Cable</a>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-box">
                                <div class="aiz-card-box border border-light rounded hov-shadow-md my-2 has-transition">
                                    <div class="">
                                        <a href="remax-rc-131th-gition-series-3-in-1-charging-cable.html"
                                            class="d-block">
                                            <img class="img-fit lazyload mx-auto h-140px h-md-210px"
                                                src="../public/assets/img/placeholder.jpg"
                                                data-src="../public/uploads/all/3N91UvOEA2eSOgxp5OARQskkIeC7tpHJj4lZZLah.jpg"
                                                alt="REMAX RC-131TH GITION SERIES 3 IN 1 CHARGING CABLE"
                                                onerror="this.onerror=null;this.src='../public/assets/img/placeholder.jpg';">
                                        </a>
                                    </div>
                                    <div class="p-md-3 p-2 text-left">
                                        <div class="fs-15">
                                            <del class="fw-600 opacity-50 mr-1">৳650.00</del>
                                            <span class="fw-700 text-primary">৳520.00</span>
                                        </div>
                                        <div class="rating rating-sm mt-1">
                                            <i class='las la-star'></i><i class='las la-star'></i><i
                                                class='las la-star'></i><i class='las la-star'></i><i
                                                class='las la-star'></i>
                                        </div>
                                        <h3 class="fw-600 fs-13 text-truncate-2 lh-1-4 mb-0 h-35px">
                                            <a href="remax-rc-131th-gition-series-3-in-1-charging-cable.html"
                                                class="d-block text-reset">REMAX RC-131TH GITION SERIES 3 IN 1 CHARGING
                                                CABLE</a>
                                        </h3>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection