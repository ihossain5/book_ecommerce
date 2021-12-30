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

                <div class="login_wrapper">
                    <img class="img-fluid w-100" src="{{ asset('frontend/assets/images/login/login-img.png') }}"
                        alt="Rectangle 48">
                    <img class="img-fluid logo" src="{{ asset('frontend/assets/images/login/logo.png') }}" alt="">
                </div>

                <div class="login_content">
                    <h2>লগ ইন করুন</h2>
                    <form action="{{route('frontend.otp.send')}}" class="loginForm" method="GET">@csrf
                        <div class="input_fild">
                            <input type="text" name="number" placeholder="আপনার ফোন নম্বর" name="">
                        </div>
                        <p>এই নম্বরে আমরা একটি ওটিপি (একবার ব্যবহারযোগ্য পাসওয়ার্ড) পাঠাব</p>
                        <div class="submit_btn">
                            <button class="submit">সাবমিট করুন</button>
                        </div>
                    </form>
                    <h3>অথবা গুগল/ফেসবুক দিয়ে লগ ইন করুন,</h3>
                    <div class="social_btns">
                        <a href="" class="google"><img
                                src="{{ asset('frontend/assets/images/icons/Google__G__Logo.svg') }}"
                                alt="google img">Google</a>
                        <a href="" class="facebook"><img
                                src="{{ asset('frontend/assets/images/icons/Facebook_f_logo.svg') }}"
                                alt="google img">Facebook</a>
                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection
@section('page-js')
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.js"></script>
    <script>
        $(".loginForm").validate({
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
