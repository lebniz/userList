<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title','User List')</title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="/css/app.css">
    <script src="/js/app.js"></script>
    <style>
        .is-completed{
            text-decoration: line-through;
        }
    </style>
</head>
<body>

<!-- header -->
<div class="jumbotron">
    <div class="container">
        <h2>{{ __('message.user_list') }}</h2>

        <p> - @yield('subtitle',__('message.list_info') )</p>
    </div>
</div>
@show
<!-- container -->
<div class="container">
    <div class="row">

        <!-- left side column -->
         @include('shared/sidebar')
        <!-- right side column -->
        <div class="col-md-9">
        @include('shared/success')
        @yield('content')   
        </div>
    </div>
</div>

@section('footer')
<!-- footer -->
<div class="jumbotron" style="margin-top:3em;">
    <div class="container">
        <span>  @2018</span>
    </div>
</div>

@section('javascript')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script> 
@show
    <script src="/js/ajax-crud.js"></script>

</body>
</html>