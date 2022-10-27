@extends('backend.vendor.master')
@section('title')
Product
@endsection
@section('content')

<style>
    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
    }

    /* Hide default HTML checkbox */
    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    /* The slider */
    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked+.slider {
        background-color: #08fc00;
        /* background-color: #2196F3; */
    }

    input:focus+.slider {
        box-shadow: 0 0 1px #08fc00;
    }

    input:checked+.slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    /* Rounded sliders */
    /* .slider.round {
        border-radius: 34px;
    } */
    .slider.round {
        border-radius: 34px;
        background: red;
    }

    .slider.round:before {
        border-radius: 50%;
    }
</style>

<div class="row" id="products">
    <h3>Products</h3>
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
    <div class="col-12 table-responsive">

        <div class="mb-4">
            <a href="{{ route('product.create') }}" id="add_product_btn" class="btn-sm btn-primary btn-icon"
                style="float: right;">Add Product</a>
        </div>
        <table class="table  mt-4" id="myTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Thumbnail</th>
                    <th class="text-center">Feature</th>
                    <th class="text-center">Trending</th>
                    <th class="text-center">Status</th>

                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $item)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $item->title }}</td>
                    <td>
                        <img src="{{ asset('thumbnail_img/' . $item->thumbnail_img) }}" width="40px" alt="">
                    </td>
                    <td class="text-center">
                        @if($item->fetured == 1)
                        <label class="switch" id="inactiveslide{{ $item->id }}">
                            <input data-id={{ $item->id }} type="checkbox" class="feature">
                            <span class="slider round "></span>
                        </label>

                        @elseif($item->fetured == 0)

                        <label class="switch" id="activeslide{{ $item->id }}">
                            <input data-id={{ $item->id }} type="checkbox" class="feature" checked>
                            <span class="slider round "></span>
                        </label>
                        @endif
                    </td>
                    <td class="text-center">
                        @if($item->trending == 1)
                        <label class="switch" id="inactiveslide{{ $item->id }}">
                            <input data-id={{ $item->id }} type="checkbox" class="trending">
                            <span class="slider round "></span>
                        </label>

                        @elseif($item->trending == 0)

                        <label class="switch" id="activeslide{{ $item->id }}">
                            <input data-id={{ $item->id }} type="checkbox" class="trending" checked>
                            <span class="slider round "></span>
                        </label>
                        @endif
                    </td>
                    <td class="text-center">
                        @if($item->status == 2)
                        <label class="switch" id="inactiveslide{{ $item->id }}">
                            <input data-id={{ $item->id }} type="checkbox" class="check_slider">
                            <span class="slider round "></span>
                        </label>

                        @elseif($item->status == 1)

                        <label class="switch" id="activeslide{{ $item->id }}">
                            <input data-id={{ $item->id }} type="checkbox" class="check_slider" checked>
                            <span class="slider round "></span>
                        </label>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('product.edit', $item->id) }}" class="btn-sm btn-success "><i
                                class="bi bi-pen"></i> </a>
                        <br>
                        <br>
                        <form action="{{ route('product.destroy', $item->id) }}" method="POST">
                            @csrf
                            @method('delete')
                            <button class="btn-sm btn-danger" style=""><i class="bi bi-trash"></i></button>
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

@section('css')
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endsection
@section('script_js')

<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    $(document).ready( function () {
    $('#myTable').DataTable();
} );


$('.trending').click(function() {
    var checked = $(this).is(':checked');
    const id = $(this).attr('data-id');
    $.ajax({
        type: "POST",
        url: "{{ route('ProductTrending') }}",
        data: { id : id , _token: '{{ csrf_token() }}'},
        success: function(data) {
            if (data.active) {
             Command: toastr["success"](data.active);
            return ;
            }
            if (data.inactive) {
                Command: toastr["warning"](data.inactive);
                return ;
            }
            
        },
        error: function() {
            alert('it broke');
        }
    });
});

$('.feature').click(function() {
    var checked = $(this).is(':checked');
    const id = $(this).attr('data-id');
    $.ajax({
        type: "POST",
        url: "{{ route('ProductFeature') }}",
        data: { id : id , _token: '{{ csrf_token() }}'},
        success: function(data) {
            if (data.active) {
             Command: toastr["success"](data.active);
            return ;
            }
            if (data.inactive) {
                Command: toastr["warning"](data.inactive);
                return ;
            }
            
        },
        error: function() {
            alert('it broke');
        }
    });
});

$('.check_slider').click(function() {
    var checked = $(this).is(':checked');
    const id = $(this).attr('data-id');
    $.ajax({
        type: "POST",
        url: "{{ route('ProductStatus') }}",
        data: { id : id , _token: '{{ csrf_token() }}'},
        success: function(data) {
            if (data.active) {
             Command: toastr["success"](data.active);
            return ;
            }
            if (data.inactive) {
                Command: toastr["warning"](data.inactive);
                return ;
            }
            
        },
        error: function() {
            alert('it broke');
        }
    });
});
</script>



@endsection