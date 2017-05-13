@extends('frontend.layouts.master')

@section('style')
<style type="text/css">
	.bg-image img {
		position: absolute;
		margin-top: 0px;
		padding: 0px;
		border: 0px;
		z-index: 0;
		width: 100%;
		height: 100%;
		top: 0;
		left: 0;
		overflow: hidden;
	}
	.video-header img {
		position: absolute;
		top: 20%;
		left: 30%;
		width: 40%;
		height: auto;
		z-index: 100;
		margin: 0px auto;
	}
	#video-home .enter-button {
		position: absolute;
		bottom: 20%;
		left: 50%;
		width: 180px;
		height: 180px;
		z-index: 100;
		margin: 0px 0px 0px -90px;
		color: black;
		text-align: center;
		line-height: 180px;
		display: block;
		transition: all 0.3s ease-out;
	}
	#video-home .enter-button:hover {
		color: #fb724d;
	}
	#video-home .enter-button svg {
		transition: all 0.3s ease-out;
	}
	#video-home .enter-button strong {
		font-family: sans-serif;
		letter-spacing: 1px;
	}
	#button-bg {
		position: absolute;
		top: 0px;
		left: 0px;
		z-index: -1;
		width: 100%;
		height: 100%;
	}
	#video-home .ui.button:hover {
		color: #FF9900;
	}
</style>
@endsection

@section('content')
<div id="video-content">
	<div id="video-home">
		<div class="video-header">
			<img src="{{ url('image/video/title.png') }}">
		</div>
		<a href="{{ route('videos.home', ['id' => $id]) }}" class="enter-button">
			<strong>DICOVER</strong>
			<svg id="button-bg" x="0px" y="0px" viewBox="0 0 150 150" enable-background="new 0 0 150 150" xml:space="preserve">
			<path fill="#FFFFFF" d="M79.33,129.193c-2.382,1.375-6.279,1.375-8.66,0l-40.437-23.346c-2.382-1.375-4.33-4.75-4.33-7.5V51.654
			c0-2.75,1.949-6.125,4.33-7.5L70.67,20.807c2.382-1.375,6.279-1.375,8.66,0l40.437,23.346c2.382,1.375,4.33,4.75,4.33,7.5v46.693
			c0,2.75-1.949,6.125-4.33,7.5L79.33,129.193z"/>
		</a>
		<div class="bg-image">
			<img src="{{ url('image/video/back.jpg') }}">
		</div>
	</div>
</div>
@endsection

@section('script')
<script type="text/javascript">
	$(function() {
		$('.enter-button').hover(function() {
			$('#button-bg').css("transform", "scale(1.1, 1.1)");
		}, function() {
			$('#button-bg').css("transform", "scale(1, 1)");
		});
	});
</script>
@endsection