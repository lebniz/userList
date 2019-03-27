<?php

use App\Student;
use Illuminate\Database\Seeder;

class StudentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (range(1,3) as $number) {
        	Student::create([
        		'name' => 'Mike',
        		'gender' => 1,
        		'age' => 12,
        		'owner_id' => 1, 
        	]);
        }
    }

}
