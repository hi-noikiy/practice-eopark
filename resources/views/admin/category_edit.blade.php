@extends("layouts.admin.category")
@section("add_modal")
@stop
@section("warp")
    <form class="form-horizontal" role="form" style="width: 50%;" action="/admin/category/editSave">
        @include("include.common.category",[
            "categories"=>getCategoryCache(),
            "thisCategory"=>$thisCategory,
            "label"=>"上级分类",
        ])

        <input type="hidden" name="id"  value="{{ $data->id }}">
        <div class="form-group">
            <label for="firstname" class="col-sm-2 control-label">名称</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="name" value="{{$data->name}}"/>
            </div>
        </div>
        <div class="form-group">
            <label for="lastname" class="col-sm-2 control-label">优先级</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="priority" value="{{$data->priority}}">
            </div>
        </div>
        @include("include.common.switch",["status"=>$data->status])
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">提交</button>
            </div>
        </div>
    </form>
@stop