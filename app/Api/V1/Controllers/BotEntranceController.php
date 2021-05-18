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


class BotEntranceController extends BaseController
{
    use HttpApi, Components;


    public function __construct()
    {
    }



    public function webhook(Request $request)
    {

        try {

            $this->networkRequest("setWebhook", [
                'url' => url(route('webhook'))
            ]) ? "success" : "Error setting the webhook";
        } catch (\Throwable $th) {
            //throw $th;
            Log::info("Error setting the webhook");
        }
    }

    public function index(Request $request)
    {

        try {


            $requestData = json_decode(file_get_contents("php://input"));

            $action = $requestData->message->text;
            $userID = $requestData->message->from->id;

            if ($action === "/start") {
                $text = "Welcome to ezugudor bot";
                $options = [['CSS', 'HTML'], ['Java', 'Javascript']];
            }
            $this->networkRequest(
                "sendMessage",
                [
                    'chat_id' => $userID,
                    'text' => $text,
                    'reply_markup' => $this->keyboardBtn($options)
                ]
            );
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
