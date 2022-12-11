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

$router->group(['prefix' => 'auth'], function () use ($router) {
    $router->post('/register', ['uses' => 'AuthController@register']);
    $router->post('/login', ['uses' => 'AuthController@login']);
});

$router->group(['prefix' => 'mahasiswa'], function () use ($router) {
    $router->get('', ['uses' => 'AuthController@getMahasiswas']);
    $router->get('/profile', ['uses' => 'AuthController@getMahasiswaByToken']);
    $router->get('/{nim}', ['uses' => 'AuthController@getMahasiswas']);
});



$router->get('/prodi', ['uses' => 'AuthController@getProdis']);
$router->get('/matakuliah', ['uses' => 'AuthController@getMatkuls']);
