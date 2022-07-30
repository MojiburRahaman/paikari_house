<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $brands=Brand::latest('id')->simplepaginate(15);
       return view('backend.brand.index',compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.brand.create');
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
            'title' => ['required', 'string', 'max:200', 'unique:brands,title'],
            // 'thumbnail' => ['required', 'mimes:png,jpg']
        ]);

        $brand = new Brand;
        $brand->title = strip_tags($request->title);
        $brand->slug = strip_tags(Str::slug($request->title));

        if ($request->hasFile('thumbnail')) {

            $brand_img = $request->file('thumbnail');
            $extension = Str::slug($request->title) . '-' . Str::random(3) . '.' . $brand_img->getClientOriginalExtension();
            Image::make($brand_img)->save(public_path('brand_img/' . $extension), 90);
        }

        $brand->thumbnail = $extension;
        $brand->save();
        return redirect()->route('brand.index')->with('success', 'Brand Added Successfully');
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
        $brand = Brand::findorfail($id);
        return view('backend.brand.edit',compact('brand'));
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
            'title' => ['required', 'string', 'max:200', 'unique:brands,title,'.$id],
            // 'thumbnail' => [ 'mimes:png,jpg']
        ]);
        $brand = Brand::findorfail($id);
        $brand->title = strip_tags($request->title);
        $brand->slug = strip_tags(Str::slug($request->title));
        if ($request->hasFile('thumbnail')) {
            // old image delete
            $old_img = public_path('brand_img/' . $brand->brand_img);
            if (file_exists($old_img)) {
                @unlink($old_img);
            }
            $brand_img = $request->file('thumbnail');
            $extension = Str::slug($request->title) . '-' . Str::random(3) . '.' . $brand_img->getClientOriginalExtension();
            Image::make($brand_img)->save(public_path('brand_img/' . $extension), 70);

            $brand->thumbnail = $extension;
            $brand->save();
        }
        return redirect()->route('brand.index')->with('warning', 'Brand Edited Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
