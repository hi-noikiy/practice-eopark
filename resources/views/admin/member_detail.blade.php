@extends("layouts.admin.master")
@section("content")
    <div class="panel panel-default">
        <div class="panel-body">
            <ul class="nav nav-pills">
                <li class="active"><a href="/admin/member">所有</a></li>
                <li class="" data-toggle="modal" data-target="#myModal"><a>添加</a></li>
            </ul>
            <br/>
            <div class="modal-body">
                <form class="form-horizontal" role="form" method="get" action="/admin/member/editSave/{{$members->id}}">
                    <div class="form-group">
                        <label for="firstname" class="col-sm-2 control-label">昵称</label>
                        <div class="col-sm-10">
                            <input type="hidden" name="id" value="{{$members->id}}}"/>
                            <input type="text" class="form-control" name="name" value="{{$members->name}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="firstname" class="col-sm-2 control-label">邮箱</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="email" value="{{$members->email}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary">编辑</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop



