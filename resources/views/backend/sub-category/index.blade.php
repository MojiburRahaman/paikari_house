@extends('backend.master')

@section('title')
Sub-Category
@endsection

@section('content')
<div class="row">
  <h3>Sub-Category</h3>
  @if (session('success'))
      
  <div class="alert alert-success" role="alert">
   {{session('success')}}
  </div>
  @endif
  @if (session('warning'))
      
  <div class="alert alert-warning" role="alert">
   {{session('warning')}}
  </div>
  @endif
  @if (session('danger'))
      
  <div class="alert alert-danger" role="alert">
   {{session('danger')}}
  </div>
  @endif
    <div class="col-12">

        <div>
            <a href="{{route('subcategory.create')}}" class="btn-sm btn-success text-right" style="float: right;">Add Sub-Category</a>
        </div>
        <table class="table table-hover text-nowrap">
            <thead>
              <tr>
                <th >#</th>
                <th >Title</th>
                <th >Action</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($subcategoreis as $item)
                  
              <tr>
                <td>{{$loop->index+1}}</td>
                <td>{{$item->title}}</td>
                <td>
                  <a href="{{route('subcategory.edit',$item->id)}}" class="btn-sm btn-success " >Edit </a>
                  {{-- &nbsp; --}}
                  <br>
                  <form action="{{route('subcategory.destroy',$item->id)}}" method="POST">
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
            {{$subcategoreis->links()}}
          </div>
    </div>
    </div>
@endsection

