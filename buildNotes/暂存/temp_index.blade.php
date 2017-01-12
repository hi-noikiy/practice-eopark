@extends('resources.views.layouts.base')
@section("content")
    <link rel="stylesheet" href="/css/index.css">
    <input type="hidden" name="_token" class="_token" value="{{csrf_token()}}">
    <div class="panel panel-default index-head">
        <div class="time-panel">
            <div class="time">
                <div id="bg-have"></div>
                <div id="bg-pass">
                    <div id="bg-pass-pass">
                    </div>
                </div>
                <div id="time-count">
                    {{--<span id="year"></span><span>年剩余:</span>--}}
                    {{--<span id="year-left"></span>--}}
                    {{--<span id="mouth-left"></span>--}}
                    <span id="day-left"></span>
                </div>
            </div>
            <div class="motto">
                我可以等你,但时间不会.
            </div>
            <div class="start">
                <a href="/category" >
                    <button type="button" class="btn btn-success  btn-lg btn-cricle">开始</button>
                </a>
            </div>
        </div>
    </div>
    <div class="panel panel-default user-nev">
        @if(!Auth::guest())
            @foreach ( $folders as $folder)
                <div class="folder-div">
                    <div class="block_title">
                    <span class="folder-name" data-folder-id="{{ $folder["folder"]->id }}"
                          data-folder-name="{{ $folder["folder"]->folder_name }}"><i
                                class="fa fa-caret-down fa-lg"></i><i
                                class="fa fa-caret-right fa-lg"></i>
                        {{ $folder["folder"]->folder_name }}
                    </span>
                        <div class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-bars fa-lg "> </i> 功能
                            </a>
                            <ul class="dropdown-menu">
                                <li class="add" data-ul-id="nev-ul-{{ $folder["folder"]->id }}"><a data-toggle="modal"
                                                                                                   data-target="#myModal">添加</a>
                                </li>
                                <li class="edit" data-ul-id="nev-ul-{{ $folder["folder"]->id }}"><a data-toggle="modal"
                                                                                                    data-target="#myModal">编辑</a>
                                </li>
                                <li class="folder" data-ul-id="nev-ul-{{ $folder["folder"]->id }}"><a
                                            data-toggle="modal"
                                            data-target="#myModal">分组管理</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <ul id="nev-ul-{{ $folder["folder"]->id }}" class="nev-ul">
                        @foreach( $folder["collects"] as $collect)
                            <li data-id="{{ $collect->id }}" class="nev-ul-li" data-href="{{ $collect->url }}"
                                data-title="{{ $collect->url_name}}">
                                <a href="{{ $collect->url }}" target="_blank">
                                    <p>{{ $collect->url_name }}</p>
                                </a>
                            </li>
                        @endforeach
                        @if(count($folder["collects"]) == 0  )
                            <li class="first-add" data-toggle="modal" data-target="#myModal">
                                <p><i class="fa fa-plus-square fa-2x"> </i></p>
                            </li>
                        @endif
                    </ul>
                </div>
            @endforeach
        @else
            <div class="folder-div">
                <div class="block_title">
                    <span class="folder-name" data-folder-id="0"
                          data-folder-name="0"><i
                                class="fa fa-caret-down fa-lg"></i><i
                                class="fa fa-caret-right fa-lg"></i>自定义导航
                    </span>
                    <div class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-bars fa-lg "> </i> 功能
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="/login">添加</a>
                            </li>
                            <li><a href="/login">编辑</a>
                            </li>
                            <li><a href="/login">分组管理</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <ul id="nev-ul-0" class="nev-ul">
                    <li>
                        <a href="/login"><p><i class="fa fa-plus fa-2x"> </i></p></a>
                    </li>
                </ul>
            </div>
        @endif
    </div>



    <!-- modal-dialog-->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">编辑</h4>
                </div>

                {{--添加--}}
                <div class="modal-body dialog-add">
                    <form class="form-horizontal" role="form" action="localhost/index/">
                        <div class="form-group old-folders">
                            <label for="test" class="col-sm-2 control-label">所属分组</label>
                            <div class="col-sm-10">
                                <select class="form-control groupId" name="groupId">
                                    @if(!Auth::guest())
                                        @foreach($folders as $folder)
                                            <option value="{{$folder["folder"]->id}}">{{$folder["folder"]->folder_name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="webname" class="col-sm-2 control-label">名称</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="webname">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="weburl" class="col-sm-2 control-label">网址</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="weburl">
                            </div>
                        </div>
                    </form>
                </div>


                {{--编辑--}}
                <div class="modal-body dialog-edit">
                    {{--<input type="hidden" name="_token" class="_token" value="{{csrf_token()}}">--}}
                    <form class="form-horizontal" role="form">
                        <div class="form-group">
                            <input type="hidden" class="form-control webid" name="webid"/>
                            <div class="col-sm-2" style="padding-left: 15px">
                                <select class="form-control groupId" name="groupId">
                                    @if(!Auth::guest())
                                        @foreach($folders as $folder)
                                            <option value="{{$folder["folder"]->id}}">{{$folder["folder"]->folder_name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-sm-3" style="padding-right: 0">
                                <input type="text" class="form-control webname" name="webname" placeholder="">
                            </div>
                            <div class="col-sm-5">
                                <input type="text" class="form-control weburl" name="weburl" placeholder="">
                            </div>
                            <div class="col-sm-2">
                                <i class="fa fa-arrow-circle-o-up fa-2x"></i>
                                <i class="fa fa-arrow-circle-o-down fa-2x"></i>
                                <i class="fa fa-times-circle-o fa-2x " style="color: red"></i>
                            </div>
                        </div>
                    </form>
                </div>


                {{--分组--}}
                <div class="modal-body dialog-folder">
                    {{--<input type="hidden" name="_token" class="_token" value="{{csrf_token()}}">--}}
                    <form class="form-horizontal" role="form">
                        <div class="form-group">
                            <label for="firstname" class="col-sm-2 control-label">分组名称</label>
                            <div class="col-sm-8">
                                <input type="hidden" class="form-control folderId" name="folderId"/>
                                <input type="text" class="form-control folderName" name="folderName"/>
                            </div>
                            <div class="col-sm-2 icon-button">
                                <i class="fa fa-arrow-circle-o-up fa-2x"></i>
                                <i class="fa fa-arrow-circle-o-down fa-2x"></i>
                                <i class="fa fa-times-circle-o fa-2x " style="color: red"></i>
                            </div>
                        </div>
                    </form>
                    <div id="create-folder">
                        <i class="fa fa-plus-square-o fa-2x"></i><span>新建分组</span>
                    </div>
                </div>

                <div class="modal-footer">
                    <h4></h4>
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-primary" id="dialog-submit">提交</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal -->
    </div>
    <script language="JavaScript" src="{{ URL::asset('/') }}js/temp_index.js"></script>
@stop
