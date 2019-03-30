<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{    
	//use RefreshDatabase;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    /** @test */
    public function test_a_user_can_have_a_student()
    {
    	$user = factory('App\User')->create();

 		// $attributes =[
   //          'name' => 'Tim',
   //          'age' => 12,
   //          'gender' => 1,
   //          'owner_id' => $user->id,
   //      ];

    	$user->students()->create(['name'=>'Tim','owner_id' => $user->id, 'age' => 12,'gender' => 1]);
    	// dd($user->students->all());
    	$this->assertDatabaseHas('students',['name'=>'Tim']);
    }
}
