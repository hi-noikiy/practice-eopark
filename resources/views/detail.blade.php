@extends('layouts.app')
@section("content")
    <link rel="stylesheet" href="/css/detail.css">
    <script type="text/javascript" src="{{ URL::asset('/js/detail.js') }}"></script>

    <input type="hidden" id="_token" class="_token" value="{{csrf_token()}}">
    <div class="detail-subject">
        <div class="detail-subject-summary">
            <h3>{{ $detail->title }}</h3>
            <br/>
            <img src="{{ $detail->cover }}" onerror="this.src='/img/onError.jpg'">
            <dl>
                <dt>
                </dt>
                @if( strlen($detail->link) > 28)
                    <dd>地址:<a href="{{ $detail->link }}" target="_blank" id="link"
                              title="{{ $detail->link }}">{{ substr($detail->link,0,28)}}...</a>
                    </dd>
                @else
                    <dd>地址:<a href="{{ $detail->link }}" target="_blank" id="link">{{ $detail->link}}</a>
                    </dd>
                @endif
                <dd>类型:{{ getResourceType($detail->type) }}</dd>
                <dd>分类:<a href="/resources/{{ $detail->category_1_name->id }}">{{ $detail->category_1_name->name }}</a>
                    {{ isset($detail->category_2_name->id) ? '/' :'' }} <a href="/resources/{{ $detail->category_2_name->id }}">{{ $detail->category_2_name->name }}</a> {{ isset($detail->category_3_name->id) ? '/' :'' }}
                    <a href="/resources/{{ isset($detail->category_3_name->id)?$detail->category_3_name->id  :''}}">{{ isset($detail->category_3_name->name) ? $detail->category_3_name->name:''  }}</a>
                </dd>
                <dd>品牌:{{ $detail->brand_name ?  $detail->brand_name : '无' }}</dd>
                <dd>贡献:{{ $detail->user_name ? $detail->user_name : "eopark.com" }}</dd>
                <dd>付费:{{ $detail->is_pay ? "是" : "否" }}</dd>
                <dd>浏览:{{ numberAdapter($detail->views) }}</dd>
                <dd>收录:{{ $detail->created_at }}</dd>
                <dd>更新:{{ $detail->updated_at }}</dd>
            </dl>
            <div class="grade">
                <p id="grade">{{ empty($detail->score) ? $detail->score : "\\" }}</p>
                <p>{{ numberAdapter($detail->scored_numbers) }}人打分</p>
                <div id="star">
                    <span>我的评分</span>
                    <ul>
                        <li class="{{ $myScore>=2 ? 'on' : ''}}"><a href="javascript:;">1</a></li>
                        <li class="{{ $myScore>=4 ? 'on' : ''}}"><a href="javascript:;">2</a></li>
                        <li class="{{ $myScore>=6 ? 'on' : ''}}"><a href="javascript:;">3</a></li>
                        <li class="{{ $myScore>=8 ? 'on' : ''}}"><a href="javascript:;">4</a></li>
                        <li class="{{ $myScore>=10 ? 'on' : ''}}"><a href="javascript:;">5</a></li>
                    </ul>
                    <span></span>
                    <p></p>
                </div>
            </div>
            @if($detail->introduce)
                <div class="detail-introduce">
                    <p>{{ $detail->introduce }}</p>
                </div>
            @endif
        </div>
        <div class="detail-subject-to">
            <a href="{{ $detail->link }}" target="_blank">
                <button type="button" class="btn btn-primary btn-lg" id="jump" title="{{ $detail->link }}">前往</button>
            </a>
            <p>点击将访问外站,请注意保护财产隐私安全.</p>
            <p><a href="#" class="tooltip-toggle" data-toggle="tooltip" data-placement="bottom" title="感谢您的反馈!"
                  data-trigger="click" data-res-id="{{$detail->id}}" id="res-feedback">反馈链接失效</a></p>
        </div>
    </div>
    <div class="detail-container">
        <div class="detail-container-left">
            <h4>用户评论(已有{{ numberAdapter($detail->comment_numbers) }}条评论)</h4>
            <textarea class="form-control" id="comment-textarea" rows="3"></textarea>
            <div id="detail-comment-count">
                <div class="comment-emoji">
                    {{--<span>img</span>--}}
                    {{--<span>@</span>--}}
                    {{--<span>#</span>--}}
                </div>
                <div class="comment-status">
                    <span id="submit-status-message"></span>
                </div>
                <div class="comment-button">
                    <span id="comment-len">0</span>/140<span>
                    <button type="button" id="submit-comment" class="btn btn-default btn-sm">提交</button></span>
                </div>
            </div>
            <div class="detail-comment">
                <ul>
                    @foreach( $comments as $comment)
                        <li>
                            {{--<img src="/img/upload/u=2020968545,2014670048&fm=21&gp=0.jpg" class="comment-userhead"/>--}}
                            <div class="comment-text">
                                <p><span class="user-name"
                                         data-id="{{ $comment->id }}">{{ $comment->user_name }}</span>
                                    @if($comment->reply_name)
                                        回复<a href='#' style="color: #357ebd;">{{ '@' }}{{$comment->reply_name}}</a>
                                    @endif
                                    :{{ $comment->comment }}
                                </p>
                                <p class="comment-text-bottom" data-comment-id="{{ $comment->id }}">
                                    <span class="comment-text-date">{{ $comment->created_at }}</span>
                                    @if( $comment->likes_user_id)
                                        <i class="glyphicon glyphicon-thumbs-up comment-likes"
                                           style="color: red;">{{ $comment->likes }}</i>
                                    @else
                                        <i class="glyphicon glyphicon-thumbs-up comment-likes">{{ $comment->likes }}</i>
                                    @endif
                                    <span class="reply">回复</span>
                                </p>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
            @if(count($comments))
                <div class="page_bottom">
                    <?php echo $comments->render(); ?>
                </div>
            @endif()

        </div>
        <div class="detail-container-right">
            {{--<h4>相关资源</h4>--}}
            {{--<ul>--}}
            {{--<li>--}}
            {{--<img src="/img/upload/u=2020968545,2014670048&fm=21&gp=0.jpg"/>--}}
            {{--<div class="related">--}}
            {{--<p>Android滑动ScrollView时使导航栏停留的效果</p>--}}
            {{--<p>播放量:1252 评分:8.5</p>--}}
            {{--</div>--}}
            {{--</li>--}}
            {{--</ul>--}}
        </div>
    </div>
@stop