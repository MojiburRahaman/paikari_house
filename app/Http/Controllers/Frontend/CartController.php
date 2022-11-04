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
        return view('frontend.pages.cart', [
            'carts' => Cart::with(['Product'])->Where('user_id', auth('web')->id())->latest('id')->get(),
        ]);
    }
    public function CartPost(Request $request)
    {
        session()->forget('total_price');
        $request->validate([
            'product_id' => ['required', 'numeric', 'exists:products,id'],
            'vendor_id' => ['required', 'numeric', 'exists:vendors,id'],
            'brand_id' => ['required', 'numeric', 'exists:brands,id'],
            'quantity' => ['required', 'numeric',],
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
            ->Where('vendor_id', $request->vendor_id)
            ->Where('brand_id', $request->brand_id);
        if ($product_already_add->exists()) {
            // checking the product already added if added then update the quantitiy
            Cart::Where('user_id', Auth::guard('web')->id())
                ->Where('product_id', $request->product_id)
                ->Where('vendor_id', $request->vendor_id)
                ->Where('brand_id', $request->brand_id)
                ->increment('quantity', $request->quantity);

            $added_product = Product::where('id', $request->product_id)
                ->where('vendor_id', $request->vendor_id)
                ->where('brand_id', $request->brand_id)
                ->select('id', 'title', 'slug', 'vendor_id', 'regular_price', 'sale_price', 'thumbnail_img', 'category_id')
                ->first();
            $similar_product = Product::where('category_id', $added_product->category_id)
                ->where('id', '!=', $added_product->id)
                ->with(['Vendor'])
                ->select('id', 'title', 'slug', 'vendor_id', 'regular_price', 'sale_price', 'thumbnail_img', 'category_id')
                ->get();

            $added_modal = view('frontend.pages.modal.cart-added-modal', compact(['added_product', 'similar_product']))->render();

            $cart_item = Cart::where('user_id', auth('web')->id())
                ->with(['Product', 'Vendor'])
                ->get();

            $nav_modal = view('frontend.pages.modal.cart-added-nav-modal', compact(['cart_item',]))->render();
            return response()->json([
                'modal_view' => $added_modal,
                'cart_count' => $cart_item->count(),
                'nav_cart_view' => $nav_modal
            ]);
        }

        $cart = new Cart;
        $cart->user_id = auth('web')->id();
        $cart->product_id = $request->product_id;
        $cart->vendor_id = $request->vendor_id;
        $cart->quantity = $request->quantity;
        $cart->brand_id = $request->brand_id;
        $cart->save();

        $added_product = Product::where('id', $request->product_id)
            ->where('vendor_id', $request->vendor_id)
            ->where('brand_id', $request->brand_id)
            ->select('id', 'title', 'slug', 'vendor_id', 'regular_price', 'sale_price', 'thumbnail_img', 'category_id')
            ->first();
        $similar_product = Product::where('category_id', $added_product->category_id)
            ->where('id', '!=', $added_product->id)
            ->with(['Vendor'])
            ->select('id', 'title', 'slug', 'vendor_id', 'regular_price', 'sale_price', 'thumbnail_img', 'category_id')
            ->get();

        $added_modal = view('frontend.pages.modal.cart-added-modal', compact(['added_product', 'similar_product']))->render();

        $cart_item = Cart::where('user_id', auth('web')->id())
            ->with(['Product', 'Vendor'])
            ->get();

        $nav_modal = view('frontend.pages.modal.cart-added-nav-modal', compact(['cart_item',]))->render();
        return response()->json([
            'modal_view' => $added_modal,
            'cart_count' => $cart_item->count(),
            'nav_cart_view' => $nav_modal
        ]);
    }
    public function CartUpdate(Request $request)
    {
        $request->validate([
            'quantity' => ['required', 'numeric', 'min:1'],
            'id' => ['required', 'numeric',]
        ]);

        $cart = Cart::findorfail($request->id);
        $cart->quantity = $request->quantity;
        $cart->save();

        $cart_item = Cart::with(['Product', 'Vendor'])->Where('user_id', auth('web')->id())->latest('id')->get();

        $cart_ajax = view('frontend.pages.cart-ajax', [
            'carts' => $cart_item,
        ])->render();

        $nav_modal = view('frontend.pages.modal.cart-added-nav-modal', compact(['cart_item',]))->render();

        return response()->json([
            'cart_view' => $cart_ajax,
            'nav_cart_view' => $nav_modal,
        ]);
    }
    public function CartRemove(Request $request)
    {
        $request->validate([
            'id' => ['required'],
        ]);
        Cart::findorfail($request->id)->delete();
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
        $modal = view('frontend.pages.modal.cart-modal', compact('product'))->render();
        return response()->json($modal);
    }
    public function AjaxCartView()
    {
        $cart_item = Cart::where('user_id', auth('web')->id())
            ->latest('id')
            ->with(['Product', 'Vendor'])
            ->get();

        $nav_modal = view('frontend.pages.modal.cart-added-nav-modal', compact(['cart_item',]))->render();
        return response()->json([
            'nav_cart_view' => $nav_modal,
            'cart_count' => $cart_item->count(),
        ]);
    }
}
