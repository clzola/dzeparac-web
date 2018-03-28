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

Route::group(['namespace' => 'Api'], function() {

	Route::post('/parent/register', 'ParentRegisterController@register');

	// Auth API
	Route::group(['prefix' => 'auth'], function() {
		Route::post('/login', 'AuthController@login');
		Route::post('/logout', 'AuthController@logout');
		Route::get('/refresh', 'AuthController@refresh');
		Route::get('/me', 'AuthController@me');
	});

	// Parent API
	Route::group(['middleware' => 'auth:api', 'prefix' => 'parent', 'namespace' => 'Parent'], function() {
		Route::get('/children/{child}/status', 'ChildStatusController@status');
		Route::get('/children/{child}', 'ChildrenController@show');
		Route::put('/children/{child}', 'ChildrenController@update');
		Route::get('/children', 'ChildrenController@children');
		Route::post('/children', 'ChildrenController@store');
	});

});
