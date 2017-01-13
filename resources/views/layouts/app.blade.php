<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title',Config::get("set.siteName") .' '. Config::get("set.sitePath")  )</title>
    <link rel="stylesheet" href="/css/lib/bootstrap.min.css">
    <script src="http://cdn.bootcss.com/jquery/3.1.1/jquery.min.js"></script>
    <script src="http://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style type="text/css">
        body, p, hr, ul, h3 {
            margin: 0;
            padding: 0;
        }

        a:link, a:visited, a:active, a {
            text-decoration: none;
        }

        a:hover {
            color: #2a6496;
        }

        body {
            min-width: 1000px;
            position: relative;
        }

        ul {
            list-style-type: none;
        }

        .panel {
            border: none;
            box-shadow: none;
            padding: 0;
        }

        .panel-default {
            border: none;
        }

        .center {
            text-align: center;
        }

        .top {
            width: 100%;
        }

        .container-fluid {
            padding-left: 10%;
            padding-right: 1em;
        }

        .navbar-right {
            margin-right: 10%;
        }

        .navbar-nav a {
            font-weight: 800;
            color: black;
        }

        .headImg {
            width: 50px;
            height: 50px;
            vertical-align: middle;
            padding: 5px;
        }

        .nev-logo {
            padding: 0;
            margin: 0;
            height: 32px;
            width: 32px;
            margin-top: -6px;
            margin-right: 8px;
        }

        .navbar-default {
            margin: 0;
        }

        #input-baidu {
            border-bottom-right-radius: 0;
            border-top-right-radius: 0;
        }

        #btn-baidu {
            background-color: rgb(184, 188, 191);
            border-color: rgb(184, 188, 191);
            margin-left: -4px;
            border-bottom-left-radius: 0;
            border-top-left-radius: 0;
        }

        #btn-baidu:hover {
            background-color: #3385ff;
            border-color: #3385ff;
        }

        .footer {
            position: relative;
            margin-top: 4em;
            padding-left: 20%;
            padding-right: 20%;
            height: 2em;
        }

        #footer-end {
            width: 100%;
            position: absolute;
            bottom: -1.2em;
            left: 0;
            z-index: -1;
        }

        .copyright {
            width: 100%;
            height: 100%;
            text-align: center;
        }

        #feedback-textarea {
            resize: none
        }

        .status-container {
            width: 20em;
            text-align: center;
            z-index: 999;
            position: fixed;
            top: 50px;
            left: 40%;
        }
        .top-message {
            width: 20%;
            margin-left: 40%;
            position: absolute;
            text-align: center;
            display: none;
        }
    </style>
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