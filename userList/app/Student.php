<?php

namespace App;

use App\Mail\StudentCreated;
use Illuminate\Database\Eloquent\Concerns\created;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class Student extends Model
{
    
   	const GENDER_UN = 2;
    const GENDER_M = 1;
    const GENDER_F = 0;
    /**
     * database related to model
     */
    protected $guarded = [];


    protected static function boot()
    {
        parent::boot();
        static::created(function ($student)
        {
            \Mail::to($student->owner->email)->send(
                new StudentCreated($student)
            );

        });
    }


    /**
     * tasks relation
     */
    public function tasks()
    {
        return $this->hasMany(Task::class);

    }

    public function addTask($task)
    {
        $this->tasks()->create($task);
    }

    public function owner()
    {
        return $this->belongsTo(User::class);
    }


    protected $fillable = [
        'order_p'
    ];
    /**
     * assign not to have timestamp on model
     */
    // public $timestamps = false;


	/**
     * transmit gender from number to text 
     */
    public function gender($ind = null)
    {
        $arr = array(
            self::GENDER_F => __('message.female'),
            self::GENDER_M => __('message.male'),
            self::GENDER_UN => __('message.unknown'),
        );

        if($ind !== null)
        {
            return array_key_exists($ind, $arr) ? $arr[$ind] : $arr[self::GENDER_UN];
        }
        return $arr;
    }

    public function taskNumber($ind = null)
    {
        $unsolved = $this->hasMany(Task::class)->where('tasks.completed', '=', '0')->count();
        $solved = $this->hasMany(Task::class)->where('tasks.completed', '=', '1')->count();
        
        $arr = array($solved ,' / ' ,$unsolved);

        if($ind !== null)
        {
            return array_key_exists($ind, $arr) ? $arr[$ind] : '0';
        }
        return $arr;
    }
}