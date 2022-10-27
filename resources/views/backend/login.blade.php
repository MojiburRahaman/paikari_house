<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login - Vetra | E-Commerce HTML Admin Dashboard Template</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('backend/assets/images/favicon.png') }}" />

    <!-- Themify icons -->
    <link rel="stylesheet" href="{{ asset('backend/dist/icons/themify-icons/themify-icons.css') }}" type="text/css">

    <!-- Main style file -->
    <link rel="stylesheet" href="{{ asset('backend/dist/css/app.min.css') }}" type="text/css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>

<body class="auth">

    <!-- begin::preloader-->
    <div class="preloader">
        <div class="preloader-icon"></div>
    </div>
    <!-- end::preloader -->


    <div class="form-wrapper">
        <div class="container">
            <div class="card">
                <div class="row g-0">
                    <div class="col">
                        <div class="row">
                            <div class="col-md-6 col-12 m-auto">
                                <div class="d-block d-lg-none text-center text-lg-start">
                                    <img width="120" src="../../assets/images/logo.svg" alt="logo">
                                </div>
                                <div class="my-5 text-center text-lg-start">
                                    <h1 class="display-8">Sign In</h1>
                                    <p class="text-muted">Sign in to Vetra to continue</p>
                                </div>
                                <form class="mb-5" id="signup" method="POST" action="{{ route('AdminloginPost') }}">
                                    @csrf
                                    <div class="mb-3">
                                        <input autofocus type="email" name="email" class="form-control"
                                            placeholder="Enter email" autofocus required>
                                        <span class="text-danger email_err"></span>
                                    </div>
                                    <div class="mb-3">
                                        <input type="password" name="password" class="form-control"
                                            placeholder="Enter password" required>
                                        <span class="text-danger pass_err"></span>
                                    </div>
                                    <div class="text-center text-lg-start">
                                        <button class="btn btn-primary">Sign In</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Bundle scripts -->
    <script src="{{ asset('backend/libs/bundle.js') }}"></script>

    <!-- Main Javascript file -->
    <script src="{{ asset('backend/dist/js/app.min.js') }}"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        jQuery(document).ready(function($) {
        $("#signup").submit(function(e) {
            $('.name_err').text('');
          $('.email_err').text('');
          $('.pass_err').text('');  
    e.preventDefault(); // avoid to execute the actual submit of the form.
    var form = $(this);
    var actionUrl = form.attr('action');
    $.ajax({
    type: "POST",
    url: actionUrl,
    data: form.serialize(), // serializes the form's elements.
    success: function(data)
    {
        Command: toastr["success"](data.success);
       
       
        setTimeout(function() {
        window.location.href ='{{ route("DashboardView") }}';
        }, 5000);

    },
    error:function (response) {
        //   $('.user_name').text(response.responseJSON.errors.user_name);
        //   $('.name_err').text(response.responseJSON.errors.name);
        if (response.responseJSON.error) {
            Command: toastr["error"](response.responseJSON.error);
        }
        $('.email_err').text(response.responseJSON.errors.email);
        $('.pass_err').text(response.responseJSON.errors.password);   
        //   alert(response.responseJSON);
        }
});
});
    });
    </script>

</body>

</html>