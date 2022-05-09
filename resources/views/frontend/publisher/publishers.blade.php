@extends('layouts.frontend.master')
@section('title', 'Publication')

@section('page-css')
<link rel="stylesheet" href="{{ asset('frontend/assets/css/topics.css') }}">
@endsection

@section('content')

<section class="banner_section pt-20 pb-56">
    <div class="container">
        <div class="banner_with_title">
            <div class="banner_title_image">
                <img class="img-fluid w-100" src="{{ asset('frontend/assets/images/banner-img/banner-title-bg.png') }}" alt="banner-img">
            </div>
            <h3 class="banner_title">প্রকাশনী</h3>
        </div>
    </div>
</section>

<section class="book_card_with_bg_section pb-120">
    <div class="container">
        <div class="row row-cols-2 row-cols-sm-2 row-cols-md-2 row-cols-lg-3 row-cols-xl-4">
            
            @if(!empty($publications))
            @foreach ($publications as $publication)
            <div class="col">
                <div class="card_with_bg">
                    <div class="circle_bg">
                        <a href="{{ route('frontend.publishers.name', $publication->publication_id ) }}" class="d-block text-reset">
                            <img src="{{ asset('images/' . $publication->photo) }}" alt="">
                        </a>
                    </div>
                    <h6><a href="{{ route('frontend.publishers.name', $publication->publication_id ) }}" class="text-reset">{{  $publication->name }}</a></h6>
                </div>
            </div>
            @endforeach
        @endif
            

            


        </div>
    </div>
</section>

@endsection

@section('page-js')
<script>
    function mobileBtnAction() {

        if ($('.filter_mobile').hasClass('expand')) {
            let btnHeight = $('.mobile_filter').innerHeight();
            $('.filter_mobile').css({ 'height': `${btnHeight}px` });
            $('.filter_mobile').removeClass('expand');
        } else {
            $('.filter_mobile').addClass('expand');
            $('.filter_mobile').css({ 'height': '100vh' });
        }
        // document.querySelector('.mobileMenu').style.height = "89vh"
    }

    function setMenuHeight() {
        let btnHeight2 = $('.mobile_filter').innerHeight();
        $('.filter_mobile').css({ 'height': `${btnHeight2}px` });
    }
    setMenuHeight();

</script>

@endsection