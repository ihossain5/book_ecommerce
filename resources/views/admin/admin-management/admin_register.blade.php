
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>Sign up Page</title>
    <meta content="Admin Dashboard" name="description" />
    <meta content="Themesbrand" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App Icons -->
    <link rel="shortcut icon" href="{{ asset('backend/assets/images/favicon.ico') }}">

    <!-- App css -->
    <link href="{{ asset('backend/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/assets/css/icons.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/assets/css/style.css') }}" rel="stylesheet" type="text/css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css"
        integrity="sha512-EZSUkJWTjzDlspOoPSpUFR0o0Xy7jdzW//6qhUkoZ9c4StFkVsp9fbbd0O06p9ELS3H486m4wmrCELjza4JEog=="
        crossorigin="anonymous" />


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
                {{-- <h3 class="text-center m-0">App Logo</h3> --}}
                <h3 class="text-center m-0">
                    <a href="" class="logo logo-admin">
                        <img src="{{asset('images/logo.png')}}" height="30"
                            alt="logo">
                        {{-- <h5>Admin Dashboard</h5> --}}
                    </a>
                </h3>

                <div class="p-3">
                    <h4 class="text-muted font-18 m-b-5 text-center">Welcome, {{$user->name}}</h4>
                    {{-- <p class="text-muted text-center">Sign in to continue.</p> --}}

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
                    @if (session()->has('success'))
                        <div class="alert alert-info text-center text-dark mt-3 alert-solid alert-dismissible shadow-sm p-3 mb-5 rounded"
                            role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @if (session()->has('message'))
                        <div class="alert alert-success text-center text-dark mt-3 alert-solid alert-dismissible shadow-sm p-3 mb-5 rounded"
                            role="alert">
                            {{ session('message') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <form class="form-horizontal m-t-30 loginForm" action="{{route('admin.sign.up')}}" method="POST" enctype="multipart/form-data">@csrf

                        <div class="form-group">
                            <label for="username">Name</label>
                            <input type="text"  class="form-control" name="name" value="{{$user->name}}">
                        </div>
                        <div class="form-group">
                            <label for="username">Email</label>
                            <input type="text" name="email" readonly="" class="form-control" id="username" value="{{$user->email}}">
                        </div>
                        <div class="form-group">
                            <label for="username">Phone</label>
                            <input type="text" name="phone" class="form-control" id="phone" placeholder="Enter your phone number" value="{{$user->phone}}">
                        </div>




                        <div class="form-group">
                            <label for="userpassword">Password</label>
                            <input type="password" name="password" class="form-control" id="userpassword"
                                placeholder="Enter password">
                        </div>
                        <div class="form-group">
                            <label for="userpassword">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control" id="confirm_password"
                                placeholder="Enter password again">
                        </div>

                             {{-- <div class="form-group ">
                            <label>Image (200*200)</label>
                            <div class="custom-file">
                                <div class="col-md-8 offset-2">
                                    <input type="file" name="image" class="custom-file-input dropify"
                                    data-errors-position="outside" data-allowed-file-extensions='["jpg", "png"]'
                                    data-max-file-size="0.6M" data-height="215" data-width="220">
                                </div>
                            </div>
                        </div> --}}


                        <div class="form-group row m-t-20">
                            <div class="col-sm-6">
                               
                            </div>
                            <div class="col-sm-6 text-right">
                                <button class="btn btn-dark btn-block w-md waves-effect waves-light"
                                    type="submit">Sign
                                    In</button>
                            </div>
                        </div>

                        <div class="form-group m-t-10 mb-0 row">
                            <div class="col-12 m-t-20">
                                Already have an account?
                                <a href="{{ route('login') }}" class="text-muted"></i>
                                    Log in</a>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"
integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew=="
crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
             $('.dropify').dropify();

            $(".loginForm").validate({
                rules: {
                    name: {
                        required: true,
                    },
                    email: {
                        required: true,
                        email: true,
                    },
                    phone: {
                        required: true,
                        digits: true,
                        maxlength: 11,
                    }, 
                    designation: {
                        required: true,
                        maxlength: 30,
                    },
                    gender: {
                        required: true,
                    },
                    profile_image: {
                        required: true,
                    },
                    password: {
                        minlength : 6,
                        required: true,
                    },

                    password_confirmation : {
                    required: true,
                    minlength : 6,
                    equalTo : "#userpassword"
                }
                },
                messages: {
                    email: {
                        required: 'Plese enter your email',
                        email: 'Email must be a valid email address',
                    },
                    name: {
                        required: 'Plese enter your name',
                    },
                    phone: {
                        required: 'Plese enter your phone',
                    },
                    designation: {
                        required: 'Plese enter your designation',
                    },
                    gender: {
                        required: 'Plese choose your gender',
                    },
                    profile_image: {
                        required: 'Plese enter your image',
                    },
                    password: {
                        required: 'Plese enter your password',
                    },
                    password_confirmation: {
                        required: 'Plese enter your password again',
                    },
                }
            });
        });
    </script>

</body>

</html>
