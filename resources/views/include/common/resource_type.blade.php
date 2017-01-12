<div class="form-group">
    <label for="firstname" class="col-sm-2 control-label">类型</label>
    <div class="col-sm-10">
        <label class="checkbox-inline">
            @if(isset($type) && $type ==1)
                <input type="radio" name="type" id="optionsRadios3" value="1" checked>视频
            @else
                <input type="radio" name="type" id="optionsRadios3" value="1">视频
            @endif
        </label>
        <label class="checkbox-inline">
            @if(isset($type) && $type ==2)
                <input type="radio" name="type" id="optionsRadios4" value="2" checked>文章
            @else
                <input type="radio" name="type" id="optionsRadios4" value="2">文章
            @endif
        </label>
        <label class="checkbox-inline">
            @if(isset($type) && $type ==3)
                <input type="radio" name="type" id="optionsRadios4" value="3" checked>下载
            @else
                <input type="radio" name="type" id="optionsRadios4" value="3">下载
            @endif
        </label>
        <label class="checkbox-inline">
            @if(!isset($type) || $type ==0)
                <input type="radio" name="type" id="optionsRadios4" value="0" checked>其他
            @else
                <input type="radio" name="type" id="optionsRadios4" value="0">其他
            @endif
        </label>
    </div>
</div>