@extends('layouts.admin.master')
@section('pageCss')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css"
        integrity="sha512-EZSUkJWTjzDlspOoPSpUFR0o0Xy7jdzW//6qhUkoZ9c4StFkVsp9fbbd0O06p9ELS3H486m4wmrCELjza4JEog=="
        crossorigin="anonymous" />
    <style>

    </style>
@endsection
@section('content')
    <div class="page-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-4">
                                <div class="ms-header-text">
                                    <h4 class="mt-0 header-title">Update Profile</h4>
                                </div>


                            </div>
                            @if ($errors->any())
                                <div class=" mt-3">
                                    <ul class="mt-3 list-disc list-inside text-danger text-sm text-red-600">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if (session()->has('success'))
                                <div class="alert alert-success alert-solid text-center text-dark alert-dismissible shadow-sm p-3 mb-5 rounded"
                                    role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            <div class="ms-panel-body">
                                <p class="ms-directions"></p>

                                <div class="ms-panel-body">
                                    <form method="POST" action="{{ route('admin.profile.update') }}" id="changeProfile"
                                        enctype="multipart/form-data"> @csrf
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Image</label>
                                                    <div class="custom-file profile_image">
                                                        <input type="file" name="image" id="profile_image"
                                                            class="custom-file-input input_image"
                                                            data-errors-position="outside"
                                                            data-allowed-file-extensions='["jpg", "png"]'
                                                            data-max-file-size="0.6M">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label for="old">Name</label>
                                                    <input type="name" name="name" class="form-control" id="old"
                                                        value="{{ $user->name ?? '' }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <input type="name" name="email" class="form-control" id="email"
                                                        value="{{ $user->email ?? '' }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="phone">Phone</label>
                                                    <input type="name" name="phone" class="form-control" id="phone"
                                                        value="{{ $user->phone ?? '' }}">
                                                </div>
                                                
                                            </div>
                                        </div>


                                       
                                        <button class="btn btn-success mt-4 d-block w-100" type="submit">Update</button>
                                    </form>

                                </div>
                            </div>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->




        </div><!-- container -->

    </div> <!-- Page content Wrapper -->
@endsection
@section('pageScripts')
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"
        integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew=="
        crossorigin="anonymous"></script>
    <script>
        $('.dropify').dropify({
            error: {
                'fileSize': 'The file size is too big ( 600KB  max).',
            }
        });
        var data = {!! $user !!};
        var path = "{{ url('/') }}" + '/images/';
        console.log(path);
        if (data.image) {
            var img_url = path + data.image;
            $("#profile_image").attr("data-height", 275);
            // $("#profile_image").attr("data-min-width", 450);
            $("#profile_image").attr("data-default-file", img_url);

            $('.profile_image').find('.dropify-wrapper').removeClass("dropify-wrapper").addClass(
                "dropify-wrapper has-preview");
            $('.profile_image').find(".dropify-preview").css('display', 'block');
            $('.profile_image').find('.dropify-render').html('').html('<img src=" ' + img_url +
                '">')
        } else {
            $('#profile_image').find(".dropify-preview .dropify-render img").attr("src", "");
        }
        $('.input_image').dropify({
            error: {
                'fileSize': 'The file size is too big ( 600KB  max).',
            }
        });
        //  validation 
        $(document).ready(function() {
            $("#changeProfile").validate({
                rules: {
                    name: {
                        required: true,
                        maxlength: 100,
                    },
                    email: {
                        required: true,
                        email: true,
                        maxlength: 100,
                    },
                    phone: {
                        required: true,
                        maxlength: 20,
                    },
                    designation: {
                        required: true,
                        maxlength: 100,
                    },


                },
                messages: {
                    name: {
                        required: 'Please insert your name',
                    },
                    email: {
                        required: 'Please insert your email',
                    },
                    phone: {
                        required: 'Please insert your phone number',
                    },
                    designation: {
                        required: 'Please insert your designation ',
                    },



                },
                errorPlacement: function(label, element) {
                    label.addClass('err-msg mt-2 text-danger ');
                    label.insertAfter(element);
                },

            });
        });
        // end
    </script>
@endsection
