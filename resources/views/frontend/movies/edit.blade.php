@extends('frontend.layouts.master')

@section('style')
<style type="text/css">
	.create-movie
	{
		margin-bottom: 150px;
		padding: 100px 50px;
	}
	.create-movie .ui.segment {
		padding: 0px 50px 50px 50px;
	}
	.ui.movie.header {
		font-family: "Comic Sans MS", cursive, sans-serif;
	}
	.field.error .ui.red.label {
		margin-left: 130px;
	}
	.ui.movie.divider {
		margin-top: 20px;
		margin-bottom: 50px;
	}
	.ui.movie.segment {
		padding: 40px;
	}
	.ui.movie.modal {
		top: 300px;
	}
	.ui.movie.modal .image.content {
		height: 300px;
		overflow: hidden;
		padding: 0px;
	}
	#previewImage {
		padding: 30px;
	}
	.movie-kit {
		position: fixed;
		right: 30px;
		bottom: 100px;
		transition: bottom 0.3s;
		-webkit-transition: bottom 0.3s;
	}
	.movie-kit:hover {
		bottom: 95px;
	}
</style>
@endsection
@section('content')
<div class="ui center aligned container create-movie">
	<div class="ui raised movie segment">

		<h2 class="ui center aligned movie header">
			<i class="film icon"></i>
			Edit your movie
		</h2>

		<div class="ui movie divider"></div>

	{!! Form::open(['url' => route('movies.update', ['id' => $user->id, 'movie_id' => $movie->id]), 'method' => 'put', 'class' => 'ui centered form grid', 'id' => 'movie_form', 'files' => true]) !!}
	{{ Form::token() }}

		<div class="row field">
			<label class="right floated right aligned two wide column">Name:</label>
			<div class="left floated left aligned fourteen wide column">
				<input type="text" name="name" placeholder="Input the movie name" value="{{ $movie->name }}">
			</div>
		</div>
		<div class="row field">
			<label class="right floated right aligned two wide column">Director:</label>
			<div class="left floated left aligned fourteen wide column">
				<input type="text" name="director" placeholder="Input the movie's director" value="{{ $movie->director }}">
			</div>
		</div>
		<div class="row field">
			<label class="right floated right aligned two wide column">Actors:</label>
			<div class="left floated left aligned fourteen wide column">
				<input type="text" name="actors" placeholder="Input movie's actors" value="{{ $movie->actors }}">
			</div>
		</div>
		<div class="row field">
			<label class="right floated right aligned two wide column">Poster:</label>
			<div class="left floated left aligned fourteen wide column">
				<input type="file" name="poster" id="poster" onchange="return moviePosterUpdate();" value="{{ $movie->poster }}">
				<input type="hidden" name="crop-poster" id="crop-poster">
			</div>
		</div>
		<div class="row field">
			<label class="right floated right aligned two wide column">Preview:</label>
			<div class="left floated left aligned fourteen wide column">
				<div class="ui padded center aligned segment" id="previewImage">
					@if(isset($movie->poster) and !is_null($movie->poster))
					<img src="{{ url($movie->poster) }}" class="ui centered image">
					@endif
				</div>
			</div>
		</div>
		<div class="row field">
			<label class="right floated right aligned two wide column">Description:</label>
			<div class="left floated left aligned fourteen wide column">
				<textarea rows="3" name="description" placeholder="Input a movie description">{{ $movie->description }}</textarea>
			</div>
		</div>
		<div class="row field">
			<label class="right floated right aligned two wide column">Recommend:</label>
			<div class="left floated left aligned fourteen wide column">
				<textarea rows="3" name="recommend" placeholder="Input a movie recommend">{{ $movie->recommend }}</textarea>
			</div>
		</div>
		<div class="row field">
			<label class="right floated right aligned two wide column">Ranking:</label>
			<div class="left floated left aligned fourteen wide column">
				<input type="number" name="ranking" placeholder="Input a movie ranking" value="{{ $movie->ranking }}">
			</div>
		</div>
		<div class="row field">
			<label class="right floated right aligned two wide column">Stars:</label>
			<div class="left floated left aligned fourteen wide column">
				<input type="number" name="stars" class="column" placeholder="Input a movie stars" value="{{ $movie->stars }}">
			</div>
		</div>
		<div class="row field">
			<div class="ui primary submit button">Submit</div>
			<div class="ui button">
				<a href="{{ route('movies.index', ['id' => $user->id]) }}">Cancel</a>
			</div>
		</div>
	{!! Form::close() !!}
	</div>
</div>
<div class="ui movie modal">
	<div class="header">Cropper your image</div>
	<div class="image content"></div>
	<div class="actions">
		<div class="ui approve button">Approve</div>
	</div>
</div>
<div class="movie-kit">
	<a href="{{ route('movies.index', ['id' => $user->id]) }}">
		<i class="circular inverted red big home icon"></i>
	</a>
</div>
@endsection

@section('script')
<script type="text/javascript">
	$('.ui.rating').rating();
	$('#test').bind('onchange', function() {
		console.log('niha');
	});
	
	function moviePosterUpdate()
	{
		var $this = $(event.target);
		var $parent = $this.closest('.field');
		var path = "{{ route('api.ajax.crop-movie-poster') }}";

		var formData = new FormData();
		var poster = $('#poster')[0].files[0];
		formData.append('poster', poster);
		formData.append('path', $('#crop-poster').val());

		$parent.removeClass('error');
      	$parent.children('.ui.red.prompt.label').remove();

		$.ajax({
			type: 'POST',
			url: path,
			headers: {
	        	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    	},
			data: formData,
			processData: false,
			contentType: false,
      		success: function(response) {
      			if(response.poster !== undefined)
      			{
      				var message = "<div class='ui basic red pointing prompt label transition visible'>" + response.poster[0] + "</div>";
      				$parent.addClass('error').append(message);
      			}
      			else
      			{
      				var content = "<img src={!! url('" + response.path + "') !!}>";
      				$('.ui.movie.modal .content').empty();
      				
      				$('.ui.movie.modal .content').append(content);
      				var image = $('.ui.movie.modal .content img')[0];
      				var cropper = new Cropper(image, {
      					aspectRatio: 2 / 1,
      				});
      				$('.ui.movie.modal')
      				.modal({
      					closable: false,
      					onApprove: function() {
      						cropper.getCroppedCanvas().toBlob(function(blob) {
      							var formData = new FormData();
      							formData.append('croppedImage', blob);
      							formData.append('path', response.path);

      							$.ajax({
									type: 'POST',
									url: path,
									headers: {
							        	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
							    	},
									data: formData,
									processData: false,
									contentType: false,
									success: function(response) {
										var content = "<img src={!! url('" + response.path + "') !!} class='ui centered image'>";
      									$('#previewImage').empty().append(content);
      									$('#crop-poster').val(response.path);
										console.log('wath');
									},
									error: function(jqXHR, status, error) {
										console.log('no');
									}
      							});
      						});
      					}
      				})
      				.modal('show');
      			}
      		},
            error: function(jqXHR, status, error) {
            	console.log(error);
            }
		});
	}

	$('#movie_form').form({
		on: 'blur',
		inline: true,
		fields: {
			name: {
				rules: [
					{
						type: 'empty',
						prompt: "Please enter movie's name."
					},
					{
						type: 'maxLength[40]',
						prompt: 'Max length of name should less than 40.'
					}
				]
			},
			director: {
				rules: [
					{
						type: 'maxLength[40]',
						prompt: 'Max length of director should less than 40.'
					}
				]
			},
			actor: {
				rules: [
					{
						type: 'maxLength[40]',
						prompt: 'Max length of actor should less than 40.'
					}
				]
			},
			description: {
				rules: [
					{
						type: 'maxLength[100]',
						prompt: 'Max length of description should less than 100.'
					}
				]
			},
			recommend: {
				rules: [
					{
						type: 'maxLength[100]',
						prompt: 'Max length of recommend should less than 100.'
					}
				]
			},
			ranking: {
				rules: [
					{
						type: 'integer[1..10000]',
						prompt: 'Ranking should be between 1 and 10000.'
					}
				]
			},
			stars: {
				rules: [
					{
						type: 'regExp',
						value: '/(^[0-9]\\.[0-9]$)|(^0$)|(^10$)|(^10\\.0$)|(^\\d$)/i',
						prompt: 'Ranking should be between 0.0 and 10.0'
					}
				]
			},
		}
	});
</script>
@endsection