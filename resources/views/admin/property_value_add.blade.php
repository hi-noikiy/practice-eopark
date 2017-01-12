@extends("layouts.admin.property")
@section("warp")
    <form class="form-horizontal" role="form" style="padding: 2em 20%" action="{{ url()->current() }}/save">
        <input type="hidden" name="prop_id" value="{{ $propId }}">
        <div class="form-group">
            <label for="firstname" class="col-sm-2 control-label">属性名</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="name"/>
            </div>
        </div>
        <div class="form-group">
            <label for="lastname" class="col-sm-2 control-label">优先级</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="priority" value="">
            </div>
        </div>
        @include("include.common.switch",["status"=>1])
        @include("include.admin.parts.form_submit_btn")
    </form>
@stop