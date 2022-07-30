<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subcategoreis = SubCategory::select('id', 'title', )->latest('id')->simplepaginate(10);
        return view('backend.sub-category.index',[
            'subcategoreis' => $subcategoreis,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::select('id', 'title', )->latest('id')->get();
        return view('backend.sub-category.create',[
            'categories' => $categories,
        ]);
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
            'title' => ['required', 'unique:sub_categories,title'],
            'category_id' => ['required']
        ]);
        $subcatagory = new SubCategory;
        $subcatagory->category_id = $request->category_id;
        $subcatagory->title = strip_tags($request->title);
        $subcatagory->slug = strip_tags(Str::slug($request->title));
        $subcatagory->save();
        return redirect()->route('subcategory.index')->with('success', 'Sub Category Created Successfully');
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
       
        $subcatagory = Subcategory::select('id', 'title', 'category_id')->findorfail($id);
        $catagories = Category::select('id', 'title')->get();

        return view(
            'backend.sub-category.edit',
            [
                'catagories' => $catagories,
                'subcatagory' => $subcatagory,
            ]
        );
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
            'title' => ['required', 'unique:sub_categories,title,' . $id],
            'category_id' => ['required']
        ]);
        $subcatagory =  SubCategory::findorfail($id);
        $subcatagory->category_id = $request->category_id;
        $subcatagory->title = strip_tags($request->title);
        $subcatagory->slug = strip_tags(Str::slug($request->title));
        $subcatagory->save();
        return redirect()->route('subcategory.index')->with('warning', 'Sub Category Edited Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        SubCategory::findorfail($id)->delete();
        return redirect()->route('subcategory.index')->with('danger', 'Sub Category Deletd ');
    }

}
