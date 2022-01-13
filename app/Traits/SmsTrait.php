<?php
namespace App\Traits;

trait SmsTrait {

     function smsSend($number, $text){
        $url  = "http://portal.metrotel.com.bd/smsapi";
        $data = [
            "api_key"  => "C2000901608f8ee5d1f403.98468584 ",
            "type"     => "text",
            "contacts" => $number,
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
}