<?php

namespace App\Api\V1\Traits;

use Ixudra\Curl\Facades\Curl;


trait Components
{
    private function keyboardBtn($options)
    {
        $keyboard = [
            'keyboard' => $options,
            'resize_keyboard' => true,
            'one_time_keyboard' => false,
            'selective' => true,
        ];

        $keyboard = json_encode($keyboard);


        return  $keyboard;
    }
}
