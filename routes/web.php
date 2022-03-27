<?php

declare(strict_types=1);

/** @var \Laravel\Lumen\Routing\Router $router */

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use phpcent\Client;

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

$router->get('/publishTest', function () use ($router) {
    $client = new Client("http://centrifugo:8000/api");
    $client->setSafety(false);

    $clientToken = $client->setApiKey("api_key")->generateConnectionToken(1);
    $city_id = "420006353";
    $openweather_key = env("OPENWEATHER_KEY");
    $response = Http::get("https://api.openweathermap.org/data/2.5/weather?id={$city_id}&appid={$openweather_key}");
    $client->publish("CityName", $response->json());
    return $clientToken;
    //return $router->app->version();
});

$router->get('/user', function () use ($router) {
    return DB::select('select * from users');
});

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->post('register', 'AuthController@register');
    $router->post('login', 'AuthController@login');
    $router->post('logout', "AuthController@logout");
});

$router->group(['middleware' => ['exists', "auth"]], function () use ($router) {
    $router->addRoute(
        ['GET', 'POST', 'PUT', 'DELETE'],
        '/{model}/{methodName}[/{id:[0-9]+}]',
        'SingleController@handle'
    );
});
