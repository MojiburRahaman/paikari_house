@extends('frontend.profile.dashboard')
@section('profile')
<div class="aiz-user-panel">
    <div class="aiz-titlebar mt-2 mb-4">
        <div class="row align-items-center">
            <div class="col-md-6">
                <b class="h4">Order No : {{ $order->order_number }}</b>
                <br>
                <small>Order date : {{ $order->created_at->format('d/m/y') }}</small>
            </div>
        </div>
    </div>
    <div class="card">

        <table class="table table-borderless">
            <tbody>
                @foreach ($order->Order as $orderList)

                <tr>
                    <td>
                        <div class="d-flex mb-2">
                            <div class="flex-shrink-0">
                                <img src="{{(asset('thumbnail_img/'.$orderList->Product->thumbnail_img))}}" alt=""
                                    width="70" class="img-fluid" alt="{{$orderList->Product->title}}">
                            </div>
                            <div class="flex-lg-grow-1 ms-3">
                                <h6><a href="#" class="text-reset">{{$orderList->Product->title}}</a></h6>
                                <p>
                                    ${{ $orderList->price }} x {{ $orderList->quantity }}
                                </p>
                            </div>
                        </div>
                    </td>
                    <td></td>
                    <td class="text-end">
                        @if ($orderList->delivery_status == 1 )
                            
                        <a href="" class=" bg-primary text-light rounded">Processing..</a>
                        @elseif ($orderList->delivery_status == 2)
                        <a href="" class=" bg-warning text-dark rounded">On the way >>></a>
                        @else
                        <a href="" class=" bg-primary text-light rounded">Deliverd ></a>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2">Subtotal</td>
                    <td class="text-end">${{ $order->total }}</td>
                </tr>
                <tr>
                    <td colspan="2">Shipping</td>
                    <td class="text-end">${{ $order->shipping }}</td>
                </tr>
                <tr>
                    <td colspan="2">Discount {{ ($order->coupon_name != '')? '(Code: '.$order->coupon_name.')' : ''  }} </td>
                    <td class="text-danger text-end">-${{ $order->discount ?? 0 }}</td>
                </tr>
                <tr class="fw-bold">
                    <td colspan="2">TOTAL</td>
                    <td class="text-end">${{ $order->subtotal }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection