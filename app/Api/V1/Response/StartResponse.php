<?php


namespace App\Api\V1\Controllers;

use App\Api\V1\Traits\Components;
use App\Api\V1\Traits\HttpApi;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Ixudra\Curl\Facades\Curl;


class StartResponse 
{
    use HttpApi, Components;


    public function __construct()
    {
    }



   
}
