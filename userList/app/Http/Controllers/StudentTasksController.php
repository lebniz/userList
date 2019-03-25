<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\Student;

class StudentTasksController extends Controller
{

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

    	return back();
    }
}
