@extends('backend.vendor.master')
@section('title')
    Edit Product
@endsection
@section('content')
    <div class="row">
        <h3>Edit Product</h3>
        @if (session('warning'))
        <div class="alert alert-warning mt-4 mb-4" role="alert">
            {{ session('warning') }}
        </div>
    @endif
        <div class="col-12">
            <form action="{{ route('product.update',$product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group mt-4">
                    <label for="title">Title</label>
                    <input id="title" required name="title" type="text" placeholder="Title" autocomplete="none"
                        value="{{ $product->title }}" class="form-control @error('title') is-invalid @enderror">
                    @error('title')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group mt-4">
                    <label for="meta_description">Meta Description</label>
                    <input id="meta_description" required name="meta_description" type="text"
                        value=" {{ $product->meta_description }}" placeholder="Meta Description" autocomplete="none"
                        class="form-control @error('meta_description') is-invalid @enderror">
                    @error('meta_description')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group mt-4">
                    <label for="meta_keyword">Meta Keyword</label>
                    <input required id="meta_keyword" name="meta_keyword" type="text" placeholder="Meta Keyword"
                        value="{{ $product->meta_description }}" autocomplete="none"
                        class="form-control @error('meta_keyword') is-invalid @enderror">
                    @error('meta_keyword')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group mt-4">
                    <label for="category_id">Category</label>
                    <select name="category_id" id="category_id"
                        class="form-control @error('category_id') is-invalid @enderror">
                        <option>Select One </option>
                        @forelse ($categories as $item)
                            <option {{ $product->category_id == $item->id ? 'selected' : '' }}
                                value="{{ $item->id }}">
                                {{ $item->title }}</option>
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
                    <label for="subcatagory_id">Sub Category</label>
                    <select name="subcatagory_id" id="subcatagory_id"
                        class="form-control @error('subcatagory_id') is-invalid @enderror">
                        @forelse ($SubCategories as $item)
                            <option {{ $product->subcatagory_id == $item->id ? 'selected' : '' }}
                                value="{{ $item->id }}">
                                {{ $item->title }}</option>
                        @empty
                        @endforelse

                    </select>
                    @error('subcatagory_id')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="row mb-4 mt-4">
                    <div class="col-lg-6 mb-4 mt-4">
                        <div class="form-group mt-4">
                            <label for="thumbnail">Product Thumbnail</label>
                            <input id="thumbnail"  name="thumbnail" type="file" autocomplete="none"
                                onchange="document.getElementById('image_id').src = window.URL.createObjectURL(this.files[0])"
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
                    <div class="col-lg-6 mb-4 mt-4">
                        <label for="image_id">*Thumbnail Preview</label>
                        <img id="image_id" width="150" height="150"
                            src="{{ asset('thumbnail_img/' . $product->thumbnail_img) }}" />
                    </div>
                </div>

                <div class="form-group mt-4">
                    <label for="product_new_image">Product Images</label>
                    <input id="product_new_image" multiple name="product_new_image[]" type="file" autocomplete="none"
                        class="form-control @error('product_image') is-invalid @enderror">
                    @error('product_new_image')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                @forelse ($product->Gallery as $gallery)
                <input type="hidden" name="gallery_id[]" value="{{$gallery->id}}">
                    <div class="row mb-4 mt-4">
                        <div class="col-lg-6 mb-4 mt-4">
                            <div class="form-group mt-4">
                                <label for="thumbnail">Product Images {{ $loop->index + 1 }}</label>
                                <input id="thumbnail" name="product_image[]" type="file" autocomplete="none"
                                    onchange="document.getElementById('image_id').src = window.URL.createObjectURL(this.files[0])"
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
                        <div class="col-lg-6 mb-4 mt-4">

                            <label for="image_id">*Product Images Preview</label>
                            <img id="image_id" width="150" height="150"
                                src="{{ asset('product_image//' . $gallery->product_image) }}" />
                            <a href="{{route('GalleryRemove',$gallery->id)}}"
                                style="padding:4px;font-size: larger;text-decoration:none;color:red;margin-left:7px"
                                title="click to remove this" href="">
                                x</a>
                        </div>
                    </div>
                @empty
                @endforelse
                <div class="form-group mt-4">
                    <label for="brand_id">Brand</label>
                    <select name="brand_id" id="brand_id" class="form-control @error('brand_id') is-invalid @enderror">
                        <option>Select One </option>
                        @forelse ($Brands as $item)
                            <option {{($item->id == $product->brand_id) ? 'selected' : ''}} value="{{ $item->id }}">{{ $item->title }}</option>
                        @empty
                        @endforelse
                    </select>
                    @error('brand_id')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group mt-4">
                    <label for="">Product Summary</label>
                    <textarea required name="product_summary" type="text" placeholder="Meta Keyword" autocomplete="none"
                        class="form-control @error('product_summary') is-invalid @enderror"> {{ $product->product_summary }}</textarea>
                    @error('product_summary')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group mt-4">
                    <label for="summernote">Product Description</label>
                    <textarea id="summernote" required name="product_description" type="text" placeholder="Meta Description"
                        autocomplete="none" class="form-control @error('product_description') is-invalid @enderror"> {{  $product->product_description }}</textarea>
                    @error('product_description')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="row mt-4 mb-4">
                    <div class="col-lg-6 mb-4">
                        <label for="regular_price"> Price</label>
                        <input id="regular_price" required name="regular_price" type="numeric" placeholder="Price"
                            autocomplete="none" value="{{ $product->regular_price }}"
                            class="form-control @error('regular_price') is-invalid @enderror">
                        @error('regular_price')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-lg-6 mb-4">
                        <label for="disount">Discount</label>
                        <input id="disount"  name="discount" type="numeric" placeholder="Discount"
                            autocomplete="none" value="{{  $product->discount }}"
                            class="form-control @error('disount') is-invalid @enderror">
                        @error('disount')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group mt-4">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('script_js')
    <script>
        // ajax dropdown
        $('#category_id').change(function() {
            $catagory_id = $(this).val();
            if ($catagory_id) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('/admin/product/get-sub-cat/') }}/" + $catagory_id,
                    success: function(res) {
                        if (res) {
                            if (res == '') {
                                return;
                            }
                            $('#subcatagory_id').removeAttr('disabled');
                            $("#subcatagory_id").empty();
                            $("#subcatagory_id").append('<option value=>Select One</option>');
                            $.each(res, function(key, value) {
                                $("#subcatagory_id").append('<option value="' + value.id +
                                    '" >' +
                                    value.title + '</option>');
                            });
                        } else {
                            $("#subcatagory_id").empty();
                        }
                    }
                });
            } else {
                $("#subcatagory_id").empty();
            }
        });
    </script>
@endsection
