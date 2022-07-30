<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class CartController extends Controller
{
    public function CartView()
    {
        return view('frontend.pages.cart-view', [
            'carts' => Cart::with(['Product'])->Where('cookie_id', Cookie::get('cookie_id'))->latest('id')->get(),
        ]);
    }
    public function CartPost(Request $request)
    {
        // return $request;
        session()->forget('cart_total');
        $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'shop_id' => ['required', 'exists:vendors,id'],
            'brand_id' => ['required', 'exists:brands,id'],
            'quantity' => ['required', 'numeric'],
        ]);


        // if ($request->hasCookie('cookie_id')) {
        //     $cookie_id_generate = $request->cookie('cookie_id');
        // } else {
        //     // if user dont have cookie
        //     $cookie_id_generate = time() . Str::random(10);
        //     Cookie::queue('cookie_id', $cookie_id_generate, 129600);
        // }
        // return 1;

        $product_already_add = Cart::Where('user_id', Auth::guard('web')->id())
            ->Where('product_id', $request->product_id)
            ->Where('brand_id', $request->brand_id);
        if ($product_already_add->exists()) {
            // checking the product already added if added then update the quantitiy
            Cart::Where('user_id', Auth::guard('web')->id())
                ->Where('product_id', $request->product_id)
                ->Where('brand_id', $request->brand_id)
                ->increment('quantity', $request->quantity);
            return response()->json(['done' => 'Prodcut add to cart succcessfully']);
        }

        // new data add
        $cart = new Cart;
        $cart->user_id = Auth::guard('web')->id();
        $cart->product_id = $request->product_id;
        $cart->quantity = $request->quantity;
        $cart->brand_id = $request->brand_id;
        $cart->save();
        return response()->json(['done' => 'Prodcut add to cart succcessfully']);
    }
    public function CartUpdate(Request $request)
    {
        // return $request;
        $request->validate([
            'cart_quantity' => ['required', 'numeric', 'min:1'],
            'cart_id' => ['required', 'numeric',]
        ]);
        $cart = Cart::findorfail($request->cart_id);

        $cart->quantity = $request->cart_quantity;
        $cart->save();

        if ($cart->product->sale_price != '') {
            $price = $cart->product->sale_price;
        } else {
            $price = $cart->product->regular_price;
        }
        $html = '<span class="money sub_product_total">$' . $price * $request->cart_quantity . '</span>';
        return response()->json($html);
    }
    public function CartRemove(Request $request)
    {
        $request->validate([
            'cart_id' => ['required'],
        ]);
        Cart::findorfail($request->cart_id)->delete();
        return response()->json(['done' => 'cart Removed']);
    }
    public function CartModalView(Request $request)
    {
        $request->validate([
            '*' => ['required'],
        ]);
        $product = Product::whereid($request->id)
            ->with(['Gallery'])
            ->wherestatus(1)
            ->first();
        $modal = view('frontend.pages.cart-modal', compact('product'))->render();
        return response()->json($modal);
    }
}
