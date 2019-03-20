<?php
use App\models\Student;
$student = new Student();
?>
@extends('layout/student')
@section('title','Add New User')
@section('content')
    <!-- 所有的错误提示 -->
    @include('shared/message')
    <!-- 自定义内容区域 -->
    <div class="panel panel-default">
        <div class="panel-heading">@section('subtitle','Add New Student')</div>
        <div class="panel-body">
            <form class="form-horizontal" method="post" action="{{ url('student/create') }}">
                {{ csrf_field() }} 
                <!-- --產生token -->
                <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">Name</label>

                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="Student[name]" value="{{ old('Student')['name'] }}" id="name" placeholder="Fill the student name">
                    </div>
                    <div class="col-sm-5">
                        <p class="form-control-static text-danger">{{ $errors->first('Student.name') }}</p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="age" class="col-sm-2 control-label">Age</label>

                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="Student[age]" value="{{ old('Student')['age'] }}" id="age" placeholder="Fill the student age">
                    </div>
                    <div class="col-sm-5">
                        <p class="form-control-static text-danger">{{ $errors->first('Student.age') }}</p>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Gender</label>

                    <div class="col-sm-5">
                       @foreach($student->gender() as $ind => $gender)
                        <label class="radio-inline">
                            <input type="radio"
                            name="Student[gender]" {{ (isset(old('Student')['gender']) && old('Student')['gender'] == $ind) ? 'checked' : '' }}
                            value="{{ $ind }}"> {{ $gender }}
                        </label>
                        @endforeach
                    </div>
                    <div class="col-sm-5">
                        <p class="form-control-static text-danger">{{ $errors->first('Student.gender') }}</p>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection