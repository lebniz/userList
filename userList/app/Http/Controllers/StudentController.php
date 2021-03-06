<?php

namespace App\Http\Controllers;

use App\Exports\StudentsExport;
use App\Http\Requests;
use App\Http\Requests\StudentStoreRequest;
use App\Student;
use Chumper\Zipper\Facades\Zipper;
use Excel;
use Illuminate\Console\makeDirectory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\isDir;
use ZipArchive;

class StudentController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

    public function index(Request $request)
    {	


        $request->session()->put('search', $request->has('search') ? $request->get('search') : ($request->session()->has('search') ? session('search') : ''));
        $request->session()->put('gender', $request->has('gender') ? $request->get('gender') : ($request->session()->has('gender') ? session('gender') : -1));
        $request->session()->put('field', $request->has('field') ? $request->get('field') : ($request->session()->has('field') ? $request->session()->get('field') : 'order_p'));
        $request->session()->put('sort', $request->has('sort') ? $request->get('sort') : ($request->session()->has('sort') ? $request->session()->get('sort') : 'asc'));

        $students = new Student();
		// $students = Student::where('owner_id', auth()->id()); //access own students only 
        if (session('gender') != -1)
            $students = $students->where('gender', session('gender'));
        $students = $students->where('name', 'like', '%' . session('search') . '%')
	        ->orderBy($request->session()->get('field'), $request->session()->get('sort'))
            ->paginate(5);
        if ($request->ajax())
            return view('student/index', compact('students'));
        else
            return view('student/ajax', compact('students'));
    }
	


	public function show($id){

		$students = Student::findOrFail($id);
		$students->name = collect($students->name)->uppercase()->first();
		// $this->authorize('update', $students);
		//abort_unless(auth()->user()->owns($students), 403); 

		// abort_if(\Gate::denies('update',$students),403);
		return view('student/show', ['students' => $students]);
	}



	public function export() 
    {
		
		$path=storage_path();
    	$invoice_file = Excel::store(new StudentsExport, 'test.xlsx','public');

		$public_dir  = Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix();

	   	$zipFileName = 'AllDocuments.zip';

	    $zip=new ZipArchive(); 
	    $zip->open( $path. '/' .$zipFileName, ZipArchive::CREATE);
	    $zip->addFile($public_dir. 'public/test.xlsx', basename('test.xlsx'));
		$r = $zip->close();
		
		unlink($public_dir. 'public/test.xlsx');

		return response()->download($path. '/' .$zipFileName)->deleteFileAfterSend(true);
    }


    public function create(Request $request)
	{    
	    return view('student/create');
	}

	public function store(StudentStoreRequest $request)
	{
		try{
			if (!$request->validated()) {
	        	return redirect('student/create')->with('error', 'Failed to add the student info.')->withInput();
			}else{
				$request->request->add(['owner_id' => auth()->id()]);
	       		Student::create($request->all()); 
	       		
	       		//You shouldn’t be firing the created if you’re not actually creating a model (save() can be used for both creating and updating a model).

	       		//event(new StudentCreated($student)); now fired in model

	       		return redirect('student')->with('success', 'Now a student is ADDED!')->withInput();
			}
		}
		catch(\Exception $e){
       		// do task when error
       		Log::error('There was an error creating student: '.$e);
   		}

	}

	public function edit(Request $request, $id)
	{
		$student = Student::findOrFail($id);
		$this->authorize('update', $student);
	    return view('student.edit', ['student' => $student]);
	}


	public function update(StudentStoreRequest $request, $id)
	{
		$student = Student::findOrFail($id);

		try{
			if (!$request->validated()) {
	        	return redirect('student/create')->with('error', 'Failed to add the student info.')->withInput();
			}else{
	       		$student->name = $request->name;
	       		$student->age = $request->age;
	       		$student->gender = $request->gender;
	       		$student->owner_id = auth()->id();
	       		$student->update(); // returns false
	       		
	       		return redirect('student')->with('success', 'Now a student is ADDED!')->withInput();
			}
		}
		catch(\Exception $e){
       		// do task when error
       		Log::error('There was an error updating student: '.$e);
   		}
	}

	public function destroy($id)
	{
	    $student = Student::findOrFail($id);
		$this->authorize('update', $student);
	   	try{
			$student->delete();
		}
		catch(\Exception $e){
       		// do task when error
       		Log::error('There was an error deleting student: '.$e);
       		//echo $e->getMessage();   // insert query
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
