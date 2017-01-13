@extends("layouts.admin.master")
@section("content")
    @include("parts.admin.resource_left")
    <div class="right-warp">
        @include("parts.admin.brand_header")
        @section("warp")
        @show
    </div>
@stop