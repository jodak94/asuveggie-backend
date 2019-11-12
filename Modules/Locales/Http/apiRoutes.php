<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/locales', 'middleware' => ['api', 'cors']], function (Router $router) {
    $router->get('', [
        'as' => 'admin.locales.local.index',
        'uses' => 'LocalController@index',
    ]);
});