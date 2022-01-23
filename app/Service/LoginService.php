<?php
namespace App\Service;

use App\Models\User;
use App\Traits\SmsTrait;
use ErrorException;
use Exception;
use Illuminate\Support\Facades\Hash;

Class LoginService {

    use SmsTrait;

    public function send($number) {
        $to          = '88' . $number;
        $randomDigit = random_int(100000, 999999);
        $text        = 'Your OTP code : ' . $randomDigit;

        $user = User::where('phone',$number)->first();

        if($user){
            throw new ErrorException('Sorry! This number is already registered');
        }

        $user = $this->storeUser($randomDigit, $number);
        
        if ($user) {
            if($user->is_ban == 1){
                 throw new ErrorException('Sorry! You have no permission to access this');
            }
            return $this->smsSend($to, $text);
        }

    }

    private function storeUser($otp, $number) {
        
        $user = User::updateOrCreate([
            'phone' => $number,
        ], [
            'otp_code' => $otp,
        ]);

        return $user;
    }

    function authenticate($number, $password){
        $user = User::where('phone',$number)->first();

        if(!$user || !Hash::check($password, $user->password)){
            throw new Exception('Phone number & password does not match');
        }

        return $user;
    }

}