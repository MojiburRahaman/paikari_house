@extends('backend.master')
@section('title')
Add Category
@endsection
@section('content')
<div class="row">
    <h3>Add Category</h3>
    <div class="col-12">
        <form action="{{route('category.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group mt-4">
                <label class="mb-2 pl-2" for="title">Title</label>
                <input spellcheck="true" required name="title" id="title" type="text" placeholder="Category Name"
                    autocomplete="none" class="form-control @error('title') is-invalid                                
                    @enderror">
                @error('title')
                <div class="alert alert-danger">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="form-group mt-4">
                <label class="mb-2 pl-2" for="title">Thumbnail</label>
                <input required name="thumbnail" type="file" autocomplete="none" class="form-control @error('thumbnail') is-invalid                                
                    @enderror">
                @error('thumbnail')
                <div class="alert alert-danger">
                    {{$message}}
                </div>
                @else
                <span class="text-danger">*Only JPG And PNG Format Allow</span>
                @enderror
            </div>
            <div class="form-group mt-4">
                <label class="mb-2 pl-2" for="title">Discount Banner</label>
                <input  name="discount_thumbnail" type="file" autocomplete="none" class="form-control @error('dicount_thumbnail') is-invalid                                
                    @enderror">
                @error('dicount_thumbnail')
                <div class="alert alert-danger">
                    {{$message}}
                </div>
                @else
                <span class="text-danger">*Only JPG And PNG Format Allow</span>
                @enderror
            </div>
            <div class="form-group mt-4">
                <label class="mb-2 pl-2" for="title">Banner</label>
                <input multiple required name="banner[]" type="file" autocomplete="none" class="form-control @error('banner[]') is-invalid                                
                    @enderror">
                @error('banner[]')
                <div class="alert alert-danger">
                    {{$message}}
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