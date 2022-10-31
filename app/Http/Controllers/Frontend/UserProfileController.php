<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
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
}