@extends('layouts.app')
@section("content")
    <div class="index-warp">
        {{--<link rel="stylesheet" href="/css/gridstack.css"/>--}}
        <link rel="stylesheet" href="/css/index.css">

        <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
        {{--<div class="panel panel-default index-head">--}}
        <div class=" index-head">
            <div class="time-panel">
                <div class="time">
                    <div id="bg-have"></div>
                    <div id="bg-pass">
                        <div id="bg-pass-pass">
                        </div>
                    </div>
                    <div id="time-count">
                        <span id="day-left"></span>
                    </div>
                </div>
                <div class="motto">
                    我可以等你,但时间不会.
                </div>
                <div class="start">
                    <a href="/category"  class="btn btn-success  btn-lg btn-cricle">探索</a>
                </div>
            </div>
        </div>

        <div class="htmleaf-content bgcolor-3">
            <div class="container-nev">
                @if (Auth::guest())
                    <div id="grid-title-bar">
                        <p id="not-login-notice"><a href="/login" class="btn-link"><b>登录</b></a> / <a href="/register"
                                                                                                      class=" btn-link"><b>注册</b></a>
                            后可定制以下导航内容&nbsp;
                        </p>
                        <a href="/login">
                            <button class="btn btn-primary">添加</button>
                        </a>
                        <a href="/login">
                            <button class="btn btn-primary">修改</button>
                        </a>
                    </div>
                    <div id="grid-container" data-bind="component: {name: 'dashboard-grid', params: $data}"></div>
                @else
                    <div id="grid-title-bar">
                        <button data-bind="click:endMove" class="btn btn-success" id="endMoveBtn">保存</button>
                        <button class="btn btn-primary" data-bind="click:add_new_widget" data-toggle="modal"
                                data-target="#myModal">添加
                        </button>
                        <button data-bind="click:startMove" class="btn btn-primary" >修改</button>
                    </div>
                    <div id="grid-container" data-bind="component: {name: 'dashboard-grid', params: $data}"></div>
                @endif
            </div>

            <!-- 模态框（Modal）addModal -->
            <div class="modal fade " id="myModal" role="dialog" tabindex="-1" aria-labelledby="myModalLabel"
                 aria-hidden="true" data-keyboard="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="myModalLabel"></h4>
                        </div>
                        <div class="modal-body">
                            <form class="form-horizontal" role="form">
                                <input type="hidden" name="id" value="0" id="input-id"/>
                                <div class="form-group">
                                    <label for="firstname" class="col-sm-2 control-label">名称</label>
                                    <div class="col-sm-10" id="popover-name" title="提示"
                                         data-container="body" data-toggle="popover" data-placement="top"
                                         data-content="请控制在32个字符内">
                                        <input type="text" class="form-control" id="input-name" name="url_name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="lastname" class="col-sm-2 control-label">网址</label>
                                    <div class="col-sm-10" id="popover-url" title="提示"
                                         data-container="body" data-toggle="popover" data-placement="bottom"
                                         data-content="请输入有效网址">
                                        <input type="text" class="form-control" id="input-href" name="url">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                            <button type="button" id="modal-submit" class="btn btn-primary" data-bind="click:submit">提交更改
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if(isset($data))
            <textarea id="json-data" style="display: none;">{{ $data }}</textarea>
        @endif
    </div>

    <script src="http://cdn.bootcss.com/jquery-ui-bootstrap/0.5pre/assets/js/jquery-ui-1.10.0.custom.min.js"></script>
    <script src="http://cdn.bootcss.com/lodash.js/4.17.2/lodash.min.js"></script>
    <script src="http://cdn.bootcss.com/knockout/3.4.1/knockout-min.js"></script>
    <script src="http://cdn.bootcss.com/gridstack.js/0.2.6/gridstack.min.js"></script>
    <script language="JavaScript" src="{{ URL::asset('/') }}js/index.js"></script>

    <!--[if IE]><script src="http://libs.useso.com/js/html5shiv/3.7/html5shiv.min.js"></script><![endif]-->

@stop
