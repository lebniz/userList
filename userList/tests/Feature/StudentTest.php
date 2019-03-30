<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\Concerns\withoutExceptionHandling;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StudentTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return voidk
     */



    /** @test */
    public function guest_may_not_create_student($value='')
    {   
        // $this->withoutExceptionHandling();

        $this->post('/student')->assertRedirect('/login');
    }


    /** @test */
    public function a_user_can_create_a_student()
    {

        //Given I am a user who's logged in

        $this->actingAs(factory('App\User')->create());

        //when they hit the endpoint /students to create a new student, while passing the neccessary data.
        $attributes =[
            'name' => 'Tim',
            'age' => 12,
            'gender' => 1
        ];

        $this->post('/student',$attributes);

        //then there should be a new in the database.
        $this->assertDatabaseHas('students',['name'=>'Tim']);


    }
}
