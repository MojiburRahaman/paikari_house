@extends('frontend.master')

@section('content')
<section class="gry-bg py-5">
    <div class="profile">
        <div class="container">
            <div class="row">
                <div class="col-xxl-4 col-xl-5 col-lg-6 col-md-8 mx-auto">
                    <div class="card">
                        <div class="text-center pt-4">
                            <h1 class="h4 fw-600">
                                Login to your account.
                                @if (session('warning'))
                                <div class="alert alert-success"></div>
                                    {{ session('warning') }}
                                @endif
                            </h1>
                        </div>

                        <div class="px-4 py-3 py-lg-4">
                            <div class="">
                                <form class="form-default" role="form" action="{{route('login')}}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <input type="email" class="form-control" value="" placeholder="Email"
                                            name="email" id="email" autocomplete="off">
                                    </div>

                                    <div class="form-group">
                                        <input type="password" class="form-control " placeholder="Password"
                                            name="password" id="password">
                                    </div>

                                    <div class="row mb-2">
                                        <div class="col-6">
                                            <label class="aiz-checkbox">
                                                <input type="checkbox" name="remember">
                                                <span class=opacity-60>Remember Me</span>
                                                <span class="aiz-square-check"></span>
                                            </label>
                                        </div>
                                        <div class="col-6 text-right">
                                            <a href="../password/reset.html" class="text-reset opacity-60 fs-14">Forgot
                                                password?</a>
                                        </div>
                                    </div>

                                    <div class="mb-5">
                                        <button type="submit" class="btn btn-primary btn-block fw-600">Login</button>
                                    </div>
                                </form>


                            </div>
                            <div class="text-center">
                                <p class="text-muted mb-0">Dont have an account?</p>
                                <a href="{{route('register')}}">Register Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection