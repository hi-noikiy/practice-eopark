@extends("layouts.admin.brand")
@section("warp")
    <table class="table table-striped container">
        <thead>
        <tr>
            <th><input type="checkbox"/></th>
            <th>品牌名</th>
            <th>官网</th>
            <th>LOGO</th>
            {{--<th>所属分类</th>--}}
            <th>排序</th>
            <th>状态</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($brands as $brand)
            <tr>
                <td><input type="checkbox"/></td>
                <td>{{$brand->brand_name}}</td>
                <td><a href="{{$brand->official_url}}" target="view">{{$brand->official_url}}</a></td>
                <td><img src="{{$brand->brand_logo}}" class="logo"></td>
{{--                <td>{{$brand->name ? $brand->name : ''}}</td>--}}
                <td>{{$brand->priority}}</td>
                @include("parts.admin.status",["status"=>$brand->status])
                <td><a href="/admin/brand/edit/{{$brand->id}}">编辑</a> | <a href="/admin/brand/showCategories/{{$brand->id}}">所属分类</a><a href="/admin/brand/delete/{{$brand->id}}"
                                                                           class="delete"
                                                                           onclick="return confirm('确认删除吗?')">删除</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="page_bottom">
        <?php echo $brands->render(); ?>
    </div>
    <style type="text/css">
        .logo {
            width: 6em;
            height: 3em;
        }

        .table {
            width: 80%;
        }

        .delete {
            margin-left: 4em;
            color: red;
        }
    </style>
@stop