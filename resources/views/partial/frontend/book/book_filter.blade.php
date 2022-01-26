<div class="col-lg-2 filter_mobile">
    <div class="filter_wraper">
        <div class="desktop_filter">
            <div class="filter_header  d-flex justify-content-between">
                <div>
                    <h1>ফিল্টার করুন</h1>
                </div>
                <div>
                    <img src="{{ asset('frontend/assets/images/icons/filterIcon.svg') }}" alt="">
                </div>
            </div>
        </div>

        <div class="mobile_filter sticky-top" type="button" onclick="mobileBtnAction()">
            <div class="filter_header d-flex justify-content-between">
                <div>
                    <h1>ফিল্টার করুন</h1>
                </div>
                <div>
                    <img src="{{ asset('frontend/assets/images/icons/filterIcon.svg') }}" alt="">
                </div>
            </div>
        </div>

        <div class="filter_body">
            <!-- Writer -->
            <div class="filter_content">
                <div class="filter_clear">
                    <h2>লেখক</h2>
                    <button class="filter_clear_btn" data-input_name="writer"> মুছে ফেলুন <img
                            src="{{ asset('frontend/assets/images/icons/close_black_24dp1.svg') }}" alt=""></button>
                </div>
                <div>
                    <div class="search_group">
                        <input class="form-control" placeholder="খুঁজে দেখুন" type="text"
                            name="writer_search_key_sidebar" id="writer_search_key_sidebar"
                            onkeypress="author_sidebar_filter()" onkeyup="author_sidebar_filter()">
                        <button><img src="{{ asset('frontend/assets/images/icons/search_black_24dp1.svg') }}"
                                alt=""></button>
                    </div>
                </div>
                <div class="form_chack_container" id="author_list_div">
                    @if (!empty($authors))
                    @foreach ($authors as $author)

                    <div class="form-check">
                        <input class="form-check-input writer_id" type="checkbox" name="writer"
                            id="writer{{ $author->author_id }}" onclick="book_fetch()">
                        <label class="form-check-label" for="writer{{ $author->author_id }}">
                            {{ $author->name }}
                        </label>
                    </div>

                    @endforeach
                    @endif
                </div>
            </div>

            <!-- Subject -->
            <div class="filter_content">
                <div class="filter_clear">
                    <h2>বিষয়</h2>
                    <button class="filter_clear_btn" data-input_name="priceDiscount"> মুছে ফেলুন <img
                            src="{{ asset('frontend/assets/images/icons/close_black_24dp1.svg') }}" alt=""></button>
                </div>
                <div>
                    <div class="search_group search_key">
                        <input class="form-control" placeholder="খুঁজে দেখুন" type="text" name="search_key"
                            id="category_search_key_sidebar" onkeypress="category_filter_sidebar_filter()"
                            onkeyup="category_filter_sidebar_filter()">

                        <button><img src="{{ asset('frontend/assets/images/icons/search_black_24dp1.svg') }}"
                                alt=""></button>
                    </div>
                </div>
                <div class="form_chack_container" id="category_list_div">
                    @if (!empty($categories))
                    @foreach ($categories as $category)
                    <div class="form-check">
                        <input class="form-check-input category_id" type="checkbox" name="priceDiscount"
                            id="discountPrice{{ $category->category_id }}" onclick="book_fetch()">
                        <label class="form-check-label" for="discountPrice{{ $category->category_id }}">
                            {{ $category->name }}

                        </label>
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>

            <!-- Price -->
            <div class="filter_content">
                <div class="filter_clear">
                    <h2>মূল্য</h2>
                    <button class="filter_clear_btn" data-input_name="price"> মুছে ফেলুন <img
                            src="{{ asset('frontend/assets/images/icons/close_black_24dp1.svg') }}" alt=""></button>
                </div>
                <div class="form_chack_container">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="price" id="radioPrice1"
                            onclick="book_fetch()" value="100">
                        <label class="form-check-label" for="radioPrice1">
                            ০-১০০
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="price" id="radioPrice2"
                            onclick="book_fetch()" value="500">
                        <label class="form-check-label" for="radioPrice2">
                            ১০০-৫০০
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="price" id="radioPrice3"
                            onclick="book_fetch()" value="1000">
                        <label class="form-check-label" for="radioPrice3">
                            ৫০০-১০০০
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="price" id="radioPrice4"
                            onclick="book_fetch()" value="1500">
                        <label class="form-check-label" for="radioPrice4">
                            ১০০০-২০০০
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="price" id="radioPrice5"
                            onclick="book_fetch()" value="2000">
                        <label class="form-check-label" for="radioPrice5">
                            ২০০০+
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="price" id="radioPrice6"
                            onclick="book_fetch()">
                        <label class="form-check-label" for="radioPrice6">
                            সকল
                        </label>
                    </div>
                </div>
            </div>





            <!-- Publisher -->
            <div class="filter_content">
                <div class="filter_clear">
                    <h2>প্রকাশক</h2>
                    <button class="filter_clear_btn" data-input_name="publisher"> মুছে ফেলুন <img
                            src="{{ asset('frontend/assets/images/icons/close_black_24dp1.svg') }}" alt=""></button>
                </div>

                <div>
                    <div class="search_group">
                        <input class="form-control search_key" placeholder="খুঁজে দেখুন" type="text"
                            name="publisher_search_key_sidebar" id="publisher_search_key_sidebar"
                            onkeypress="publisher_sidebar_filter()" onkeyup="publisher_sidebar_filter()">
                        <button><img src="{{ asset('frontend/assets/images/icons/search_black_24dp1.svg') }}"
                                alt=""></button>
                    </div>
                </div>

                {{-- <span id="publication_list_div"> --}}
                    <div class="form_chack_container" id="publication_list_div">
                        @if (!empty($publications))
                        @foreach ($publications as $publication)
                        <div class="form-check">
                            <input class="form-check-input publisher_id" type="checkbox" name="publisher"
                                id="publisher{{ $publication->publication_id }}" onclick="book_fetch()">
                            <label class="form-check-label" for="publisher{{ $publication->publication_id }}">
                                {{ $publication->name }}

                            </label>
                        </div>
                        @endforeach
                        @endif
                    </div>
                    {{--
                </span> --}}
            </div>
        </div>
    </div>
</div>