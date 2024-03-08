<?php

namespace App\Helpers;
use Illuminate\Support\Facades\Http;

class DistanceHelper{
    static function getInKm($address1,$address2){
        $apiKey = "AIzaSyAbcpF6GlIsLXXGLr3PVHTA2pEZsjUhw64";
        $res = Http::get('https://maps.googleapis.com/maps/api/distancematrix/json?units=metric&destinations=' . $address1 . '&origins=' . $address2 . '&key=' . $apiKey);
        $body = json_decode($res->getBody(), true);
        $distance = $body['rows'][0]['elements'][0]['distance']['value'];
        $km = round($distance / 1000, 1);
        return $km;
    }
}