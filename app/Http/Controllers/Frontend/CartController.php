<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Service\CartService;
use Exception;
use Illuminate\Http\Request;

class CartController extends Controller {
    public function index(Request $request, CartService $cart) {
        try {
            $cart->add($request->id);

            $data                           = [];
            $data['message']                = 'Item has been added into cart';
            $data['items']                  = $cart->getCartContent();
            $data['grandTotal']             = englishTobangla($cart->subTotal());
            $data['numberOfCartQuantities'] = $cart->numberOfCartQty();
            $data['cartItems']              = $cart->cartItems();

            return $this->success($data);

        } catch (Exception $e) {

            return $e->getMessage();
        }

    }
}
