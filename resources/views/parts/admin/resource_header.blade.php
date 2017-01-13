<div class="right-head-warp">
    <ul class="nav nav-pills" role="tablist">
        @if(isset($all))
            <li class="active"><a>所有</a></li>
            <li><a href="/admin/resource/updateCache">缓存数据</a></li>
        @else
            <li><a href="/admin/resource">所有</a></li>
        @endif
        @if(isset($add))
            <li class="active"><a>添加</a></li>
        @else
            <li><a href="/admin/resource/add">添加</a></li>
        @endif
        @if(isset($edit))
            <li class='active'><a>编辑</a></li>
        @endif
    </ul>
</div>
<style type="text/css">
    .edit-body {
        width: 60%;
        margin-left: 15%;
        margin-top: 2em;
    }
</style>
