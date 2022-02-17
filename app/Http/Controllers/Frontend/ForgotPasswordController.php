<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Service\LoginService;
use App\Traits\SmsTrait;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class ForgotPasswordController extends Controller {
    use SmsTrait;

    public function index() {
        return view('frontend.auth.forgot-password');
    }

    public function sendOtp(Request $request, LoginService $loginService) {
        if (Auth::check()) {
            return redirect()->route('frontend.home');
        }

        $this->validate($request, [
            'number' => 'required|min:11|max:11|exists:users,phone',
        ], [
            'number.exists' => 'ফোন নাম্বার সঠিক নয়',
        ]
        );

        $number = $request->number;

        try {
            $to          = '88' . $number;
            $randomDigit = random_int(100000, 999999);
            $text        = 'Your OTP code : ' . $randomDigit;

            User::where('phone', $request->number)->update(['otp_code' => $randomDigit]);

            $parsedUrl = parse_url(URL::previous());

            $url = url('') . $parsedUrl['path'];

            if ($url != route('forgot.password.otp.send')) {

                $this->smsSend($to, $text);
             }

            return view('frontend.auth.login_verification', compact('number'));

        } catch (Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function verifyOtp(Request $request) {
        // dd($request->all());
        $number = $request->phone;

        $user = User::where('otp_code', $request->otp)->where('phone', $request->phone)->first();

        if (!$user) {

            return redirect()->back()->with('errorMessage', 'ওটিপি সঠিক নয় ');
        } else {
            $user->update(['otp_code' => null]);

            return view('frontend.auth.change-password', compact('number'));

            return redirect()->route('frontend.password.change')->with('number', $number);

        }

    }

    public function changePassword() {
        return view('frontend.auth.change-password');
    }

    public function updatePassword(Request $request) {
        // dd($request->all());
        $this->validate($request, [
            'phone'    => 'required|min:11|max:11',
            'password' => 'required|min:8|max:255|confirmed',
        ]
        );
        $user = User::where('phone',$request->phone)->first();
        
        $user->update(['password'=>$request->password]);

        Auth::login($user);

        return redirect()->route('frontend.home');
    }
}
