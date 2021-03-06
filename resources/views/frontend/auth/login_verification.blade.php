@extends('layouts.frontend.master')
@section('title', 'Login Verification')

@section('page-css')
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/login.css') }}">
@endsection

@section('content')

    <!-- login verification section -->
    <section class="login_section pt-20 pb-120">
        <div class="container">
            <div class="login_container">

                @include('partial.frontend.auth.logo')

                <div class="login_content">
                    <h2>ওটিপি বসান</h2>
                    <p><span class="font_inter">{{ $number }} </span> নাম্বারে ওটিপি পাঠানো হয়েছে </p>
     
                    <form action="{{ route('forgot.password.otp.verification') }}" class="otpVerifyForm" method="POST">
                        @csrf
                        @include('partial.frontend.auth.verify-otp')
                    </form>

                </div>

                <!-- </div> -->
            </div>
        </div>
    </section>

@endsection
@section('page-js')
    <script>
        $(".otpVerifyForm").validate({
            rules: {
                otp: {
                    required: true,
                    digits: true,
                    minlength: 6,
                    maxlength: 6,
                },


            },
            messages: {
                otp: {
                    required: 'Please insert your otp code',
                },
            },
            errorPlacement: function(label, element) {
                label.addClass('h1 text-danger');
                label.insertAfter(element);
            },
        });

        function sendOtpAgain() {
            var number = $('#number').val();
            $.ajax({
                url: routeConfig.routes.login,
                method: "post",
                data: {
                    number: number,
                    _token: "{{ csrf_token() }}"
                },
                dataType: "json",
                success: function(response) {
                    if (response.success == true) {
                        toastr['success']('পুনরায়  ওটিপি পাঠানো হয়েছে ');
                    } else {
                        toastr['error'](response.data);
                    }

                },
                error: function(error) {
                    if (error.status == 404) {
                        toastr['error']('Data not found');

                    }
                    if (error.status == 422) {
                        $.each(error.responseJSON.errors, function(i, message) {
                            toastr['error'](message);
                        });

                    }
                },
            }); //ajax end
        }
    </script>
@endsection
