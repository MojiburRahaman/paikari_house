@extends('frontend.master')

@section('content')



<div class="home-banner-area mb-4 pt-3">
    <div class="container">
        <div class="row gutters-10 position-relative">
            <div class="col-lg-3 position-static d-none d-lg-block">
                <div class="aiz-category-menu bg-white rounded  shadow-sm">
                    <div
                        class="p-3 bg-soft-primary d-none d-lg-block rounded-top all-category position-relative text-left">
                        <span class="fw-600 fs-16 mr-3">Categories</span>
                        <a href="categories.html" class="text-reset">
                            <span class="d-none d-lg-inline-block">See All ></span>
                        </a>
                    </div>
                    <ul class="list-unstyled categories no-scrollbar py-2 mb-0 text-left">
                        @foreach ($categories as $cat)
                        <li class="category-nav-element" data-id="1">
                            <a href="category/electronic%20devices.html"
                                class="text-truncate text-reset py-2 px-3 d-block">
                                <span class="cat-name"> > {{$cat->title}}</span>
                            </a>
                            <div class="sub-cat-menu c-scrollbar-light rounded shadow-lg p-4">
                                <div class="c-preloader text-center absolute-center">
                                    <i class="las la-spinner la-spin la-3x opacity-70"></i>
                                </div>
                            </div>
                        </li>
                        @endforeach

                    </ul>
                </div>
            </div>


            <div class=" col-lg-7 ">
                <div class="aiz-carousel dots-inside-bottom mobile-img-auto-height" data-arrows="true" data-dots="true"
                    data-autoplay="true">
                    <div class="carousel-box">
                        <a href="#">
                            <img class="d-block mw-100 img-fit rounded shadow-sm overflow-hidden"
                                src="{{asset('frontend/uploads/all/SMppu1iIPWlBYsEE8ZXZHoN1h3ch9YQdA6f5EiEr.png')}}"
                                alt="Paikari House promo" height="315"
                                onerror="this.onerror=null;this.src='public/assets/img/placeholder-rect.jpg';">
                        </a>
                    </div>
                    <div class="carousel-box">
                        <a href="#">
                            <img class="d-block mw-100 img-fit rounded shadow-sm overflow-hidden"
                                src="{{asset('frontend/uploads/all/SMppu1iIPWlBYsEE8ZXZHoN1h3ch9YQdA6f5EiEr.png')}}"
                                alt="Paikari House promo" height="315"
                                onerror="this.onerror=null;this.src='public/assets/img/placeholder-rect.jpg';">
                        </a>
                    </div>
                    <div class="carousel-box">
                        <a href="#">
                            <img class="d-block mw-100 img-fit rounded shadow-sm overflow-hidden"
                                src="{{asset('frontend/uploads/all/SMppu1iIPWlBYsEE8ZXZHoN1h3ch9YQdA6f5EiEr.png')}}"
                                alt="Paikari House promo" height="315"
                                onerror="this.onerror=null;this.src='public/assets/img/placeholder-rect.jpg';">
                        </a>
                    </div>
                </div>
                <ul class="list-unstyled mb-0 row gutters-5">
                    @foreach ($categories->take(7) as $cat)
                    <li class="minw-0 col-4 col-md mt-3">
                        <a href="category/electronic%20devices.html"
                            class="d-block rounded bg-white p-2 text-reset shadow-sm">
                            <img src="{{asset('category_images/'.$cat->thumbnail)}}"
                                data-src="{{asset('category_images/'.$cat->thumbnail)}}" alt="{{$cat->title}}"
                                class="lazyload img-fit" height="78"
                                onerror="this.onerror=null;this.src='{{asset('category_images/'.$cat->thumbnail)}}';">
                            <div class="text-truncate fs-12 fw-600 mt-2 opacity-70">{{$cat->title}}</div>
                        </a>
                    </li>
                    @endforeach
                    {{-- <li class="minw-0 col-4 col-md mt-3">
                        <a href="category/electronic%20accessories.html"
                            class="d-block rounded bg-white p-2 text-reset shadow-sm">
                            <img src="public/assets/img/placeholder.jpg"
                                data-src="public/uploads/all/QkqbkCEekbAJkeBes9MFptvC4nHT4B50uLlymxP1.jpg"
                                alt="Electronic Accessories" class="lazyload img-fit" height="78"
                                onerror="this.onerror=null;this.src='public/assets/img/placeholder-rect.jpg';">
                            <div class="text-truncate fs-12 fw-600 mt-2 opacity-70">Electronic Accessories
                            </div>
                        </a>
                    </li>
                    <li class="minw-0 col-4 col-md mt-3">
                        <a href="category/tv%20%26%20home%20appliances.html"
                            class="d-block rounded bg-white p-2 text-reset shadow-sm">
                            <img src="public/assets/img/placeholder.jpg"
                                data-src="public/uploads/all/62wbWdwYWZQ5srjdtyT4cbfUXiKyYDfjXTSTwbAK.jpg"
                                alt="TV &amp; Home Appliances" class="lazyload img-fit" height="78"
                                onerror="this.onerror=null;this.src='public/assets/img/placeholder-rect.jpg';">
                            <div class="text-truncate fs-12 fw-600 mt-2 opacity-70">TV &amp; Home Appliances
                            </div>
                        </a>
                    </li>
                    <li class="minw-0 col-4 col-md mt-3">
                        <a href="category/health%20%26%20beauty.html"
                            class="d-block rounded bg-white p-2 text-reset shadow-sm">
                            <img src="public/assets/img/placeholder.jpg"
                                data-src="public/uploads/all/dxzwX3eRNdZNw5Fbe85P07g1cvPCVSWL5sYW2buA.jpg"
                                alt="Health &amp; Beauty" class="lazyload img-fit" height="78"
                                onerror="this.onerror=null;this.src='public/assets/img/placeholder-rect.jpg';">
                            <div class="text-truncate fs-12 fw-600 mt-2 opacity-70">Health &amp; Beauty
                            </div>
                        </a>
                    </li>
                    <li class="minw-0 col-4 col-md mt-3">
                        <a href="category/babies%20%26%20toys.html"
                            class="d-block rounded bg-white p-2 text-reset shadow-sm">
                            <img src="public/assets/img/placeholder.jpg"
                                data-src="public/uploads/all/28XoHdJdAtmntbv6372RihQ3uhu5C4diElqw4Jpg.jpg"
                                alt="Babies &amp; Toys" class="lazyload img-fit" height="78"
                                onerror="this.onerror=null;this.src='public/assets/img/placeholder-rect.jpg';">
                            <div class="text-truncate fs-12 fw-600 mt-2 opacity-70">Babies &amp; Toys</div>
                        </a>
                    </li>
                    <li class="minw-0 col-4 col-md mt-3">
                        <a href="category/groceries%20%26%20pets.html"
                            class="d-block rounded bg-white p-2 text-reset shadow-sm">
                            <img src="public/assets/img/placeholder.jpg"
                                data-src="public/uploads/all/JxODqW1D5a3Za7CGu4GIvSovvdE68CrbvL1LQeZn.jpg"
                                alt="Groceries &amp; Pets" class="lazyload img-fit" height="78"
                                onerror="this.onerror=null;this.src='public/assets/img/placeholder-rect.jpg';">
                            <div class="text-truncate fs-12 fw-600 mt-2 opacity-70">Groceries &amp; Pets
                            </div>
                        </a>
                    </li>
                    <li class="minw-0 col-4 col-md mt-3">
                        <a href="category/women%27s%20fashion.html"
                            class="d-block rounded bg-white p-2 text-reset shadow-sm">
                            <img src="public/assets/img/placeholder.jpg"
                                data-src="public/uploads/all/bVbimlxhH9C6EoVNYQQt9Lt58e7eJHutNlO2VRJe.jpg"
                                alt="Women&#039;s Fashion" class="lazyload img-fit" height="78"
                                onerror="this.onerror=null;this.src='public/assets/img/placeholder-rect.jpg';">
                            <div class="text-truncate fs-12 fw-600 mt-2 opacity-70">Women&#039;s Fashion
                            </div>
                        </a>
                    </li>
                    <li class="minw-0 col-4 col-md mt-3">
                        <a href="category/men%27s%20fashion.html"
                            class="d-block rounded bg-white p-2 text-reset shadow-sm">
                            <img src="public/assets/img/placeholder.jpg"
                                data-src="public/uploads/all/84Pk16IpAfoJCgONGfnX4vCEhInokl0CPzMbuM49.jpg"
                                alt="Men&#039;s Fashion" class="lazyload img-fit" height="78"
                                onerror="this.onerror=null;this.src='public/assets/img/placeholder-rect.jpg';">
                            <div class="text-truncate fs-12 fw-600 mt-2 opacity-70">Men&#039;s Fashion</div>
                        </a>
                    </li>
                    <li class="minw-0 col-4 col-md mt-3">
                        <a href="category/watches%20%26%20accessories.html"
                            class="d-block rounded bg-white p-2 text-reset shadow-sm">
                            <img src="public/assets/img/placeholder.jpg"
                                data-src="public/uploads/all/uE8HBGe3M3CnFb14EXsvjCmMdO8YusdgFvch71IP.jpg"
                                alt="Watches &amp; Accessories" class="lazyload img-fit" height="78"
                                onerror="this.onerror=null;this.src='public/assets/img/placeholder-rect.jpg';">
                            <div class="text-truncate fs-12 fw-600 mt-2 opacity-70">Watches &amp;
                                Accessories</div>
                        </a>
                    </li> --}}
                </ul>
            </div>

            <div class="col-lg-2 order-3 mt-3 mt-lg-0">
                <div class="bg-success rounded shadow-sm">
                    <div class="bg-soft-primary rounded-top p-3 d-flex align-items-center justify-content-center">
                        <span class="fw-600 fs-16 mr-2 text-truncate">
                            Todays Deal
                        </span>
                        <span class="badge badge-primary badge-inline">Hot</span>
                    </div>
                    <div class="c-scrollbar-light overflow-auto h-lg-400px p-2 bg-primary rounded-bottom">
                        <div class="gutters-5 lg-no-gutters row row-cols-2 row-cols-lg-1">
                            <div class="col mb-2">
                                <a href="product/one-plus-warp-charge-65w-fast-charging-power-adapter.html"
                                    class="d-block p-2 text-reset bg-white h-100 rounded">
                                    <div class="row gutters-5 align-items-center">
                                        <div class="col-xxl">
                                            <div class="img">
                                                <img class="lazyload img-fit h-140px h-lg-80px"
                                                    src="{{asset('frontend/assets/img/placeholder.jpg')}}"
                                                    data-src="{{asset('frontend/uploads/all/fnGCnyVZRvCv4CfGPpeeZvl7aF7mzNDoFTQ9FMZY.png')}}"
                                                    alt="One Plus Warp Charge 65W Fast Charging Power Adapter"
                                                    onerror="this.onerror=null;this.src='public/assets/img/placeholder.jpg';">
                                            </div>
                                        </div>
                                        <div class="col-xxl">
                                            <div class="fs-16">
                                                <span class="d-block text-primary fw-600">৳1,100.00</span>
                                                <del class="d-block opacity-70">৳1,200.00</del>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col mb-2">
                                <a href="product/two-in-one-otg-converter-usb-to-type-c--micro-port-fast-data-transfer.html"
                                    class="d-block p-2 text-reset bg-white h-100 rounded">
                                    <div class="row gutters-5 align-items-center">
                                        <div class="col-xxl">
                                            <div class="img">
                                                <img class="lazyload img-fit h-140px h-lg-80px"
                                                    src="{{asset('frontend/assets/img/placeholder.jpg')}}"
                                                    data-src="{{asset('frontend/uploads/all/7oJqt9SiGVwSGLSvkEEbsXuwlhiMFzQoQjaQPR8O.jpg')}}"
                                                    alt="Two in One OTG Converter USB to Type-C &amp; Micro port Fast Data Transfer"
                                                    onerror="this.onerror=null;this.src='public/assets/img/placeholder.jpg';">
                                            </div>
                                        </div>
                                        <div class="col-xxl">
                                            <div class="fs-16">
                                                <span class="d-block text-primary fw-600">৳299.00</span>
                                                <del class="d-block opacity-70">৳350.00</del>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col mb-2">
                                <a href="product/senmai-is-200-stereo-sport-headphones.html"
                                    class="d-block p-2 text-reset bg-white h-100 rounded">
                                    <div class="row gutters-5 align-items-center">
                                        <div class="col-xxl">
                                            <div class="img">
                                                <img class="lazyload img-fit h-140px h-lg-80px"
                                                    src="public/assets/img/placeholder.jpg"
                                                    data-src="public/uploads/all/QCZxrddGSAyyllGYfSgg4frICXpANpb3Sb3IQmon.jpg"
                                                    alt="SENMAI iS-200 Stereo Sport Headphones"
                                                    onerror="this.onerror=null;this.src='public/assets/img/placeholder.jpg';">
                                            </div>
                                        </div>
                                        <div class="col-xxl">
                                            <div class="fs-16">
                                                <span class="d-block text-primary fw-600">৳990.00</span>
                                                <del class="d-block opacity-70">৳1,000.00</del>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col mb-2">
                                <a href="product/xiaomi-67-watt-fast-charger-type-c-adapter--cable.html"
                                    class="d-block p-2 text-reset bg-white h-100 rounded">
                                    <div class="row gutters-5 align-items-center">
                                        <div class="col-xxl">
                                            <div class="img">
                                                <img class="lazyload img-fit h-140px h-lg-80px"
                                                    src="public/assets/img/placeholder.jpg"
                                                    data-src="public/uploads/all/8rKbVyVkLBn0bGvVP0MQhkDOfilLD2QquW6vPcjS.png"
                                                    alt="Xiaomi 67 Watt Fast Charger (Type-C) Adapter + Cable"
                                                    onerror="this.onerror=null;this.src='public/assets/img/placeholder.jpg';">
                                            </div>
                                        </div>
                                        <div class="col-xxl">
                                            <div class="fs-16">
                                                <span class="d-block text-primary fw-600">৳2,500.00</span>
                                                <del class="d-block opacity-70">৳2,990.00</del>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col mb-2">
                                <a href="product/remax-rc-131th-gition-series-3-in-1-charging-cable.html"
                                    class="d-block p-2 text-reset bg-white h-100 rounded">
                                    <div class="row gutters-5 align-items-center">
                                        <div class="col-xxl">
                                            <div class="img">
                                                <img class="lazyload img-fit h-140px h-lg-80px"
                                                    src="public/assets/img/placeholder.jpg"
                                                    data-src="public/uploads/all/3N91UvOEA2eSOgxp5OARQskkIeC7tpHJj4lZZLah.jpg"
                                                    alt="REMAX RC-131TH GITION SERIES 3 IN 1 CHARGING CABLE"
                                                    onerror="this.onerror=null;this.src='public/assets/img/placeholder.jpg';">
                                            </div>
                                        </div>
                                        <div class="col-xxl">
                                            <div class="fs-16">
                                                <span class="d-block text-primary fw-600">৳520.00</span>
                                                <del class="d-block opacity-70">৳650.00</del>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>



<div class="mb-4">
    <div class="container">
        <div class="row gutters-10">
        </div>
    </div>
</div>





<div id="section_newest">
    <section class="mb-4">
        <div class="container">
            <div class="px-2 py-4 px-md-4 py-md-3 bg-white shadow-sm rounded">
                <div class="d-flex mb-3 align-items-baseline border-bottom">
                    <h3 class="h5 fw-700 mb-0">
                        <span class="border-bottom border-primary border-width-2 pb-3 d-inline-block">
                            New Products
                        </span>
                    </h3>
                </div>
                <div class="aiz-carousel gutters-10 half-outside-arrow" data-items="6" data-xl-items="5"
                    data-lg-items="4" data-md-items="3" data-sm-items="2" data-xs-items="2" data-arrows='true'>
                    @foreach ($Product as $latest_product)

                    <div class="carousel-box">
                        <div
                            class="aiz-card-box border border-light rounded hov-shadow-md mt-1 mb-2 has-transition bg-white">
                            @if ($latest_product->discount != '')

                            <span class="badge-custom">OFF<span
                                    class="box ml-1 mr-0">&nbsp;{{$latest_product->discount}}%</span></span>
                            @endif
                            <div class="position-relative">
                                <a href="{{route('ProductView',['vendor'=>$latest_product->vendor->slug,'product'=>$latest_product->slug])}}"
                                    class="d-block">
                                    <img class="img-fit lazyload mx-auto h-140px h-md-210px"
                                        src="{{(asset('thumbnail_img/'.$latest_product->thumbnail_img))}}"
                                        data-src="{{(asset('thumbnail_img/'.$latest_product->thumbnail_img))}}"
                                        alt="{{$latest_product->title}}"
                                        onerror="this.onerror=null;this.src='public/assets/img/placeholder.jpg';">
                                </a>
                                <div class="absolute-top-right aiz-p-hov-icon">
                                    <a href="javascript:void(0)" onclick="addToWishList(11)" data-toggle="tooltip"
                                        data-title="Add to wishlist" data-placement="left">
                                        <i class="la la-heart-o"></i>
                                    </a>
                                    <a href="javascript:void(0)" onclick="addToCompare(11)" data-toggle="tooltip"
                                        data-title="Add to compare" data-placement="left">
                                        <i class="las la-sync"></i>
                                    </a>
                                    <a href="javascript:void(0)" onclick="showAddToCartModal({{$latest_product->id}})" data-toggle="tooltip"
                                        data-title="Add to cart" data-placement="left">
                                        <i class="las la-shopping-cart"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="p-md-3 p-2 text-left">
                                <div class="fs-15">
                                    @if ($latest_product->discount != '')
                                    <del class="fw-600 opacity-50 mr-1">৳{{$latest_product->regular_price}}</del>
                                    <span class="fw-700 text-primary">৳{{$latest_product->sale_price}}</span>
                                    @else
                                    <span class="fw-700 text-primary">৳{{$latest_product->regular_price}}</span>
                                    
                                    @endif
                                </div>
                                <div class="rating rating-sm mt-1">
                                    <i class='las la-star'></i><i class='las la-star'></i><i class='las la-star'></i><i
                                        class='las la-star'></i><i class='las la-star'></i>
                                </div>
                                <h3 class="fw-600 fs-13 text-truncate-2 lh-1-4 mb-0 h-35px">
                                    <a href="{{route('ProductView',['vendor'=>$latest_product->vendor->slug,'product'=>$latest_product->slug])}}"
                                        class="d-block text-reset">{{$latest_product->title}}</a>
                                </h3>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
</div>
{{-- catgory wise product --}}
@forelse ($activeProductCategory as $cat)

<div id="section_newest">
    <section class="mb-4">
        <div class="container">
            <div class="text-right pb-2">

                <a href="brands.html" class="ml-auto mr-0 btn btn-primary btn-sm shadow-md">View More</a>
            </div>
            <div class="px-2 py-4 px-md-4 py-md-3 bg-white shadow-sm rounded">
                <div class="d-flex mb-3 align-items-baseline border-bottom">
                    <h3 class="h5 fw-700 mb-0">
                        <span class="border-bottom border-primary border-width-2 pb-3 d-inline-block">
                            {{$cat->title}}
                        </span>
                    </h3>

                </div>
                <div class="aiz-carousel gutters-10 half-outside-arrow" data-items="6" data-xl-items="5"
                    data-lg-items="4" data-md-items="3" data-sm-items="2" data-xs-items="2" data-arrows='true'>
                    @foreach ($cat->Product->take(20) as $latest_product)
                    <div class="carousel-box">
                        <div
                            class="aiz-card-box border border-light rounded hov-shadow-md mt-1 mb-2 has-transition bg-white">
                            @if ($latest_product->discount != '')

                            <span class="badge-custom">OFF<span
                                    class="box ml-1 mr-0">&nbsp;{{$latest_product->discount}}%</span></span>
                            @endif
                            <div class="position-relative">
                                <a href="{{route('ProductView',['vendor'=>$latest_product->vendor->slug,'product'=>$latest_product->slug])}}"
                                    class="d-block">
                                    <img class="img-fit lazyload mx-auto h-140px h-md-210px"
                                        src="{{(asset('thumbnail_img/'.$latest_product->thumbnail_img))}}"
                                        data-src="{{(asset('thumbnail_img/'.$latest_product->thumbnail_img))}}"
                                        alt="{{$latest_product->title}}"
                                        onerror="this.onerror=null;this.src='public/assets/img/placeholder.jpg';">
                                </a>
                                <div class="absolute-top-right aiz-p-hov-icon">
                                    <a href="javascript:void(0)" onclick="addToWishList(11)" data-toggle="tooltip"
                                        data-title="Add to wishlist" data-placement="left">
                                        <i class="la la-heart-o"></i>
                                    </a>
                                    <a href="javascript:void(0)" onclick="addToCompare(11)" data-toggle="tooltip"
                                        data-title="Add to compare" data-placement="left">
                                        <i class="las la-sync"></i>
                                    </a>
                                    <a href="javascript:void(0)" onclick="showAddToCartModal({{$latest_product->id}})" data-toggle="tooltip"
                                        data-title="Add to cart" data-placement="left">
                                        <i class="las la-shopping-cart"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="p-md-3 p-2 text-left">
                                <div class="fs-15">
                                    @if ($latest_product->discount != '')
                                    <del class="fw-600 opacity-50 mr-1">৳{{$latest_product->sale_price}}</del>
                                    @endif
                                    <span class="fw-700 text-primary">৳{{$latest_product->regular_price}}</span>
                                </div>
                                <div class="rating rating-sm mt-1">
                                    <i class='las la-star'></i><i class='las la-star'></i><i class='las la-star'></i><i
                                        class='las la-star'></i><i class='las la-star'></i>
                                </div>
                                <h3 class="fw-600 fs-13 text-truncate-2 lh-1-4 mb-0 h-35px">
                                    <a href="{{route('ProductView',['vendor'=>$latest_product->vendor->slug,'product'=>$latest_product->slug])}}"
                                        class="d-block text-reset">{{$latest_product->title}}</a>
                                </h3>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </section>
</div>
@empty

@endforelse


<div id="section_featured">

</div>


<div id="section_best_selling">

</div>

<!-- Auction Product -->




<div class="mb-4">
    <div class="container">
        <div class="row gutters-10">
        </div>
    </div>
</div>


<div id="section_home_categories">

</div>






<div id="section_best_sellers">

</div>


<section class="mb-4">
    <div class="container">
        <div class="row gutters-10">
            <div class="col-lg-6">
                <div class="d-flex mb-3 align-items-baseline border-bottom">
                    <h3 class="h5 fw-700 mb-0">
                        <span class="border-bottom border-primary border-width-2 pb-3 d-inline-block">Top 10
                            Categories</span>
                    </h3>
                    <a href="categories.html" class="ml-auto mr-0 btn btn-primary btn-sm shadow-md">View All
                        Categories</a>
                </div>
                <div class="row gutters-5">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="d-flex mb-3 align-items-baseline border-bottom">
                    <h3 class="h5 fw-700 mb-0">
                        <span class="border-bottom border-primary border-width-2 pb-3 d-inline-block">Top 10
                            Brands</span>
                    </h3>
                    <a href="brands.html" class="ml-auto mr-0 btn btn-primary btn-sm shadow-md">View All
                        Brands</a>
                </div>
                <div class="row gutters-5">
                </div>
            </div>
        </div>
    </div>
</section>


@endsection