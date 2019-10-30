<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/publicaciones'], function (Router $router) {
    $router->bind('publicacion', function ($id) {
        return app('Modules\Publicaciones\Repositories\PublicacionRepository')->find($id);
    });
    $router->get('publicacions', [
        'as' => 'admin.publicaciones.publicacion.index',
        'uses' => 'PublicacionController@index',
        'middleware' => 'can:publicaciones.publicacions.index'
    ]);
    $router->get('publicacions/index-ajax', [
        'as' => 'admin.publicaciones.publicacion.index_ajax',
        'uses' => 'PublicacionController@index_ajax',
        'middleware' => 'can:publicaciones.publicacions.index'
    ]);
    $router->get('publicacions/create', [
        'as' => 'admin.publicaciones.publicacion.create',
        'uses' => 'PublicacionController@create',
        'middleware' => 'can:publicaciones.publicacions.create'
    ]);
    $router->post('publicacions', [
        'as' => 'admin.publicaciones.publicacion.store',
        'uses' => 'PublicacionController@store',
        'middleware' => 'can:publicaciones.publicacions.create'
    ]);
    $router->get('publicacions/{publicacion}/edit', [
        'as' => 'admin.publicaciones.publicacion.edit',
        'uses' => 'PublicacionController@edit',
        'middleware' => 'can:publicaciones.publicacions.edit'
    ]);
    $router->put('publicacions/{publicacion}', [
        'as' => 'admin.publicaciones.publicacion.update',
        'uses' => 'PublicacionController@update',
        'middleware' => 'can:publicaciones.publicacions.edit'
    ]);
    $router->delete('publicacions/{publicacion}', [
        'as' => 'admin.publicaciones.publicacion.destroy',
        'uses' => 'PublicacionController@destroy',
        'middleware' => 'can:publicaciones.publicacions.destroy'
    ]);
// append

});
