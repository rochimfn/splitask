<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function ()
{
    return redirect('login');
});
Route::get('/home', function ()
{
    return redirect('/');
});

// General
Route::get('accounts', 'UserController@edit')->name('users.edit');
Route::patch('accounts', 'UserController@updateProfile')->name('users.update.profile');


// Administrator
Route::get('administrator', 'UserController@index')->middleware('admin')->name('administrator.index');
Route::post('administrator', 'UserController@store')->middleware('admin')->name('administrator.store');
Route::patch('administrator/{user}', 'UserController@update')->middleware('admin')->name('administrator.update');
Route::delete('administrator/{user}', 'UserController@destroy')->middleware('admin')->name('administrator.destroy');
Route::post('administrator/departments', 'DepartmentController@store')->middleware('admin')->name('administrator.departments.store');
Route::delete('administrator/departments/{department}', 'DepartmentController@destroy')->middleware('admin')->name('administrator.departments.destroy');
// Chief
Route::get('chief', 'DepartmentController@index')->middleware('chief')->name('chief.departments.index');
Route::post('chief', 'WorkController@store')->middleware('chief')->name('chief.departments.store');
Route::patch('chief/works/{work}', 'WorkController@update')->middleware('chief')->name('chief.works.update');
Route::patch('chief/works/{work}', 'WorkController@updateStatusWork')->middleware('chief')->name('chief.work.update.status');
Route::delete('chief/{work}', 'WorkController@destroy')->middleware('chief')->name('chief.works.destroy');
Route::get('chief/works/{work}', 'WorkController@show')->middleware('chief')->name('chief.task.show');
Route::patch('chief/{work}', 'WorkController@update')->middleware('chief')->name('chief.works.update');

// Manager
Route::get('manager', 'WorkController@index')->middleware('manager')->name('manager.works.index');
Route::patch('manager/{work}/report', 'WorkController@storeReport')->middleware('manager')->name('manager.store.report');
Route::post('manager/tasks', 'TaskController@store')->middleware('manager')->name('manager.tasks.store');
Route::patch('manager/tasks/{task}', 'TaskController@update')->middleware('manager')->name('manager.tasks.update');
Route::get('manager/tasks/{task}', 'TaskController@show')->middleware('manager')->name('manager.task.show');
Route::patch('manager/task/{task}', 'TaskController@updateStatusTask')->middleware('manager')->name('manager.task.update.status');
Route::delete('manager/tasks/{user}', 'TaskController@destroy')->middleware('manager')->name('manager.tasks.destroy');

// Staff
Route::get('staff', 'TaskController@index')->middleware('staff')->name('staff.tasks.index');
Route::get('staff/{task}', 'TaskController@show')->middleware('staff')->name('staff.tasks.show');
Route::patch('staff/{task}/report', 'TaskController@storeReport')->middleware('staff')->name('staff.store.report');

Auth::routes(['register' => false]);
// Route::get('/home', 'HomeController@index')->name('home');
