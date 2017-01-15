@extends('layouts.app')
@section("content")
    <div>
        @include("parts.letter_left")
        <div class="panel panel-default">
            @include("parts.my_header",["selected"=>"letter"])
            <div class="panel-body content">
                1232341234
            </div>
        </div>
    </div>
    <style type="text/css">
        .panel {
            width: 70%;
            min-height: 80em;
            margin: 0 auto;
        }

        .content {
            background: wheat;
            height: 20em;
            margin: auto;
            padding: 2em 10%;
        }
    </style>
@stop
