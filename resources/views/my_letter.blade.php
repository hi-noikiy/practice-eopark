@extends('layouts.app')
@section("content")
    <div class="letter">
        <div class="list-group letter-left">
            <a href="#" class="list-group-item ">
                未读
                <span class="badge">12</span>
            </a>
            <a href="#" class="list-group-item active">全部</a>
        </div>
        <div class="panel panel-default">
            @include("parts.my_header",["selected"=>"letter"])
            <div class="panel-body ">
                <div class="list-group">
                    <a class="list-group-item list-group-item-success" href="#1"><span class="letter-item-from">Qskane</span>
                        <p>
                            <span class="letter-item-content">信件内容信信件内容信件内内容信件内</span>
                        <span class="date">2017-01-02</span>
                        <span title="删除" class="delete glyphicon glyphicon-trash"
                              data-id="123424" > </span>
                        </p>
                        <p>
                            <span class="letter-item-content">信件内容信信件内容信件内内容信件内</span>
                        <span class="date">2017-01-02</span>
                        <span title="删除" class="delete glyphicon glyphicon-trash"
                              data-id="123424" > </span>
                        </p>
                        <p>
                            <span class="letter-item-content">hover事件</span>
                        <span class="date">2017-01-02</span>
                        <span title="删除" class="delete glyphicon glyphicon-trash"
                              data-id="123424" > </span>
                        </p>
                    </a>
                    <a class="list-group-item list-group-item-success" href="#1" ><span class="letter-item-from">Qskane</span>
                        <p><span class="letter-item-content">信件内容信件内容信内容信件内容信件内容信件内</span>
                        <span class="date">2017-01-02</span>
                        <span title="删除" class="delete glyphicon glyphicon-trash"
                              data-id="123424" > </span></p>
                    </a>
                </div>
            </div>
        </div>
    </div>
    @include("parts.my_css_js",["type"=>"letter"])

@stop
