function engToBangla(num){
   return num.toLocaleString("bn-BD");
}

// add to cart
function addToCart(id){
    $.ajax({
        type: "POST",
        url: '/add-to-cart',
        data: {
            id: id,
        },
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        dataType: 'JSON',
        success: function(response) {
            if(response.success == true){
                $('.cartCounter').html(response.data.numberOfCartQuantities)
                $('.cartTotal').html(response.data.grandTotal)
                $('.selectedItems').html(response.data.cartItems)

                $('.appendCartItems').empty();
                $.each(response.data.items, function(key, val) {
                    appendCartItem(val);
                });
            }
           
        },
        error: function(error) {
            if (error.status == 404) {


            }
        },
    });
}

// append item into cart sidebar

function appendCartItem(val) {
    var base_url = location.origin;
    if(val.options.discounted_percentage !=null || val.options.discounted_percentage !=0){
        var discount = `<h6><del>${engToBangla(val.options.regular_price * val.qty)} টাকা</del></h6>`;
    }else{
        var discount = '';
    }

    
    $('.appendCartItems').append(
        `<tr class="cart_item">
        <td class="del_cell"><button class="del_btn" onclick="deleteCart()"><img
                    src='${base_url}/frontend/assets/images/icons/delete_black_24dp 1.svg' alt=""></button></td>
        <td class="pd_cell"><img src="${base_url}/images/${val.options.image}" alt=""></td>
        <td class="pd_info_cell">
            <h2>${val.name}</h2>
            <h6>
            ${ $.map( val.options.auhtors_name, function( n ) {
                return n;
            })}
            </h6>
        </td>
        <td class="pd_price_cell">
            <h2>${engToBangla(val.price * val.qty)} টাকা</h2>
            ${discount}
            <div class="btn_group">
                <button onclick="decreaseQuantity()"><img src="${base_url}/frontend/assets/images/icons/remove.svg" alt=""></button>
                <span class="qty">${engToBangla(val.qty)}</span>
                <button onclick="increaseQuantity()"><img src="${base_url}/frontend/assets/images/icons/add.svg" alt=""></button>
            </div>
        </td>
    </tr>`
    )
}
