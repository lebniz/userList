<?php

namespace App;

use App\Events\StudentCreated;
use App\Task;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    
    use SoftDeletes;

   	const GENDER_UN = 2;
    const GENDER_M = 1;
    const GENDER_F = 0;

    protected $guarded = [];

    protected $fillable = [
        'name',
        'age',
        'gender',
        'order_p',
        'owner_id',
    ];

    protected $dispatchesEvents = [
        'saved' => StudentCreated::class 
    ];


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
        //$total = $this->tasks()->count('tasks.id');
        $unsolved = $this->tasks()->where('tasks.completed', '=', '0')->count('tasks.id');
        $solved = $this->tasks()->where('tasks.completed', '=', '1')->count('tasks.id');
        
        // $arr = array( $total,' = ',$solved ,' / ' ,$unsolved);
        $arr = array( $solved ,' / ' ,$unsolved);

        if($ind !== null)
        {
            return array_key_exists($ind, $arr) ? $arr[$ind] : '0';
        }
        return $arr;
    }
}