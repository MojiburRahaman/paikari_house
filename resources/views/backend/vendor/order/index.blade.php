@extends('backend.vendor.master')
@section('title')
    Order
@endsection
@section('content')
    <div class="row" id="products">
        <h3>Orders</h3>
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

            <div class="mb-4">
                <a href="{{ route('product.create') }}" id="add_product_btn" class="btn-sm btn-primary btn-icon"
                    style="float: right;">Add Product</a>
            </div>
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
                                @if ($Order->status == 1)
                                    <a href="" class="btn-sm btn-success">Active</a>
                                @else
                                    <a href="" class="btn-sm btn-danger">Inactive</a>
                                @endif
                            </td>

                            <td>
                                <a href="{{ route('order.edit', $Order->id) }}" class="btn-sm btn-success ">Edit </a>
                              <br>
                                <br>
                                <form action="{{ route('order.destroy', $Order->id) }}" method="POST">
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
