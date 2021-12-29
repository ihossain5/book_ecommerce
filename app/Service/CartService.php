<?php
namespace App\Service;

use Gloudemans\Shoppingcart\Facades\Cart;

Class CartService {

    protected $bookservice;

    public function __construct(BookService $bookservice) {
        $this->bookservice = $bookservice;

    }

    public function add($id) {
        $book = $this->bookservice->find($id);

        $auhtors_name = $book->authors->pluck('name');

        // Cart::add($book->book_id, $book->title, 1, $book->discounted_price,auhtors_name)
        //     ->associate($book);
   
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

    /* get all cart items */
    public function cartItems() {
        $ids = $this->getCartContent()->pluck('id');

        $books = $this->bookservice->find($ids)->count();

        return $books;
    }

}