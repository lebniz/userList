<?php
use App\Student;
$student = new Student();
?>
@extends('layout/student')

@section('content')

<!-- customer area -->
<div class="panel panel-default">
    <div class="panel-heading">Student</div>
    <table class="table table-striped table-hover table-responsive">
        <thead>
            <th>{{ __('message.id') }}</th>
            <th>{{ __('message.name') }}</th>
            <th>{{ __('message.age') }}</th>
            <th>{{ __('message.gender') }}</th>
            <th>{{ __('message.created_time') }}</th>
            <th>{{ __('message.updated_time') }}</th>
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
    @if($students->tasks->count())
    <span>TASK List</span>
    <ul>
      @foreach($students->tasks as $task)
        <li>{{ $task->description }}</li>
      @endforeach
    </ul>
    @endif
</div>
@endsection