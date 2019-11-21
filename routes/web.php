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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', 'Security\LoginController@login');
Route::post('/login', 'Security\LoginController@postLogin');

Route::get('/register', 'Security\RegisterController@register');
Route::post('/register', 'Security\RegisterController@registerUser');


Route::get('/logout', 'Security\LoginController@logout');

# Accounts Dashboards
Route::get('/employee', 'Accounts\employeeController@employee')->middleware('employee');
Route::get('/line-manager', 'Accounts\lineManagerController@lineManager')->middleware('line_manager');

Route::post('/process-leave', 'Utils\leaveController@processLeave')->middleware('employee');
Route::get('/decline-leave/{id}', 'Utils\leaveController@declineLeave')->middleware('line_manager');
Route::post('/accept-leave', 'Utils\leaveController@acceptLeave')->middleware('line_manager');