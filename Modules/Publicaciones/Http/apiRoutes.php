<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/publicaciones', 'middleware' => ['api', 'cors']], function (Router $router) {
    $router->get('', [
        'uses' => 'PublicacionController@index',
    ]);
});
