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

$router->get('/matakuliah', ['uses' => 'AuthController@getMatkuls']);
$router->get('/prodi', ['uses' => 'ProdiController@getProdis']);


$router->group(['prefix' => 'auth'], function () use ($router) {
    $router->post('/register', ['uses' => 'AuthController@register']);
    $router->post('/login', ['uses' => 'AuthController@login']);
});

$router->group(['prefix' => 'mahasiswa'], function () use ($router) {
    $router->get('', ['uses' => 'AuthController@getMahasiswas']);
    $router->get('/profile', ['middleware' => 'auth', 'uses' => 'AuthController@getMahasiswaByToken']);
    $router->get('/{nim}', ['uses' => 'AuthController@getMahasiswasByNim']);
    $router->post('/{nim}/matakuliah/{matakuliahId}', ['middleware' => 'auth', 'uses' => 'AuthController@storeMatakuliah']);
    $router->put('/{nim}/matakuliah/{matakuliahId}', ['middleware' => 'auth', 'uses' => 'AuthController@deleteMatakuliah']);
});

$router->get('/prodi', ['uses' => 'AuthController@getProdis']);
$router->get('/matakuliah', ['uses' => 'AuthController@getMatkuls']);
