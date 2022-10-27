<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CategoryBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use Intervention\Image\Facades\Image;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categoreis = Category::select('id', 'title', 'thumbnail', 'status')->latest('id')->simplepaginate(10);
        return view('backend.category.index', [
            'categoreis' => $categoreis,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;
        $request->validate([
            'title' => ['required', 'string', 'unique:categories,title'],
            'thumbnail' => ['required', 'mimes:png,jpg']
        ]);
        $catagory = new Category;
        $catagory->title = $request->title;
        $catagory->slug = Str::slug($request->title);

        if ($request->hasFile('thumbnail')) {
            $product_thumbnail = $request->file('thumbnail');
            $extension = Str::slug($request->title) . '-' . Str::random(1) . '.' . $product_thumbnail->getClientOriginalExtension();
            Image::make($product_thumbnail)->save(public_path('category_images/' . $extension), 90);

            $catagory->thumbnail = $extension;
        }
        if ($request->hasFile('discount_thumbnail')) {
            $product_thumbnail = $request->file('discount_thumbnail');
            $extension = Str::slug($request->title) . '-' . Str::random(2) . '.' . $product_thumbnail->getClientOriginalExtension();
            Image::make($product_thumbnail)->save(public_path('category_images/discount/' . $extension), 90);

            $catagory->discount_thumbnail = $extension;
        }
        $catagory->save();

        if ($request->hasFile('banner')) {
            // product image validation
            $p_img = $request->file('banner');
            foreach ($p_img as $value) {
                $product_img = Str::slug($request->title) . '-' . Str::random(2) . '.' .
                    $value->getClientOriginalExtension();

                Image::make($value)->save(public_path('category_images/banner/' . $product_img), 90);

                $CategoryBanner = new CategoryBanner;
                $CategoryBanner->banner = $product_img;
                $CategoryBanner->category_id = $catagory->id;
                $CategoryBanner->save();
            }
        }


        return redirect()->route('category.index')->with('success', 'Category Added');
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
        $catagory = Category::findorfail($id);
        return view('backend.category.edit', [
            "catagory" => $catagory,
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
        // return $request;
        $request->validate([
            'title' => ['required', 'string', 'unique:categories,title,' . $id],
        ]);
        $catagory =  Category::findorfail($id);
        $catagory->title = $request->title;
        $catagory->slug = Str::slug($request->title);

        if ($request->hasFile('thumbnail')) {
            if ($catagory->thumbnail != '') {
                $old_thumbnail = public_path('category_images/' . $catagory->catagory_image);
                if (file_exists($old_thumbnail)) {
                    @unlink($old_thumbnail);
                }
            }
            $product_thumbnail = $request->file('thumbnail');
            $extension = Str::slug($request->title) . '-' . Str::random(1) . '.' . $product_thumbnail->getClientOriginalExtension();
            Image::make($product_thumbnail)->save(public_path('category_images/' . $extension), 90);
            $catagory->thumbnail = $extension;
        }
        if ($request->hasFile('discount_thumbnail')) {
            if ($catagory->discount_thumbnail != '') {
                $old_thumbnail = public_path('category_images/discount/' . $catagory->catagory_image);
                if (file_exists($old_thumbnail)) {
                    @unlink($old_thumbnail);
                }
            }
            $product_thumbnail = $request->file('discount_thumbnail');
            $extension = Str::slug($request->title) . '-' . Str::random(2) . '.' . $product_thumbnail->getClientOriginalExtension();
            Image::make($product_thumbnail)->save(public_path('category_images/discount/' . $extension), 90);
            $catagory->discount_thumbnail = $extension;
        }

        $catagory->save();

        if ($request->hasFile('banner')) {
            // product image validation
            $p_img = $request->file('banner');
            foreach ($p_img as $key => $value) {
                if ($request->banner_id[$key] != '') {
                    // old image unlink
                    $cat = CategoryBanner::findorfail($request->banner_id[$key]);
                    $old_img = public_path('category_images/banner/' . $cat->banner);
                    if (file_exists($old_img)) {
                        unlink($old_img);
                    }

                    $img = Str::slug($request->title) . '-' . Str::random(2) . '.' .
                        $value->getClientOriginalExtension();

                    Image::make($value)->save(public_path('category_images/banner/' . $img), 90);

                    $cat->banner = $img;
                    $cat->category_id = $catagory->id;
                    $cat->save();
                }
            }
        }

        if ($request->hasFile('banner_new')) {
            // product image validation
            $p_img = $request->file('banner_new');
            foreach ($p_img as $value) {
                $product_img = Str::slug($request->title) . '-' . Str::random(2) . '.' .
                    $value->getClientOriginalExtension();

                Image::make($value)->save(public_path('category_images/banner/' . $product_img), 90);

                $CategoryBanner = new CategoryBanner;
                $CategoryBanner->banner = $product_img;
                $CategoryBanner->category_id = $catagory->id;
                $CategoryBanner->save();
            }
        }

        return redirect()->route('category.index')->with('warning', 'Category Updated Succesfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $catagory =  Category::findorfail($id);
        if ($catagory->thumbnail != '') {
            $old_thumbnail = public_path('category_images/' . $catagory->thumbnail);
            if (file_exists($old_thumbnail)) {
                @unlink($old_thumbnail);
            }
        }
        if ($catagory->discount_thumbnail != '') {
            $old_thumbnail = public_path('category_images/discount/' . $catagory->discount_thumbnail);
            if (file_exists($old_thumbnail)) {
                @unlink($old_thumbnail);
            }
        }
        $catagory->delete();
        return redirect()->route('category.index')->with('danger', 'Category Deleted');
    }
    public function CategoryBannerDelete($id)
    {
        $catagory =    CategoryBanner::findorfail($id);
        if ($catagory->banner != '') {
            $old_thumbnail = public_path('category_images/banner/' . $catagory->banner);
            if (file_exists($old_thumbnail)) {
                @unlink($old_thumbnail);
            }
        }
        $catagory->delete();
        return response()->json('Item Remove');
    }
    function CategoryStatus(Request $request)
    {
        $catagory = Category::findorfail($request->id);
        if ($catagory->status == 1) {
            $catagory->status = 2;
            $catagory->save();
            return response()->json([
                'inactive' => 'Category  Inactivated',
            ]);
        } else {
            $catagory->status = 1;
            $catagory->save();
            return response()->json([
                'active' => 'Category  Activate',
            ]);
        }
    }
}
