<?php
use App\Student;
$students = new Student();
?>
@component('mail::message')
#New Student: {{ $student->name }}

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
           <th>{{ $student->id }}</th>
           <td>{{ $student->name }}</td>
           <td>{{ $student->age }}</td>
           <td>{{ $student->gender($student->gender) }}</td>
           <td>{{ $student->created_at }}</td>
           <td>{{ $student->updated_at }}</td>
       </tr>
    </tbody>
</table>

@component('mail::button', ['url' => url('/student/' . $student->id)])

View Student

@endcomponent

Thanks,<br>

{{ config('app.name') }}

@endcomponent
