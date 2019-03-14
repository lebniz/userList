<?php
use App\models\Student;
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
            <th>Create Time</th>
            <th>Update Time</th>
        </thead>
        <tbody>
           <tr>
               <th scope="row">{{ $students->id }}</th>
               <td>{{ $students->name }}</td>
               <td>{{ $students->age }}</td>
               <td>{{ $student->gender($students->gender) }}</td>
               <td>{{ date('Y-m-d', $students->created_time) }}</td>
               <td>{{ date('Y-m-d', $students->updated_time) }}</td>
           </tr>
        </tbody>
    </table>
</div>
@endsection