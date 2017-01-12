@extends('layouts.app')
@section("content")
    <div class="collect">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <div class="btn-group">
                        <button type="button" class="btn btn-default">我的资料</button>
                        <button type="button" class="btn btn-primary">我的收藏</button>
                        {{--<button type="button" class="btn btn-default">按钮 3</button>--}}
                    </div>
                </h3>
            </div>
            <div class="panel-body">
                <ul class="list-group">
                    @foreach($collects as $collect)
                        <li class="list-group-item"><a
                                    href="/detile/{{ $collect->resource_id }}">{{$collect->title}}</a> <span
                                    class="date">{{$collect->created_at}}</span>
                            <span
                                    title="删除收藏" class="delete glyphicon glyphicon-trash"
                                    data-id="{{$collect->id}}"> </span></a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <style type="text/css">
        .collect {
            min-height: 40em;
            padding: 0 15%;
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

        .list-group .delete:hover {
            color: red;
            cursor: pointer;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function () {
            var deleteId, item;
            $(".delete").click(function () {
                deleteId = $(this).attr("data-id");
                item = $(this).parents('.list-group-item');

                $.ajax({
                    url: '/my/collect/delete/' + deleteId,
                    type: 'get',
                    success: function () {
                        item.hide();
                    }
                })

            });
        });
    </script>
@stop
