<?php
namespace App\Service;

use App\Models\User;

Class LoginService {

    private function sendOTP($to, $text) {
        $url  = "http://portal.metrotel.com.bd/smsapi";
        $data = [
            "api_key"  => "C2000901608f8ee5d1f403.98468584 ",
            "type"     => "text",
            "contacts" => $to,
            "senderid" => "8809612441441",
            "msg"      => $text,
        ];
        // dd($data);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }

    public function send($number) {
        $to          = '88' . $number;
        $randomDigit = random_int(100000, 999999);
        $text        = 'Your OTP code : ' . $randomDigit;

        $user = $this->storeUser($randomDigit, $number);
        
        if ($user) {
            return $this->sendOTP($to, $text);
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

}