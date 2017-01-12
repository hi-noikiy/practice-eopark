@extends("layouts.app")
@section("content")
    <link rel="stylesheet" href="/css/thanksgiving.css">

    <script type="text/javascript" src="{{ URL::asset('/js/lib/plupload/plupload.full.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('/js/thanksgiving.js') }}"></script>
    <script src="http://cdn.bootcss.com/highcharts/5.0.0/highcharts.js"></script>

    <div class="modal fade " id="propModal" role="dialog" tabindex="-1" aria-labelledby="myModalLabel"
         aria-hidden="true" data-keyboard="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="propModalLabel"></h4>
                </div>
                <div class="modal-body">
                    <form id="properties-warp">
                        <table class="table">
                            <caption><p id="no-prop">当前分类下无可供选择的属性</p></caption>
                            <thead>
                            <tr id="prop-thead-tr">
                                <th>属性名</th>
                                <th>值</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    <button type="button" id="modal-submit" class="btn btn-primary" data-bind="click:submit">
                        确认
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="thanksgiving">
        <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
        {{--face front--}}
        <div class="thanks-flip">
            <div class="thanks face front">
                <div class="head center">
                    <h3>Thanks</h3>
                    <br/>
                    <hr/>
                    <br/>
                    <h3>虽然不能做些什么,但至少可以谢谢.</h3>
                </div>
                <form class="form-horizontal" role="form" id="thanks-form">
                    <div class="form-group">
                        <label for="lastname" class="col-sm-2 control-label">寄语</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="gratitude" rows="7"></textarea>
                        </div>
                    </div>
                    <div class="center">
                        <button type="button" id="thanks-submit" class="btn btn-primary contribute-btn">感谢</button>
                    </div>
                    <div class="form-group">
                        <div id="thanks-message">
                            <p id="thanks-success"></p>
                            <p id="thanks-error"></p>
                        </div>
                    </div>
                </form>

            </div>
            {{--thanks-back face back thanks-back-warper--}}
            <div class="thanks-back face back thanks-back-warper">
                <div class="head center">
                    <h3>Thanks</h3>
                    <br/>
                    <hr/>
                </div>
                <div class="thanks-words">
                    @foreach( $thanks as $thank)
                        <p>{{ $thank->gratitude }}</p>
                    @endforeach
                    <a href="#"><i class="fa fa-gift fa-lg"> more...</i></a>
                </div>
                <br/>
                <div class="thanks-words" id="thanks-height-container">
                </div>
                <br/>
                <div class="thanks-words" id="thanks-pie-container">
                </div>
            </div>
            {{-------------------------------}}
        </div>
        <div id="thanksgiving-middle">
        </div>

        <div class="giving-flip">
            {{--------------face back cardAK-----------------}}
            <div class="giving face front" style="margin-left: 50%">
                <div class="head center">
                    <h3>Giving</h3>
                    <br/>
                    <hr/>
                    <br/>
                    <h3>赠人玫瑰,手有余香.</h3>
                </div>
                <form class="form-horizontal" role="form" id="giving-form">
                    <input type="hidden" id="form-property" name="property" value="">
                    <div class="form-group">
                        <label for="title" class="col-sm-2 control-label"><i class="fa fa-asterisk"></i> 标题</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="title" name="title" placeholder="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="link" class="col-sm-2 control-label"><i class="fa fa-asterisk"></i> 链接</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="link" name="link" placeholder="">
                        </div>
                    </div>
                    @include("include.common.category")
                    <div class="panel panel-info form-group">
                        <div class="panel-heading">
                            <a id='giving-more' data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                                <h4 class="panel-title">
                                    <i class="glyphicon glyphicon-chevron-up"></i>详细信息
                                </h4>
                            </a>
                        </div>
                        <div id="collapseThree" class="panel-collapse collapse">
                            <div class="panel-body">
                                <div class="form-group">
                                    <label for="lastname" class="col-sm-2 control-label">上传封面</label>
                                    <div class="col-sm-10 " id="upload-container">
                                        <a class="a-upload" id="a-upload">
                                            <b>点击上传</b>
                                        </a>
                                        <ul id="filelist">
                                        </ul>
                                        <p id="showImgName" style="display: inline-block;"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label style="position: relative" for="link" class="col-sm-2 control-label">封面地址<p
                                                style="position: absolute;top: -1.2em;right: 0;"><i
                                                    class="glyphicon glyphicon-resize-vertical"></i> 或
                                        </p></label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="cover_link" name="cover_url"
                                               placeholder="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="introduce" class="col-sm-2 control-label">介绍</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" name="introduce" id="introduce" rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="type" class="col-sm-2 control-label">类型</label>
                                    <div class="col-sm-10 res-type">
                                        <div class="radio">
                                            <input type="radio" name="type" id="optionsRadios1" value="1">
                                            <label for="optionsRadios1">视频</label>
                                        </div>
                                        <div class="radio">
                                            <input type="radio" name="type" id="optionsRadios2" value="2">
                                            <label for="optionsRadios2">图文</label>
                                        </div>
                                        <div class="radio">
                                            <input type="radio" name="type" id="optionsRadios3" value="3">
                                            <label for="optionsRadios3">下载</label>
                                        </div>
                                        <div class="radio">
                                            <input type="radio" name="type" id="optionsRadios4" value="0" checked>
                                            <label for="optionsRadios4">其他</label>
                                        </div>
                                    </div>
                                </div>
                                @include('include.common.switch', ["label"=>"付费",'status' => false,"open"=>"是","close"=>"否","name"=>"is_pay"])
                                <div class="form-group">
                                    <label for="introduce" class="col-sm-2 control-label">属性</label>
                                    <div class="col-sm-10">
                                        <a class="btn btn-default btn-sm" data-toggle="modal"
                                           data-target="#propModal" id="btn-add-prop">添加属性
                                        </a>
                                        <span class="glyphicon glyphicon-ok prop-ok">已选择</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="center">
                        <button type="button" class="btn btn-primary contribute-btn" id="giving-submit">提交</button>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12 " id="message-giving">
                            <p id="giving-error"></p>
                            <p id="giving-success"></p>
                        </div>
                    </div>
                </form>
            </div>

            <div class="giving-back face back">
                <div class="head center">
                    <h3>Giving</h3>
                    <br/>
                    <hr/>
                </div>
                <div class="giving-words" id="giving-height-container">
                    用户贡献量排行榜top10
                </div>
                <br/>
                <div class="giving-words" id="giving-pie-container">
                    学科活跃度Top10
                </div>
                <br/>
            </div>
        </div>
    </div>
    <textarea style="display: none;" id="prop_data">{{ json_encode(getCatePropRelationCache()) }}</textarea>
@stop
@section("footer")
@stop




