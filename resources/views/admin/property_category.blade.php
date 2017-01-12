@extends("layouts.admin.category")
@section("add_modal")
@stop
@section("warp")
    <form class="form-horizontal" role="form" action="{{ url()->current()}}/save">
        @include("include.admin.parts.property_table",[
                                    "properties"=>$properties,
                                    'ownProperty'=>$ownProperty
                                ])
        @include("include.admin.parts.form_submit_btn")
    </form>
    <script type="text/javascript">
        $(document).ready(function () {
            new helper().isShowProperties(true);
        })
    </script>
@stop