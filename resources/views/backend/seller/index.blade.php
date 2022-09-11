@extends('backend.master')

@section('content')


<div class="mb-4">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('DashboardView') }}">
                    <i class="bi bi-globe2 small me-2"></i> Dashboard
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Sellers</li>
        </ol>
    </nav>
</div>
<div class="row ">
    <div class="col-12 text-right">
        <a href="" class="btn btn-primary">Add Seller</a>
    </div>
</div>
<div class="table-responsive" style="overflow: hidden; outline: currentcolor none medium;" tabindex="1">
    <table class="table table-custom table-lg mb-0" id="orders">
        <thead>
            <tr>
                {{-- <th>
                    <input class="form-check-input select-all" type="checkbox" data-select-all-target="#orders"
                        id="defaultCheck1">
                </th> --}}
                <th>SL</th>
                <th>Name</th>
                <th>Total Product</th>
                <th>Status</th>
                <th class="text-end">Actions</th>
            </tr>
        </thead>
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
        <tbody>
            @forelse ($sellers as $seller)

            <tr>
                {{-- <td>
                    <input class="form-check-input" type="checkbox">
                </td> --}}
                <td>
                    <a href="#">{{ $loop->index+1 }}</a>
                </td>
                <td>{{ $seller->name }}</td>
                <td>{{ $seller->Product->count() }}</td>
                <td>
                    {{-- <span class="badge bg-primary">Processing</span> --}}
                    @if($seller->status == 1)
                    <label class="switch" id="inactiveslide{{ $seller->id }}">
                        <input data-id={{ $seller->id }} type="checkbox" class="check_slider" >
                        <span class="slider round "></span>
                    </label>

                    @elseif($seller->status == 2)

                    <label class="switch" id="activeslide{{ $seller->id }}">
                        <input data-id={{ $seller->id }} type="checkbox" class="check_slider" checked>
                        <span class="slider round "></span>
                    </label>
                    @endif
                </td>
                <td class="text-end">
                    <div class="d-flex">
                        <div class="dropdown ms-auto">
                            <a href="#" data-bs-toggle="dropdown" class="btn btn-floating" aria-haspopup="true"
                                aria-expanded="false">
                                <i class="bi bi-three-dots"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" style="margin: 0px;">
                                <a href="#" class="dropdown-item">Show</a>
                                <a href="#" class="dropdown-item">Edit</a>
                                <a href="#" class="dropdown-item">Delete</a>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>

            @empty
            <td colspan="10" class="text-center">No Seller</td>
            @endforelse
        </tbody>
    </table>
</div>

<nav class="mt-4" aria-label="Page navigation example">
    {{ $sellers->links() }}
    {{-- <ul class="pagination justify-content-center">
        <li class="page-item">
            <a class="page-link" href="#" aria-label="Previous">
                <span aria-hidden="true">«</span>
            </a>
        </li>
        <li class="page-item active"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item">
            <a class="page-link" href="#" aria-label="Next">
                <span aria-hidden="true">»</span>
            </a>
        </li>
    </ul> --}}
</nav>


@endsection
@section('css')
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endsection

@section('script_js')
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    $('.check_slider').click(function() {
    var checked = $(this).is(':checked');
    const id = $(this).attr('data-id');
    $.ajax({
        type: "POST",
        url: "{{ route('SellerStatus') }}",
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