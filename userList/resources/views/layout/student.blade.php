<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User List</title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="/css/app.css">
    <script src="js/app.css"></script>
</head>
<body>

<!-- header -->
<div class="jumbotron">
    <div class="container">
        <h2>User List</h2>

        <p> - Laravel Form</p>
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
<div class="jumbotron" style="margin:0;">
    <div class="container">
        <span>  @2018</span>
    </div>
</div>
<!-- jQuery 文件 -->
<script src="./static/jquery/jquery.min.js"></script>
<!-- Bootstrap JavaScript 文件 -->
<script src="./static/bootstrap/js/bootstrap.min.js"></script>

@section('javascript')

@show
</body>
</html>