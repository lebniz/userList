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

Route::resource('student','StudentController');
Route::patch('student', ['uses' => 'StudentController@orderUpdate'])->name('student.sort');

// Route::get('student', 'StudentController@index');
// Route::any('student/create', ['uses' => 'StudentController@create']);
// Route::any('student/update/{id}', ['uses' => 'StudentController@update']);
// Route::any('student/delete/{id}', ['uses' => 'StudentController@delete']);
// Route::any('student/show/{id}', ['uses' => 'StudentController@show']);
// Route::post('student/store', 'StudentController@store');

Route::patch('/tasks/{task}', 'StudentTasksController@update');
Route::post('/student/show/{student}/tasks', 'StudentTasksController@store')->middleware('can:update,student');

Route::get('{locale}', function($locale){
	Session::put('locale', $locale);
	return redirect()->back();
});
