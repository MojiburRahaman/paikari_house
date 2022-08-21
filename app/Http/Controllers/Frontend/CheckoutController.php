<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function CheckoutView()
    {
        // if (!session()->get('cart_total')) {
        //     return back();
        // }
        // return  Cart::groupBy('vendor_id')
        // ->selectRaw('sum(quantity) , vendor_id')
        // ->get(); 
        //  return   DB::table('carts')
        //     ->join('products','products.id','=','carts.product_id')
        //     ->where('products.vendor_id','=','7')
        //     ->selectRaw('(round(sum(regular_price * carts.quantity))) as  regular_price,(round(sum(sale_price * carts.quantity))) as  sale_price ')
        //     // ->selectRaw('sum(regular_price) as regular_price,sum(sale_price) as sale_price')
        //     ->get();

        return view('frontend.pages.checkout-view', []);
    }
    public function CouponPost(Request $request)
    {
        
        $request->validate([
            'coupon' => ['required']
        ]);
          $coupon  = Coupon::where('coupon_name',$request->coupon)->first();
       return   DB::table('carts')
              ->join('products','products.id','=','carts.product_id')
              ->where('products.vendor_id','=',$coupon->vendor_id)
              ->selectRaw('(round(sum(regular_price * carts.quantity))) as  regular_price,(round(sum(sale_price * carts.quantity))) as  sale_price ')
              ->selectRaw('((regular_price * '.$coupon->discount.')/100) as regular_discount')
              ->get();
        return $request;
    }
}
