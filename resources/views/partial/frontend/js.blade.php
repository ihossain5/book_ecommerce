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

<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.js"></script>

@yield('page-js')

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
        }
    };

    $("#loginModalForm").validate({
        rules: {
            number: {
                required: true,
                digits: true,
                minlength: 11,
                maxlength: 11,
            },


        },
        messages: {
            number: {
                required: 'Please insert your mobile number',
            },
        },
        errorPlacement: function(label, element) {
            label.addClass('h3 text-danger');
            label.insertAfter(element);
        },
    });

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

    $(document).on('submit', '#loginModalForm', function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: routeConfig.routes.login,
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            success: function(response) {
                if (response.success == true) {
                    $('.phone_number').addClass('d-none');
                    $('.otp_change').toggleClass('d-none');

                    $('#loginModalForm').attr('id', 'otpCheckForm');
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
    })

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
        $.ajax({
            url: "{{ route('book.filter.autocomplete') }}",
            type: 'post',
            dataType: "json",
            data: {
                search: search,
                _token: "{{ csrf_token() }}"
            },
            success: function(data) {
                $('#nav_bar_search_div').empty();
                if (data.value == null) {
                    $('#nav_bar_search_div').empty();
                } else {
                    if (data.value.length != 0) {
                        $.each(data.value, function(index, val) {
                            var book_details_url = '{{ route('frontend.book.details', ':id') }}';
                            book_details_url = book_details_url.replace(':id', val.value);
                            //console.log(val);
                            $('#nav_bar_search_div').append(
                                `<a href="${book_details_url}" class="btn_buy_now"><li class="bg-white rounded-pill" style="color:black">${val.label}</li></a>`
                                )
                        });
                    } else {
                        $('#nav_bar_search_div').append(`<li>পাওয়া যায়নি!</li>`);
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
</script>
