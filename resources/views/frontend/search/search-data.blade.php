@extends('frontend.master')
@section('title')
Search result for"{{ $search }}"
@endsection
@section('content')
<section>

    <div class="container sm-px-0">
        <form class="" id="search-form" action="" method="GET">
            <div class="row">
                <div class="col-xl-3">
                    <div class="aiz-filter-sidebar collapse-sidebar-wrap sidebar-xl sidebar-right z-1035">
                        <div class="overlay overlay-fixed dark c-pointer" data-toggle="class-toggle"
                            data-target=".aiz-filter-sidebar" data-same=".filter-sidebar-thumb"></div>
                        <div class="collapse-sidebar c-scrollbar-light text-left">
                            <div class="d-flex d-xl-none justify-content-between align-items-center pl-3 border-bottom">
                                <h3 class="h6 mb-0 fw-600">Filters</h3>
                                <button type="button" class="btn btn-sm p-2 filter-sidebar-thumb"
                                    data-toggle="class-toggle" data-target=".aiz-filter-sidebar">
                                    <i class="las la-times la-2x"></i>
                                </button>
                            </div>
                            <div class="bg-white shadow-sm rounded mb-3">
                                <div class="fs-15 fw-600 p-3 border-bottom">
                                    Categories
                                </div>
                                <div class="p-3">
                                    <ul class="list-unstyled">
                                        @foreach ($categories as $cat)

                                        <li class="mb-2 ml-2">
                                            <a class="text-reset fs-14"
                                                href="{{ route('CategorySearch',$cat->slug) }}">{{
                                                $cat->title }} &nbsp;({{ $cat->product_count }})</a>
                                        </li>
                                        @endforeach

                                    </ul>
                                </div>
                            </div>
                            <div class="bg-white shadow-sm rounded mb-3">
                                <div class="fs-15 fw-600 p-3 border-bottom">
                                    Price range
                                </div>
                                <div class="p-3">
                                    <div class="aiz-range-slider">
                                        <div id="input-slider-range" data-range-value-min=" 45.00 "
                                            data-range-value-max=" 2990.00 "
                                            class="noUi-target noUi-ltr noUi-horizontal noUi-txt-dir-ltr">
                                            <div class="noUi-base">
                                                <div class="noUi-connects">
                                                    <div class="noUi-connect"
                                                        style="transform: translate(0%) scale(0.646859, 1);"></div>
                                                </div>
                                                <div class="noUi-origin"
                                                    style="transform: translate(-1000%); z-index: 5;">
                                                    <div class="noUi-handle noUi-handle-lower" data-handle="0"
                                                        tabindex="0" role="slider" aria-orientation="horizontal"
                                                        aria-valuemin="45.0" aria-valuemax="1950.0" aria-valuenow="45.0"
                                                        aria-valuetext="45.00">
                                                        <div class="noUi-touch-area"></div>
                                                    </div>
                                                </div>
                                                <div class="noUi-origin"
                                                    style="transform: translate(-353.141%); z-index: 4;">
                                                    <div class="noUi-handle noUi-handle-upper" data-handle="1"
                                                        tabindex="0" role="slider" aria-orientation="horizontal"
                                                        aria-valuemin="45.0" aria-valuemax="2990.0"
                                                        aria-valuenow="1950.0" aria-valuetext="1950.00">
                                                        <div class="noUi-touch-area"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mt-2">
                                            <div class="col-6">
                                                <span class="range-slider-value value-low fs-14 fw-600 opacity-70"
                                                    data-range-value-low="45.00"
                                                    id="input-slider-range-value-low">45.00</span>
                                            </div>
                                            <div class="col-6 text-right">
                                                <span class="range-slider-value value-high fs-14 fw-600 opacity-70"
                                                    data-range-value-high="1950.00"
                                                    id="input-slider-range-value-high">1950.00</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-white shadow-sm rounded mb-3">
                                <div class="fs-15 fw-600 p-3 border-bottom">
                                    Filter by Size
                                </div>
                                <div class="p-3">
                                    <div class="aiz-checkbox-list">
                                    </div>
                                </div>
                            </div>
                            <div class="bg-white shadow-sm rounded mb-3">
                                <div class="fs-15 fw-600 p-3 border-bottom">
                                    Filter by Fabric
                                </div>
                                <div class="p-3">
                                    <div class="aiz-checkbox-list">
                                    </div>
                                </div>
                            </div>



                        </div>
                    </div>
                </div>
                <div class="col-xl-9">

                    <ul class="breadcrumb bg-transparent p-0">
                        <li class="breadcrumb-item opacity-50">
                            <a class="text-reset" href="{{ route('FrontendView') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item fw-600  text-dark">
                            <a class="text-reset" href="">All categories</a>
                        </li>
                        @if(url()->current() != route('FrontendView'))
                        <li class="breadcrumb-item fw-600  text-dark">
                            <a class="text-reset" href="https://paikarihouse.com/search">"{{ $search }}"</a>
                        </li>
                        @endif
                    </ul>

                    <div class="text-left">
                        <div class="row gutters-5 flex-wrap align-items-center">
                            <div class="col-lg col-10">
                                <h1 class="h6 fw-600 text-body">
                                    @if(url()->current() != route('FrontendView'))
                                    {{ $search }}
                                    @else

                                    Search result for"{{ $search }}"
                                    @endif
                                </h1>
                                <input type="hidden" name="keyword" value="a">
                            </div>
                            <div class="col-2 col-lg-auto d-xl-none mb-lg-3 text-right">
                                <button type="button" class="btn btn-icon p-0" data-toggle="class-toggle"
                                    data-target=".aiz-filter-sidebar">
                                    <i class="la la-filter la-2x"></i>
                                </button>
                            </div>
                            <div class="col-6 col-lg-auto mb-3 w-lg-200px">
                                <label class="mb-0 opacity-50">Brands</label>
                                <div class="dropdown bootstrap-select form-control form-control-sm aiz-"><select
                                        class="form-control form-control-sm aiz-selectpicker" data-live-search="true"
                                        name="brand" onchange="filter()" tabindex="-98">
                                        <option value="">All Brands</option>
                                        <option value="baesus-gm7sl">Baesus</option>
                                        <option value="Remax-VfyOy">Remax</option>
                                        <option value="Xiaomi-iR1cb">Xiaomi</option>
                                        <option value="OnePlus-8nbB0">OnePlus</option>
                                        <option value="Bluetooth-wireless-I0vsC">Bluetooth wireless</option>
                                    </select><button type="button" class="btn dropdown-toggle btn-light"
                                        data-toggle="dropdown" role="combobox" aria-owns="bs-select-1"
                                        aria-haspopup="listbox" aria-expanded="false" title="All Brands">
                                        <div class="filter-option">
                                            <div class="filter-option-inner">
                                                <div class="filter-option-inner-inner">All Brands</div>
                                            </div>
                                        </div>
                                    </button>
                                    <div class="dropdown-menu" style="max-height: 248px; overflow: hidden;">
                                        <div class="bs-searchbox"><input type="search" class="form-control"
                                                autocomplete="off" role="combobox" aria-label="Search"
                                                aria-controls="bs-select-1" aria-autocomplete="list"
                                                aria-activedescendant="bs-select-1-0"></div>
                                        <div class="inner show" role="listbox" id="bs-select-1" tabindex="-1"
                                            style="max-height: 180px; overflow-y: auto;">
                                            <ul class="dropdown-menu inner show" role="presentation"
                                                style="margin-top: 0px; margin-bottom: 0px;">
                                                <li class="selected active"><a role="option"
                                                        class="dropdown-item active selected" id="bs-select-1-0"
                                                        tabindex="0" aria-setsize="6" aria-posinset="1"
                                                        aria-selected="true"><span class="text">All Brands</span></a>
                                                </li>
                                                <li><a role="option" class="dropdown-item" id="bs-select-1-1"
                                                        tabindex="0"><span class="text">Baesus</span></a></li>
                                                <li><a role="option" class="dropdown-item" id="bs-select-1-2"
                                                        tabindex="0"><span class="text">Remax</span></a></li>
                                                <li><a role="option" class="dropdown-item" id="bs-select-1-3"
                                                        tabindex="0"><span class="text">Xiaomi</span></a></li>
                                                <li><a role="option" class="dropdown-item" id="bs-select-1-4"
                                                        tabindex="0"><span class="text">OnePlus</span></a></li>
                                                <li><a role="option" class="dropdown-item" id="bs-select-1-5"
                                                        tabindex="0"><span class="text">Bluetooth wireless</span></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-lg-auto mb-3 w-lg-200px">
                                <label class="mb-0 opacity-50">Sort by</label>
                                <div class="dropdown bootstrap-select form-control form-control-sm aiz-"><select
                                        class="form-control form-control-sm aiz-selectpicker" name="sort_by"
                                        onchange="filter()" tabindex="-98">
                                        <option value="newest">Newest</option>
                                        <option value="oldest">Oldest</option>
                                        <option value="price-asc">Price low to high</option>
                                        <option value="price-desc">Price high to low</option>
                                    </select><button type="button" class="btn dropdown-toggle btn-light"
                                        data-toggle="dropdown" role="combobox" aria-owns="bs-select-2"
                                        aria-haspopup="listbox" aria-expanded="false" title="Newest">
                                        <div class="filter-option">
                                            <div class="filter-option-inner">
                                                <div class="filter-option-inner-inner">Newest</div>
                                            </div>
                                        </div>
                                    </button>
                                    <div class="dropdown-menu" style="overflow: hidden;">
                                        <div class="inner show" role="listbox" id="bs-select-2" tabindex="-1"
                                            style="overflow-y: auto;" aria-activedescendant="bs-select-2-0">
                                            <ul class="dropdown-menu inner show" role="presentation"
                                                style="margin-top: 0px; margin-bottom: 0px;">
                                                <li class="selected active"><a role="option"
                                                        class="dropdown-item active selected" id="bs-select-2-0"
                                                        tabindex="0" aria-setsize="4" aria-posinset="1"
                                                        aria-selected="true"><span class="text">Newest</span></a></li>
                                                <li><a role="option" class="dropdown-item" id="bs-select-2-1"
                                                        tabindex="0"><span class="text">Oldest</span></a></li>
                                                <li><a role="option" class="dropdown-item" id="bs-select-2-2"
                                                        tabindex="0"><span class="text">Price low to high</span></a>
                                                </li>
                                                <li><a role="option" class="dropdown-item" id="bs-select-2-3"
                                                        tabindex="0"><span class="text">Price high to low</span></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="min_price" value="">
                    <input type="hidden" name="max_price" value="">
                    <div class="row gutters-5 row-cols-xxl-4 row-cols-xl-3 row-cols-lg-4 row-cols-md-3 row-cols-2">
                        @forelse ($products as $product)

                        <div class="col">
                            <div
                                class="aiz-card-box border border-light rounded hov-shadow-md mt-1 mb-2 has-transition bg-white">
                                @if ($product->discount != '')

                                <span class="badge-custom">OFF<span
                                        class="box ml-1 mr-0">&nbsp;{{$product->discount}}%</span></span>
                                @endif
                                <div class="position-relative">
                                    <a href="{{ route('ProductView',['vendor'=>$product->vendor->slug,'product'=>$product->slug]) }}"
                                        class="d-block">
                                        <img class="img-fit mx-auto h-140px h-md-210px ls-is-cached lazyloaded"
                                            src="{{ route('ProductView',['vendor'=>$product->vendor->slug,'product'=>$product->slug]) }}"
                                            data-src="{{ asset('thumbnail_img/'.$product->thumbnail_img) }}"
                                            alt="{{ $product->title }}"
                                            onerror="this.onerror=null;this.src='{{ asset('thumbnail_img/'.$product->thumbnail_img) }}';">
                                    </a>
                                    <div class="absolute-top-right aiz-p-hov-icon">
                                        <a href="javascript:void(0)" onclick="addToWishList({{ $product->id }})" data-toggle="tooltip"
                                            data-title="Add to wishlist" data-placement="left">
                                            <i class="la la-heart-o"></i>
                                        </a>
                                        <a href="javascript:void(0)" onclick="addToCompare({{ $product->id }})" data-toggle="tooltip"
                                            data-title="Add to compare" data-placement="left">
                                            <i class="las la-sync"></i>
                                        </a>
                                        <a href="javascript:void(0)" onclick="showAddToCartModal({{ $product->id }})"
                                            data-toggle="tooltip" data-title="Add to cart" data-placement="left">
                                            <i class="las la-shopping-cart"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="p-md-3 p-2 text-left">
                                    <div class="fs-15">
                                        @if ($product->discount != '')
                                        <del class="fw-600 opacity-50 mr-1">৳{{$product->regular_price}}</del>
                                        <span class="fw-700 text-primary">৳{{$product->sale_price}}</span>
                                        @else
                                        <span class="fw-700 text-primary">৳{{$product->regular_price}}</span>

                                        @endif
                                    </div>
                                    <div class="rating rating-sm mt-1">
                                        <i class="las la-star"></i><i class="las la-star"></i><i
                                            class="las la-star"></i><i class="las la-star"></i><i
                                            class="las la-star"></i>
                                    </div>
                                    <h3 class="fw-600 fs-13 text-truncate-2 lh-1-4 mb-0 h-35px">
                                        <a href="{{ route('ProductView',['vendor'=>$product->vendor->slug,'product'=>$product->slug]) }}"
                                            class="d-block text-reset">{{ $product->title }}</a>
                                    </h3>
                                </div>
                            </div>
                        </div>
                        @empty

                        @endforelse
                    </div>
                    <div class="mt-4 mb-4">
                        @if(url()->current() != route('FrontendView'))
                        {{ $products->links('frontend.paginator') }}
                        @else
                        {{ $products->appends(['search' => $search])->links('frontend.paginator') }}
                        @endif
                    </div>
                </div>
            </div>
        </form>
    </div>

</section>

@endsection