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

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('current', 'Api@current');
    $router->get('predict', 'Api@predict');
});
$router->get('/api[/{name}]', 'Api@index');


$router->get('/{route:.*}/', function ()  {
    return view('index');
});