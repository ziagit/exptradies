<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Config;
use SignalWire\Rest\Client;

class SmsHelper
{
    public $client;
    public $from;
    public $bas_url;
    public function __construct()
    {
        $this->client = new Client(
            Config::get('services.signalwire.client'),
            Config::get('services.signalwire.token'),
            Config::get('services.signalwire.space_url')
        );
        $this->from = Config::get('services.signalwire.from');
        $this->bas_url =  "https://exptradies.com";
    }
    public function verify($phone, $code)
    {
        $message = $this->client->messages
            ->create(
                $phone,
                array("from" => $this->from, "body" => "Your Exptradies verification code is " . $code . ".")
            );
        return $message;
    }
   
    public function newSms($phone, $sms)
    {
        $message = $this->client->messages
            ->create(
                $phone,
                array(
                    "from" => $this->from,
                    "body" => $sms,
                )
            );
        return $message;
    }
}
