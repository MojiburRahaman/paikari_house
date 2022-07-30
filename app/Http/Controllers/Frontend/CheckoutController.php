<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function CheckoutView()
    {
        if (!session()->get('cart_total')) {
            return back();
        }
        return view('frontend.pages.checkout', [
            
        ]);
    }
}
