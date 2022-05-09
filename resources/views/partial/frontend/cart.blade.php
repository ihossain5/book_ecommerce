<div class="offcanvas offcanvas-end" tabindex="-1" id="cartSidebar" aria-labelledby="sidebarLebel">
    <div class="offcanvas-body">

        <div class="cart_header">
            <h1>আপনার শপিং কার্ট</h1>
            <button data-bs-dismiss="offcanvas" class="canvasClose"><img src="{{asset('frontend/assets/images/icons/close.svg')}}"
                    alt=""></button>
        </div>

        <div class="cart_body">
            <div class="cart_item_header">
                <h5>Selected</h5>
                <h6><span class="selectedItems ">{{$cartQty}}</span> Items</h6>
            </div>

            <div class="cart_table_wrapper">
                <table class="w-100">
                    <tbody class="appendCartItems">
                        @if (!empty($items))
                            @foreach ($items as $book)
                    
                            <tr class="cart_item">
                                <td class="del_cell"><button class="del_btn" onclick="deleteCart('{{ $book->rowId }}')"><img
                                            src="{{asset('frontend/assets/images/icons/delete_black_24dp 1.svg')}}" alt=""></button></td>
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
                                    <h2><span class="itemSubtotal{{$book->rowId}}">{{englishTobangla($book->subtotal)}}</span> টাকা</h2>
                                    <h6>
                                        @if ($book->options->discounted_percentage != null || $book->options->discounted_percentage != 0)
                                        <del> <span class="itemRegularPrice{{$book->rowId}}">{{englishTobangla($book->options->regular_price * $book->qty)}}</span> টাকা</del>
                                        @endif
                                    </h6>
                                    <div class="btn_group">
                                        <button type="button" onclick="decreaseQuantity('{{ $book->rowId }}')"><img src="{{asset('frontend/assets/images/icons/remove.svg')}}" alt=""></button>
                                        <span class="qty cartQty{{$book->rowId}}">{{ englishTobangla($book->qty)}}</span>
                                        <button type="button" onclick="increaseQuantity('{{ $book->rowId }}')"><img src="{{asset('frontend/assets/images/icons/add.svg')}}" alt=""></button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        @endif

  


                        <!-- <tr class="cart_sub_total">
                            <td colspan="2" class="sub_cell">Subtotal <span>(2 item)</span></td>
                            <td colspan="2" class="sub_price_cell">
                                ৩৬০ টাকা
                            </td>
                        </tr>
                        <tr class="cart_sub_del">
                            <td colspan="2" class="sub_del">Delivary Charge</td>
                            <td colspan="2" class="sub_del_charge">
                                + ৬০ টাকা
                            </td>
                        </tr> -->
                    </tbody>
                </table>
            </div>

            <div class="total_item">
                <h1>Total</h1>
                <h2><span class="cartTotal">{{englishTobangla($totalAmount)}}</span> টাকা</h2>
            </div>

            <div class="row">
                <div class="col-12">
                    <a href="{{route('frontend.checkout')}}"><button class="check_btn">Checkout</button></a>
                </div>
            </div>
        </div>

    </div>

</div>