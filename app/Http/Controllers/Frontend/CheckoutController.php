<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\BillingDetail;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\OrderSummaries;
use App\Models\OrderTable;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Devfaysal\BangladeshGeocode\Models\Division;
use Devfaysal\BangladeshGeocode\Models\District;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cookie;

class CheckoutController extends Controller
{
    public function CheckoutView()
    {
        // return session()->get('subtotal_price');
        // if (!session()->get('cart_total')) {
        //     return back();
        // }
        $carts = Cart::where('user_id', auth('web')->id())->with('Product:title,id,sale_price,regular_price,thumbnail_img')->get();

        $divisons = Division::all();
        // return  Cart::groupBy('vendor_id')
        // ->selectRaw('sum(quantity) , vendor_id')
        // ->get(); 
        //  return   DB::table('carts')
        //     ->join('products','products.id','=','carts.product_id')
        //     ->where('products.vendor_id','=','7')
        //     ->selectRaw('(round(sum(regular_price * carts.quantity))) as  regular_price,(round(sum(sale_price * carts.quantity))) as  sale_price ')
        //     // ->selectRaw('sum(regular_price) as regular_price,sum(sale_price) as sale_price')
        //     ->get();

        return view('frontend.pages.checkout-view', [
            'carts' => $carts,
            'divisions' => $divisons,
        ]);
    }
    public function CouponPost(Request $request)
    {

        $request->validate([
            'coupon' => ['required',]
        ]);
        $coupon  = Coupon::where('coupon_name', $request->coupon)->firstorfail();
        //   $price =   DB::table('carts')
        //           ->join('products','products.id','=','carts.product_id')
        //           ->where('products.vendor_id','=',$coupon->vendor_id)
        //           ->selectRaw('(round(sum(regular_price * carts.quantity))) as  regular_price,(round(sum(sale_price * carts.quantity))) as  sale_price ')
        //         //   ->selectRaw('((regular_price * '.$coupon->discount.')/100) as regular_discount')
        //           ->get();
        $product_price =   DB::table('carts')
            ->join('products', 'products.id', '=', 'carts.product_id')
            ->where('products.vendor_id', '=', $coupon->vendor_id)
            ->selectRaw('(round(regular_price * carts.quantity)) as  regular_price,(round(sale_price * carts.quantity)) as  sale_price')
            ->get();

        $total_price = 0;
        foreach ($product_price as $key => $value) {
            if ($value->sale_price != '') {
                $total_price += $value->sale_price;
            } else {

                $total_price += $value->regular_price;
            }
        }
        $discount_amount = round(($total_price * $coupon->discount) / 100);

        session()->put('discount', $discount_amount);
        session()->put('coupon', $request->coupon);


        return response()->json([
            'discount' => $discount_amount
        ]);
    }
    function GetDiistrict(Request $request)
    {
        $request->validate([
            'division_id' => ['required']
        ]);

        $district = District::where('division_id', $request->division_id)
            ->select('id', 'name')->get();
        return response()->json($district);
    }
    public function CheckoutPost(Request $request)
    {
        // return $request;
        $request->validate([
            'billing_user_name' => ['required', 'string', 'max:150'],
            'billing_number' => ['numeric', 'required',],
            'division_name' => ['numeric', 'required',],
            'district_name' => ['numeric', 'required',],
            'billing_order_note' => ['nullable', 'string',],
        ]);

        // DB::transaction(function () use($request) {


        $order_number = now()->format('dm') . auth('web')->id() . mt_rand(1, 1000);
        $billing_details = BillingDetail::insertGetId($request->except('_token') + [
            'payment_option' => 'cash_on_delivery',
            'order_number' => $order_number,
            'created_at' => now(),
            'user_email' => auth('web')->user()->email,
            'user_id' => auth('web')->id(),
        ]);

        $Order_Summaries_id = OrderSummaries::insertGetId([
            'billing_details_id' => $billing_details,
            'user_id' => auth('web')->id(),
            'order_number' => $order_number,
            'coupon_name' => session()->get('coupon'),
            'total' => session()->get('total_price'),
            'subtotal' => session()->get('subtotal_price') + session()->get('shipping'),
            'discount' => session()->get('discount'),
            'shipping' => session()->get('shipping'),
            'created_at' => now(),
        ]);
        $carts = Cart::Where('user_id', auth('web')->id())->get();
        foreach ($carts as  $cart) {
            OrderTable::insert([
                'order_number' => $order_number,
                'Order_Summaries_id' => $Order_Summaries_id,
                'product_id' => $cart->product_id,
                'vendor_id' => $cart->vendor_id,
                'customer_id' => auth('web')->id(),
                'regular_price' => $cart->Product->regular_price,
                'sale_price' => $cart->Product->sale_price,
                'discount' => $cart->Product->discount,
                'quantity' => $cart->quantity,
                'created_at' => Carbon::now(),
            ]);

            $cart->delete();
        }
        if (session()->get('coupon')) {
            Coupon::where('coupon_name', session()->get('coupon'))->decrement('user_limit', 1);
        }
        // Mail::to(auth()->user()->email)->send(new OrderPlace($order_number,auth()->user()->name));
        session()->forget('total_price');
        session()->forget('coupon_name');
        session()->forget('cart_discount');
        session()->forget('subtotal_price');
        session()->forget('shipping');
        return redirect('/')->with('orderPlace', $order_number);


        // });
        return 'done';
    }
}
