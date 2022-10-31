@extends('frontend.master')
@section('title','Dashboard')

@section('content')
<section id="profile">
    <div class="container">

        <div class="d-flex align-items-start">
            <div class="aiz-user-sidenav-wrap position-relative z-1 shadow-sm">
                <div class="aiz-user-sidenav rounded overflow-auto c-scrollbar-light pb-5 pb-xl-0">
                    <div class="p-4 text-xl-center mb-4 border-bottom bg-primary text-white position-relative">
                        <span class="avatar avatar-md mb-3">
                            <img src="{{ Avatar::create(auth('web')->user()->name)->toBase64(); }}"
                                class="image rounded-circle"
                                onerror="this.onerror=null;this.src='https://paikarihouse.com/public/assets/img/avatar-place.png';">
                        </span>
                        <h4 class="h5 fs-16 mb-1 fw-600">{{ auth('web')->user()->name }}</h4>
                        <div class="text-truncate opacity-60">{{ auth('web')->user()->email }}</div>
                    </div>

                    <div class="sidemnenu mb-3">
                        <ul class="aiz-side-nav-list px-2 metismenu" data-toggle="aiz-side-menu">

                            <li class="aiz-side-nav-item">
                                <a href="{{ route('UserProfile') }}"
                                    class="aiz-side-nav-link {{ (url()->current() == route('UserProfile')) ? 'active' : '' }}">
                                    <i class="las la-home aiz-side-nav-icon"></i>
                                    <span class="aiz-side-nav-text">Dashboard</span>
                                </a>
                            </li>


                            <li class="aiz-side-nav-item">
                                <a href="https://paikarihouse.com/purchase_history" class="aiz-side-nav-link ">
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


                            <li class="aiz-side-nav-item mm-active">
                                <a href="{{ route('WishListView') }}"
                                    class="aiz-side-nav-link {{ (url()->current() == route('WishListView')) ? 'active' : '' }}"
                                    aria-expanded="true">
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
                    <a class="btn btn-sm p-2 d-flex align-items-center" href="https://paikarihouse.com/logout">
                        <i class="las la-sign-out-alt fs-18 mr-2"></i>
                        <span>Logout</span>
                    </a>
                    <button class="btn btn-sm p-2 " data-toggle="class-toggle" data-backdrop="static"
                        data-target=".aiz-mobile-side-nav" data-same=".mobile-side-nav-thumb">
                        <i class="las la-times la-2x"></i>
                    </button>
                </div>
            </div>
            @if (url()->current() == route('UserProfile'))
            <div class="aiz-user-panel">

                <div class="aiz-titlebar mt-2 mb-4">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <h1 class="h3">Dashboard</h1>
                        </div>
                    </div>
                </div>
                <div class="row gutters-10">
                    <div class="col-md-4">
                        <div class="bg-grad-1 text-white rounded-lg mb-4 overflow-hidden">
                            <div class="px-3 pt-3">
                                <div class="h3 fw-700">
                                    {{ $carts }} Products
                                </div>
                                <div class="opacity-50">in your cart</div>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                                <path fill="rgba(255,255,255,0.3)" fill-opacity="1"
                                    d="M0,192L30,208C60,224,120,256,180,245.3C240,235,300,181,360,144C420,107,480,85,540,96C600,107,660,149,720,154.7C780,160,840,128,900,117.3C960,107,1020,117,1080,112C1140,107,1200,85,1260,74.7C1320,64,1380,64,1410,64L1440,64L1440,320L1410,320C1380,320,1320,320,1260,320C1200,320,1140,320,1080,320C1020,320,960,320,900,320C840,320,780,320,720,320C660,320,600,320,540,320C480,320,420,320,360,320C300,320,240,320,180,320C120,320,60,320,30,320L0,320Z">
                                </path>
                            </svg>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="bg-grad-2 text-white rounded-lg mb-4 overflow-hidden">
                            <div class="px-3 pt-3">
                                <div class="h3 fw-700"> {{ $wishlists }} Products</div>
                                <div class="opacity-50">in your wishlist</div>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                                <path fill="rgba(255,255,255,0.3)" fill-opacity="1"
                                    d="M0,128L34.3,112C68.6,96,137,64,206,96C274.3,128,343,224,411,250.7C480,277,549,235,617,213.3C685.7,192,754,192,823,181.3C891.4,171,960,149,1029,117.3C1097.1,85,1166,43,1234,58.7C1302.9,75,1371,149,1406,186.7L1440,224L1440,320L1405.7,320C1371.4,320,1303,320,1234,320C1165.7,320,1097,320,1029,320C960,320,891,320,823,320C754.3,320,686,320,617,320C548.6,320,480,320,411,320C342.9,320,274,320,206,320C137.1,320,69,320,34,320L0,320Z">
                                </path>
                            </svg>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="bg-grad-3 text-white rounded-lg mb-4 overflow-hidden">
                            <div class="px-3 pt-3">
                                <div class="h3 fw-700">0 Products</div>
                                <div class="opacity-50">you ordered</div>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                                <path fill="rgba(255,255,255,0.3)" fill-opacity="1"
                                    d="M0,192L26.7,192C53.3,192,107,192,160,202.7C213.3,213,267,235,320,218.7C373.3,203,427,149,480,117.3C533.3,85,587,75,640,90.7C693.3,107,747,149,800,149.3C853.3,149,907,107,960,112C1013.3,117,1067,171,1120,202.7C1173.3,235,1227,245,1280,213.3C1333.3,181,1387,107,1413,69.3L1440,32L1440,320L1413.3,320C1386.7,320,1333,320,1280,320C1226.7,320,1173,320,1120,320C1066.7,320,1013,320,960,320C906.7,320,853,320,800,320C746.7,320,693,320,640,320C586.7,320,533,320,480,320C426.7,320,373,320,320,320C266.7,320,213,320,160,320C106.7,320,53,320,27,320L0,320Z">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            @else

            @yield('profile')
            @endif
        </div>

    </div>
</section>
@endsection