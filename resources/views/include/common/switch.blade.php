    <div class="form-group">
    <label for="lastname" class="col-sm-2 control-label">{{ isset($label) ?  $label : "状态"}}</label>
    <div class="col-sm-10" style="padding: 7px 15px">
        @if(isset($status) && $status)
            <div class="radio">
                <input id="switch-true" type="radio" name="{{isset($name) ? $name : "status"}}" value="1"
                       checked>
                <label for="switch-true">{{ isset($open) ?  $open : "开启"}}</label>
            </div>
            <div class="radio">
                <input type="radio" id="switch-false" name="{{isset($name) ? $name : "status"}}"
                       value="0">
                <label for="switch-false">{{ isset($close) ?  $close : "关闭"}}</label>
            </div>
        @else
            <div class="radio">
                <input type="radio" id="switch-true" name="{{isset($name) ? $name : "status"}}" value="1"
                       checked>
                <label for="switch-true">{{ isset($open) ?  $open : "开启"}}</label>
            </div>
            <div class="radio">
                <input type="radio" id="switch-false" name="{{isset($name) ? $name : "status"}}"
                       value="0" checked>
                <label for="switch-false">{{ isset($close) ?  $close : "关闭"}}</label>
            </div>
        @endif
    </div>
</div>