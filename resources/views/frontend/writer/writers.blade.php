@extends('layouts.frontend.master')
@section('title', 'Writers')

@section('page-css')
<link rel="stylesheet" href="{{ asset('frontend/assets/css/owl.carousel.min.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/assets/css/writers.css') }}">
@endsection

@section('content')
    <!-- Banner Section -->
    <section class="banner_section pt-20 pb-56">
        <div class="container">
            <div class="banner_slider">
                <div class="owl-carousel owl-theme">
                    <div class="item"><img src="{{ asset('frontend/assets/images/banner-img/banner-slide-img-1.png') }}" alt="slider-images">
                    </div>
                    <div class="item"><img src="{{ asset('frontend/assets/images/banner-img/banner-slide-img-1.png') }}" alt="slider-images">
                    </div>
                    <div class="item"><img src="{{ asset('frontend/assets/images/banner-img/banner-slide-img-1.png') }}" alt="slider-images">
                    </div>
                </div>
            </div>
        </div>
    </section>
        <!-- writers cards -->
        <section class="writer_cards_section pb-120">
            <div class="container">
                <div class="sc_title_wrapper">
                    <h1 class="sc_title">লেখক </h1>
                </div>
            </div>
            <div class="container">
                <div class="row row-cols-2 row-cols-sm-2 row-cols-md-5  g-0">
                    <div class="col">
                        <div class="writer_content">
                            <a href="writer-details.html"  class="d-block tex-reset" >
                                <img class="img-fluid w-100" src="{{ asset('frontend/assets/images/writers/writer-1.png') }}" alt="writer image">
                                <h3 class="card_text">শ্যামল দত্ত</h3>
                            </a>
                        </div>
                    </div>
                    <div class="col">
                        <div class="writer_content">
                            <a href="writer-details.html"  class="d-block tex-reset" >
                                <img class="img-fluid w-100" src="{{ asset('frontend/assets/images/writers/writer-2.png') }}" alt="writer image">
                                <h3 class="card_text">মজিদ মাহমুদ</h3>
                            </a>
                        </div>
                    </div>
                    <div class="col">
                        <div class="writer_content">
                            <a href="writer-details.html"  class="d-block tex-reset" >
                                <img class="img-fluid w-100" src="{{ asset('frontend/assets/images/writers/writer-3.png') }}" alt="writer image">
                                <h3 class="card_text">আন্দালিব রাশদী</h3>
                            </a>
                        </div>
                    </div>
                    <div class="col">
                        <div class="writer_content">
                            <a href="writer-details.html"  class="d-block tex-reset" >
                                <img class="img-fluid w-100" src="{{ asset('frontend/assets/images/writers/writer-4.png') }}" alt="writer image">
                                <h3 class="card_text">সালেক নাছির উদ্দিন</h3>
                            </a>
                        </div>
                    </div>
                    <div class="col">
                        <div class="writer_content">
                            <a href="writer-details.html"  class="d-block tex-reset" >
                                <img class="img-fluid w-100" src="{{ asset('frontend/assets/images/writers/writer-5.png') }}" alt="writer image">
                                <h3 class="card_text">আনোয়ারা সৈয়দ হক</h3>
                            </a>
                        </div>
                    </div>
                    <div class="col">
                        <div class="writer_content">
                            <a href="writer-details.html"  class="d-block tex-reset" >
                                <img class="img-fluid w-100" src="{{ asset('frontend/assets/images/writers/writer-1.png') }}" alt="writer image">
                                <h3 class="card_text">শ্যামল দত্ত</h3>
                            </a>
                        </div>
                    </div>
                    <div class="col">
                        <div class="writer_content">
                            <a href="writer-details.html"  class="d-block tex-reset" >
                                <img class="img-fluid w-100" src="{{ asset('frontend/assets/images/writers/writer-2.png') }}" alt="writer image">
                                <h3 class="card_text">মজিদ মাহমুদ</h3>
                            </a>
                        </div>
                    </div>
                    <div class="col">
                        <div class="writer_content">
                            <a href="writer-details.html"  class="d-block tex-reset" >
                                <img class="img-fluid w-100" src="{{ asset('frontend/assets/images/writers/writer-3.png') }}" alt="writer image">
                                <h3 class="card_text">আন্দালিব রাশদী</h3>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection
@section('page-js')
<script src="{{ asset('frontend/assets/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/banner-carousel-activation.js') }}"></script>
@endsection