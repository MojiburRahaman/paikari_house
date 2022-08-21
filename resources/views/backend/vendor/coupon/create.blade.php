@extends('backend.vendor.master')

@section('content')
<div class="row">
    <h3>Create Coupons</h3>
    <div class="col-12">
        <form action="{{route('coupon.store')}}" method="POST">
            @csrf
            <div class="form-group mb-4">
                <label for="color_name">Coupon Name</label>
                <input id="coupon_name" name="coupon_name" type="text" placeholder="Coupon Name" autocomplete="none"
                    autofocus class="form-control @error('coupon_name') is-invalid                                
                    @enderror">
                @error('coupon_name')
                <div class="alert alert-danger">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="form-group  mb-4">
                <label for="discount">Coupon Amount(%)</label>
                <input id="discount" required min="1" max="99" name="discount" type="number"
                    placeholder="Coupon Amount" autocomplete="none" class="form-control @error('discount') is-invalid                                
                    @enderror">
                @error('discount')
                <div class="alert alert-danger">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="form-group mb-4">
                <label for="coupon_limit">Coupon Limit User</label>
                <input id="coupon_limit" name="coupon_limit" type="number" placeholder="Coupon Limit"
                    autocomplete="none" class="form-control @error('coupon_limit') is-invalid                                
                    @enderror">
                @error('coupon_limit')
                <div class="alert alert-danger">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="form-group mb-4">
                <label for="coupon_expire_date">Coupon Expire Date</label>
                <input id="coupon_expire_date" name="coupon_expire_date" type="date" autocomplete="none" class="form-control @error('coupon_limit') is-invalid                                
                    @enderror">
                @error('coupon_expire_date')
                <div class="alert alert-danger">
                    {{$message}}
                </div>
                @enderror
            </div>

            <div class="form-group mb-4">
                <button type="submit" class="btn btn-success">Submit</button>
            </div>
        </form>
    </div>
</div>
@endsection