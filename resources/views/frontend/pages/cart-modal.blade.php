<div class="modal-body p-4 c-scrollbar-light">
    <div class="row">
        <div class="col-lg-6">
            <div class="row gutters-10 flex-row-reverse">
                <div class="col">
                    <div class="aiz-carousel product-gallery" data-nav-for='.product-gallery-thumb' data-fade='true'
                        data-auto-height='true'>
                        @foreach ($product->Gallery as $Gallery)

                        <div class="carousel-box img-zoom rounded">
                            <img class="img-fluid lazyload" src="{{asset('product_image/'.$Gallery->product_image)}}"
                                data-src="{{asset('product_image/'.$Gallery->product_image)}}"
                                onerror="this.onerror=null;this.src='{{asset('product_image/'.$Gallery->product_image)}}';">
                        </div>
                        @endforeach

                    </div>
                </div>
                <div class="col-auto w-90px">
                    <div class="aiz-carousel carousel-thumb product-gallery-thumb" data-items='5'
                        data-nav-for='.product-gallery' data-vertical='true' data-focus-select='true'>
                        @foreach ($product->Gallery as $Gallery)
                        <div class="carousel-box c-pointer border p-1 rounded">
                            <img class="lazyload mw-100 size-60px mx-auto"
                                src="{{asset('product_image/'.$Gallery->product_image)}}"
                                data-src="{{asset('product_image/'.$Gallery->product_image)}}"
                                onerror="this.onerror=null;this.src='{{asset('product_image/'.$Gallery->product_image)}}';">
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="text-left">
                <h2 class="mb-2 fs-20 fw-600">
                    {{$product->title}}
                </h2>

                @if ($product->discount != '')

                <div class="row no-gutters mt-3">
                    <div class="col-2">
                        <div class="opacity-50 mt-2">Price:</div>
                    </div>
                    <div class="col-10">
                        <div class="fs-20 opacity-60">
                            <del>
                                ৳{{$product->regular_price}}
                                <span>/1</span>
                            </del>
                        </div>
                    </div>
                </div>

                <div class="row no-gutters mt-2">
                    <div class="col-2">
                        <div class="opacity-50">Discount Price:</div>
                    </div>
                    <div class="col-10">
                        <div class="">
                            <strong class="h2 fw-600 text-primary">
                                ৳{{$product->sale_price}}
                            </strong>
                            <span class="opacity-70">/1</span>
                        </div>
                    </div>
                </div>
                @else
                <div class="row no-gutters mt-2">
                    <div class="col-2">
                        <div class="opacity-50"> Price:</div>
                    </div>
                    <div class="col-10">
                        <div class="">
                            <strong class="h2 fw-600 text-primary">
                                ৳{{$product->sale_price}}
                            </strong>
                            <span class="opacity-70">/1</span>
                        </div>
                    </div>
                </div>

                @endif


                <hr>


                <form id="option-choice-form">
                    <input type="hidden" name="vendor_id" value="{{$product->vendor_id}}">
                    <input type="hidden" name="product_id" value="{{$product->id}}">
                    <input type="hidden" name="brand_id" value="{{$product->brand_id}}">
                    @csrf
                    <!-- Quantity + Add to cart -->


                    <div class="row no-gutters">
                        <div class="col-2">
                            <div class="opacity-50 mt-2">Quantity:</div>
                        </div>
                        <div class="col-10">
                            <div class="product-quantity d-flex align-items-center">
                                <div class="row no-gutters align-items-center aiz-plus-minus mr-3"
                                    style="width: 130px;">
                                    <button class="btn col-auto btn-icon btn-sm btn-circle btn-light" type="button"
                                        data-type="minus" data-field="quantity" disabled="">
                                        <i class="las la-minus"></i>
                                    </button>
                                    <input type="number" name="quantity"
                                        class="col border-0 text-center flex-grow-1 fs-16 input-number" placeholder="1"
                                        value="1" min="1" max="10" lang="en">
                                    <button class="btn  col-auto btn-icon btn-sm btn-circle btn-light" type="button"
                                        data-type="plus" data-field="quantity">
                                        <i class="las la-plus"></i>
                                    </button>
                                </div>
                                <div class="avialable-amount opacity-60">
                                    (<span id="available-quantity">96</span> available)
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row no-gutters pb-3 d-none" id="chosen_price_div">
                        <div class="col-2">
                            <div class="opacity-50">Total Price:</div>
                        </div>
                        <div class="col-10">
                            <div class="product-price">
                                <strong id="chosen_price" class="h4 fw-600 text-primary">

                                </strong>
                            </div>
                        </div>
                    </div>

                </form>
                <div class="mt-3">
                    <button type="button" class="btn btn-primary buy-now fw-600 add-to-cart" onclick="addToCart()">
                        <i class="la la-shopping-cart"></i>
                        <span class="d-none d-md-inline-block">Add to cart</span>
                    </button>
                </div>

            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('#option-choice-form input').on('change', function () {
        getVariantPrice();
    });
</script>