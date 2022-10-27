<?php

namespace App\Http\Controllers\dashboard\vendor;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Gallery;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::Where('vendor_id', auth('vendor')->id())
            ->latest('id')
            ->get();
        return view('backend.vendor.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::latest('id')->get();
        $Brands = Brand::latest('id')->get();
        return view('backend.vendor.product.create', compact('categories', 'Brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'unique:products,title'],
            'meta_description' => ['required', 'max:250'],
            'meta_keyword' => ['required', 'max:250'],
            'category_id' => ['required',],
            'subcatagory_id' => ['required',],
            'category_id' => ['required',],
            'brand_id' => ['required', 'numeric'],
            'thumbnail' => ['required',],
            'product_image' => ['required',],
            'product_summary' => ['required',],
            'regular_price' => ['required',],
            'discount' =>  ['nullable', 'numeric', 'min:1', 'max:99'],
            'product_description' => ['required',],
        ]);

        $product = new Product();
        $product->title = $request->title;
        $product->slug = Str::slug($request->title);
        $product->category_id = $request->category_id;
        $product->vendor_id = auth('vendor')->id();
        $product->meta_description = $request->meta_description;
        $product->meta_keyword = $request->meta_keyword;
        $product->subcatagory_id = $request->subcatagory_id;
        $product->brand_id = $request->brand_id;
        $product->product_summary = $request->product_summary;
        $product->product_description = $request->product_description;
        $product->regular_price = $request->regular_price;

        if ($request->discount != '') {
            $regular_price = $request->regular_price;
            $discount_amount = ($request->regular_price * $request->discount) / 100;
            $sell_price = round($request->regular_price - $discount_amount);

            $product->sale_price = $sell_price;
            $product->discount = $request->discount;
        }

        if ($request->hasFile('thumbnail')) {
            $product_thumbnail = $request->file('thumbnail');
            $extension = Str::slug($request->title) . '-' . Str::random(1) . '.' . $product_thumbnail->getClientOriginalExtension();
            Image::make($product_thumbnail)->save(public_path('thumbnail_img/' . $extension), 95);
        }
        $product->thumbnail_img = $extension;
        $product->save();

        if ($request->hasFile('product_image')) {
            // product image validation
            $p_img = $request->file('product_image');
            foreach ($p_img as $value) {
                $product_img = Str::slug($request->title) . '-' . Str::random(2) . '.' .
                    $value->getClientOriginalExtension();

                Image::make($value)->save(public_path('product_image/' . $product_img), 90);
                $gallery = new Gallery();
                $gallery->product_image = $product_img;
                $gallery->product_id = $product->id;
                $gallery->save();
            }
        }
        return redirect()->route('product.index')->with('success', 'Product Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('backend.vendor.product.edit', [
            'product' =>  Product::findorfail($id),
            'categories' => Category::latest('id')->get(),
            'SubCategories' => SubCategory::latest('id')->get(),
            'Brands' => Brand::latest('id')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => ['required', 'unique:products,title,' . $id],
            'meta_description' => ['required', 'max:250'],
            'meta_keyword' => ['required', 'max:250'],
            'category_id' => ['required',],
            'subcatagory_id' => ['required',],
            'category_id' => ['required',],
            'brand_id' => ['required',],
            'thumbnail' => ['mimes:png,jpg'],
            // 'product_image' => ['mimes:png,jpg'],
            // 'product_new_image' => ['mimes:png,jpg'],
            'product_summary' => ['required',],
            'regular_price' => ['required',],
            'discount' =>  ['nullable', 'numeric', 'min:1', 'max:99'],
            'product_description' => ['required',],
        ]);

        $product =  Product::findorfail($id);
        $product->title = $request->title;
        $product->slug = Str::slug($request->title);
        $product->category_id = $request->category_id;
        $product->meta_description = $request->meta_description;
        $product->meta_keyword = $request->meta_keyword;
        $product->subcatagory_id = $request->subcatagory_id;
        $product->brand_id = $request->brand_id;
        $product->product_summary = $request->product_summary;
        $product->product_description = $request->product_description;
        $product->regular_price = $request->regular_price;

        if ($request->discount != '') {
            $regular_price = $request->regular_price;
            $discount_amount = ($request->regular_price * $request->discount) / 100;
            $sell_price = round($request->regular_price - $discount_amount);

            $product->sale_price = $sell_price;
            $product->discount = $request->discount;
        }

        if ($request->hasFile('thumbnail')) {
            $old_img = public_path('thumbnail_img/' . $product->thumbnail_img);
            if (file_exists($old_img)) {
                @unlink($old_img);
            }

            $product_thumbnail = $request->file('thumbnail');
            $extension = Str::slug($request->title) . '-' . Str::random(1) . '.' . $product_thumbnail->getClientOriginalExtension();
            Image::make($product_thumbnail)->save(public_path('thumbnail_img/' . $extension), 95);

            $product->thumbnail_img = $extension;
        }
        $product->save();

        if ($request->hasFile('product_image')) {
            // product image validation
            $p_img = $request->file('product_image');
            foreach ($p_img as $key => $value) {
                if ($request->gallery_id[$key] != '') {
                    // old image unlink
                    $gallery = Gallery::findorfail($request->gallery_id[$key]);
                    $old_img = public_path('product_image/' . $gallery->product_image);
                    if (file_exists($old_img)) {
                        unlink($old_img);
                    }

                    $product_img = Str::slug($request->title) . '-' . Str::random(2) . '.' .
                        $value->getClientOriginalExtension();

                    Image::make($value)->save(public_path('product_image/' . $product_img), 90);

                    $gallery->product_image = $product_img;
                    $gallery->product_id = $product->id;
                    $gallery->save();
                }
            }
        }
        if ($request->hasFile('product_new_image')) {
            // product image validation
            $p_img = $request->file('product_new_image');
            foreach ($p_img as $value) {
                $product_img = Str::slug($request->title) . '-' . Str::random(2) . '.' .
                    $value->getClientOriginalExtension();

                Image::make($value)->save(public_path('product_image/' . $product_img), 90);
                $gallery = new Gallery();
                $gallery->product_image = $product_img;
                $gallery->product_id = $product->id;
                $gallery->save();
            }
        }
        return redirect()->route('product.index')->with('success', 'Product Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Product = Product::findorfail($id);
        $old_img = public_path('thumbnail_img/' . $Product->thumbnail_img);
        if (file_exists($old_img)) {
            @unlink($old_img);
        }

        $gallerys = $Product->Gallery;

        foreach ($gallerys as  $gallery) {
            $old_img = public_path('product_image/' . $gallery->product_image);
            if (file_exists($old_img)) {
                unlink($old_img);
            }
            $gallery->delete();
        }
        $Product->delete();
        return back()->with('danger', 'Product  Deleted');
    }
    public function GetSubcatbyAjax($id)
    {
        return    $subcategories = SubCategory::where('category_id', $id)->get();
        return response()->json($subcategories);
    }
    public function GalleryRemove($id)
    {
        $gallery = Gallery::findorfail($id);
        $old_img = public_path('product_image/' . $gallery->product_image);
        if (file_exists($old_img)) {
            unlink($old_img);
        }
        $gallery->delete();
        return back()->with('warning', 'Product Image Deleted');
    }

    public function ProductStatus(Request $request)
    {
        $id = $request->id;

        $Product = Product::findorfail($id);
        if ($Product->status == 1) {
            $Product->status = 2;
            $Product->save();
            return response()->json([
                'inactive' => 'Product Inactivated',
            ]);

            
        } else {
            $Product->status = 1;
            $Product->save();
            return response()->json([
                'active' => 'Product Activated',
            ]);
        }
    }
    public function ProductFeature(Request $request)
    {
        $id = $request->id;

        $Product = Product::findorfail($id);
        if ($Product->fetured == 0) {
            $Product->fetured = 1;
            $Product->save();
            return response()->json([
                'inactive' => 'Product featured Inactivated',
            ]);

            
        } else {
            $Product->fetured = 1;
            $Product->save();
            return response()->json([
                'active' => 'Product featured Activated',
            ]);
        }
    }
    public function ProductTrending(Request $request)
    {
        $id = $request->id;

        $Product = Product::findorfail($id);
        if ($Product->trending == 0) {
            $Product->trending = 1;
            $Product->save();
            return response()->json([
                'inactive' => 'Product trending Inactivated',
            ]);

        } else {
            $Product->trending = 1;
            $Product->save();
            return response()->json([
                'active' => 'Product trending Activated',
            ]);
        }
    }
}
