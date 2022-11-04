@extends('frontend.profile.dashboard')
@section('title','Purchase History')
@section('profile')
<div class="aiz-user-panel">

  <div class="aiz-titlebar mt-2 mb-4">
    <div class="row align-items-center">
      <div class="col-md-6">
        <b class="h4">Purchsase</b>
      </div>
    </div>
  </div>

  <div class="row gutters-5">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Order No</th>
          <th scope="col">Total Product</th>
          <th scope="col">Amount</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($orders as $order)
        <tr>
          <th scope="row">{{ $loop->index+1 }}</th>
          <td>{{ $order->order_number }}</td>
          <td>{{ $order->order_count }}</td>
          <td>{{ $order->subtotal }}</td>
          <td>
            <a href="{{Illuminate\Support\Facades\URL::signedRoute('UserOrderDetails',$order->id)}}"
              class="btn-sm"><i class="fa fa-eye"></i></a>
          </td>
        </tr>
        @empty

        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection