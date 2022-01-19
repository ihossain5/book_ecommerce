@extends('layouts.frontend.master')
@section('title', 'Writer Details')

@section('page-css')
<link rel="stylesheet" href="{{ asset('frontend/assets/css/books.css') }}">
@endsection

@section('content')
<section class="banner_section pt-20 pb-56">
    <div class="container">
        <div class="writer_details_content">
            <div class="row">
                <div class="col-lg-4">
                    <div class="writer_details_image">
                        <img class="img-fluid w-100" src="{{ asset('images/' . $author_info->photo) }}"
                            alt="{{ $author_info->name }}">
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="writer_details_text">
                        <input type="hidden" name="author_id" id="author_id" value="{{ $author_info->author_id }}">
                        <h2>{{ $author_info->name }}</h2>
                        <p>{{ $author_info->description }} </p>
                        {{-- <a href="#">Read more</a> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="fillter_with_grid_section pb-120">
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
                        {{-- <div class="filter_content">
                            <div class="filter_clear">
                                <h2>লেখক</h2>
                                <button class="filter_clear_btn" data-input_name="writer"> মুছে ফেলুন <img
                                        src="{{ asset('frontend/assets/images/icons/close_black_24dp1.svg') }}"
                                        alt=""></button>
                            </div>
                            <div>
                                <div class="search_group">
                                    <input class="form-control" placeholder="খুঁজে দেখুন" type="text" name="search_key"
                                        id="writer_search_key" onkeypress="book_fetch()" onkeyup="book_fetch()">
                                    <button><img
                                            src="{{ asset('frontend/assets/images/icons/search_black_24dp1.svg') }}"
                                            alt=""></button>
                                </div>
                            </div>

                            @if(!empty($authors))
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

                        </div> --}}

                        <!-- Subject -->
                        <div class="filter_content">
                            <div class="filter_clear">
                                <h2>বিষয়</h2>
                                <button class="filter_clear_btn" data-input_name="priceDiscount"> মুছে ফেলুন <img
                                        src="{{ asset('frontend/assets/images/icons/close_black_24dp1.svg') }}"
                                        alt=""></button>
                            </div>
                            <div>
                                <div class="search_group search_key">
                                    <input class="form-control" placeholder="খুঁজে দেখুন" type="text"
                                        name="category_search_key_sidebar" id="category_search_key_sidebar"
                                        onkeypress="category_filter_sidebar_filter()"
                                        onkeyup="category_filter_sidebar_filter()">
                                    <button><img
                                            src="{{ asset('frontend/assets/images/icons/search_black_24dp1.svg') }}"
                                            alt=""></button>
                                </div>
                            </div>
                            <span id="category_list_div">
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
                            </span>
                        </div>

                        <!-- Price -->
                        <div class="filter_content">
                            <div class="filter_clear">
                                <h2>মূল্য</h2>
                                <button class="filter_clear_btn" data-input_name="price"> মুছে ফেলুন <img
                                        src="{{ asset('frontend/assets/images/icons/close_black_24dp1.svg') }}"
                                        alt=""></button>
                            </div>

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

                        <!-- Publisher -->
                        <div class="filter_content">
                            <div class="filter_clear">
                                <h2>প্রকাশক</h2>
                                <button class="filter_clear_btn" data-input_name="publisher"> মুছে ফেলুন <img
                                        src="{{ asset('frontend/assets/images/icons/close_black_24dp1.svg') }}"
                                        alt=""></button>
                            </div>

                            <div>
                                <div class="search_group">
                                    <input class="form-control search_key" placeholder="খুঁজে দেখুন" type="text"
                                        name="publisher_search_key_sidebar" id="publisher_search_key_sidebar"
                                        onkeypress="publisher_sidebar_filter()" onkeyup="publisher_sidebar_filter()">
                                    <button><img
                                            src="{{ asset('frontend/assets/images/icons/search_black_24dp1.svg') }}"
                                            alt=""></button>
                                </div>
                            </div>
                            <span id="publication_list_div">
                                @if(!empty($publications))
                                @foreach ($publications as $publication)
                                <div class="form-check">
                                    <input class="form-check-input publisher_id" type="checkbox" name="publisher"
                                        id="publisher{{$publication->publication_id}}" onclick="book_fetch()">
                                    <label class="form-check-label" for="publisher{{$publication->publication_id}}">
                                        {{$publication->name}}

                                    </label>
                                </div>
                                @endforeach
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-10">
                <div class="right_grid_content">
                    <div class="row row-cols-2 row-cols-sm-3 row-cols-lg-4" id="author_book_list">
                        @if(!empty($books))
                        @foreach ($books as $key=>$book)
                        <div class="col">
                            <div class="book_card_wrapper">
                                <div class="image_wrapper">
                                    <a href="{{route('frontend.book.details',[$book->book_id])}}"
                                        class="d-block text-reset">
                                        <img class="img-fluid w-100" src="{{ asset('images/' . $book->cover_image) }}"
                                            alt="book image">
                                    </a>
                                    @if ($book->discounted_percentage != null || $book->discounted_percentage != 0)
                                    <div class="red_tag">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="49" height="49"
                                            viewBox="0 0 49 49" fill="none">
                                            <path
                                                d="M23.7645 0.798398C24.1606 0.368447 24.8394 0.368447 25.2355 0.798399L29.1564 5.05469C29.4184 5.33912 29.821 5.44698 30.1901 5.33167L35.7138 3.60607C36.2718 3.43175 36.8597 3.77117 36.9878 4.34156L38.2552 9.98808C38.3399 10.3654 38.6346 10.6601 39.0119 10.7448L44.6584 12.0122C45.2288 12.1403 45.5682 12.7282 45.3939 13.2862L43.6683 18.8099C43.553 19.179 43.6609 19.5816 43.9453 19.8436L48.2016 23.7645C48.6316 24.1606 48.6316 24.8394 48.2016 25.2355L43.9453 29.1564C43.6609 29.4184 43.553 29.821 43.6683 30.1901L45.3939 35.7138C45.5682 36.2718 45.2288 36.8597 44.6584 36.9878L39.0119 38.2552C38.6346 38.3399 38.3399 38.6346 38.2552 39.0119L36.9878 44.6584C36.8597 45.2288 36.2718 45.5682 35.7138 45.3939L30.1901 43.6683C29.821 43.553 29.4184 43.6609 29.1564 43.9453L25.2355 48.2016C24.8394 48.6316 24.1606 48.6316 23.7645 48.2016L19.8436 43.9453C19.5816 43.6609 19.179 43.553 18.8099 43.6683L13.2862 45.3939C12.7282 45.5682 12.1403 45.2288 12.0122 44.6584L10.7448 39.0119C10.6601 38.6346 10.3654 38.3399 9.98808 38.2552L4.34156 36.9878C3.77117 36.8597 3.43175 36.2718 3.60607 35.7138L5.33167 30.1901C5.44698 29.821 5.33912 29.4184 5.05469 29.1564L0.798398 25.2355C0.368447 24.8394 0.368447 24.1606 0.798399 23.7645L5.05469 19.8436C5.33912 19.5816 5.44698 19.179 5.33167 18.8099L3.60607 13.2862C3.43175 12.7282 3.77117 12.1403 4.34156 12.0122L9.98808 10.7448C10.3654 10.6601 10.6601 10.3654 10.7448 9.98808L12.0122 4.34156C12.1403 3.77117 12.7282 3.43175 13.2862 3.60607L18.8099 5.33167C19.179 5.44698 19.5816 5.33912 19.8436 5.05469L23.7645 0.798398Z"
                                                fill="#D20202" />
                                        </svg>
                                        <p>{{ $book->discounted_percentage}}%</p>
                                    </div>
                                    @endif
                                </div>
                                <div class="content_wrapper book_card_content">
                                    {{-- <div class="rating">
                                        <div class="rateYo ratSerialId{{ $key }}"
                                            data-user_rating="{{getTotalRating($book->reviews)}}"></div>
                                    </div> --}}
                                    <h3 class="title">{{ $book->title }}</h3>
                                    <p class="author">
                                        @foreach ($book->authors as $author)

                                        {{ $author->name }}@if (!$loop->last) , @endif
                                        @endforeach</p>
                                    <div class="price_wrapper">
                                        @if ($book->discounted_percentage != null || $book->discounted_percentage != 0)
                                        <h6 class="discount">{{englishTobangla($book->regular_price)}} টাকা</h6>
                                        <h5 class="regular">{{englishTobangla($book->discounted_price)}} টাকা</h5>
                                        @else
                                        <h5 class="regular">{{englishTobangla($book->discounted_price)}} টাকা</h5>
                                        @endif
                                    </div>
                                    <a href="{{route('frontend.book.details',[$book->book_id])}}"
                                        class="btn_buy_now">Buy Now</a>
                                    {{-- <button class="btn_buy_now"
                                        onclick="addToCart({{ $author_book->book_id }})">Buy Now</button> --}}
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
                <!-- pagination -->
                {{$books->links('partial.frontend.pagination')}}

            </div>
        </div>
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
                filter: "{!! route('book.details.filter') !!}",
                category_filter: "{!! route('category.sidebar.filter') !!}",
                publisher_filter: "{!! route('publisher.sidebar.filter') !!}",
               
            }
        };
	function book_fetch(id) {
       

        var author_id=$('#author_id').val();
        

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
                    
                    author_id: author_id,
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

                    $("#author_book_list").empty();
                    if(response.book_list.length!=0){
                      
                                  
                        
						$.each(response.book_list, function(index, val) {
                            var book_details_url = '{{ route('frontend.book.details', ':id') }}';
                            book_details_url = book_details_url.replace(':id', val.book_id);
							console.log(val);
						$('#author_book_list').append(`  <div class="col">
                            <div class="book_card_wrapper">
                                <div class="image_wrapper">
                                    <a href="${book_details_url}" class="d-block text-reset">
                                        <img class="img-fluid w-100" src="{{ asset('images/${val.cover_image}') }}"
                                            alt="book image">
                                    </a>
                                    ${ val.discounted_percentage != 0?`
                                    <div class="red_tag">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="49" height="49" viewBox="0 0 49 49"
                                            fill="none">
                                            <path
                                                d="M23.7645 0.798398C24.1606 0.368447 24.8394 0.368447 25.2355 0.798399L29.1564 5.05469C29.4184 5.33912 29.821 5.44698 30.1901 5.33167L35.7138 3.60607C36.2718 3.43175 36.8597 3.77117 36.9878 4.34156L38.2552 9.98808C38.3399 10.3654 38.6346 10.6601 39.0119 10.7448L44.6584 12.0122C45.2288 12.1403 45.5682 12.7282 45.3939 13.2862L43.6683 18.8099C43.553 19.179 43.6609 19.5816 43.9453 19.8436L48.2016 23.7645C48.6316 24.1606 48.6316 24.8394 48.2016 25.2355L43.9453 29.1564C43.6609 29.4184 43.553 29.821 43.6683 30.1901L45.3939 35.7138C45.5682 36.2718 45.2288 36.8597 44.6584 36.9878L39.0119 38.2552C38.6346 38.3399 38.3399 38.6346 38.2552 39.0119L36.9878 44.6584C36.8597 45.2288 36.2718 45.5682 35.7138 45.3939L30.1901 43.6683C29.821 43.553 29.4184 43.6609 29.1564 43.9453L25.2355 48.2016C24.8394 48.6316 24.1606 48.6316 23.7645 48.2016L19.8436 43.9453C19.5816 43.6609 19.179 43.553 18.8099 43.6683L13.2862 45.3939C12.7282 45.5682 12.1403 45.2288 12.0122 44.6584L10.7448 39.0119C10.6601 38.6346 10.3654 38.3399 9.98808 38.2552L4.34156 36.9878C3.77117 36.8597 3.43175 36.2718 3.60607 35.7138L5.33167 30.1901C5.44698 29.821 5.33912 29.4184 5.05469 29.1564L0.798398 25.2355C0.368447 24.8394 0.368447 24.1606 0.798399 23.7645L5.05469 19.8436C5.33912 19.5816 5.44698 19.179 5.33167 18.8099L3.60607 13.2862C3.43175 12.7282 3.77117 12.1403 4.34156 12.0122L9.98808 10.7448C10.3654 10.6601 10.6601 10.3654 10.7448 9.98808L12.0122 4.34156C12.1403 3.77117 12.7282 3.43175 13.2862 3.60607L18.8099 5.33167C19.179 5.44698 19.5816 5.33912 19.8436 5.05469L23.7645 0.798398Z"
                                                fill="#D20202" />
                                        </svg>
                                        <p>${ val.discounted_percentage}%</p>
                                    </div>`:``}

                                </div>
                                <div class="content_wrapper book_card_content">
                                    <h3 class="title">${val.title}</h3>
                                    <p class="author">${$.map( val.authors, function( n ) {
                                            return n.name;
                                        })}</p>
                                    <div class="price_wrapper">
                                        ${ val.discounted_percentage != 0?`
                                            <h6 class="discount">${engToBangla(val.regular_price) } টাকা</h6>
                                            <h5 class="regular">${engToBangla(val.discounted_price) } টাকা</h5>`:
                                            `<h5 class="regular">${engToBangla(val.discounted_price)} টাকা</h5>`}
                                    </div>
                           
                                   
                                    
                                    
                                    <a href="${book_details_url}" class="btn_buy_now">Buy Now</a>
                                </div>
                            </div>
                        </div>`)
                        rateYo();
						});
                    }else{
                        $('#author_book_list').append(` <div class="col offset-4">
                            <h1 class="sc_title">বই নেই</h1>
                        </div>`);
                        }
						//alert("reponse success");
                    //success end
                }
            }); //ajax end
        }
        


        function category_filter_sidebar_filter(id) {
            
            var category_search_key_sidebar=$('#category_search_key_sidebar').val();
    
                console.log(category_search_key_sidebar)
            //alert(location_search); 
    
            $.ajax({
                url: book_fetch_config.routes.category_filter,
                method: "POST",
                data: {
                    category_search_key_sidebar: category_search_key_sidebar,
                    _token: "{{ csrf_token() }}"
                },
                dataType: "json",
                success: function(response) {
                 
                 if(response.success==true){
                    $("#category_list_div").empty();
                    if(response.category_list.length!=0){
                       
                        $.each(response.category_list, function(index, val) {
                            console.log(val);
                        $('#category_list_div').append(` <div class="form-check">
                                        <input class="form-check-input category_id" type="checkbox" name="priceDiscount"
                                            id="discountPrice${val.category_id }" onclick="book_fetch()">
                                        <label class="form-check-label" for="discountPrice${val.category_id }">
                                            ${val.name }
                                            
                                        </label>
                                    </div>`)
                        });
                        
                    }else{
                        $('#category_list_div').append(`<h1>পাওয়া যায়নি!</h1>`);
                        }
    
                 }
                    
    
                }
            }); //ajax end
        
        }

        function publisher_sidebar_filter(id) {
            
            var publisher_search_key_sidebar=$('#publisher_search_key_sidebar').val();
    
                console.log(publisher_search_key_sidebar)
            //alert(location_search); 
    
            $.ajax({
                url: book_fetch_config.routes.publisher_filter,
                method: "POST",
                data: {
                    publisher_search_key_sidebar: publisher_search_key_sidebar,
                    _token: "{{ csrf_token() }}"
                },
                dataType: "json",
                success: function(response) {
                 
                 if(response.success==true){
                    $("#publication_list_div").empty();
                    if(response.publication_list.length!=0){
                       
                        $.each(response.publication_list, function(index, val) {
                            console.log(val);
                        $('#publication_list_div').append(` <div class="form-check">
                                    <input class="form-check-input publisher_id" type="checkbox" name="publisher" id="publisher${val.publication_id}" onclick="book_fetch()">
                                    <label class="form-check-label" for="publisher${val.publication_id}" >
                                        ${val.name}
                                      
                                    </label>
                                </div>`)
                        });
                        
                    }else{
                        $('#publication_list_div').append(`<h1>পাওয়া যায়নি!</h1>`);
                        }
    
                 }
                    
    
                }
            }); //ajax end
        
        }
</script>
@endsection