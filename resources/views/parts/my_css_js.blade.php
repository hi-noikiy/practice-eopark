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
        visibility: hidden;
        margin-right: 1em;
    }

    .list-group .date {
        float: right;
        margin-right: 1em;
    }

    .list-group-item:hover > .delete {
        /*display: inline-block;*/
        visibility: visible;
    }

    .delete:hover {
        color: red;
        cursor: pointer;
    }

    .letter-left {
        width: 15%;
        position: absolute;
        left: 0;
        top: 120px;
        padding: 0 10px;
    }

    @if(isset($type) && $type=="letter")
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
        /*display: inline-block;*/
    }

    .list-group-item:hover > p .delete {
        visibility: visible;
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
                }
            });
            event.preventDefault();
        });
    });
</script>
