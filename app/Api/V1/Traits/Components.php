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

        $keyboard = [
            'inline_keyboard' => [
                [
                    ['text' => 'Goto Google', 'url' => 'http://google.com'],
                    // ['text' => 'Goto Unitrade', 'url' => 'http://t.me/UniTradeApp']
                ],
                [
                    ['text' => 'Goto Google', 'url' => 'http://google.com'],
                    ['text' => 'Goto Google', 'url' => 'http://google.com'],
                    ['text' => 'Goto Google', 'url' => 'http://google.com'],
                    ['text' => 'Goto Google', 'url' => 'http://google.com'],
                    ['text' => 'Goto Unitrade', 'url' => 'http://t.me/UniTradeApp']
                ]
                ]
                
        ];

        $keyboard = json_encode($keyboard);


        return  $keyboard;
    }
}
