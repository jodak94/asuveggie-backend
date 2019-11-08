<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/ciudades'], function (Router $router) {
    $router->bind('ciudad', function ($id) {
        return app('Modules\Ciudades\Repositories\CiudadRepository')->find($id);
    });
    $router->get('ciudads', [
        'as' => 'admin.ciudades.ciudad.index',
        'uses' => 'CiudadController@index',
        'middleware' => 'can:ciudades.ciudads.index'
    ]);
    $router->get('ciudads/search_ajax', [
        'as' => 'admin.ciudades.ciudad.search_ajax',
        'uses' => 'CiudadController@search_ajax',
    ]);
    $router->get('ciudads/create', [
        'as' => 'admin.ciudades.ciudad.create',
        'uses' => 'CiudadController@create',
        'middleware' => 'can:ciudades.ciudads.create'
    ]);
    $router->post('ciudads', [
        'as' => 'admin.ciudades.ciudad.store',
        'uses' => 'CiudadController@store',
        'middleware' => 'can:ciudades.ciudads.create'
    ]);
    $router->get('ciudads/{ciudad}/edit', [
        'as' => 'admin.ciudades.ciudad.edit',
        'uses' => 'CiudadController@edit',
        'middleware' => 'can:ciudades.ciudads.edit'
    ]);
    $router->put('ciudads/{ciudad}', [
        'as' => 'admin.ciudades.ciudad.update',
        'uses' => 'CiudadController@update',
        'middleware' => 'can:ciudades.ciudads.edit'
    ]);
    $router->delete('ciudads/{ciudad}', [
        'as' => 'admin.ciudades.ciudad.destroy',
        'uses' => 'CiudadController@destroy',
        'middleware' => 'can:ciudades.ciudads.destroy'
    ]);
// append

});
