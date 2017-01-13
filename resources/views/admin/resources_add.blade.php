@extends("layouts.admin.master")
@section("content")
    @include("parts.admin.resource_left")
    <div class="right-warp">
        @include("parts.admin.resource_header",['add'=>true])
        <div class="panel panel-default edit-body">
            <div class="panel-body">
                <form enctype="multipart/form-data" action="/admin/resource/add-save" method="post"
                      class="form-horizontal"
                      role="form">
                    <input type="hidden" name="_token" class="_token" value="{{csrf_token()}}">
                    <div class="form-group title">
                        <label for="firstname" class="col-sm-2 control-label">标题</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="title" placeholder="必填"/>
                        </div>
                    </div>

                    @include('parts.common.category',
                        ['categories' => $categories,
                        'label'=>"所属分类"
                        ])

                    @include("parts.admin.brand_select",[
                        "brandRelations"=>$brandRelations,
                    ])
                    {{--<div class="form-group">--}}
                    {{--<label for="firstname" class="col-sm-2 control-label">tag</label>--}}
                    {{--<div class="col-sm-10">--}}
                    {{--<input type="text" class="form-control" name="tag">--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="form-group">--}}
                    {{--<label for="firstname" class="col-sm-2 control-label">from_domain</label>--}}
                    {{--<div class="col-sm-10">--}}
                    {{--<input type="text" class="form-control" name="from_domain">--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="form-group">--}}
                    {{--<label for="firstname" class="col-sm-2 control-label">from_domain_name</label>--}}
                    {{--<div class="col-sm-10">--}}
                    {{--<input type="text" class="form-control" name="from_domain_name">--}}
                    {{--</div>--}}
                    {{--</div>--}}

                    <div class="form-group link">
                        <label for="lastname" class="col-sm-2 control-label">link</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="link" placeholder="必填">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="lastname" class="col-sm-2 control-label">contributor</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="contributor" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="firstname" class="col-sm-2 control-label">introduce</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" rows="3" name="introduce"></textarea>
                        </div>
                    </div>

                    @include('parts.common.resource_type',['other'=>true])
                    @include('parts.common.switch', ['status' => false])
                    @include('parts.common.switch', ["label"=>"付费",'status' => false,"open"=>"是","close"=>"否","name"=>"is_pay"])

                    <div class="form-group">
                        <label for="firstname" class="col-sm-2 control-label">cover</label>
                        <div class="col-sm-8">
                            <input type="file" name="cover">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">网络地址封面</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="cover_url">
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
                                ])
                            </div>
                        </div>
                    </div>
                    <br/>
                    @include("parts.admin.form_submit_btn")

                </form>
            </div>
        </div>
    </div>
    <style type="text/css">
        .edit-body {
            width: 60%;
            margin-left: 20%;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function () {
            var inputTitle = $("input[name=title]");
            var inputLink = $("input[name=link]");
            $('form').submit(function () {
                var isValid = true;
                var title = inputTitle.val();
                var link = inputLink.val();
                if (title.trim() == '') {
                    $('.title').attr('class', "form-group title has-error");
                    isValid = false;
                }
                if (link.trim() == '') {
                    $('.link').attr('class', "form-group link has-error");
                    isValid = false;
                }
                if (isValid) {
                    return true;
                } else {
                    return false;
                }
            })
        })
    </script>

@stop