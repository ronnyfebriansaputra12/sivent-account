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

$router->post('/loginAdmin', 'AuthController@loginAdmin');

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

$router->group(['prefix' => 'admin'], function () use($router) {
    $router->get('/', 'AdminController@index');
    $router->post('/add', 'AdminController@store');
    $router->get('/edit/{id}', 'AdminController@edit');
    $router->put('/update/{id}', 'AdminController@update');
    $router->delete('/delete', 'AdminController@destroy');
});

$router->group(['prefix' => 'role'], function () use($router) {
    $router->get('/', 'RoleController@index');
    $router->post('/add', 'RoleController@store');
    $router->get('/edit/{id}', 'RoleController@edit');
    $router->put('/update/{id}', 'RoleController@update');
    $router->delete('/delete', 'RoleController@destroy');
});

$router->group(['prefix' => 'privilage'], function () use($router) {
    $router->get('/', 'PrivilageController@index');
    $router->post('/add', 'PrivilageController@store');
    $router->get('/edit/{id}', 'PrivilageController@edit');
    $router->put('/update/{id}', 'PrivilageController@update');
    $router->delete('/delete', 'PrivilageController@destroy');
});