<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use \App\models\Student;

class StudentController extends Controller
{
    public function index()
    {
		$students = Student::orderby('id', 'desc')->paginate(5);
        return view('student/index', ['students' => $students]);
    }

    public function create(Request $request)
	{    

		if($request->isMethod('POST')){
	    	$this->validate($request, [
	            'Student.name' => 'required|min:3|max:20',
	            'Student.age' => 'required|integer',
	            'Student.gender' => 'required|integer',
        	],[
			    'required' => ':attribute is required.',
			    'min' => ':attribute should be between 3-20 characters',
			    'max' => ':attribute should be between 3-20 characters',
			    'integer' => ':attribute is integer',
			],[
			    'Student.name' => 'Name',
			    'Student.age' => 'Age',
			    'Student.gender' => 'Gender',
			]);
	    	$data = $request->input('Student');
	    	$data['created_time'] = time();
	    	$data['updated_time'] = time();

	        // var_dump($data);
		    $ret = Student::insert($data);
	        // var_dump($ret);

	        if($ret){
	        	return redirect('/')->with('success', 'Now a student is ADDED!')->withInput();
	        }else{
	        	return redirect('student/create')->with('error', 'Failed to add the student info.')->withInput();
	        }

    	}

	    return view('student/create');
	}

	public function update(Request $request, $id)
	{
		$student_info = Student::find($id);

		if($request->isMethod('POST')){

	    	$this->validate($request, [
	            'Student.name' => 'required|min:3|max:20',
	            'Student.age' => 'required|integer',
	            'Student.gender' => 'required|integer',
	    	],[
			    'required' => ':attribute is required.',
			    'min' => ':attribute should be between 3-20 characters',
			    'max' => ':attribute should be between 3-20 characters',
			    'integer' => ':attribute is integer',
			],[
			    'Student.name' => 'Name',
			    'Student.age' => 'Age',
			    'Student.gender' => 'Gender',
			]);

	    	$data = $request->input('Student');
	    	$student_info->name = $data['name'];
	        $student_info->age = $data['age'];
	        $student_info->gender = $data['gender'];
	        $student_info->updated_time = time();
			$ret = $student_info->save();

			if($ret){
				return redirect('/')->with('success', 'Student info is UPDATED!')->withInput();
			}else{
				return redirect('student/update')->with('error', 'Failed to update student info.')->withInput();
			}
		}
	    return view('student/update', ['student_info' => $student_info]);
	}


	public function detail($id){

		$students = Student::find($id);

		return view('student/detail', ['students' => $students]);
	}


	public function delete($id)
	{
	    $student = Student::find($id);

	    if($student->delete())
	    {
	        return redirect('/')->with('success', 'Delete-'.$id. ' SUCCESS');
	    } else {
	        return redirect()->back()->with('error', 'DETELE-'.$id.' FAILED');
	    }
	}

}