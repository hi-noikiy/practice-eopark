<div class="form-group">
    <label for="lastname" class="col-sm-2 control-label">{{ isset($label)? $label : '分类' }}</label>
    <div class="col-sm-3 category-depth-1-div">
        <select class="form-control category-depth-1" name="category_1">
            <option value="0">未选择</option>
            @foreach( $categories as $categoryOne)
                @if(isset($thisCategory[0])  && $categoryOne["id"] == $thisCategory[0]['id'])
                    <option value="{{ $categoryOne['id'] }}" selected="selected">{{ $categoryOne['name'] }}</option>
                @else
                    <option value="{{ $categoryOne['id'] }}">{{ $categoryOne['name'] }}</option>
                @endif
            @endforeach
        </select>
    </div>
    @foreach( $categories as $categoryOne)
        <div class="col-sm-3 category-depth-2-div" data-parent-id="{{$categoryOne['id']}}">
            <select class="form-control category-depth-2" data-parent-id="{{$categoryOne['id']}}">
                <option value="0">未选择</option>
                @if( isset($categoryOne['next']))
                    @foreach($categoryOne['next'] as $categoryTwo)
                        @if(isset($thisCategory[1]) && $thisCategory[1]['id'] ==  $categoryTwo['id'])
                            <option value="{{ $categoryTwo['id'] }}"
                                    selected="selected">{{ $categoryTwo['name'] }}
                            </option>
                        @else
                            <option value="{{ $categoryTwo['id'] }}">{{ $categoryTwo['name'] }}</option>
                        @endif
                    @endforeach
                @endif
            </select>
        </div>
    @endforeach
    @foreach( $categories as $categoryOne)
        @if( isset($categoryOne['next']))
            @foreach($categoryOne['next'] as $categoryTwo)
                <div class="col-sm-3 category-depth-3-div" data-parent-id="{{$categoryTwo['id']}}">
                    <select class="form-control category-depth-3">
                        <option value="0">未选择</option>
                        @if( isset($categoryTwo['next']))
                            @foreach($categoryTwo['next'] as $categoryThree)
                                @if(isset($thisCategory[2]) && $thisCategory[2]['id']==$categoryThree['id'])
                                    <option value="{{ $categoryThree['id'] }}"
                                            selected="selected">{{ $categoryThree['name'] }}
                                    </option>
                                @else
                                    <option value="{{ $categoryThree['id'] }}">{{ $categoryThree['name'] }}</option>
                                @endif
                            @endforeach
                        @endif
                    </select>
                </div>
            @endforeach
        @endif
    @endforeach
</div>
@if(isset($thisCategory))
    @if(isset($thisCategory[0]) && isset($thisCategory[1]))
        <style type="text/css">
            .category-depth-2-div, .category-depth-3-div {
                display: none;
            }

            .category-depth-2-div[data-parent-id='{{$thisCategory[0]['id'] }}'],
            .category-depth-3-div[data-parent-id='{{$thisCategory[1]['id'] }}'] {
                display: block;
            }
        </style>
    @elseif(isset($thisCategory[0]))
        <style type="text/css">
            .category-depth-2-div, .category-depth-3-div {
                display: none;
            }
            .category-depth-2-div[data-parent-id='{{$thisCategory[0]['id'] }}'] {
                display: block
            }
        </style>
    @endif
@else
    <style type="text/css">
        .category-depth-2-div, .category-depth-3-div {
            display: none;
        }

        .category-depth-1, .category-depth-2, .category-depth-3 {
            padding: 0;
        }
    </style>
@endif
<script type="text/javascript">
    $(document).ready(function () {
        var depthId1, depthId2;
        var div2 = $(".category-depth-2-div");
        var div3 = $(".category-depth-3-div");
        $(".category-depth-1").change(function () {
            depthId1 = $(".category-depth-1 option:selected").val();
            div3.find("select").removeAttr("name");
            div2.find("select").removeAttr("name");
            div3.hide();
            div2.hide();
            var current = $(".category-depth-2-div[data-parent-id=" + depthId1 + "]");
            current.find("select").attr("name", "category_2");
            current.show();
        });
        div2.change(function () {
            if (depthId1 == undefined) {
                depthId1 = $(".category-depth-1 option:selected").val();
            }
            depthId2 = $(".category-depth-2[data-parent-id=" + depthId1 + "] option:selected ").val();
            div3.removeAttr("name");
            div3.hide();
            var current = $(".category-depth-3-div[data-parent-id=" + depthId2 + "]");
            current.find("select").attr('name', 'category_3');
            current.show();
        });
                @if(isset($thisCategory[0]))
        var thisCategory2 = $(".category-depth-2-div[data-parent-id=" + {{$thisCategory[0]['id']}} +"]");
        thisCategory2.find("select").attr("name", "category_2");
                @if(isset($thisCategory[1]))
        var thisCategory3 = $(".category-depth-3-div[data-parent-id=" + {{$thisCategory[1]['id']}} +"]");
        thisCategory3.find("select").attr('name', 'category_3');
        @endif
        @endif
    });
</script>