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
    Route::post('/controlUser', 'UsersController@controlUser');

});
