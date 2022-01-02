@extends('layouts.frontend.master')
@section('title', 'Book Details')

@section('page-css')
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/book-details.css') }}">
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
                                <button class="read_something_btn"><img
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
                                    <div class="rating ratingDetails ratingId0" data-rating="{{$rating}}"></div>
                                    <div>
                                        <span>({{ englishTobangla($rating) }} / ({{ englishTobangla($book->reviews->count()) }}টি রিভিউ)</span>
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
                            </div>

                            <div class="book_add_btn">
                                <button onclick="addToWishlist({{ $book->book_id }})"><img
                                        src="{{ asset('frontend/assets/images/icons/favorite_border_black_24dp 1.svg') }}"
                                        alt=""></button>
                                <button onclick="addToCart({{ $book->book_id }})"><img
                                        src="{{ asset('frontend/assets/images/icons/shopping_cart_black_24dp (1).svg') }}"
                                        alt=""></button>
                                <button><img src="{{ asset('frontend/assets/images/icons/share_black_24dp 1.svg') }}"
                                        alt=""></button>
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
                        <h1>পিতা</h1>
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
                            <div class="rating ratingId0" data-rating="{{$rating}}"></div>
                            <div>
                                <span>({{ englishTobangla($rating) }} / ({{ englishTobangla($book->reviews->count()) }}টি রিভিউ)</span>
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
                                            <a href="#">
                                                @foreach ($book->authors as $author)
                                                    {{ $author->name }} @if (!$loop->last) , @endif
                                                @endforeach

                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Publisher</td>
                                        <td>
                                            <a href="#">
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
            <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-5">
                @if (!empty($related_books))
                    @foreach ($related_books as $related_book)
                        <div class="col">
                            <div class="book_card_wrapper">
                                <div class="image_wrapper">
                                    <a href="{{ route('frontend.book.details', [$related_book->book_id]) }}"
                                        class="d-block text-reset">
                                        <img class="img-fluid w-100"
                                            src="{{ asset('images/' . $related_book->cover_image) }}" alt="book image">
                                    </a>
                                </div>
                                <div class="content_wrapper book_card_content">
                                    <div class="rating">
                                        <div class="rateYo"></div>
                                    </div>
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
                                        class="btn_buy_now">Buy Now</a>
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
            <div class="rating_box">
                <h3>রিভিউস এবং রেটিংস</h3>
            </div>

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
                                        <div class="userRating ratSerialId{{ $key }}"
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

@endsection
@section('page-js')
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.js"></script>
    <script src="{{ asset('frontend/assets/js/owl.carousel.min.js') }}"></script>

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

                $(`.ratSerialId${i}`).rateYo({
                    starWidth: "22px",
                    ratedFill: "#F2C94C",
                    normalFill: "none",
                    rating: $(`.ratSerialId${i}`).data('user_rating'),
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

        // ratin >> rateyo acitvation
        $(".rateYo").rateYo({
            starWidth: "20px",
            normalFill: "none",
            ratedFill: "#F2C94C",
            rating: 4,
            readOnly: true,
            starSvg: `<svg xmlns="http://www.w3.org/2000/svg" width="20" height="19" viewBox="0 0 20 19" fill="none">
  <path d="M10 1.34175L12.1223 6.62665L12.2392 6.91794L12.5524 6.93918L18.2345 7.32445L13.8641 10.976L13.6232 11.1772L13.6998 11.4817L15.0892 17.0047L10.2659 13.9765L10 13.8096L9.73415 13.9765L4.91081 17.0047L6.30024 11.4817L6.37683 11.1772L6.13594 10.976L1.76551 7.32445L7.44757 6.93918L7.76076 6.91794L7.87773 6.62665L10 1.34175Z" stroke="#F2C94C"/>
  </svg>`
        });

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
                url: config.routes.store,
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
                type: "POST",
                url: config.routes.addWishlist,
                data: {
                    id: id,
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'JSON',
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
    </script>
@endsection
