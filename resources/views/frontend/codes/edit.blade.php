@extends('frontend.layouts.master')

@include('vendor.ueditor.assets')

@section('style')
<style type="text/css">
	.create-code
	{
		padding-top: 50px;
		margin-bottom: 100px;
		padding: 50px 50px;
	}
	.create-code .ui.segment {
		padding: 0px 50px 50px 50px;
	}
	.ui.code.header {
		font-family: "Comic Sans MS", cursive, sans-serif;
	}
	.field.error .ui.red.label {
		margin-left: 130px;
	}
	.ui.code.divider {
		margin-top: 20px;
		margin-bottom: 50px;
	}
	.ui.code.segment {
		padding: 40px;
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
	.row.field .ui.label {
		margin-top: 10px;
	}
</style>
@endsection
@section('content')
<div class="ui center aligned container create-code">
	<div class="ui raised code segment">

		<h2 class="ui center aligned code header">
			<i class="code icon"></i>
			Edit your code
		</h2>

		<div class="ui code divider"></div>

	{!! Form::open(['url' => route('codes.store', ['id' => $user->id]), 'method' => 'post', 'class' => 'ui centered form grid', 'id' => 'code_form', 'files' => true]) !!}
	{{ Form::token() }}

		<div class="row field">
			<label class="right floated right aligned two wide column">Header:</label>
			<div class="left floated left aligned fourteen wide column">
				<input type="text" name="header" placeholder="Input the code header" value="{{ $code->header }}">
			</div>
		</div>
		<div class="row field">
			<label class="right floated right aligned two wide column">Type:</label>
			<div class="left floated left aligned fourteen wide column">
				<select class="ui compact dropdown" name="type">
					<option value="原创" selected="selected">原创</option>
					<option value="转载">转载</option>
					<option value="翻译">翻译</option>
				</select>
			</div>
		</div>
		<div class="row field">
			<label class="right floated right aligned two wide column">Categories:</label>
			<div class="left floated left aligned fourteen wide column">
				<input id="categories" type="text" name="categories" placeholder="Input the code's categories, divide them with ," value="{{ $code->header }}">
			</div>
		</div>
		<div class="row field">
			<label class="right floated right aligned two wide column">Description:</label>
			<div class="left floated left aligned fourteen wide column">
				<textarea rows="3" name="description" placeholder="Input a code description">{{ $code->description }}</textarea>
			</div>
		</div>
		<div class="row field">
			<label class="right floated right aligned two wide column">Content:</label>
			<div class="left floated left aligned fourteen wide column">
				<script id="container" name="content" type="text/plain">
					{{ $code->content }}
				</script>
			</div>
		</div>
		<div class="row field">
			<div class="ui primary submit button">Submit</div>
		</div>
	{!! Form::close() !!}
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
	var ue = UE.getEditor('container');
    ue.ready(function() {
        ue.execCommand('serverparam', '_token', '{{ csrf_token() }}');
    });
	$('#categories').on('keyup', function() {
		var items = $(this).val().split(",");
		var content = "";
		for(var i = 0; i < items.length; ++i)
		{
			if(items[i].length <= 0) continue;
			content += "<div class='ui label'>" + items[i] + "</div>";
		}

		$(this).siblings().remove();
		$(this).parent().append(content);
	});
	$('#code_form').form({
		on: 'blur',
		inline: true,
		fields: {
			header: {
				rules: [
					{
						type: 'empty',
						prompt: "Please enter code's name."
					},
					{
						type: 'maxLength[40]',
						prompt: 'Max length of name should less than 40.'
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
			content: {
				rules: [
					{
						type: 'maxLength[100]',
						prompt: 'Max length of recommend should less than 100.'
					}
				]
			}
		}
	});
</script>
@endsection