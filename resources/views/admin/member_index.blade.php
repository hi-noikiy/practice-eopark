@extends("layouts.admin.master")
@section("content")
    @include("include.admin.resource_left")
    <div class="right-warp">
        <div class="panel panel-default">
            <div class="panel-body">
                <ul class="nav nav-pills">
                    <li class="active"><a href="#">所有</a></li>
                    <li class="" data-toggle="modal" data-target="#myModal"><a>添加</a></li>
                </ul>
                <br/>
                <form class="form-inline" role="form" action="/admin/member">
                    <div class="form-group ">
                        {{--<label class="sr-only" for="name">名称</label>--}}
                        <input type="text" class="form-control " id="name" name="name" placeholder="请输入名称">
                    </div>

                    <button type="submit" class="btn btn-default">搜索</button>
                </form>
            </div>
        </div>

        <!-- 模态框（Modal） -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">添加用户</h4>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" role="form" method="get" action="/admin/member/add">
                            <div class="form-group">
                                <label for="firstname" class="col-sm-2 control-label">昵称</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="firstname" class="col-sm-2 control-label">邮箱</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="email">
                                </div>
                            </div>
                            {{--                        @include('include.common.category',['categories' => $categories,'label'=>'上级分类'])--}}
                            <div class="form-group">
                                <label for="firstname" class="col-sm-2 control-label">密码</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="password">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-primary">提交</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal -->
        </div>

        <table class="table table-striped container">
            {{--<caption>条纹表格布局</caption>--}}
            <thead>
            <tr>
                <th><input type="checkbox"/></th>
                <th>name</th>
                <th>email</th>
                <th>注册时间</th>
                <th>上次登录时间</th>
                <th>operation</th>
            </tr>
            </thead>

            <tbody>
            @foreach( $members as $member)
                <tr>
                    <th>
                        <input type="checkbox"/>
                    </th>
                    <td>{{$member->name}}</td>
                    <td>{{$member->email }}</td>
                    <td>{{$member->created_at}}</td>
                    <td>
                        {{$member->updated_at}}
                    </td>
                    <td><a href="/admin/member/edit/{{$member->id}}">修改</a> |
                        <a href="/admin/member/delete/{{$member->id}}">删除</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="page_bottom">
            <?php echo $members->render(); ?>
        </div>
    </div>
    <style type="text/css">
        table th, table td {
            text-align: center;
        }

        .form-group {
            margin: 0;
        }

        td > img {
            max-height: 2.5em;
        }

        .page_bottom {
            text-align: center;
        }

        .status {
            font-weight: 600;
        }
    </style>
    <script type="text/javascript">
        /*
         $(function(){
         $('.btn-primary').click(function(){
         $('input[name="name"]').val();
         $('input[name="email"]').val();
         $('input[name="password"]').val();
         })
         })*/

    </script>
@stop



