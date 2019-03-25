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
               <td>{{ $students->created_at }}</td>
               <td>{{ $students->updated_at }}</td>
           </tr>
        </tbody>
    </table>
    <div class="row">
      <div class="col-6">
        @if($students->tasks->count()) 
        <span>TASK List</span>
        <div>
          @foreach($students->tasks as $task)
            <div> 
              <form method="POST" action="/tasks/{{$task->id}}">
                @method('PATCH')
                @csrf
                <label for="completed" class="checkbox {{ $task->completed? 'is-completed': ''}} ">
                  <input type="checkbox" name="completed" onChange="this.form.submit();" {{ $task->completed? 'checked': ''}}>
                  {{ $task->description }}
                </label>
              </form>
            </div>
          @endforeach
        </div>
        @endif
      </div>
    </div>
    <div class="row">
      <div class="col-6">
        {{-- add a new task form --}}
          @include('shared/message')
          <form class="form-inline" method="POST" action="/student/show/{{ $students->id }}/tasks">
            @csrf
            <div class="input-group mb-3">
              <input type="text" class="form-control" placeholder="New Task" aria-label="New Task" aria-describedby="basic-addon2" name="description">
              <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit">Add Task</button>
              </div>
            </div>
          </form>
      </div>
    </div>
</div>
@endsection