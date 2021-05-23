<?php


namespace App\Api\V1\Controllers;

use App\Api\V1\Responses\FirstnameResponse;
use App\Api\V1\Responses\StartResponse;
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

    public function getWebhook(Request $request)
    {

        try {

            $res = $this->networkRequest("getWebhookInfo");
            $a = $res->ok ? "success" : "Error setting the webhook";
            Log::info("respose ==== >" . json_encode($res));
            Log::info("respose ==== >" . $res->ok);
            // Log::info("respose ==== >" . $res->error_code);
            return $a;
        } catch (\Throwable $th) {
            //throw $th;
            Log::info("Error getting the webhook info ==== >" . $th->getMessage());
        }
    }

    public function index(Request $request)
    {

        try {


            $requestData = json_decode(file_get_contents("php://input"));
            Log::info("reached data  ===> " . json_encode($requestData));
            if (property_exists($requestData, 'message')) {
                $action = $requestData->message->text;
                $userID = $requestData->message->from->id;
                $userFirstname = $requestData->message->from->first_name;
            } else {
                $action = $requestData->callback_query->data;
                $userID = $requestData->callback_query->from->id;
                $userFirstname = $requestData->callback_query->from->first_name;
            }

            switch ($action) {
                case '/start':
                    $reqPayload = ['user_id' => $userID, 'user_firstname' => $userFirstname];
                    $responseTemplate = new StartResponse($reqPayload);
                    $this->networkRequest(
                        "sendMessage",
                        $responseTemplate
                    );
                    break;
                case '/join':
                    $reqPayload = ['user_id' => $userID, 'user_firstname' => $userFirstname];
                    $responseTemplate = new FirstnameResponse($reqPayload);

                    $pathExist = file_exists('../resources/img/promo2.jpeg');
                    $path = '../resources/img/promo1.jpeg';
                    Log::info("check file exist  ===> " . json_encode($pathExist));
                    $this->networkRequest(
                        "sendPhoto",
                        (object)['imagePath' => $path, 'imageMimeType' => 'image/webp', 'imageOriginalName' => 'ads.jpeg'],
                        $responseTemplate
                    );


                    break;

                default:
                    # code...
                    break;
            }

            if ($action === "/start") {
                $reqPayload = ['user_id' => $userID, 'user_firstname' => $userFirstname];
                $responseTemplate = new StartResponse($reqPayload);
                $this->networkRequest(
                    "sendMessage",
                    $responseTemplate
                );

                // $pathExist = file_exists('../resources/img/promo2.jpeg');
                // $path = '../resources/img/promo1.jpeg';
                // Log::info("check file exist  ===> " . json_encode($pathExist));
                // $this->networkRequest(
                //     "sendPhoto",
                //     (object)['imagePath' => $path, 'imageMimeType' => 'image/webp', 'imageOriginalName' => 'ads.jpeg'],
                //     [
                //         'chat_id' => $userID,
                //         'caption' => $text,
                //         'parse_mode' => 'MarkdownV2',
                //         'reply_markup' => $this->keyboardBtn($options),
                //     ]
                // );
            }
        } catch (\Throwable $th) {
            //throw $th;
            Log::info("error data  ===> " . $th->getMessage());
            Log::info("error data  ===> " . json_encode($th));
            Log::info($th);
        }
    }
}
