@extends('layouts.app')
@section("content")
    <div class="letter">
        @include("parts.letter_left",[
            'leftSelected'=>"unread",
            'newNumber'=>count($letters)
        ])
        <div class="panel panel-default">
            @include("parts.my_header",["selected"=>"letter"])
            <div class="panel-body ">
                <div class="list-group">
                    @foreach($letters as $letter)
                        <a class="list-group-item list-group-item-success"
                           href="/my/letter/reading/{{$letter['from_user_id']}}"><span
                                    class="letter-item-from">{{$letter['from_user_name']}}</span>
                            @foreach($letter['content'] as $content)
                                <p>
                                    <span class="letter-item-content"><span
                                                class="letter-item-content-point">-</span> {{$content['content']}}</span>
                                    <span title="删除" class="delete glyphicon glyphicon-trash"
                                          data-id="{{$content['id']}}"> </span>
                                    <span class="date">{{ dateAdapter($content['created_at'])}}</span>
                                </p>
                            @endforeach
                            @if($letter['number'] > 5 )
                                <p class="center"><strong>共{{$letter['number']}}条</strong></p>
                            @endif
                        </a>
                    @endforeach
                </div>
            </div>
            @if(count($letters) == 0)
                <h3 class="center">无内容</h3>
            @endif
        </div>
    </div>
    @include("parts.my_css_js",["type"=>"letter"])
@stop
