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
                    <form class="loginForm" method="POST">@csrf
                        <div class="input_fild">
                            <input type="text" name="number" placeholder="আপনার ফোন নম্বর" name="">
                            <input type="password" name="password" placeholder="আপনার পাসওয়ার্ড" name="" class="mt-4">
                        </div>
                        <p>এই নম্বরে আমরা একটি ওটিপি (একবার ব্যবহারযোগ্য পাসওয়ার্ড) পাঠাব</p>
                        <div class="submit_btn">
                            <button class="submit">সাবমিট করুন</button>
                        </div>
                    </form>
                    <h3>অথবা গুগল/ফেসবুক দিয়ে লগ ইন করুন,</h3>
                    <div class="social_btns">
                        <a href="{{ route('login.google') }}" class="google"><img
                                src="{{ asset('frontend/assets/images/icons/Google__G__Logo.svg') }}"
                                alt="google img">Google</a>
                        <a href="{{ route('login.facebook') }}" class="facebook"><img
                                src="{{ asset('frontend/assets/images/icons/Facebook_f_logo.svg') }}"
                                alt="google img">Facebook</a>
                    </div>
                    <div class="new_account_create lnpage">
                        <a href="{{ route('frontend.send.otp') }}">নতুন অ্যাকাউন্ট তৈরি করুন</a>
                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection
@section('page-js')

    <script>

    </script>
@endsection
