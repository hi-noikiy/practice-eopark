<tr class="{{isset($depthTr) ? $depthTr : ""}}" data-pid="{{ isset($parent_id) ? $parent_id :0 }}">
    <td><input type="checkbox"/></td>
    <td class="{{isset($depth) ? $depth : ""}}">
        @if(isset($hasNext) && $hasNext)
            <span class="glyphicon glyphicon-chevron-up"
                  data-id="{{ isset($id)?$id : 0 }}"> </span>
        @endif
        {{isset($name) ? $name :"未命名"}}
    </td>
    <td>{{isset($priority) ?$priority : 0 }}</td>
    @include("parts.admin.status",['status'=>isset($status) ?$status: 0 ])
    <td><a href="/admin/category/edit/{{isset($id)?$id : 0}}">编辑</a> |
        <a href="/admin/category/add/{{isset($id)?$id : 0}}">新增下级</a> |
        <a href="/admin/property/assignCategory/{{isset($id)?$id : 0}}">分配属性</a> &nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="/admin/category/delete/{{isset($id)?$id : 0}}" style="color: red"
           onclick="return confirm('确认删除及其子类所有数据?')">删除</a>
    </td>
</tr>