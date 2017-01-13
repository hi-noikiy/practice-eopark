@extends("layouts.admin.master")
@section("content")
    @include("parts.admin.resource_left")
@section("add_modal")
    @include("parts.admin.category_add_model",['categories'=>getCategoryCache()])
@show
<div class="right-warp">
    @include("parts.admin.category_header")
    @section("warp")
    @show
</div>
@stop