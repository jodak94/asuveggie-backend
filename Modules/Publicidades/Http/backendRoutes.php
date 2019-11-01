<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/publicidades'], function (Router $router) {
    $router->bind('publicidad', function ($id) {
        return app('Modules\Publicidades\Repositories\PublicidadRepository')->find($id);
    });
    $router->get('publicidads', [
        'as' => 'admin.publicidades.publicidad.index',
        'uses' => 'PublicidadController@index',
        'middleware' => 'can:publicidades.publicidads.index'
    ]);
    $router->get('publicidads/create', [
        'as' => 'admin.publicidades.publicidad.create',
        'uses' => 'PublicidadController@create',
        'middleware' => 'can:publicidades.publicidads.create'
    ]);
    $router->post('publicidads', [
        'as' => 'admin.publicidades.publicidad.store',
        'uses' => 'PublicidadController@store',
        'middleware' => 'can:publicidades.publicidads.create'
    ]);
    $router->get('publicidads/{publicidad}/edit', [
        'as' => 'admin.publicidades.publicidad.edit',
        'uses' => 'PublicidadController@edit',
        'middleware' => 'can:publicidades.publicidads.edit'
    ]);
    $router->put('publicidads/{publicidad}', [
        'as' => 'admin.publicidades.publicidad.update',
        'uses' => 'PublicidadController@update',
        'middleware' => 'can:publicidades.publicidads.edit'
    ]);
    $router->delete('publicidads/{publicidad}', [
        'as' => 'admin.publicidades.publicidad.destroy',
        'uses' => 'PublicidadController@destroy',
        'middleware' => 'can:publicidades.publicidads.destroy'
    ]);
// append

});
