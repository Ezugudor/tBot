<?php

namespace App\Api\V1\Traits;

<<<<<<< HEAD
=======
use Illuminate\Support\Facades\Log;
>>>>>>> f38f6d4f24e3707d8a3616c262ad8e5011a408b1
use Ixudra\Curl\Facades\Curl;


trait HttpApi
{
    public function networkRequest($method, $data = [])
    {
        $BaseEndPoint =  "https://api.telegram.org/bot";

        $Key = config('BOT_KEY');

        Log::info("Bot key ==== " . $Key);

        $CurrentEndpoint = "/{$method}";

        $FullEndPoint =  $BaseEndPoint . $Key . $CurrentEndpoint;
        $TokenResponse  = Curl::to($FullEndPoint)
            ->withData($data)
            ->asJson()
            ->post();

        return  $TokenResponse;
    }
}
