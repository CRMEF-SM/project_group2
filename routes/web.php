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

$router->get('/parents', 'ParentController@index');

//show Each Products By ID
$router->get('/parents/{id}', 'ParentController@show');

//store products
$router->post('/parents/create', 'ParentController@store');

//update products
$router->post('/parents/update/{id}', 'ParentController@update');

// Delete
$router->delete('/parents/delete/{id}', 'ParentController@destroy');