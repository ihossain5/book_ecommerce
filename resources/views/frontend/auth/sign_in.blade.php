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
                    <h2>লগ ইন করুন</h2>
                   
                    <form id="loginForm" method="POST">@csrf
                        <div class="input_fild inputDiv">
                            <p class="error loginErrorMessage"></p>
                            <input type="text" name="number" placeholder="আপনার ফোন নম্বর" name="">
                            <input type="password" name="password" placeholder="আপনার পাসওয়ার্ড" name=""
                                class="mt-4">
                        </div>
                        <!--<p>এই নম্বরে আমরা একটি ওটিপি (একবার ব্যবহারযোগ্য পাসওয়ার্ড) পাঠাব</p>-->
                        <a href="{{route('frontend.forgot.password')}}" class="forgot_passowrd">পাসওয়ার্ড ভুলে গেছেন?</a>
                        <div class="submit_btn">
                            <button class="submit">সাবমিট করুন</button>
                        </div>
                    </form>
                    @include('partial.frontend.auth.social_login')
                    <div class="new_account_create lnpage">
                        <a href="{{ route('frontend.send.otp') }}">নতুন <label>অ্যাকাউন্ট</label> তৈরি করুন</a>
                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection
@section('page-js')

    <script>
        var errorMessageDiv = '.loginErrorMessage';
        var form = '#loginForm';
        var url = "{!! route('frontend.sign.in') !!}";

        loginFormValidation(form);
        singIn(form,url,errorMessageDiv);
    </script>
@endsection
