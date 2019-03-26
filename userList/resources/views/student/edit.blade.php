<?php
use App\Student;
$students = new Student();
?>
@extends('layout/student')

@section('content')
    <!-- Error block -->
    @include('shared/message')
    <!-- customized content -->
    <div class="panel panel-default">
        <div class="panel-heading">{{ __('message.edit')}}</div>
        <div class="panel-body">
            <form class="form-horizontal" method="post" action="{{ route('student.update', ['id' => $student->id]) }}">
                {{ method_field('PATCH') }}
                @csrf
                <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">{{ __('message.name')}}</label>

                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="name" value="{{ old('Student')['name'] ? old('Student')['name'] : $student->name }}" id="name" placeholder="Fill the student name">
                    </div>
                    <div class="col-sm-5">
                        <p class="form-control-static text-danger">{{ $errors->first('Student.name') }}</p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="age" class="col-sm-2 control-label">{{ __('message.age')}}</label>

                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="age" value="{{ old('Student')['age'] ? old('Student')['age'] : $student->age }}" id="age" placeholder="Fill the student age">
                    </div>
                    <div class="col-sm-5">
                        <p class="form-control-static text-danger">{{ $errors->first('Student.age') }}</p>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">{{ __('message.gender')}}</label>

                    <div class="col-sm-5">
                       @foreach($students->gender() as $ind => $gender)
                        <label class="radio-inline">
                            <input type="radio"
                            name="gender"  {{ ((isset(old('Student')['gender']) && old('Student')['gender'] == $ind) || $student->gender == $ind) ? 'checked' : '' }} value="{{ $ind }}"> {{ $gender }}
                        </label>
                        @endforeach
                    </div>
                    <div class="col-sm-5">
                        <p class="form-control-static text-danger">{{ $errors->first('Student.gender') }}</p>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary">{{ __('message.submit')}}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection