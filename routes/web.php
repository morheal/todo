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

Route::get('/', 'HomeController@index');
Route::get('/showUsersTasks', 'TaskUserController@showUsersTasks');
Route::post('/add_task', 'TaskController@addTask');
Route::post('/delete_task', 'TaskController@deleteTask');
Route::post('/get_users_without_task', 'TaskController@getUsersWithoutTask');
Route::post('/add_task_user', 'TaskController@addTaskToUser');

Route::get('/get_users_without_task/{i}', 'TaskController@getUsersWithoutTask');

Auth::routes();
