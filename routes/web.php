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

use Illuminate\Support\Facades\Route;

Route::get('/', 'SocialLoginController@index');
Route::get('/login', 'SocialLoginController@index');

Route::get('/auth/redirect/{provider}', 'SocialLoginController@auth_redirect');
Route::get('/auth/callback/{provider}', 'SocialLoginController@auth_callback');
Route::post('/auth/register', 'SocialLoginController@registerUser');
Route::get('/auth/logout', 'SocialLoginController@logout');


Route::get('/game', 'GameController@index');
Route::get('/game/question', 'GameController@getQuestion');
Route::post('/game/submitAnswer', 'GameController@submitAnswer');
Route::get('/game/leaderboard', 'GameController@leaderboard');
Route::post('/game/coins', 'GameController@getCoins');
Route::get('/game/profile', 'GameController@viewProfile');

Route::get('/admin', 'AdminController@index');
Route::get('/admin/view/profile/{username}', 'AdminController@viewProfile');
Route::post('/admin/actions/coins_giveaway/{username}', 'AdminController@coinsGiveaway');
Route::post('/admin/actions/change_user_type/{username}', 'AdminController@changeUserType');
Route::get('/admin/actions/block_user/{username}', 'AdminController@blockUser');
Route::post('/admin/actions/coins_giveaway_all', 'AdminController@coinsGiveawayAll');
