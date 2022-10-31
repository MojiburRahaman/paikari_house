<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

class WishListController extends Controller
{
    function WishListView()
    {
        $wishlists = Wishlist::whereUserId(auth('web')->id())->with('Product.Vendor')->latest('id')->get();
        return view('frontend.pages.wishlist', [
            'wishlists' => $wishlists,
        ]);
    }
    function WishListViewPost(Request $request)
    {

        $request->validate([
            'id' => ['required', 'numeric', 'exists:products,id',],
        ]);


        $product_already_add = Wishlist::Where('user_id', Auth::guard('web')->id())
            ->Where('product_id', $request->id);

        if ($product_already_add->exists()) {
            $wishlist =  Wishlist::whereUserId(auth('web')->id())->count();

            $html = '<a href="https://paikarihouse.com/wishlists" class="d-flex align-items-center text-reset">
            <i class="la la-heart-o la-2x opacity-80"></i>
            <span class="flex-grow-1 ml-1">
                            <span class="badge badge-primary badge-inline badge-pill">' . $wishlist . '</span>
                        <span class="nav-box-text d-none d-xl-block opacity-70">Wishlist</span>
            </span>
        </a>';
            return response()->json($html);
        }

        $wishlist = new Wishlist;
        $wishlist->user_id = auth('web')->id();
        $wishlist->product_id = $request->id;
        $wishlist->save();

        $wishlist =  Wishlist::whereUserId(auth('web')->id())->count();

        $html = '<a href="'.route("WishListView").'" class="d-flex align-items-center text-reset">
        <i class="la la-heart-o la-2x opacity-80"></i>
        <span class="flex-grow-1 ml-1">
                        <span class="badge badge-primary badge-inline badge-pill">' . $wishlist . '</span>
                    <span class="nav-box-text d-none d-xl-block opacity-70">Wishlist</span>
        </span>
    </a>';

        return response()->json($html);
    }
    public function WishListRemovePost(Request $request)
    {

        $request->validate([
            'id' => ['required', 'numeric',]
        ]);

        Wishlist::findorfail($request->id)->delete();
        
        $wishlist =  Wishlist::whereUserId(auth('web')->id())->count();

        $html = '<a href="https://paikarihouse.com/wishlists" class="d-flex align-items-center text-reset">
        <i class="la la-heart-o la-2x opacity-80"></i>
        <span class="flex-grow-1 ml-1">
                        <span class="badge badge-primary badge-inline badge-pill">' . $wishlist . '</span>
                    <span class="nav-box-text d-none d-xl-block opacity-70">Wishlist</span>
        </span>
    </a>';

        return response()->json($html);
    }
}
