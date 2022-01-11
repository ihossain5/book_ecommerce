<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{
   

        // Google login
        public function redirectToGoogle() {
            session()->put('previous_url', url()->previous());
           return Socialite::driver('google')->with(["prompt" => "select_account"])->redirect();
       }
   
       // Google callback
       public function handleGoogleCallback() {
           $user = Socialite::driver('google')->user();
           
           $this->_registerOrLoginUser($user);
           // Return home after login
          return  $this->redirectCustomer();
       }
       // facebook login
       public function redirectToFacebook() {

           return Socialite::driver('facebook')->redirect();
       }
   
       // facebook callback
       public function handleFacebookCallback() {
           $user = Socialite::driver('facebook')->user();
           $this->_registerOrLoginUser($user);
           // Return home after login
           return  $this->redirectCustomer();
       }
   
       protected function _registerOrLoginUser($data) {
           $user = User::where('email', '=', $data->email)->first();
           if (!$user) {
               $user              = new User();
               $user->name        = $data->name;
               $user->email       = $data->email;
               $user->save();
           }
   
           Auth::login($user);
       }

       protected function redirectCustomer(){
        if(Auth::user()->ban == 1){
            Auth::logout();
            return redirect()->route('frontend.home')->with('error','Sorry! You have no permission to access this');

        }else{
            // if($this->previous_url == route('frontend.checkout')){
            //     $url= route('frontend.checkout');
            // }else{
            //     $url= $this->previous_url;
            // }
            // session()->forget('previous_url');
  
            return redirect()->to(session()->get('previous_url'));
            
        }
       
    
      
    }
}
