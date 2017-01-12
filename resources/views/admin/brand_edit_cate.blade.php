@extends("layouts.admin.brand")
@section('warp')
    <form class="form-horizontal" role="form" style="padding: 2em 20%" action="{{ url()->current() }}/save">
        @include('include.common.category',['categories'=>getCategoryCache(),'label'=>"所属分类"])
        @include("include.admin.parts.form_submit_btn")
    </form>
@stop