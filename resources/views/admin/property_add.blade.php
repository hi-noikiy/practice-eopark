@extends("layouts.admin.property")
@section("warp")
    <form class="form-horizontal" role="form" action="{{ url()->current() }}/save">
        <div class="form-group">
            <label for="firstname" class="col-sm-2 control-label">名称</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="name"/>
            </div>
        </div>
        <div class="form-group">
            <label for="lastname" class="col-sm-2 control-label">优先级</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="priority">
            </div>
        </div>
        @include("include.common.switch",["status"=>true])
        @include("include.admin.parts.form_submit_btn")
    </form>
@stop