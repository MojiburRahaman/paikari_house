@extends('backend.vendor.master')
@section('title','Access Denied')
@section('content')


<div class="row mb-5">
    <div class="col-md-3 m-auto">
        <figure>
            <img class="w-100" src="{{asset('backend/assets/images/svg/access-denied.svg') }}" alt="image">
        </figure>
    </div>
</div>
<div class="row text-center">

    <div class="display-6">Access Denied</div>
    <p class="text-muted my-4">You have been denied access to this page. Please wait for your seller account approved.
    </p>
    <div class="d-flex gap-3 justify-content-center">
        <a href="{{ route('FrontendView') }}" class="btn btn-primary">Home Page</a>
        <a onclick="event.preventDefault();document.getElementById('from_logout').submit()" href="#"
            class="btn bg-white">Log Out</a>
    </div>
</div>


@endsection

@section('css')
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endsection

@section('script_js')
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    @if (session()->get('denied'))
        
    Command: toastr["error"]('{{ session()->get('denied') }}');
    @endif
</script>
@endsection