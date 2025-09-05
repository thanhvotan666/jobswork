<?php

namespace App\Services;

use Twilio\Rest\Client;

class TwilioService
{
    protected $twilio;

    public function __construct()
    {
        $this->twilio = new Client(
            config('app.twilio_sid'),
            config('app.twilio_auth_token')
        );
    }

    public function sendSms($to, $message)
    {
        return $this->twilio->messages->create($to, [
            'from' => config('app.twilio_phone_number'),
            'body' => $message,
        ]);
    }
}
