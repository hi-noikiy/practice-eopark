@extends('layouts.app')
@section('content')
    <link rel="stylesheet" href="/css/resource.css">

    <div class="resource">
        <div class="resource-header">
            <ol class="breadcrumb">
                @foreach($categories as  $key =>$category)
                    @if($key == count($categories)-1)
                        <li>{{ $category['name']}}</li>
                    @else
                        <li><a href="/resources/{{$category['id']}}">{{ $category['name'] }}</a></li>
                    @endif
                @endforeach
            </ol>
            <div class="selector">
                <ul class="list-group">
                    <li class="list-group-item">
                        <div class="selector-name">品牌</div>
                        <div class="row selector-value">
                            @if(strpos(url()->full(),"brand=") !== false)
                                <div class="col-xs-3 col-md-2 " style="padding: 0;width: 5em;">
                                    <a href="{{ url()->current() }}">
                                        <button class="btn btn-sm btn-default" style="padding: 5px 15px;width: auto">不限
                                        </button>
                                    </a>
                                </div>
                            @endif
                            @if(isset($brands) && count($brands))
                                @foreach($brands as $brand)
                                    <div class="col-xs-3 col-md-2 selector-value-item">
                                        <a href="{{url()->current()}}?brand={{$brand->id}}" class="thumbnail">
                                            <img src="{{$brand->brand_logo}}" alt="...">
                                        </a>
                                    </div>
                                @endforeach
                            @else
                                <p class="no-brand">无</p>
                            @endif
                        </div>
                    </li>

                    <li class="list-group-item">
                        <div class="selector-name">
                            类型
                        </div>
                        <ul class="nav nav-pills selector-value">
                            <li class="{{ !isset($type) ? "active":"" }}"><a href="{{url()->current()}}"><span>不限</span></a>
                            </li>
                            <li class="{{ isset($type) &&$type==1 ? "active":"" }}"><a
                                        href="{{addParaToUrl('type',1)}}"><span>视频</span></a></li>
                            <li class="{{ isset($type) &&$type==2 ? "active":"" }}"><a
                                        href="{{addParaToUrl('type',2)}}"><span>图文</span></a></li>
                            <li class="{{ isset($type) &&$type==3 ? "active":"" }}"><a
                                        href="{{addParaToUrl('type',3)}}"><span>下载</span></a></li>
                            <li class="{{ isset($type) && $type=='0' ? "active":"" }}"><a
                                        href="{{addParaToUrl('type',0)}}"><span>其他</span></a></li>
                        </ul>
                    </li>

                    @foreach($properties as $property)
                        <li class="list-group-item">
                            <div class="selector-name">
                                {{$property['prop_name']}}
                            </div>
                            <ul class="nav nav-pills selector-value sv-text filter-warp">
                                @if(strpos(url()->current(),'filter')===false)
                                    <li class="active">
                                        <a href="">不限</a>
                                    </li>
                                    @foreach($property['values'] as $value)
                                        <li>
                                            <a href="{{url()->current()}}/filter/{{$value['value_id']}}">{{$value['value_name']}}</a>
                                        </li>
                                    @endforeach
                                @else
                                    <li class="active no-select">
                                        <a href="{{ clearBrother($property['value_ids']) }}">不限</a>
                                    </li>
                                    @foreach($property['values'] as $value)
                                        <li data-id="{{$value['value_id']}}">
                                            <a href="{{alterFilter($value['value_id'],$property['value_ids'])}}">{{$value['value_name']}}</a>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="resource-content ">
            <div class="rc-head">
                <div class="btn-group ">
                    <a href="{{addParaToUrl("order","views")}}">
                        <button type="button"
                                class="btn btn-sm  btn-{{ (isset($order)&& $order =='views') || (!isset($order)) ? 'primary':'default' }}">
                            热门<i class="glyphicon glyphicon-arrow-down"> </i>
                        </button>
                    </a>
                    <a href="{{addParaToUrl("order","score")}}">
                        <button type="button"
                                class="btn  btn-sm btn-{{ isset($order)&& $order =='score' ? 'primary':'default' }}">评分
                            <i
                                    class="glyphicon glyphicon-arrow-down"> </i></button>
                    </a>
                    <a href="{{addParaToUrl("order","comment_numbers")}}">
                        <button type="button"
                                class="btn  btn-sm btn-{{ isset($order)&&$order=='comment_numbers' ? 'primary':'default' }}">
                            评论数
                            <i class="glyphicon glyphicon-arrow-down"> </i></button>
                    </a>
                    <a href="{{addParaToUrl("order","created_at")}}">
                        <button type="button"
                                class="btn  btn-sm btn-{{ isset($order)&&$order=='created_at' ? 'primary':'default' }}">
                            最新 <i
                                    class="glyphicon glyphicon-arrow-up"> </i></button>
                    </a>
                </div>
            </div>

            <div class="row rc-body">
                @foreach($resources as $resource)
                    <div class="col-sm-4 col-md-2 rc-body-item">
                        <a href="/detail/{{$resource->id}}">
                            <div class="thumbnail">
                                <img class="thumbnail-cover"
                                     src="{{$resource->cover ? $resource->cover : '/img/onError.jpg'}}">
                                <div class="caption">
                                    <div class="rc-score-warp">
                                        @if((int)$resource->score)
                                            <span class="score">{{ $resource->score }}</span>
                                        @else
                                            <span class="score">\</span>
                                        @endif
                                        @if((int)$resource->score)
                                            <span class="scored-numbers">{{numberAdapter($resource->scored_numbers)}}
                                                人打分</span>
                                        @endif
                                    </div>
                                    <h5>{{$resource->title}}</h5>
                                    <p class="rc-comment">{{ numberAdapter($resource->comment_numbers)}}条评论</p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
            @include("parts.common.page_number",["data"=>$resources])
        </div>

    </div>
    @if(isset($selectedIds))
        <textarea id="filter-selected">{{ $selectedIds }}</textarea>
    @endif

    <script language="JavaScript" src="{{ URL::asset('/') }}js/resources.js"></script>
@stop