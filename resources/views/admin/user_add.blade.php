@extends("layouts.admin.master")
@section("content")
    <div class="panel panel-default" style="width:35%;padding:10px;">
        <div class="panel-body">
            @include("parts.admin.user_head")
            <br/>
            <form role="form" action="/admin/user/add" method="post">
                <div class="form-group ">
                    <label for = "name">昵称:</label>
                    <input type="text" class="form-control " id="name" placeholder="请输入昵称" >
                </div>
                <div class="form-group">
                    <label for = "name">邮箱:</label>
                    <input type="text" class="form-control" id="email" placeholder="请输入邮箱" >
                </div>
                <div class="form-group">
                    <label for = "name">密码:</label>
                    <input type="password" class="form-control" id="password" placeholder="请输入密码">
                </div>
                <button type="submit" class="btn btn-primary">添加</button>
            </form>
        </div>
    </div>
@stop



