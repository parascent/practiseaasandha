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

Route::middleware(['auth'])->group(function(){
	Route::get('/home', 'TasksController@all')->name('home');
	Route::get('/tasks', 'TasksController@all')->name('tasks');
	Route::get('/tasks/{id}', 'TasksController@single')->name('singleTask');
	Route::post('/tasks', 'TasksController@add')->name('addTask');
	Route::patch('/tasks/{id}', 'TasksController@edit')->name('editTask');
	Route::patch('/tasks/{id}/markdone', 'TasksController@markDone')->name('markDoneTask');
	Route::delete('/tasks/{id}', 'TasksController@delete')->name('deleteTask');
});


