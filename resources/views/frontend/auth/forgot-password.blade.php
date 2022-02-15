@extends('layouts.frontend.master')
@section('title', 'Login')

@section('page-css')
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/login.css') }}">

    <style>
        .submitBtn {
            padding: 1.6rem;
            display: block;
            background-color: var(--blue);
            color: var(--white);
            text-decoration: none;
            font-size: 2.4rem;
            font-weight: 700;
            line-height: 3.3rem;
            border-radius: 6.8px;
        }

    </style>
@endsection
@section('content')
    <!-- login section -->
    <section class="login_section pt-20 pb-120">
        <div class="container">
            <div class="login_container ">

                @include('partial.frontend.auth.logo')
                <div class="login_content">

                    <h2>আপনার ফোন নম্বর</h2>

                    <form action="{{ route('forgot.password.otp.send') }}" class="otpForm" method="get">@csrf

                        @include('partial.frontend.auth.otp')
                    </form>
                    @include('partial.frontend.auth.social_login')
                </div>
            </div>
        </div>
    </section>

@endsection
@section('page-js')

    <script>
        $(".otpForm").validate({
            rules: {
                number: {
                    required: true,
                    digits: true,
                    minlength: 11,
                    maxlength: 11,
                },


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
    </script>
@endsection
