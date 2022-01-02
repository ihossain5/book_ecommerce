<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\OtpVerifyRequest;
use App\Models\User;
use App\Service\LoginService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class LoginController extends Controller
{
    public function index (){
        return view('frontend.auth.login');
    }

    public function sendOtp (Request $request, LoginService $loginService){

        $number = $request->number;

        $parsedUrl = parse_url(URL::previous());

        $url = url('') . $parsedUrl['path'];

        if ($url != route('frontend.otp.send')) {
            $loginService->send($number);
        }

        return view('frontend.auth.login_verification', compact('number'));
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
}
