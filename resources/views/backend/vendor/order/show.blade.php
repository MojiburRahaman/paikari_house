@extends('backend.vendor.master')

@section('content')


<div class="mb-4">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('VendorDashboardView') }}">
                    <i class="bi bi-globe2 small me-2"></i> Dashboard
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Orders Details</li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col-lg-8 col-md-12">
        <div class="card mb-4">
            <div class="card-body">
                <div class="mb-5 d-flex align-items-center justify-content-between">
                    <span>Order No : <a href="#">#{{ $invoice->order_number }}</a></span>
                    <span class="badge bg-success">Completed</span>
                </div>
                <div class="row mb-5 g-4">
                    <div class="col-md-3 col-sm-6">
                        <p class="fw-bold">Order Created at</p>
                        {{ $invoice->created_at->format('d/m/Y') }} at {{ $invoice->created_at->format('h:t A') }}
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <p class="fw-bold">Name</p>
                        {{ $billing_details->billing_user_name }}
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <p class="fw-bold">Email</p>
                        {{ $billing_details->user_email }}
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <p class="fw-bold">Contact No</p>
                        {{ $billing_details->billing_number }}
                    </div>
                </div>
                <div class="row g-4">
                    <div class="col-md-12 col-sm-12">
                        <div class="card">
                            <div class="card-body d-flex flex-column gap-3">
                                <div class="d-flex justify-content-between">
                                    <h5 class="mb-0">Delivery Address</h5>
                                </div>
                                <div>Name: {{ $billing_details->billing_user_name }}</div>
                                <div>Location:
                                    <ul>
                                        <li>{{ $billing_details->Division->name }}</li>
                                        <li>{{ $billing_details->District->name }}</li>
                                    </ul>
                                </div>
                                <div>Address: {{ $billing_details->billing_address }}</div>
                                <div>
                                    <i class="bi bi-telephone me-2"></i> {{ $billing_details->billing_number }}
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-md-6 col-sm-12">
                        <div class="card">
                            <div class="card-body d-flex flex-column gap-3">
                                <div class="d-flex justify-content-between">
                                    <h5 class="mb-0">Billing Address</h5>
                                </div>
                                <div>Name: Workplace</div>
                                <div>Josephin Villa</div>
                                <div>29543 South Plaza, Canada/Sydney Mines</div>
                                <div>
                                    <i class="bi bi-telephone me-2"></i> 484-948-8535
                                </div>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
        <div class="card widget">
            <h5 class="card-header">Order Items</h5>
            <div class="card-body">
                <div class="table-responsive" style="overflow: hidden; outline: currentcolor none medium;" tabindex="1">
                    <table class="table table-custom mb-0">
                        <thead>
                            <tr>
                                <th>Photo</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                            <tr>
                                <td>
                                    <a href="#">
                                        <img src="{{ asset('thumbnail_img/'.$order->Product->thumbnail_img ) }}"
                                            class="rounded" alt="..." width="60">
                                    </a>
                                </td>
                                <td>{{ $order->Product->title }}</td>
                                <td>${{ $order->price }}</td>
                                <td>{{ $order->quantity }}</td>
                                <td>${{ $order->price * $order->quantity }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-12 mt-4 mt-lg-0">
        <div class="card mb-4">
            <div class="card-body">
                <h6 class="card-title mb-4">Price</h6>
                <div class="row justify-content-center mb-3">
                    <div class="col-6 text-end">Sub Total:</div>
                    <div class="col-4">${{ $invoice->total_price }}</div>
                </div>
                <div class="row justify-content-center mb-3">
                    <div class="col-6 text-end">Shipping:</div>
                    <div class="col-4">${{ 60 }}</div>
                </div>
                <div class="row justify-content-center mb-3">
                    <div class="col-6 text-end">Discount({{ $invoice->discount_percent . '%' }}) :</div>
                    <div class="col-4">${{ $invoice->discount_amount }}</div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-6 text-end">
                        <strong>Total :</strong>
                    </div>
                    <div class="col-4">
                        <strong>${{ $invoice->total_price + 60 - $invoice->discount_amount }}</strong>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h6 class="card-title mb-4">Invoice</h6>
                <div class="row justify-content-center mb-3">
                    <div class="col-6 text-end">Order No :</div>
                    <div class="col-6">
                        <a href="#">#{{ $invoice->order_number }}</a>
                    </div>
                </div>
                {{-- <div class="row justify-content-center mb-3">
                    <div class="col-6 text-end">Seller GST :</div>
                    <div class="col-6">12HY87072641Z0</div>
                </div>
                <div class="row justify-content-center mb-3">
                    <div class="col-6 text-end">Purchase GST :</div>
                    <div class="col-6">22HG9838964Z1</div>
                </div> --}}
                <div class="text-center mt-4">
                    <button class="btn btn-outline-primary">Download PDF</button>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection