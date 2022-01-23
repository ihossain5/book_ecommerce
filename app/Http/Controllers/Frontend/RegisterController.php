<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function index(){
        if(auth()->check()){
            return redirect()->route('frontend.home');
        }
        return view('frontend.auth.register');
    }

    public function signUp(RegisterRequest $request){
        // dd($request->all());
       try {
           $user = $request->register();

           Auth::login($user);

           return $this->success($user);

       } catch (Exception $e) {

         return $this->error($e->getMessage());
       }
    }

    public function sendOtp(){
        if(auth()->check()){
            return redirect()->route('frontend.home');
        }
        return view('frontend.auth.login');
    }
}
