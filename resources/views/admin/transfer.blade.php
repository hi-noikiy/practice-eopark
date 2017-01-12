@extends("layouts.admin.master")
@section("content")
    <div class="transfer">
                @if (session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
    </div>
    <style>
        .transfer{
            text-align: center;
            width: 40%;
            margin-left: 30%;
            margin-top: 4em;
            margin-bottom: 4em;
        }

    </style>
@stop