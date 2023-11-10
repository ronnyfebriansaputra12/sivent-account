<?php

/** @var \Laravel\Lumen\Routing\Router $router */


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'group-menu'], function () use($router) {
    $router->get('/', 'GroupMenuController@index');
    $router->post('/add', 'GroupMenuController@store');
    $router->get('/edit/{id}', 'GroupMenuController@edit');
    $router->put('/update/{id}', 'GroupMenuController@update');
    $router->delete('/delete', 'GroupMenuController@destroy');
});

$router->group(['prefix' => 'menu'], function () use($router) {
    $router->get('/', 'MenuController@index');
    $router->post('/add', 'MenuController@store');
    $router->get('/edit/{id}', 'MenuController@edit');
    $router->put('/update/{id}', 'MenuController@update');
    $router->delete('/delete', 'MenuController@destroy');
});
