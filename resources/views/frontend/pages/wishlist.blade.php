@extends('frontend.profile.dashboard')
@section('title','WishList')
@section('profile')
<div class="aiz-user-panel">

    <div class="aiz-titlebar mt-2 mb-4">
        <div class="row align-items-center">
            <div class="col-md-6">
                <b class="h4">Wishlist</b>
            </div>
        </div>
    </div>

    <div class="row gutters-5">

        @if ($wishlists->count() != 0)
        
        @foreach ($wishlists as $wishlist)
            
        <div class="col-xxl-3 col-xl-4 col-lg-3 col-md-4 col-sm-6" id="wishlist_{{ $wishlist->id }}">
            <div class="card mb-2 shadow-sm">
                <div class="card-body">
                    <a href="{{route('ProductView',['vendor'=>$wishlist->Product->Vendor->slug,'product'=>$wishlist->Product->slug])}}"
                        class="d-block mb-3">
                        <img src="{{asset('thumbnail_img/'.$wishlist->Product->thumbnail_img)}}"
                            class="img-fit h-140px h-md-200px">
                    </a>

                    <h5 class="fs-14 mb-0 lh-1-5 fw-600 text-truncate-2">
                        <a href="{{route('ProductView',['vendor'=>$wishlist->Product->Vendor->slug,'product'=>$wishlist->Product->slug])}}"
                            class="text-reset">{{$wishlist->Product->title}}</a>
                    </h5>
                    <div class="rating rating-sm mb-1">
                        <i class="las la-star"></i><i class="las la-star"></i><i class="las la-star"></i><i
                            class="las la-star"></i><i class="las la-star"></i>
                    </div>
                    <div class=" fs-14">
                        @if ($wishlist->Product->discount != '')
                        <del class="fw-600 opacity-50 mr-1">৳{{$wishlist->Product->regular_price}}</del>
                        <span class="fw-700 text-primary">৳{{$wishlist->Product->sale_price}}</span>
                        @else
                        <span class="fw-700 text-primary">৳{{$wishlist->Product->regular_price}}</span>
                        
                        @endif
                    </div>
                </div>
                <div class="card-footer">
                    <a href="#" class="link link--style-3" data-toggle="tooltip" data-placement="top"
                        title="Remove from wishlist" onclick="removeFromWishlist({{ $wishlist->id }})">
                        <i class="la la-trash la-2x"></i>
                    </a>
                    <button type="button" class="btn btn-sm btn-block btn-primary ml-3"
                        onclick="showAddToCartModal({{ $wishlist->Product->id }})">
                        <i class="la la-shopping-cart mr-2"></i>Add to cart
                    </button>
                </div>
            </div>
        </div>
        @endforeach

        @else
<div class="col">
    <div class="text-center bg-white p-4 rounded shadow">
        <img class="mw-100 h-200px" src="https://paikarihouse.com/public/assets/img/nothing.svg" alt="Image">
        <h5 class="mb-0 h5 mt-3">There isn't anything added yet</h5>
    </div>
</div>
@endif
    </div>
    <div class="aiz-pagination">

    </div>



</div>
@endsection
@section('script_js')
<script>
        function removeFromWishlist(id){
            $.post('{{ route("WishListRemovePost") }}',{_token:'{{ csrf_token() }}', id:id}, function(data){
                $('#wishlist').html(data);
                $('#wishlist_'+id).remove();
                AIZ.plugins.notify('success', 'Item has been renoved from wishlist');
            })
        }
</script>

@endsection
{{--

<div class="col">
    <div class="text-center bg-white p-4 rounded shadow">
        <img class="mw-100 h-200px" src="https://paikarihouse.com/public/assets/img/nothing.svg" alt="Image">
        <h5 class="mb-0 h5 mt-3">There isn't anything added yet</h5>
    </div>
</div> --}}