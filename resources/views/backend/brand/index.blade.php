@extends('backend.master')

@section('title')
Brands
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
            <a href="{{route('brand.create')}}" class="btn-sm btn-success text-right" style="float: right;">Add Brands</a>
        </div>
        <table class="table table-hover text-nowrap">
            <thead>
              <tr>
                <th >#</th>
                <th >Title</th>
                <th >Thumnail</th>
                <th >Action</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($brands as $item)
                  
              <tr>
                <td>{{$loop->index+1}}</td>
                <td>{{$item->title}}</td>
                <td><img width="40px" src="{{asset('brand_img/' . $item->thumbnail)}}" alt="{{$item->title}}"></td>
                <td>
                  <a href="{{route('brand.edit',$item->id)}}" class="btn-sm btn-success " >Edit </a>
                  {{-- &nbsp; --}}
                  <br>
                  <form action="{{route('brand.destroy',$item->id)}}" method="POST">
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
            {{$brands->links()}}
          </div>
    </div>
    </div>
@endsection

