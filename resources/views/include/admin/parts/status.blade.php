<td>
    @if(isset($status) && $status)
        <span class='status-open'>开启</span>
    @else
        <span class='status-close'>关闭</span>
    @endif
</td>
<style type="text/css">
    .status-open {
        color: darkgreen;
        font-weight: 600;
    }
    .status-close {
        color: red;
        font-weight: 600;
    }
</style>