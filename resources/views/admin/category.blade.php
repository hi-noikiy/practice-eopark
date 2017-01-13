@extends("layouts.admin.category")
@section("warp")
    <div class="category">
        <table class="table table-striped container">
            <thead>
            <tr>
                <th><input type="checkbox"/></th>
                <th>分类名</th>
                <th>排序</th>
                <th>状态</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($categories as $category1)
                @include("parts.admin.category_tr",[
                "id"=>$category1["id"],
                "parent_id"=>$category1["parent_id"],
                "name"=>$category1["name"],
                "priority"=>$category1["priority"],
                "status"=>$category1["status"],
                "hasNext"=>count($category1["next"]),
                'depthTr'=>"depth1-tr"
                ])
                @if(count($category1["next"]))
                    @foreach($category1["next"] as $category2)
                        @include("parts.admin.category_tr",[
                        "id"=>$category2["id"],
                        "parent_id"=>$category2["parent_id"],
                        "name"=>$category2["name"],
                        "priority"=>$category2["priority"],
                        "status"=>$category2["status"],
                        "hasNext"=>count($category2["next"]),
                        "depth"=>"depth2-name",
                        'depthTr'=>"depth2-tr"
                        ])
                        @if(count($category2["next"]))
                            @foreach($category2["next"] as $category3)
                                @include("parts.admin.category_tr",[
                                "id"=>$category3["id"],
                                "parent_id"=>$category3["parent_id"],
                                "name"=>$category3["name"],
                                "priority"=>$category3["priority"],
                                "status"=>$category3["status"],
                                "depth"=>"depth3-name",
                                'depthTr'=>"depth3-tr"
                                ])
                            @endforeach
                        @endif
                    @endforeach
                @endif
            @endforeach
            </tbody>
        </table>
    </div>

    <style type="text/css">
        .category .depth2-name {
            padding-left: 3em;
        }

        .category .depth3-name {
            padding-left: 6em;
        }
        .depth2-tr, .depth3-tr {
            display: none;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function () {
            new helper().ladder();
        });
    </script>
@stop