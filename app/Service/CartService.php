<?php
namespace App\Service;

use Gloudemans\Shoppingcart\Facades\Cart;

Class CartService {

    protected $bookservice;

    public $insideDhakadeliveryFee;

    public $outsideDhakadeliveryFee;

    public function __construct(BookService $bookservice, $insideDhakadeliveryFee = 60, $outsideDhakadeliveryFee = 120) {
        $this->bookservice             = $bookservice;
        $this->insideDhakadeliveryFee  = $insideDhakadeliveryFee;
        $this->outsideDhakadeliveryFee = $outsideDhakadeliveryFee;

    }

    public function add($id) {
        $book = $this->bookservice->find($id);

        $auhtors_name = $book->authors->pluck('name');

        Cart::add([
            'id'      => $book->book_id,
            'name'    => $book->title,
            'qty'     => 1,
            'price'   => $book->discounted_price,
            'options' => [
                'auhtors_name'          => $auhtors_name,
                'image'                 => $book->cover_image,
                'discounted_percentage' => $book->discounted_percentage,
                'regular_price'         => $book->regular_price,
            ],
        ])->associate('App\Models\Book');

        return $this->getCartContent();
    }

    /* increase quantity  */
    public function increaseCartQty($rowId) {
        $cart = $this->getCart($rowId);
        $qty  = $cart->qty + 1;
        return $this->updateCart($rowId, $qty);

    }

    /* decrease quantity  */
    public function decreaseCartQty($rowId) {
        $cart = $this->getCart($rowId);
        if ($cart->qty == 1) {
            return false;
        }
        $qty = $cart->qty - 1;
        return $this->updateCart($rowId, $qty);

    }

    /* get all cart items */
    public function getCartContent() {
        return Cart::content();
    }

/* get  cart subtoal */
    public function subTotal() {
        return Cart::subtotal();
    }

    /* get all number of cart quantity */
    public function numberOfCartQty() {
        return Cart::count();
    }
    /* destrouy cart */
    public function destroy() {
        return  Cart::destroy();
    }

    /* get all cart items */
    public function cartItems() {
        $ids = $this->getCartContent()->pluck('id');

        $books = $this->bookservice->find($ids)->count();

        return $books;
    }

    /* update cart quantity  */
    public function updateCart($rowId, $qty) {
        return Cart::update($rowId, $qty);
    }

    /* remove item from cart */
    public function removeCsdart($rowId) {
        return Cart::remove($rowId);

    }
    /* get single item from cart */
    public function getCart($rowId) {
        return Cart::get($rowId);
    }

}