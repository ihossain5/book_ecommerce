@extends('layouts.frontend.master')
@section('title', 'Cart')

@section('page-css')
<link rel="stylesheet" href="{{ asset('frontend/assets/css/cart.css') }}">
@endsection

@section('content')
    <!-- Cart Page -->
    <div class="cart_for_large pt-20 pb-120">
        <div class="container">
            @if ($items->count()>0)
            <div class="large_cart_wrapper cartRow">
                <div>
                     
                    <div class="large_cart_inner">
                        <div class="row">
                            <div class="col-sm-2 col-lg-2">
                                <p class="header"> মুছে ফেলুন</p>
                            </div>
                            <div class="col-sm-4 col-lg-4">
                                <p class="header">পণ্য</p>
                            </div>
                            <div class="col-sm-2 col-lg-2 text-center">
                                <p class="header">পরিমাণ</p>
                            </div>
                            <div class="col-sm-2 col-lg-3 text-center">
                                <p class="header">প্রতিটির দাম</p>
                            </div>
                            <div class="col-sm-2 col-lg-1 text-end">
                                <p class="header">মোট</p>
                            </div>
                        </div>
                    </div>

                    @foreach ($items as $book)
                    <div class="large_cart_inner cartItemRow{{$book->rowId}}">
                        <div class="row">
                            <div class="col-sm-2 col-lg-2">
                                <div class="del_btn_wrapper">
                                    <button class="del_btn" onclick="deleteCart('{{ $book->rowId }}')">
                                        <img src="{{asset('frontend/assets/images/icons/delete_black_24dp 1.svg')}}" alt="">
                                    </button>
                                </div>
                            </div>
                            <div class="col-sm-4 col-lg-4">
                                <div class="image_content">
                                    <img src="{{asset('images/'.$book->options->image)}}" alt="">
                                    <div class="pd_info_cell">
                                        <h2>{{$book->name}}</h2>
                                        <h6>     
                                            @foreach ($book->options->auhtors_name as $key=>$author)
                                                {{ $author}} @if (!$loop->last) , @endif
                                            @endforeach
                                       </h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-2  col-lg-2">
                                <div class="btn_group">
                                    <button onclick="decreaseQuantity('{{ $book->rowId }}')"><img src="{{asset('frontend/assets/images/icons/remove.svg')}}" alt=""></button>
                                    <span class="qty cartQty{{$book->rowId}}">{{ englishTobangla($book->qty)}}</span>
                                    <button onclick="increaseQuantity('{{ $book->rowId }}')"><img src="{{asset('frontend/assets/images/icons/add.svg')}}" alt=""></button>
                                </div>
                            </div>
                            <div class="col-sm-2  col-lg-3">
                                <div class="pd_price_cell">
                                    <h2>৳ {{englishTobangla($book->price)}}</h2>
                                    @if ($book->options->discounted_percentage != null || $book->options->discounted_percentage != 0)
                                    <h6><del>৳ {{englishTobangla($book->options->regular_price)}}</del></h6>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-2  col-lg-1">
                                <div class="pd_price_cell total">
                                    <h2 class="itemSubtotal{{$book->rowId}}">৳ {{englishTobangla($book->subtotal)}}</h2>
                                </div>
                            </div>
                        </div>
                    </div>

                    @endforeach
               
                    <div class="large_cart_inner">
                        <div class="total_item">
                            <h1>সাব টোটাল</h1>
                            <h2 class="cartTotal">৳ {{englishTobangla($totalAmount)}}</h2>
                        </div>
                    </div>
                  
                </div>
                <div class="large_cart_inner">
                    <div class="total_item last">
                        <div>
                            <a href="{{route('frontend.books')}}" class="fire_jan">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="8" viewBox="0 0 25 8" fill="none">
                                    <path
                                        d="M0.646446 3.64645C0.451185 3.84171 0.451185 4.15829 0.646446 4.35355L3.82843 7.53553C4.02369 7.7308 4.34027 7.7308 4.53553 7.53553C4.7308 7.34027 4.7308 7.02369 4.53553 6.82843L1.70711 4L4.53553 1.17157C4.7308 0.976311 4.7308 0.659728 4.53553 0.464466C4.34027 0.269204 4.02369 0.269204 3.82843 0.464466L0.646446 3.64645ZM25 3.5L1 3.5V4.5L25 4.5V3.5Z"
                                        fill="#4F7F6C" />
                                </svg> শপে ফিরে যান</a>
                        </div>
                        <div>
                            <a href="{{route('frontend.checkout')}}"><button class="check_btn">চেকআউট</button></a>
                        </div>
                    </div>
                </div>
             
            </div>
            @else 
                <p>Your cart is empty</p>
            @endif
        </div>
    </div>

    <!-- cart for mobile -->
    <div class="cart_for_mobile">
        <div class="container">

            <div class="cart_header">
                <h1>আপনার শপিং কার্ট</h1>
            </div>

            <div class="cart_body">
                <div class="cart_item_header">
                    <h5>Selected</h5>
                    <h6>{{$cartQty}} Items</h6>
                </div>

                <div class="cart_table_wrapper">
                    <table class="w-100">
                        <tbody>
                            @if (!empty($items))
                            @foreach ($items as $book)
                            <tr class="cart_item cartItemRow{{$book->rowId}}">
                                <td class="del_cell">
                                    <button class="del_btn"  onclick="deleteCart('{{ $book->rowId }}')">
                                        <img src="{{asset('frontend/assets/images/icons/delete_black_24dp 1.svg')}}" alt="">
                                    </button>
                                </td>
                                <td class="pd_cell"><img src="{{asset('images/'.$book->options->image)}}" alt=""></td>
                                <td class="pd_info_cell">
                                    <h2>{{$book->name}}</h2>
                                    <h6>     
                                        @foreach ($book->options->auhtors_name as $key=>$author)
                                            {{ $author}} @if (!$loop->last) , @endif
                                        @endforeach
                                   </h6>
                                </td>
                                <td class="pd_price_cell">
                                    <h2>৳ {{englishTobangla($book->price)}}</h2>
                                    @if ($book->options->discounted_percentage != null || $book->options->discounted_percentage != 0)
                                    <h6><del>৳ {{englishTobangla($book->options->regular_price)}}</del></h6>
                                    @endif
                                    <div class="btn_group">
                                        <button onclick="decreaseQuantity('{{ $book->rowId }}')"><img src="{{asset('frontend/assets/images/icons/remove.svg')}}" alt=""></button>
                                        <span class="qty cartQty{{$book->rowId}}">{{ englishTobangla($book->qty)}}</span>
                                        <button onclick="increaseQuantity('{{ $book->rowId }}')"><img src="{{asset('frontend/assets/images/icons/add.svg')}}" alt=""></button>
                                    </div>
                                </td>
                            </tr>

                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>

                <div class="total_item">
                    <h1>সাব টোটাল</h1>
                    <h2 class="cartTotal">৳ {{englishTobangla($totalAmount)}}</h2>
                </div>

                <div class="row">
                    <div class="col-12">
                        <a href="{{route('frontend.checkout')}}"><button class="check_btn">Checkout</button></a>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection

@section('page-js')

@endsection