@extends("layouts.admin.master")
@section("content")
    @include("include.admin.resource_left")
@section("add_modal")
    @include("include.admin.parts.category_add_model",['categories'=>getCategoryCache()])
@show
<div class="right-warp">
    @include("include.admin.category_header")
    @section("warp")
    @show
</div>
@stop