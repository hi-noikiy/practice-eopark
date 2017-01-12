<div class="form-group">
    <label for="lastname" class="col-sm-2 control-label">{{ isset($label)? $label : '属性组' }}</label>
    <div class="col-sm-3 category-depth-1-div">
        <select class="form-control category-depth-1" name="prop_id">
            <option value="0">未选择</option>
            @foreach($properties as $property)
                @if(isset($ownPropertyId) && $ownPropertyId == $property->id)
                    <option value="{{ $property->id }}" selected="selected">{{ $property->name }}</option>
                @else
                    <option value="{{ $property->id }}">{{ $property->name }}</option>
                @endif
            @endforeach
        </select>
    </div>
</div>