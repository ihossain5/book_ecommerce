@extends('layouts.frontend.master')
@section('title', 'Checkout')

@section('page-css')
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/checkout.css') }}">
@endsection

@section('content')
    <section class="checkout_container checkout_p">
        <div class="row">
            <h1>চেকআউট</h1>
        </div>
        <form method="POST" class="checkoutForm">@csrf
            <div class="row">
                <div class="col-lg-6">
                    <div class="checkout_box">
                        <div class="form_wraper">
                            <!-- <h1>চেকআউট</h1> -->
                            <h3>ব্যক্তিগত তথ্য</h3>
                            <div class="form_group">
                                <label for="name" class="form-label">নাম</label>
                                <input type="text" class="form-control" id="name" placeholder="আপনার নাম"
                                    value="{{ $user->name }}">
                            </div>
                            <div class="form_group">
                                <label for="phone" class="form-label">ফোন নম্বর</label>
                                <input type="text" class="form-control" id="phone" placeholder="আপনার ফোন নম্বর"
                                    value="{{ $user->phone }}">
                            </div>
                            <div class="form_group">
                                <label for="email" class="form-label">ইমেইল অ্যাড্রেস</label>
                                <input type="text" class="form-control" id="email" placeholder="আপনার ইমেইল অ্যাড্রেস"
                                    value="{{ $user->email }}">
                            </div>

                            <h3 class="pt-5 mt-5">ঠিকানা</h3>
                            <div class="form_group">
                                <label for="areaSelect" class="form-label">ঠিকানা নির্বাচন করুন</label>
                                <select class="form-select" id="areaSelect">
                                    {{-- <option value="">ঠিকানা নির্বাচন করুন</option> --}}
                                    @if (!empty($user->addresses))
                                        @foreach ($user->addresses as $address)
                                            <option value="{{ $address->address_id }}"
                                                {{ $address->pivot->is_default == 1 ? 'selected' : '' }}>
                                                {{ $address->name }},{{ $address->mobile }},{{ $address->address }},{{ $address->inside_dhaka_city == 1 ? 'Inside Dhaka city' : 'Outside Dhaka city' }}
                                            </option>
                                        @endforeach
                                    @endif

                                </select>
                            </div>
                            <div class="form_group">
                                <label for="areaWiseName" class="form-label">নাম</label>
                                <input type="text" name="name" class="form-control" id="areaWiseName"
                                    placeholder="আপনার নাম" value="{{ $default_address->name ?? '' }}">
                            </div>
                            <div class="form_group">
                                <label for="areaWisePhone" class="form-label">মোবাইল</label>
                                <input type="text" name="phone" class="form-control" id="areaWisePhone"
                                    placeholder="আপনার মোবাইল" value="{{ $default_address->mobile ?? '' }}">
                            </div>
                            <div class="form_group">
                                <label for="areaWisePhone" class="form-label">বিভাগ</label>
                                <input type="text" name="division" class="form-control" id="division"
                                    placeholder="আপনার বিভাগ" value="{{ $default_address->division ?? '' }}">
                            </div>

                            <div class="form_group">
                                <label for="areaWisePhone" class="form-label">জেলা</label>
                                <input type="text" name="district" class="form-control" id="default_distric"
                                    placeholder="আপনার জেলা" value="{{ $default_address->district ?? '' }}">
                            </div>
                            {{-- <div class="form_group">
                            <label for="division" class="form-label">বিভাগ</label>
                            <select class="form-select" id="division">
                                <option value="{{$default_address->address_id}}" >{{$default_address->division}}</option>
            
                            </select>
                        </div> --}}

                            {{-- <div class="form_group">
                            <label for="distric" class="form-label">জেলা</label>
                            <select class="form-select" id="distric">
                                <option value=""> {{$default_address->district}}</option>
               
                            </select>
                        </div> --}}

                            <div class="form_group">
                                <label for="address" class="form-label">ঠিকানা</label>
                                <textarea name="address" class="form-control" id="address" cols="30" rows="4"
                                    placeholder="ঠিকানা">{{ $default_address->address ?? '' }}</textarea>
                            </div>
                            <h3 class="pt-5 mt-5">পেমেন্ট তথ্য</h3>


                            <div class="form_group">
                                <div class="form-check">
                                    <input class="form-check-input" name="paymentMethod" type="radio" id="cashOnDel"
                                        value="1">
                                    <label class="form-check-label" for="cashOnDel">
                                        ক্যাশ অন ডেলিভারি
                                    </label>
                                </div>
                            </div>
                            <div class="form_group">
                                <div class="form-check">
                                    <input class="form-check-input" name="paymentMethod" type="radio" id="bkash" value="2">
                                    <label class="form-check-label" for="bkash">
                                        বিকাশ/নগদ
                                    </label>
                                </div>
                            </div>
                            <div class="form_group">
                                <div class="form-check">
                                    <input class="form-check-input" name="paymentMethod" type="radio" id="creditDabit"
                                        value="3">
                                    <label class="form-check-label" for="creditDabit">
                                        ক্রেডিট/ডেবিট কার্ড
                                    </label>
                                </div>
                            </div>
                            <label id="paymentMethod-error" class="error h3 text-danger" for="paymentMethod"></label>

                            <!-- <div class="form_group">
                                                                            <label for="address" class="form-label">আরও তথ্য</label>
                                                                            <textarea name="address" class="form-control" id="address" cols="30" rows="4"
                                                                                placeholder="এখানে লিখুন..."></textarea>
                                                                        </div> -->
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="checkout_box">
                        <div class="right_wraper form_wraper">
                            <div class="d-flex justify-content-between shop_header align-items-center">
                                <h2>আপনার শপিং লিস্ট</h2>
                                <h6>{{ englishTobangla($cartService->numberOfCartQty()) }}টি আইটেম</h6>
                            </div>
                            <div>
                                @if (!empty($cartService->getCartContent()))
                                    @foreach ($cartService->getCartContent() as $cartItem)
                                        <div class="check_cart_item">
                                            <div>{{ englishTobangla($cartItem->qty) }}টি
                                                <span>{{ $cartItem->name }}</span>
                                            </div>
                                            <div>
                                                {{ englishTobangla($cartItem->price * $cartItem->qty) }} টাকা
                                                <del>
                                                    {{ englishTobangla($cartItem->options->regular_price * $cartItem->qty) }}
                                                    টাকা</del>
                                            </div>

                                        </div>
                                    @endforeach
                                @endif

                            </div>

                            <div>
                                <div class="cart_chack">
                                    <div class="form-check">
                                        <input class="form-check-input" id="checkBox" type="checkbox"
                                            name="permanent_address" value="">
                                        <label class="form-check-label"> উপহারের মোড়ক</label>
                                    </div>
                                </div>
                                <div class="cart_fees">
                                    <div>
                                        সাব টোটাল
                                    </div>
                                    <div>
                                        {{ englishTobangla($cartService->subTotal()) }} টাকা
                                    </div>
                                </div>

                                <div class="cart_fees">
                                    <div>
                                        ডেলিভারি ফি
                                    </div>
                                    @if (!empty($default_address))
                                        <input type="hidden" name="delivery_fee" id="deliveryFee"
                                            value="{{ $default_address->inside_dhaka_city == 1? $cartService->insideDhakadeliveryFee: $cartService->outsideDhakadeliveryFee }}">
                                        <div class="deliveryFee">

                                            {{ $default_address->inside_dhaka_city == 1? englishTobangla($cartService->insideDhakadeliveryFee): englishTobangla($cartService->outsideDhakadeliveryFee) }}
                                            টাকা
                                        </div>
                                    @else
                                        <input type="hidden" name="delivery_fee" id="deliveryFee" value="0">
                                        <div class="deliveryFee">
                                            {{ englishTobangla(0) }}

                                            টাকা
                                        </div>
                                    @endif

                                </div>

                                <div class="cart_fees d-none" id="giftWrapper">
                                    <div>
                                        উপহারের মোড়ক
                                    </div>
                                    <input type="hidden" name="delivery_fee" id="giftWrapperCost" value="0">
                                    <div class="deliveryFee giftWrapper"></div>

                                </div>

                                <div class="cart_fees">
                                    <div>
                                        টোটাল
                                    </div>
                                    <input type="hidden" name="subtotal" id="total"
                                        value="{{ $cartService->subTotal() }}">

                                    <input type="hidden" name="subtotal" id="grandTotal" value="{{ $total }}">

                                    <div class="grandTotal">

                                        {{ englishTobangla($total) }} টাকা
                                    </div>
                                </div>
                            </div>

                            <div class="form_group">
                                <label for="addInfo" class="form-label">বিশেষ নোট</label>
                                <textarea name="note" class="form-control" id="notes" cols="30" rows="4"
                                    placeholder="এখানে লিখুন..."></textarea>
                            </div>
                            <div>
                                <button type="button" onclick="validateForm()" class="confirm_bn">অর্ডার কনফার্ম
                                    করুন</button>
                                <button type="button" class="confirm_bn d-none" id="sslczPayBtn"
                                    token="if you have any token validation" postdata=""
                                    order="If you already have the transaction generated for current order"
                                    endpoint="/pay-via-ajax"> অর্ডার কনফার্ম করুন
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </form>
    </section>

@endsection

@section('page-js')
    <script>

    
        (function(window, document) {
            var loader = function() {
                var script = document.createElement("script"),
                    tag = document.getElementsByTagName("script")[0];
                script.src = "https://sandbox.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(
                    7);
                tag.parentNode.insertBefore(script, tag);
            };

            window.addEventListener ? window.addEventListener("load", loader, false) : window.attachEvent("onload",
                loader);
        })(window, document);

        $(document).on('change', '#areaSelect', function() {


            var val = $(this).val();

            if (val == '') {
                // alert('asdas');
            } else {
                $.ajax({
                    url: "{!! route('get.customer.address') !!}",
                    method: "post",
                    data: {
                        id: val,
                        _token: "{{ csrf_token() }}"
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.success == true) {
                            $('#areaWiseName').val(response.data.name)
                            $('#areaWisePhone').val(response.data.mobile)
                            $('#division').val(response.data.division)

                            $('#default_distric').val(response.data.district)

                            $('#address').val(response.data.address)

                            var total = format_value($('#total').val());

                            var newTotal;

                            if (response.data.inside_dhaka_city == 1) {
                                newTotal = total + 60;

                                $('.deliveryFee').html(engToBangla(60) + ' টাকা');
                                $('#deliveryFee').val(60);
                            } else {

                                newTotal = total + 120;
                                $('.deliveryFee').html(engToBangla(120) + ' টাকা');
                                $('#deliveryFee').val(120);
                            }
                            $('.grandTotal').html(engToBangla(newTotal) + ' টাকা');

                        } //success end

                    },
                    error: function(error) {
                        if (error.status == 404) {

                        }
                    },
                }); //ajax end
            }
        })



        function format_value(val) {
            var number = Number(val.replace(/[^0-9\.-]+/g, ""));
            var val = parseFloat(number);
            return val;

        }

        $(".checkoutForm").validate({
            rules: {
                name: {
                    required: true,
                },
                email: {
                    required: true,
                    email: true,
                },
                paymentMethod: {
                    required: true,
                },
                phone: {
                    required: true,
                    digits: true,
                    minlength: 11,
                    maxlength: 11,
                },
                district: {
                    required: true,
                    maxlength: 255
                },
                division: {
                    required: true,
                    maxlength: 255
                },
                address: {
                    required: true,
                    maxlength: 5000
                },


            },
            messages: {

            },
            errorPlacement: function(label, element) {
                label.addClass('h3 text-danger');
                label.insertAfter(element);
            },
        });

        $(document).on('submit', '.checkoutForm', function(e) {
            e.preventDefault();
            // $.ajax({
            //     url: "{!! route('order.place') !!}",
            //     method: "post",
            //     data: new FormData(this),
            //     contentType: false,
            //     cache: false,
            //     processData: false,
            //     dataType: "json",
            //     success: function(response) {
            //         if (response.success == true) {
            //             var url = '{{ route('frontend.home') }}';
            //             location.replace(url);

            //         } //success end

            //     },
            //     error: function(error) {
            //         if (error.status == 422) {
            //             $.each(error.responseJSON.errors, function(i, message) {
            //                 toastr['error'](message);
            //             });

            //         }
            //     },
            // }); //ajax end  
        });

        var name;
        var phone;
        var division;
        var default_distric;
        var address;
        var deliveryFee;
        var addInfo;
        var email;
        var giftWrapperCost;

        function validateForm() {
            $('.checkoutForm').submit();

            var slecetMethod = $("input:radio[name=paymentMethod]:checked").val();

            name = $('#areaWiseName').val();
            phone = $('#areaWisePhone').val();
            division = $('#division').val();
            default_distric = $('#default_distric').val();
            address = $('#address').val();
            deliveryFee = $('#deliveryFee').val();
            addInfo = $('#notes').val();
            email = $('#email').val();
            giftWrapperCost = $('#giftWrapperCost').val();

            if ($('.checkoutForm').valid() == true) {
                var obj = {};
                obj.name = $('#areaWiseName').val();
                obj.phone = $('#areaWisePhone').val();
                obj.division = $('#division').val();
                obj.district = $('#default_distric').val();
                obj.address = $('#address').val();
                obj.deliveryFee = $('#deliveryFee').val();
                obj.notes = $('#notes').val();
                obj.email = $('#email').val();
                obj.giftWrapperCost = $('#giftWrapperCost').val();


                $('#sslczPayBtn').prop('postdata', obj);

                if (slecetMethod == 1) {

                    checkoutByCash();
                } else if (slecetMethod == 3 || slecetMethod == 2) {


                    if (name == '' || phone == '' || division == '' || default_distric == '' || address == '' ||
                        deliveryFee ==
                        '') {
                        toastr['error']('Please fill up all fields');
                    } else {
                        $('#sslczPayBtn').trigger('click');
                    }
                }
            }





            // $('#sslczPayBtn').trigger('click');

        }

        function checkoutByCash() {
            $.ajax({
                url: "{!! route('order.place') !!}",
                method: "post",
                data: {
                    name: name,
                    phone: phone,
                    division: division,
                    district: default_distric,
                    address: address,
                    delivery_fee: deliveryFee,
                    addInfo: addInfo,
                    email: email,
                    giftWrapperCost: giftWrapperCost,
                    _token: "{{ csrf_token() }}"
                },
                dataType: "json",
                
                success: function(response) {
                    if (response.success == true) {
                        //var orderdetails_url = config.routes.getOrderDetails;
                        //orderdetails_url = orderdetails_url.replace(':id', response.data.order_id);
                        //console.log(orderdetails_url);
                        
                        //location.replace(orderdetails_url);

                        var orderdetails_url = '{{ route('order.details', ':id') }}';
                        orderdetails_url = orderdetails_url.replace(':id', response.data.order_id);
                        window.location.replace(orderdetails_url);

                    } //success end

                },
                error: function(error) {
                    if (error.status == 422) {
                        $.each(error.responseJSON.errors, function(i, message) {
                            toastr['error'](message);
                        });

                    }
                },
            }); //ajax end  
        }

        $('#checkBox').click(function() {

            var total = format_value($('#grandTotal').val());

            var cost;

            if ($(this).is(':checked')) {
                $.ajax({
                    url: "{!! route('get.gift.wrapper') !!}",
                    method: "post",
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.success == true) {

                            cost = response.data.cost;

                            $('#giftWrapper').removeClass('d-none')
                            $('.giftWrapper').html(engToBangla(cost) + ' টাকা')
                            $('#giftWrapperCost').val(cost)



                            var newTotal = total + cost;

                            $('.grandTotal').html(engToBangla(newTotal) + ' টাকা');

                        } //success end

                    },
                    error: function(error) {
                        if (error.status == 422) {
                            $.each(error.responseJSON.errors, function(i, message) {
                                toastr['error'](message);
                            });

                        }
                    },
                }); //ajax end  


            } else {
                $('#giftWrapperCost').val(0)
                $('.grandTotal').html(engToBangla(total) + ' টাকা');

                $('#giftWrapper').addClass('d-none')
            }

        });
    </script>
@endsection
