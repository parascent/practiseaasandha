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

Route::get('/home', 'TasksController@all')->name('home')->middleware('auth.basic');
Route::get('/tasks', 'TasksController@all')->name('tasks')->middleware('auth.basic');
Route::get('/tasks/{id}', 'TasksController@single')->name('singleTask')->middleware('auth.basic');
Route::post('/tasks', 'TasksController@add')->name('addTask')->middleware('auth.basic');
Route::patch('/tasks/{id}', 'TasksController@edit')->name('editTask')->middleware('auth.basic');
Route::patch('/tasks/{id}/markdone', 'TasksController@markDone')->name('markDoneTask')->middleware('auth.basic');
Route::delete('/tasks/{id}', 'TasksController@delete')->name('deleteTask')->middleware('auth.basic');

