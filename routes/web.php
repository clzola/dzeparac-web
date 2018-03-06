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

Route::get("/categories", 'Api\Parent\CategoriesController@index');

Route::post("/parent/login", 'Api\Parent\LoginController@login');
Route::post("/parent/register", 'Api\Parent\RegisterController@register');

Route::get('/parent/children', 'Api\Parent\ChildrenController@children');
Route::post('/parent/children', 'Api\Parent\ChildrenController@store');
Route::post('/parent/children/{child}', 'Api\Parent\ChildrenController@update');

Route::get('/parent/children/{child}/wishes', 'Api\Parent\WishesController@wishes');

Route::get("/parent/children/{child}/completed-tasks", 'Api\Parent\TasksController@completedTasks');
Route::post("/parent/children/{child}/complete-tasks", 'Api\Parent\TasksController@markManyAsCompleted');
Route::post("/parent/children/{child}/wishes/{wish}/tasks/create", 'Api\Parent\TasksController@create');
Route::post("/parent/children/{child}/wishes/{wish}/tasks/{task}/complete", 'Api\Parent\TasksController@complete');
Route::post("/parent/children/{child}/wishes/{wish}/tasks/{task}/incomplete", 'Api\Parent\TasksController@incomplete');

Route::get("/parent/children/{child}/history", 'Api\Parent\HistoryEntriesController@history');






Route::group(["prefix" => "child", 'namespace' => 'Api\Child'], function() {
    Route::post('/login', 'LoginController@login');

    Route::get('/wishes', 'WishesController@index');
    Route::post('/wishes/create', 'WishesController@store');
    Route::get('/wishes/{wish}', 'WishesController@show');
    Route::post('/wishes/{wish}/update', 'WishesController@update');

    Route::get('/tasks', 'TasksController@index');
    Route::get('/tasks/{task}/complete', 'TasksController@markAsCompleted');
    Route::get('/tasks/{task}/complete/revert', 'TasksController@markAsNotCompleted');

    Route::get('/dzeparac', 'DzeparacController@index');

    Route::get('/history', 'HistoryController@index');
    Route::get('/history/{entry}', 'HistoryController@show');
    Route::post('/history/create', 'HistoryController@store');
    Route::post('/history/{entry}/update', 'HistoryController@update');

});




Route::get('/', function () {
    return view('welcome');
});
