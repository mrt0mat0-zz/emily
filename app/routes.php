<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


Route::get('login',					'UsersController@getLogin');
Route::get('password/reset',			'UsersController@getResetPassword');
Route::get('password/reset/{token}','UsersController@getResetPasswordToken');
Route::post('login',					'UsersController@postLogin');

Route::group(array('before' => 'auth'), function(){
	Route::get('/', 'UsersController@index');

});