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

//BOOKS GET
$router->get('/blog', 'BlogController@index');
$router->get('/blog/{id}', 'BlogController@show');

Route::group(['middleware' => 'auth'], function () {
    
    Route::post('/register', 'UserController@register');
    Route::post('/login', 'UserController@login');

    Route::get('/logout', 'UserController@logout');
 
    Route::post('/blog', 'BlogController@store');
    Route::put('/blog/{id}', 'BlogController@update');
    Route::delete('/blog/{id}', 'BlogController@destroy');
});


