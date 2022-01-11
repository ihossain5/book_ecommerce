<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\OtpVerifyRequest;
use App\Models\User;
use App\Service\LoginService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class LoginController extends Controller
{
    public function index (){
        return view('frontend.auth.login');
    }

    public function sendOtp (Request $request, LoginService $loginService){

        $this->validate($request,[
            'number'=> 'required|min:11|max:11'
        ]);

        $number = $request->number;

        $parsedUrl = parse_url(URL::previous());

        $url = url('') . $parsedUrl['path'];

        try {
            if ($url != route('frontend.otp.send')) {
                $loginService->send($number);
             }

             return view('frontend.auth.login_verification', compact('number'));

        } catch (Exception $e) {

           return redirect()->back()->with('error',$e->getMessage());
        }

      

       
    }

    public function otpSend (Request $request, LoginService $loginService){

        $this->validate($request,[
            'number'=> 'required|min:11|max:11'
        ]);

        $number = $request->number;

        // $loginService->send($number);

        return $this->success($number);
    }

    public function otpVerification (Request $request){
        // dd($request->all());
        $this->validate($request,[
            'otp'=> 'required|min:6|max:6'
        ]);

        $user = User::where('otp_code', $request->otp)->where('phone',$request->number)->first();
        if (!$user) {

            return $this->error('Please provide a valid otp code');

        } else {
            $user->update(['otp_code' => null]);

            Auth::login($user);

            return $this->success($user);

        }

    }
    public function verifyOtp (Request $request){
        $user = User::where('otp_code', $request->otp)->where('phone',$request->phone)->first();
        if (!$user) {

            return redirect()->back()->with('errorMessage', 'Please provide a valid otp code');
        } else {
            $user->update(['otp_code' => null]);

            Auth::login($user);

            return redirect(route('customer.profile'));

        }

    }

    public function logout(){
        Auth::logout();

        return redirect()->route('frontend.home');
    }
}
