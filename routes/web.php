<?php

/*
|--------------------------------------------------------------------------
| routerlication Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an routerlication.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});


/**
 *  Routes for items
 */
$router->group(['prefix' => 'api'], function ($router) {
    $router->get('items', 'ItemsController@add');
    $router->post('items', 'ItemsController@all');
    $router->put('items/{id}', 'ItemsController@put');
    $router->delete('items/{id}', 'ItemsController@remove');
});
