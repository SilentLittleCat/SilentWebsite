@extends('frontend.layouts.master')
@section('style')
<style type="text/css">
	.ui.segment {
		margin: 0px;
		border-radius: 0px;
		padding-top: 88px;
	}
	.ui.text.shape .side {
		margin-top: 1em;
		font-size: 1.4em;
		text-align: center;
		font-style: italic;
		font-family: "Comic Sans MS", cursive, sans-serif;
	}
	.ui.text.shape {
		width: 100%;
	}
	.ui.text.container {
		margin-bottom: 6em;
	}
	.ui.text.container .ui.divider {
		margin-bottom: 45px;
		margin-top: 45px;
	}
	.ui.text.container .ui.first.divider{
		margin-top: 83px;
	}
	.ui.text.container .ui.divider:nth-child(2) {
		margin-top: 3.4em;
	}
	.ui.text.container .ui.pointing.menu .item:hover {
		background-color: #333;
	}
	.ui.reveal.image {
		width: 100px;
	}
</style>
@endsection
@section('content')
<div class="ui inverted vertical masthead segment">
	<div class="ui text inverted container">
		<div class="ui six item large secondary pointing menu">
			<a class="active red item" href="{{ url('u/' . $user->id . '/movies') }}">Movie</a>
			<a class="active orange item" href="{{ url('u/' . $user->id . '/codes') }}">Code</a>
			<a class="active olive item" href="{{ url('u/' . $user->id . '/photos') }}">Photo</a>
			<a class="active green item" href="{{ url('u/' . $user->id . '/articles') }}">Article</a>
			<a class="active violet item" href="{{ url('u/' . $user->id . '/music') }}">Music</a>
			<a class="active purple item" href="{{ url('u/' . $user->id . '/videos') }}">Video</a>
		</div>

		<h3 class="ui horizontal inverted divider hidden"></h3>

		<div class="ui small circular fade reveal centered image">
			<img src="{{ url($user->avatar) }}" class="visible content">
			<img src="{{ url($user->avatar_back) }}" class="hidden content">
		</div>

		<h3 class="ui horizontal inverted first divider">{{ $user->name }}</h3>

		<div class="ui text shape">
			<div class="sides">
				<div class="ui inverted center align header side active">
					{{ $user->moto }}
				</div>
				<div class="ui inverted center align header side">
					Hi boy! How can you find me?
				</div>
			</div>
		</div>

		<h3 class="ui inverted center align header">

		</h3>
		<h4 class="ui horizontal inverted divider">MOTO</h4>
	</div>
</div>
@endsection

@section('script')
<script type="text/javascript">
	$('.ui.text.shape').hover(function() {
		$(this).shape('flip over');
	}, function() {
		$(this).shape('flip back');
	});
</script>
@endsection