<a href="javascript:void(0)" class="d-flex align-items-center text-reset h-100" data-toggle="dropdown"
    data-display="static">
    <i class="la la-shopping-cart la-2x opacity-80"></i>
    <span class="flex-grow-1 ml-1"> <span class="badge badge-primary badge-inline badge-pill cart-count">
            {{$cart_item->count()}} </span>
        <span class="nav-box-text d-none d-xl-block opacity-70">Cart</span> </span></a>
<div class="dropdown-menu dropdown-menu-right dropdown-menu-lg p-0 stop-propagation">
    @if ($cart_item->count() != 0)

    <div class="p-3 fs-15 fw-600 p-3 border-bottom"> Cart Items </div>
    @endif
    <ul class="h-250px overflow-auto c-scrollbar-light list-group list-group-flush">
        @php
        $total_cart_amount = 0;
        @endphp
        @forelse ($cart_item as $product)
        <li class="list-group-item" id="nav_cart_id{{$product->id}}">
            <span class="d-flex align-items-center">
                <a href="{{route('ProductView',['vendor'=>$product->Vendor->slug,'product'=>$product->Product->slug])}}"
                    class="text-reset d-flex align-items-center flex-grow-1"> <img
                        src="{{asset('thumbnail_img/'.$product->Product->thumbnail_img)}}"
                        data-src="{{asset('thumbnail_img/'.$product->Product->thumbnail_img)}}"
                        class="img-fit lazyload size-60px rounded"
                        alt="M28 TWS RGB Touch Control Zero Lag Wireless Earbuds"> <span
                        class="minw-0 pl-2 flex-grow-1">
                        <span class="fw-600 mb-1 text-truncate-2">
                            {{$product->Product->title}}
                        </span>
                        <span class="">{{$product->quantity}}x</span>
                        @if ($product->Product->sale_price != '')

                        @php
                        $total_cart_amount += $product->Product->sale_price * $product->quantity;
                        @endphp

                        <span class="">৳{{$product->Product->sale_price}}</span>
                        @else

                        @php
                        $total_cart_amount += $product->Product->regular_price * $product->quantity;
                        @endphp

                        <span class="">৳{{$product->Product->regular_price}}</span>
                        @endif
                    </span>
                </a>
                <span class="">
                    <button onclick="removeFromCart({{$product->id}})" class="btn btn-sm btn-icon stop-propagation">
                        <i class="la la-close"></i>
                    </button>
                </span>
            </span>
        </li>
        @empty
        <div class="text-center p-3">
            <i class="las la-frown la-3x opacity-60 mb-3"></i>
            <h3 class="h6 fw-700">Your Cart is empty</h3>
        </div>
        @endforelse
    </ul>
    @if ($cart_item->count() != 0)

    <div class="px-3 py-2 fs-15 border-top d-flex justify-content-between cart_total">
        <span class="opacity-60">Subtotal</span>
        <span class="fw-600 cart_total">৳{{round($total_cart_amount)}}</span>
    </div>
    <div class="px-3 py-2 text-center border-top">
        <ul class="list-inline mb-0">
            <li class="list-inline-item"> <a href="{{route('CartView')}}" class="btn btn-soft-primary btn-sm">
                    View cart </a> </li>
        </ul>
    </div>
    @endif
</div>