@extends("layouts.admin.master")
@section("content")
    @include("parts.admin.resource_left")

    <div class="right-warp">
        @include("parts.admin.resource_header",['all'=>true])
        {{--<div class="panel panel-default">--}}
        {{--<div class="panel-body">--}}
        {{--<form class="form-inline" role="form">--}}
        {{--<div class="form-group ">--}}
        {{--<label class="sr-only" for="name">名称</label>--}}
        {{--<input type="text" class="form-control " id="name" placeholder="请输入名称">--}}
        {{--</div>--}}
        {{--<div class="form-group">--}}
        {{--<label class="sr-only" for="name">名称</label>--}}
        {{--<input type="text" class="form-control" id="name" placeholder="请输入名称">--}}
        {{--</div>--}}
        {{--<div class="form-group">--}}
        {{--<label class="sr-only" for="name">名称</label>--}}
        {{--<input type="text" class="form-control" id="name" placeholder="请输入名称">--}}
        {{--</div>--}}
        {{--<button type="submit" class="btn btn-default">搜索</button>--}}
        {{--</form>--}}
        {{--</div>--}}
        {{--</div>--}}


        <table class="table table-striped container">
            {{--<caption>条纹表格布局</caption>--}}
            <thead>
            <tr>
                <th><input type="checkbox"/></th>
                <th>id</th>
                <th>分类</th>
                <th>品牌</th>
                <th>标题</th>
                <th>封面</th>
                <th>类型</th>
                <th>分数</th>
                <th>贡献</th>
                <th>链接</th>
                <th>状态</th>
                <th>操作</th>
            </tr>
            </thead>

            <tbody>

            @foreach( $resources as $resource )
                <tr>
                    <th>
                        <input type="checkbox"/>
                    </th>
                    <td class="resource-id">{{ $resource->id }}</td>
                    @if($resource->category_3_name)
                        <td>{{ $resource->category_1_name .' / '.$resource->category_2_name .' / '. $resource->category_3_name }}</td>
                    @else
                        @if($resource->category_2_name)
                            <td>{{ $resource->category_1_name .' / '. $resource->category_2_name }}</td>
                        @else
                            <td>{{ $resource->category_1_name }}</td>
                        @endif
                    @endif
                    <td >{{ $resource->brand_name }}</td>
                    {{--@if(strlen($resource->title)> 21 )--}}
                    {{--<td class="title-text">{{ substr($resource->title,0,21) }}...</td>--}}
                    {{--@else--}}
                    {{--<td>{{substr($resource->title,0,21)}}</td>--}}
                    <td>{{$resource->title}}</td>
                    {{--@endif--}}
                    <td>
                        @if( $resource->cover )
                            <img src="{{ $resource->cover  }}" onerror="this.src='{{config("path.img_error")}}'">
                        @else
                            无
                        @endif
                    </td>
                    <td>{{ getResourceType($resource->type) }}</td>
                    <td>{{ $resource->score/10 }}</td>
                    <td>{{ $resource->contributor }}</td>
                    <td>
                        <div class="form-group" style="width: 20em;overflow: hidden;height: 1.2em; text-align: center">
                            <a href="{{ $resource->link }}" target="view_window">{{ $resource->link}}</a>
                        </div>
                    </td>
                    @if($resource->status)
                        <td class="status" style="color: green">开</td>
                    @else
                        <td class="status" style="color: red">关</td>
                    @endif
                    <td><a href="/admin/resource/edit/{{ $resource->id }}" target="view_resource_edit">编辑</a> |
                        <a href="/admin/resource/delete/{{ $resource->id }}" class="btn-delete"
                           onclick="return confirm('确认删除该资源?')">删除</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="page_bottom">
            <?php echo $resources->render(); ?>
        </div>
    </div>
    <style type="text/css">
        table th, table td {
            text-align: center;
        }

        .form-group {
            margin: 0;
        }

        td > img {
            max-height: 2.5em;
        }

        .page_bottom {
            text-align: center;
        }

        .status {
            font-weight: 600;
            cursor: pointer;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function () {
            var url = '/admin/resource/changeStatus/';
            var resourceId;
            $(".status").click(function () {
                var clickObj = $(this);
                var resourceId = $(this).parent().find(".resource-id").html().trim();
                $.ajax({
                    url: url + resourceId,
                    type: "get",
                    success: function (data) {
                        if (data) {
                            clickObj.css("color", "green");
                            clickObj.html('开');
                        } else {
                            clickObj.css("color", "red");
                            clickObj.html('关');
                        }
                    }
                })
            });
        });
    </script>
@stop

