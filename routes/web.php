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
    return view('home');
});
Route::get('/employees', 'EmployeeController@index');
Route::get('/create', 'EmployeeController@create');
Route::post('/store', 'EmployeeController@store');
Route::post('/edit', 'EmployeeController@edit');
Route::post('/update', 'EmployeeController@update');
Route::post('/destroy', 'EmployeeController@destroy');
