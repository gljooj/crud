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
 Route::get('/', 'UsersController@welcomeView');
Route::group(['prefix' => 'controluser'], function(){
 Route::get('/', 'UsersController@welcomeView');
    Route::post('/controlUser', 'UsersController@controlUser');
	Route::post('/datasEdited', 'UsersController@datasEdited');
	Route::get('/fi', 'UsersController@QuestaoDois');
	Route::get('/editUser/{id}', 'UsersController@editUser');
	Route::get('/remove/{id}', 'UsersController@remove');


});
