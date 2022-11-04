@extends('frontend.master')
@section('title', 'Track Order')

@section('content')
<style>
    .track {
        position: relative;
        background-color: #ddd;
        height: 7px;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        margin-bottom: 60px;
        margin-top: 50px
    }

    .track .step {
        -webkit-box-flex: 1;
        -ms-flex-positive: 1;
        flex-grow: 1;
        width: 25%;
        margin-top: -18px;
        text-align: center;
        position: relative
    }

    .track .step.active:before {
        background: #FF5722
    }

    .track .step::before {
        height: 7px;
        position: absolute;
        content: "";
        width: 100%;
        left: 0;
        top: 18px
    }

    .track .step.active .icon {
        background: #ee5435;
        color: #fff
    }

    .track .icon {
        display: inline-block;
        width: 40px;
        height: 40px;
        line-height: 40px;
        position: relative;
        border-radius: 100%;
        background: #ddd
    }

    .track .step.active .text {
        font-weight: 400;
        color: #000
    }

    .track .text {
        display: block;
        margin-top: 7px
    }

    .card {
        position: relative;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        -ms-flex-direction: column;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 1px solid rgba(0, 0, 0, 0.1);
        border-radius: 0.10rem
    }

    .card-header:first-child {
        border-radius: calc(0.37rem - 1px) calc(0.37rem - 1px) 0 0
    }

    .card-header {
        padding: 0.75rem 1.25rem;
        margin-bottom: 0;
        background-color: #fff;
        border-bottom: 1px solid rgba(0, 0, 0, 0.1)
    }

    .itemside {
        position: relative;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        width: 100%
    }

    .itemside .aside {
        position: relative;
        -ms-flex-negative: 0;
        flex-shrink: 0
    }

    .img-sm {
        width: 80px;
        height: 80px;
        padding: 7px
    }

    .itemside .info {
        padding-left: 15px;
        padding-right: 7px
    }

    .itemside .title {
        display: block;
        margin-bottom: 5px;
        color: #212529
    }

    .btn-warning {
        color: #ffffff;
        background-color: #ee5435;
        border-color: #ee5435;
        border-radius: 1px
    }

    .btn-warning:hover {
        color: #ffffff;
        background-color: #ff2b00;
        border-color: #ff2b00;
        border-radius: 1px
    }
</style>
<section class="pt-4 mb-4">
    <div class="container text-center">
        <div class="row">
            <div class="col-lg-6 text-center text-lg-left">
                <h1 class="fw-600 h4">Track Order</h1>
            </div>
            <div class="col-lg-6">
                <ul class="breadcrumb bg-transparent p-0 justify-content-center justify-content-lg-end">
                    <li class="breadcrumb-item opacity-50">
                        <a class="text-reset" href="{{ route('FrontendView') }}">Home</a>
                    </li>
                    <li class="text-dark fw-600 breadcrumb-item">
                        <a class="text-reset" href="track-your-order.html">"Track Order"</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>
<section class="mb-5">
    <div class="container text-left">
        <div class="row">
            <div class="col-xxl-5 col-xl-6 col-lg-8 mx-auto">
                <form class="" id="order-form" method="POST" enctype="multipart/form-data">
                    <div class="bg-white rounded shadow-sm">
                        <div class="fs-15 fw-600 p-3 border-bottom text-center">
                            Check Your Order Status
                        </div>
                        <div class="form-box-content p-3">
                            <div class="form-group">
                                <input type="number" id="order_number" class="form-control mb-3"
                                    placeholder="Order Number:" name="order_code" required>
                                    <span class="text-danger" id="errors"></span>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Track Order</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</section>
<section>
    <div class="container" id="data">
    </div>
</section>

@endsection
@section('script_js')
<script>
    $("#order-form").submit(function(e) {
        e.preventDefault(); 
    $('#preloader').show();
         var order_number = $('#order_number').val();
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                     }),
        $.ajax({
        url:'{{route("FrontendOrdeTrackPost")}}',
        type:'POST',
        data:{order_number: order_number},
    })
    .done(function(data){
        if(data.errors){
            $('#errors').show();
            $('#data').hide();
            $('#errors').html(data.errors);
        }
        if(data.html){
            $('#errors').hide();
            $('#data').show();
            $('#data').html(data.html);
        }else{
            return;
        }
        cache: false
    })
     .fail(function (xhr, status, error) {
    Swal.fire('Server Error');
});
    
 });
</script>


@endsection