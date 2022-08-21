<?php

namespace App\Http\Controllers\dashboard\vendor;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.vendor.coupon.index', [
            'Coupons' => Coupon::latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.vendor.coupon.create');
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
            'coupon_name' => ['required', 'string', 'unique:coupons,coupon_name'],
            'discount' => ['required', 'integer', 'min:1', 'max:99'],
            'coupon_limit' => ['nullable', 'integer', 'min:1'],
            'coupon_expire_date' => ['date', 'required', 'after:tomorrow', ]
        ]);
        // return $request;

        $coupon = new Coupon;
        $coupon->vendor_id = auth('vendor')->id();
        $coupon->coupon_name = $request->coupon_name;
        $coupon->discount = $request->discount;
        $coupon->expire_date = $request->coupon_expire_date;
        $coupon->user_limit = $request->coupon_limit;
        $coupon->save();

        return redirect()->route('coupon.index')->with('success', 'Coupon Added Successfully');
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
        return view('backend.vendor.coupon.edit', [
            'coupon' => Coupon::findorfail($id),
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
            'coupon_name' => ['required', 'string', 'unique:coupons,coupon_name,'.$id],
            'discount' => ['required', 'integer', 'min:1', 'max:99'],
            'coupon_limit' => ['nullable', 'integer', 'min:1'],
            'coupon_expire_date' => ['date', 'required', 'after:tomorrow', ]
        ]);

        $coupon = Coupon::findorfail($id);
        $coupon->vendor_id = auth('vendor')->id();
        $coupon->coupon_name = $request->coupon_name;
        $coupon->discount = $request->discount;
        $coupon->expire_date = $request->coupon_expire_date;
        $coupon->user_limit = $request->coupon_limit;
        $coupon->save();

        return redirect()->route('coupon.index')->with('success', 'Coupon Edited Successfully');

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
