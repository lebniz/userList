<div class="col-md-3">
    <div class="list-group">
    	<ul>
    		<li><a href="{{ url('en') }}" ><i class="fa fa-language"></i> EN</a></li>
    		<li><a href="{{ url('cn') }}" ><i class="fa fa-language"></i> CN</a></li>
    	</ul>
		<a href="{{ url('student') }}" class="list-group-item {{ Request::path() == '/' ? 'active' : '' }}">{{ __('message.user_list') }}</a>
        <a href="{{ url('student/create') }}" class="list-group-item {{ Request::path() == 'student/create' ? 'active' : '' }}">{{ __('message.add_new_user') }}</a>
    </div>
</div>