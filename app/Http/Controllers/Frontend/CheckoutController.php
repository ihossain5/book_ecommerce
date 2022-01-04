<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Service\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function checkOut(CartService $cartService){
        if(Auth::check()){

            $user = auth()->user();

            $user->load('addresses');

            foreach($user->addresses as $address){
                if($address->pivot->is_default == 1){
                    $default_address = $address;
                }
            }

            return view('frontend.checkout.checkout',compact('user','cartService','default_address'));
        }else{
            return view('frontend.auth.login');
        }
        
    }
}
