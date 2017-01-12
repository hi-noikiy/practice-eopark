@extends('layouts.base')
@section('content')
    <script language="JavaScript" src="{{ URL::asset('/') }}js/resources.js"></script>
    <div class="resource">
        <div class="resource-header">
            <ol class="breadcrumb">
                @foreach($chains as  $key =>$chain)
                    @if($key == count($chains)-1)
                        <li><a class="active" style="font-weight: 600; ">{{ $chain->name }}</a></li>
                    @else
                        <li><a href="/resources/{{$chain->id}}">{{ $chain->name }}</a></li>
                    @endif
                @endforeach
            </ol>
            <div class="row brand">
                <div class="col-xs-6 col-md-2 brand-item">
                    <a href="#" class="thumbnail">
                        <img  src="http://img.bss.csdn.net/201611301702407025.jpg"  alt="...">
                    </a>
                </div>
                <div class="col-xs-6 col-md-2 brand-item">
                    <a href="#" class="thumbnail">
                        <img  src="http://img.bss.csdn.net/201611301702407025.jpg"  alt="...">
                    </a>
                </div>
                <div class="col-xs-6 col-md-2 brand-item">
                    <a href="#" class="thumbnail">
                        <img  src="http://img.bss.csdn.net/201611301702407025.jpg"  alt="...">
                    </a>
                </div>
                <div class="col-xs-6 col-md-2 brand-item">
                    <a href="#" class="thumbnail">
                        <img  src="http://img.bss.csdn.net/201611301702407025.jpg"  alt="...">
                    </a>
                </div>
            </div>
            <ul id="tabHeader" class="nav nav-tabs">
                <li class="active" data-type="0" data-page="1" data-has-more="{{$hasMore}}">
                    <a href="#all" data-toggle="tab">所有</a>
                </li>
                <li data-type="1" data-page="1" data-has-more="0"><a href="#video" data-toggle="tab">视频</a></li>
                <li data-type="2" data-page="1" data-has-more="0"><a href="#text" data-toggle="tab">图文</a></li>
                <li data-type="3" data-page="1" data-has-more="0"><a href="#download" data-toggle="tab">下载</a></li>
            </ul>
        </div>
        <div class="resource-content">
            <div class="left-warp">
                <div id="myTabContent" class="tab-content">
                    <div class="tab-pane fade in active" id="all">
                        <ul class="list-group" data-type="0">
                            @if($coverData)
                                <li class="list-group-item">
                                    @foreach($coverData as $key1=>$cover1)
                                        @if($key1 < 4)
                                            <div class="list-video">
                                                <a href="/detail/{{$cover1->id}}">
                                                    <img class="cover" src="{{$cover1->cover}}"
                                                         onerror="this.src='{{config("path.img_error")}}'">
                                                    <h5>{{$cover1->title}}<span
                                                                class="list-grade">{{$cover1->score ?$cover1->score:'/' }}</span>
                                                    </h5>
                                                </a>
                                            </div>
                                        @else
                                            @break
                                        @endif
                                    @endforeach
                                </li>
                            @endif
                            @if(count($coverData) > 4)
                                <li class="list-group-item">
                                    @foreach($coverData as $key2=>$cover2)
                                        @if($key2 > 3)
                                            <div class="list-video">
                                                <a href="/detail/{{$cover2->id}}">
                                                    <img class="cover" src="{{$cover2->cover}}"
                                                         onerror="this.src='{{config("path.img_error")}}'">
                                                    <h5>{{$cover2->title}}<span
                                                                class="list-grade">{{$cover2->score ?$cover2->score:'/' }}</span>
                                                    </h5>
                                                </a>
                                            </div>
                                        @endif
                                    @endforeach
                                </li>
                            @endif
                            <li class="list-group-item ">
                                <ul class="list-group list-text">
                                    @foreach($emptyCoverData as $key1=>$emptyCover1)
                                        @if($key1<5)
                                            <li class="list-group-item li-text">
                                                <a href="/detail/{{$emptyCover1->id}}">
                                                    <h5>
                                                        {{$emptyCover1->title}}
                                                        <span class="list-grade">{{$emptyCover1->score ? $emptyCover1->score : "/"}}</span>
                                                    </h5>
                                                </a>
                                            </li>
                                        @else
                                            @break
                                        @endif
                                    @endforeach
                                </ul>
                                <ul class="list-group list-text">
                                    @foreach($emptyCoverData as $key2=>$emptyCover2)
                                        @if($key2>4)
                                            <li class="list-group-item li-text">
                                                <a href="/detail/{{$emptyCover2->id}}">
                                                    <h5>
                                                        {{$emptyCover2->title}}
                                                        <span class="list-grade">{{$emptyCover2->score ? $emptyCover2->score : "/"}}</span>
                                                    </h5>
                                                </a>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-pane fade" id="video">
                        <ul class="list-group" data-type="1">
                        </ul>
                    </div>
                    <div class="tab-pane fade" id="text">
                        <ul class="list-group" data-type="2">
                        </ul>
                    </div>
                    <div class="tab-pane fade" id="download">
                        <ul class="list-group" data-type="3">
                        </ul>
                    </div>
                </div>
                @if($hasMore)
                    <div id="more">
                        <button type="button" class="btn btn-default  btn-block">显示更多</button>
                    </div>
                @else
                    <div id="more" style="display: none;">
                        <button type="button" class="btn btn-default  btn-block">显示更多</button>
                    </div>
                @endif
            </div>
            {{--<div class="right-warp">--}}
            {{--right--}}
            {{--</div>--}}
        </div>
    </div>
    <style>
        .resource {
            padding: 0 15% 4em 15%;
        }

        .resource-header h3 {
            padding: 1em 0;
        }

        .resource-content {
            /*background: darkcyan;*/
            overflow: hidden;
            padding: 1em 0;
        }

        .left-warp {
            /*width: 70%;*/
            float: left;
            background-color: #f9f9f9;
        }

        .right-warp {
            width: 30%;
            /*background: saddlebrown;*/
            float: left;
        }

        .list-group-item {
            overflow: hidden;
            border: none;
            background: none;
        }

        .list-video {
            width: 20%;
            text-align: center;
            /*background: lavender;*/
            float: left;
        }

        .list-video h5 {
            padding: 0 4px;
        }

        .list-video .cover {
            width: 100%;
            max-width: 8em;
            height: 11em;
            border-radius: 1em;
        }

        .list-grade {
            color: orange;
            margin-left: 1em;
        }

        .list-text {
            float: left;
            width: 50%;
            padding: 0 1em;
        }

        .li-text {
            border: none;
            /*padding: 6px 6px;*/
        }

        .li-text h5 {
            font-weight: 600;
        }
        /*.brand{*/
            /*width: 70%;*/
        /*}*/
        .brand-item{
            padding: 0;
        }
    </style>
@stop