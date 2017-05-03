@extends('frontend.layouts.master')

@include('vendor.ueditor.assets')

@section('style')
<style type="text/css">
	.code.content .ui.container {
		margin-top: 20px;
		margin-bottom: 100px;
	}
	.code.content .ui.divider {
		margin-bottom: 50px;
	}
	.ui.card {
		width: 60%;
		word-break: break-all;
	}
	.code-kit {
		position: fixed;
		right: 30px;
		bottom: 100px;
		transition: bottom 0.3s;
		-webkit-transition: bottom 0.3s;
	}
	.code-kit:hover {
		bottom: 95px;
	}
	.ui.code.segment {
		padding: 20px 50px;
	}
</style>
@endsection

@section('content')
<div class="code content">
	<div class="ui container">
		<div class="code-header">
			<img class="ui small circular centered image" src="{{ url($user->avatar) }}">
		</div>
		<div class="ui horizontal divider">{{ $user->name . "'s codes" }}</div>
		<div class="ui raised code segment">
			<h3 class="ui centered header">
				{{ $code->header }}
			</h3>
			<div class="ui divider"></div>
			{!! $code->content !!}
		</div>
	</div>
</div>
<div class="code-kit">
	<a href="{{ route('codes.index', ['id' => $user->id]) }}">
		<i class="circular inverted red big home icon"></i>
	</a>
</div>
@endsection

@section('script')
<script type="text/javascript">
$(function() {
	SyntaxHighlighter.all();
});
</script>
@endsection