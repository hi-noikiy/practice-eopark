@extends('layouts.app')
@section("content")
    <div class="collect">
        <div class="panel panel-default">
            @include("parts.my_header",["selected"=>"collect"])
            <div class="panel-body">
                <div class="list-group">
                    @foreach($collects as $collect)
                        <a class="list-group-item" href="/detail/{{ $collect->resource_id }}">{{ $collect->title}}
                            <span class="date">{{$collect->created_at}}</span>
                            <span title="删除" class="delete glyphicon glyphicon-trash"
                                  data-id="{{$collect->id}}"> </span>
                        </a>
                    @endforeach
                </div>
            </div>
            @include("parts.common.page_number",["data"=>$collects])
        </div>
    </div>
    @include("parts.my_css_js",['type'=>'collect'])
@stop
