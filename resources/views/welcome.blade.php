@extends('frontend.layouts.master')
@section('style')
<style type="text/css">
    .masthead h2.ui.header {
        margin-top: 58px;
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

@section('script')
<script type="text/javascript">
$(function() {
    var renderer = new FSS.CanvasRenderer();    

    // 2) Add the Renderer's element to the DOM:
    var container = document.getElementById('myTest');
    container.appendChild(renderer.element);    

    // 3) Create a Scene:
    var scene = new FSS.Scene();    

    // 4) Create some Geometry & a Material, pass them to a Mesh constructor, and add the Mesh to the Scene:
    var geometry = new FSS.Plane(1000, 500, 4, 2);
    var material = new FSS.Material('#444444', '#FFFFFF');
    var mesh = new FSS.Mesh(geometry, material);
    scene.add(mesh);    

    // 5) Create and add a Light to the Scene:
    var light = new FSS.Light('#FF0000', '#0000FF');
    scene.add(light);   

    // 6) Finally, render the Scene:
    renderer.render(scene);
});
</script>
@endsection