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
        if ($cartService->numberOfCartQty() <= 0) {
            return redirect()->back()->with('error', 'Please add book to your cart first');
        }
        if (Auth::check()) {

            $user = auth()->user();

            $user->load('addresses');

            if (count($user->addresses) > 0) {

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

            } else {
                $total           = $this->totalAmount($cartService->subTotal(), 0);
                $default_address = [];
                return redirect()->route('customer.profile', '#address')->with('error', 'Please first add your primary address');
            }

            return view('frontend.checkout.checkout', compact('user', 'cartService', 'default_address', 'total'));
        } else {
            return view('frontend.auth.sign_in');
        }

    }

    public function placeOrder(OrderStoreRequest $request, CartService $cartService) {
        // dd($request->all());
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
            'id'              => getMaxId(),
            'name'            => $request->name,
            'email'           => $request->email,
            'phone'           => $request->phone,
            'division'        => $request->division,
            'district'        => $request->district,
            'address'         => $request->address,
            'delivery_fee'    => $request->delivery_fee,
            'notes'           => $request->addInfo,
            'wrapping_cost'   => $request->giftWrapperCost,
            'subtotal'        => $total,
            'total'           => $this->grandTotal($cartService->subTotal(), $request->delivery_fee, $request->giftWrapperCost),
        ]);

        foreach ($cartService->getCartContent() as $book) {
            $order->books()->attach([$book->id => [
                'quantity' => $book->qty,
                'amount'   => $book->subtotal,
            ]]);
        }

        $cartService->destroy();
        Session::put('order', $order);
        Session::flash('success', 'Order has been placed');

        return $this->success($order);

    }

    // order total amount
    function totalAmount($amount, $deleiveryFee) {

        $amount = floatval(preg_replace('/[^\d.]/', '', $amount));

        $deleiveryFee = floatval(preg_replace('/[^\d.]/', '', $deleiveryFee));

        return currency_format($amount + $deleiveryFee );
    }

    function grandTotal($amount, $deleiveryFee, $giftWrapperCost) {

        $amount = floatval(preg_replace('/[^\d.]/', '', $amount));

        $deleiveryFee = floatval(preg_replace('/[^\d.]/', '', $deleiveryFee));

        $giftWrapperCost = floatval(preg_replace('/[^\d.]/', '', $giftWrapperCost));

        return currency_format($amount + $deleiveryFee + $giftWrapperCost);
    }
}
