<style type="text/css">
    .letter {
    }

    .panel {
        width: 70%;
        min-height: 80em;
        margin: 0 auto;
    }

    .panel-body {
        padding: 15px 0;
    }

    .list-group .delete {
        float: right;
        display: none;
        margin-right: 1em;
    }

    .list-group .date {
        float: right;
        margin-right: 1em;
    }

    .list-group-item:hover > .delete {
        display: inline-block;
    }

    .delete:hover {
        color: red;
        cursor: pointer;
    }

    @if($type=="letter")
        .letter-item-content {
        max-width: 80%;
        padding-left: 1.5em;
        display: inline-block;
        max-height: 3em;
        overflow: hidden;
    }

    .letter-item-content-point {
        font-weight: 800;
        padding: 0 5px;
    }

    .list-group-item-success {
        margin-bottom: 5px;
    }

    .letter-item-from {
        font-weight: 600;
        padding-right: 1em;
    }

    .list-group-item:hover > p .delete {
        display: inline-block;
    }
    @endif
</style>
<script type="text/javascript">
    $(document).ready(function () {
        var deleteId, item;
        $(".delete").click(function () {
            deleteId = $(this).attr("data-id");
            item = $(this).parents('.list-group-item');
            $.ajax({
                url: '/my/{{$type}}/delete/' + deleteId,
                type: 'get',
                success: function () {
                    item.hide();
                    @if($type=="letter")
                        console.log(111);

                    @endif
                }
            });
            event.preventDefault();
        });
    });
</script>
