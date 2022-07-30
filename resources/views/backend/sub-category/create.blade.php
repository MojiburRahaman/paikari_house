@extends('backend.master')
@section('title')
    Add SubCategory
@endsection
@section('content')
    <div class="row">
        <h3>Add Category</h3>
        <div class="col-12">
            <form action="{{ route('subcategory.store') }}" method="POST">
                @csrf
                <div class="form-group mt-4">
                    <label for="category_id">Category</label>
                    <select name="category_id" id="category_id"
                        class="form-control @error('category_id') is-invalid @enderror">
                        <option>Select One </option>
                        @forelse ($categories as $item)
                            <option value="{{ $item->id }}">{{ $item->title }}</option>
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
                    <input required name="title" type="text" placeholder="Sub Category Name" autocomplete="none"
                        class="form-control @error('title') is-invalid @enderror">
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
