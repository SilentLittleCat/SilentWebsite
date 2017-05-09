@extends('frontend.layouts.master')

@section('style')
<style type="text/css">
	body {
		background-image: url('../../image/bg/bg.jpg');
		background-repeat: repeat-y;
		background-size: 100%;
		background-attachment: fixed;
	}
	.movie-content {
		padding-top: 80px;
		padding-bottom: 30px;
		background-color: rgba(150, 150, 150, 0.4);
	}
	.movie-content .ui.container {
		padding: 20px 0px;
	}
	.movie-content .ui.header {
		background-color: #DDD;
	}
	.movie-content .ui.divider {
		margin-bottom: 50px;
		margin-top: 30px;
	}
	.movie-cards .ui.grid .row {
		padding: 5px;
	}
	.movie-cards .ui.grid .row div {
		font-weight: bold;
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
	.movie-hidden-content {
		display: none;
	}
	.link-diabled.item {
		opacity: 0.45;
		pointer-events: none;
		cursor: default;
	}
	.ui.maximize.shape img {
		height: auto;
		width: 100%;
	}
	.ui.maximize.dimmer .ui.buttons {
		margin-top: 20px;
		width: 300px;
	}
	.ui.movie-search.dimmer .ui.search input {
		width: 800px;
	}
	.ui.movie-search.dimmer .ui.search .results {
		width: 70%;
		margin: 10px 15%;
	}
	.ui.movie-search.dimmer .ui.search {
		margin-top: -200px;
	}
</style>
@endsection
@section('content')
<div class="movie-content">
	<div class="ui container">
		<div class="movie-header">
			<img class="ui small circular centered image" src="{{ url($user->avatar) }}">
		</div>
		<div class="ui horizontal divider">{{ $user->name . "'s movies" }}</div>
		@if($style == 'grid')
		<div class="movie-cards">
			<div class="ui three stackable link cards">
				@foreach($movies as $movie)
				<div class="card">
					<div class="blurring dimmable image">
						<div class="ui dimmer">
							@if(Auth::check() && Auth::user()->id == $user->id)
							<div class="content">
								<div class="center">
									<div class="ui inverted edit button">
										<a href="{{ route('movies.edit', ['id' => $user->id, 'movie_id' => $movie->id]) }}">Edit</a>
									</div>
									<input class="movie-hidden-name" type="hidden" value="{{ $movie->name }}">
									<input class="movie-hidden-id" type="hidden" value="{{ $movie->id }}">
									<div class="movie-hidden-content">
										<div class="ui equal width centered grid container">
											<div class="right aligned column">
												<div class="ui medium rounded image">
													<img src="{{ url($movie->poster) }}">
												</div>
											</div>
											<div class="left aligned column">
												<div class="ui equal width center aligned grid">
													<div class="row">
														<div class="column">
															<h3>
																{{ $movie->name }}
															</h3>
														</div>
													</div>
													<div class="row">
														<div class="right aligned column">电影导演:</div>
														<div class="left aligned column">
															{{ $movie->director }}
														</div>
													</div>
													<div class="row">
														<div class="right aligned column">电影演员:</div>
														<div class="left aligned column">
															{{ $movie->actors }}
														</div>
													</div>
													<div class="row">
														<div class="column">
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
									<div class="ui inverted delete button">Delete</div>
									{!! Form::open(['url' => url()->current() . '/' . $movie->id, 'method' => 'delete']) !!}
										{{ Form::token() }}
									{!! Form::close() !!}
								</div>
							</div>
							@endif
						</div>	
						<img src="{{ url($movie->poster) }}">
					</div>
					<div class="content">
						<div class="ui center aligned grid">
							<div class="row">
								<div class="column">
									<a href="{{ route('movies.show', ['id' => $user->id, 'movie_id' => $movie->id]) }}">
										{{ $movie->name }}
									</a>
								</div>
							</div>
							<div class="row">
								<div class="six wide right aligned column">电影导演:</div>
								<div class="ten wide left aligned column">
									{{ $movie->director }}
								</div>
							</div>
							<div class="row">
								<div class="six wide right aligned column">电影演员:</div>
								<div class="ten wide left aligned column">
									{{ $movie->actors }}
								</div>
							</div>
						</div>
					</div>
					<div class="center aligned extra content">
						<div class="ui heart rating" data-rating="{{ intval($movie->stars / 2) }}" data-max-rating="5"></div>
						<div class="ui red circular label">
							{{ $movie->stars }}
						</div>
					</div>
				</div>
				@endforeach
			</div>
		</div>
		@elseif($style == 'list')
		<div class="ui segment">
			<table class="ui very basic compact striped center aligned movie table">
				<thead>
					<tr>
						<th>Name</th>
						<th>Director</th>
						<th>Actors</th>
						<th>Ranking</th>
						<th>Stars</th>
						@if(Auth::check() && Auth::user()->id == $user->id)
						<th>Operation</th>
						@endif
					</tr>
					<tbody>
						@foreach($movies as $movie)
						<tr>
							<td class="movie-table-name">
								<a href="{{ route('movies.show', ['id' => $user->id, 'movie_id' => $movie->id]) }}">
										{{ $movie->name }}
								</a>
							</td>
							<td>{{ $movie->director }}</td>
							<td>{{ $movie->actors }}</td>
							<td>{{ $movie->ranking }}</td>
							<td>{{ $movie->stars }}</td>
							@if(Auth::check() && Auth::user()->id == $user->id)
							<td>
								<a href="{{ route('movies.edit', ['id' => $user->id, 'movie_id' => $movie->id]) }}">Edit</a>
								<span>|</span>
								<a href="" class="delete-movie">Delete</a>
								{!! Form::open(['url' => url()->current() . '/' . $movie->id, 'method' => 'delete']) !!}
									{{ Form::token() }}
								{!! Form::close() !!}
							</td>
							@endif
						</tr>
						@endforeach
					</tbody>
				</thead>
			</table>
		</div>
		@endif
		{{ $movies->links() }}
	</div>
</div>
<div class="ui delete-movie modal">
	<div class="header"></div>
	<div class="image content"></div>
	<div class="actions">
		<div class="ui blue approve button">OK</div>
		<div class="ui black cancel button">Cancel</div>
	</div>
</div>
<div class="ui maximize page dimmer">
	<div class="content">
		<div class="center">
			<div class="ui one column centered gird">
				<div class="column">
					<div class="ui maximize shape">
						<div class="sides">
							@foreach($movies as $movie)
							<div class="{{ $loop->first ? 'active' : '' }} side">
								<div class="content">
									<div class="ui huge image">
										<img src="{{ url($movie->poster) }}">
									</div>
								</div>
							</div>
							@endforeach
						</div>
					</div>
				</div>
				<div class="column">
					<div class="ui icon large buttons">
						<div class="ui left button">
							<i class="chevron circle left icon"></i>
						</div>
						<div class="ui red close button">
							<i class="close icon"></i>
						</div>
						<div class="ui right button">
							<i class="chevron circle right icon"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="ui movie-search page dimmer">
	<div class="content">
		<div class="center">
			<div class="ui category search">
				<div class="ui icon input">
					<input class="prompt" type="text" name="Search movie">
					<i class="search icon"></i>
				</div>
				<div class="center aligned results"></div>
			</div>
		</div>
	</div>
</div>
<div class="movie-kit">
	<div class="ui right pointing dropdown">
		<i class="circular inverted red big settings icon"></i>
		<div class="menu">
			<div class="go-up item" data-tooltip="Go to top!" data-inverted="" data-position="left center">
				<i class="chevron up icon"></i>
			</div>
			@if(Auth::check() && Auth::user()->id == $user->id)
			<div class="add item" data-inverted="" data-tooltip="Add your movie" data-position="left center">
				<i class="plus icon"></i>
			</div>
			@endif
			<a class="grid-layout {{ $style == 'grid' ? 'link-diabled' : '' }} item" data-inverted="" data-tooltip="Grid layout" data-position="left center" href="{{ route('movies.index', ['id' => $user->id, 'style' => 'grid']) }}">
				<i class="grid layout icon"></i>
			</a>
			<a class="list-layout {{ $style == 'list' ? 'link-diabled' : '' }} item" data-inverted="" data-tooltip="List layout" data-position="left center" href="{{ route('movies.index', ['id' => $user->id, 'style' => 'list']) }}">
				<i class="list layout icon"></i>
			</a>
			<div class="maximize item" data-inverted="" data-tooltip="Maximize layout" data-position="left center">
				<i class="maximize icon"></i>
			</div>
			<a class="item" data-inverted="" data-tooltip="Home" data-position="left center" href="{{ route('welcome', ['id' => $user->id]) }}">
				<i class="home icon"></i>
			</a>
			<div class="search item" data-inverted="" data-tooltip="Search movie" data-position="left center">
				<i class="search icon"></i>
			</div>
		</div>
	</div>
</div>
@endsection

@section('script')
<script type="text/javascript">
	$('.movie-cards .image').dimmer({
		on: 'hover'
	});
	$('.movie-cards .ui.rating').rating({
		maxRating: 5,
		interactive: false
	});
	$('.ui.delete-movie.modal .ui.rating').rating({
		maxRating: 5,
		interactive: false
	});
	$('.ui.paginator.button').on('click', function() {
		window.location = window.location.pathname + '?page=' + $(this).prev().find("option:selected").val();
	});

	$('.movie-cards').on('click', '.ui.delete.button', function() {
		$('.ui.delete-movie.modal .header').text('你确定要删除' + $(event.target).siblings('.movie-hidden-name').val() + '?');
		$('.ui.delete-movie.modal .content').html($(event.target).siblings('.movie-hidden-content').html());
		$form = $(event.target).next();
		$('.ui.delete-movie.modal').modal({
			onApprove: function() {
				$form.submit();
			}
		}).modal('show');
	});
	$('.ui.movie.table').on('click', '.delete-movie', function() {
		event.preventDefault();
		$('.ui.delete-movie.modal .header').text('你确定要删除《' + $(event.target).parent().siblings('.movie-table-name').text() + '》吗?');
		$form = $(event.target).next();
		$('.ui.delete-movie.modal').modal({
			onApprove: function() {
				$form.submit();
			}
		}).modal('show');
	});

	$('.ui.maximize.shape').shape();

	$('.movie-kit').on('click', '.go-up.item', function() {
		$(window).scrollTo(0, 0);
	}).on('click', '.add.item', function() {
		window.location = window.location.pathname + '/create';
	}).on('click', '.maximize.item', function() {
		$('.ui.maximize.dimmer').dimmer('show');
	}).on('click', '.search.item', function() {
		$('.ui.movie-search.dimmer').dimmer('show');
	});

	$('.ui.maximize.dimmer').on('click', '.ui.left.button', function() {
		$('.ui.maximize.shape').shape('flip left');
	}).on('click', '.ui.right.button', function() {
		$('.ui.maximize.shape').shape('flip right');
	}).on('click', '.ui.close.button', function() {
		$('.ui.maximize.dimmer').dimmer('hide');
	});

	$('.ui.search').search({
		apiSettings: {
			url: "{{ route('movies.search', ['id' => $user->id]) }}" + "?key={query}"
		},
		fields: {
			results: 'items',
			title: 'name',
			url: 'url'
		},
		minCharacters: 3,
		onResults: function(response) {
			console.log(response);
		}
	});

	$('.ui.movie-search.dimmer').on('click', '.ui.search', function(event) {
		event.stopImmediatePropagation();
		console.log('1');
	}).on('click', function(event) {
		$('.ui.movie-search.dimmer').dimmer('hide');
	});
</script>
@endsection
