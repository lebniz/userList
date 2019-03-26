<div class="col-md-3">
    <div class="list-group">
		<a href="{{ route('student.index') }}" class="list-group-item {{ Request::path() == 'student' ? 'active' : '' }}">{{ __('message.user_list') }}</a>
        <a href="{{ route('student.create') }}" class="list-group-item {{ Request::path() == 'student/create' ? 'active' : '' }}">{{ __('message.add_new_user') }}</a>
    </div>
</div>