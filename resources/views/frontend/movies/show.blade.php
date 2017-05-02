@extends('frontend.layouts.master')

@section('style')
<style type="text/css">
	.movie.content .ui.container {
		margin-top: 20px;
		margin-bottom: 100px;
	}
	.movie.content .ui.divider {
		margin-bottom: 50px;
	}
	.ui.card {
		width: 60%;
		word-break: break-all;
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
<div class="movie content">
	<div class="ui container">
		<div class="movie-header">
			<img class="ui small circular centered image" src="{{ url($user_avatar) }}">
		</div>
		<div class="ui horizontal divider">SilentGod's Movies</div>
		<div class="ui centered raised card">
			<div class="image">
				<img src="{{ url($movie->poster) }}">
			</div>
			<div class="content">
				<div class="ui centered grid">
					<div class="center aligned sixteen wide column">
						<h3>
							{{ $movie->name }}
						</h3>
					</div>
					<div class="row">
						<div class="right aligned three wide column">电影导演:</div>
						<div class="left aligned twelve wide column">
							{{ $movie->director }}
						</div>
					</div>
					<div class="row">
						<div class="right aligned three wide column">电影演员:</div>
						<div class="left aligned twelve wide column">
							{{ $movie->actors }}
						</div>
					</div>
					<div class="row">
						<div class="right aligned three wide column">电影简介:</div>
						<div class="left aligned twelve wide column">
							{{ $movie->description }}
						</div>
					</div>
					<div class="row">
						<div class="right aligned three wide column">电影推荐:</div>
						<div class="left aligned twelve wide column">
							{{ $movie->recommend }}
						</div>
					</div>
					<div class="row">
						<div class="right aligned three wide column">电影排行:</div>
						<div class="left aligned twelve wide column">
							{{ $movie->ranking }}
						</div>
					</div>
					<div class="row">
						<div class="right aligned three wide column">电影星级:</div>
						<div class="left aligned twelve wide column">
							<div class="ui heart rating" data-rating="{{ intval($movie->stars / 2) }}" data-max-rating="5"></div>
							<div class="ui red circular label">
								{{ $movie->stars }}
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="movie-kit">
	<a href="{{ route('movies.index', ['id' => $id]) }}">
		<i class="circular inverted red big home icon"></i>
	</a>
</div>
@endsection

@section('script')
<script type="text/javascript">
	$('.ui.rating').rating({
		maxRating: 5,
		interactive: false
	});
</script>
@endsection