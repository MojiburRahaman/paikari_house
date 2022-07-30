@extends('backend.master')

@section('title')
Category
@endsection

@section('content')
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
                <td>
                  <a href="{{route('category.edit',$item->id)}}" class="btn-sm btn-success " >Edit </a>
                  {{-- &nbsp; --}}
                  <br>
                  <form action="{{route('category.destroy',$item->id)}}" method="POST">
                    @csrf
                    @method('delete')
                    <button class="btn-sm btn-danger"  style="">Delete</button>
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
</script>
@endsection

