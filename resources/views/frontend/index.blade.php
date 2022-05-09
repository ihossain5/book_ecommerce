@extends('layouts.frontend.master')
@section('title', 'Home')

@section('page-css')
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/home.css') }}">

    <style>
        .atpb_wrapper {
            position: absolute;
            top: -1.2rem;
            right: -1.2rem;
            width: 2.4rem;
            height: 2.4rem;
            border-radius: 50%;
            background: black;
            z-index: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1px;
        }

        .atp.btn-close {
            background: url(frontend/assets/images/icons/close.svg);
            background: transparent url(frontend/assets/images/icons/close.svg) center/1em auto no-repeat;
            width: 1.6rem;
            height: 1.6rem;
            opacity: 1;
        }

        .atp.btn-close:focus {
            box-shadow: none;
        }

    </style>
@endsection

@section('content')

    @include('partial.frontend.banner_slider')

    <!-- popular books -->
    <section class="popular_topics_section">
        <div class="container">
            <div class="sc_title_wrapper">
                <h1 class="sc_title">জনপ্রিয় বিষয়</h1>
                <div class="btn_box d-none d-lg-block">
                    <a href="{{ route('frontend.topics') }}" class="btn_more">
                        সব দেখুন
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="none">
                            <path d="M2.5 6H9.5" stroke="black" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path d="M6 2.5L9.5 6L6 9.5" stroke="black" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </a>
                </div>
            </div>
            <div class="book_card_with_bg_section">
                <div class="row row-cols-2 row-cols-sm-2 row-cols-md-2 row-cols-lg-3 row-cols-xl-5">
                    @if (!empty($featureCategories))
                        @foreach ($featureCategories as $category)
                            <div class="col">
                                <div class="card_with_bg">
                                    <div class="circle_bg">
                                        <a href="{{ route('frontend.topics.name', [$category->category_id]) }}"
                                            class="d-block text-reset">
                                            <img src="{{ asset('images/' . $category->photo) }}" alt="">
                                        </a>

                                    </div>
                                    <h6>
                                        <a href="{{route('frontend.topics.name',[$category->category_id])}}" class="text-reset">{{ $category->name }}</a>    
                                    </h6>
                                </div>
                            </div>
                        @endforeach
                    @endif


                </div>
            </div>

            <div class="btn_box_smd d-lg-none">
                <a href="{{ route('frontend.topics') }}" class="btn_more">
                    সব দেখুন
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="none">
                        <path d="M2.5 6H9.5" stroke="black" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M6 2.5L9.5 6L6 9.5" stroke="black" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </a>
            </div>
        </div>
    </section>



    <!-- new published books -->
    
    <section class="new_published_book_section pt-120">
        <div class="container">
            <div class="sc_title_wrapper">
                <h1 class="sc_title">নতুন প্রকাশিত বই</h1>
                <div class="btn_box d-none d-lg-block">
                    <a href="{{ route('frontend.books') }}" class="btn_more">
                        সব দেখুন
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="none">
                            <path d="M2.5 6H9.5" stroke="black" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path d="M6 2.5L9.5 6L6 9.5" stroke="black" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
        <div class="new_published_carousel_wrapper">
            <div class="container">
                <div class="new_published_book_carousel owl-carousel control_design">
                    @if (!empty($books))
                        @foreach ($books as $key => $book)
                            <div class="item">
                                <div class="new_published_card">
                                    <div class="image_wrapper">
                                        <a href="{{ route('frontend.book.details', [$book->book_id]) }}"
                                            class="d-block text-reset">
                                            <img class="img-fluid w-100" src="{{ asset('images/' . $book->cover_image) }}"
                                                alt="book image">
                                        </a>
                                        <div class="npb_hoberable">
                                            <button class="addtocart" onclick="addToCart({{ $book->book_id }})">Add to cart</button>
                                        </div>
                                    </div>
                                    <div class="content_wrapper book_card_content">
                                        @if ($book->discounted_percentage != null || $book->discounted_percentage != 0)
                                            <div class="red_tag">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="49" height="49"
                                                    viewBox="0 0 49 49" fill="none">
                                                    <path
                                                        d="M23.7645 0.798398C24.1606 0.368447 24.8394 0.368447 25.2355 0.798399L29.1564 5.05469C29.4184 5.33912 29.821 5.44698 30.1901 5.33167L35.7138 3.60607C36.2718 3.43175 36.8597 3.77117 36.9878 4.34156L38.2552 9.98808C38.3399 10.3654 38.6346 10.6601 39.0119 10.7448L44.6584 12.0122C45.2288 12.1403 45.5682 12.7282 45.3939 13.2862L43.6683 18.8099C43.553 19.179 43.6609 19.5816 43.9453 19.8436L48.2016 23.7645C48.6316 24.1606 48.6316 24.8394 48.2016 25.2355L43.9453 29.1564C43.6609 29.4184 43.553 29.821 43.6683 30.1901L45.3939 35.7138C45.5682 36.2718 45.2288 36.8597 44.6584 36.9878L39.0119 38.2552C38.6346 38.3399 38.3399 38.6346 38.2552 39.0119L36.9878 44.6584C36.8597 45.2288 36.2718 45.5682 35.7138 45.3939L30.1901 43.6683C29.821 43.553 29.4184 43.6609 29.1564 43.9453L25.2355 48.2016C24.8394 48.6316 24.1606 48.6316 23.7645 48.2016L19.8436 43.9453C19.5816 43.6609 19.179 43.553 18.8099 43.6683L13.2862 45.3939C12.7282 45.5682 12.1403 45.2288 12.0122 44.6584L10.7448 39.0119C10.6601 38.6346 10.3654 38.3399 9.98808 38.2552L4.34156 36.9878C3.77117 36.8597 3.43175 36.2718 3.60607 35.7138L5.33167 30.1901C5.44698 29.821 5.33912 29.4184 5.05469 29.1564L0.798398 25.2355C0.368447 24.8394 0.368447 24.1606 0.798399 23.7645L5.05469 19.8436C5.33912 19.5816 5.44698 19.179 5.33167 18.8099L3.60607 13.2862C3.43175 12.7282 3.77117 12.1403 4.34156 12.0122L9.98808 10.7448C10.3654 10.6601 10.6601 10.3654 10.7448 9.98808L12.0122 4.34156C12.1403 3.77117 12.7282 3.43175 13.2862 3.60607L18.8099 5.33167C19.179 5.44698 19.5816 5.33912 19.8436 5.05469L23.7645 0.798398Z"
                                                        fill="#D20202" />
                                                </svg>
                                                <p>{{ $book->discounted_percentage }}%</p>
                                            </div>
                                        @endif

                                        <h3 class="title">
                                            <a href="{{ route('frontend.book.details', [$book->book_id]) }}" class="text-reset">{{ $book->title }}</a>
                                        </h3>
                                        <p class="author">
                                            @foreach ($book->authors as $author)
                                            <a href="{{ route('frontend.author.details', [$author->author_id]) }}" class="text-reset">{{ $author->name }} @if (!$loop->last) , @endif</a>
                                            @endforeach

                                        </p>

                                        <div class="price_wrapper">
                                            @if ($book->discounted_percentage != null || $book->discounted_percentage != 0)
                                                <h6 class="discount">{{ englishTobangla($book->regular_price) }}
                                                    টাকা
                                                </h6>
                                                <h5 class="regular">{{ englishTobangla($book->discounted_price) }}
                                                    টাকা</h5>
                                            @else
                                                <h5 class="regular">{{ englishTobangla($book->discounted_price) }}
                                                    টাকা</h5>
                                            @endif
                                        </div>
                                        <a href="{{ route('frontend.book.details', [$book->book_id]) }}"
                                            class="btn_buy_now">বিস্তারিত</a>
                                            <div class="addtocart_smallview">
                                                <button class="addtocart" onclick="addToCart({{ $book->book_id }})">Add to cart</button>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>

        <div class="container d-lg-none">
            <div class="btn_box_smd">
                <a href="{{ route('frontend.books') }}" class="btn_more">
                    সব দেখুন
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="none">
                        <path d="M2.5 6H9.5" stroke="black" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M6 2.5L9.5 6L6 9.5" stroke="black" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </a>
            </div>
        </div>
    </section>



    <!-- most selling books -->
    <section class="most_selling_book_section">
        <div class="container">
            <div class="sc_title_wrapper">
                <h1 class="sc_title">সর্বাধিক বিক্রিত বই</h1>
                <div class="btn_box d-none d-lg-block">
                    <a href="{{ route('frontend.more.sell.books') }}" class="btn_more">
                        সব দেখুন
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="none">
                            <path d="M2.5 6H9.5" stroke="black" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path d="M6 2.5L9.5 6L6 9.5" stroke="black" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
        <div class="most_selling_carousel_wrapper">
            <div class="container">
                <div class="most_selling_book_carousel common_carousel owl-carousel control_design">
                    @if (!empty($popularBooks))
                        @foreach ($popularBooks as $key => $popularBook)
                            @if ($popularBook->counted_order > 0)
                                <div class="item">
                                    <div class="book_card_wrapper">
                                        <div class="image_wrapper">
                                            <a href="{{ route('frontend.book.details', [$popularBook->book_id]) }}"
                                                class="d-block text-reset">
                                                <img class="img-fluid w-100"
                                                    src="{{ asset('images/' . $popularBook->cover_image) }}"
                                                    alt="book image">
                                            </a>
                                            <div class="npb_hoberable">
                                                <button class="addtocart" onclick="addToCart({{ $popularBook->book_id }})">Add to cart</button>
                                            </div>
                                            @if ($popularBook->discounted_percentage != null || $popularBook->discounted_percentage != 0)
                                                <div class="red_tag">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="49" height="49"
                                                        viewBox="0 0 49 49" fill="none">
                                                        <path
                                                            d="M23.7645 0.798398C24.1606 0.368447 24.8394 0.368447 25.2355 0.798399L29.1564 5.05469C29.4184 5.33912 29.821 5.44698 30.1901 5.33167L35.7138 3.60607C36.2718 3.43175 36.8597 3.77117 36.9878 4.34156L38.2552 9.98808C38.3399 10.3654 38.6346 10.6601 39.0119 10.7448L44.6584 12.0122C45.2288 12.1403 45.5682 12.7282 45.3939 13.2862L43.6683 18.8099C43.553 19.179 43.6609 19.5816 43.9453 19.8436L48.2016 23.7645C48.6316 24.1606 48.6316 24.8394 48.2016 25.2355L43.9453 29.1564C43.6609 29.4184 43.553 29.821 43.6683 30.1901L45.3939 35.7138C45.5682 36.2718 45.2288 36.8597 44.6584 36.9878L39.0119 38.2552C38.6346 38.3399 38.3399 38.6346 38.2552 39.0119L36.9878 44.6584C36.8597 45.2288 36.2718 45.5682 35.7138 45.3939L30.1901 43.6683C29.821 43.553 29.4184 43.6609 29.1564 43.9453L25.2355 48.2016C24.8394 48.6316 24.1606 48.6316 23.7645 48.2016L19.8436 43.9453C19.5816 43.6609 19.179 43.553 18.8099 43.6683L13.2862 45.3939C12.7282 45.5682 12.1403 45.2288 12.0122 44.6584L10.7448 39.0119C10.6601 38.6346 10.3654 38.3399 9.98808 38.2552L4.34156 36.9878C3.77117 36.8597 3.43175 36.2718 3.60607 35.7138L5.33167 30.1901C5.44698 29.821 5.33912 29.4184 5.05469 29.1564L0.798398 25.2355C0.368447 24.8394 0.368447 24.1606 0.798399 23.7645L5.05469 19.8436C5.33912 19.5816 5.44698 19.179 5.33167 18.8099L3.60607 13.2862C3.43175 12.7282 3.77117 12.1403 4.34156 12.0122L9.98808 10.7448C10.3654 10.6601 10.6601 10.3654 10.7448 9.98808L12.0122 4.34156C12.1403 3.77117 12.7282 3.43175 13.2862 3.60607L18.8099 5.33167C19.179 5.44698 19.5816 5.33912 19.8436 5.05469L23.7645 0.798398Z"
                                                            fill="#D20202" />
                                                    </svg>
                                                    <p>{{ $popularBook->discounted_percentage }}%</p>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="content_wrapper book_card_content">

                                            {{-- <div class="rating">
                                <div class="rateYo ratSerialId{{ $key }}"
                                    data-user_rating="{{getTotalRating($popularBook->reviews)}}"></div>
                            </div> --}}
                                            <h3 class="title">
                                                <a href="{{ route('frontend.book.details', [$popularBook->book_id]) }}" class="text-reset">{{ $popularBook->title }}</a>
                                            </h3>
                                            <p class="author">
                                                @foreach ($popularBook->authors as $author)
                                                <a href="{{ route('frontend.author.details', [$author->author_id]) }}" class="text-reset">{{ $author->name }} @if (!$loop->last) , @endif</a>                                                    
                                                @endforeach
                                            </p>
                                            <div class="price_wrapper">
                                                @if ($popularBook->discounted_percentage != null || $popularBook->discounted_percentage != 0)
                                                    <h6 class="discount">
                                                        {{ englishTobangla($popularBook->regular_price) }} টাকা</h6>
                                                    <h5 class="regular">
                                                        {{ englishTobangla($popularBook->discounted_price) }} টাকা</h5>
                                                @else
                                                    <h5 class="regular">
                                                        {{ englishTobangla($popularBook->discounted_price) }} টাকা</h5>
                                                @endif

                                            </div>
                                            <a href="{{ route('frontend.book.details', [$popularBook->book_id]) }}"
                                                class="btn_buy_now">বিস্তারিত</a>
                                                <div class="addtocart_smallview">
                                                    <button class="addtocart" onclick="addToCart({{ $popularBook->book_id }})">Add to cart</button>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endif


                </div>
            </div>
        </div>
        <div class="container d-lg-none">
            <div class="btn_box_smd">
                <a href="{{ route('frontend.books') }}" class="btn_more">
                    সব দেখুন
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="none">
                        <path d="M2.5 6H9.5" stroke="black" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M6 2.5L9.5 6L6 9.5" stroke="black" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </a>
            </div>
        </div>

    </section>


    @if (!empty($featureCategories))
    @foreach ($featureCategories as $category)
    @if (count($category->books)>0)
        

    <section class="most_selling_book_section pt-120">
        <div class="container">
            <div class="sc_title_wrapper">
                <h1 class="sc_title">{{$category->name}}</h1>
                <div class="btn_box d-none d-lg-block">
                    <a href="{{ route('frontend.topics.name',[$category->category_id]) }}" class="btn_more">
                        সব দেখুন
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="none">
                            <path d="M2.5 6H9.5" stroke="black" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path d="M6 2.5L9.5 6L6 9.5" stroke="black" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
        <div class="most_selling_carousel_wrapper">
            <div class="container">
                <div class="most_selling_book_carousel common_carousel owl-carousel control_design">
                    @if (!empty($category->books))
                        @foreach ($category->books as $key => $popularBook)
                                <div class="item">
                                    <div class="book_card_wrapper">
                                        <div class="image_wrapper">
                                            <a href="{{ route('frontend.book.details', [$popularBook->book_id]) }}"
                                                class="d-block text-reset">
                                                <img class="img-fluid w-100"
                                                    src="{{ asset('images/' . $popularBook->cover_image) }}"
                                                    alt="book image">
                                            </a>
                                            <div class="npb_hoberable">
                                                <button class="addtocart" onclick="addToCart({{ $popularBook->book_id }})">Add to cart</button>
                                            </div>
                                            @if ($popularBook->discounted_percentage != null || $popularBook->discounted_percentage != 0)
                                                <div class="red_tag">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="49" height="49"
                                                        viewBox="0 0 49 49" fill="none">
                                                        <path
                                                            d="M23.7645 0.798398C24.1606 0.368447 24.8394 0.368447 25.2355 0.798399L29.1564 5.05469C29.4184 5.33912 29.821 5.44698 30.1901 5.33167L35.7138 3.60607C36.2718 3.43175 36.8597 3.77117 36.9878 4.34156L38.2552 9.98808C38.3399 10.3654 38.6346 10.6601 39.0119 10.7448L44.6584 12.0122C45.2288 12.1403 45.5682 12.7282 45.3939 13.2862L43.6683 18.8099C43.553 19.179 43.6609 19.5816 43.9453 19.8436L48.2016 23.7645C48.6316 24.1606 48.6316 24.8394 48.2016 25.2355L43.9453 29.1564C43.6609 29.4184 43.553 29.821 43.6683 30.1901L45.3939 35.7138C45.5682 36.2718 45.2288 36.8597 44.6584 36.9878L39.0119 38.2552C38.6346 38.3399 38.3399 38.6346 38.2552 39.0119L36.9878 44.6584C36.8597 45.2288 36.2718 45.5682 35.7138 45.3939L30.1901 43.6683C29.821 43.553 29.4184 43.6609 29.1564 43.9453L25.2355 48.2016C24.8394 48.6316 24.1606 48.6316 23.7645 48.2016L19.8436 43.9453C19.5816 43.6609 19.179 43.553 18.8099 43.6683L13.2862 45.3939C12.7282 45.5682 12.1403 45.2288 12.0122 44.6584L10.7448 39.0119C10.6601 38.6346 10.3654 38.3399 9.98808 38.2552L4.34156 36.9878C3.77117 36.8597 3.43175 36.2718 3.60607 35.7138L5.33167 30.1901C5.44698 29.821 5.33912 29.4184 5.05469 29.1564L0.798398 25.2355C0.368447 24.8394 0.368447 24.1606 0.798399 23.7645L5.05469 19.8436C5.33912 19.5816 5.44698 19.179 5.33167 18.8099L3.60607 13.2862C3.43175 12.7282 3.77117 12.1403 4.34156 12.0122L9.98808 10.7448C10.3654 10.6601 10.6601 10.3654 10.7448 9.98808L12.0122 4.34156C12.1403 3.77117 12.7282 3.43175 13.2862 3.60607L18.8099 5.33167C19.179 5.44698 19.5816 5.33912 19.8436 5.05469L23.7645 0.798398Z"
                                                            fill="#D20202" />
                                                    </svg>
                                                    <p>{{ $popularBook->discounted_percentage }}%</p>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="content_wrapper book_card_content">
                                            <h3 class="title">
                                                <a href="{{ route('frontend.book.details', [$popularBook->book_id]) }}" class="text-reset">{{ $popularBook->title }}</a>
                                            </h3>
                                            <p class="author">
                                                @foreach ($popularBook->authors as $author)
                                                <a href="{{ route('frontend.author.details', [$author->author_id]) }}" class="text-reset">{{ $author->name }} @if (!$loop->last) , @endif</a>                                                    
                                                @endforeach
                                            </p>
                                            <div class="price_wrapper">
                                                @if ($popularBook->discounted_percentage != null || $popularBook->discounted_percentage != 0)
                                                    <h6 class="discount">
                                                        {{ englishTobangla($popularBook->regular_price) }} টাকা</h6>
                                                    <h5 class="regular">
                                                        {{ englishTobangla($popularBook->discounted_price) }} টাকা</h5>
                                                @else
                                                    <h5 class="regular">
                                                        {{ englishTobangla($popularBook->discounted_price) }} টাকা</h5>
                                                @endif

                                            </div>
                                            <a href="{{ route('frontend.book.details', [$popularBook->book_id]) }}"
                                                class="btn_buy_now">বিস্তারিত</a>
                                                <div class="addtocart_smallview">
                                                    <button class="addtocart" onclick="addToCart({{ $popularBook->book_id }})">Add to cart</button>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                        @endforeach
                    @endif


                </div>
            </div>
        </div>


    </section>
    @endif
    @endforeach
    @endif
    <!-- writers -->
    <section class="writer_section_slider pt-120 pb-56">
        <div class="container">
            <div class="sc_title_wrapper">
                <h1 class="sc_title">লেখক </h1>
                <div class="btn_box d-none d-lg-block">
                    <a href="{{ route('frontend.authors') }}" class="btn_more">
                        সব লেখকদের দেখুন
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="none">
                            <path d="M2.5 6H9.5" stroke="black" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path d="M6 2.5L9.5 6L6 9.5" stroke="black" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
        <div class="writers_carousel_wrapper">
            <div class="container">
                <div class="writers_carousel common_carousel owl-carousel">
                    @if (!empty($authors))
                        @foreach ($authors as $author)
                            <div class="item">
                                <div class="writer_content">
                                    <a href="{{ route('frontend.author.details', [$author->author_id]) }}"
                                        class="d-block tex-reset">
                                        <div class="writer_img_wrapper">
                                            <img class="img-fluid w-100" src="{{ asset('images/' . $author->photo) }}"
                                                alt="Card image">
                                        </div>

                                        <h3 class="card_text">
                                            <a class="text-reset" href="{{ route('frontend.author.details', [$author->author_id]) }}">{{ $author->name }}</a>
                                            
                                        </h3>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    @endif


                </div>
            </div>
        </div>
        <div class="container d-lg-none">
            <div class="btn_box_smd">
                <a href="{{ route('frontend.authors') }}" class="btn_more">
                    সব লেখকদের দেখুন
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="none">
                        <path d="M2.5 6H9.5" stroke="black" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M6 2.5L9.5 6L6 9.5" stroke="black" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- Searvices Section -->
    {{-- <section class="searvices_section py-120">
    <div class="container">
        <div class="searvices">
            <div class="row">
                <div class="col-lg-3">
                    <div class="searvices_content">
                        <img class="Service_img" src="{{ asset('frontend/assets/images/home/customer-support.svg') }}"
                            alt="social-media-image">
                        <h3 class="Service_text">Quality Service</h3>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="searvices_content">
                        <img class="Service_img" src="{{ asset('frontend/assets/images/home/cash-on-delivery.svg') }}"
                            alt="social-media-image">
                        <h3 class="Service_text">Cash On Delivery</h3>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="searvices_content">
                        <img class="Service_img" src="{{ asset('frontend/assets/images/home/tracking.svg') }}"
                            alt="social-media-image">
                        <h3 class="Service_text">Track Order</h3>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="searvices_content">
                        <img class="Service_img" src="{{ asset('frontend/assets/images/home/purchase.svg') }}"
                            alt="social-media-image">
                        <h3 class="Service_text">Happy Return</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> --}}

    <!-- Searvices Section -->
    <section class="searvices_section py-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="searvices">
                        <div class="searvices_content">
                            <img class="Service_img" src="{{ asset('frontend/assets/images/home/Servicee 1.svg') }}"
                                alt="social-media-image">
                            <h3 class="Service_text">উন্নত সেবা</h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="searvices">

                        <div class="searvices_content">
                            <img class="Service_img" src="{{ asset('frontend/assets/images/home/COD 1.svg') }}"
                                alt="social-media-image">
                            <h3 class="Service_text">ক্যাশ অন ডেলিভারি</h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="searvices">
                        <div class="searvices_content">
                            <img class="Service_img"
                                src="{{ asset('frontend/assets/images/home/Track Order 1.svg') }}"
                                alt="social-media-image">
                            <h3 class="Service_text">অর্ডার ট্র্যাকিং</h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="searvices">
                        <div class="searvices_content">
                            <img class="Service_img" src="{{ asset('frontend/assets/images/home/Box 1.svg') }}"
                                alt="social-media-image">
                            <h3 class="Service_text">সন্তোষজনক অভিজ্ঞতা</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    @include('partial.frontend.discountModal')

@endsection
@section('page-js')
    {{-- {{ asset('frontend/') }} --}}
    <script src="{{ asset('frontend/assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/banner-carousel-activation.js') }}"></script>
    <script>
        $('.new_published_book_carousel').owlCarousel({
            autoplay: true,
            rewind: true,
            margin: 10,
            dots: false,
            nav: true,
            navText: [
                '<img src="{{ asset('frontend/assets/images/icons/chevron-left-black.svg') }}" alt="chevron-left-black">',
                '<img src="{{ asset('frontend/assets/images/icons/chevron-right-black.svg') }}" alt="chevron-right-black">'
            ],
            responsive: {
                0: {
                    items: 1,
                    dots: true,
                    nav: false,
                },
                992: {
                    items: 2
                },
                1200: {
                    items: 3
                },
                1600: {
                    items: 4
                }
            }
        })

        $('.common_carousel').owlCarousel({
            autoplay: true,
            rewind: true,
            margin: 0,
            dots: false,
            nav: true,
            navText: [
                '<img src="{{ asset('frontend/assets/images/icons/chevron-left.svg') }}" alt="chevron-left">',
                '<img src="{{ asset('frontend/assets/images/icons/chevron-right.svg') }}" alt="chevron-left">'
            ],
            responsive: {
                0: {
                    items: 2,
                    dots: true
                },
                768: {
                    items: 2,
                },
                1200: {
                    items: 4
                },
                1366: {
                    items: 5,
                },
                1600: {
                    items: 6
                }
            }
        })
    </script>
@endsection
