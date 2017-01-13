@extends("layouts.admin.brand")
@section("warp")
    <form method="post" class="form-horizontal" role="form" style="width: 50%;margin:2em 20%"
          action="/admin/brand/add/save" enctype="multipart/form-data">
        <input type="hidden" name="_token" class="_token" value="{{csrf_token()}}">
        <div class="form-group">
            <label for="firstname" class="col-sm-2 control-label">品牌名称</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="brand_name"/>
            </div>
        </div>
        <div class="form-group">
            <label for="lastname" class="col-sm-2 control-label">官网地址</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="official_url">
            </div>
        </div>
        <div class="form-group">
            <label for="lastname" class="col-sm-2 control-label">优先级</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="priority">
                <span class="help-block">默认优先级为:最低</span>
            </div>
        </div>
        @include("parts.common.switch",["status"=>1])
        <div class="form-group">
            <label for="firstname" class="col-sm-2 control-label">品牌LOGO</label>
            <div class="col-sm-8">
                <input type="file" name="brand_logo">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">(或)网络图片地址</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="brand_logo_url">
            </div>
        </div>
        @include("parts.admin.form_submit_btn")
    </form>
@stop