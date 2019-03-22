<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use \App\models\Student;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $request->session()->put('search', $request->has('search') ? $request->get('search') : ($request->session()->has('search') ? session('search') : ''));
        $request->session()->put('gender', $request->has('gender') ? $request->get('gender') : ($request->session()->has('gender') ? session('gender') : -1));
        $request->session()->put('field', $request->has('field') ? $request->get('field') : ($request->session()->has('field') ? $request->session()->get('field') : 'order_p'));
        $request->session()->put('sort', $request->has('sort') ? $request->get('sort') : ($request->session()->has('sort') ? $request->session()->get('sort') : 'asc'));
        $students = new Student();
        if (session('gender') != -1)
            $students = $students->where('gender', session('gender'));
        $students = $students->where('name', 'like', '%' . session('search') . '%')
	        ->orderBy($request->session()->get('field'), $request->session()->get('sort'))
            ->paginate(10);
        if ($request->ajax())
            return view('student/index', compact('students'));
        else
            return view('student/ajax', compact('students'));
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
		    $ret = Student::insert($data);

	        if($ret){
	        	return redirect('student')->with('success', 'Now a student is ADDED!')->withInput();
	        }else{
	        	return redirect('student/create')->with('error', 'Failed to add the student info.')->withInput();
	        }

    	}

	    return view('student/create');
	}

	public function update(Request $request, $id)
	{
		$student_info = Student::findOrFail($id);

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
				return redirect('student')->with('success', 'Student info is UPDATED!')->withInput();
			}else{
				return redirect('student/update')->with('error', 'Failed to update student info.')->withInput();
			}
		}
	    return view('student/update', ['student_info' => $student_info]);
	}


	public function show($id){

		$students = Student::findOrFail($id);

		return view('student/show', ['students' => $students]);
	}


	public function delete($id)
	{
	    $student = Student::findOrFail($id);

	    if($student->delete())
	    {
	        return redirect('student')->with('success', 'Delete-'.$id. ' SUCCESS');
	    } else {
	        return redirect()->back()->with('error', 'DETELE-'.$id.' FAILED');
	    }
	}

	public function orderUpdate(Request $request)
	{
	    $students = Student::all();

	    $request->session()->put('field', $request->has('field') ? $request->get('field') : ($request->session()->has('field') ? session('field') : 'order_p'));

	    foreach ($students as $student) {
	        $student->timestamps = false;
	        $id = $student->id;

	        foreach ($request->order as $order) {
	            if ($order['id'] == $id) {
	                $student->update(['order_p' => $order['position']]);
	            }
	        }
	    }
	    
	    return response($request);
	}

}
