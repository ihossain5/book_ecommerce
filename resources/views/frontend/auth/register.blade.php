@extends('layouts.frontend.master')
@section('title', 'Register')

@section('page-css')
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/login.css') }}">

    <style>


    </style>
@endsection
@section('content')
    <!-- login section -->
    <section class="login_section pt-20 pb-120">
        <div class="container">
            <div class="login_container ">

                <div class="login_content reg_container">
                    <div class="register_content">
                        <h2>রেজিষ্টার করুন</h2>

                     <form id="registerForm" method="POST">@csrf
                         <input type="hidden" name="phone"value="{{session()->get('number')}}">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="input_fild">
                                    <label for="name">নাম</label>
                                    <input type="text" name="name" id="name" placeholder="আপনার নাম" name="">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="input_fild">
                                    <label for="email">ইমেইল অ্যাড্রেস</label>
                                    <input type="text" name="email" id="email" placeholder="আপনার ইমেইল অ্যাড্রেস" name="">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="input_fild">
                                    <label for="password">পাসওয়ার্ড</label>
                                    <input type="password" name="password" id="password" placeholder="আপনার পাসওয়ার্ড" name="">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="input_fild">
                                    <label for="confirmPassword">নিশ্চিত করুন পাসওয়ার্ড </label>
                                    <input type="password" name="password_confirmation" id="confirmPassword" placeholder="নিশ্চিত করুন পাসওয়ার্ড " name="">
                                </div>
                            </div>
                        </div>
                     </form>

                        <div class="col-12">
                            <div class="submit_btn reg_btn">
                                <a onclick="submit()"class="submit">সাবমিট করুন</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection
@section('page-js')

    <script>
        $("#registerForm").validate({
            rules: {
                name: {
                    required: true,
                    minlength: 5,
                    maxlength: 100,
                },
                email: {
                    required: true,
                    email: true,
                    maxlength: 100,
                },
                password: {
                    required: true,
                    minlength: 8,
                    maxlength: 100,
                },
                password_confirmation : {
                    minlength : 8,
                    equalTo : "#password"
                }

            },
            messages: {
                number: {
                    required: 'Please insert your mobile number',
                },
            },
            errorPlacement: function(label, element) {
                label.addClass('h1 text-danger');
                label.insertAfter(element);
            },
        });

        function submit(){
            $('#registerForm').submit();
        }

        $(document).off('submit', '#registerForm');
        $(document).on('submit', '#registerForm', function(event) {  
            event.preventDefault();

            $.ajax({
                type: "POST",
                url: "{!! route('frontend.sign.up') !!}",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function(response) {
                    if (response.success == true) {
                        location.reload();
                    } else {
                        toastr['error'](response.data);
                    }
                },
                error: function(error) {
                    if (error.status == 422) {
                        $.each(error.responseJSON.errors, function(i, message) {
                            toastr['error'](message);
                        });

                    }
                },
            });
            
        });
    </script>
@endsection