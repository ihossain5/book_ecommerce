@extends('layouts.frontend.master')
@section('title', 'Book Details')

@section('meta')
    <meta property="og:url" content="{{ url()->current() }}" />

    <meta property="og:title" content="{{ $book->title }}" />
    <meta property="og:description" content="{{ $book->long_description }}" />
    <meta property="og:image" content="{{ asset($book->cover_image) }}" />
@endsection

@section('page-css')
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/book-details.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

    <style>
        #shareModal button {
            border: 0;
            outline: none;
            background: transparent;
            width: 2.1rem;
            height: 2.1rem;
            position: absolute;
            top: 2.4rem;
            right: 2.4rem;
            z-index: 1;
        }

        #shareModal .modal-content {
            border-radius: 1.6rem;
        }

        #shareModal .modal-body {
            padding: 2.4rem 6rem 4rem 4rem;
        }

        #shareModal h6 {
            font-size: 1.8rem;
            line-height: 2.2rem;
            font-weight: 700;
            text-transform: uppercase;
            margin-bottom: 5.8rem;
        }

        @media (min-width: 576px) {
            #shareModal .modal-dialog {
                max-width: 446px;
            }
        }

        #shareModal .social-share {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        #shareModal a {
            display: inline-block;
            border-radius: 8px;
            max-width: 5.6rem;
            width: 100%;
        }

        .pdfobject-container {
            height: 60rem;
        }

    </style>
@endsection

@section('content')
    <section class="book_details_sec pt-20">
        <div class="container">
            <div class="row">
                <div class="col-3 col-lg-3">
                    <div class="row left_book_img">
                        <div class="col-6">
                            <img class="thumb_img active" data-serial="serial1"
                                src="{{ asset('images/' . $book->cover_image) }}" alt="{{ $book->title }}">
                            <img class="thumb_img" data-serial="serial12"
                                src="{{ asset('images/' . $book->backside_image) }}" alt="">
                        </div>
                        <div class="col-6">
                            <img class="hero_img serial1 active " src="{{ asset('images/' . $book->cover_image) }}"
                                alt="{{ $book->title }}">
                            <img class="hero_img serial12" src="{{ asset('images/' . $book->backside_image) }}"
                                alt="{{ $book->title }}">
                            <div class="read_btn_box">
                                <button class="read_something_btn" onclick="readBook({{ $book->book_id }})"><img
                                        src="{{ asset('frontend/assets/images/icons/fi_file-text.svg') }}"
                                        alt="{{ $book->title }}">
                                    একটু
                                    পড়ে দেখুন</button>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-9 col-lg-9">
                    <div class="book_details_box">
                        <div class="box_relative">

                            <div class="details_wraper desktop_details">
                                <h1>{{ $book->title }}</h1>
                                <h6>কোডঃ <span>{{ $book->isbn }}</span></h6>
                                <h2>লেখকঃ
                                    <span>
                                        @if (!empty($book->authors))
                                            @foreach ($book->authors as $author)
                                                {{ $author->name }} @if (!$loop->last) , @endif
                                            @endforeach
                                        @endif
                                    </span>
                                </h2>
                                <h2>বিষয়ঃ
                                    <span>
                                        @if (!empty($book->categories))
                                            @foreach ($book->categories as $category)
                                                {{ $category->name }} @if (!$loop->last) , @endif
                                            @endforeach
                                        @endif
                                    </span>
                                </h2>

                                <div class="d-flex rating_box">
                                    <div class="rating ratingDetails ratingId0" data-rating="{{ $rating }}"></div>
                                    <div>
                                        <span>({{ englishTobangla($rating) }} /
                                            ({{ englishTobangla($book->reviews->count()) }}টি রিভিউ)</span>
                                    </div>
                                </div>

                                <p class="book_description">{{ $book->short_description }}</p>


                                <div class="price_box">
                                    <h3>{{ englishTobangla($book->discounted_price) }} টাকা
                                        @if ($book->discounted_percentage != null || $book->discounted_percentage != 0)
                                            <del>{{ englishTobangla($book->regular_price) }} টাকা</del>

                                            <span>({{ englishTobangla($book->discounted_percentage) }}% ছাড়)</span>
                                        @endif
                                    </h3>
                                </div>
                                <button class="buy_btn" onclick="addToCart({{ $book->book_id }})">Buy Now</button>
                                <div class="book_add_btn">
                                    <button type="button" onclick="addToWishlist({{ $book->book_id }})"><img
                                            src="{{ asset('frontend/assets/images/icons/favorite_border_black_24dp 1.svg') }}"
                                            alt=""></button>
                                    <button onclick="addToCart({{ $book->book_id }})"><img
                                            src="{{ asset('frontend/assets/images/icons/shopping_cart_black_24dp (1).svg') }}"
                                            alt=""></button>
                                    <button onclick="share()"><img
                                            src="{{ asset('frontend/assets/images/icons/share_black_24dp 1.svg') }}"
                                            alt=""></button>
                                </div>                   
                                <div class="deilvery_info">
                                    <p> <img src="{{asset('frontend/assets/images/icons/cash-on-delivery-green.svg')}}" alt="icon">ক্যাশ অন ডেলিভারি</p>
                                <p><img src="{{asset('frontend/assets/images/icons/seven-day-retuen-green.svg')}}" alt="icon"> ৭ দিন ফেরতযোগ্য</p>
                                    {{-- <p>ডেলিভারি ফি ৫০ টাকা</p> --}}
                                </div>
                            </div>
                            <div class="deilvery_info">
                                <p> <img src="{{asset('frontend/assets/images/icons/cash-on-delivery-green.svg')}}" alt="icon">ক্যাশ অন ডেলিভারি</p>
                            <p><img src="{{asset('frontend/assets/images/icons/seven-day-retuen-green.svg')}}" alt="icon"> ৭ দিন ফেরতযোগ্য</p>
                                {{-- <p>ডেলিভারি ফি ৫০ টাকা</p> --}}
                            </div>

               
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="details_wraper mobile_details">
                        <h6>কোডঃ <span>{{ $book->isbn }}</span></h6>
                        <h1>{{ $book->title }}</h1>
                        <h2>লেখকঃ
                            <span>
                                @if (!empty($book->authors))
                                    @foreach ($book->authors as $author)
                                        {{ $author->name }} @if (!$loop->last) , @endif
                                    @endforeach
                                @endif
                            </span>
                        </h2>
                        <h2>বিষয়ঃ
                            <span>
                                @if (!empty($book->categories))
                                    @foreach ($book->categories as $category)
                                        {{ $category->name }}
                                    @endforeach
                                @endif
                            </span>
                        </h2>

                        <div class="d-flex rating_box">
                            <div class="rating ratingId0" data-rating="{{ $rating }}"></div>
                            <div>
                                <span>({{ englishTobangla($rating) }} /
                                    ({{ englishTobangla($book->reviews->count()) }}টি রিভিউ)</span>
                            </div>
                        </div>

                        <p class="book_description">{{ $book->short_description }}</p>


                        <div class="price_box">
                            <h3>{{ englishTobangla($book->discounted_price) }} টাকা
                                @if ($book->discounted_percentage != null || $book->discounted_percentage != 0)
                                    <del>{{ englishTobangla($book->regular_price) }} টাকা</del>

                                    <span>({{ englishTobangla($book->discounted_percentage) }}% ছাড়)</span>
                                @endif
                            </h3>
                        </div>
                        <button class="buy_btn" onclick="addToCart({{ $book->book_id }})">Buy Now</button>
                        <div class="book_add_btn">
                            <button type="button" onclick="addToWishlist({{ $book->book_id }})"><img
                                    src="{{ asset('frontend/assets/images/icons/favorite_border_black_24dp 1.svg') }}"
                                    alt=""></button>
                            <button onclick="addToCart({{ $book->book_id }})"><img
                                    src="{{ asset('frontend/assets/images/icons/shopping_cart_black_24dp (1).svg') }}"
                                    alt=""></button>
                            <button onclick="share()"><img
                                    src="{{ asset('frontend/assets/images/icons/share_black_24dp 1.svg') }}"
                                    alt=""></button>
                        </div>  
                        <div class="deilvery_info">
                            <p> <img src="{{asset('frontend/assets/images/icons/cash-on-delivery-green.svg')}}" alt="icon">ক্যাশ অন ডেলিভারি</p>
                            <p><img src="{{asset('frontend/assets/images/icons/seven-day-retuen-green.svg')}}" alt="icon"> ৭ দিন ফেরতযোগ্য</p>
                            {{-- <p>ডেলিভারি ফি ৫০ টাকা</p> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- tab section -->
    <section class="tabs_section py-120">
        <div class="container">
            <div class="row">
                <div>
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li role="presentation">
                            <a class=" active" id="personal_info-tab" data-bs-toggle="tab"
                                data-bs-target="#personal_info" type="button" role="tab" aria-controls="personal_info"
                                aria-selected="true">বিস্তারিত</a>
                        </li>
                        <li role="presentation">
                            <a class="" id="area_info-tab" data-bs-toggle="tab" data-bs-target="#area_info"
                                type="button" role="tab" aria-controls="area_info" aria-selected="false">স্পেসিফিকেশন্স</a>
                        </li>
                        <li role="presentation">
                            <a class="" id="settings-tab" data-bs-toggle="tab" data-bs-target="#settings"
                                type="button" role="tab" aria-controls="settings" aria-selected="false">লেখক</a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="personal_info">
                            <p class="tab_text">{{ $book->long_description }}</p>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="area_info">

                            <table class="table table-bordered book_spec">
                                <tbody>
                                    <tr>
                                        <td>Title</td>
                                        <td>{{ $book->title }}</td>
                                    </tr>
                                    <tr>
                                        <td>ISBN</td>
                                        <td>{{ $book->isbn }}</td>
                                    </tr>
                                    <tr>
                                        <td>Author</td>
                                        <td>
                                            @foreach ($book->authors as $author)
                                            <a href="{{route('frontend.author.details',[$author->author_id])}}">
                                                    {{ $author->name }} @if (!$loop->last) , @endif
                                            </a>
                                            @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Publisher</td>
                                        <td>
                                            <a href="{{route('frontend.publishers.name',[$book->publication->publication_id])}}">
                                                {{ $book->publication->name }}
                                            </a>
                                        </td>
                                    </tr>
                                    @if (!empty($book->featureAttributes))
                                        @foreach ($book->featureAttributes as $specification)
                                            <tr>
                                                <td>{{ $specification->name }}</td>
                                                <td>{{ $specification->pivot->value }}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div role="tabpanel" class="tab-pane books_choice" id="settings">
                            <section class="writer_details_section">
                                <div class="writer_details_carousel owl-carousel control_design">
                                    @if (!empty($book->authors))
                                        @foreach ($book->authors as $author)


                                            <div class="item">
                                                <div class="writer_details">
                                                    <div class="writer_details_img">
                                                        <img class="img-fluid w-100"
                                                            src="{{ asset('images/' . $author->photo) }}" alt="">
                                                    </div>
                                                    <div class="wd_description">
                                                        <h2>{{ $author->name }}</h2>
                                                        <p>{{ $author->description }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- related books -->
    <section class="related_books_section">
        <div class="container">
            <div class="rating_heading">
                <h2>সম্পর্কিত বইসমূহ</h2>
            </div>
        </div>
        <div class="container">
            <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-5 row-cols-xxl-6">
                @if (!empty($related_books))
                    @foreach ($related_books as $key => $related_book)
                        <div class="col">
                            <div class="book_card_wrapper">
                                <div class="image_wrapper">
                                    <a href="{{ route('frontend.book.details', [$related_book->book_id]) }}"
                                        class="d-block text-reset">
                                        <img class="img-fluid w-100"
                                            src="{{ asset('images/' . $related_book->cover_image) }}" alt="book image">
                                    </a>
                                    <div class="npb_hoberable">
                                        <button class="addtocart" onclick="addToCart({{ $related_book->book_id }})">Add to cart</button>
                                    </div>
                                    @if ($related_book->discounted_percentage != null || $related_book->discounted_percentage != 0)
                                        <div class="red_tag">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="49" height="49"
                                                viewBox="0 0 49 49" fill="none">
                                                <path
                                                    d="M23.7645 0.798398C24.1606 0.368447 24.8394 0.368447 25.2355 0.798399L29.1564 5.05469C29.4184 5.33912 29.821 5.44698 30.1901 5.33167L35.7138 3.60607C36.2718 3.43175 36.8597 3.77117 36.9878 4.34156L38.2552 9.98808C38.3399 10.3654 38.6346 10.6601 39.0119 10.7448L44.6584 12.0122C45.2288 12.1403 45.5682 12.7282 45.3939 13.2862L43.6683 18.8099C43.553 19.179 43.6609 19.5816 43.9453 19.8436L48.2016 23.7645C48.6316 24.1606 48.6316 24.8394 48.2016 25.2355L43.9453 29.1564C43.6609 29.4184 43.553 29.821 43.6683 30.1901L45.3939 35.7138C45.5682 36.2718 45.2288 36.8597 44.6584 36.9878L39.0119 38.2552C38.6346 38.3399 38.3399 38.6346 38.2552 39.0119L36.9878 44.6584C36.8597 45.2288 36.2718 45.5682 35.7138 45.3939L30.1901 43.6683C29.821 43.553 29.4184 43.6609 29.1564 43.9453L25.2355 48.2016C24.8394 48.6316 24.1606 48.6316 23.7645 48.2016L19.8436 43.9453C19.5816 43.6609 19.179 43.553 18.8099 43.6683L13.2862 45.3939C12.7282 45.5682 12.1403 45.2288 12.0122 44.6584L10.7448 39.0119C10.6601 38.6346 10.3654 38.3399 9.98808 38.2552L4.34156 36.9878C3.77117 36.8597 3.43175 36.2718 3.60607 35.7138L5.33167 30.1901C5.44698 29.821 5.33912 29.4184 5.05469 29.1564L0.798398 25.2355C0.368447 24.8394 0.368447 24.1606 0.798399 23.7645L5.05469 19.8436C5.33912 19.5816 5.44698 19.179 5.33167 18.8099L3.60607 13.2862C3.43175 12.7282 3.77117 12.1403 4.34156 12.0122L9.98808 10.7448C10.3654 10.6601 10.6601 10.3654 10.7448 9.98808L12.0122 4.34156C12.1403 3.77117 12.7282 3.43175 13.2862 3.60607L18.8099 5.33167C19.179 5.44698 19.5816 5.33912 19.8436 5.05469L23.7645 0.798398Z"
                                                    fill="#D20202" />
                                            </svg>
                                            <p>{{ $related_book->discounted_percentage }}%</p>
                                        </div>
                                    @endif
                                </div>
                                <div class="content_wrapper book_card_content">
                                    {{-- <div class="rating">
                                        <div class="rateYo ratSerialId{{ $key }}"
                                            data-user_rating="{{ getTotalRating($related_book->reviews) }}"></div>
                                    </div> --}}
                                    <h3 class="title">{{ $related_book->title }}</h3>
                                    <p class="author">
                                        @if (!empty($related_book->authors))
                                            @foreach ($related_book->authors as $author)
                                                {{ $author->name }} @if (!$loop->last) , @endif
                                            @endforeach
                                        @endif
                                    </p>
                                    <div class="price_wrapper">
                                        @if ($related_book->discounted_percentage != null || $related_book->discounted_percentage != 0)
                                            <h6 class="discount">
                                                {{ englishTobangla($related_book->regular_price) }} টাকা</h6>
                                        @endif
                                        <h5 class="regular">{{ englishTobangla($related_book->discounted_price) }}
                                            টাকা</h5>
                                    </div>
                                    <a href="{{ route('frontend.book.details', [$related_book->book_id]) }}"
                                        class="btn_buy_now">বিস্তারিত</a>
                                        <div class="addtocart_smallview">
                                            <button class="addtocart" onclick="addToCart({{ $related_book->book_id }})">Add to cart</button>
                                        </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif

            </div>
        </div>
    </section>

    <!-- rating section -->
    <section class="rating_section py-120">
        <div class="container">
            <div class="rating_heading">
                <h2>রিভিউস এবং রেটিংস</h2>
            </div>
            <div class="rating_content">
                <div class="rating ratingReadOnly" data-rating="{{ $rating }}"></div>
                <h3 class="reating_points">{{ englishTobangla($rating) }}/৫</h3>
                <p>({{ englishTobangla($book->reviews->count()) }}টি রিভিউ)</p>
            </div>
            {{-- <div class="rating_box">
                <h3>রিভিউস এবং রেটিংস</h3>
            </div> --}}

        </div>
    </section>
    @auth
        <section class="rating_section py-120">
            <div class="container">
                <div class="rating_container">
                    <div class="rating_text_box">
                        <form class="reviewStoreForm" method="POST">@csrf
                            <textarea class="form-control" name="review" cols="30" rows="5"
                                placeholder="Tell us what do you think about this book"></textarea>
                            <input type="hidden" name="book_id" value="{{ $book->book_id }}">
                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                            <input type="hidden" name="rating" class="book_rating">
                            <div class="row mt-4 ">
                                <div class="col-md-6">
                                    <div class="bookRating"></div>
                                </div>
                                <div class="col-md-6 pt-5 pt-md-0 text-end">
                                    <button type="submit" class="ratingBtn">SUBMIT</button>
                                </div>
                            </div>

                        </form>

                    </div>

                    @if (!empty($book->reviews))
                        @foreach ($book->reviews as $key => $review)
                            <div class="user_rating_box">
                                <div class="rating_user">
                                    <div>
                                        <img src="  {{ asset($review->user->image == null ? 'frontend/assets/images/demo_user.png' : 'images/' . $review->user->image) }}"
                                            alt="">
                                    </div>
                                    <div>
                                        <h2>by <span>{{ $review->user->name }}</span>
                                            {{ formatDate($review->created_at) }}</h2>
                                        <div class="userRating userRatSerialId{{ $key }}"
                                            data-user_rating="{{ $review->rating }}"></div>
                                    </div>
                                </div>
                                <div class="rating_msg">
                                    <p>{{ $review->review }}</p>
                                </div>
                            </div>
                        @endforeach
                    @endif



                </div>
            </div>
        </section>
    @endauth

    <div class="share d-none">
        {!! $shareComponent !!}
    </div>
    <div class="modal fade" id="shareModal" tabindex="-1" aria-labelledby="shareModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <button type="button" data-bs-dismiss="modal" aria-label="Close">
                    <img src="{{ asset('frontend/assets/icons/close_icon.svg') }}" alt="close-icon"
                        class="img-fluid">
                </button>
                <div class="modal-body">
                    <h6>SHare this book</h6>
                    <div class="social-share">
                        <a href="javascript:void(0)" onclick="shareToLinkedin()" class="share-link"><img
                                src="{{ asset('frontend/assets/icons/linkedin.svg') }}" alt="linkedin"></a>
                        <a href="javascript:void(0)" onclick="shareToTwitter()" class="share-link"><img
                                src="{{ asset('frontend/assets/icons/twitter.svg') }}" alt="twitter"></a>
                        <a href="javascript:void(0)" onclick="shareToFacebook()" class="share-link"><img
                                src="{{ asset('frontend/assets/icons/facebook.svg') }}" alt="facebook"></a>
                        <a href="javascript:void(0)" onclick="shareToWhatsapp()" class="share-link"><img
                                src="{{ asset('frontend/assets/icons/whatsapp.svg') }}" alt="whatsapp"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="pdfModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              {{-- <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5> --}}
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="pdf_viewer"></div>
            </div>

          </div>
        </div>
      </div>
@endsection
@section('page-js')

    <script src="{{ asset('frontend/assets/js/owl.carousel.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfobject/2.2.6/pdfobject.min.js"
    integrity="sha512-B+t1szGNm59mEke9jCc5nSYZTsNXIadszIDSLj79fEV87QtNGFNrD6L+kjMSmYGBLzapoiR9Okz3JJNNyS2TSg=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $('.writer_details_carousel').owlCarousel({
            loop: false,
            autoplayTimeout: 3500,
            smartSpeed: 1500,
            autoplayHoverPause: true,
            margin: 16,
            navText: [
                '<img src="{{ asset('frontend/assets/images/icons/chevron-left-black.svg') }}" alt="chevron-left-black">',
                '<img src="{{ asset('frontend/assets/images/icons/chevron-right-black.svg') }}" alt="chevron-right-black">'
            ],
            responsive: {
                0: {
                    items: 1,
                    autoplay: false,
                    loop: true,
                    dots: false
                },
                1200: {
                    items: 2,
                    nav: true
                }
            }
        })

        $(function() {
            for (let i = 0; i < $('.ratingDetails').length; i++) {
                $(`.ratingId${i}`).rateYo({
                    starWidth: "20px",
                    rating: $('.ratingDetails').data('rating'),
                    readOnly: true,
                    ratedFill: "#F2C94C",
                    normalFill: "none",
                    spacing: "5px",
                    starSvg: `<svg xmlns="http://www.w3.org/2000/svg" width="20" height="19" viewBox="0 0 20 19" fill="none">
  <path d="M10 1.34175L12.1223 6.62665L12.2392 6.91794L12.5524 6.93918L18.2345 7.32445L13.8641 10.976L13.6232 11.1772L13.6998 11.4817L15.0892 17.0047L10.2659 13.9765L10 13.8096L9.73415 13.9765L4.91081 17.0047L6.30024 11.4817L6.37683 11.1772L6.13594 10.976L1.76551 7.32445L7.44757 6.93918L7.76076 6.91794L7.87773 6.62665L10 1.34175Z" stroke="#F2C94C"/>
  </svg>`
                });
            }

            for (let i = 0; i < $('.userRating').length; i++) {

                $(`.userRatSerialId${i}`).rateYo({
                    starWidth: "22px",
                    ratedFill: "#F2C94C",
                    normalFill: "none",
                    rating: $(`.userRatSerialId${i}`).data('user_rating'),
                    readOnly: true,
                    spacing: "5px",
                    starSvg: `<svg xmlns="http://www.w3.org/2000/svg" width="20" height="19" viewBox="0 0 20 19" fill="none">
  <path d="M10 1.34175L12.1223 6.62665L12.2392 6.91794L12.5524 6.93918L18.2345 7.32445L13.8641 10.976L13.6232 11.1772L13.6998 11.4817L15.0892 17.0047L10.2659 13.9765L10 13.8096L9.73415 13.9765L4.91081 17.0047L6.30024 11.4817L6.37683 11.1772L6.13594 10.976L1.76551 7.32445L7.44757 6.93918L7.76076 6.91794L7.87773 6.62665L10 1.34175Z" stroke="#F2C94C"/>
  </svg>`
                });

            }


            $('.bookRating').rateYo({
                starWidth: "32px",
                ratedFill: "#F2C94C",
                normalFill: "none",
                spacing: "5px",
                onSet: function(rating, rateYoInstance) {
                    // alert(rating);
                    // console.log(rating);
                    var rating_value = rating;
                    $('.book_rating').val(rating_value);

                },
                starSvg: `<svg xmlns="http://www.w3.org/2000/svg" width="20" height="19" viewBox="0 0 20 19" fill="none">
  <path d="M10 1.34175L12.1223 6.62665L12.2392 6.91794L12.5524 6.93918L18.2345 7.32445L13.8641 10.976L13.6232 11.1772L13.6998 11.4817L15.0892 17.0047L10.2659 13.9765L10 13.8096L9.73415 13.9765L4.91081 17.0047L6.30024 11.4817L6.37683 11.1772L6.13594 10.976L1.76551 7.32445L7.44757 6.93918L7.76076 6.91794L7.87773 6.62665L10 1.34175Z" stroke="#F2C94C"/>
  </svg>`
            });



        });

        $('.hero_img').mouseenter(function() {
            $('.hero_img.active').css({
                'opacity': '0'
            }).siblings('.hero_img').css({
                'opacity': '1'
            })
        })

        $('.hero_img').mouseleave(function() {
            $('.hero_img.active').css({
                'opacity': '1'
            }).siblings('.hero_img').css({
                'opacity': '0'
            })
        })

        $('.thumb_img').click(function() {
            $(this).addClass('active').siblings('.thumb_img').removeClass('active');
            let thumbSerial = $(this).data('serial')


            $('.hero_img').removeClass('active');
            $(`.${thumbSerial}`).addClass('active');

            $(`.${thumbSerial}`).css({
                'opacity': '1'
            }).siblings('.hero_img').css({
                'opacity': '0'
            });

        })

        // ratin readonly >> rateyo acitvation
        $(".rating.ratingReadOnly").rateYo({
            starWidth: "20px",
            normalFill: 'none',
            ratedFill: "#F2C94C",
            spacing: "5px",
            readOnly: true,
            rating: $('.ratingReadOnly').data('rating'),
            starSvg: `<svg xmlns="http://www.w3.org/2000/svg" width="20" height="19" viewBox="0 0 20 19" fill="none">
      <path d="M10 1.34175L12.1223 6.62665L12.2392 6.91794L12.5524 6.93918L18.2345 7.32445L13.8641 10.976L13.6232 11.1772L13.6998 11.4817L15.0892 17.0047L10.2659 13.9765L10 13.8096L9.73415 13.9765L4.91081 17.0047L6.30024 11.4817L6.37683 11.1772L6.13594 10.976L1.76551 7.32445L7.44757 6.93918L7.76076 6.91794L7.87773 6.62665L10 1.34175Z" stroke="#F2C94C"/>
      </svg>`
        });

        $('.read_btn_box').css({
            'margin-top': `calc(${$('.hero_img').innerHeight()}px + 25px)`,
            'width': `${$('.hero_img').innerWidth()}px`,
        })

        var config = {
            routes: {
                store: "{!! route('store.review') !!}",
                addWishlist: "{!! route('store.whislist') !!}",
                getPdf: "{!! route('book.get.pdf', ':id') !!}",
            }
        };

        // review store function

        $(".reviewStoreForm").validate({
            rules: {
                review: {
                    required: true,
                },

            },
            messages: {
                review: {
                    required: 'Please write your review',
                },


            },

            errorPlacement: function(label, element) {
                label.addClass('mt-2 text-danger');
                label.insertAfter(element);
            },
        });

        $(document).on('submit', '.reviewStoreForm', function(e) {
            e.preventDefault();
            $.ajax({
                url: "{!! route('store.review') !!}",
                method: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function(response) {

                    if (response.success == true) {
                        location.reload();
                    } else {

                    }
                }, //success end
                error: function(error) {
                    if (error.status == 422) {
                        $.each(error.responseJSON.errors, function(i, message) {
                            $('.reviewStoreForm').after(`
                            <div class="alert mt-5 text-center alert-danger alert-dismissible fade show" role="alert">
                                <strong>${message}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                            `);
                        });

                    }
                },
            });
        })

        // add to wishlist   
        function addToWishlist(id) {
            $.ajax({
                url: "{!! route('store.whislist') !!}",
                method: "POST",
                data: {
                    id: id,
                    _token: "{{ csrf_token() }}"
                },
                dataType: "json",

                success: function(response) {
                    if (response.success == true) {
                        $('.whislistCounter').html(response.data.whislist);
                        toastr["success"](response.data.message);
                    }
                },
                error: function(error) {
                    if (error.status == 404) {
                        toastr["error"]('Something went wrong');
                    } else if (error.status == 401) {
                        toastr["error"]('Please login to continue');
                    }
                },
            });
        }

        // social share
        function shareToFacebook() {
            $('.fa-facebook-square').trigger('click');
        }

        function shareToTwitter() {
            $('.fa-twitter').trigger('click');
        }

        function shareToLinkedin() {
            $('.fa-linkedin').trigger('click');
        }

        function shareToWhatsapp() {
            $('.fa-whatsapp').trigger('click');
        }

        function share() {
            $('#shareModal').modal('show');
            $('.social-button').attr('target', 'blank');
        }

     // read book function
     function readBook(id) {
            var path = window.location.origin;
            var url = config.routes.getPdf;
            url = url.replace(':id', id);

            $.ajax({
                url: url,
                method: "get",
                data: {
                    _token: "{{ csrf_token() }}"
                },
                dataType: "json",
                success: function(response) {
                    if (response.success == true) {
                        PDFObject.embed(path + "/pdfs/" + response.data, ".pdf_viewer");
                        $('#pdfModal').modal('show');
                    } else if (response.success == false) {
                        toastr["error"](response.data);

                    }
                }, //success end
                error: function(error) {
                    if (error.status == 404) {
                        toastr["error"]('Data not found');
                    }
                },

            }); //ajax end

        }   
    </script>
@endsection
