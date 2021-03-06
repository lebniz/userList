<?php

// use Illuminate\Http\Request;

// use App\Notifications\SubscriptionRenewalFailed;
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

// Route::get('/', function(){
// 	$user = App\User::first();

// 	$user->notify(new SubscriptionRenewalFailed);

// 	return 'Done';
// });


Route::middleware('auth')->post('/student', function(){
	$attributes = request()->validate(['name'=>'required','age'=>'required','gender'=>'required']);
	$attributes['owner_id'] = auth()->id();

	App\Student::create($attributes);

	return redirect('/');
});


Route::get('/', 'HomeController@index')->name('home');

Route::resource('student','StudentController');
Route::patch('student', ['uses' => 'StudentController@orderUpdate'])->name('student.sort');
Route::post('student/export', ['uses' => 'StudentController@export']);

Route::patch('/tasks/{task}', 'StudentTasksController@update');
Route::post('/student/show/{student}/tasks', 'StudentTasksController@store')->middleware('can:update,student');




// multi-language
Route::get('{locale}', function($locale){
	Session::put('locale', $locale);
	return redirect()->back();
});
