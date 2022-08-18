<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
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
     return   DB::table('carts')
    //  ->select('id','product_id','vendor_id')
        ->join('products','products.id','=','carts.product_id')
        ->where('products.vendor_id','=','11')
        // ->groupBy('products.vendor_id')
        ->selectRaw('(round(sum(regular_price * carts.quantity))) as  regular_price,(round(sum(sale_price * carts.quantity))) as  sale_price ')
        // ->selectRaw('sum(regular_price) as regular_price,sum(sale_price) as sale_price')
        ->get();

        return view('frontend.pages.checkout-view', []);
    }
}
