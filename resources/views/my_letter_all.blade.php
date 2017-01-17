@extends('layouts.app')
@section("content")
    <div class="letter">
        @include("parts.letter_left",[
            'leftSelected'=>"all",
            'newNumber'=>$newNumber
        ])
        <div class="panel panel-default">
            @include("parts.my_header",["selected"=>"letter"])
            <div class="panel-body">
                <div class="list-group">
                    @foreach($letters as $letter)
                        <a class="list-group-item {{$letter->is_viewed ? '': 'list-group-item-success'}}"
                           href="/my/letter/reading/{{$letter->from_user_id}}/{{$letter->id}}">
                            <span class="letter-item-from">{{$letter->name}}</span>
                            <span class="letter-item-content">{{$letter->content}}</span>
                            <span title="删除" class="delete glyphicon glyphicon-trash"
                                  data-id="{{ $letter->id}}"> </span>
                            <span class="date">{{ dateAdapter($letter->created_at)}}</span>
                        </a>
                    @endforeach
                </div>
            </div>
            @include("parts.common.page_number",["data"=>$letters])
        </div>
    </div>
    @include('parts.my_css_js',["type"=>"letter"])
    <style type="text/css">
        .list-group-item {
            overflow: hidden;
        }

        .letter-item-from {
            float: left;
            height: 1.5em;
            width: 4em;
            overflow: hidden;
        }

        .letter-item-content {
            float: left;
            height: 1.5em;
            max-width: 65%;
        }
    </style>
@stop