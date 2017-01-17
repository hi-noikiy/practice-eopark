<div class="top">
    <nav class="navbar navbar-default" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="/admin">Admin</a>
            </div>
            <div>
                <ul class="nav navbar-nav" style="width: 90%;">
                    <li class="{{ session('resource_active') }}"><a href="/admin/resource">资源</a></li>
                    <li class="{{ session('user_active') }}"><a href="/admin/user">用户</a></li>
                    <li style="float: right"><a href="/admin/logout">退出</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="alert alert-success top-message" role="alert">123412341234123</div>
    <div class="alert alert-info top-message" role="alert">...</div>
    <div class="alert alert-warning top-message" role="alert">...</div>
    <div class="alert alert-danger top-message" role="alert">...</div>
    <input type="hidden" name="_token" class="_token" value="{{csrf_token()}}">
</div>
@include("parts.common.operation_message")