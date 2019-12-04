<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/locales'], function (Router $router) {
    $router->bind('local', function ($id) {
        return app('Modules\Locales\Repositories\LocalRepository')->find($id);
    });
    $router->get('locals', [
        'as' => 'admin.locales.local.index',
        'uses' => 'LocalController@index',
        'middleware' => 'can:locales.locals.index'
    ]);
    $router->get('locals/create', [
        'as' => 'admin.locales.local.create',
        'uses' => 'LocalController@create',
        'middleware' => 'can:locales.locals.create'
    ]);
    $router->post('locals', [
        'as' => 'admin.locales.local.store',
        'uses' => 'LocalController@store',
        'middleware' => 'can:locales.locals.create'
    ]);
    $router->get('locals/{local}/edit', [
        'as' => 'admin.locales.local.edit',
        'uses' => 'LocalController@edit',
        'middleware' => 'can:locales.locals.edit'
    ]);
    $router->put('locals/{local}', [
        'as' => 'admin.locales.local.update',
        'uses' => 'LocalController@update',
        'middleware' => 'can:locales.locals.edit'
    ]);
    $router->delete('locals/{local}', [
        'as' => 'admin.locales.local.destroy',
        'uses' => 'LocalController@destroy',
        'middleware' => 'can:locales.locals.destroy'
    ]);
// append

    $router->get('locals/{local}/galeria', [
        'as' => 'admin.locales.local.galeria',
        'uses' => 'LocalController@galeria',
    ]);
    $router->post('locals/{local}/galeria', [
        'as' => 'admin.locales.local.store_galeria',
        'uses' => 'LocalController@store_galeria',
    ]);
    $router->post('locals/{local}/store-galeria-ajax', [
        'as' => 'admin.locales.local.store_galeria_ajax',
        'uses' => 'LocalController@store_galeria_ajax',
    ]);
    $router->delete('locals/{local}/{file}/galeria', [
        'as' => 'admin.locales.local.delete_file',
        'uses' => 'LocalController@delete_file',
    ]);

});

$router->post('contacto/leido', [
    'as' => 'admin.contactos.contacto.leido',
    'uses' => 'LocalController@contacto_leido',
]);

$router->get('contacto/index-ajax', [
    'as' => 'admin.contacto.contacto.index_ajax',
    'uses' => 'LocalController@contacto_index_ajax'
]);

$router->put('contacto/change-contacto-importante', [
    'as' => 'admin.contacto.contacto.change_contacto_importante',
    'uses' => 'LocalController@change_contacto_importante'
]);

$router->put('contacto/change-contacto-tipo', [
    'as' => 'admin.contacto.contacto.change_contacto_tipo',
    'uses' => 'LocalController@change_contacto_tipo'
]);
