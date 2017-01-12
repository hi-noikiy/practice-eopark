<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>eopark - @yield('title')</title>
    <link rel="stylesheet" href="/css/lib/bootstrap.min.css">
    <link rel="stylesheet" href="/css/lib/font-awesome.min.css">
    <link rel="stylesheet" href="/css/admin/master.css"/>
    <link rel="stylesheet" href="/css/lib/awesome-bootstrap-checkbox.css"/>
    <script src="//cdn.bootcss.com/jquery/3.1.1/jquery.min.js"></script>
    <script src="//cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script language="JavaScript" src="{{ URL::asset('/') }}js/admin/helper.js"></script>
</head>
<body>
@section('top')
    @include('include.admin.top')
@show
@section("content")
@show
@section("footer")
    @include('include.admin.footer')
@show
</body>
</html>