<div class="footer">
    <div class="copyright">
        <p><a href="#" data-toggle="modal" data-target="#feedback">反馈意见</a> | <a href="/official/touch">联系我们</a></p>
        <p>{{ config("set.siteBeian") }} | Copyright©{{ date("Y") }} <a
                    href="{{config('set.siteRoot')}}">{{config("set.sitePath")}}</a> All Rights
            Reserved</p>
    </div>
    <div id="footer-end">
    </div>
    <div class="modal fade " id="feedback" role="dialog" tabindex="-1" aria-labelledby="feedbackLabel"
         aria-hidden="true" data-keyboard="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="feedback">反馈意见</h4>
                </div>
                <form class="form-horizontal" role="form" action="/feedback/opinion" method="get">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="firstname" class="col-sm-2 control-label">网址链接</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="url" value="{{ url()->current() }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="lastname" class="col-sm-2 control-label">意见建议</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="feedback-opinion" rows="5"
                                          maxlength="255" placeholder="255个字符内描述"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                        <button type="submit" class="btn btn-primary">提交更改</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>