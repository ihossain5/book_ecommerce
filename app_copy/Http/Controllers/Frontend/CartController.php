<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Service\CartService;
use Exception;
use Illuminate\Http\Request;

class CartController extends Controller {
    public function addToCart(Request $request, CartService $cart) {
        try {
            $cart->add($request->id);

            $message = 'Item has been added into cart';

            return $this->success($this->response($cart, $message));

        } catch (Exception $e) {

            return $e->getMessage();
        }

    }

    public function deleteCart(Request $request, CartService $cart) {
        try {
            $cart->removeCsdart($request->rowId);

            return $this->success($this->response($cart));

        } catch (Exception $e) {

            return $e->getMessage();
        }

    }
    public function increaseCart(Request $request, CartService $cart) {
        try {
            $cart->increaseCartQty($request->rowId);

            return $this->success($this->qtyUpdateResponse($cart, $request->rowId));

        } catch (Exception $e) {

            return $e->getMessage();
        }

    }
    public function decreaseCart(Request $request, CartService $cart) {
        try {
            $qty = $cart->decreaseCartQty($request->rowId);

            if ($qty == false) {
                return $this->error('quantity can not be less than 1');
            }
            return $this->success($this->qtyUpdateResponse($cart, $request->rowId));

        } catch (Exception $e) {

            return $e->getMessage();
        }

    }

    private function response($cart, $message = '') {
        $data                           = [];
        $data['items']                  = $cart->getCartContent();
        $data['grandTotal']             = englishTobangla($cart->subTotal());
        $data['numberOfCartQuantities'] = $cart->numberOfCartQty();
        $data['cartItems']              = $cart->cartItems();
        $data['message']                = $message;

        return $data;
    }

    private function qtyUpdateResponse($cart, $rowId) {
        $data                           = [];
        $data['grandTotal']             = englishTobangla($cart->subTotal());
        $data['numberOfCartQuantities'] = $cart->numberOfCartQty();
        $data['item']                   = $cart->getCart($rowId);
        $data['cartItems']              = $cart->cartItems();

        return $data;
    }
}
