<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>Password Recover</title>
    <meta content="Admin Dashboard" name="description" />
    <meta content="Themesbrand" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App Icons -->
    <link rel="shortcut icon" href="{{ asset('backend/assets/images/favicon.ico') }}">

    <!-- App css -->
    <link href="{{ asset('backend/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/assets/css/icons.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/assets/css/style.css') }}" rel="stylesheet" type="text/css">

</head>


<body>

    <!-- Loader -->
    <div id="preloader">
        <div id="status">
            <div class="spinner"></div>
        </div>
    </div>

    <!-- Begin page -->
    <div class="accountbg"></div>
    <div class="wrapper-page">

        <div class="card">
            <div class="card-body">
                <h3 class="text-center m-0">Admin Dashboard</h3>
                <h3 class="text-center m-0">
                    <a href="" class="logo logo-admin">
                        {{-- <img src="{{asset('backend/assets/images/logo_dark.png')}}" height="30"
                            alt="logo"> --}}
                            {{-- <h5>Quotation Builder</h5> --}}
                        </a>
                </h3>

                <div class="p-3">
                    <h4 class="text-muted font-18 m-b-5 text-center">Welcome Back !</h4>
                    <p class="text-muted text-center">Reset your password.</p>

                    @if ($errors->any())
                    <div  class=" mt-3">
                        <div class="font-medium text-red-600 text-danger">
                            {{ __('Whoops! Something went wrong.') }}
                        </div>

                        <ul class="mt-3 list-disc list-inside text-danger text-sm text-red-600">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (session()->has('error'))
                <div class="alert alert-danger text-center alert-solid alert-dismissible shadow-sm p-3 mt-5 rounded"
                    role="alert">
                    {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

                    <form class="form-horizontal m-t-30 loginForm" action="{{route('reset.password.post')}}" method="POST">@csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                        {{-- <div class="form-group">
                            <label for="username">Email</label>
                            <input type="text" name="email" class="form-control" id="username" placeholder="Enter username">
                        </div> --}}

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control" id="email" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label for="userpassword">Password</label>
                            <input type="password" name="password" class="form-control" id="userpassword" placeholder="Enter password">
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Password Confirmation</label>
                            <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="confirm password">
                        </div>


                        <div class="form-group row m-t-20">
                            <div class="col-sm-6 text-right">
                                <button class="btn btn-primary btn-block w-md waves-effect waves-light" type="submit">Reset Password</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>

        {{-- <div class="m-t-40 text-center">
            <p>Don't have an account ? <a href="pages-register.html"
                    class="font-500 font-14 text-primary font-secondary"> Signup Now </a> </p>
            <p>© 2018 Fonik. Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesbrand</p>
        </div> --}}

    </div>


    <!-- jQuery  -->
    <script src="{{ asset('backend/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/modernizr.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/jquery.slimscroll.js') }}"></script>
    <script src="{{ asset('backend/assets/js/waves.js') }}"></script>
    <script src="{{ asset('backend/assets/js/jquery.nicescroll.js') }}"></script>
    <script src="{{ asset('backend/assets/js/jquery.scrollTo.min.js') }}"></script>

    <!-- App js -->
    <script src="{{ asset('backend/assets/js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.js"></script>
    <script>
        $(document).ready(function() {
            $(".loginForm").validate({
                rules: {
                    // email: {
                    //     required: true,
                    //     email: true,
                    // },
                    password: {
                        required: true,
                        minlength: 6,
                        maxlength:20,
                    },
                    password_confirmation: {
                        equalTo: '[name="password"]'
                    },
                },
                messages: {
                    // email: {
                    //     required: 'Plese enter your email',
                    //     email: 'Email must be a valid email address',
                    // },
                    password: {
                        required: 'Plese enter your password',
                        minlength: 'Password must atleast 6 charecters long',
                    },
                }
            });
        });

    </script>

</body>

</html>
