@extends('layouts.frontend.master')
@section('title', 'Profile Edit')

@section('page-css')
<link rel="stylesheet" href="{{ asset('frontend/assets/css/my-profile.css') }}">
@endsection

@section('content')
<section class="my_profile_section pt-20 pb-120">
    <div class="container">
        <form action="#">
            <div class="upload-picture">
                <div class="upload-picture-inner">
                    <label for="fileUpload">
                        <img src="{{ asset('frontend/assets/images/profile/profile-pic-editable.png') }}" alt="upload-image"
                            id="uplodedImg">
                        <div class="edit-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="13" height="12" viewBox="0 0 13 12"
                                fill="none">
                                <path
                                    d="M7.37333 4.01333L7.98667 4.62667L1.94667 10.6667H1.33333V10.0533L7.37333 4.01333ZM9.77333 0C9.60667 0 9.43333 0.0666666 9.30667 0.193333L8.08667 1.41333L10.5867 3.91333L11.8067 2.69333C12.0667 2.43333 12.0667 2.01333 11.8067 1.75333L10.2467 0.193333C10.1133 0.06 9.94667 0 9.77333 0ZM7.37333 2.12667L0 9.5V12H2.5L9.87333 4.62667L7.37333 2.12667Z"
                                    fill="white" />
                            </svg>
                        </div>
                    </label>
                    <input type="file" class="form-control-file" id="fileUpload">
                </div>
            </div>
        </form>
        <div class="my_profile_body">
            <div>
                <!-- Nav tabs -->
                <ul class="nav nav-tabs justify-content-between" id="myTab" role="tablist">
                    <li role="presentation">
                        <a class="" id="personal_info-tab" data-bs-toggle="tab"
                            data-bs-target="#personal_info" type="button" role="tab" aria-controls="personal_info"
                            aria-selected="false">ব্যক্তিগত তথ্য</a>
                    </li>
                    <li role="presentation">
                        <a class="active" id="area_info-tab" data-bs-toggle="tab" data-bs-target="#area_info"
                            type="button" role="tab" aria-controls="area_info" aria-selected="true">আমার ঠিকানা</a>
                    </li>
                    <li role="presentation">
                        <a class="" id="order_info-tab" data-bs-toggle="tab" data-bs-target="#order_info"
                            type="button" role="tab" aria-controls="order_info" aria-selected="false">পুরোনো
                            অর্ডার</a>
                    </li>
                    <li role="presentation">
                        <a class="" id="settings-tab" data-bs-toggle="tab" data-bs-target="#settings" type="button"
                            role="tab" aria-controls="settings" aria-selected="false">পছন্দের তালিকা</a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="personal_info">
                        <form action="">
                            <div class="input_fild">
                                <label>নাম</label>
                                <input type="text" class="form-control" placeholder="আপনার নাম">
                            </div>
                            <div class="input_fild">
                                <label>ফোন নম্বর</label>
                                <input type="text" class="form-control" placeholder="আপনার ফোন নম্বর">
                            </div>
                            <div class="input_fild">
                                <label>ইমেইল অ্যাড্রেস</label>
                                <input type="email" class="form-control" placeholder="আপনার ইমেইল অ্যাড্রেস">
                            </div>

                            <div class="input_fild">
                                <label>জন্ম তারিখ</label>
                                <input type="text" class="form-control" placeholder="আপনার জন্ম তারিখ">
                            </div>
                            <a href="" class="submit_btn">সেভ করুন</a>

                        </form>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="area_info">
                        <form action="">
                            <div class="input_fild">
                                <label>জেলা</label>
                                <select id="district" name="">
                                    <option value="" disabled selected hidden>আপনার জেলা</option>
                                    <option value="ঢাকা">ঢাকা</option>
                                    <option value="চট্টগ্রাম">চট্টগ্রাম</option>
                                    <option value="চট্টগ্রাম">চট্টগ্রাম</option>
                                </select>
                            </div>
                            <div class="input_fild">
                                <label>এরিয়া</label>
                                <select id="district" name="">
                                    <option value="" disabled selected hidden>আপনার এরিয়া</option>
                                    <option value="ঢাকা">ঢাকা</option>
                                    <option value="চট্টগ্রাম">চট্টগ্রাম</option>
                                    <option value="চট্টগ্রাম">চট্টগ্রাম</option>
                                </select>
                            </div>
                            <div class="input_fild">
                                <label>ঠিকানা</label>
                                <textarea placeholder="আপনার নাম" class="form-control" name="" rows="4"
                                    cols="30"></textarea>
                            </div>
                            <a href="" class="submit_btn">সেভ করুন</a>

                        </form>
                    </div>

                    <div role="tabpanel" class="tab-pane" id="order_info">
                        <ul class="orders_lists">
                            <li class="order_details">
                                <div class="code_and_delevery">
                                    <p class="order_code">অর্ডার কোডঃ <span>#10102</span></p>
                                    <h3 class="order_sign delevery">ডেলিভারড</h3>
                                </div>
                                <div class="price_date">
                                    <h3 class="order_price">মোট ৪৮০ টাকা</h3>
                                    <p class="order_date">২১ ডিসেম্বর, ২০২১</p>
                                </div>
                            </li>
                            <li class="order_details">
                                <div class="code_and_delevery">
                                    <p class="order_code">অর্ডার কোডঃ <span>#10102</span></p>
                                    <h3 class="order_sign panding">পেন্ডিং</h3>
                                </div>
                                <div class="price_date">
                                    <h3 class="order_price">মোট ৪৮০ টাকা</h3>
                                    <p class="order_date">২১ ডিসেম্বর, ২০২১</p>
                                </div>
                            </li>
                        </ul>

                    </div>
                    <div role="tabpanel" class="tab-pane books_choice" id="settings">
                        <section class="book_cards_section">
                            <div class="container ">
                                <div class="row row-cols-2 row-cols-sm-2 row-cols-md-3  g-0">
                                    <div class="col">
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
                                    </div>
                                    <div class="col">
                                        <div class="book_card_wrapper">
                                            <div class="image_wrapper">
                                            <a href="book-details.html" class="d-block text-reset">
                                                <img class="img-fluid w-100" src="{{ asset('frontend/assets/images/books/book-img-2.png') }}" alt="book image">
                                            </a>
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
                                    </div>
                                    <div class="col">
                                        <div class="book_card_wrapper">
                                            <div class="image_wrapper">
                                            <a href="book-details.html" class="d-block text-reset">
                                                <img class="img-fluid w-100" src="{{ asset('frontend/assets/images/books/book-img-3.png') }}" alt="book image">
                                            </a>
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
                                    </div>
                                    <div class="col">
                                        <div class="book_card_wrapper">
                                            <div class="image_wrapper">
                                            <a href="book-details.html" class="d-block text-reset">
                                                <img class="img-fluid w-100" src="{{ asset('frontend/assets/images/books/book-img-4.png') }}" alt="book image">
                                            </a>
                                            </div>
                                            <div class="content_wrapper book_card_content">
                                                <div class="rating"></div>
                                                <h3 class="title">সেরা লেখক সেরা গল্প</h3>
                                                <p class="author">শ্যামল দত্ত</p>
                                                <div class="price_wrapper">
                                                    <h6 class="discount">২০০ টাকা</h6>
                                                    <h5 class="regular">১৮০ টাকা</h5>
                                                </div>
                                                <a href="#" class="btn_buy_now">Buy Now</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="book_card_wrapper">
                                            <div class="image_wrapper">
                                                <a href="book-details.html" class="d-block text-reset">
                                                   <img class="img-fluid w-100" src="{{ asset('frontend/assets/images/books/book-img-2.png') }}" alt="book image">
                                                </a>
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
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
@section('page-js')
<script>
    // edit profile image 
    $('#fileUpload').change(function () {
        const url = window.URL.createObjectURL(this.files[0]);
        $('#uplodedImg').attr('src',url);
    })
</script>
@endsection