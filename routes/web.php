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

Route::get('/', function () {
    return view('welcome');
});
Route::resource('works','WorkController');
Route::resource('tasks','TaskController');

Route::get('users', 'UserController@index')->name('users.index')->middleware('admin');
Route::post('users', 'UserController@store')->name('users.store')->middleware('admin');
Route::patch('users/{user}', 'UserController@update')->name('users.update')->middleware('admin');
Route::delete('users/{user}', 'UserController@destroy')->name('users.destroy')->middleware('admin');

Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');
