@extends('backend.vendor.master')

@section('content')
<div class="row" id="products">
    <h3>Coupons</h3>
    @if (session('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
    @endif
    @if (session('warning'))
    <div class="alert alert-warning" role="alert">
        {{ session('warning') }}
    </div>
    @endif
    @if (session('danger'))
    <div class="alert alert-danger" role="alert">
        {{ session('danger') }}
    </div>
    @endif
    <div class="col-12">
        <a id="add_product_btn" href="{{ route('coupon.create') }}" class="btn-sm btn-primary btn-icon"
            style="float: right;">Add Coupons</a>
    </div>
    <table class="table table-hover text-nowrap mt-4">
        <thead>
            <tr>
                <th>SL</th>
                <th>Name</th>
                <th>User limit</th>
                <th>Expire Date</th>
                <th class="text-center">Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($Coupons as $item)
            <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ $item->coupon_name }}</td>
                <td>
                    {{$item->user_limit}}
                </td>
                <td>
                    {{$item->expire_date}}
                </td>
                <td class="text-center">
                    @if ($item->status == 1)
                    <a href="{{route('ProductStatus',$item->id)}}" class="btn-sm btn-success">Active</a>
                    @else
                    <a href="{{route('ProductStatus',$item->id)}}" class="btn-sm btn-danger">Inactive</a>
                    @endif
                </td>

                <td>
                    <a href="{{ route('coupon.edit', $item->id) }}" class="btn-sm btn-success ">Edit </a>
                    {{-- &nbsp; --}}
                    <br>
                    <form action="{{ route('coupon.destroy', $item->id) }}" method="POST">
                        @csrf
                        @method('delete')
                        <button class="btn-sm btn-danger" style="">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="10" class="text-center">
                    No data
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div class="text-left mt-4">
    </div>
</div>
</div>
@endsection
@section('script_js')
<script>
</script>

@endsection