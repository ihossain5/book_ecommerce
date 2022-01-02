@extends('layouts.frontend.master')
@section('title', 'Books')

@section('page-css')
<link rel="stylesheet" href="{{ asset('frontend/assets/css/books.css') }}">
@endsection

@section('content')

<section class="fillter_with_grid_section books_page pt-20 pb-120">
    <div class="container">
        <div class="sc_title_wrapper">
            <h1 class="sc_title">নতুন প্রকাশিত বই</h1>
            <div class="btn_box">
                <select class="btn_more">
                    <option value="" disabled selected hidden>সর্ট করুন
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="15" viewBox="0 0 14 15"
                            fill="none">
                            <path d="M3.5 5.75L7 9.25L10.5 5.75" stroke="#4F7F6C" stroke-width="1.5"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
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
                                        name="search_key" id="writer_search_key" onkeypress="book_fetch()" onkeyup="book_fetch()">
                                    <button><img src="{{ asset('frontend/assets/images/icons/search_black_24dp1.svg') }}" alt=""></button>
                                </div>
                            </div>
                            
                            @if(!empty($authors))
                                @foreach ($authors as $author)
                                    <div class="form-check">
                                        <input class="form-check-input writer_id" type="checkbox" name="writer" id="writer{{ $author->author_id }}" onclick="book_fetch()">
                                        <label class="form-check-label" for="writer{{ $author->author_id }}">
                                            {{ $author->name }}
                                        </label>
                                    </div>
                                @endforeach
                            @endif
                            
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
                                    <input class="form-control" placeholder="খুঁজে দেখুন" type="text"
                                        name="search_key" id="category_search_key" onkeypress="book_fetch()" onkeyup="book_fetch()">
                                    <button><img src="{{ asset('frontend/assets/images/icons/search_black_24dp1.svg') }}" alt=""></button>
                                </div>
                            </div>
                           
                            @if(!empty($categories))
                                @foreach ($categories as $category)
                                    <div class="form-check">
                                        <input class="form-check-input category_id" type="checkbox" name="priceDiscount"
                                            id="discountPrice{{$category->category_id }}" onclick="book_fetch()">
                                        <label class="form-check-label" for="discountPrice{{$category->category_id }}">
                                            {{$category->name}}
                                            
                                        </label>
                                    </div>
                                @endforeach
                            @endif
                        </div>

                        <!-- Price -->
                        <div class="filter_content">
                            <div class="filter_clear">
                                <h2>মূল্য</h2>
                                <button class="filter_clear_btn" data-input_name="price"> মুছে ফেলুন <img
                                        src="{{ asset('frontend/assets/images/icons/close_black_24dp1.svg') }}" alt=""></button>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="price" id="radioPrice1" onclick="book_fetch()" value="100">
                                <label class="form-check-label" for="radioPrice1">
                                    ০-১০০
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="price" id="radioPrice2" onclick="book_fetch()" value="500">
                                <label class="form-check-label" for="radioPrice2">
                                    ১০০-৫০০
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="price" id="radioPrice3" onclick="book_fetch()" value="1000">
                                <label class="form-check-label" for="radioPrice3">
                                    ৫০০-১০০০
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="price" id="radioPrice4" onclick="book_fetch()"  value="1500">
                                <label class="form-check-label" for="radioPrice4">
                                    ১০০০-২০০০
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="price" id="radioPrice5" onclick="book_fetch()" value="2000">
                                <label class="form-check-label" for="radioPrice5">
                                    ২০০০+
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="price" id="radioPrice6" onclick="book_fetch()">
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
                                        src="{{ asset('frontend/assets/images/icons/close_black_24dp1.svg') }}" alt=""></button>
                            </div>

                            <div>
                                <div class="search_group">
                                    <input class="form-control search_key" placeholder="খুঁজে দেখুন" type="text"
                                        name="search_key" id="publisher_search_key" onkeypress="book_fetch()" onkeyup="book_fetch()">
                                    <button><img src="{{ asset('frontend/assets/images/icons/search_black_24dp1.svg') }}" alt=""></button>
                                </div>
                            </div>
                            @if(!empty($publications))
                                @foreach ($publications as $publication)
                                <div class="form-check">
                                    <input class="form-check-input publisher_id" type="checkbox" name="publisher" id="publisher{{$publication->publication_id}}" onclick="book_fetch()">
                                    <label class="form-check-label" for="publisher{{$publication->publication_id}}" >
                                      {{$publication->name}}
                                      
                                    </label>
                                </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-10">
                <div class="right_grid_content">
                    <div class="row row-cols-2 row-cols-sm-2 row-cols-md-3 row-cols-lg-4" id="book_list">
                        @if(!empty($books))
                        @foreach ($books as $book)
                        <div class="col">
                            <div class="book_card_wrapper">
                                <div class="image_wrapper">
                                    <a href="{{route('frontend.book.details',[$book->book_id])}}" class="d-block text-reset">
                                        <img class="img-fluid w-100" src="{{ asset('images/' . $book->cover_image) }}"
                                            alt="book image">
                                    </a>
                                </div>
                                <div class="content_wrapper book_card_content">
                                    <div class="rating">
                                        <div class="rateYo"></div>
                                    </div>
                                    <h3 class="title">{{ $book->title }}</h3>
                                    <p class="author">
                                        @foreach ($book->authors as $author)

                                        {{ $author->name }}@if (!$loop->last) , @endif
                                        @endforeach
                                    </p>
                                    <div class="price_wrapper">
                                        <h6 class="discount">{{ $book->discounted_price }}</h6>
                                        <h5 class="regular">{{ $book->regular_price }}</h5>
                                    </div>
                                    <a href="{{route('frontend.book.details',[$book->book_id])}}" class="btn_buy_now" >Buy Now</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endif
                        @if($books->isEmpty())
                        <div class="col offset-4">
                            <h1 class="sc_title">বই নেই</h1>
                        </div>
                        @endif   
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- pagination -->
    @include('partial.frontend.pagination')
    </div>
</section>


@endsection
@section('page-js')
<script>

    function mobileBtnAction() {

        let navHeight = $('.navbar').innerHeight();
        if ($('.filter_mobile').hasClass('expand')) {
            let btnHeight = $('.mobile_filter').innerHeight();
            $('.filter_mobile').css({ 'height': `${btnHeight}px` });
            $('.filter_mobile').removeClass('expand');
        } else {
            $('.filter_mobile').addClass('expand');
            $('.filter_mobile').css({ 'height': `calc(100vh - ${navHeight * 2}px)` });
        }
    }

    function setMenuHeight() {
        if ($('body').innerWidth() < 992) {
            let btnHeight2 = $('.mobile_filter').innerHeight();
            $('.filter_mobile').css({ 'height': `${btnHeight2}px` });
        }
    }
    setMenuHeight();

</script>

<script>
    ///////////////////////////////backend page codes////////////////////////////////////////
    var book_fetch_config = {
                routes: {
                    filter: "{!! route('book.filter') !!}",
                   
                }
            };
        function book_fetch(id) {
           
    
            //var author_id=$('#author_id').val();
            
    
            var writer_list=[];
            $('.'+'writer_id'+':checked').each(function(){
                 var writer_id = $(this).attr("id").replace('writer','');
                writer_list.push(writer_id);
            });
            //alert(writer_list);
    
    
    
            var category_list=[];
            $('.'+'category_id'+':checked').each(function(){
                 var category_id = $(this).attr("id").replace('discountPrice','');
                category_list.push(category_id);
            });
            //alert(category_list);
           
            var category_search_key=$('#category_search_key').val();
            //alert(category_search_key);
            
            var publisher_search_key=$('#publisher_search_key').val();
            //alert(publisher_search_key);
            var writer_search_key=$('#writer_search_key').val();
            //alert(writer_search_key);
            
            var price = $("input[name='price']:checked").val();
            //alert(price);
         
            var publisher_list=[];
            $('.'+'publisher_id'+':checked').each(function(){
                 var publisher_id = $(this).attr("id").replace('publisher','');
     
                publisher_list.push(publisher_id);
            });
            //alert(publisher_list)    
    
                $.ajax({
                    url:  book_fetch_config.routes.filter,
                    method: "POST",
                    data: {
                        
                        //author_id: author_id,
                        category_list: category_list,
                        category_search_key: category_search_key,
                        publisher_search_key: publisher_search_key,
                        price: price,
                        publisher_list: publisher_list,
                        writer_list: writer_list,
                        writer_search_key: writer_search_key,
                      
                        _token: "{{ csrf_token() }}"
                    },
                    dataType: "json",
                    success: function(response) {
    
                        $("#book_list").empty();
                        if(response.book_list.length!=0){
                            
                            $.each(response.book_list, function(index, val) {
                                console.log(val);
                            $('#book_list').append(`  <div class="col">
                                <div class="book_card_wrapper">
                                    <div class="image_wrapper">
                                        <a href="{{ url('/book/${val.book_id}/details') }}" class="d-block text-reset">
                                            <img class="img-fluid w-100" src="{{ asset('images/${val.cover_image}') }}"
                                                alt="book image">
                                        </a>
                                    </div>
                                    <div class="content_wrapper book_card_content">
                                        <div class="rating">
                                            <div class="rateYo"></div>
                                        </div>
                                        <h3 class="title">${val.title}</h3>
                                        <p class="author">${$.map( val.authors, function( n ) {
                                            return n.name;
                                        })}</p>
                                        <div class="price_wrapper">
                                            <h6 class="discount">${val.discounted_price }</h6>
                                            <h5 class="regular">${ val.regular_price }</h5>
                                        </div>
                                        <a href="#" class="btn_buy_now">Buy Now</a>
                                    </div>
                                </div>
                            </div>`)
                            });
                        }else{
                            $('#book_list').append(` <div class="col offset-4">
                                <h1 class="sc_title">বই নেই</h1>
                            </div>`);
                            }
                            //alert("reponse success");
                        //success end
                    }
                }); //ajax end
            }
    
    </script>

@endsection