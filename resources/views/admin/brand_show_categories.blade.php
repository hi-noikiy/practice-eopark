@extends("layouts.admin.brand")
@section('warp')
    <div class="panel-body">
        <a class="btn btn-default" href="/admin/brand/addCateRelation/{{$id}}">添加所属关系</a>
    </div>
    <table class="table table-striped container" style="width: 40%">
        <thead>
        <tr>
            {{--<th><input type="checkbox"/></th>--}}
            {{--<th>brand_cate_id</th>--}}
            <th>所属分类名</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($brandCategories as $brandCategory)
            <tr>
                {{--<td>{{$brandCategory->id}}</td>--}}
                <td>{{$brandCategory->category_name}}</td>
                <td><a class="btn btn-default btn-sm" href="/admin/brand/editCategory/{{$brandCategory->id}}">编辑</a> | <a class="btn btn-danger btn-sm"
                            href="/admin/brand/deleteCateRelation/{{$brandCategory->id}}">删除</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
@stop