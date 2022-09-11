@extends('frontend.master')

@section('content')

<section class="pt-5 mb-4 bg-white">


    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="d-flex justify-content-center">
                    <img class=" ls-is-cached lazyloaded"
                        src=" https://paikarihouse.com/public/assets/img/placeholder.jpg "
                        data-src=" https://paikarihouse.com/public/assets/img/placeholder.jpg " alt="BestBuy Shop"
                        height="70">
                    <div class="pl-4 text-left">
                        <h1 class="fw-600 h4 mb-0">{{ $vendor->shop_name }}
                            <span class="ml-2"><i class="fa fa-check-circle" style="color:green"></i></span>
                        </h1>
                        <div class="location opacity-60">Farmgate, Dhaka</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="border-bottom mt-5"></div>
        <div class="row align-items-center">
            <div class="col-lg-6 order-2 order-lg-0">
                <ul class="list-inline mb-0 text-center text-lg-left">
                    <li class="list-inline-item ">
                        <a class="text-reset d-inline-block fw-600 fs-15 p-3   " href="{{ route('FrrontendShopView',$vendor->slug) }}">Store Home</a>
                    </li>
                    <li class="list-inline-item ">
                        <a class="text-reset d-inline-block fw-600 fs-15 p-3 border-bottom border-primary border-width-2"
                            href=" {{ route('FrrontendShopViewAllProducts',$vendor->slug) }}">All products</a>
                    </li>
                </ul>
            </div>
            <div class="col-lg-6 order-1 order-lg-0">
                <ul class="text-center text-lg-right mt-4 mt-lg-0 social colored list-inline mb-0">
                </ul>
            </div>
        </div>
    </div>

</section>
<section class="mb-5">

    <div class="container">
        <div class="aiz-carousel dots-inside-bottom mobile-img-auto-height slick-initialized slick-slider"
            data-arrows="true" data-dots="true" data-autoplay="true">
            <div class="slick-list draggable">
                <div class="slick-track" style="opacity: 1; width: 0px; transform: translate3d(0px, 0px, 0px);"></div>
            </div>
        </div>
    </div>

</section>

<section class="mb-5">


    <div class="container">
        <div class="mb-4">
            <h3 class="h3 fw-600 border-bottom">
                <span class="border-bottom border-primary border-width-2 pb-3 d-inline-block">
                    All Products
                </span>
            </h3>
        </div>
        {{-- <div class="row gutters-5 row-cols-xxl-5 row-cols-lg-4 row-cols-md-3 row-cols-2">

        </div> --}}
        <div class="row">

            @foreach ($Products as $latest_product)
            <div class="col-lg-3 col-6 col-sm-4">
                <div class="aiz-card-box border border-light rounded hov-shadow-md mt-1 mb-2 has-transition bg-white">
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
                            <a href="javascript:void(0)" onclick="showAddToCartModal({{$latest_product->id}})"
                                data-toggle="tooltip" data-title="Add to cart" data-placement="left">
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
        <div class="row" id="ajax-data">

        </div>
        @if ($Products->links())

        <div class="row text-center mt-5">
            <div class="col-12">
                <div class="no_data" style="display: none">
                    <span class="text-center mt-5"> No More Product</span>
                </div>
                <div class="spinner-grow load_image" role="status" style="display: none">
                    <span class="sr-only">Loading...</span>
                </div>
                <a class="loadMore_btn btn btn-success">Load More</a>
            </div>
        </div>
        @endif
    </div>


</section>
@endsection
@section('script_js')
<script>
    var page = 1;
    $(document).on('click', '.loadMore_btn', function(event){
    page++;
    loadMoreData(page)
 });
function loadMoreData(page){
     $('.loadMore_btn').hide();
    $('.load_image').show();
    $.ajax({
        url:'?page=' + page,
        type:'get',
    })
    .done(function(data){
        if(data.html == ""){
         $('.loadMore_btn').hide();
        $('.load_image').hide();
        $('.no_data').show();
           
            return;
        }
        $('#ajax-data').append(data.html);
        $('.load_image').hide();
        $('.loadMore_btn').show();
    })
}

</script>

@endsection