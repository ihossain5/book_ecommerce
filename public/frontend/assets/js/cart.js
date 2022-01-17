const  base_url = location.origin;

function engToBangla(num){
   return num.toLocaleString("bn-BD");
}


// add to cart
function addToCart(id){
    $.ajax({
        type: "POST",
        url: base_url+'/add-to-cart',
        data: {
            id: id,
        },
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        dataType: 'JSON',
        success: function(response) {
            if(response.success == true){
                $('.cartTooltip').addClass('d-none');
                $('.cartSideBar').removeClass('d-none');
                
                appendToCart(response);
                toastr["success"](response.data.message);
            }else{
                toastr["error"](response.data);
            }
        },
        error: function(error) {
            if (error.status == 404) {

            }
        },
    });
}

//increase a cart qty 
function increaseQuantity(rowId){

    var oldQty = $('.cartQty' + rowId).html();

    $.ajax({
        url: base_url+'/increase-cart',
        method: "POST",
        data: {
            rowId: rowId,
        },
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        dataType: "json",
        success: function(response) {
            if (response.success == true) {
                  setCartAmount(response,rowId);
            }else{
                toastr["error"](response.data);
            }
             
        },//success end
        error: function(error) {
            if (error.status == 404) {
                toastr["error"](response.data.message)
            }
        },
    }); //ajax end
}

//decrease a cart qty 
function decreaseQuantity(rowId){

    var oldQty = $('.cartQty' + rowId).html();
    $.ajax({
        url: base_url+'/decrease-cart',
        method: "POST",
        data: {
            rowId: rowId,
        },
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        dataType: "json",
        success: function(response) {
            if (response.success == true) {
                  setCartAmount(response,rowId);
            } //success end
        },
        error: function(error) {
            if (error.status == 404) {
                toastr["error"](response.data.message)
            }
        },
    }); //ajax end
}


//delete a cart item 
function deleteCart(id){
    $.ajax({
        url: base_url+'/remove-cart',
        method: "POST",
        data: {
            rowId: id,
        },
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        dataType: "json",
        success: function(response) {
            if (response.success == true) {
                if(response.data.cartItems == 0){
                    $('.cartTooltip').removeClass('d-none');
                    $('.cartSideBar').addClass('d-none');
                }
                appendToCart(response);
            } //success end
        },
        error: function(error) {
            if (error.status == 404) {
                toastr["error"]('Data not found');
            }
        },
    }); //ajax end
}

function appendToCart(response){
    $('.cartCounter').html(response.data.numberOfCartQuantities)
    $('.cartTotal').html(response.data.grandTotal)
    $('.selectedItems').html(response.data.cartItems)

    $('.appendCartItems').empty();
    $.each(response.data.items, function(key, val) {
        appendCartItem(val);
    });
}


// append item into cart sidebar
function appendCartItem(val) {
    if(val.options.discounted_percentage !=null || val.options.discounted_percentage !=0){
        var discount = `<h6><del><span class="itemRegularPrice${val.rowId}"> ${engToBangla(val.options.regular_price * val.qty)}</span> টাকা</del></h6>`;
    }else{
        var discount = '';
    }
    
    $('.appendCartItems').append(
        `<tr class="cart_item">
        <td class="del_cell"><button class="del_btn" onclick="deleteCart('${val.rowId}')"><img
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
            <h2><span class="itemSubtotal${val.rowId}"> ${engToBangla(val.price * val.qty)}</span> টাকা</h2>
            ${discount}
            <div class="btn_group">
                <button onclick="decreaseQuantity('${val.rowId}')"><img src="${base_url}/frontend/assets/images/icons/remove.svg" alt=""></button>
                <span class="qty cartQty${val.rowId}">${engToBangla(val.qty)}</span>
                <button onclick="increaseQuantity('${val.rowId}')"><img src="${base_url}/frontend/assets/images/icons/add.svg" alt=""></button>
            </div>
        </td>
    </tr>`
    )
}

// set cart amount
function setCartAmount(response, rowId){
    $('.cartQty' + rowId).html(engToBangla(response.data.item.qty));
    $('.itemSubtotal' + rowId).html(engToBangla(response.data.item.price * response.data.item.qty));
    $('.itemRegularPrice' + rowId).html(engToBangla(response.data.item.options.regular_price * response.data.item.qty));
    $('.cartCounter').html(response.data.numberOfCartQuantities)
    $('.selectedItems').html(response.data.cartItems)
    $('.cartTotal').html(response.data.grandTotal)
}
