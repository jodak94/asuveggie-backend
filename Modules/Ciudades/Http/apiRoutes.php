<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/ciudades', 'middleware' => ['api', 'cors']], function (Router $router) {
    $router->get('', [
        'uses' => 'CiudadController@index',
    ]);
});
