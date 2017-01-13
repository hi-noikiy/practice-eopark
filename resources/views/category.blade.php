@extends('layouts.app')
@section("content")
    <link rel="stylesheet" href="/css/category.css">

    <div class="panel panel-body category">
        <div class="sub-container">
            <div class="subclass subclass-one" data-depth="1">
                <ul>
                    @foreach( $categories as $categoryOne)
                        <li id="{{ $categoryOne['id']}}">{{$categoryOne['name'] }}</li>
                    @endforeach
                </ul>
            </div>
            <div class="subclass subclass-two" data-depth="2">
                @foreach( $categories as $categoryOne)
                    @if( isset($categoryOne['next']))
                        <ul data-pid="{{$categoryOne['id']}}">
                            @if(count($categoryOne['next']))
                                @foreach( $categoryOne['next'] as $categoryTwo)
                                    <li id="{{ $categoryTwo['id'] }}">{{ $categoryTwo['name'] }}</li>
                                @endforeach
                            @else
                                <p>该类目暂无分类</p>
                            @endif
                        </ul>
                    @endif
                @endforeach
            </div>
            <div class="subclass subclass-three" data-depth="3">
                @foreach( $categories as $categoryOne)
                    @if( isset($categoryOne['next']))
                        @foreach( $categoryOne['next'] as $categoryTwo)
                            @if( isset($categoryTwo['next']))
                                <ul data-pid="{{$categoryTwo['id']}}">
                                    @if(count($categoryTwo['next']))
                                        @foreach( $categoryTwo['next'] as $categoryThree)
                                            <li id="{{ $categoryThree['id'] }}">{{ $categoryThree['name'] }}</li>
                                        @endforeach
                                    @else
                                        <p>该类目暂无分类</p>
                                    @endif
                                </ul>
                            @endif
                        @endforeach
                    @endif
                @endforeach
            </div>
        </div>


        <div class="panel panel-body category-content">
            <div class="category-video category-content-class">
                <h3>视频</h3>
                <ul class="video-container">
                    @foreach( $resources_hot[1]  as $video)
                        <li>
                            <a href="/detail/{{ $video->id }}">
                                <img src="{{ $video->cover }}" onerror="this.src='/img/onError.jpg'">
                                <div class="video-introduce">
                                    <h4>{{$video->title}}</h4>
                                    <p class="video-introduce-text">{{$video->introduce}}</p>
                                    <p><i class="glyphicon glyphicon-eye-open">{{$video->views}}</i><i
                                                class="glyphicon glyphicon-star other">{{(int)$video->score ? $video->score : "\\"}}</i><i
                                                class="glyphicon glyphicon-comment other">{{$video->comment_numbers}}</i><i
                                                class="glyphicon glyphicon-time other">{{ substr($video->updated_at,0,10)}}</i>
                                    </p>
                                </div>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="category-text category-content-class">
                <h3>图文</h3>
                <ul class="text-container">
                    @foreach($resources_hot[2] as $text)
                        <li>
                            <a href="/detail/{{ $text->id }}">
                                <h4>{{ $text->title }}</h4>
                                <p class="video-introduce-text">{{$video->introduce}}</p>
                                <p><i class="glyphicon glyphicon-eye-open">{{$text->views}}</i>
                                    <i class="glyphicon glyphicon-star other">{{(int)$text->score ? $text->score : "\\"}}</i>
                                    <i class="glyphicon glyphicon-comment other">{{$text->comment_numbers}}</i>
                                    <i class="glyphicon glyphicon-time other">{{ substr($text->updated_at,0,10)}}</i>
                                </p></a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="category-download category-content-class">
                <h3>下载</h3>
                <ul class="download-container category-download-introuduce">
                    @foreach( $resources_hot[3] as $download )
                        <li>
                            <a href="/detail/{{ $download->id }}">
                                <h4><span><img src="{{ $download->cover }}"
                                               onerror="this.src='/img/onError.jpg'"></span>{{ $download->title }}</h4>

                                <p><i class="glyphicon glyphicon-eye-open">{{ $download->views }}</i>
                                    <i class="glyphicon glyphicon-star other">{{ (int)$download->score ? $video->score : "\\" }}</i>
                                    <i class="glyphicon glyphicon-comment other">{{$download->comment_numbers}}</i>
                                    <i class="glyphicon glyphicon-time other">{{ substr($download->updated_at,0,10)}}</i>
                                </p>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <script src="/js/category.js"></script>
@stop

