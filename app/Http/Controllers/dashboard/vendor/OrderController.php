<?php

namespace App\Http\Controllers\dashboard\vendor;

use App\Http\Controllers\Controller;
use App\Models\BillingDetail;
use App\Models\Invoice;
use App\Models\OrderTable;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $order = Invoice::where('vendor_id', auth('vendor')->id())->get();
        return view('backend.vendor.order.index', [
            'Orders' => $order,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $invoice = Invoice::findorfail($id);
        $order =  OrderTable::where([
            'vendor_id' => auth('vendor')->id(),
            'order_number' => $invoice->order_number,
        ])->with('Product')->get();
        
        $billing_details = BillingDetail::where('order_number', $invoice->order_number)->first();

        return view('backend.vendor.order.show', [
            'invoice' => $invoice,
            'orders' => $order,
            'billing_details' => $billing_details,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
