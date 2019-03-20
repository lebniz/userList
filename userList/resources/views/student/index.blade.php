<?php
use App\Models\Student;
$student = new Student();
?>

    <div class="row">
        <div class="col-sm-4 form-group">
            {!! Form::select('gender',['-1'=>'Select Gender','1'=>'Male','0'=>'Female','2'=>'Unknown'],request()->session()->get('gender'),['class'=>'form-control','onChange'=>'ajaxLoad("'.url("student").'?gender="+this.value)']) !!}
        </div>
        <div class="col-sm-5 form-group">
            <div class="input-group">
                <input class="form-control" id="search"
                       value="{{ request()->session()->get('search') }}"
                       onChange = "ajaxLoad('{{url('/student')}}?search='+this.value)"
                       placeholder="Search name" name="search"
                       type="text" id="search"/>
                <div class="input-group-btn">
                    <button type="submit" class="btn btn-warning"
                            onclick="ajaxLoad('{{url('/student')}}?search='+$('#search').val())">
                        Search
                    </button>
                </div>
            </div>
        </div>
    </div>
<!-- customer area -->
<div class="panel panel-default">
    <div class="panel-heading">Student</div>
    <table class="table table-striped table-hover table-responsive">
        <thead>
            <th>ID</th>
            <th>Name</th>
            <th>Age</th>
            <th>Gender</th>
            <th>Time</th>
            <th>operation</th>
        </thead>
        <tbody>
           @foreach($students as $student)
           <tr>
               <th scope="row">{{ $student->id }}</th>
               <td>{{ $student->name }}</td>
               <td>{{ $student->age }}</td>
               <td>{{ $student->gender($student->gender) }}</td>
               <td>{{ date('Y-m-d', $student->created_time) }}</td>
               <td>
                   <a href="{{ url('student/detail', ['id' => $student->id]) }}">view</a> | 
                   <a href="{{ url('student/update', ['id' => $student->id]) }}">edit</a> | 
                   <a onclick="if(confirm('DELETE {{ $student->name }} from student list') == false) return false;" href="{{ url('student/delete', ['id' => $student->id]) }}">delete</a>
               </td>
           </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- pagination  -->
    <nav>
        <ul class="pagination justify-content-end">
            {{$students->links()}}
        </ul>
    </nav>

</div>