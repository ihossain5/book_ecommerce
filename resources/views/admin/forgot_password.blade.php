<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>Admin Dashboard- Reset Password</title>
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

                <h3 class="text-center m-0">
                    Admin Dashboard
                    <!-- <a href="index.html" class="logo logo-admin"><img src="assets/images/logo_dark.png" height="30" alt="logo"></a> -->
                </h3>

                <div class="p-3">

                    <h4 class="text-muted font-18 mb-3 text-center">Reset Password Form</h4>
                    @if ($errors->any())
                    <div class=" mt-3">
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
                    {{-- <div class="alert alert-info" role="alert">
                        Enter your Email and instructions will be sent to you!
                    </div> --}}
                    @if (session()->has('success'))
                    <div class="alert alert-info text-center text-dark mt-3 alert-solid alert-dismissible shadow-sm p-3 mb-5 rounded"
                        role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                    <form class="form-horizontal reset_password m-t-30" action="{{ route('forget.password.post') }}" method="POST">@csrf

                        <div class="form-group">
                            <label for="useremail">Email</label>
                            <input type="email" class="form-control" name="email" id="useremail" placeholder="Enter email">
                        </div>

                        <div class="form-group row m-t-20">
                            <div class="col-12 text-right">
                                <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Reset</button>
                            </div>
                        </div>

                    </form>
                </div>

            </div>
        </div>

        {{-- <div class="m-t-40 text-center">
            <p>Remember It ? <a href="pages-login.html" class="font-500 font-14 text-primary font-secondary"> Sign In Here </a> </p>
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
            $(".reset_password").validate({
                rules: {
                    email: {
                        required: true,
                        email: true,
                    },

                },
                messages: {
                    email: {
                        required: 'Plese enter your email',
                        email: 'Email must be a valid email address',
                    },
                }
            });
        });

    </script>

</body>

</html>