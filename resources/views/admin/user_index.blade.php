@extends("layouts.admin.master")
@section("content")
    <div class="right-warp">
        <div class="panel panel-default">
            <div class="panel-body">
                @include("parts.admin.user_head")
                <br/>
                <form class="form-inline" role="form" action="/admin/member">
                    <div class="form-group ">
                        <input type="text" class="form-control " id="name" name="name" placeholder="请输入名称">
                    </div>
                    <button type="submit" class="btn btn-default">搜索</button>
                </form>
            </div>
        </div>
        @include("parts.admin.user_add_modal")
        <table class="table table-striped container">
            <thead>
            <tr>
                <th><input type="checkbox"/></th>
                <th>名称</th>
                <th>邮箱</th>
                <th>注册时间</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach( $users as $user)
                <tr>
                    <th>
                        <input type="checkbox"/>
                    </th>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email }}</td>
                    <td>{{$user->created_at}}</td>
                    <td><a href="/admin/user/edit/{{$user->id}}">修改</a> |
                        <a href="/admin/user/delete/{{$user->id}}">删除</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="page_bottom">
            <?php echo $users->render(); ?>
        </div>

    </div>
@stop



