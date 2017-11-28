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
    $router->post('items', 'ItemController@add');
    $router->get('items', 'ItemController@all');
    $router->get('items/{id}', 'ItemController@oneItem');
    $router->put('items/{id}', 'ItemController@update');
    $router->delete('items/{id}', 'ItemController@delete');
});

/**
 *  Routes for orders
 */
$router->group(['prefix' => 'api'], function ($router) {
    $router->post('orders', 'OrderController@add');
    $router->put('orders/{id}', 'OrderController@update');
    $router->delete('orders/{id}', 'OrderController@delete');
    $router->get('orders', 'OrderController@all');
    $router->get('orders/{id}', 'OrderController@oneOrder');
});

$router->group(['prefix' => 'api', 'middleware' => 'web'], function ($router) {
    $router->post('cart', 'CartController@add');
    $router->get('cart', 'CartController@all');
    $router->delete('cart/{id}', 'CartController@delete');
});
$router->group(['prefix' => 'api'], function ($router) {
    $router->post('users', 'UserController@add');
});
