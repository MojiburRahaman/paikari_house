<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from paikarihouse.com/ by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 28 Apr 2022 19:38:37 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="app-url" content="//paikarihouse.com/">
    <meta name="file-base-url" content="//paikarihouse.com/public/">

    <title>@yield('title')</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="index, follow">
    <meta name="description" content="@yield('meta_description')" />
    <meta name="keywords" content="@yield('meta_keyword')">


    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="@yield('title')">
    <meta itemprop="description" content="@yield('meta_description')">
    <meta itemprop="image" content="{{asset('frontend/uploads/all/QS8ZmUrOUhcszhtGgjTFXUTnuNOCC82G8veGFB2y.png')}}">

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="product">
    <meta name="twitter:site" content="@publisher_handle">
    <meta name="twitter:title" content="Paikari House">
    <meta name="twitter:description" content="@yield('meta_description')">
    <meta name="twitter:creator" content="@author_handle">
    <meta name="twitter:image" content="public/uploads/all/QS8ZmUrOUhcszhtGgjTFXUTnuNOCC82G8veGFB2y.png">

    <!-- Open Graph data -->
    <meta property="og:title" content="@yield('title')" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="index.html" />
    <meta property="og:image" content="public/uploads/all/QS8ZmUrOUhcszhtGgjTFXUTnuNOCC82G8veGFB2y.png" />
    <meta property="og:description" content="@yield('meta_description')" />
    <meta property="og:site_name" content="Paikari House" />
    <meta property="fb:app_id" content="">

    <!-- Favicon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="icon" href="public/uploads/all/QS8ZmUrOUhcszhtGgjTFXUTnuNOCC82G8veGFB2y.png">

    <!-- Google Fonts -->
    <link
        href="../fonts.googleapis.com/cssd661.css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&amp;display=swap"
        rel="stylesheet">

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{asset('frontend/assets/css/vendors.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/assets/css/aiz-core.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/assets/css/custom-style.css')}}">
    @yield('css')


    <script>
        var AIZ = AIZ || {};
        AIZ.local = {
            nothing_selected: 'Nothing selected',
            nothing_found: 'Nothing found',
            choose_file: 'Choose File',
            file_selected: 'File selected',
            files_selected: 'Files selected',
            add_more_files: 'Add more files',
            adding_more_files: 'Adding more files',
            drop_files_here_paste_or: 'Drop files here, paste or',
            browse: 'Browse',
            upload_complete: 'Upload complete',
            upload_paused: 'Upload paused',
            resume_upload: 'Resume upload',
            pause_upload: 'Pause upload',
            retry_upload: 'Retry upload',
            cancel_upload: 'Cancel upload',
            uploading: 'Uploading',
            processing: 'Processing',
            complete: 'Complete',
            file: 'File',
            files: 'Files',
        }
    </script>

    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            font-weight: 400;
        }

        :root {
            --primary: #50C878;
            --hov-primary: FF5F1F;
            --soft-primary: rgba(80, 200, 120, 0.15);
        }

        #map {
            width: 100%;
            height: 250px;
        }

        #edit_map {
            width: 100%;
            height: 250px;
        }

        .pac-container {
            z-index: 100000;
        }
    </style>




</head>

<body>
    <div class="aiz-main-wrapper d-flex flex-column">

        <!-- Header -->
        <!-- Top Bar -->
        <div class="top-navbar bg-white border-bottom border-soft-secondary z-1035">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 col">
                        <ul class="list-inline d-flex justify-content-between justify-content-lg-start mb-0">
                            <li class="list-inline-item dropdown mr-3" id="lang-change">
                                <a href="javascript:void(0)" class="dropdown-toggle text-reset py-2"
                                    data-toggle="dropdown" data-display="static">
                                    <img src="public/assets/img/placeholder.jpg"
                                        data-src="https://paikarihouse.com/public/assets/img/flags/en.png"
                                        class="mr-2 lazyload" alt="English" height="11">
                                    <span class="opacity-60">English</span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-left">
                                    <li>
                                        <a href="javascript:void(0)" data-flag="en" class="dropdown-item ">
                                            <img src="public/assets/img/placeholder.jpg"
                                                data-src="https://paikarihouse.com/public/assets/img/flags/en.png"
                                                class="mr-1 lazyload" alt="English" height="11">
                                            <span class="language">English</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)" data-flag="bd" class="dropdown-item ">
                                            <img src="public/assets/img/placeholder.jpg"
                                                data-src="https://paikarihouse.com/public/assets/img/flags/bd.png"
                                                class="mr-1 lazyload" alt="Bangla" height="11">
                                            <span class="language">Bangla</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                        </ul>
                    </div>
                    @auth('web')

                    <div class="col-5 text-right d-none d-lg-block">
                        <ul class="list-inline mb-0 h-100 d-flex justify-content-end align-items-center">
                            <li class="list-inline-item mr-3 border-right border-left-0 pr-3 pl-0">
                                <a href=" {{route('UserProfile')}}"
                                    class="text-reset d-inline-block opacity-60 py-2">Dashboard</a>
                            </li>
                        </ul>
                    </div>
                    @else

                    <div class="col-5 text-right d-none d-lg-block">
                        <ul class="list-inline mb-0 h-100 d-flex justify-content-end align-items-center">
                            <li class="list-inline-item mr-3 border-right border-left-0 pr-3 pl-0">
                                <a href=" {{route('login')}}"
                                    class="text-reset d-inline-block opacity-60 py-2">Login</a>
                            </li>
                            <li class="list-inline-item">
                                <a href="{{route('register')}}"
                                    class="text-reset d-inline-block opacity-60 py-2">Registration</a>
                            </li>
                        </ul>
                    </div>
                    @endauth
                </div>
            </div>
        </div>
        <!-- END Top Bar -->
        <header class=" sticky-top  z-1020 bg-white border-bottom shadow-sm">
            <div class="position-relative logo-bar-area z-1">
                <div class="container">
                    <div class="d-flex align-items-center">

                        <div class="col-auto col-xl-3 pl-0 pr-3 d-flex align-items-center">
                            <a class="d-block py-20px mr-3 ml-0" href="{{route('FrontendView')}}">
                                <img src="public/uploads/all/ZnsGwxqm4iLaBmbmMJV11WDbi7phJtgeDVZi23RX.png"
                                    alt="Paikari House" class="mw-100 h-30px h-md-40px" height="40">
                            </a>

                        </div>

                        @if(url()->current() != route('FrontendView'))

                        <div class="d-none d-xl-block align-self-stretch category-menu-icon-box ml-auto mr-0">

                            <div class="h-100 d-flex align-items-center" id="category-menu-icon">
                                <div
                                    class="dropdown-toggle navbar-light bg-light h-40px w-50px pl-2 rounded border c-pointer">
                                    <span class="navbar-toggler-icon"></span>
                                </div>
                            </div>

                        </div>
                        @endif

                        <div class="d-lg-none ml-auto mr-0">
                            <a class="p-2 d-block text-reset" href="javascript:void(0);" data-toggle="class-toggle"
                                data-target=".front-header-search">
                                <i class="las la-search la-flip-horizontal la-2x"></i>
                            </a>
                        </div>

                        <div class="flex-grow-1 front-header-search d-flex align-items-center bg-white">
                            <div class="position-relative flex-grow-1">
                                <form action="" method="GET" class="stop-propagation">
                                    <div class="d-flex position-relative align-items-center">
                                        <div class="d-lg-none" data-toggle="class-toggle"
                                            data-target=".front-header-search">
                                            <button class="btn px-2" type="button"><i
                                                    class="la la-2x la-long-arrow-left"></i></button>
                                        </div>
                                        <div class="input-group">
                                            <input type="text" class="border-0 border-lg form-control" id="search"
                                                name="search" placeholder="I am shopping for..." autocomplete="off">
                                            <div class="input-group-append d-none d-lg-block">
                                                <button class="btn btn-primary" type="submit">
                                                    <i class="la la-search la-flip-horizontal fs-18"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <div class="typed-search-box stop-propagation document-click-d-none d-none bg-white rounded shadow-lg position-absolute left-0 top-100 w-100"
                                    style="min-height: 200px">
                                    <div class="search-preloader absolute-top-center">
                                        <div class="dot-loader">
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                        </div>
                                    </div>
                                    <div class="search-nothing d-none p-3 text-center fs-16">

                                    </div>
                                    <div id="search-content" class="text-left">

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-none d-lg-none ml-3 mr-0">
                            <div class="nav-search-box">
                                <a href="#" class="nav-box-link">
                                    <i class="la la-search la-flip-horizontal d-inline-block nav-box-icon"></i>
                                </a>
                            </div>
                        </div>

                        <div class="d-none d-lg-block ml-3 mr-0">
                            <div class="" id="compare">
                                <a href="{{ route('CompareView') }}" class="d-flex align-items-center text-reset">
                                    <i class="la la-refresh la-2x opacity-80"></i>
                                    <span class="flex-grow-1 ml-1">
                                        @php
                                        $Compare= App\Models\Compare::Where('cookie_id',
                                        Cookie::get('cookie_id'))->count()
                                        @endphp
                                        <span class="badge badge-primary badge-inline badge-pill">{{ $Compare }}</span>
                                        <span class="nav-box-text d-none d-xl-block opacity-70">Compare</span>
                                    </span>
                                </a>
                            </div>
                        </div>

                        <div class="d-none d-lg-block ml-3 mr-0">
                            <div class="" id="wishlist">
                                <a href=" {{route('WishListView')}}" class="d-flex align-items-center text-reset">
                                    <i class="la la-heart-o la-2x opacity-80"></i>
                                    <span class="flex-grow-1 ml-1">
                                        @auth('web')
                                        @php
                                        $wishlist = App\Models\Wishlist::whereUserId(auth('web')->id())->count();
                                        @endphp
                                        <span class="badge badge-primary badge-inline badge-pill">{{ $wishlist }}</span>
                                        @else
                                        <span class="badge badge-primary badge-inline badge-pill">0</span>
                                        @endauth
                                        <span class="nav-box-text d-none d-xl-block opacity-70">Wishlist</span>
                                    </span>
                                </a>
                            </div>
                        </div>

                        <div class="d-none d-lg-block  align-self-stretch ml-3 mr-0" data-hover="dropdown">
                            <div class="nav-cart-box dropdown h-100" id="cart_items">
                                <a href="javascript:void(0)" class="d-flex align-items-center text-reset h-100"
                                    data-toggle="dropdown" data-display="static">
                                    <i class="la la-shopping-cart la-2x opacity-80"></i>
                                    <span class="flex-grow-1 ml-1">
                                        <span class="badge badge-primary badge-inline badge-pill cart-count">0</span>
                                        <span class="nav-box-text d-none d-xl-block opacity-70">Cart</span>
                                    </span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg p-0 stop-propagation">

                                    <div class="text-center p-3">
                                        <i class="las la-frown la-3x opacity-60 mb-3"></i>
                                        <h3 class="h6 fw-700">Your Cart is empty</h3>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div id="hover-category-menu"
                class="hover-category-menu position-absolute w-100 top-100 left-0 right-0 z-3 d-none">

                <div class="container">
                    <div class="row gutters-10 position-relative">
                        <div class="col-lg-3 position-static">
                            <div class="aiz-category-menu bg-white rounded  shadow-lg" id="category-sidebar">
                                <div
                                    class="p-3 bg-soft-primary d-none d-lg-block rounded-top all-category position-relative text-left">
                                    <span class="fw-600 fs-16 mr-3">Categories</span>
                                    <a href="https://paikarihouse.com/categories" class="text-reset">
                                        <span class="d-none d-lg-inline-block">See All &gt;</span>
                                    </a>
                                </div>
                                <ul class="list-unstyled categories no-scrollbar py-2 mb-0 text-left">
                                    @foreach ($categories as $cat)

                                    <li class="category-nav-element" data-id="{{ $cat->id }}">
                                        <a href="https://paikarihouse.com/category/electronic%20devices"
                                            class="text-truncate text-reset py-2 px-3 d-block">
                                            <img class="cat-image mr-2 opacity-60 ls-is-cached lazyloaded"
                                                src="https://paikarihouse.com/public/uploads/all/pdzCbEJNQvkCTdv0sNi228oURvGylI06O5upAbdP.png"
                                                data-src="https://paikarihouse.com/public/uploads/all/pdzCbEJNQvkCTdv0sNi228oURvGylI06O5upAbdP.png"
                                                alt="Electronic Devices"
                                                onerror="this.onerror=null;this.src='https://paikarihouse.com/public/assets/img/placeholder.jpg';"
                                                width="16">
                                            <span class="cat-name">{{ $cat->title }}</span>
                                        </a>
                                        <div class="sub-cat-menu c-scrollbar-light rounded shadow-lg p-4 loaded">
                                            <div class="card-columns">
                                                @foreach ($cat->SubCategory as $Subcategory)

                                                <div class="card shadow-none border-0">
                                                    <ul class="list-unstyled mb-3">
                                                        <li class="fw-600 border-bottom pb-2 mb-3">
                                                            <a class="text-reset"
                                                                href="https://paikarihouse.com/category/Smartphones">{{
                                                                $Subcategory->title }}</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                @endforeach

                                            </div>
                                        </div>
                                    </li>
                                    @endforeach

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="bg-success border-top border-gray-200 py-1">
                <div class="container">
                    <ul class="list-inline mb-0 pl-0 mobile-hor-swipe text-center">
                        <li class="list-inline-item mr-0">
                            <a href="{{ route('FrontendView') }}"
                                class="opacity-60 fs-14 px-3 py-2 d-inline-block fw-600 hov-opacity-100 text-reset">
                                Home
                            </a>
                        </li>
                        <li class="list-inline-item mr-0">
                            <a href="index.html"
                                class="opacity-60 fs-14 px-3 py-2 d-inline-block fw-600 hov-opacity-100 text-reset">
                                Flash Sale
                            </a>
                        </li>
                        <li class="list-inline-item mr-0">
                            <a href="index.html"
                                class="opacity-60 fs-14 px-3 py-2 d-inline-block fw-600 hov-opacity-100 text-reset">
                                Blogs
                            </a>
                        </li>
                        <li class="list-inline-item mr-0">
                            <a href="index.html"
                                class="opacity-60 fs-14 px-3 py-2 d-inline-block fw-600 hov-opacity-100 text-reset">
                                All Brands
                            </a>
                        </li>
                        <li class="list-inline-item mr-0">
                            <a href="index.html"
                                class="opacity-60 fs-14 px-3 py-2 d-inline-block fw-600 hov-opacity-100 text-reset">
                                All categories
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </header>

        <div class="modal fade" id="order_details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                <div class="modal-content">
                    <div id="order-details-modal-body">

                    </div>
                </div>
            </div>
        </div>

        <!-- aiz-main-wrapper -->
        @yield('content')

    </div>
    <section class="bg-white border-top mt-auto">
        <div class="container">
            <div class="row no-gutters">
                <div class="col-lg-3 col-md-6">
                    <a class="text-reset border-left text-center p-4 d-block" href="terms.html">
                        <i class="la la-file-text la-3x text-primary mb-2"></i>
                        <h4 class="h6">Terms &amp; conditions</h4>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <a class="text-reset border-left text-center p-4 d-block" href="return-policy.html">
                        <i class="la la-mail-reply la-3x text-primary mb-2"></i>
                        <h4 class="h6">return policy</h4>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <a class="text-reset border-left text-center p-4 d-block" href="support-policy.html">
                        <i class="la la-support la-3x text-primary mb-2"></i>
                        <h4 class="h6">Support Policy</h4>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <a class="text-reset border-left border-right text-center p-4 d-block" href="privacy-policy.html">
                        <i class="las la-exclamation-circle la-3x text-primary mb-2"></i>
                        <h4 class="h6">privacy policy</h4>
                    </a>
                </div>
            </div>
        </div>
    </section>
    {{-- footer --}}
    <section class="bg-dark py-5 text-light footer-widget">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-xl-4 text-center text-md-left">
                    <div class="mt-4">
                        <a href="index.html" class="d-block">
                            <img class="lazyload" src="public/assets/img/placeholder-rect.jpg"
                                data-src="https://paikarihouse.com/public/uploads/all/D3RDV09e8r7WKxy8dDZNGYSeGMp4INAIP8hGLhUz.png"
                                alt="Paikari House" height="44">
                        </a>
                        <div class="my-3">

                        </div>
                        <div class="d-inline-block d-md-block mb-4">
                            <form class="form-inline" method="POST" action="">
                                @csrf
                                <div class="form-group mb-0">
                                    <input type="email" class="form-control" placeholder="Your Email Address"
                                        name="email" required>
                                </div>
                                <button type="submit" class="btn btn-primary">
                                    Subscribe
                                </button>
                            </form>
                        </div>
                        <div class="w-300px mw-100 mx-auto mx-md-0">
                            <a href="https://play.google.com/store/apps/details?id=com.paikari.house" target="_blank"
                                class="d-inline-block mr-3 ml-0">
                                <img src="public/assets/img/play.png" class="mx-100 h-40px">
                            </a>
                            <a href="https://play.google.com/store/apps/details?id=com.paikari.house" target="_blank"
                                class="d-inline-block">
                                <img src="public/assets/img/app.png" class="mx-100 h-40px">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 ml-xl-auto col-md-4 mr-0">
                    <div class="text-center text-md-left mt-4">
                        <h4 class="fs-13 text-uppercase fw-600 border-bottom border-gray-900 pb-2 mb-4">
                            Contact Info
                        </h4>
                        <ul class="list-unstyled">
                            <li class="mb-2">
                                <span class="d-block opacity-30">Address:</span>
                                <span class="d-block opacity-70">Web address: paikarihouse.com</span>
                            </li>
                            <li class="mb-2">
                                <span class="d-block opacity-30">Phone:</span>
                                <span class="d-block opacity-70">Not available for now</span>
                            </li>
                            <li class="mb-2">
                                <span class="d-block opacity-30">Email:</span>
                                <span class="d-block opacity-70">
                                    <a href="mailto:paikarihouse123@gmail.com"
                                        class="text-reset">paikarihouse123@gmail.com</a>
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4">
                    <div class="text-center text-md-left mt-4">
                        <h4 class="fs-13 text-uppercase fw-600 border-bottom border-gray-900 pb-2 mb-4">

                        </h4>
                        <ul class="list-unstyled">
                        </ul>
                    </div>
                </div>

                <div class="col-md-4 col-lg-2">
                    <div class="text-center text-md-left mt-4">
                        <h4 class="fs-13 text-uppercase fw-600 border-bottom border-gray-900 pb-2 mb-4">
                            My Account
                        </h4>
                        <ul class="list-unstyled">
                            <li class="mb-2">
                                <a class="opacity-50 hov-opacity-100 text-reset" href="{{route('login')}}">

                                </a>
                            </li>
                            <li class="mb-2">
                                <a class="opacity-50 hov-opacity-100 text-reset" href="purchase_history.html">
                                    Order History
                                </a>
                            </li>
                            <li class="mb-2">
                                <a class="opacity-50 hov-opacity-100 text-reset" href="users/login.html">
                                    My Wishlist
                                </a>
                            </li>
                            <li class="mb-2">
                                <a class="opacity-50 hov-opacity-100 text-reset" href="{{ route('OrderTrack') }}">
                                    Track Order
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="text-center text-md-left mt-4">
                        <h4 class="fs-13 text-uppercase fw-600 border-bottom border-gray-900 pb-2 mb-4">
                            Be A Seller
                        </h4>
                        <a href="{{ route('VendorLogin') }}" class="btn btn-primary btn-sm shadow-md">
                            Apply Now
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="pt-3 pb-7 pb-xl-3 bg-black text-light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-4">
                    <div class="text-center text-md-left" current-verison="5.5.6">
                        Developed by <a href="https://mojiburrahaman.com" target="_blank">Mojibur Rahaman</a>
                    </div>
                </div>
                <div class="col-lg-4">
                </div>
                <div class="col-lg-4">
                    <div class="text-center text-md-right">
                        <ul class="list-inline mb-0">
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>


    <div class="aiz-mobile-bottom-nav d-xl-none fixed-bottom bg-white shadow-lg border-top rounded-top"
        style="box-shadow: 0px -1px 10px rgb(0 0 0 / 15%)!important; ">
        <div class="row align-items-center gutters-5">
            <div class="col">
                <a href="index.html" class="text-reset d-block text-center pb-2 pt-3">
                    <i class="las la-home fs-20 opacity-60 opacity-100 text-primary"></i>
                    <span class="d-block fs-10 fw-600 opacity-60 opacity-100 fw-600">Home</span>
                </a>
            </div>
            <div class="col">
                <a href="{{ route('Category') }}" class="text-reset d-block text-center pb-2 pt-3">
                    <i class="las la-list-ul fs-20 opacity-60 "></i>
                    <span class="d-block fs-10 fw-600 opacity-60 ">Categories</span>
                </a>
            </div>
            <div class="col-auto">
                <a href="cart.html" class="text-reset d-block text-center pb-2 pt-3">
                    <span
                        class="align-items-center bg-primary border border-white border-width-4 d-flex justify-content-center position-relative rounded-circle size-50px"
                        style="margin-top: -33px;box-shadow: 0px -5px 10px rgb(0 0 0 / 15%);border-color: #fff !important;">
                        <i class="las la-shopping-bag la-2x text-white"></i>
                    </span>
                    <span class="d-block mt-1 fs-10 fw-600 opacity-60 ">
                        Cart
                        (<span class="cart-count">0</span>)
                    </span>
                </a>
            </div>
            <div class="col">
                <a href="users/login.html" class="text-reset d-block text-center pb-2 pt-3">
                    <span class="d-inline-block position-relative px-2">
                        <i class="las la-bell fs-20 opacity-60 "></i>
                    </span>
                    <span class="d-block fs-10 fw-600 opacity-60 ">Notifications</span>
                </a>
            </div>
            <div class="col">
                @auth('web')
                <a href="javascript:void(0)" class="text-reset d-block text-center pb-2 pt-3 mobile-side-nav-thumb"
                    data-toggle="class-toggle" data-backdrop="static" data-target=".aiz-mobile-side-nav">
                    <span class="d-block mx-auto">
                        <img src="https://paikarihouse.com/public/assets/img/avatar-place.png"
                            class="rounded-circle size-20px">
                    </span>
                    <span class="d-block fs-10 fw-600 opacity-60">Account</span>
                </a>

                @else
                <a href="{{ route('login') }}" class="text-reset d-block text-center pb-2 pt-3 mobile-side-nav-thumb"
                    data-toggle="class-toggle" data-backdrop="static" data-target=".aiz-mobile-side-nav">
                    <span class="d-block mx-auto">
                        <img src="https://paikarihouse.com/public/assets/img/avatar-place.png"
                            class="rounded-circle size-20px">
                    </span>
                    <span class="d-block fs-10 fw-600 opacity-60">Account</span>
                </a>


                @endauth

            </div>
        </div>
    </div>


    @auth('web')

    <div class="aiz-mobile-side-nav collapse-sidebar-wrap sidebar-xl d-xl-none z-1035">

        <div class="overlay dark c-pointer overlay-fixed" data-toggle="class-toggle" data-backdrop="static"
            data-target=".aiz-mobile-side-nav" data-same=".mobile-side-nav-thumb"></div>
        <div class="collapse-sidebar bg-white">
            <div class="aiz-user-sidenav-wrap position-relative z-1 shadow-sm">
                <div class="aiz-user-sidenav rounded overflow-auto c-scrollbar-light pb-5 pb-xl-0">
                    <div class="p-4 text-xl-center mb-4 border-bottom bg-primary text-white position-relative">
                        <span class="avatar avatar-md mb-3">
                            <img src="{{ Avatar::create(auth('web')->user()->name)->toBase64(); }}"
                                class="image rounded-circle"
                                onerror="this.onerror=null;this.src='{{ Avatar::create(auth('web')->user()->name)->toBase64(); }}';">
                        </span>
                        <h4 class="h5 fs-16 mb-1 fw-600">{{ auth('web')->user()->name }}</h4>
                        <div class="text-truncate opacity-60">{{ auth('web')->user()->email }}</div>
                    </div>

                    <div class="sidemnenu mb-3">
                        <ul class="aiz-side-nav-list px-2 metismenu" data-toggle="aiz-side-menu">

                            <li class="aiz-side-nav-item">
                                <a href="{{ route('UserProfile') }}" class="aiz-side-nav-link ">
                                    <i class="las la-home aiz-side-nav-icon"></i>
                                    <span class="aiz-side-nav-text">Dashboard</span>
                                </a>
                            </li>


                            <li class="aiz-side-nav-item">
                                <a href="{{ route('UserPurchase') }}" class="aiz-side-nav-link ">
                                    <i class="las la-file-alt aiz-side-nav-icon"></i>
                                    <span class="aiz-side-nav-text">Purchase History</span>
                                </a>
                            </li>

                            <li class="aiz-side-nav-item">
                                <a href="https://paikarihouse.com/digital_purchase_history" class="aiz-side-nav-link ">
                                    <i class="las la-download aiz-side-nav-icon"></i>
                                    <span class="aiz-side-nav-text">Downloads</span>
                                </a>
                            </li>


                            <li class="aiz-side-nav-item">
                                <a href="{{ route('WishListView') }}" class="aiz-side-nav-link ">
                                    <i class="la la-heart-o aiz-side-nav-icon"></i>
                                    <span class="aiz-side-nav-text">Wishlist</span>
                                </a>
                            </li>

                            <li class="aiz-side-nav-item">
                                <a href="{{ route('CompareView') }}" class="aiz-side-nav-link ">
                                    <i class="la la-refresh aiz-side-nav-icon"></i>
                                    <span class="aiz-side-nav-text">Compare</span>
                                </a>
                            </li>


                            <li class="aiz-side-nav-item">
                                <a href="https://paikarihouse.com/conversations" class="aiz-side-nav-link ">
                                    <i class="las la-comment aiz-side-nav-icon"></i>
                                    <span class="aiz-side-nav-text">Conversations</span>
                                </a>
                            </li>






                            <li class="aiz-side-nav-item">
                                <a href="https://paikarihouse.com/support_ticket" class="aiz-side-nav-link ">
                                    <i class="las la-atom aiz-side-nav-icon"></i>
                                    <span class="aiz-side-nav-text">Support Ticket</span>
                                </a>
                            </li>
                            <li class="aiz-side-nav-item">
                                <a href="https://paikarihouse.com/profile" class="aiz-side-nav-link ">
                                    <i class="las la-user aiz-side-nav-icon"></i>
                                    <span class="aiz-side-nav-text">Manage Profile</span>
                                </a>
                            </li>
                        </ul>
                    </div>

                </div>

                <div class="fixed-bottom d-xl-none bg-white border-top d-flex justify-content-between px-2"
                    style="box-shadow: 0 -5px 10px rgb(0 0 0 / 10%);">
                    <a class="btn btn-sm p-2 d-flex align-items-center" href="">
                        <i class="las la-sign-out-alt fs-18 mr-2"></i>
                        <span>Logout</span>
                    </a>
                    <button class="btn btn-sm p-2" data-toggle="class-toggle" data-backdrop="static"
                        data-target=".aiz-mobile-side-nav" data-same=".mobile-side-nav-thumb">
                        <i class="las la-times la-2x"></i>
                    </button>
                </div>
            </div>
        </div>

    </div>
    @endauth



    <div>


    </div>
    </div>



    <script>
        function confirm_modal(delete_url)
    {
        jQuery('#confirm-delete').modal('show', {backdrop: 'static'});
        document.getElementById('delete_link').setAttribute('href' , delete_url);
    }
    </script>

    <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">

                    <h4 class="modal-title" id="myModalLabel">Confirmation</h4>
                </div>

                <div class="modal-body">
                    <p>Delete confirmation message</p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <a id="delete_link" class="btn btn-danger btn-ok">Delete</a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addToCart">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size"
            role="document">
            <div class="modal-content position-relative">
                <div class="c-preloader text-center p-3">
                    <i class="las la-spinner la-spin la-3x"></i>
                </div>
                <button type="button" class="close absolute-top-right btn-icon close z-1" data-dismiss="modal"
                    aria-label="Close">
                    <span aria-hidden="true" class="la-2x">&times;</span>
                </button>
                <div id="addToCart-modal-body">

                </div>
            </div>
        </div>
    </div>


    <!-- SCRIPTS -->
    <script src="{{asset('frontend/assets/js/vendors.js')}}"></script>
    <script src="{{asset('frontend/assets/js/aiz-core.js')}}"></script>

    @yield('script_js')


    <script>
    </script>

    <script>
        $(document).ready(function() {
            $('.category-nav-element').each(function(i, el) {
                $(el).on('mouseover', function(){
                    if(!$(el).find('.sub-cat-menu').hasClass('loaded')){
                        $.post('category/nav-element-list.html', {_token: AIZ.data.csrf, id:$(el).data('id')}, function(data){
                            $(el).find('.sub-cat-menu').addClass('loaded').html(data);
                        });
                    }
                });
            });
            if ($('#lang-change').length > 0) {
                $('#lang-change .dropdown-menu a').each(function() {
                    $(this).on('click', function(e){
                        e.preventDefault();
                        var $this = $(this);
                        var locale = $this.data('flag');
                        $.post('language.html',{_token: AIZ.data.csrf, locale:locale}, function(data){
                            location.reload();
                        });

                    });
                });
            }

            // if ($('#currency-change').length > 0) {
            //     $('#currency-change .dropdown-menu a').each(function() {
            //         $(this).on('click', function(e){
            //             e.preventDefault();
            //             var $this = $(this);
            //             var currency_code = $this.data('currency');
            //             $.post('currency.html',{_token: AIZ.data.csrf, currency_code:currency_code}, function(data){
            //                 location.reload();
            //             });

            //         });
            //     });
            // }
         

            // function ajaxCart(){
            //     alert('ajax');
            @auth('web')
                $.ajax({
                    type:"GET",
                    url: '{{route('AjaxCartView')}}',
                    success: function(data){
                       updateNavCart(data.nav_cart_view,data.cart_count);
                    }
                }); 
            @endauth
        // }


        });

        $('#search').on('keyup', function(){
            search();
        });

        $('#search').on('focus', function(){
            search();
        });

        function search(){
            var searchKey = $('#search').val();
            if(searchKey.length > 0){
                $('body').addClass("typed-search-box-shown");

                $('.typed-search-box').removeClass('d-none');
                $('.search-preloader').removeClass('d-none');
                $.post('{{ route("AjaxSearch") }}', { _token: '{{ csrf_token() }}', search:searchKey}, function(data){
                    if(data == '0'){
                        // $('.typed-search-box').addClass('d-none');
                        $('#search-content').html(null);
                        $('.typed-search-box .search-nothing').removeClass('d-none').html('Sorry, nothing found for <strong>"'+searchKey+'"</strong>');
                        $('.search-preloader').addClass('d-none');

                    }
                    else{
                        $('.typed-search-box .search-nothing').addClass('d-none').html(null);
                        $('#search-content').html(data);
                        $('.search-preloader').addClass('d-none');
                    }
                });
            }
            else {
                $('.typed-search-box').addClass('d-none');
                $('body').removeClass("typed-search-box-shown");
            }
        }

        function updateNavCart(view,count){
            $('.cart-count').html(count);
            $('#cart_items').html(view);
        }

        function removeFromCart(key){
            $.post('{{route('CartRemove')}}', {
                _token  : '{{ csrf_token() }}',
                id      :  key
            }, function(data){
                
                $('#nav_cart_id'+key).remove();
                $('#cart_view'+key).remove();
                $(".cart_total").load(location.href + " .cart_total");
            $('.cart-count').html(parseInt($('.cart-count').html())-1);

            });
        }

        function addToCompare(id){
            $.post('{{ route("CompareViewPost") }}', {_token: '{{ csrf_token() }}', id:id}, function(data){
                $('#compare').html(data);
                AIZ.plugins.notify('success', "Item has been added to compare list");
                $('#compare_items_sidenav').html(parseInt($('#compare_items_sidenav').html())+1);
            });
        }

        function addToWishList(id){
                 $.post('{{ route("WishListViewPost") }}', {_token: '{{ csrf_token() }}', id:id}, function(data){
                    if(data != 0){
                        $('#wishlist').html(data);
                        AIZ.plugins.notify('success', "Item has been added to wishlist");
                    }
                    else{
                        AIZ.plugins.notify('warning', "Please login first");
                    }
                });
                    }
        function LoginAttemptShow(){
                            AIZ.plugins.notify('warning', "Please login first");
                    }

        function showAddToCartModal(id){
            if(!$('#modal-size').hasClass('modal-lg')){
                $('#modal-size').addClass('modal-lg');
            }
            $('#addToCart-modal-body').html(null);
            $('#addToCart').modal();
            $('.c-preloader').show();
            $.post('{{route('CartModalView')}}', {_token:'{{ csrf_token() }}', id:id}, function(data){
                $('.c-preloader').hide();
                $('#addToCart-modal-body').html(data);
                AIZ.plugins.slickCarousel();
                AIZ.plugins.zoom();
                AIZ.extra.plusMinus();
                getVariantPrice();
            });
        }

        $('#option-choice-form input').on('change', function(){
            getVariantPrice();
        });

        function getVariantPrice(){
            if($('#option-choice-form input[name=quantity]').val() > 0 && checkAddToCartValidity()){
                $.ajax({
                   type:"POST",
                   url: 'https://paikarihouse.com/product/variant_price',
                   data: $('#option-choice-form').serializeArray(),
                   success: function(data){

                        $('.product-gallery-thumb .carousel-box').each(function (i) {
                            if($(this).data('variation') && data.variation == $(this).data('variation')){
                                $('.product-gallery-thumb').slick('slickGoTo', i);
                            }
                        })

                       $('#option-choice-form #chosen_price_div').removeClass('d-none');
                       $('#option-choice-form #chosen_price_div #chosen_price').html(data.price);
                       $('#available-quantity').html(data.quantity);
                       $('.input-number').prop('max', data.max_limit);
                       if(parseInt(data.in_stock) == 0 && data.digital  == 0){
                           $('.buy-now').addClass('d-none');
                           $('.add-to-cart').addClass('d-none');
                           $('.out-of-stock').removeClass('d-none');
                       }
                       else{
                           $('.buy-now').removeClass('d-none');
                           $('.add-to-cart').removeClass('d-none');
                           $('.out-of-stock').addClass('d-none');
                       }
                   }
               });
            }
        }

        function checkAddToCartValidity(){
            var names = {};
            $('#option-choice-form input:radio').each(function() { // find unique names
                  names[$(this).attr('name')] = true;
            });
            var count = 0;
            $.each(names, function() { // then count them
                  count++;
            });

            if($('#option-choice-form input:radio:checked').length == count){
                return true;
            }

            return false;
        }

        function addToCart(){
            if(checkAddToCartValidity()) {
                $('#addToCart').modal();
                $('.c-preloader').show();
                $.ajax({
                    type:"POST",
                    url: '{{route('CartPost')}}',
                    data: $('#option-choice-form').serializeArray(),
                    success: function(data){

                       $('#addToCart-modal-body').html(null);
                       $('.c-preloader').hide();
                       $('#modal-size').removeClass('modal-lg');
                       $('#addToCart-modal-body').html(data.modal_view);
                       AIZ.extra.plusMinus();
                       AIZ.plugins.slickCarousel();
                       updateNavCart(data.nav_cart_view,data.cart_count);
                    }
                });
            }
            else{
                AIZ.plugins.notify('warning', "Please choose all the options");
            }
        }

        function buyNow(){
            if(checkAddToCartValidity()) {
                $('#addToCart-modal-body').html(null);
                $('#addToCart').modal();
                $('.c-preloader').show();
                $.ajax({
                   type:"POST",
                   url: '{{route('CartPost')}}',
                   data: $('#option-choice-form').serializeArray(),
                   success: function(data){
                       if(data){

                            $('#addToCart-modal-body').html(data.modal_view);
                            updateNavCart(data.nav_cart_view,data.cart_count);
                            location.assign('{{route('CartView')}}');
                            // window.location("/cart");
                       }
                       else{
                            $('#addToCart-modal-body').html(null);
                            $('.c-preloader').hide();
                            $('#modal-size').removeClass('modal-lg');
                            $('#addToCart-modal-body').html(data.modal_view);
                       }
                   }
               });
            }
            else{
                AIZ.plugins.notify('warning', "Please choose all the options");
            }
        }

        function show_purchase_history_details(order_id)
        {
            $('#order-details-modal-body').html(null);

            if(!$('#modal-size').hasClass('modal-lg')){
                $('#modal-size').addClass('modal-lg');
            }

            $.post('users/login.html', { _token : AIZ.data.csrf, order_id : order_id}, function(data){
                $('#order-details-modal-body').html(data);
                $('#order_details').modal();
                $('.c-preloader').hide();
            });
        }


    </script>

    <script>
        // $(document).ready(function(){
        //     $.post('home/section/featured.html', {_token:'Bppdvrt9SZVF80PZFxkOGQc8skTFVyqXCMkKiajc'}, function(data){
        //         $('#section_featured').html(data);
        //         AIZ.plugins.slickCarousel();
        //     });
        //     $.post('home/section/best_selling.html', {_token:'Bppdvrt9SZVF80PZFxkOGQc8skTFVyqXCMkKiajc'}, function(data){
        //         $('#section_best_selling').html(data);
        //         AIZ.plugins.slickCarousel();
        //     });
        //     $.post('home/section/auction_products.html', {_token:'Bppdvrt9SZVF80PZFxkOGQc8skTFVyqXCMkKiajc'}, function(data){
        //         $('#auction_products').html(data);
        //         AIZ.plugins.slickCarousel();
        //     });
        //     $.post('home/section/home_categories.html', {_token:'Bppdvrt9SZVF80PZFxkOGQc8skTFVyqXCMkKiajc'}, function(data){
        //         $('#section_home_categories').html(data);
        //         AIZ.plugins.slickCarousel();
        //     });
        //     $.post('home/section/best_sellers.html', {_token:'Bppdvrt9SZVF80PZFxkOGQc8skTFVyqXCMkKiajc'}, function(data){
        //         $('#section_best_sellers').html(data);
        //         AIZ.plugins.slickCarousel();
        //     });
        // });
    </script>


</body>

<!-- Mirrored from paikarihouse.com/ by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 28 Apr 2022 19:39:07 GMT -->

</html>