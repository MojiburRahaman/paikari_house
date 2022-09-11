@extends('backend.vendor.master')
@section('title')
Order
@endsection
@section('content')
<div class="mb-4">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('VendorDashboardView') }}">
                    <i class="bi bi-globe2 small me-2"></i> Dashboard
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Orders</li>
        </ol>
    </nav>
</div>
<div class="row" id="products">
    {{-- <h3 class="mb-4">Orders</h3> --}}
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
    <table class="table table-hover text-nowrap mt-4" id="myTable">
        <thead>
            <tr>
                <th>#</th>
                <th>Order Number</th>
                <th>Total</th>
                <th class="text-center">Status</th>

                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($Orders as $Order)
            <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ $Order->order_number }}</td>
                <td>
                    {{ $Order->total_price }}

                </td>
                <td class="text-center">
                    @if ($Order->delivery_status == 1)
                    <a href="" class="badge bg-danger">pending</a>
                    @elseif($Order->status == 2)
                    <a href="" class="badge bg-primary">on the way</a>

                    @else
                    <a href="" class="badge bg-success">Inactive</a>
                    @endif
                </td>

                <td>
                    <a href="{{ route('order.show', $Order->id) }}" class="btn-sm btn-success "><i
                            class="bi bi-eye"></i> </a>&nbsp;
                    <a href="{{ route('order.edit', $Order->id) }}" class="btn-sm btn-info "><i
                            class="bi bi-download"></i> </a>

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
    {{-- <div class="text-left mt-4">
        {{ $products->links() }}
    </div> --}}
</div>
</div>
@endsection
@section('script_js')
<script>
    $(document).ready( function () {
    $('#myTable').DataTable();
} );
</script>
@endsection
@section('css')
@endsection