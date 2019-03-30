<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{

    protected $guarded = [];


	public function student()
	{
		return $this->belongsTo(Student::class);
	}

	public function complete($completed = true)
	{
		$this->update(compact('completed'));
	}

	public function incomplete()
	{
		$this->complete(false);
	}

	public function completedCount()
	{
		return count($this->completed);
	}
}
