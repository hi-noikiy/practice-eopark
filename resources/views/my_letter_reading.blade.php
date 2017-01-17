@extends('layouts.app')
@section("content")
    <div>
        @include("parts.letter_left",['leftSelected'=>"NEW"])
        <div class="panel panel-default">
            @include("parts.my_header",["selected"=>"letter"])
            <div class="panel-body content">
                <ul class="list-group">
                    @foreach($letters as $letter)
                        @if($letter['isShowDate'])
                            <li class="list-group-item  item-time">
                                {{ dateAdapter($letter['created_at']) }}
                            </li>
                        @endif
                        @if($letter['from_user_id'] == $from_user_id)
                            <li class="list-group-item ">
                                <div class="item-head head-left">
                                    {{--<img class="head-img img-circle" src="/img/resource/20161218171218_53.jpg">--}}
                                    <p class="text-center">{{ $letter['from_name'] }}</p>
                                </div>
                                <p class="item-content item-left">
                                    {{ $letter['content'] }}
                                </p>
                            </li>
                        @else
                            <li class="list-group-item">
                                <div class="item-head head-right">
                                    {{--<img class="head-img img-circle my-head" src="/img/resource/20161218171218_53.jpg">--}}
                                    <p class="text-center my-name">{{ $letter['from_name'] }}</p>
                                </div>
                                <p class=" item-content item-right">
                                    {{ $letter['content'] }}
                                </p>
                            </li>
                        @endif
                    @endforeach
                </ul>
                <div class="reply">
                    <form id="reply-form">
                        {!! csrf_field() !!}
                        <textarea id="reply-content" name="content"></textarea>
                    </form>
                    <button class="btn btn-success" id="reply-btn" data-to-id="{{$from_user_id}}">发送</button>
                </div>
            </div>
        </div>
        <textarea id="hidden-user-data">{{$userData}}</textarea>
        @include('parts.my_css_js',['type'=>'letter'])
    </div>
    <style type="text/css">
        .panel {
            width: 70%;
            margin: 0 auto;
            min-height: 40em;
        }

        .content {
            min-height: 20em;
            margin: 0;
            padding: 4px 0 0 0;
        }

        .list-group {
            overflow: hidden;
            margin-bottom: 0;
        }

        .content .list-group-item {
            overflow: hidden;
            background-color: rgba(234, 234, 234, 0.64);
            border: none;
        }

        .item-content {
            padding: 1em;
            border-radius: 1em;
        }

        .item-left {
            max-width: 75%;
            width: auto;
            background: rgb(249, 240, 169);
            float: left;
        }

        .item-right {
            max-width: 75%;
            width: auto;
            float: right;
            background: #c9e1ff;
        }

        .item-time {
            text-align: center;
            color: #757575;
        }

        /*head*/
        .item-head {
            padding: 5px;
            min-width: 3em;
            text-align: center;
        }

        .head-left {
            float: left;
        }

        .head-right {
            float: right;
        }

        .head-img {
            width: 1.6em;
            height: 1.6em;
        }

        /*reply*/
        .reply {
            height: 8em;
        }

        .reply form {
            height: 100%;
            width: 92%;
            float: left;
        }

        .reply textarea {
            width: 100%;
            padding: 5px 1em;
            border-right: none;
            height: 100%;
        }

        .reply button {
            height: 100%;
            width: 8%;
            float: right;
            border: none;
            max-width: 8em;
        }

        #hidden-user-data {
            display: none;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function () {
            var replyContent = $("#reply-content");
            var replyBtn = $("#reply-btn");
            var replyForm = $("#reply-form");
            var listGroup = $(".content .list-group");
            var my = JSON.parse($("#hidden-user-data").val());
            var toId = replyBtn.attr("data-to-id");
            var content;
            document.onkeydown = function () {
                if (window.event && window.event.keyCode == 13 && $("#reply-content").is(":focus")) {
                    send();
                }
            };
            replyBtn.click(function () {
                send();
            });
            function send() {
                content = replyContent.val().trim();
                if (content != "") {
                    $.ajax({
                        url: "/my/letter/send/" + toId,
                        type: "post",
                        data: replyForm.serialize(),
                        success: function () {
                            listGroup.append('<li class="list-group-item">' +
                                    '<div class="item-head head-right">' +
                                    '<img class="head-img img-circle" src="/img/resource/20161218171218_53.jpg">' +
                                    '<p class="text-center">' + my.name + '</p></div>' +
                                    '<p class="item-content item-right">' + content + '</p></li>');
                            replyContent.val("");
                        }
                    });
                }
            }
        });
    </script>
@stop
