<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\OtpVerifyRequest;
use App\Models\User;
use App\Service\LoginService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index (){
        return view('frontend.auth.login');
    }

    public function sendOtp (Request $request, LoginService $loginService){

        $number = $request->number;
        // $loginService->send($number);

        return view('frontend.auth.login_verification',compact('number'));
    }

    public function verifyOtp (Request $request, LoginService $loginService){

        $user = User::where('otp_code',$request->otp)->where('phone',$request->phone)->first();
        if(!$user){
            return redirect()->back()->with('errorMessage','Please provide a valid otp code');
        }else{
            $user->update(['otp_code'=>null]);
            Auth::login($user);

            // return view('frontend.auth.login_verification',compact('number'));
        }

        // dd($request->all());


        
    }
}
