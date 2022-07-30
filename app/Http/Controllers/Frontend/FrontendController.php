<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    public function FrontendView()
    {
        //    return Auth::user();
        return view('frontend.main', [
            'categories' => Category::with('SubCategory', 'Product.Vendor')
                ->withcount(['Product', 'SubCategory'])
                ->limit(10)
                ->get(),
            'activeProductCategory' => Category::with([
                'SubCategory', 'Product' => function ($query) {
                    $query->where('status', 1)
                        ->latest('id');
                },  'Product.Vendor',
            ])
                ->where('status', 1)
                ->get(),
            'Product' => Product::latest('id')
                ->where('status', 1)
                ->limit(20)
                ->latest('id')
                ->get(),
        ]);
    }
    public function ProductView($vendor, $product)
    {
        $seller = Vendor::where('slug', $vendor)->firstorfail();
        $products = Product::where('vendor_id', $seller->id)
            ->where('slug', $product)
            ->where('status', 1)
            ->with('Gallery')
            ->firstorfail();

        return view('frontend.pages.product-view',[
        // return view('frontend.pages.product-view-test', [
            'product' => $products,
            'similar_product' => Product::where('category_id', $products->category_id)->where('id', '!=', $products->id)->get(),
            'trending_product' => Product::where('trending', 1)->inRandomOrder()->take(10)->get(),

        ]);
    }
    public function Category()
    {

        return view('frontend.pages.category');
    }
}
