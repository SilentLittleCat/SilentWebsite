@extends('frontend.layouts.master')
@section('style')
<style type="text/css">
    .masthead h2.ui.header {
        margin-top: 33px;
        font-size: 2em;
        text-align: center;
        font-style: italic;
    }
    .ui.text.container {
        margin-bottom: 7em;
    }
    .ui.header {
        font-family: "Comic Sans MS", cursive, sans-serif;
    }
    .ui.segment {
        padding-top: 38px;
    }
</style>
@endsection
@section('content')
<div class="ui inverted vertical masthead center align segment">
    <div class="ui text container">
        <img class="ui centered medium image" src="{{ asset('image/icon/icon2.png') }}">
        <h2 class="ui inverted center align header">
            @lang('messages.moto1')
        </h2>
        <h2 class="ui inverted center align header">
            @lang('messages.moto2')
        </h2>
    </div>
</div>
@endsection