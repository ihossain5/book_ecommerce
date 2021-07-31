@extends('layouts.admin.master')
@section('pageCss')
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
                                    <h4 class="mt-0 header-title">Update Password</h4>
                                </div>


                            </div>
                            @if ($errors->any())
                                <div class=" mt-3">
                                    {{-- <div class="font-medium text-red-600 text-danger">
                                    {{ __('Whoops! Something went wrong.') }}
                                </div> --}}

                                    <ul class="mt-3 list-disc list-inside text-danger text-sm text-red-600">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="ms-panel-body">
                                <p class="ms-directions"></p>

                                <div class="ms-panel-body">
                                    <form method="POST" action="{{ route('password.update') }}" id="changePassword"> @csrf
                                        <div class="form-group">
                                            <label for="old">Current Password</label>
                                            <input type="password" name="old_password" class="form-control" id="old">
                                        </div>
                                        <div class="form-group">
                                            <label for="new">New Password</label>
                                            <input type="password" name="password" class="form-control" id="new">
                                        </div>
                                        <div class="form-group">
                                            <label for="confirm">Confirm Password</label>
                                            <input type="password" name="password_confirmation" class="form-control"
                                                id="confirm">
                                        </div>
                                        {{-- <input type="text" name="password" class="form-control mt-5" id=""> --}}
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

    <script>
        //  validation 
        $(document).ready(function() {
            $("#changePassword").validate({
                rules: {
                    old_password: {
                        required: true,

                    },

                    password: {
                        required: true,
                        minlength: 6,
                    },
                    password_confirmation: {

                        equalTo: '[name="password"]'
                    },


                },
                messages: {
                    old_password: {
                        required: 'Please insert your old password',

                    },

                    password: {
                        required: 'Please insert  new password',
                        minlength: 'Password must consist of at least 6 characters',
                    },
                    password_confirmation: {
                        equalTo: 'Password and confirm password does not match',
                    }



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
