<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => 'api'], function(){
    Route::post('login', 'LoginController@login');
    Route::post('register', 'Auth\RegisterController@register');
    Route::group(['middleware' => 'jwt.auth'], function(){
        Route::resource('publication', 'PublicationController');
		Route::get('/publication/tag/{tag}', [
			'as'   => 'tag',
			'uses' => 'PublicationController@tag'
		]);
    });
});