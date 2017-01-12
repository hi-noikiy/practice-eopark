<div class="form-group">
    <label class="col-sm-2 control-label">品牌</label>
    <div class="col-sm-3 category-depth-1-div">
        <select class="form-control brand" name="brand_id">
            <option value="0">未选择</option>
            @foreach($brandRelations as $brandRelation)
                @if(isset($brand_id) && $brand_id ==$brandRelation->brand_id )
                    <option value="{{$brandRelation->brand_id}}"
                            data-cate-id="{{ $brandRelation->category_id }}"
                            selected>{{$brandRelation->brand_name}}</option>
                @else
                    <option value="{{$brandRelation->brand_id}}"
                            data-cate-id="{{ $brandRelation->category_id }}">{{$brandRelation->brand_name}}</option>
                @endif
            @endforeach
        </select>
    </div>
</div>
{{--<script type="text/javascript">--}}
{{--$(document).ready(function () {--}}
{{--var cateId;--}}
{{--$(".brand").click(function () {--}}
{{--cateId = $(".category-depth-3 option:selected").val();--}}
{{--if (cateId == 0 || cateId == '') {--}}
{{--cateId = $(".category-depth-2 option:selected").val();--}}
{{--if (cateId == 0 || cateId == '') {--}}
{{--cateId = $(".category-depth-1 option:selected").val();--}}
{{--}--}}
{{--}--}}
{{--//            console.log(cateId);--}}
{{--//            return ;--}}
{{--$(".brand option:selected").removeAttr('selected');--}}
{{--$(".brand option").hide();--}}
{{--$(".brand option[data-cate-id=" + cateId + "]").show();--}}
{{--});--}}
{{--})--}}
{{--</script>--}}