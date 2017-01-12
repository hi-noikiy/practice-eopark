@extends("layouts.admin.master")
@section("content")
    @include("include.admin.resource_left")
    <div class="right-warp">
        @include("include.admin.brand_header")
        @section("warp")
        @show
    </div>
@stop