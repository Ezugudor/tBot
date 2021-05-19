<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/



$router->get('/', function () use ($router) {
    return $router->app->version();
});

$api = app('Dingo\Api\Routing\Router');
$api->version(
    'v1',
    [
        'namespace' => 'App\Api\V1\Controllers'
    ],
    function ($api) {

        /**
         * Users Route
         */

        $api->get('webhook', [
            'as' => 'authorization.user',
            'uses' => 'BotMainController@webhook',
        ]);

        $api->get('get_webhook', [
            'as' => 'authorization.user',
            'uses' => 'BotMainController@getWebhook',
        ]);

        $api->post('/', [
            'as' => 'webhook',
            'uses' => 'BotMainController@index',
        ]);
    }
);
