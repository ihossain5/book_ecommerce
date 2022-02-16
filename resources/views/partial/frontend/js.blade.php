{{-- <script src="{{ asset('frontend/assets/js/vendor/jquery-3.6.0.min.js') }}"></script> --}}
<!-- Jquery CDNJS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{ asset('frontend/assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/jquery.rateyo.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/common.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="{{ asset('frontend/assets/js/cart.js') }}"></script>
<script src="{{ asset('frontend/assets/js/auth.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.js"></script>



<script>
    toastr.options = {
        "closeButton": true,
        "debug": true,
        "tapToDismiss ": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-bottom-right",
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "autohide": false,
    }
    @if (Session::has('error'))
        var message = "{{ Session::get('error') }}";
        toastr["error"](message)
    @endif

    @if (Session::has('success'))
        var message = "{{ Session::get('success') }}";
        toastr["success"](message)
    @endif


    var routeConfig = {
        routes: {
            login: "{!! route('send.otp') !!}",
            verifyOtp: "{!! route('verify.otp') !!}",
            filterBookByPrice: "{!! route('book.filter.price') !!}",
        }
    };

    // $("#loginModalForm").validate({
    //     rules: {
    //         number: {
    //             required: true,
    //             digits: true,
    //             minlength: 11,
    //             maxlength: 11,
    //         },


    //     },
    //     messages: {
    //         number: {
    //             required: 'Please insert your mobile number',
    //         },
    //     },
    //     errorPlacement: function(label, element) {
    //         label.addClass('h3 text-danger');
    //         label.insertAfter(element);
    //     },
    // });

    // $(".login_auth_box").validate({
    //     rules: {
    //         otp: {
    //             required: true,
    //             digits: true,
    //             minlength: 6,
    //             maxlength: 6,
    //         },


    //     },
    //     messages: {
    //         otp: {
    //             required: 'Please insert your otp code',
    //         },
    //     },
    //     errorPlacement: function(label, element) {
    //         label.addClass('h3 text-danger');
    //         label.insertAfter(element);
    //     },
    // });

    $("#otpCheckForm").validate({
        rules: {
            otp: {
                required: true,
                digits: true,
                minlength: 6,
                maxlength: 6,
            },
        },
        messages: {
            otp: {
                required: 'Please insert your otp code',
            },
        },
        errorPlacement: function(label, element) {
            label.addClass('h3 text-danger');
            label.insertAfter(element);
        },
    });

    // $(document).on('submit', '#loginModalForm', function(e) {
    //     e.preventDefault();
    //     $.ajax({
    //         type: "POST",
    //         url: routeConfig.routes.login,
    //         data: new FormData(this),
    //         contentType: false,
    //         cache: false,
    //         processData: false,
    //         dataType: "json",
    //         success: function(response) {
    //             if (response.success == true) {
    //                 $('.phone_number').addClass('d-none');
    //                 $('.otp_change').toggleClass('d-none');

    //                 $('#loginModalForm').attr('id', 'otpCheckForm');
    //             } else {
    //                 toastr['error'](response.data);
    //             }
    //         },
    //         error: function(error) {

    //             if (error.status == 422) {
    //                 $.each(error.responseJSON.errors, function(i, message) {
    //                     toastr['error'](message);
    //                 });

    //             }
    //         },
    //     });
    // })

    $(document).on('submit', '#otpCheckForm', function(e) {
        e.preventDefault();

        var otp = $('.loginModalOtp').val();
        if (otp == '') {
            $('.loginModalOtp').after(`
            <label id="otp-error" class="error h3 text-danger" for="otp">Please insert your otp code</label>
            `);
        } else if (otp.length < 6 || otp.length > 6) {
            $('.loginModalOtp').after(`
            <label id="otp-error" class="error h3 text-danger" for="otp">Please provide a valide otp code</label>
            `);
        } else {
            $('#otp-error').addClass('d-none');

            $.ajax({
                type: "POST",
                url: routeConfig.routes.verifyOtp,
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function(response) {
                    if (response.success == true) {
                        location.reload();
                    } else {
                        toastr['error'](response.data);
                    }
                },
                error: function(error) {
                    if (error.status == 422) {
                        $.each(error.responseJSON.errors, function(i, message) {
                            toastr['error'](message);
                        });

                    }
                },
            });
        }


    })

    function book_search_method() {

        var search = $('#navbar_search').val();
        var search_mobile = $('#navbar_search_mobile').val();
        //var search =$("input[name='navbar_search']").val();
        //alert(search)
        $.ajax({
            url: "{{ route('book.filter.autocomplete') }}",
            type: 'post',
            dataType: "json",
            data: {
                search: search,
                search_mobile: search_mobile,
                _token: "{{ csrf_token() }}"
            },
            success: function(data) {
                $('.autoCompleteBox').empty();
                if (data.value == null) {
                    $('.autoCompleteBox').empty();
                } else {
                    if (data.value.length != 0) {
                        $.each(data.value, function(index, val) {
                            var book_details_url = '{{ route('frontend.book.details', ':id') }}';
                            book_details_url = book_details_url.replace(':id', val.value);
                            //console.log(val);
                            $('.autoCompleteBox').append(
                                `<a href="${book_details_url}">
                                        <div class="d-flex justify-content-between auto_complete_item">
                                            <div class="d-flex justify-content-start">
                                                <div>
                                                    <img src="${location.origin}/images/${val.image}" alt="">
                                                </div>
                                                <div>
                                                    <h2>${val.title}</h2>
                                                    <h5>
                                                        ${ $.map( val.authors, function( n ) {
                                                                return n.name;
                                                            })}
                                                        </h5>
                                                </div>
                                            </div>
                                            <div>
                                                <h1>${val.price} টাকা</h1>
                                            </div>
                                        </div>
                                    </a>`
                            )
                        });
                    } else {
                        $('.autoCompleteBox').append(`<h1>পাওয়া যায়নি!</h1>`);
                    }
                }
            }
        });
    };


    function rateYo() {
        for (let i = 0; i < $(".rateYo").length; i++) {
            $(`.ratSerialId${i}`).rateYo({
                starWidth: "20px",
                normalFill: "none",
                ratedFill: "#F2C94C",
                rating: $(`.ratSerialId${i}`).data("user_rating"),
                readOnly: true,
                starSvg: `<svg xmlns="http://www.w3.org/2000/svg" width="20" height="19" viewBox="0 0 20 19" fill="none">
      <path d="M10 1.34175L12.1223 6.62665L12.2392 6.91794L12.5524 6.93918L18.2345 7.32445L13.8641 10.976L13.6232 11.1772L13.6998 11.4817L15.0892 17.0047L10.2659 13.9765L10 13.8096L9.73415 13.9765L4.91081 17.0047L6.30024 11.4817L6.37683 11.1772L6.13594 10.976L1.76551 7.32445L7.44757 6.93918L7.76076 6.91794L7.87773 6.62665L10 1.34175Z" stroke="#F2C94C"/>
      </svg>`,
            });
        }
    }

    // $(".loginForm").validate({
    //     rules: {
    //         number: {
    //             required: true,
    //             digits: true,
    //             minlength: 11,
    //             maxlength: 11,
    //         },
    //         password: {
    //             required: true,
    //             minlength: 8,

    //         },


    //     },
    //     messages: {
    //         number: {
    //             required: 'Please insert your mobile number',
    //         },
    //     },
    //     errorPlacement: function(label, element) {
    //         label.addClass('h3 text-danger');
    //         label.insertAfter(element);
    //     },
    // });

    var form = '.loginForm';
    var errorMessageDiv = '.signInErrorMessage';
    var url = "{!! route('frontend.sign.in') !!}";

    loginFormValidation(form);
    singIn(form, url, errorMessageDiv);

    // $(document).off('submit', '.loginForm');
    // $(document).on('submit', '.loginForm', function(event) {
    //     event.preventDefault();


    //     $.ajax({
    //         type: "POST",
    //         url: "{!! route('frontend.sign.in') !!}",
    //         data: new FormData(this),
    //         contentType: false,
    //         cache: false,
    //         processData: false,
    //         dataType: "json",
    //         success: function(response) {
    //             if (response.success == true) {
    //                 location.reload();
    //             } else {
    //                 $('.messageDiv').empty();
    //                 $('.passwordDiv').after(
    //                     `<div class="col-12 mb-3 messageDiv">
    //                         <P class='text-danger h3'>${response.data}</p>
    //                     </div>`
    //                 )
    //                 // toastr['error'](response.data);
    //             }
    //         },
    //         error: function(error) {
    //             if (error.status == 422) {
    //                 $.each(error.responseJSON.errors, function(i, message) {
    //                     toastr['error'](message);
    //                 });

    //             }
    //         },
    //     });

    // });

    // for discount modal
    $(window).on('load', function() {
        $('#discountModal').modal('show');

        setTimeout(function() {
            $('#discountModal').modal('hide');
        }, 10000);
    });

    function filterByPrice() {

        var minValue = $('.minAmount').val();
        var maxValue = $('.maxAmount').val();
        var popularBook = $('#popularBook').val();
        var offer_id = $('#offer_id').val();
        var category_id = $('#category_id').val();
        var author_id = $('#author_id').val();
        var bookItems = $('#bookItems').val();
        var publication_id = $('#publication_id').val();


        if (minValue <= 0 || maxValue < 1) {
            alert('asdsa');
        } else {
            $.ajax({
                type: "POST",
                url: routeConfig.routes.filterBookByPrice,
                data: {
                    minValue: minValue,
                    maxValue: maxValue,
                    popularBook: popularBook,
                    offer_id: offer_id,
                    category_id: category_id,
                    author_id: author_id,
                    books: bookItems,
                    publication_id: publication_id,
                    _token: "{{ csrf_token() }}",
                },
                dataType: "json",
                success: function(response) {
                    if (response.success == true) {
                        $("#book_list").empty();

                        if (response.data.length > 0) {
                            $.each(response.data, function(index, val) {
                                var book_details_url =
                                    '{{ route('frontend.book.details', ':id') }}';
                                book_details_url = book_details_url.replace(':id', val.book_id);

                                $('#book_list').append(appendBooks(val, book_details_url));

                            });
                        } else {

                        }
                    }
                },
                error: function(error) {
                    if (error.status == 422) {
                        $.each(error.responseJSON.errors, function(i, message) {
                            toastr['error'](message);
                        });

                    }
                },
            });
        }
    }

    function appendBooks(val, book_details_url) {
        return `<div class="col">
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
                            </div>`;
    }
</script>

@yield('page-js')
