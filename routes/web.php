<?php

use Dusterio\LumenPassport\LumenPassport;
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
    $routes = $router->app->router->getRoutes();
    return view("home")->with("routes", $routes);
});


$router->group(['middleware' => 'guest', 'prefix' => 'api/admin'], function () use ($router) {
    $router->post('/register', 'UserController@Register');
});


$router->group(['middleware' => 'guest', 'prefix' => 'api/admin'], function () use ($router) {
    $router->post('/login', 'UserController@login');
});
$router->group(['middleware' => 'auth', 'prefix' => 'api/admin'], function () use ($router) {
    $router->post('/logout', 'UserController@logout');
});

$router->group(['middleware' => 'auth', 'prefix' => 'api'], function () use ($router) {

    // parents
    $router->get('/parents', 'ParentController@index');
    
    $router->get('/parents/{theParent}', 'ParentController@show');
    
    $router->post('/parents/create', 'ParentController@store');
    
    $router->post('/parents/update/{theParent}', 'ParentController@update');
    
    $router->delete('/parents/delete/{theParent}', 'ParentController@destroy');
    
    //students
    $router->get('/students', 'StudentController@index');
    
    $router->get('/students/{student_id}', 'StudentController@show');
    
    $router->post('/students/create', 'StudentController@store');
    
    $router->post('/students/update/{student_id}', 'StudentController@update');
    
    $router->delete('/students/delete/{student_id}', 'StudentController@destroy');
    
    //Cartes
    $router->get('/cartes', 'CarteController@index');
    
    $router->get('/cartes/{carte_id}', 'CarteController@show');
    
    $router->post('/cartes/create', 'CarteController@store');
    
    $router->post('/cartes/update/{carte_id}', 'CarteController@update');
    
    $router->delete('/cartes/delete/{carte_id}', 'CarteController@destroy');
    
    //students_parents
    $router->get('/studentParent', 'StudentParentController@index');
    
    $router->get('/studentParent/{studentParent_id}', 'StudentParentController@show');
    
    $router->post('/studentParent/create', 'StudentParentController@store');
    
    $router->post('/studentParent/update/{studentParent_id}', 'StudentParentController@update');
    
    $router->delete('/studentParent/delete/{studentParent_id}', 'StudentParentController@destroy');
    
    //waitings
    $router->get('/waiting', 'WaitingController@index');
    
    $router->get('/waiting/{student_id}', 'WaitingController@show');
    
    $router->post('/waiting/create', 'WaitingController@store');
    
    $router->post('/waiting/update/{student_id}', 'WaitingController@update');
    
    $router->delete('/waiting/delete/{student_id}', 'WaitingController@destroy');
    
});
