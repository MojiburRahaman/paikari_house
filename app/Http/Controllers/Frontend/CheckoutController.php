<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\BillingDetail;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Invoice;
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
        if (!session()->get('cart_total')) {
            return back();
        }
        $carts = Cart::where('user_id', auth('web')->id())->with('Product:title,id,sale_price,regular_price,thumbnail_img')->get();

        $divisons = Division::all();


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

        session()->put('discount_info', $coupon);



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
    public function GetDiistrict(Request $request)
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
            'discount_percent' =>session()->get('discount_info')->discount,
            'discount' => session()->get('discount'),
            'shipping' => session()->get('shipping'),
            'created_at' => now(),
        ]);
        $carts = Cart::Where('user_id', auth('web')->id())->get();
        foreach ($carts as  $cart) {
            if ($cart->Product->sale_price != '') {
                $price = $cart->Product->sale_price;
            } else {
                $price = $cart->Product->regular_price;
            }

            OrderTable::insert([
                'order_number' => $order_number,
                'Order_Summaries_id' => $Order_Summaries_id,
                'product_id' => $cart->product_id,
                'vendor_id' => $cart->vendor_id,
                'customer_id' => auth('web')->id(),
                'price' => $price,
                'quantity' => $cart->quantity,
                'created_at' => Carbon::now(),
            ]);

            $cart->delete();
        }
        $OrderTables =   OrderTable::groupBy('vendor_id')
           ->where('order_number', $order_number)
           ->selectRaw('round(sum(price * quantity)) as total_price, vendor_id')
           ->get();
        foreach ($OrderTables as $key => $OrderTable) {
            $invoice = new Invoice();
            $invoice->order_number = $order_number;
            $invoice->order_summary_id = $Order_Summaries_id;
            $invoice->vendor_id = $OrderTable->vendor_id;
            if ($OrderTable->vendor_id == session()->get('discount_info')->vendor_id) {
                $invoice->coupon_name = session()->get('discount_info')->coupon_name;
                $invoice->discount_percent = session()->get('discount_info')->discount;
                $invoice->discount_amount = session()->get('discount');
            }
            $invoice->total_price = $OrderTable->total_price;
            $invoice->save();
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
