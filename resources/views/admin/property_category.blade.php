@extends("layouts.admin.category")
@section("add_modal")
@stop
@section("warp")
    <form class="form-horizontal" role="form" action="{{ url()->current()}}/save">
        @include("parts.admin.property_table",[
                                    "properties"=>$properties,
                                    'ownProperty'=>$ownProperty
                                ])
        @include("parts.admin.form_submit_btn")
    </form>
    <script type="text/javascript">
        $(document).ready(function () {
            new helper().isShowProperties(true);
        })
    </script>
@stop