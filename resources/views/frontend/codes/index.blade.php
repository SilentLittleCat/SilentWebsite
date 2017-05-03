@extends('frontend.layouts.master')

@section('style')
<style type="text/css">
	body {
		background-image: url('../../image/bg/bg.jpg');
		background-repeat: repeat-y;
		background-size: 100%;
		background-attachment: fixed;
	}
	.code-content {
		background-color: rgba(200, 200, 200, 0.4);
		margin: 0px;
		padding: 0px;
	}
	.code-content .ui.container {
		padding: 20px 0px;
	}
	.code-content .ui.title.divider {
		margin-bottom: 40px;
		margin-top: 0px;
		font-size: 1.3em;
	}
	.ui.list .content .ui.header {
		font-size: 1.1em;
	}
	.ui.list .content .ui.header .date {
		font-weight: lighter;
		font-size: 0.8em;
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
	.code-hidden-content {
		display: none;
	}
	.link-diabled.item {
		opacity: 0.45;
		pointer-events: none;
		cursor: default;
	}
	.ui.code-search.dimmer .ui.search input {
		width: 800px;
	}
	.ui.code-search.dimmer .ui.search .results {
		width: 70%;
		margin: 10px 15%;
	}
	.ui.code-search.dimmer .ui.search {
		margin-top: -200px;
	}
	.code-content .ui.list .item .content a {
		display: inline;
	}
	.code-content .ui.segment {
		padding: 40px;
	}
	.code-content .ui.list .item .content .sub.header {
		font-weight: lighter;
		margin-top: 20px;
		margin-bottom: 20px;
	}
	.code-content .ui.list .ui.divider {
		margin-bottom: 20px;
		border-style: dashed;
		border-width: 1px 0px 0px 0px;
	}
	.ui.directory .date {
		float: right;
	}
	.ui.code.sidebar .item .menu .item .content {
		display: inline-block;
		width: 180px;
		overflow: hidden;
		white-space: nowrap;
		text-overflow: ellipsis;
	}
	.ui.code.sidebar .item .menu .item span {
		float: right;
	}
	.ui.code.sidebar .item .menu .item a:hover {
		color: white;
	}
</style>
@endsection

@section('content')
<div class="code-content">
	<div class="ui container">
		<div class="code-header">
			<img class="ui small circular centered image" src="{{ url($user->avatar) }}">
		</div>
		<div class="ui segment">
			<div class="ui horizontal title divider">{{ $user->name . "'s codes" }}</div>
			@if($style == 'abstract')
			<div class="ui relaxed list">
				@foreach($codes as $code)
				<div class="item">
					<div class="content">
						<div class="ui header">
							@if($code->type == 'original')
							<span class="ui horizontal green tag label">原创</span>
							@elseif($code->type == 'transport')
							<span class="ui horizontal tag label">转载</span>
							@elseif($code->type == 'translate')
							<span class="ui horizontal red tag label">翻译</span>
							@endif
							<a href="{{ route('codes.show', ['id' => $user->id, 'code_id' => $code->id]) }}" class="ui header">
								<span>{{ $code->header }}</span>
							</a>
							<div class="sub header">
								{{ $code->description }}
							</div>
						</div>
					</div>
					<div class="right floated content">
						<span class="date">{{ $code->updated_at }}</span>
						<i class="unhide icon"></i>
						阅读（{{ $code->reading_times }}）
						<i class="talk icon"></i>
						评论（{{ $code->reading_times }}）
						@if(Auth::user()->id == $user->id)
						<a href="{{ route('codes.edit', ['id' => $user->id, 'code_id' => $code->id]) }}">编辑</a>
						<a>删除</a>
						{!! Form::open(['url' => url()->current() . '/' . $code->id, 'method' => 'delete']) !!}
							{{ Form::token() }}
						{!! Form::close() !!}
						@endif
					</div>
				</div>
				<div class="ui divider"></div>
				@endforeach
			</div>
			@elseif($style == 'directory')
			<div class="ui relaxed list directory">
				@foreach($codes as $code)
				<div class="item">
					<div class="content">
						<div class="ui header">
							@if($code->type == 'original')
							<span class="ui horizontal green tag label">原创</span>
							@elseif($code->type == 'transport')
							<span class="ui horizontal tag label">转载</span>
							@elseif($code->type == 'translate')
							<span class="ui horizontal red tag label">翻译</span>
							@endif
							<a href="{{ route('codes.show', ['id' => $user->id, 'code_id' => $code->id]) }}" class="ui header">
								<span>{{ $code->header }}</span>
							</a>
							<span class="date">{{ $code->updated_at }}</span>
						</div>
					</div>
				</div>
				<div class="ui divider"></div>
				@endforeach
			</div>
			@endif
		</div>
		{{ $codes->links() }}
	</div>
</div>

<div class="ui code-search page dimmer">
	<div class="content">
		<div class="center">
			<div class="ui category search">
				<div class="ui icon input">
					<input class="prompt" type="text" name="Search code">
					<i class="search icon"></i>
				</div>
				<div class="center aligned results"></div>
			</div>
		</div>
	</div>
</div>

<div class="ui left vertical inverted code sidebar menu">
	<div class="header">
		<div class="ui hidden divider"></div>
		<img class="ui mini circular centered image" src="{{ url($user->avatar) }}">
		<div class="ui horizontal inverted divider">
			{{ Auth::user()->name }}
		</div>
	</div>
	<div class="item">
		<div class="header">文章分类</div>
		<div class="menu">
			@foreach($categories as $key => $value)
			<div class="item">
				<div class="content">
					<a href="{{ route('codes.index', ['id' => $user->id, 'category' => $key]) }}">{{ $key }}</a>
				</div>
				<span>{{ '(' . $value . ')' }}</span>
			</div>
			@endforeach
		</div>
	</div>
	<div class="item">
		<div class="header">阅读排行</div>
		<div class="menu">
			@foreach($reading_ranks as $item)
			<div class="item">
				<div class="content">
					<a href="">{{ $item['header'] }}</a>
				</div>
				<span>{{ '(' . $item['reading_times'] . ')' }}</span>
			</div>
			@endforeach
		</div>
	</div>
</div>

<div class="code-kit">
	<div class="ui right pointing dropdown">
		<i class="circular inverted red big settings icon"></i>
		<div class="menu">
			<div class="go-up item" data-tooltip="Go to top!" data-inverted="" data-position="left center">
				<i class="chevron up icon"></i>
			</div>
			@if(Auth::user()->id == $user->id)
			<div class="add item" data-inverted="" data-tooltip="Add your code" data-position="left center">
				<i class="plus icon"></i>
			</div>
			@endif
			<a class="abstract-layout {{ $style == 'abstract' ? 'link-diabled' : '' }} item" data-inverted="" data-tooltip="Abstract layout" data-position="left center" href="{{ route('codes.index', ['id' => $user->id, 'style' => 'abstract']) }}">
				<i class="indent icon"></i>
			</a>
			<a class="directory-layout {{ $style == 'directory' ? 'link-diabled' : '' }} item" data-inverted="" data-tooltip="Directory layout" data-position="left center" href="{{ route('codes.index', ['id' => $user->id, 'style' => 'directory']) }}">
				<i class="align justify icon"></i>
			</a>
			<a class="item" data-inverted="" data-tooltip="Home" data-position="left center" href="{{ route('welcome', ['id' => $user->id]) }}">
				<i class="home icon"></i>
			</a>
			<div class="code-menu item" data-inverted="" data-tooltip="Menu" data-position="left center">
				<i class="sidebar icon"></i>
			</div>
			<div class="search item" data-inverted="" data-tooltip="Search code" data-position="left center">
				<i class="search icon"></i>
			</div>
		</div>
	</div>
</div>
@endsection

@section('script')
<script type="text/javascript">
	$('.ui.paginator.button').on('click', function() {
		window.location = window.location.pathname + '?page=' + $(this).prev().find("option:selected").val();
	});

	$('.code-kit').on('click', '.go-up.item', function() {
		$(window).scrollTo(0, 0);
	}).on('click', '.add.item', function() {
		window.location = window.location.pathname + '/create';
	}).on('click', '.search.item', function() {
		$('.ui.code-search.dimmer').dimmer('show');
	}).on('click', '.code-menu.item', function() {
		$('.ui.code.sidebar').sidebar('toggle');
	});

	$('.ui.search').search({
		apiSettings: {
			url: "{{ route('codes.search', ['id' => $user->id]) }}" + '?key={query}&' + "{{ 'id=' . $user->id }}"
		},
		fields: {
			results: 'items',
			title: 'header',
			url: 'url'
		},
		minCharacters: 3,
		onResults: function(response) {
			console.log(response);
		}
	});

	$('.ui.code-search.dimmer').on('click', '.ui.search', function(event) {
		event.stopImmediatePropagation();
		console.log('1');
	}).on('click', function(event) {
		$('.ui.code-search.dimmer').dimmer('hide');
	});
</script>
@endsection
