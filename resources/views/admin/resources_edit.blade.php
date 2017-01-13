@extends("layouts.admin.master")
@section("content")
    @include("parts.admin.resource_left")
    <div class="right-warp">
        @include("parts.admin.resource_header",["edit"=>true])
        <div class="panel panel-default edit-body">
            <div class="panel-body">
                <form enctype="multipart/form-data" class="form-horizontal" role="form"
                      action="/admin/resource/edit-save/{{ $resource->id }}" method="get">
                    <div class="form-group">
                        <label for="firstname" class="col-sm-2 control-label">标题</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="title" value="{{ $resource->title or '' }}"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="lastname" class="col-sm-2 control-label">链接</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="link" value="{{ $resource->link or '' }}">
                        </div>
                    </div>
                    @include('parts.common.category',
                        ['categories' => $categories,
                        'thisCategory'=>[
                                ["id"=>$resource->category_1],
                                ["id"=>$resource->category_2],
                                ["id"=>$resource->category_3],
                        ]])


                    @include("parts.admin.brand_select",[
                        "brandRelations"=>$brandRelations,
                        "brand_id"=>$resource->brand_id
                    ])

                    <div class="form-group">
                        <label for="lastname" class="col-sm-2 control-label">收录</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="created_at"
                                   value="{{ $resource->created_at or '' }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="lastname" class="col-sm-2 control-label">贡献者</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="contributor"
                                   value="{{ $resource->contributor or '' }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="firstname" class="col-sm-2 control-label">介绍</label>
                        <div class="col-sm-10">
                        <textarea name="introduce" class="form-control"
                                  rows="3">{{ $resource->introduce or '' }}</textarea>
                        </div>
                    </div>
                    @include('parts.common.resource_type',['type'=>$resource->type])
                    @include('parts.common.switch', ['status' => $resource->status])
                    @include('parts.common.switch', ["label"=>"付费",'status' =>  $resource->is_pay,"open"=>"是","close"=>"否","name"=>"is_pay"])
                    <div class="form-group">
                        <label for="firstname" class="col-sm-2 control-label">上传封面</label>
                        <div class="col-sm-8">
                            <input type="file" id="cover" name="cover">
                        </div>
                        <div class="col-sm-2">
                            <img src="{{ $resource->cover }}" style="max-height: 2.5em;"
                                 onerror="this.src='{{config("path.img_error")}}'"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">封面地址</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="cover_url" value="{{$resource->cover}}">
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <a data-toggle="collapse" data-parent="#accordion"
                               href="#collapseOne">
                                <button class="btn btn-block " id="btn-assign-prop">分配属性</button>
                            </a>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse">
                            <div class="panel-body">
                                @include("parts.admin.property_table",[
                                    "properties"=>$properties,
                                    'ownProperty'=>$ownProperty
                                ])
                            </div>
                        </div>
                    </div>

                    @include("parts.admin.form_submit_btn")
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function () {
            new helper().isShowProperties(false);
        });
    </script>
@stop