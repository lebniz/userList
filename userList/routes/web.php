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

// Route::get('/', function () {
//     return view('student/index');
// });

Route::get('student', 'StudentController@index');

Route::any('student/create', ['uses' => 'StudentController@create']);
Route::any('student/update/{id}', ['uses' => 'StudentController@update']);
Route::any('student/delete/{id}', ['uses' => 'StudentController@delete']);
Route::any('student/detail/{id}', ['uses' => 'StudentController@detail']);


// Route::group(['prefix' => 'student'], function () {
//     Route::any('/', 'StudentController@index');
//     Route::match(['get', 'post'], 'create', 'StudentController@create');
//     Route::match(['get', 'post'], 'update/{id}', 'StudentController@update');
//     Route::match(['get', 'put'], 'detail/{id}', 'StudentController@detail');
//     Route::any('delete/{id}', 'StudentController@delete');
// });