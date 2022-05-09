@extends('layouts.frontend.master')
@section('title', 'Popular Books')

@section('page-css')
<link rel="stylesheet" href="{{ asset('frontend/assets/css/books.css') }}">
@endsection

@section('book_header_title')
{{$title}}
@endsection

@section('content')

<section class="fillter_with_grid_section books_page pt-20 pb-120">

    @include('partial.frontend.book.book_header')

    <div class="container">
        <div class="row">

            @include('partial.frontend.book.book_filter')
            <input type="hidden" id="offer_id" value="{{ $offer_id??'' }}">
            <input type="hidden"  id="popularBook" value="true">
            <div class="col-lg-10">
                <div class="right_grid_content">
                    <div class="row row-cols-2 row-cols-sm-2 row-cols-md-3 row-cols-lg-5" id="book_list">
                        @foreach ($books as $key=>$book)
                        @if ($book->counted_order > 0)
                    
                        <div class="col">
                            <div class="book_card_wrapper">
                                <div class="image_wrapper">
                                    <a href="{{route('frontend.book.details',[$book->book_id])}}"
                                        class="d-block text-reset">
                                        <img class="img-fluid w-100" src="{{ asset('images/' . $book->cover_image) }}"
                                            alt="book image">
                                    </a>
                                    <div class="npb_hoberable">
                                        <button class="addtocart" onclick="addToCart({{ $book->book_id }})">Add to cart</button>
                                    </div>
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
                                    <h3 class="title"><a href="{{route('frontend.book.details',[$book->book_id])}}" class="text-reset">{{ $book->title }}</a></h3>
                                    <p class="author">
                                        @foreach ($book->authors as $author)
                                        <a href="{{route('frontend.author.details',[$author->author_id])}}" class="text-reset">{{ $author->name }}@if (!$loop->last) , @endif</a>                                        
                                        @endforeach
                                    </p>
                                    <div class="price_wrapper">
                                        @if ($book->discounted_percentage != null || $book->discounted_percentage != 0)
                                        <h6 class="discount">{{englishTobangla($book->regular_price)}} টাকা</h6>
                                        <h5 class="regular">{{englishTobangla($book->discounted_price)}} টাকা</h5>
                                        @else
                                        <h5 class="regular">{{englishTobangla($book->discounted_price)}} টাকা</h5>
                                        @endif
                                    </div>
                                    <a href="{{route('frontend.book.details',[$book->book_id])}}"
                                        class="btn_buy_now">বিস্তারিত</a>
                                        <div class="addtocart_smallview">
                                            <button class="addtocart" onclick="addToCart({{ $book->book_id }})">Add to cart</button>
                                        </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @endforeach


                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- pagination -->
    {{$books->links('partial.frontend.pagination')}}
</section>

@endsection
@section('page-js')

<script>
    ///////////////////////////////backend page codes////////////////////////////////////////
    var book_fetch_config = {
                routes: {
                    filter: "{!! route('popular.book.filter') !!}",
                    author_filter: "{!! route('author.sidebar.filter') !!}",
                    publisher_filter: "{!! route('publisher.sidebar.filter') !!}",
                    category_filter: "{!! route('category.sidebar.filter') !!}",
                   
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
           
            var offer_id=$('#offer_id').val();
            //alert(offer_id)
            
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
                        offer_id: offer_id,
                      
                        _token: "{{ csrf_token() }}"
                    },
                    dataType: "json",
                    success: function(response) {
    
                        $("#book_list").empty();
                        if(response.book_list.length!=0){
                            
                            $.each(response.book_list, function(index, val) {
                                var book_details_url = '{{ route('frontend.book.details', ':id') }}';
                                book_details_url = book_details_url.replace(':id', val.book_id);
                                //console.log(val);
                                if(val.counted_order >0){
                                    $('#book_list').append(`<div class="col">
                                <div class="book_card_wrapper">
                                    <div class="image_wrapper">
                                        <a href="${book_details_url}" class="d-block text-reset">
                                            <img class="img-fluid w-100" src="{{ asset('images/${val.cover_image}') }}"
                                                alt="book image">
                                        </a>
                                        <div class="npb_hoberable">
                                        <button class="addtocart" onclick="addToCart(${val.book_id})">Add to cart</button>
                                    </div>
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
                                        <a href="${book_details_url}" class="btn_buy_now">বিস্তারিত</a>
                                    <div class="addtocart_smallview">
                                            <button class="addtocart" onclick="addToCart(${val.book_id})">Add to cart</button>
                                        </div>
                                    </div>
                                </div>
                            </div>`)
                                }
                          
                            rateYo();
                            });
                        }else{
                            // $('#book_list').append(`<div class="col offset-4">
                            //     <h1 class="d-flex justify-content-center align-items-center h-100" >বই নেই</h1>
                            // </div>`);
                            }
                            //alert("reponse success");
                        //success end
                    }
                }); //ajax end
            }




            function author_sidebar_filter(id) {
            
            var writer_search_key_sidebar=$('#writer_search_key_sidebar').val();
    
                console.log(writer_search_key_sidebar)
            //alert(location_search); 
    
            $.ajax({
                url: book_fetch_config.routes.author_filter,
                method: "POST",
                data: {
                    writer_search_key_sidebar: writer_search_key_sidebar,
                    _token: "{{ csrf_token() }}"
                },
                dataType: "json",
                success: function(response) {
                 
                 if(response.success==true){
                    $("#author_list_div").empty();
                    if(response.author_list.length!=0){
                       
                        $.each(response.author_list, function(index, val) {
                            console.log(val);
                        $('#author_list_div').append(`<div class="form-check">
                                        <input class="form-check-input writer_id" type="checkbox" name="writer" id="writer${val.author_id }" onclick="book_fetch()">
                                        <label class="form-check-label" for="writer${val.author_id }">
                                            ${val.name }
                                        </label>
                                    </div>`)
                        });
                        
                    }else{
                        $('#author_list_div').append(`<h1>পাওয়া যায়নি!</h1>`);
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
</script>
@endsection