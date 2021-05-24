<?php


namespace App\Api\V1\Responses;

use App\Api\V1\Responses\BaseResponse;



class FirstnameResponse extends BaseResponse
{
    private $details;
    public function __construct($details)
    {
        $this->setDetails($details);
    }

    public function setDetails($details)
    {
        $this->details = (object) $details;
    }

    public function getResponse()
    {

        return  [
            'chat_id' => $this->details->user_id,
            'text' => "Your firstname : ",
            'parse_mode' => 'MarkdownV2',
            'reply_markup' => $this->keyboardBtn()
        ];
    }

    private function keyboardBtn()
    {
        // $options = [['Java', "Javasncript"], ['Angular']];
        $options = [['CSS', "\xF0\x9F\x8C\x8D HTML"], ['Java', "Javasncript"], ['Angular']];

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
