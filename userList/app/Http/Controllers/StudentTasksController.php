<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\Student;

class StudentTasksController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth');
	}

	public function store(Student $student)
	{

		$attributes = request()->validate([
			'description' => 'required',
		]);

		$student->addTask($attributes);
		return back();
	}


    public function update(Task $task)
    {
    	request()->has('completed')? $task->complete(): $task->incomplete();
		
    	$student = new Student();
		$this->authorize('update', $student);

    	return back();
    }

}
