@extends("layouts.admin.master")
@section("content")
    @include("parts.admin.resource_left")
<div class="right-warp">
    @include("parts.admin.property_header")
    @section("warp")
    @show
</div>
@stop