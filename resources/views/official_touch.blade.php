@extends('layouts.app')
@section('content')
    <div class="touch">
        <h3>联系方式</h3>
        <p>新浪微博 : EOPARK</p>
        <p>微信公众号 : EOPARK</p>
        <p>邮箱 : eopark@126.com</p>
        <div class="row center">
            <div class="col-sm-6 col-md-2">
                <a href="#" class="thumbnail">
                    <img src="/img/official/qrcode_wx.jpg"
                         alt="EOPARK微信二维码">
                </a>
                <div class="caption">
                    <p>微信公众号</p>
                </div>
            </div>
            <div class="col-sm-6 col-md-2">
                <a href="#" class="thumbnail">
                    <img src="/img/official/qrcode_weibo.png"
                         alt="EOPARK新浪微博二维码">
                </a>
                <div class="caption">
                    <p>新浪微博</p>
                </div>
            </div>
        </div>
    </div>
    <style type="text/css">
        .touch {
            width: 70%;
            margin: auto;
            padding: 4em;
            background: whitesmoke;
        }

        .touch > h3 {
            margin-bottom: 1em;
        }

        .touch > .row {
            margin-top: 2em;

        }
    </style>
@stop
