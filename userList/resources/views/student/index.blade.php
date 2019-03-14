<?php
use App\Models\Student;
$student = new Student();
?>

@extends('layout/student')

@section('content')

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
<div>
   <div class="pull-right">
    {{ $students->links() }}
</div>
</div>
@endsection