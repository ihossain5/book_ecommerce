@extends('layouts.frontend.master')
@section('title', 'Writers')

@section('page-css')
<link rel="stylesheet" href="{{ asset('frontend/assets/css/owl.carousel.min.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/assets/css/writers.css') }}">
@endsection

@section('content')
    <!-- Banner Section -->
@include('partial.frontend.banner_slider')
        <!-- writers cards -->
        <section class="writer_cards_section pb-120">
            <div class="container">
                <div class="sc_title_wrapper">
                    <h1 class="sc_title">লেখক </h1>
                </div>
            </div>
            <div class="container">
                <div class="row row-cols-2 row-cols-sm-2 row-cols-md-5  g-0">
                    @if(!empty($authors))
                        @foreach ($authors as $author)
                            <div class="col">
                                <div class="writer_content">
                                    <a href="{{ route('frontend.author.details', $author->author_id ) }}"  class="d-block tex-reset" >
                                        <img class="img-fluid w-100" src="{{ asset('images/' . $author->photo) }}" alt="{{  $author->name }}">
                                        <h3 class="card_text">{{  $author->name }}</h3>
                                    </a>
                                </div>
                            </div>  
                        @endforeach
                    @endif
                </div>
            </div>
        </section>
@endsection
@section('page-js')
<script src="{{ asset('frontend/assets/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/banner-carousel-activation.js') }}"></script>
@endsection