@extends('frontend.layouts.master')

@section('style')
<style type="text/css">
	body {
		background-image: url('https://photos.smugmug.com/Background-1/i-Gw4vpVD/0/b1c1de02/M/color1-M.png');
		background-repeat: repeat-y;
		background-size: 100%;
		background-attachment: fixed;
	}
	#backControl {
		padding-top: 100px;
	}
</style>
@endsection

@section('content')
<div id="backControl">
	<div class="ui container">
		<div class="ui pointing secondary menu">
			<a href="#" class="active item" data-tab="movie">Movie</a>
			<a href="#" class="item" data-tab="code">Code</a>
			<a href="#" class="item" data-tab="photo">Photo</a>
			<a href="#" class="item" data-tab="article">Article</a>
			<a href="#" class="item" data-tab="music">Music</a>
			<a href="#" class="item" data-tab="video">Video</a>
		</div>	

		<div class="ui tab active segment" data-tab="movie">
			<div class="ui top attached tabular menu">
				<a href="#" class="active item" data-tab="movie/manage">Manage</a>
				<a href="#" class="item" data-tab="movie/category">Category</a>
				<a href="#" class="item" data-tab="movie/comment">Comment</a>
				<a href="#" class="item" data-tab="movie/config">Config</a>
			</div>
			<div class="ui bottom attached active tab segment" data-tab="movie/manage">
				movie/manage
			</div>
			<div class="ui bottom attached tab segment" data-tab="movie/category">
				movie/category
			</div>
			<div class="ui bottom attached tab segment" data-tab="movie/comment">
				movie/comment
			</div>
			<div class="ui bottom attached tab segment" data-tab="movie/config">
				movie/config
			</div>
		</div>	

		<div class="ui tab segment" data-tab="code">
			<div class="ui top attached tabular menu">
				<a href="#" class="active item" data-tab="code/manage">Manage</a>
				<a href="#" class="item" data-tab="code/category">Category</a>
				<a href="#" class="item" data-tab="code/comment">Comment</a>
				<a href="#" class="item" data-tab="code/config">Config</a>
			</div>
			<div class="ui bottom attached active tab segment" data-tab="code/manage">
				code/manage
			</div>
			<div class="ui bottom attached tab segment" data-tab="code/category">
				code/category
			</div>
			<div class="ui bottom attached tab segment" data-tab="code/comment">
				code/comment
			</div>
			<div class="ui bottom attached tab segment" data-tab="code/config">
				code/config
			</div>
		</div>	

		<div class="ui tab segment" data-tab="photo">
			<div class="ui top attached tabular menu">
				<a href="#" class="active item" data-tab="photo/manage">Manage</a>
				<a href="#" class="item" data-tab="photo/category">Category</a>
				<a href="#" class="item" data-tab="photo/comment">Comment</a>
				<a href="#" class="item" data-tab="photo/config">Config</a>
			</div>
			<div class="ui bottom attached active tab segment" data-tab="photo/manage">
				photo/manage
			</div>
			<div class="ui bottom attached tab segment" data-tab="photo/category">
				photo/category
			</div>
			<div class="ui bottom attached tab segment" data-tab="photo/comment">
				photo/comment
			</div>
			<div class="ui bottom attached tab segment" data-tab="photo/config">
				photo/config
			</div>
		</div>	

		<div class="ui tab segment" data-tab="article">
			<div class="ui top attached tabular menu">
				<a href="#" class="active item" data-tab="article/manage">Manage</a>
				<a href="#" class="item" data-tab="article/category">Category</a>
				<a href="#" class="item" data-tab="article/comment">Comment</a>
				<a href="#" class="item" data-tab="article/config">Config</a>
			</div>
			<div class="ui bottom attached active tab segment" data-tab="article/manage">
				article/manage
			</div>
			<div class="ui bottom attached tab segment" data-tab="article/category">
				article/category
			</div>
			<div class="ui bottom attached tab segment" data-tab="article/comment">
				article/comment
			</div>
			<div class="ui bottom attached tab segment" data-tab="article/config">
				article/config
			</div>
		</div>	

		<div class="ui tab segment" data-tab="music">
			<div class="ui top attached tabular menu">
				<a href="#" class="active item" data-tab="music/manage">Manage</a>
				<a href="#" class="item" data-tab="music/category">Category</a>
				<a href="#" class="item" data-tab="music/comment">Comment</a>
				<a href="#" class="item" data-tab="music/config">Config</a>
			</div>
			<div class="ui bottom attached active tab segment" data-tab="music/manage">
				music/manage
			</div>
			<div class="ui bottom attached tab segment" data-tab="music/category">
				music/category
			</div>
			<div class="ui bottom attached tab segment" data-tab="music/comment">
				music/comment
			</div>
			<div class="ui bottom attached tab segment" data-tab="music/config">
				music/config
			</div>
		</div>	

		<div class="ui tab segment" data-tab="video">
			<div class="ui top attached tabular menu">
				<a href="#" class="active item" data-tab="video/manage">Manage</a>
				<a href="#" class="item" data-tab="video/category">Category</a>
				<a href="#" class="item" data-tab="video/comment">Comment</a>
				<a href="#" class="item" data-tab="video/config">Config</a>
			</div>
			<div class="ui bottom attached active tab segment" data-tab="video/manage">
				video/manage
			</div>
			<div class="ui bottom attached tab segment" data-tab="video/category">
				video/category
			</div>
			<div class="ui bottom attached tab segment" data-tab="video/comment">
				video/comment
			</div>
			<div class="ui bottom attached tab segment" data-tab="video/config">
				video/config
			</div>
		</div>
	</div>
</div>
@endsection

@section('script')
<script type="text/javascript">
$(function() {
	$('#backControl .menu .item').tab({
		cache: false,
		context: $('#backControl')
	}).api({
		url: "{{ route('home.update') }}",
		method: 'POST',
		loadingDuration: 200,
		beforeXHR: function(xhr) {
			xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
		},
		beforeSend: function(settings) {
			var info = $(this).attr('data-tab');
			settings.data = {
				'object': info.split("/")[0],
				'operation': info.split("/")[1]
			}
			return settings;
		},
		onSuccess: function(response, element, xhr) {
			var info = $(this).attr('data-tab');
			var object = info.split("/")[0];
			var operation = info.split("/")[1];
			console.log(info);
			if(object == 'movie')
			{
				if(operation == 'manage')
				{
					$(this).closest('.ui.tab.segment').children('.active.segment').html(response);
				}
			}
		}
	});
});
</script>
@endsection