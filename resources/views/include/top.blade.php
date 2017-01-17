<div class="top">
    <nav class="navbar navbar-default" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="/">
                    {{--<img src="{{ Config::get("set.siteLogo") }}" class="nev-logo" style="float: left"/>--}}
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
                                @if( session('unreadLetterNum'))
                                    <span class="badge">{{session('unreadLetterNum')}}</span>
                                @endif
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/my/letter') }}"><i class="glyphicon glyphicon-envelope"> </i>
                                        我的信件
                                        @if( session('unreadLetterNum') && session('unreadLetterNum') !=0)
                                            <span class="badge">{{session('unreadLetterNum')}}</span>
                                        @endif
                                    </a></li>
                                <li><a href="{{ url('/my/collect') }}"><i class="glyphicon glyphicon-folder-open"> </i>
                                        我的收藏</a></li>
                                <li><a href="{{ url('/logout') }}" style="color: red;"><i
                                                class="glyphicon glyphicon-log-out"> </i> 退出登录</a></li>
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
    @include("parts.common.operation_message")
</div>
