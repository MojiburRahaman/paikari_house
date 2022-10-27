@extends('backend.vendor.master')

@section('content')
<h1>Dashboard</h1>
<div class="row row-cols-1 row-cols-md-3 g-4">

    <div class="col-12 col-lg-3">
        <div class="card h-100">
            <div class="card-body">
                <div class="d-flex mb-3">
                    <div class="display-7">
                        <i class="bi bi-basket"></i>
                    </div>
                </div>
                <h4 class="mb-3">Total Orders</h4>
                <div class="d-flex mb-3" style="position: relative;">
                    <div class="display-7"> {{ $order->count() }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-3">
        <div class="card h-100">
            <div class="card-body">
                <div class="d-flex mb-3">
                    <div class="display-7">
                        <i class="bi bi-credit-card-2-front text-success"></i>
                    </div>
                </div>
                <h4 class="mb-3">Sales</h4>
                <div class="d-flex mb-3" style="position: relative;">
                    <div class="display-7">$ {{ $order->where('delivery_status',3)->sum('total_price') -
                        $order->where('delivery_status',3)->sum('discount_amount') }} </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-6">

        <div class="card border-0">
            <div class="card-body text-center">
                <div class="display-5">
                    <i class="bi bi-truck text-warning"></i>
                </div>
                <h5 class="my-3">Pending</h5>
                <div class="text-muted">{{ $order->where('delivery_status',1)->count() }} New Packages</div>

            </div>
        </div>

    </div>
    <div class="col-lg-3 col-6">

        <div class="card border-0">
            <div class="card-body text-center">
                <div class="display-5">
                    <i class="bi bi-truck text-secondary"></i>
                </div>
                <h5 class="my-3">Delivered</h5>
                <div class="text-muted">{{ $order->where('delivery_status',3)->count() }} New Packages</div>

            </div>
        </div>

    </div>
</div>

@endsection