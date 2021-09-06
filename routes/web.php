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

// Registration
$router->post('/register', 'UsersController@register');
$router->post('/login', 'UsersController@login');

$router->get('/products', 'ProductsController@index');

// Find by
$router->get('/product/{id}', 'ProductsController@show');
$router->get('/products/brand', 'ProductsController@findByBrand');
$router->get('/products/category', 'ProductsController@findByCategory');
$router->get('/products/condition', 'ProductsController@findByCondition');
$router->get('/products/price', 'ProductsController@findByPriceRange');

// For Developer
$router->post('/product', 'ProductsController@create');
$router->put('/product/{id}', 'ProductsController@update');
$router->delete('/product/{id}', 'ProductsController@destroy');