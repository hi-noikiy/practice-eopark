@extends("layouts.admin.property")
@section("warp")
    <table class="table table-striped container">
        <thead>
        <tr>
            <th><input type="checkbox"/></th>
            <th>属性名/属性值</th>
            <th>排序</th>
            <th>状态</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($properties as $property)
            <tr>
                <th><input type="checkbox"/></th>
                <td><span class="glyphicon glyphicon-chevron-up"
                          data-id="{{$property->id}}"> </span> {{$property->name}}</td>
                <td>{{$property->priority}}</td>
                @include("include.admin.parts.status",['status'=>$property->status])
                <td>
                    <a href="{{ url()->current() }}/edit/{{ $property->id }}">编辑</a> | <a
                            href="{{url()->current()}}/addValue/{{$property->id}}">新增下级</a> | <a
                            href="{{url()->current()}}/deleteProp/{{$property->id }}" class="btn-prop-delete"
                            onclick="return confirm('确认删除该属性,子类及所有关联项?')">删除</a>
                </td>
            </tr>
            @foreach($property->value as $value)
                <tr class="prop-value" data-pid="{{$property->id}}">
                    <th><input type="checkbox"/></th>
                    <td class="depth2">{{$value->name}}</td>
                    <td>{{$value->priority}}</td>
                    @include("include.admin.parts.status",['status'=>$value->status])
                    <td>
                        <a href="{{ url()->current() }}/editValue/{{ $value->id }}">编辑</a> | <a
                                href="{{url()->current()}}/deletePropValue/{{$value->id}}"
                                class="btn-value-delete" onclick="return confirm('确认删除该属性及其关联项?')">删除</a>
                    </td>
                </tr>
            @endforeach
        @endforeach
        </tbody>
    </table>
    <div class="page_bottom">
        <?php echo $properties->render(); ?>
    </div>
    <style type="text/css">
        .glyphicon {
            cursor: pointer;
        }

        .prop-value {
            display: none;
        }

        .prop-value .depth2 {
            padding-left: 3em;
        }

    </style>
    <script type="text/javascript">
        $(document).ready(function () {
            new helper().ladder();
//            var glyphicon = $(".glyphicon");
//            glyphicon.click(function () {
//                var current = $(this).attr("class");
//                var id = $(this).attr("data-id");
//                console.log(id);
//                if (current == "glyphicon glyphicon-chevron-up") {
//                    $(".prop-value[data-pid=" + id + "]").show();
//                    $(this).attr("class", "glyphicon glyphicon-chevron-down");
//                } else {
//                    $(".prop-value[data-pid=" + id + "]").hide();
//                    $(this).attr("class", "glyphicon glyphicon-chevron-up");
//                }
//            });

        });
    </script>
@stop
