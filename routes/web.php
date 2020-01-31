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

Route::get('/', 'LoginController@index');
Route::get('/login', 'LoginController@index');
Route::post('/login/checkLogin', 'LoginController@checkLogin');
Route::get('/login/logout', 'LoginController@logout');

Route::get('/game', 'GameController@index');
Route::get('/game/question', 'GameController@getQuestion');
Route::post('/game/submitAnswer', 'GameController@submitAnswer');

Route::get('/game/leaderboard', 'GameController@leaderboard');

Route::post('/game/coins', 'GameController@getCoins');


