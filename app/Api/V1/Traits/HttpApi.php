<?php

namespace App\Api\V1\Traits;

use Ixudra\Curl\Facades\Curl;


trait HttpApi
{
    public function networkRequest($method, $data = [])
    {
        $BaseEndPoint =  "https://api.telegram.org/bot";
        $Key = config('API_KEY');
        $CurrentEndpoint = "/{$method}";

        $FullEndPoint =  $BaseEndPoint . $Key . $CurrentEndpoint;
        $TokenResponse  = Curl::to($FullEndPoint)
            ->withData($data)
            ->asJson()
            ->post();

        return  $TokenResponse;
    }
}
