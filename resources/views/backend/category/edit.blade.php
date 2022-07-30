@extends('backend.master')
@section('title')
Edit Category
@endsection
@section('content')
<div class="row">
    <h3>Edit Category</h3>
    <div class="col-12">
        <form action="{{route('category.update',$catagory->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group mt-4">
                <label class="mb-2" for="title">Title</label>

                <input spellcheck="true" id="title" required name="title" value="{{$catagory->title}}" type="text"
                    placeholder="Category Name" autocomplete="none" class="form-control @error('title') is-invalid                                
                    @enderror">
                @error('title')
                <div class="alert alert-danger">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="row mt-4 mb-4">
                <div class="col-6">
                    <div class="form-group mt-4">
                        <label class="mb-2" for="thumbnail">Thumbnail</label>
                        <input name="thumbnail" id="thumbnail" type="file" autocomplete="none" class="form-control @error('thumbnail') is-invalid                                
                            @enderror"
                            onchange="document.getElementById('image_id').src = window.URL.createObjectURL(this.files[0])">
                        @error('thumbnail')
                        <div class="alert alert-danger">
                            {{$message}}
                        </div>
                        @else
                        <span class="text-danger">*Only JPG And PNG Format Allow</span>
                        @enderror
                    </div>
                </div>
                <div class="col-6">
                    <label for=""><span class="text-danger">*</span>Preview Thumbnail</label>

                    <img id="image_id" width="200" height="200"
                        src="{{asset('category_images/' . $catagory->thumbnail)}}" />
                </div>
            </div>
            <div class="row mt-4 mb-4">
                <div class="col-6">
                    <div class="form-group mt-4">
                        <label class="mb-2" for="thumbnail">Discount Banner</label>
                        <input name="discount_thumbnail" id="thumbnail" type="file" autocomplete="none" class="form-control @error('thumbnail') is-invalid                                
                            @enderror"
                            onchange="document.getElementById('discount').src = window.URL.createObjectURL(this.files[0])">
                        @error('thumbnail')
                        <div class="alert alert-danger">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-6">
                    <label for=""><span class="text-danger">*</span>Preview Discount Image</label>
                    <img id="discount" width="200" height="200"
                        src="{{asset('category_images/discount/' . $catagory->discount_thumbnail)}}" />
                </div>
            </div>
            <div class="form-group mt-4 mb-5">
                <label class="mb-2" for="banner_new">Banner Image</label>

                <input id="banner_new"  name="banner_new" type="file" multiple
                    placeholder="Category Name" autocomplete="none" class="form-control @error('title') is-invalid                                
                    @enderror">
                @error('title')
                <div class="alert alert-danger">
                    {{$message}}
                </div>
                @enderror
            </div>


            @forelse ($catagory->CategoryBanner as $item)

            <div id="delete{{$item->id}}" class="row mt-4 mb-4">
                <div class="col-6">
                    <div class="form-group mt-4">
                        <input type="hidden" value="{{$item->id}}" name="banner_id[]">
                        <label class="mb-2" for="thumbnail"> Banner {{$loop->index+1}}</label>
                        <input name="banner[]" id="thumbnail" type="file" autocomplete="none" class="form-control @error('thumbnail') is-invalid                                
                                @enderror"
                            onchange="document.getElementById('banner{{$item->id}}').src = window.URL.createObjectURL(this.files[0])">
                        @error('thumbnail')
                        <div class="alert alert-danger">
                            {{$message}}
                        </div>
                        @else
                        <span class="text-danger">*Only JPG And PNG Format Allow</span>
                        @enderror
                    </div>
                </div>
                <div class="col-6">
                    <label class="mb-2" for=""><span class="text-danger">*</span>Preview Banner Image
                        {{$loop->index+1}} <a class="banner_remove" data-id="{{$item->id}}">X</a></label>
                    <img id="banner{{$item->id}}" width="400" height="200"
                        src="{{asset('category_images/banner/' . $item->banner)}}" />
                </div>
            </div>
            @empty

            @endforelse

            <div class="form-group mt-4">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{route('category.index')}}" class="btn btn-regular">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
@section('css')
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endsection
@section('script_js')
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    $(".banner_remove").click(function() {
        var ele = $(this);
            $id = $(this).attr('data-id');
                $.ajax({
                    type: "get",
                    url: "{{url('admin/category/banner/')}}/"+$id,
                   
                    success: function(res) {
                        if (res == '') {
                            toastr["success"]('Something Wrong');
                        } else {
                            $('#delete'+$id).remove();
                            toastr["success"](res);
                        }
                    }
                })
        });


</script>

@endsection