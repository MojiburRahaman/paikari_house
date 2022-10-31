@extends('frontend.master')
@section('title','Compare')
@section('content')
<section class="pt-4 mb-4">
    <div class="container text-center">
        <div class="row">
            <div class="col-lg-6 text-center text-lg-left">
                <h1 class="fw-600 h4">Compare</h1>
            </div>
            <div class="col-lg-6">
                <ul class="breadcrumb bg-transparent p-0 justify-content-center justify-content-lg-end">
                    <li class="breadcrumb-item opacity-50">
                        <a class="text-reset" href="{{ route('FrontendView') }}">Home</a>
                    </li>
                    <li class="text-dark fw-600 breadcrumb-item">
                        <a class="text-reset" href="{{ route('CompareView') }}">"Compare"</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="mb-4">
    <div class="container text-left">
        <div class="bg-white shadow-sm rounded">
            <div class="p-3 border-bottom d-flex justify-content-between align-items-center">
                <div class="fs-15 fw-600">Comparison</div>
                <a href="{{ route('CompareReset') }}" style="text-decoration: none;" class="btn btn-soft-primary btn-sm fw-600">Reset
                    Compare List</a>
            </div>
            @if ($compares->count() == 0)

            <div class="text-center p-4">
                <p class="fs-17">Your comparison list is empty</p>
            </div>
            @else
            <table class="table table-responsive table-bordered mb-0">

                <thead>
                    <tr>
                        <th scope="col" class="font-weight-bold text-center">
                            Name
                        </th>
                        @foreach ($compares as $compare)
                        <th scope="col" class="font-weight-bold">
                            {{ $compare->Product->title }}
                        </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">Image</th>
                        @foreach ($compares as $compare)
                        <td>
                            <img loading="lazy" src="{{ asset('thumbnail_img/'.$compare->Product->thumbnail_img) }}"
                                alt="{{ $compare->Product->title }}" class="img-fluid py-4">
                        </td>
                        @endforeach
                    </tr>
                    <tr>
                        <th scope="row">Price</th>
                        @foreach ($compares as $compare)
                        <td>
                            @if ($compare->Product->discount != '')
                            <del class="fw-600 opacity-50 mr-1">৳{{$compare->Product->regular_price}}</del>
                            <span class="fw-700 text-primary">৳{{$compare->Product->sale_price}}</span>
                            @else
                            <span class="fw-700 text-primary">৳{{$compare->Product->regular_price}}</span>

                            @endif
                        </td>
                        @endforeach
                    </tr>
                    <tr>
                        <th scope="row">Brand</th>
                        @foreach ($compares as $compare)
                        <td>
                            {{ $compare->Product->Brand->title }}
                        </td>
                        @endforeach
                    </tr>
                    <tr>
                        <th scope="row">Category</th>
                        @foreach ($compares as $compare)
                        <td>
                            {{ $compare->Product->Category->title }}
                        </td>
                        @endforeach
                    </tr>
                    <tr>
                        <th scope="row"></th>
                        @foreach ($compares as $compare)
                        <td class="text-center py-4">
                            <button type="button" class="btn btn-primary fw-600"
                                onclick="showAddToCartModal({{ $compare->product_id }})">
                                Add to cart
                            </button>
                        </td>
                        @endforeach
                    </tr>
                </tbody>

            </table>
            @endif


        </div>
    </div>
</section>
@endsection