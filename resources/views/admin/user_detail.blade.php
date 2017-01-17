@extends("layouts.admin.master")
@section("content")
    <div class="panel panel-default">
        <div class="panel-body">
            @include("parts.admin.user_head")
            <br/>
            <div class="modal-body">
                <form class="form-horizontal" role="form" method="get" action="{{url()->current()}}/save">
                    <div class="form-group">
                        <label for="firstname" class="col-sm-2 control-label">昵称</label>
                        <div class="col-sm-10">
                            <input type="hidden" name="id" value="{{$user->id}}}"/>
                            <input type="text" class="form-control" name="name" value="{{$user->name}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="firstname" class="col-sm-2 control-label">邮箱</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="email" value="{{$user->email}}">
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



