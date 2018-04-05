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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'tasks'], function() {
    Route::get('/', 'TaskController@index')->name('allTasks');
    Route::get('create', 'TaskController@create')->name('createTask');
    Route::post('/', 'TaskController@store')->name('storeTask');
    Route::get('{task}', 'TaskController@show')->name('showTask');
    Route::get('{task}/edit', 'TaskController@edit')->name('editTask');
    Route::put('{task}', 'TaskController@update')->name('updateTask');
    Route::delete('{task}', 'TaskController@destroy')->name('deleteTask');
});
