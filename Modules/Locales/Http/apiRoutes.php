<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/locales', 'middleware' => ['api', 'cors']], function (Router $router) {
    $router->get('', [
        'uses' => 'LocalController@index',
    ]);

    $router->get('/detail', [
        'uses' => 'LocalController@detail',
    ]);
});

$router->group(['prefix' =>'/contacto', 'middleware' => ['api', 'cors']], function (Router $router) {
    $router->post('', [
        'uses' => 'LocalController@contacto',
    ]);
});
