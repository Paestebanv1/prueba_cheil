<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/hotelesByName', 'HotelsController@getByName');

Route::get('/hotelesByStar', 'HotelsController@getByStars');

Route::get('/hotelesByPrice', 'HotelsController@getByPrice');

Route::get('/hotelesByAmenties', 'HotelsController@getByAmenties');

Route::get('/hoteles', 'HotelsController@index');

Route::post('/hoteles', 'HotelsController@create');

Route::put('/hoteles', 'HotelsController@update');
