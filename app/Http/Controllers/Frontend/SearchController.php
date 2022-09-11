<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function AjaxSearch(Request $request)
    {
        $search = $request->search;
        // return Product::where('title', 'LIKE', "%$search%")
        // // ->where('status', 1)
        // ->select('id', 'slug', 'category_id', 'thumbnail_img', 'product_summary', 'title')->get();

        $products = Product::where([
            'status' => 1,
        ])->where('title', 'LIKE', "%$search%")
            ->select('id', 'title', 'slug', 'thumbnail_img', 'regular_price', 'sale_price', 'vendor_id')
            ->with('vendor')
            ->get();

        $categories = Category::where('title', 'LIKE', "%$search%")
            ->where([
                'status' => 1,
            ])
            ->select('id', 'title', 'slug')
            ->get();

        $view = view('frontend.ajax-data.search-keyword', compact('products', 'categories'))->render();
        return response()->json($view);
    }
    function CategorySearch($slug, Request $request)
    {
        $category = Category::where([
            'status' => 1,
            'slug' => $slug,
        ])
            ->select('id', 'title', 'slug')
            ->first();

        $products = Product::where([
            'status' => 1,
            'category_id' => $category->id,
        ])
            ->select('id', 'title', 'slug', 'thumbnail_img', 'regular_price', 'discount', 'sale_price', 'vendor_id')
            ->with('vendor')
            ->paginate(18);

        return view('frontend.search.search-data', [
            'products' => $products,
            'search' => $category->title,
            'categories' => Category::with('Product.Vendor:id,slug')
                ->withcount(['Product',])
                ->get(),
        ]);
    }
}
