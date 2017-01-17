<div class="list-group letter-left">
    <a href="/my/letter/unread"
       class="list-group-item {{$leftSelected=="unread" ? "active":""}}">未读
        @if(isset($newNumber ) && $newNumber)
            <span class="badge">{{$newNumber}}人</span>
        @endif
    </a>
    <a href="/my/letter/all" class="list-group-item {{$leftSelected=="all" ? "active":""}}">全部</a>
</div>