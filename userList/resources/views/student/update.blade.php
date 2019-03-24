<?php
use App\Student;
$student = new Student();
?>
@extends('layout/student')

@section('content')
    <!-- 所有的错误提示 -->
    @include('shared/message')
    <!-- 自定义内容区域 -->
    <div class="panel panel-default">
        <div class="panel-heading">{{ __('message.edit')}}</div>
        <div class="panel-body">
            <form class="form-horizontal" method="post" action="">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">{{ __('message.name')}}</label>

                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="Student[name]" value="{{ old('Student')['name'] ? old('Student')['name'] : $student_info->name }}" id="name" placeholder="Fill the student name">
                    </div>
                    <div class="col-sm-5">
                        <p class="form-control-static text-danger">{{ $errors->first('Student.name') }}</p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="age" class="col-sm-2 control-label">{{ __('message.age')}}</label>

                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="Student[age]" value="{{ old('Student')['age'] ? old('Student')['age'] : $student_info->age }}" id="age" placeholder="Fill the student age">
                    </div>
                    <div class="col-sm-5">
                        <p class="form-control-static text-danger">{{ $errors->first('Student.age') }}</p>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">{{ __('message.gender')}}</label>

                    <div class="col-sm-5">
                       @foreach($student->gender() as $ind => $gender)
                        <label class="radio-inline">
                            <input type="radio"
                            name="Student[gender]"  {{ ((isset(old('Student')['gender']) && old('Student')['gender'] == $ind) || $student_info->gender == $ind) ? 'checked' : '' }} value="{{ $ind }}"> {{ $gender }}
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