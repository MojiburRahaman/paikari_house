<div class="modal-body p-4 added-to-cart">
    <div class="text-center text-success mb-4"> <i class="las la-check-circle la-3x"></i>
        <h3>Item added to your cart!</h3>
    </div>
    <div class="media mb-4"> <img src="{{asset('thumbnail_img/'.$added_product->thumbnail_img)}}"
            class="mr-3 lazyload size-100px img-fit rounded" alt="Product Image">
        <div class="media-body pt-3 text-left">
            <h6 class="fw-600">{{$added_product->title}} </h6>
            <div class="row mt-3">
                <div class="col-sm-2 opacity-60">
                    <div>Price:</div>
                </div>
                <div class="col-sm-10">
                    @if ($added_product->sale_price != '')

                    <div class="h6 text-primary"> <strong> ৳{{$added_product->sale_price}} </strong> </div>
                    @else

                    <div class="h6 text-primary"> <strong> ৳{{$added_product->regular_price}} </strong> </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="bg-white rounded shadow-sm">
        <div class="border-bottom p-3">
            <h3 class="fs-16 fw-600 mb-0"> <span class="mr-4">Frequently Bought Together</span> </h3>
        </div>
        <div class="p-3">
            <div class="aiz-carousel gutters-5 half-outside-arrow" data-items="2" data-xl-items="3" data-lg-items="4"
                data-md-items="3" data-sm-items="2" data-xs-items="2" data-arrows='true' data-infinite='true'>
                @foreach ($similar_product as $product)

                <div class="carousel-box">
                    <div class="aiz-card-box border border-light rounded hov-shadow-md my-2 has-transition">
                        <div class=""> <a
                                href="{{route('ProductView',['vendor'=>$product->Vendor->slug,'product'=>$product->slug])}}"
                                class="d-block"> <img class="img-fit lazyload mx-auto h-140px h-md-210px"
                                    src="{{asset('thumbnail_img/'.$product->thumbnail_img)}}" data-src="" alt="M10"
                                    onerror="this.onerror=null;this.src='{{asset('thumbnail_img/'.$product->thumbnail_img)}}';">
                            </a> </div>
                        <div class="p-md-3 p-2 text-left">
                            <div class="fs-15">
                                @if ($product->sale_price != '')
                                <del class="fw-600 opacity-50 mr-1">৳{{$product->regular_price}}</del>
                                <span class="fw-700 text-primary">৳{{$product->sale_price}} </span>
                                @else
                                <span class="fw-700 text-primary">৳{{$product->regular_price}} </span>
                                @endif

                            </div>
                            <div class="rating rating-sm mt-1"> <i class='las la-star'></i><i class='las la-star'></i><i
                                    class='las la-star'></i><i class='las la-star'></i><i class='las la-star'></i>
                            </div>
                            <h3 class="fw-600 fs-13 text-truncate-2 lh-1-4 mb-0 h-35px"> <a
                                    href="{{route('ProductView',['vendor'=>$product->Vendor->slug,'product'=>$product->slug])}}"
                                    class="d-block text-reset">{{$product->title}}</a> </h3>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="text-center"> <button class="btn btn-outline-primary mb-3 mb-sm-0" data-dismiss="modal">Back to
            shopping</button> <a href="https://paikarihouse.com/cart" class="btn btn-primary mb-3 mb-sm-0">Proceed to
            Checkout</a> </div>
</div>