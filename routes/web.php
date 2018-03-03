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

Route::post("/parent/login", 'Api\Parent\LoginController@login');
Route::post("/parent/register", 'Api\Parent\RegisterController@register');

Route::get('/parent/children', 'Api\Parent\ChildrenController@children');

Route::get('/parent/children/{child}/wishes', 'Api\Parent\WishesController@wishes');

Route::get('/', function () {
    return view('welcome');
});
