<table class="table table-striped container">
    <tbody>
    @foreach($properties as $property)
        <tr>
            <th class="prop-name">{{$property->name}}</th>
            <td>
                @foreach($property->values as $value)
                    <label class="checkbox-inline">
                        @if(isset($ownProperty) &&  in_array($value->id,$ownProperty))
                            <input data-type="prop" type="radio" value="{{$value->id}}"
                                   checked="checked" name="value[]">
                        @else
                            <input data-type="prop" type="radio"
                                   value="{{$value->id}}" name="value[]">
                        @endif
                        {{ $value->name  }}
                    </label>
                @endforeach
            </td>
        </tr>
    @endforeach
    </tbody>
</table>