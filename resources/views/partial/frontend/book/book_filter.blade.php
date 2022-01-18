<div class="col-lg-2 filter_mobile">
    <div class="filter_wraper">
        <div class="desktop_filter">
            <div class="filter_header  d-flex justify-content-between">
                <div>
                    <h1>ফিল্টার করুন</h1>
                </div>
                <div>
                    <img src="{{asset('frontend/assets/images/icons/filterIcon.svg')}}" alt="">
                </div>
            </div>
        </div>

        <div class="mobile_filter sticky-top" type="button" onclick="mobileBtnAction()">
            <div class="filter_header d-flex justify-content-between">
                <div>
                    <h1>ফিল্টার করুন</h1>
                </div>
                <div>
                    <img src="{{asset('frontend/assets/images/icons/filterIcon.svg')}}" alt="">
                </div>
            </div>
        </div>

        <div class="filter_body">
            <!-- Writer -->
            <div class="filter_content">
                <div class="filter_clear">
                    <h2>লেখক</h2>
                    <button class="filter_clear_btn" data-input_name="writer"> মুছে ফেলুন <img
                            src="{{asset('frontend/assets/images/icons/close_black_24dp 1.svg')}}" alt=""></button>
                </div>
                <div>
                    <div class="search_group">
                        <input class="form-control" placeholder="খুঁজে দেখুন" type="text"
                            name="writers">
                        <button><img src="{{asset('frontend/assets/images/icons/search_black_24dp 1.svg')}}" alt=""></button>
                    </div>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="writer" id="writer1">
                    <label class="form-check-label" for="writer1">
                        শ্যামল দত্ত
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="writer" id="writer2">
                    <label class="form-check-label" for="writer2">
                        মজিদ মাহমুদ
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="writer" id="writer3">
                    <label class="form-check-label" for="writer3">
                        মজিদ মাহমুদ
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="writer" id="writer4">
                    <label class="form-check-label" for="writer4">
                        আন্দালিব রাশদী
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="writer" id="writer5">
                    <label class="form-check-label" for="writer5">
                        হাবীবুল্লাহ সিরাজী
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="writer" id="writer6">
                    <label class="form-check-label" for="writer6">
                        সালেক নাছির উদ্দিন
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="writer" id="writer7">
                    <label class="form-check-label" for="writer7">
                        রফিকুর রশীদ
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="writer" id="writer8">
                    <label class="form-check-label" for="writer8">
                        আনোয়ারা সৈয়দ হক
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="writer" id="writer9">
                    <label class="form-check-label" for="writer9">
                        মুকুল শাহরিয়ার
                    </label>
                </div>
            </div>

            <!-- Subject -->
            <div class="filter_content">
                <div class="filter_clear">
                    <h2>বিষয়</h2>
                    <button class="filter_clear_btn" data-input_name="priceDiscount"> মুছে ফেলুন <img
                            src="{{asset('frontend/assets/images/icons/close_black_24dp 1.svg')}}" alt=""></button>
                </div>
                <div>
                    <div class="search_group">
                        <input class="form-control" placeholder="খুঁজে দেখুন" type="text"
                            name="writers">
                        <button><img src="{{asset('frontend/assets/images/icons/search_black_24dp 1.svg')}}" alt=""></button>
                    </div>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="priceDiscount"
                        id="discountPrice">
                    <label class="form-check-label" for="discountPrice">
                        বিষয় ১
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="priceDiscount"
                        id="discountPrice1">
                    <label class="form-check-label" for="discountPrice1">
                        বিষয় ২
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="priceDiscount"
                        id="discountPrice2">
                    <label class="form-check-label" for="discountPrice2">
                        বিষয় ৩
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="priceDiscount"
                        id="discountPrice3">
                    <label class="form-check-label" for="discountPrice3">
                        বিষয় ৪ </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="priceDiscount"
                        id="discountPrice4">
                    <label class="form-check-label" for="discountPrice4">
                        বিষয় ৫
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="priceDiscount"
                        id="discountPrice5">
                    <label class="form-check-label" for="discountPrice5">
                        সকল
                    </label>
                </div>

            </div>

            <!-- Price -->
            <div class="filter_content">
                <div class="filter_clear">
                    <h2>মূল্য</h2>
                    <button class="filter_clear_btn" data-input_name="price"> মুছে ফেলুন <img
                            src="{{asset('frontend/assets/images/icons/close_black_24dp 1.svg')}}" alt=""></button>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="radio" name="price" id="radioPrice1">
                    <label class="form-check-label" for="radioPrice1">
                        ০-১০০
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="price" id="radioPrice2">
                    <label class="form-check-label" for="radioPrice2">
                        ১০০-৫০০
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="price" id="radioPrice3">
                    <label class="form-check-label" for="radioPrice3">
                        ৫০০-১০০০
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="price" id="radioPrice4">
                    <label class="form-check-label" for="radioPrice4">
                        ১০০০-২০০০
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="price" id="radioPrice5">
                    <label class="form-check-label" for="radioPrice5">
                        ২০০০+
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="price" id="radioPrice6">
                    <label class="form-check-label" for="radioPrice6">
                        সকল
                    </label>
                </div>
            </div>





            <!-- Publisher -->
            <div class="filter_content">
                <div class="filter_clear">
                    <h2>প্রকাশক</h2>
                    <button class="filter_clear_btn" data-input_name="publisher"> মুছে ফেলুন <img
                            src="{{asset('frontend/assets/images/icons/close_black_24dp 1.svg')}}" alt=""></button>
                </div>

                <div>
                    <div class="search_group">
                        <input class="form-control" placeholder="খুঁজে দেখুন" type="text"
                            name="writers">
                        <button><img src="{{asset('frontend/assets/images/icons/search_black_24dp 1.svg')}}" alt=""></button>
                    </div>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="publisher" id="publisher1">
                    <label class="form-check-label" for="publisher1">
                        ভোরের কাগজ প্রকাশন
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>