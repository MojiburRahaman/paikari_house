<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\OrderSummaries;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    function UserProfile()
    {
        $carts = Cart::whereUserId(auth('web')->id())->count();
        $wishlists = Wishlist::whereUserId(auth('web')->id())->count();

        return view('frontend.profile.dashboard',  [
            'carts' => $carts,
            'wishlists' => $wishlists,
        ]);
    }
    function UserPurchase()
    {
        $orders = OrderSummaries::whereUserId(auth('web')->id())
            ->withCount(['Order'])
            ->latest('id')
            ->get();

        return view('frontend.profile.purchase',  [
            'orders' => $orders,
        ]);
    }
    function UserOrderDetails($id, Request $request)
    {
        abort_if(!$request->hasValidSignature(), 404);
        $order = OrderSummaries::whereUserId(auth('web')->id())
            ->whereId($id)
            ->with(['Order.Product'])
            ->firstorfail();

        return view('frontend.profile.order-details',  [
            'order' => $order,
        ]);
    }
}
