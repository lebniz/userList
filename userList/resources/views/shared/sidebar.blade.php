<div class="col-md-3">
    <div class="list-group">
		<a href="{{ url('student') }}" class="list-group-item {{ Request::path() == '/' ? 'active' : '' }}">Student List</a>
        <a href="{{ url('student/create') }}" class="list-group-item {{ Request::path() == 'student/create' ? 'active' : '' }}">Add New Student</a>
    </div>
</div>