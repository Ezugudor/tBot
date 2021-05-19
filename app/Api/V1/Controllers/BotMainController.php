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


class BotMainController extends BaseController
{
    use HttpApi, Components;


    public function __construct()
    {
    }



    public function webhook(Request $request)
    {

        Log::info("reached webhook");
        $webhook = $this->getNamedRoute('webhook');

        Log::info($webhook);
        try {

            $res = $this->networkRequest("setWebhook", [
                'url' => url($webhook)
            ]);
            $a = $res->ok ? "success" : "Error setting the webhook";
            Log::info("respose ==== >" . json_encode($res));
            Log::info("respose ==== >" . $res->ok);
            // Log::info("respose ==== >" . $res->error_code);
            return $a;
        } catch (\Throwable $th) {
            //throw $th;
            Log::info("Error setting the webhook ==== >" . $th->getMessage());
        }
    }

    public function index(Request $request)
    {
        Log::info("reached index");

        try {


            $requestData = json_decode(file_get_contents("php://input"));

            Log::info("reached data  ===> " . json_encode($requestData));
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
