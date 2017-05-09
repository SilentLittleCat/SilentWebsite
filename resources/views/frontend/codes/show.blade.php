@extends('frontend.layouts.master')

@include('vendor.ueditor.assets')

@section('style')
<style type="text/css">
	.code.content .ui.container {
		padding-top: 100px;
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
	.ui.comments .comment .avatar img {
		height: auto
	}
	.ui.comments {
		max-width: none !important;
	}
	.ui.code-top.comments .comment .comments {
		margin-left: 50px;
		margin-top: -30px;
		padding: 10px 20px;
	}
	.hidden {
		display: none;
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
		<div class="ui code-top comments raised code segment">
			<h3 class="ui dividing header">Comments</h3>
			@foreach($comments as $comment)
			<div class="comment">
				<a class="avatar" href="">
					<img src="{{ url($comment->user_avatar) }}">
				</a>
				<div class="content">
					<a class="author">{{ $comment->user_name }}</a>
					<div class="metadata">
						<span class="date">{{ $comment->updated_at }}</span>
					</div>
					<div class="text">
						{{ $comment->content }}
					</div>
					<div class="actions">
						<a class="reply reply-comment" href="" data-form-status="hidden">Reply</a>
						@if($comment->total_replies != 0)
						<a class="replies_open" data-id="{{ $comment->id }}" data-status="hidden" data-total="{{ $comment->total_replies }}">{{ $comment->total_replies }} replied</a>
						@endif
					</div>
					<div class="ui divider"></div>
				</div>
				<div class="comments ui segment hidden">
					<form class="ui reply form">
						<div class="field">
							<textarea></textarea>
						</div>
						<div class="ui primary submit labeled icon button">
      						<i class="icon edit"></i> Add Comment
    					</div>
					</form>
				</div>
			</div>
			@endforeach
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

	$('.ui.code-top.comments').on('click', '.replies_open', function() {
		$this = $(this);
		$comments = $this.closest('.comment').children('.comments');
		if($this.attr('data-status') == 'show')
		{
			$comments.addClass('hidden').children('.comment').remove();
			$this.attr('data-status', 'hidden');
			$this.text($this.attr('data-total') + '条评论');
			return true;
		}
		$comments.removeClass('hidden').addClass('loading');
		var path = "{{ route('comments.replies') }}";
		var formData = new FormData();
		var comment_id = $this.attr('data-id');
		formData.append('comment_id', comment_id);

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
				var replies = "";
				replies += "<h3 class='ui dividing header'>" + response.length + "条评论</h3>"
				for(iter in response)
				{
					replies += "<div class='comment'>";
					replies += "<a class='avatar'><img src='{!! url('" + response[iter].user_avatar + "') !!}'></a>";
					replies += "<div class='content'>";
					replies += "<a class='author'>" + response[iter].user_name + "</a>";
					if(response[iter].replied_comment_id != comment_id)
					{
						replies += "回复<a class='author'>" + response[iter].replied_user_name + "</a>";
					}
					replies += "<div class='metadata'><span class='date'>" + response[iter].updated_at + "</span></div>";
					replies += "<div class='text'>" + response[iter].content + "</div>";
					replies += "<div class='actions'><a class='reply'>Reply</a></div>";
					replies += "</div></div>";

					$this.attr('data-status', 'show');
					$this.text('收起评论');
				}
				$comments.removeClass('loading').prepend(replies);
			},
            error: function(jqXHR, status, error) {
            	console.log('error');
            	console.log(error);
            }
		});
	}).on('click', '.reply.reply-comment', function() {
		event.preventDefault();
		$this = $(this);
		var status = $this.attr('data-form-status');
		if(status == 'hidden')
		{
			$this.closest('.content').next().removeClass('hidden');
			$this.text('收起评论');
			$this.attr('data-form-status', 'show');
		}
		else if(status == 'show')
		{
			$this.closest('.content').next().addClass('hidden');
			$this.attr('data-form-status', 'hidden');
		}
	});
});
</script>
@endsection