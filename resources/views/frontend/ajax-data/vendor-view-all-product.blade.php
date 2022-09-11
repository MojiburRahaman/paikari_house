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