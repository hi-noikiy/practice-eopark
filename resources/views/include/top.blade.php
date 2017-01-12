<div class="top">
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
    <nav class="navbar navbar-default" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="/">
                    <img src="{{ Config::get("set.siteLogo") }}" class="nev-logo" style="float: left"/>
                    <strong>{{ Config::get("set.siteEnglishName") }}</strong>
                </a>
            </div>
            <div>
                <ul class="nav navbar-nav">
                    <li class="{{ session('index_active') }}"><a href="/">首页</a></li>
                    <li class="{{  session('category_active') }}"><a href="/category">分类</a></li>
                    <li class="{{   session('thanksgiving_active') }}"><a href="/thanksgiving">Thanks/Giving</a></li>
                </ul>
            </div>
            <div>
                <div class="navbar-form navbar-left" role="search">
                    <div class="form-group">
                        <input type="text" class="form-control" id="input-baidu">
                        <button class="btn btn-primary" id="btn-baidu">百度一下</button>
                    </div>
                </div>

            </div>
            <div class="navbar-right">
                <ul class="nav navbar-nav">
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">登录</a></li>
                        <li><a href="{{ url('/register') }}">注册</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>退出登录</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    @if(session('index_active') != "active")
        <script src="/js/common/helper.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                new helper().baiduSearch();
            });
        </script>
    @endif
    @include("include.common.operation_message")
</div>
