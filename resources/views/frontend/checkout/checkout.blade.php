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
    <form action="#">
        <div class="row">
            <div class="col-lg-6">
                <div class="checkout_box">
                    <div class="form_wraper">
                        <!-- <h1>চেকআউট</h1> -->
                        <h3>ব্যক্তিগত তথ্য</h3>
                        <div class="form_group">
                            <label for="name" class="form-label">নাম</label>
                            <input type="text" class="form-control" id="name" placeholder="আপনার নাম" value="{{$user->name}}">
                        </div>
                        <div class="form_group">
                            <label for="phone" class="form-label">ফোন নম্বর</label>
                            <input type="text" class="form-control" id="phone" placeholder="আপনার ফোন নম্বর" value="{{$user->phone}}">
                        </div>
                        <div class="form_group">
                            <label for="email" class="form-label">ইমেইল অ্যাড্রেস</label>
                            <input type="text" class="form-control" id="email" placeholder="আপনার ইমেইল অ্যাড্রেস" value="{{$user->email}}">
                        </div>

                        <h3 class="pt-5 mt-5">ঠিকানা</h3>
                        <div class="form_group">
                            <label for="areaSelect" class="form-label">ঠিকানা নির্বাচন করুন</label>
                            <select class="form-select" id="areaSelect">
                                <option selected>ঠিকানা নির্বাচন করুন</option>
                                @if (!empty($user->addresses))
                                    @foreach ($user->addresses as $address)
                                        <option value="{{$address->address_id}}" {{$address->inside_dhaka_city ==1 ? 'selected' : ''}}>{{$address->name}},{{$address->mobile}},{{$address->division}},{{$address->district}},{{$address->address}},{{$address->inside_dhaka_city == 1 ?'Inside Dhaka city' : 'Outside Dhaka city'}}</option>
                                    @endforeach
                                @endif
                               
                            </select>
                        </div>
                        <div class="form_group">
                            <label for="areaWiseName" class="form-label">নাম</label>
                            <input type="text" class="form-control" id="areaWiseName" placeholder="আপনার নাম" value="{{$default_address->name}}">
                        </div>
                        <div class="form_group">
                            <label for="areaWisePhone" class="form-label">মোবাইল</label>
                            <input type="text" class="form-control" id="areaWisePhone" placeholder="আপনার মোবাইল" value="{{$default_address->mobile}}">
                        </div>
                        <div class="form_group">
                            <label for="division" class="form-label">বিভাগ</label>
                            <select class="form-select" id="division">
                                <option selected >{{$default_address->division}}</option>
                                {{-- <option value="1">বিভাগ 1</option>
                                <option value="2">বিভাগ 2</option>
                                <option value="3">বিভাগ 3</option> --}}
                            </select>
                        </div>
                        <div class="form_group">
                            <label for="distric" class="form-label">জেলা</label>
                            <select class="form-select" id="distric">
                                <option selected> {{$default_address->district}}</option>
                                {{-- <option value="1">জেলা 1</option>
                                <option value="2">জেলা 2</option>
                                <option value="3">জেলা 3</option> --}}
                            </select>
                        </div>
                        <div class="form_group">
                            <label for="address" class="form-label">ঠিকানা</label>
                            <textarea name="address" class="form-control" id="address" cols="30" rows="4"
                                placeholder="ঠিকানা" value="{{$default_address->address}}"></textarea>
                        </div>
                        <h3 class="pt-5 mt-5">পেমেন্ট তথ্য</h3>

                        <div class="form_group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="cashOnDel">
                                <label class="form-check-label" for="cashOnDel">
                                    ক্যাশ অন ডেলিভারি
                                </label>
                            </div>
                        </div>
                        <div class="form_group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="bkash">
                                <label class="form-check-label" for="bkash">
                                    বিকাশ/নগদ
                                </label>
                            </div>
                        </div>
                        <div class="form_group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="creditDabit">
                                <label class="form-check-label" for="creditDabit">
                                    ক্রেডিট/ডেবিট কার্ড
                                </label>
                            </div>
                        </div>

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
                            <h6>{{ englishTobangla($cartService->numberOfCartQty())}}টি আইটেম</h6>
                        </div>
                        <div>
                            @if (!empty($cartService->getCartContent()))
                                @foreach ($cartService->getCartContent() as $cartItem)
                                <div class="check_cart_item">
                                    <div>{{englishTobangla($cartItem->qty)}}টি <span>{{$cartItem->name}}</span></div>
                                    <div>
                                        {{englishTobangla($cartItem->price * $cartItem->qty)}} টাকা
                                        <del> {{englishTobangla($cartItem->options->regular_price * $cartItem->qty)}} টাকা</del>
                                    </div>
    
                                </div>
                                @endforeach
                            @endif
                    
                        </div>

                        <div>
                            <div class="cart_fees">
                                <div>
                                    সাব টোটাল
                                </div>
                                <div>
                                    {{ englishTobangla($cartService->subTotal())}} টাকা
                                </div>
                            </div>

                            <div class="cart_fees">
                                <div>
                                    ডেলিভারি ফি
                                </div>
                                <div>
                                    ০ টাকা
                                </div>
                            </div>
                            <div class="cart_fees">
                                <div>
                                    টোটাল
                                </div>
                                <div>
                                    {{ englishTobangla($cartService->subTotal())}} টাকা
                                </div>
                            </div>
                        </div>

                        <div class="form_group">
                            <label for="addInfo" class="form-label">বিশেষ নোট</label>
                            <textarea name="addInfo" class="form-control" id="addInfo" cols="30" rows="4"
                                placeholder="এখানে লিখুন..."></textarea>
                        </div>
                        <div>
                            <button class="confirm_bn">অর্ডার কনফার্ম করুন</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </form>
</section>

@endsection

@section('page-js')

@endsection