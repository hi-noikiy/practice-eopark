@extends("layouts.admin.master")
@section("content")
    @include("include.admin.resource_left")
    <script type="text/javascript" src="{{ URL::asset('/js/admin/category.js') }}"></script>
    <div class="right-warp ">
        <div class=" right-head-warp">
            <ul class="nav nav-pills" role="tablist">
                <li role="presentation" data-toggle="modal" data-target="#myModal"><a href="#">添加</a></li>
                <li role="presentation"><a href="#" id="update">更新缓存</a></li>
                <p id="status-notice" style="display: none"></p>
            </ul>
        </div>
        <div class="right-warp-content">
        <input type="hidden" name="_token" class="_token" value="{{csrf_token()}}">
        <ul class="depth-1">
            @foreach( $categories as $categoryOne)
                <li data-id="{{ $categoryOne['id']}}">
                    <p>
                        <span class="category-name">{{ $categoryOne['name']}}</span>
                        <span><input class="name-input" type="text"/></span>
                        <span class="operation">
                            <input class="add-input" type="text" placeholder="同级类目"/>
                            <input class="add-child-input" type="text" placeholder="下级类目"/>
                            <i class="fa fa-plus-square fa-2x"></i>
                            <i class="fa fa-plus-square-o fa-2x"></i>
                            <i class="fa fa-arrow-circle-o-up fa-2x"></i>
                            <i class="fa fa-arrow-circle-o-down fa-2x"></i>
                            <i class="fa fa-times-circle-o fa-2x "></i>
                        </span>
                    </p>
                    @if( isset($categoryOne["next"]))
                        <ul class="depth-2">
                            @foreach( $categoryOne["next"] as $categoryTwo)
                                <li data-id="{{ $categoryTwo['id']}}">
                                    <p>
                                        <span class="category-name">{{ $categoryTwo['name']}}</span>
                                        <span><input class="name-input" type="text"/></span>
                                        <span class="operation">
                                            <input class="add-input" type="text" placeholder="同级类目"/>
                                            <input class="add-child-input" type="text" placeholder="下级类目"/>
                                            <i class="fa fa-plus-square fa-2x"></i>
                                            <i class="fa fa-plus-square-o fa-2x"></i>
                                            <i class="fa fa-arrow-circle-o-up fa-2x"></i>
                                            <i class="fa fa-arrow-circle-o-down fa-2x"></i>
                                            <i class="fa fa-times-circle-o fa-2x "></i>
                                    </span>
                                    </p>
                                    @if(isset($categoryTwo['next']))
                                        <ul class="depth-3">
                                            @foreach($categoryTwo['next'] as $categoryThree)
                                                <li data-id="{{ $categoryThree['id']}}">
                                                    <p>
                                                        <span class="category-name">{{ $categoryThree['name']}}</span>
                                                        <span><input class="name-input" type="text"/></span>
                                                        <span class="operation">
                                                    <i class="fa fa-arrow-circle-o-up fa-2x"></i>
                                                    <i class="fa fa-arrow-circle-o-down fa-2x"></i>
                                                    <i class="fa fa-times-circle-o fa-2x "></i>
                                                 </span>
                                                    </p>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>

    <!-- 模态框（Modal） -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">添加分类</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form" method="get" action="/admin/category/add">
                        <div class="form-group">
                            <label for="firstname" class="col-sm-2 control-label">分类名</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="category_name">
                            </div>
                        </div>

                        @include('include.common.category',['categories' => $categories,'label'=>'上级分类'])

                        <div class="form-group">
                            <label for="firstname" class="col-sm-2 control-label">排序</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="priority">
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
    </div>

    {{---------------css----------}}
    <style type="text/css">
        .right-warp-content {
            width: 60%;
            margin-left: 10%;
            /*margin-left: 20%;*/
        }

        .category li {
            min-height: 3em;
        }

        p {
            min-height: 2em;
        }

        .operation {
            float: right;
        }

        .operation .add-input, .operation .add-child-input {
            display: none;
        }

        .fa-times-circle-o {
            color: red;
        }

        .depth-1, .depth-2, .depth-3 {
            width: 100%;
            list-style: none;
        }

        .depth-1 > li {
            background: darkgray;
            margin: 12px 0;
        }

        .depth-2 > li {
            background: lightgray;
            margin: 8px 0;
        }

        .depth-3 > li {
            background: whitesmoke;
            margin: 4px 0;
        }

        .name-input {
            display: none;
        }

        .copy {
            visibility: hidden;
        }
    </style>

@stop
