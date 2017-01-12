@extends("layouts.admin.brand")
@section("warp")
    <form class="form-horizontal" role="form" style="padding: 2em 20%" action="{{ url()->current() }}/save"
          enctype="multipart/form-data" method="post">
        <input type="hidden" name="_token" class="_token" value="{{csrf_token()}}">
        <input type="hidden" name="id" value="{{ $brand->id }}">
        <div class="form-group">
            <label for="firstname" class="col-sm-2 control-label">品牌名称</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="brand_name" value="{{$brand->brand_name}}"/>
            </div>
        </div>
        <div class="form-group">
            <label for="firstname" class="col-sm-2 control-label">官网地址</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="official_url" value="{{$brand->official_url}}"/>
            </div>
        </div>
        <div class="form-group">
            <label for="lastname" class="col-sm-2 control-label">优先级</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="priority" value="{{$brand->priority}}">
            </div>
        </div>
        <div class="form-group">
            <label for="firstname" class="col-sm-2 control-label">品牌LOGO</label>
            <div class="col-sm-8">
                <input type="file" name="brand_logo">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">(或)网络图片地址</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="brand_logo_url" value="{{ $brand->brand_logo }}">
            </div>
        </div>
        @include("include.common.switch",["status"=>$brand->status])
        @include("include.admin.parts.form_submit_btn")
    </form>
@stop