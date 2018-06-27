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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::view('/', 'CheckController@index', ['status' => NULL]);
Route::get('/', 'CheckController@index');
Route::post('/', 'CheckController@store');
Route::post('/', 'CheckController@list');

Route::view('/checks', 'CheckController@index', ['status' => NULL]);
Route::get('/checks', 'CheckController@index');
Route::post('/checks', 'CheckController@store');

Route::get('/users', 'UserController@index');
Route::post('/users', 'UserController@store');
//\URL::forceScheme('https');
