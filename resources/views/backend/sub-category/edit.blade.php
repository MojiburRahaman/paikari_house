@extends('backend.master')
@section('title')
    Edit SubCategory
@endsection
@section('content')
    <div class="row">
        <h3>Add Category</h3>
        <div class="col-12">
            <form action="{{ route('subcategory.update',$subcatagory->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group mt-4">
                    <label for="category_id">Category</label>
                    <select name="category_id" id="category_id"
                        class="form-control @error('category_id') is-invalid @enderror">
                        <option>Select One </option>
                        @forelse ($catagories as $item)
                            <option {{($item->id == $subcatagory->category_id)? 'selected' :  ''}} value="{{ $item->id }}">{{ $item->title }}</option>
                        @empty
                        @endforelse
                    </select>
                    @error('category_id')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group mt-4">
                    <label for="">Title</label>
                    <input required name="title" type="text" placeholder="Category Name" autocomplete="none"
                        class="form-control @error('title') is-invalid @enderror" value="{{$subcatagory->title}}">
                    @error('title')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group mt-4">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
