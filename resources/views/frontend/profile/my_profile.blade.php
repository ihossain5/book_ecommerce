@extends('layouts.frontend.master')
@section('title', 'Profile')

@section('page-css')

    <link rel="stylesheet" href="{{ asset('frontend/assets/css/my-profile.css') }}">
@endsection

@section('content')
    <section class="my_profile_section pt-20 pb-120">
        <div class="container">

            {{-- <button class="btn btn-primary" onclick="menu3()">go to menu 3</button> --}}

            <div class="upload-picture">
                <div class="upload-picture-inner">
                    <label for="fileUpload">
                        @if ($user_info->image == null)
                            <img src="{{ asset('frontend/assets/images/profile/profile-pic-editable.png') }}"
                                alt="upload-image" id="uplodedImg">
                        @else
                            <img src="{{ asset('images/' . $user_info->image) }}" alt="upload-image" id="uplodedImg">
                        @endif

                        <div class="edit-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="13" height="12" viewBox="0 0 13 12" fill="none">
                                <path
                                    d="M7.37333 4.01333L7.98667 4.62667L1.94667 10.6667H1.33333V10.0533L7.37333 4.01333ZM9.77333 0C9.60667 0 9.43333 0.0666666 9.30667 0.193333L8.08667 1.41333L10.5867 3.91333L11.8067 2.69333C12.0667 2.43333 12.0667 2.01333 11.8067 1.75333L10.2467 0.193333C10.1133 0.06 9.94667 0 9.77333 0ZM7.37333 2.12667L0 9.5V12H2.5L9.87333 4.62667L7.37333 2.12667Z"
                                    fill="white" />
                            </svg>
                        </div>
                    </label>

                    <form method="POST" id="imageUpdateForm">@csrf
                        <input type="file" class="form-control-file" id="fileUpload" name="photo" accept="image/*">
                    </form>
                </div>
            </div>

            <div class="my_profile_body">
                <div>
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs justify-content-between" id="myTab" role="tablist">
                        <li role="presentation">
                            <a class=" active" id="personal_info-tab" data-bs-toggle="tab"
                                data-bs-target="#personal_info" type="button" role="tab" aria-controls="personal_info"
                                aria-selected="true">ব্যক্তিগত তথ্য</a>
                        </li>
                        <li role="presentation">
                            <a class="" id="area_info-tab" data-bs-toggle="tab" data-bs-target="#area_info"
                                type="button" role="tab" aria-controls="area_info" aria-selected="false">আমার ঠিকানা</a>
                        </li>
                        <li role="presentation">
                            <a class="" id="order_info-tab" data-bs-toggle="tab" data-bs-target="#order_info"
                                type="button" role="tab" aria-controls="order_info" aria-selected="false">পুরোনো
                                অর্ডার</a>
                        </li>
                        <li role="presentation">
                            <a class="wishlistTab" id="settings-tab" data-bs-toggle="tab"
                                data-bs-target="#settings" type="button" role="tab" aria-controls="settings"
                                aria-selected="false">পছন্দের তালিকা</a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="personal_info">
                            <form id="edit_profile_form">
                                @csrf
                                <div class="input_fild">
                                    <label>নাম</label>
                                    <input type="text" class="form-control" placeholder="আপনার নাম" name="name"
                                        value="{{ $user_info->name }}">
                                </div>
                                <div class="input_fild">
                                    <label>ফোন নম্বর</label>
                                    <input type="text" class="form-control" placeholder="আপনার ফোন নম্বর" name="phone"
                                        value="{{ $user_info->phone }}">
                                </div>
                                <div class="input_fild">
                                    <label>ইমেইল অ্যাড্রেস</label>
                                    <input type="email" class="form-control" placeholder="আপনার ইমেইল অ্যাড্রেস"
                                        name="email" value="{{ $user_info->email }}">
                                </div>

                                <div class="input_fild">
                                    <label>জন্ম তারিখ</label>
                                    <input type="text" class="form-control" placeholder="আপনার জন্ম তারিখ" name="dob"
                                        value="{{ $user_info->date_of_birth }}">
                                </div>

                                {{-- <a href="" class="submit_btn">সেভ করুন</a> --}}

                                <button type="submit" class="submit_btn">সেভ করুন</button>

                            </form>
                        </div>
                        <div role="tabpanel" class="tab-pane " id="area_info">
                            <ul class="my_address_details" id="user_address_list">
                                @if (!empty($user_info->addresses))
                                    @foreach ($user_info->addresses as $address)
                                        <li class="address_loc_details address_id{{ $address->address_id }}">
                                            <div class="address_loc_desc">
                                                <p class="address_loc"><span>বিভাগ: </span>{{ $address->division }}</p>
                                                <p class="address_loc"><span>জেলা: </span>{{ $address->district }}</p>
                                                <p class="address_loc"><span>ঠিকানা: </span>{{ $address->address }}
                                                </p>
                                                <p class="address_loc"><span>মোবাইল: </span>{{ $address->mobile }}</p>
                                            </div>
                                            <div class="address_loc_edit">
                                                <div class="form-check">
                                                    @if ($address->pivot->is_default == 1)
                                                        <input class="form-check-input" type="checkbox"
                                                            name="permanent_address" value=""
                                                            onclick="primaryAddress({{ $address->address_id }})" checked>
                                                    @else
                                                        <input class="form-check-input" type="checkbox"
                                                            name="permanent_address" value=""
                                                            onclick="primaryAddress({{ $address->address_id }})">
                                                    @endif

                                                    <label class="form-check-label"> প্রাথমিক ঠিকানা </label>
                                                </div>
                                                <div class="address_loc_buttons">

                                                    <button type="button" class="edit address_info"
                                                        data-id="{{ $address->address_id }}">

                                                        <button class="delete"
                                                            onclick="deleteAddress({{ $address->address_id }})"></button>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                            <button type="button" class="submit_btn" data-bs-toggle="modal"
                                data-bs-target="#addNewAddressModal">নতুন ঠিকানা যোগ করুন</button>

                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">ঠিকানা পরিবর্তন করুন</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="edit_address_modal">
                                            @csrf
                                            <div class="container">
                                                <div class="row">
                                                    <input type="hidden" id="address_id" name="address_id">
                                                    <div class="col-12 text-center circular">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input " type="radio"
                                                                name="isInsideDhaka" id="select_dhaka" value="1">
                                                            <label class="form-check-label" for="inlineRadio1">ঢাকা
                                                                সিটি</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio"
                                                                name="isInsideDhaka" id="unselect_dhaka" value="0">
                                                            <label class="form-check-label" for="inlineRadio2">ঢাকা সিটির
                                                                বাইরে</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-lg-6 col-sm-12 col-12 cols">
                                                        <div class="input_fild_modal">
                                                            <label>নাম</label>
                                                            <input type="text" class="form-control" id="modal_name"
                                                                placeholder="আপনার নাম" name="modal_name">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-lg-6 col-sm-12 col-12 cols">
                                                        <div class="input_fild_modal">
                                                            <label>ফোন নম্বর</label>
                                                            <input type="text" class="form-control" id="modal_phone"
                                                                placeholder="আপনার ফোন নম্বর" name="modal_phone">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-lg-6 col-sm-12 col-12 cols">
                                                        <label>বিভাগ</label>
                                                        <input type="text" class="form-control" id="modal_district"
                                                            placeholder="আপনার বিভাগ" name="modal_division">
                                                    </div>
                                                    <div class="col-md-6 col-lg-6 col-sm-12 col-12 cols">
                                                        <label>এরিয়া</label>
                                                        <input type="text" class="form-control" id="modal_area"
                                                            placeholder="আপনার এরিয়া" name="modal_district">
                                                    </div>
                                                    <div class="col-12 cols">
                                                        <div class="input_fild_modal d-block">
                                                            <label>ঠিকানা</label>
                                                            <textarea placeholder="আপনার ঠিকানা" id="modal_address"
                                                                class="form-control" name="modal_address"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" class="submit_btn">সেভ করুন</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Add Address Modal -->
                        <div class="modal fade" id="addNewAddressModal" tabindex="-1" aria-labelledby="addNewAddress"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addNewAddressModal">নতুন ঠিকানা যোগ করুন</h5>
                                        <button type="button" class="btn-close" id="addAddressModalClose"
                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="new_address_model">
                                            @csrf
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-12 text-center circular">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input " type="radio"
                                                                name="is_inside_dhaka" value="1">
                                                            <label class="form-check-label" for="inlineRadio1">ঢাকা
                                                                সিটি</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio"
                                                                name="is_inside_dhaka" value="0">
                                                            <label class="form-check-label" for="inlineRadio2">ঢাকা সিটির
                                                                বাইরে</label>
                                                        </div>
                                                        <label id="is_inside_dhaka-error" class="error mt-2 text-danger"
                                                            for="is_inside_dhaka"></label>
                                                    </div>

                                                    <div class="col-md-6 col-lg-6 col-sm-12 col-12 cols">
                                                        <div class="input_fild_modal">
                                                            <label>নাম</label>
                                                            <input type="text" class="form-control"
                                                                placeholder="আপনার নাম" name="modal_new_name">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-lg-6 col-sm-12 col-12 cols">
                                                        <div class="input_fild_modal">
                                                            <label>ফোন নম্বর</label>
                                                            <input type="text" class="form-control"
                                                                placeholder="আপনার ফোন নম্বর" name="modal_new_phone">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-lg-6 col-sm-12 col-12 cols">
                                                        <input type="text" class="form-control" placeholder="আপনার বিভাগ"
                                                            name="modal_new_division">
                                                    </div>
                                                    <div class="col-md-6 col-lg-6 col-sm-12 col-12 cols">
                                                        <input type="text" class="form-control" placeholder="আপনার এরিয়া"
                                                            name="modal_new_district">
                                                    </div>
                                                    <div class="col-12 cols">
                                                        <div class="input_fild_modal d-block">
                                                            <label>ঠিকানা</label>
                                                            <textarea placeholder="আপনার ঠিকানা" class="form-control"
                                                                name="modal_new_address"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" class="submit_btn">সেভ করুন</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="order_info">
                            <ul class="orders_lists">
                                @if (!empty($user_orders))
                                    @foreach ($user_orders as $user_order)
                                        <li class="order_details" onclick="order_view({{ $user_order->order_id }})" style="cursor:pointer">
                                            <div class="code_and_delevery">
                                                {{-- <p class="order_code">অর্ডার কোডঃ
                                                    <span>#{{ $user_order->id }}</span>
                                                </p> --}}

                                                <p class="order_code" >অর্ডার কোডঃ <span >#{{ $user_order->id }}</span></p>

                                                @if ($user_order->order_status_id == 1)
                                                    <h3 class="order_sign panding">পেন্ডিং</h3>
                                                @elseif ($user_order->order_status_id == 2)
                                                    <h3 class="order_sign delevery">ডেলিভারিং</h3>
                                                @elseif($user_order->order_status_id == 3)
                                                    <h3 class="order_sign delevery">কমপ্লিট</h3>
                                                @else
                                                    <h3 class="order_sign panding">ক্যানসেল</h3>
                                                @endif

                                            </div>
                                            <div class="price_date">
                                                <h3 class="order_price">মোট {{ englishTobangla($user_order->total) }}
                                                    টাকা</h3>
                                                <p class="order_date">{{ banglaDate($user_order->created_at) }}</p>
                                            </div>
                                        </li>
                                    @endforeach
                                @endif
                                @if ($user_orders->isEmpty())
                                    <div class="col offset-4">
                                        <h1 class="">অর্ডার নেই</h1>
                                    </div>
                                @endif
                            </ul>

                        </div>
                        <div role="tabpanel" class="tab-pane books_choice" id="settings">
                            <section class="book_cards_section">
                                <div class="container ">
                                    <div class="row row-cols-2 row-cols-sm-2 row-cols-md-3  g-0">

                                        {{-- <div class="col">
                                        <div class="book_card_wrapper">
                                            <div class="image_wrapper">
                                                <a href="book-details.html" class="d-block text-reset">
                                                    <img class="img-fluid w-100" src="{{ asset('frontend/assets/images/books/book-img-1.png') }}" alt="book image">
                                                </a>
                                                <div class="red_tag">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="49" height="49"
                                                        viewBox="0 0 49 49" fill="none">
                                                        <path
                                                            d="M23.7645 0.798398C24.1606 0.368447 24.8394 0.368447 25.2355 0.798399L29.1564 5.05469C29.4184 5.33912 29.821 5.44698 30.1901 5.33167L35.7138 3.60607C36.2718 3.43175 36.8597 3.77117 36.9878 4.34156L38.2552 9.98808C38.3399 10.3654 38.6346 10.6601 39.0119 10.7448L44.6584 12.0122C45.2288 12.1403 45.5682 12.7282 45.3939 13.2862L43.6683 18.8099C43.553 19.179 43.6609 19.5816 43.9453 19.8436L48.2016 23.7645C48.6316 24.1606 48.6316 24.8394 48.2016 25.2355L43.9453 29.1564C43.6609 29.4184 43.553 29.821 43.6683 30.1901L45.3939 35.7138C45.5682 36.2718 45.2288 36.8597 44.6584 36.9878L39.0119 38.2552C38.6346 38.3399 38.3399 38.6346 38.2552 39.0119L36.9878 44.6584C36.8597 45.2288 36.2718 45.5682 35.7138 45.3939L30.1901 43.6683C29.821 43.553 29.4184 43.6609 29.1564 43.9453L25.2355 48.2016C24.8394 48.6316 24.1606 48.6316 23.7645 48.2016L19.8436 43.9453C19.5816 43.6609 19.179 43.553 18.8099 43.6683L13.2862 45.3939C12.7282 45.5682 12.1403 45.2288 12.0122 44.6584L10.7448 39.0119C10.6601 38.6346 10.3654 38.3399 9.98808 38.2552L4.34156 36.9878C3.77117 36.8597 3.43175 36.2718 3.60607 35.7138L5.33167 30.1901C5.44698 29.821 5.33912 29.4184 5.05469 29.1564L0.798398 25.2355C0.368447 24.8394 0.368447 24.1606 0.798399 23.7645L5.05469 19.8436C5.33912 19.5816 5.44698 19.179 5.33167 18.8099L3.60607 13.2862C3.43175 12.7282 3.77117 12.1403 4.34156 12.0122L9.98808 10.7448C10.3654 10.6601 10.6601 10.3654 10.7448 9.98808L12.0122 4.34156C12.1403 3.77117 12.7282 3.43175 13.2862 3.60607L18.8099 5.33167C19.179 5.44698 19.5816 5.33912 19.8436 5.05469L23.7645 0.798398Z"
                                                            fill="#D20202" />
                                                    </svg>
                                                    <p>20%</p>
                                                </div>
                                            </div>
                                            <div class="content_wrapper book_card_content">
                                                <div class="rating">
                                                    <div class="rateYo"></div>
                                                </div>
                                                <h3 class="title">সেরা লেখক সেরা গল্প</h3>
                                                <p class="author">শ্যামল দত্ত</p>
                                                <div class="price_wrapper">
                                                    <h6 class="discount">২০০ টাকা</h6>
                                                    <h5 class="regular">১৮০ টাকা</h5>
                                                </div>
                                                <a href="#" class="btn_buy_now">Buy Now</a>
                                            </div>
                                        </div>
                                    </div> --}}
                                        @if (!empty(auth()->user()->wishlists))
                                            @foreach (auth()->user()->wishlists as $key=>$wishlist)
                                                <div class="col">
                                                    <div class="book_card_wrapper">
                                                        <div class="image_wrapper">
                                                            <a href="{{ route('frontend.book.details', [$wishlist->book->book_id]) }}"
                                                                class="d-block text-reset">
                                                                <img class="img-fluid w-100"
                                                                    src="{{ asset('images/' . $wishlist->book->cover_image) }}"
                                                                    alt="book image">
                                                            </a>
                                                            @if ($wishlist->book->discounted_percentage != null || $wishlist->book->discounted_percentage != 0)
                                                                <div class="red_tag">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="49"
                                                                        height="49" viewBox="0 0 49 49" fill="none">
                                                                        <path
                                                                            d="M23.7645 0.798398C24.1606 0.368447 24.8394 0.368447 25.2355 0.798399L29.1564 5.05469C29.4184 5.33912 29.821 5.44698 30.1901 5.33167L35.7138 3.60607C36.2718 3.43175 36.8597 3.77117 36.9878 4.34156L38.2552 9.98808C38.3399 10.3654 38.6346 10.6601 39.0119 10.7448L44.6584 12.0122C45.2288 12.1403 45.5682 12.7282 45.3939 13.2862L43.6683 18.8099C43.553 19.179 43.6609 19.5816 43.9453 19.8436L48.2016 23.7645C48.6316 24.1606 48.6316 24.8394 48.2016 25.2355L43.9453 29.1564C43.6609 29.4184 43.553 29.821 43.6683 30.1901L45.3939 35.7138C45.5682 36.2718 45.2288 36.8597 44.6584 36.9878L39.0119 38.2552C38.6346 38.3399 38.3399 38.6346 38.2552 39.0119L36.9878 44.6584C36.8597 45.2288 36.2718 45.5682 35.7138 45.3939L30.1901 43.6683C29.821 43.553 29.4184 43.6609 29.1564 43.9453L25.2355 48.2016C24.8394 48.6316 24.1606 48.6316 23.7645 48.2016L19.8436 43.9453C19.5816 43.6609 19.179 43.553 18.8099 43.6683L13.2862 45.3939C12.7282 45.5682 12.1403 45.2288 12.0122 44.6584L10.7448 39.0119C10.6601 38.6346 10.3654 38.3399 9.98808 38.2552L4.34156 36.9878C3.77117 36.8597 3.43175 36.2718 3.60607 35.7138L5.33167 30.1901C5.44698 29.821 5.33912 29.4184 5.05469 29.1564L0.798398 25.2355C0.368447 24.8394 0.368447 24.1606 0.798399 23.7645L5.05469 19.8436C5.33912 19.5816 5.44698 19.179 5.33167 18.8099L3.60607 13.2862C3.43175 12.7282 3.77117 12.1403 4.34156 12.0122L9.98808 10.7448C10.3654 10.6601 10.6601 10.3654 10.7448 9.98808L12.0122 4.34156C12.1403 3.77117 12.7282 3.43175 13.2862 3.60607L18.8099 5.33167C19.179 5.44698 19.5816 5.33912 19.8436 5.05469L23.7645 0.798398Z"
                                                                            fill="#D20202" />
                                                                    </svg>
                                                                    <p>{{ $wishlist->book->discounted_percentage }}%</p>
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <div class="content_wrapper book_card_content">
                                                            <div class="rating">
                                                                <div class="rateYo ratSerialId{{ $key }}"
                                                                    data-user_rating="{{ getTotalRating($wishlist->book->reviews) }}">
                                                                </div>
                                                            </div>
                                                            <h3 class="title">{{ $wishlist->book->title }}</h3>
                                                            <p class="author">
                                                                @if (!empty($wishlist->book->authors))
                                                                    @foreach ($wishlist->book->authors as $author)
                                                                        {{ $author->name }} @if (!$loop->last) , @endif
                                                                    @endforeach
                                                                @endif
                                                            </p>
                                                            <div class="price_wrapper">
                                                                @if ($wishlist->book->discounted_percentage != null || $wishlist->book->discounted_percentage != 0)
                                                                    <h6 class="discount">
                                                                        {{ englishTobangla($wishlist->book->regular_price) }}
                                                                        টাকা</h6>
                                                                @endif
                                                                <h5 class="regular">
                                                                    {{ englishTobangla($wishlist->book->discounted_price) }}
                                                                    টাকা</h5>
                                                            </div>
                                                            <a href="{{ route('frontend.book.details', [$wishlist->book->book_id]) }}"
                                                                class="btn_buy_now">Buy Now</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
        <!-- Order History Modal -->
        <div class="modal fade" id="orderHistoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content order-history-content">
    
                    <button class="modalCloseBtn" data-bs-dismiss="modal" aria-label="Close"><img
                            src="{{ asset('frontend/assets/images/icons/add_circle.svg') }}" alt=""></button>
                    <div class="modal-body">
                        <div class="row align-items-center pb-5">
                            <div class="col-md-6 order-header">
                                <h1>অর্ডার কোডঃ #<span id="order_id"></span></h1>
                                <h5 id="order_date"></h5>
                            </div>
                            <div class="col-md-6 text-start text-md-end" id="order_status">
                                <span class="delevery-success" id="order_status"></span>
                                <!-- <span class="delevery-pending">ডেলিভারড</span> -->
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 order-item-box">
                                <ul id="book_list">
                            
                                </ul>
                            </div>
                            <div class="col-md-6 order-price-box">
                                <ul>
                                    <li>
                                        <span>সাব টোটাল</span>
                                        <span id="order_sub_total"></span>
                                    </li>
                                    {{-- <li>
                                        <span>ভ্যাট</span>
                                        <span id="order_vat"></span>
                                    </li> --}}
                                    <li>
                                        <span>ডেলিভারি ফি</span>
                                        <span id="order_delivery"></span>
                                    </li>
                                    <li>
                                        <span>টোটাল</span>
                                        <span id="order_total"></span>
                                    </li>
                                </ul>
                            </div>
                        </div>
    
                        <div class="row">
                            <div class="col-12 special-note">
                                <h1>বিশেষ নোট</h1>
                                <h3 id="order_note"></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
@section('page-js')


    <script>
        var config = {
            routes: {
                imageUpdate: "{!! route('profile.photo.update') !!}",
                order_single: "{!! route('my.order.single') !!}",
                
            }
        };

       

        if (location.hash == '#wishlist') {
            var firstTabEl = document.querySelector('#settings-tab')
            var wishlistTab = new bootstrap.Tab(firstTabEl)

            wishlistTab.show()

        } else if (location.hash == '#orders') {
            var firstTabEl = document.querySelector('#order_info-tab')
            var order_infoTab = new bootstrap.Tab(firstTabEl)

            order_infoTab.show()
        }else if(location.hash == '#address'){
            var firstTabEl = document.querySelector('#area_info-tab')
            var addressTab = new bootstrap.Tab(firstTabEl)

            addressTab.show()
        }




        var url;
        $('#fileUpload').change(function() {
            url = window.URL.createObjectURL(this.files[0]);

            $("#imageUpdateForm").submit();
        });

        $(document).on('submit', '#imageUpdateForm', function(e) {
            e.preventDefault();

            $.ajax({
                url: config.routes.imageUpdate,
                method: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function(response) {
                    if (response.success == true) {
                        $('#uplodedImg').attr('src', url);
                        // toastr["success"](response.data.message)

                    } //success end
                },
                error: function(error) {
                    if (error.status == 404) {
                        toastr["error"](response.data.message)
                    } else if (error.status == 422) {
                        $.each(error.responseJSON.errors, function(i, message) {
                            toastr["error"](message)
                        });
                    }
                },
            }); //ajax end
        });


        $(document).ready(function() {
            $("#edit_profile_form").validate({

                rules: {
                    name: {
                        required: true,
                        maxlength: 100,
                    },
                    phone: {
                        required: true,
                        maxlength: 11,
                    },
                    email: {
                        required: true,
                        email: true,
                    },
                    dob: {
                        required: true,
                    },
                },
                messages: {
                    name: {
                        required: 'Please insert name',
                    },
                    phone: {
                        required: 'Please insert phone',
                    },
                    dob: {
                        required: 'Please insert date of birth',
                    },
                    email: {
                        required: 'Please insert email',

                    },
                },
                errorPlacement: function(label, element) {
                    label.addClass('mt-2 text-danger');
                    label.insertAfter(element);
                },
            });
        });
        //end

        $(document).off('submit', '#edit_profile_form');
        $(document).on('submit', '#edit_profile_form', function(event) {
            event.preventDefault();
            $.ajax({

                url: "{!! route('profile.update') !!}",
                method: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function(response) {

                    if (response.success == true) {

                        if (response.data.message) {

                            toastr['success'](response.data.message);
                        }
                    } else {


                    }

                }


            })
        });


        $(document).on('click', '.address_info', function() {
            var id = $(this).data('id');


            $.get('/profile/address/' + id, function(data) {
                if (data.inside_dhaka_city == 1) {
                    $("#select_dhaka").prop("checked", true);
                } else {
                    $("#unselect_dhaka").prop("checked", true);
                }



                $('#exampleModal #address_id').val(data.address_id);
                $('#exampleModal #modal_name').val(data.name);
                $('#exampleModal #modal_phone').val(data.mobile);
                $('#exampleModal #modal_district').val(data.division);
                $('#exampleModal #modal_area').val(data.district);
                $('#exampleModal #modal_address').val(data.address);
                $('#exampleModal #select_dhaka').val(data.inside_dhaka_city);

                $('#exampleModal').modal('show');

            })
        })



        $(document).ready(function() {
            $("#edit_address_modal").validate({
                rules: {
                    is_inside_dhaka: {
                        required: true,
                    },
                    modal_new_name: {
                        required: true,
                        maxlength: 100,
                    },
                    modal_new_phone: {
                        required: true,
                        maxlength: 11,
                        minlength: 11,
                        digits: true,
                    },
                    modal_new_district: {
                        required: true,
                        maxlength: 50,
                    },
                    modal_new_area: {
                        required: true,
                        maxlength: 50,
                    },
                    modal_new_address: {
                        required: true,
                        maxlength: 500,
                    },
                },
                messages: {
                    is_inside_dhaka: {
                        required: 'Please select one',
                    },
                    modal_new_name: {
                        required: 'Please insert name',
                    },
                    modal_new_phone: {
                        required: 'Please insert phone',
                    },
                    modal_new_district: {
                        required: 'Please insert division',

                    },
                    modal_new_area: {
                        required: 'Please insert area',

                    },
                    modal_new_address: {
                        required: 'Please insert address',

                    },
                },
                errorPlacement: function(label, element) {
                    label.addClass('mt-2 text-danger');
                    label.insertAfter(element);
                },
            });
        });

        $(document).off('submit', '#edit_address_modal');
        $(document).on('submit', '#edit_address_modal', function(event) {
            event.preventDefault();
            $.ajax({
                url: "{!! route('profile.address.update') !!}",
                method: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function(response) {
                    if (response.success == true) {
                        $('.address_id' + response.data.id).html(
                            `<div class="address_loc_desc">
                                    <p class="address_loc"><span>বিভাগ: </span>${response.data.division}</p>
                                    <p class="address_loc"><span>জেলা: </span>${response.data.district}</p>
                                    <p class="address_loc"><span>ঠিকানা: </span>${response.data.address}</p>
                                    <p class="address_loc"><span>মোবাইল: </span>${response.data.mobile}</p>
                                </div>
                                <div class="address_loc_edit">
                                    <div class="form-check">
                                        ${ (response.data.is_default==1?`<input class="form-check-input" type="checkbox" name="permanent_address"
                                                            value="" onclick="primaryAddress(${response.data.address_id})" checked>`:`<input class="form-check-input" type="checkbox" name="permanent_address"
                                                            value="" onclick="primaryAddress(${response.data.address_id})">`)

                                            
                                        }
                                    </div>
                                    <div class="address_loc_buttons">

                                        <button type="button" class="edit address_info"
                                            data-id="${response.data.id}">

                                            <button class="delete"
                                                onclick="deleteAddress(${response.data.id})"></button>
                                    </div>
                                </div>`
                        );

                        if (response.data.message) {
                            $('#exampleModal').trigger('click');
                            $('#edit_address_modal')[0].reset();

                            toastr['success'](response.data.message);
                        }
                    } else {
                        toastr['error'](response.data.error);
                    }


                }, //success end
            });
        });

        $(document).ready(function() {
            $("#new_address_model").validate({

                rules: {
                    is_inside_dhaka: {
                        required: true,
                    },
                    modal_new_name: {
                        required: true,
                        maxlength: 100,
                    },
                    modal_new_phone: {
                        required: true,
                        maxlength: 11,
                        minlength: 11,
                        digits: true,
                    },
                    modal_new_district: {
                        required: true,
                        maxlength: 50,
                    },
                    modal_new_area: {
                        required: true,
                        maxlength: 50,
                    },
                    modal_new_address: {
                        required: true,
                        maxlength: 500,
                    },
                },
                messages: {
                    is_inside_dhaka: {
                        required: 'Please select one',
                    },
                    modal_new_name: {
                        required: 'Please insert name',
                    },
                    modal_new_phone: {
                        required: 'Please insert phone',
                    },
                    modal_new_district: {
                        required: 'Please insert division',

                    },
                    modal_new_area: {
                        required: 'Please insert area',

                    },
                    modal_new_address: {
                        required: 'Please insert address',

                    },
                },
                errorPlacement: function(label, element) {
                    label.addClass('mt-2 text-danger');
                    label.insertAfter(element);
                },
            });
        });
        //end

        $(document).off('submit', '#new_address_model');
        $(document).on('submit', '#new_address_model', function(event) {
            //alert('submit');
            event.preventDefault();
            $.ajax({
                url: "{!! route('profile.address.add') !!}",
                method: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function(response) {

                    if (response.success == true) {
                        $('#addAddressModalClose').trigger('click');
                        $('#new_address_model')[0].reset();
                        $('#user_address_list').append(`<li class="address_loc_details address_id${response.address.address_id}">
                                <div class="address_loc_desc">
                                    <p class="address_loc"><span>বিভাগ: </span>${response.address.division}</p>
                                    <p class="address_loc"><span>জেলা: </span>${response.address.district}</p>
                                    <p class="address_loc"><span>ঠিকানা: </span>${response.address.address}</p>
                                    <p class="address_loc"><span>মোবাইল: </span>${response.address.mobile}</p>
                                </div>
                                <div class="address_loc_edit">
                                    <div class="form-check"> 

                                        ${ (response.is_default==1?`<input class="form-check-input" type="checkbox" name="permanent_address"
                                                            value="" onclick="primaryAddress(${response.address.address_id})" checked>`:`<input class="form-check-input" type="checkbox" name="permanent_address"
                                                            value="" onclick="primaryAddress(${response.address.address_id})">`)
   
                                        }


                                       
                                        <label class="form-check-label"> প্রাথমিক ঠিকানা </label>
                                    </div>
                                    <div class="address_loc_buttons">

                                        <button type="button" class="edit address_info"
                                            data-id="${response.address.address_id}">

                                            <button class="delete"
                                                onclick="deleteAddress(${response.address.address_id})"></button> 
                                    </div>
                                </div>
                            </li>`);

                        // <input class="form-check-input" type="checkbox" name="permanent_address"
                        //             value="" onclick="primaryAddress(${response.address.address_id})">
                        toastr['success'](response.data.message);

                    } else {
                        toastr['error'](response.data.error);
                    }
                }

            })
        });

        // delete address
        function deleteAddress(id) {
            $.ajax({
                type: "POST",
                url: "{!! route('profile.address.delete') !!}",
                data: {
                    id: id,
                    _token: "{{ csrf_token() }}"
                },
                dataType: 'JSON',
                success: function(response) {
                    if (response.success === true) {
                        toastr['success'](response.data.message);
                        $('.address_id' + response.data.id).remove();
                    } else {
                        toastr['error'](response.data.message);
                    }
                }
            });
        }
        //primary address     
        function order_view(id) {
            //alert(id)
            $.ajax({
                type: "POST",
                url:  config.routes.order_single,
                // url:  "{!! route('my.order.single') !!}",
                data: {
                    id: id,
                    _token: "{{ csrf_token() }}"
                },
                dataType: 'JSON',
                success: function(response) {
                    if (response.success === true) {

                        $("#book_list").empty();
                       
                        $.each(response.data.books, function(index, val) {
                            console.log(val);
                        $('#book_list').append(`<li>
                                        <div>
                                            <span>${engToBangla(val.pivot.quantity)}টি</span>
                                            <span>${val.title}</span>
                                        </div>
                                        <div>
                                            ${engToBangla(val.pivot.amount)}
                                        </div>
                                    </li>`)
                        });

                        $('#order_sub_total').html(engToBangla(response.data.subtotal));
                        // $('#order_vat').html(response.data.total);
                        $('#order_delivery').html(engToBangla(response.data.delivery_fee));
                        $('#order_total').html(engToBangla(response.data.total));
                        $('#order_status').html(response.data.order_status.name);
                        $('#order_id').html(response.data.id);
                        $('#order_note').html(response.data.notes ?? 'N/A');


                        $("#order_status").empty();
                        $('#order_status').append(response.data.order_status_id==1?`<span class="delevery-pending" id="order_status">পেন্ডিং</span>`:
                        response.data.order_status_id==2?`<span class="delevery-success" id="order_status">ডেলিভারিং</span>`:response.data.order_status_id==3?`কমপ্লিট`:`<span class="delevery-pending">ক্যানসেল</span>`
                        )
                     
                        $('#orderHistoryModal').modal('show');
                    }

                        

                    else {
                        toastr['error'](response.message);
                    }
                }
            });
        }
        //end

        //primary address     
      function primaryAddress(id) {
                    $.ajax({
                        type: "POST",
                        url: "{!! route('profile.address.primary') !!}",
                        data: {
                            id: id,
                            _token: "{{ csrf_token() }}"
                        },
                        dataType: 'JSON',
                        success: function(response) {
                            if (response.success === true) {

                                $("#user_address_list").empty();
                                if(response.user_address.length!=0){
                                
                                    $.each(response.user_address.addresses, function(index, val) {
                                        console.log(val);
                                    $('#user_address_list').append(`<li class="address_loc_details address_id${val.address_id}">
                                <div class="address_loc_desc">
                                    <p class="address_loc"><span>বিভাগ: </span>${val.division}</p>
                                    <p class="address_loc"><span>জেলা: </span>${val.district}</p>
                                    <p class="address_loc"><span>ঠিকানা: </span>${val.address}</p>
                                    <p class="address_loc"><span>মোবাইল: </span>${val.mobile}</p>
                                </div>
                                <div class="address_loc_edit">
                                    <div class="form-check">
                                        ${ (val.pivot.is_default==1?`<input class="form-check-input" type="checkbox" name="permanent_address"
                                            value="" onclick="primaryAddress(${val.address_id})" checked>`:`<input class="form-check-input" type="checkbox" name="permanent_address"
                                            value="" onclick="primaryAddress(${val.address_id})">`)

                                            
                                        }

                                        <label class="form-check-label"> প্রাথমিক ঠিকানা </label>
                                    </div>
                                    <div class="address_loc_buttons">

                                        <button type="button" class="edit address_info"
                                            data-id="${val.address_id}">

                                            <button class="delete"
                                                onclick="deleteAddress(${val.address_id})"></button>
                                    </div>
                                </div>
                            </li>`)
                                    });
                                    
                                }else{
                                    $('#user_address_list').append(`<h1>No data!</h1>`);
                                    }
                                
                                toastr['success'](response.data.message);


                               
                            } else {
                                toastr['error'](response.message);
                            }
                        }
                    });    
            }
        //end
    </script>
@endsection
