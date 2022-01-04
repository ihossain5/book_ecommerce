<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderStoreRequest;
use App\Models\Order;
use App\Service\CartService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller {
    public function checkOut(CartService $cartService) {
        if (Auth::check()) {

            $user = auth()->user();

            $user->load('addresses');

            foreach ($user->addresses as $address) {
                if ($address->pivot->is_default == 1) {
                    $default_address = $address;
                }
            }
            if ($default_address->inside_dhaka_city == 1) {
                $total = $this->totalAmount($cartService->subTotal(), $cartService->insideDhakadeliveryFee);
            } else {
                $total = $this->totalAmount($cartService->subTotal(), $cartService->outsideDhakadeliveryFee);
            }

            return view('frontend.checkout.checkout', compact('user', 'cartService', 'default_address', 'total'));
        } else {
            return view('frontend.auth.login');
        }

    }

    public function placeOrder(OrderStoreRequest $request, CartService $cartService) {
        $total = $cartService->subTotal();
        // $order = new Order();

        // $order->user_id         = auth()->user()->id;
        // $order->payment_id      = 1;
        // $order->order_status_id = 1;
        // $order->name            = $request->name;
        // $order->id              = '31254';
        // $order->mobile          = $request->phone;
        // $order->division        = $request->division;
        // $order->district        = $request->district;
        // $order->address         = $request->address;
        // $order->delivery_fee    = $request->delivery_fee;
        // $order->subtotal        = $request->subtotal;
        // $order->total           = $this->totalAmount($cartService->subTotal(), $request->delivery_fee);
        // $order->save();

        $order = Order::create([
            'user_id'         => auth()->user()->id,
            'payment_id'      => 1,
            'order_status_id' => 1,
            'id'              => 1,
            'name'            => $request->name,
            'mobile'          => $request->phone,
            'division'        => $request->division,
            'district'        => $request->district,
            'address'         => $request->address,
            'delivery_fee'    => $request->delivery_fee,
            'subtotal'        => $request->subtotal,
            'total'           => $this->totalAmount($cartService->subTotal(), $request->delivery_fee),
        ]);

        foreach ($cartService->getCartContent() as $book) {
            $order->books()->attach([$book->id => [
                'quantity' => $book->qty,
                'amount'   => $book->subtotal,
            ]]);
        }

        $cartService->destroy();

        Session::flash('success','Order has been placed');

        return $this->success($order);

    }

    // order total amount
    function totalAmount($amount, $deleiveryFee) {
        $amount       = floatval(preg_replace('/[^\d.]/', '', $amount));
        $deleiveryFee = floatval(preg_replace('/[^\d.]/', '', $deleiveryFee));
        return currency_format($amount + $deleiveryFee);
    }
}