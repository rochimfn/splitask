<?php

use Illuminate\Support\Facades\Route;

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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', function ()
{
    return redirect('login');
});


Route::get('tasks', 'TaskController@index')->name('tasks.index')->middleware('staff');
Route::get('tasks/{task}', 'TaskController@show')->name('tasks.show');
Route::post('tasks', 'TaskController@store')->name('tasks.store')->middleware('staff');
Route::patch('tasks/{user}', 'TaskController@update')->name('tasks.update')->middleware('staff');
Route::delete('tasks/{user}', 'TaskController@destroy')->name('tasks.destroy')->middleware('staff');


Route::get('works', 'WorkController@index')->name('works.index')->middleware('manager');
Route::post('works', 'WorkController@store')->name('works.store')->middleware('manager');
Route::patch('works/{work}', 'WorkController@update')->name('works.update')->middleware('manager');
Route::delete('works/{work}', 'WorkController@destroy')->name('works.destroy')->middleware('manager');
Route::patch('works/{work}', 'WorkController@storeReport')->middleware('manager');

Route::patch('tasks/{task}', 'WorkController@approveTask')->middleware('manager');
Route::patch('tasks/{task}', 'WorkController@disapproveTask')->middleware('manager');



Route::get('users', 'UserController@index')->name('users.index')->middleware('admin');
Route::post('users', 'UserController@store')->name('users.store')->middleware('admin');
Route::patch('users/{user}', 'UserController@update')->name('users.update')->middleware('admin');
Route::delete('users/{user}', 'UserController@destroy')->name('users.destroy')->middleware('admin');

Auth::routes(['register' => false]);
Route::get('/home', 'HomeController@index')->name('home');
