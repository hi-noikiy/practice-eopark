<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title',Config::get("set.siteName") .' '. Config::get("set.sitePath")  )</title>
    <link rel="stylesheet" href="/css/lib/bootstrap.min.css">
    <script src="http://cdn.bootcss.com/jquery/3.1.1/jquery.min.js"></script>
    <script src="http://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<body>
@section('top')
    @include('include.top')
@show
@section("content")
@show
@section("footer")
    @include('include.footer')
@show
</body>
</html>