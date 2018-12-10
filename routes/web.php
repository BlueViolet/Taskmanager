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


Auth::routes();

Route::get('/', 'HomeController@index')->name('home');


Route::resource('projects', 'ProjectsController');
Route::resource('tasks', 'ProjectsController');


// Route::get('/', 'ProjectsController@index');
// Route::post('projects', ['uses'=>'ProjectsController@store',
// 'as'=>'projects.store']);
// Route::patch('projects/{project}', ['uses'=>'ProjectsController@update',
// 'as'=>'projects.update']);
// Route::delete('projects/{project}',['uses'=>'ProjectsController@destroy',
// 'as'=>'projects.destroy']);
// Route::get('projects/{project}',['uses'=>'ProjectsController@show',
// 'as'=>'projects.show']);

