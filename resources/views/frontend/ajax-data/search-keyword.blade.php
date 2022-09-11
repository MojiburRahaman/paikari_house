@if($products->count() != 0)


<div class="">
    <div class="px-2 py-1 text-uppercase fs-10 text-right text-muted bg-soft-secondary">Popular Suggestions</div>
    <ul class="list-group list-group-raw">
        @foreach ($products->take(5) as $item )

        <li class="list-group-item py-1">
            <a class="text-reset hov-text-primary" href="{{ route('FrontendView').'?search='.$item->title }}">{{
                $item->title }}</a>
        </li>
        @endforeach
    </ul>
</div>
@endif
@if($categories->count() != 0)
<div class="">
    <div class="px-2 py-1 text-uppercase fs-10 text-right text-muted bg-soft-secondary">Category Suggestions</div>
    <ul class="list-group list-group-raw">
        @foreach ($categories->take(5) as $item )
        <li class="list-group-item py-1">
            <a class="text-reset hov-text-primary" href="{{ route('CategorySearch',$item->slug) }}">{{
                $item->title }}</a>
        </li>
        @endforeach
    </ul>
</div>
@endif
@if($products->count() != 0)


<div class="">
    <div class="px-2 py-1 text-uppercase fs-10 text-right text-muted bg-soft-secondary">Products</div>
    <ul class="list-group list-group-raw">
        @foreach ($products as $item )

        <li class="list-group-item">
            <a class="text-reset"
                href="{{route('ProductView',['vendor'=>$item->vendor->slug,'product'=>$item->slug])}}">
                <div class="d-flex search-product align-items-center">
                    <div class="mr-3">
                        <img class="size-40px img-fit rounded" src="{{ asset('thumbnail_img/'.$item->thumbnail_img) }}">
                    </div>
                    <div class="flex-grow-1 overflow--hidden minw-0">
                        <div class="product-name text-truncate fs-14 mb-5px">
                            {{ $item->title }}
                        </div>
                        <div class="">
                            @if($item->sale_price != '')

                            <del class="opacity-60 fs-15">৳{{ $item->regular_price }}</del>

                            <span class="fw-600 fs-16 text-primary">৳{{ $item->sale_price }}</span>
                            @else
                            <span class="fw-600 fs-16 text-primary">৳{{ $item->regular_price }}</span>
                            @endif
                        </div>
                    </div>
                </div>
            </a>
        </li>
        @endforeach
    </ul>
</div>
@endif
<div class="">
</div>