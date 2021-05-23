<?php

namespace App\Api\V1\Traits;

use Illuminate\Support\Facades\Log;
use Ixudra\Curl\Facades\Curl;


trait HttpApi
{
    public function networkRequest($method, $data = [],$fileObj = [])
    {
        if($method == "sendMessage"){
            $TokenResponse = $this->networkRequestPlain($method, $data);
        }else if($method == "sendPhoto"){
            $TokenResponse = $this->networkRequestWithFile($method, $data,$fileObj);
        }

        return  $TokenResponse;
        
    }

    public function networkRequestPlain($method, $data = [])
    {
        $BaseEndPoint =  "https://api.telegram.org/bot";

        $Key = config('services.bot_key');

        Log::info("aaaaaBot key ==== " . json_encode($data));

        $CurrentEndpoint = "/{$method}";

        $FullEndPoint =  $BaseEndPoint . $Key . $CurrentEndpoint;
        $TokenResponse  = Curl::to($FullEndPoint)
            ->withData($data)
            ->asJson()
            ->post();

        return  $TokenResponse;
    }


    
    public function networkRequestWithFile($method, $fileObj, $data = [])
    {
        $BaseEndPoint =  "https://api.telegram.org/bot";

        $Key = config('services.bot_key');

        Log::info("acccBot key ==== " . $Key);
        Log::info("file obj ==== " . json_encode($fileObj));

        $CurrentEndpoint = "/{$method}";

        try {
            $FullEndPoint =  $BaseEndPoint . $Key . $CurrentEndpoint;
            $TokenResponse  = Curl::to($FullEndPoint)
            ->withData($data)
            ->withFile('photo', $fileObj->imagePath, $fileObj->imageMimeType, $fileObj->imageOriginalName)
            ->post();

        } catch (\Throwable $th) {
            Log::info("error file === ".json_encode($th));
        }
       


        return  $TokenResponse;
    }
}
