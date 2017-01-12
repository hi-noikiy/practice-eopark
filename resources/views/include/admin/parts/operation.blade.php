<td>

    @if(isset($operation["delete"]))
        <a href="/admin/brand/delete/{{$operation->id}}"
           class="btn-delete"
           onclick="return confirm({{isset($operation["delete_notice"]) ?$operation["delete_notice"] : "确认删除吗?" }})">删除</a>
        <a href="{{ $operation["href"] }}">{{$operation['name']}}</a> |
    @endif
</td>