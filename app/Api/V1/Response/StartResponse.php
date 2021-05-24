<?php


namespace App\Api\V1\Responses;

use App\Api\V1\Responses\BaseResponse;



class StartResponse extends BaseResponse
{
    public $details;
    public function __construct($details)
    {
        $this->setDetails($details);
        return $this->getResponse();
    }

    public function setDetails($details)
    {
        $this->details = (object) $details;
    }

    public function getResponse()
    {

        return  [
            'chat_id' => $this->details->user_id,
            'text' => "_Welcome_ [{$this->details->user_firstname}](http://google.com) *bot* [__Goto your profile__](tg://user?id={$this->details->user_id})",
            'parse_mode' => 'MarkdownV2',
            'reply_markup' => $this->keyboardBtn()
        ];
    }

    public function keyboardBtn()
    {
        // $options = [['Java', "Javasncript"], ['Angular']];
        $options = [['CSS', "\xF0\x9F\x8C\x8D HTML"], ['Java', "Javasncript"], ['Angular']];

        $keyboard = [
            'keyboard' => $options,
            'resize_keyboard' => true,
            'one_time_keyboard' => false,
            'selective' => true,
        ];

        $keyboard = [
            'inline_keyboard' => [
                [
                    ['text' => 'Join Us','callback_data'=>'/join'],
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
