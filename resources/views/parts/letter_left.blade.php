<div class="list-group letter-left">
    <a href="/my/letter/new"
       class="list-group-item {{$leftSelected=="NEW" ? "active":""}}">未读
        @if(isset($newNumber ) && $newNumber)
            <span class="badge">{{$newNumber}}人</span>
        @endif
    </a>
    <a href="/my/letter/all" class="list-group-item {{$leftSelected=="ALL" ? "active":""}}">全部</a>
</div>