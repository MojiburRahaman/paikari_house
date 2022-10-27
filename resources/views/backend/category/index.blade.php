@extends('backend.master')

@section('title')
Category
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

<div class="row">
  <h3>Category</h3>
    <div class="col-12">

        <div>
            <a href="{{route('category.create')}}" class="btn-sm btn-success text-right" style="float: right;">Add Category</a>
        </div>
        <table class="table table-hover text-nowrap">
            <thead>
              <tr>
                <th >#</th>
                <th >Title</th>
                <th >Thumbnail</th>
                <th >Status</th>
                <th >Action</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($categoreis as $item)
                  
              <tr>
                <td>{{$loop->index+1}}</td>
                <td>{{$item->title}}</td>
                <td>
                  <img src="{{asset('category_images/'.$item->thumbnail)}}" width="40px" alt="">
                </td>
                <td >
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
                  <a href="{{route('category.edit',$item->id)}}" class="btn-sm btn-success " ><i class="bi bi-pen"></i> </a>
                  {{-- &nbsp; --}}
                  <br>
                  <br>

                  <form action="{{route('category.destroy',$item->id)}}" method="POST">
                    @csrf
                    @method('delete')
                    <button class="btn-sm btn-danger"  ><i class="bi bi-trash"></i></button>
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
            {{$categoreis->links()}}
          </div>
    </div>
    </div>
@endsection

@section('css')
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endsection
@section('script_js')
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
     @if (session('success'))
      
     toastr["success"](' {{session('success')}}');

      @endif
     @if (session('warning'))
      
     toastr["warning"](' {{session('warning')}}');

      @endif
     @if (session('danger'))
      
     toastr["danger"](' {{session('danger')}}');

      @endif


      $('.check_slider').click(function() {
    var checked = $(this).is(':checked');
    const id = $(this).attr('data-id');
    $.ajax({
        type: "POST",
        url: "{{ route('CategoryStatus') }}",
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

