@extends('layouts.frontend.master')
@section('title', 'Login Verification')

@section('page-css')
<link rel="stylesheet" href="{{ asset('frontend/assets/css/login.css') }}">
@endsection
{{-- {{ asset('frontend/') }} --}}
@section('content')

    <!-- login verification section -->
    <section class="login_section pt-20 pb-120">
        <div class="container">
            <div class="login_container">
                <!-- <div class="col-12 col-lg-6 sm_hide"> -->
                    <div class="login_wrapper">
                        <img class="img-fluid w-100" src="{{ asset('frontend/assets/images/login/login-img.png') }}" alt="Rectangle 48">
                        <img class="img-fluid logo" src="{{ asset('frontend/assets/images/login/logo.png') }}" alt="">
                    </div>
                <!-- </div> -->
                <!-- <div class="col-12 col-lg-6"> -->
                    <div class="login_content">
                        <h2>লগ ইন করুন</h2>

                        @if (session()->has('errorMessage'))
                        <div class="alert alert-success text-center text-dark mt-3 alert-solid alert-dismissible shadow-sm p-3 mb-5 rounded"
                            role="alert">
                            {{ session('errorMessage') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

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

                        <p><span class="font_inter">{{$number}} </span>  নাম্বারে পাঠান ওটিপি বসান</p>
                        <form action="{{route('frontend.otp.verification')}}" method="POST">@csrf
                        <div class="input_fild">
                            <input type="text" name="otp" placeholder="আপনার ওটিপি" name="">
                            <input type="hidden" name="phone" value="{{$number}}">
                        </div>
                        <div class="submit_btns">
                            <button href="" class="submit">সাবমিট করুন</button>
                            <button href="" class="otp">আবার ওটিপি পাঠান</button>
                        </div>
                    </form>
                        <h3>অথবা গুগল/ফেসবুক দিয়ে লগ ইন করুন,</h3>
                        <div class="social_btns">
                            <a href="" class="google"><img src="{{ asset('frontend/assets/images/icons/Google__G__Logo.svg') }}"
                                    alt="google img">Google</a>
                            <a href="" class="facebook"><img src="{{ asset('frontend/assets/images/icons/Facebook_f_logo.svg') }}"
                                    alt="google img">Facebook</a>
                        </div>
                    </div>

                <!-- </div> -->
            </div>
        </div>
    </section>

@endsection
@section('page-js')
@endsection