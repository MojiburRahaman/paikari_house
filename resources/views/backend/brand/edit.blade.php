@extends('backend.master')
@section('title')
    Edit Brand
@endsection
@section('content')
    <div class="row">
        <h3>Add Brand</h3>
        <div class="col-12">
            <form action="{{ route('brand.update', $brand->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group mt-4">
                    <input value="{{ $brand->title }}" required name="title" type="text" placeholder="Brand Name"
                        autocomplete="none" class="form-control @error('title') is-invalid @enderror">
                    @error('title')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div>
                    <div class="row mt-4">

                        <div class="col-lg-6">

                            <div class="form-group mt-4">
                                <input
                                    onchange="document.getElementById('image_id').src = window.URL.createObjectURL(this.files[0])"
                                    name="thumbnail" type="file" autocomplete="none"
                                    class="form-control @error('thumbnail') is-invalid @enderror">
                                @error('thumbnail')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                @else
                                    <span class="text-danger">*Only JPG And PNG Format Allow</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <label for="image_id">*Thumbnail Preview</label>
                            <img src="{{asset('brand_img/' . $brand->thumbnail)}}" id="image_id" width="150" height="150" />
                        </div>
                    </div>
                </div>
        </div>
        <div class="form-group mt-4">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        </form>
    </div>
    </div>
@endsection
