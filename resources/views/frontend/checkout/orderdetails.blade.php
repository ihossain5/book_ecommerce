@extends('layouts.frontend.master')
@section('title', 'Order Details')

@section('page-css')
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/checkout.css') }}">
@endsection

@section('content')
    <section class="checkout_container checkout_p">
        <div class="row">
            <div class="col-lg-6">
                <div class="checkout_box2">
                    {{-- <div class="check_img">
                        <img src="assets/images/book-details/1638787287 2.png" alt="">
                    </div> --}}
                    <h1>প্রিয় গ্রাহক আপনার অর্ডারটি সম্পন্ন হয়েছে</h1>
                    <p>ভোরের কাগজ প্রকাশন থেকে অর্ডার করার জন্য আপনাকে ধন্যবাদ</p>
                    <h4>অর্ডার কোডঃ <span>#{{ $orderDetails->order_id }}</span></h4>
                    <a href="{{ route('order.invoice.download', [$orderDetails->order_id]) }}"><button class="order_btn">ডাউনলোড করুন</button></a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="checkout_box">
                    <div class="right_wraper form_wraper">
                        <div class="d-flex justify-content-between shop_header align-items-center">
                            <h2>আপনার শপিং লিস্ট</h2>
                            {{-- <h6>৪টি আইটেম</h6> --}}
                        </div>
                        <div>
                        @foreach($orderDetails->books as $book)
                            <div class="check_cart_item">
                                <div>{{ englishTobangla($book->pivot->quantity) }}টি <span>{{ $book->title }}</span></div>
                                <div>
                                    {{ $book->pivot->amount }} টাকা
                                    {{-- <del>90 টাকা</del> --}}
                                </div>
                            </div>
                            {{-- <div class="check_cart_item">
                                <div>১টি <span>বইয়ের নাম</span></div>
                                <div>
                                    ১৮০ টাকা
                                    <del>90 টাকা</del>
                                </div>
                            </div> --}}
                            @endforeach
                        </div>

                        <div>
                            <div class="cart_fees">
                                <div>
                                    সাব টোটাল
                                </div>
                                <div>
                                    {{ $orderDetails->subtotal }} টাকা
                                </div>
                            </div>
                            <div class="cart_fees">
                                <div>
                                    উপহারের মোড়ক
                                </div>
                                <div>
                                    {{ $orderDetails->wrapping_cost }} টাকা
                                </div>
                            </div>
                            <div class="cart_fees">
                                <div>
                                    ডেলিভারি ফি
                                </div>
                                <div>
                                    {{ $orderDetails->delivery_fee }} টাকা
                                </div>
                            </div>
                            <div class="cart_fees">
                                <div>
                                    টোটাল
                                </div>
                                <div>
                                    {{ $orderDetails->total }} টাকা
                                </div>
                            </div>
                        </div>


                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection

@section('page-js')
   
@endsection
