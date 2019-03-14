<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    
   	const GENDER_UN = 2;
    const GENDER_M = 1;
    const GENDER_F = 0;
    /**
     * database related to model
     */
    protected $table = "student";

    /**
     * assign not to have timestamp on model
     */
    public $timestamps = false;


	/**
     * transmit gender from number to text 
     */


    public function gender($ind = null)
    {
        $arr = array(
            self::GENDER_F => 'female',
            self::GENDER_M => 'male',
            self::GENDER_UN => 'unknown',
        );

        if($ind !== null)
        {
            return array_key_exists($ind, $arr) ? $arr[$ind] : $arr[self::GENDER_UN];
        }
        return $arr;
    }
}