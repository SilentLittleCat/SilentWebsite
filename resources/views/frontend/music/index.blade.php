@extends('frontend.layouts.master')

@section('style')
<style type="text/css">
	#master-header {
		background-color: rgba(0, 0, 0, 0);
	}
	body {
		width: 100%;
		height: 100%;
		overflow: hidden;
	}
	#music {
		width: 100%;
		height: 100%;
		min-width: 1200px;
		overflow: hidden;
		position: absolute;
		color: rgb(200, 200, 200);
	}
	#music .bg-wrapper img {
		width: 100%;
		position: absolute;
		top: 0;
		left: 0;
	}
	.bg-wrapper .mask {
		width: 100%;
		height: 100%;
		background-color: rgba(10, 10, 10, 0.8);
		position: absolute;
		top: 0;
		left: 0;
	}
	.blur {
		filter: blur(50px);
		-ms-filter: blur(50px);
		-moz-filter: blur(50px);
		-webkit-filter: blur(50px);
	}
	#music .content {
		position: absolute;
		top: 100px;
		width: 90%;
		height: 100%;
		left: 5%;
		z-index: 200;
	}
	#music .content .left-content {
		float: left;
		width: 55%;
		min-width: 700px;
	}
	#music .content .left-content .ui.buttons {
		width: 100%;
	}
	#music .content .left-content .ui.button {
		background-color: rgba(0, 0, 0, 0);
		border: 1px solid rgba(255, 255, 255, .2);
		margin-left: 4px;
		color: rgb(200, 200, 200);
		width: 11%;
	}
	#music .content .left-content .ui.button:hover {
		border: 1px solid #ccc;
	}
	#music .content .left-content ul {
		padding: 0px;
		list-style-type: none;
		display: inline-block;
		width: 100%;
		text-align: center;
	}
	#music .content .left-content ul li {
		width: 100%;
	} 
	#music .content .left-content ul li input {
		width: 14px;
		height: 14px;
		opacity: 0;
	}
	#music .content .left-content ul li span:nth-child(1)
	{
		width: 14px;
		height: 14px;
		margin-left: 3%;
		border: 1px solid #ccc;
	}
	#music .content .left-content ul li span:nth-child(2)
	{
		width: 25%;
		text-align: left;
		padding-left: 50px;
	}
	#music .content .left-content ul li span:nth-child(3)
	{
		width: 25%;
		text-align: right;
		margin-top: -6px;
	}
	#music .content .left-content ul li span i {
		width: 20px;
		height: 20px;
		border: 1px solid #ccc;
		color: #ccc;
	}
	#music .content .left-content ul li span i:hover {
		border: 1px solid rgba(255, 255, 255, 1);
		color: #FFF;
	}
	#music .content .left-content ul li span:nth-child(4)
	{
		width: 25%;
	}
	#music .content .left-content ul li span {
		display: inline-block;
		float: left;
	}
	#music .ui.divider {
		padding: 2px 0;
		margin: 10px 0;
	}
	.song-list {
		overflow-x: hidden;
		overflow-y: scroll;
		height: 370px;
	}
	.song-list::-webkit-scrollbar {
		background-color: rgba(0, 0, 0, 0);
		width: 10px;
	}
	.song-list::-webkit-scrollbar-thumb {
		background-color: rgba(50, 50, 50, 0.5);
		border-radius: 10px;
	}
	.song-list .song-check.check {
		background-image: url('https://y.gtimg.cn/mediastyle/yqq/img/icon_sprite.png?max_age=2592000&v=3139b9b10089fcb0bf3725ac66b82a40');
		background-position: -60px -81px;
	}
	.song-list .song-title {
		margin: 0px;
	}
	.song-list .songs {
		margin: 0;
	}
	.song-list .songs li {
		border-bottom: 1px solid rgba(255, 255, 255, .2);
		height: 40px;
		padding: 10px 0;
	}
	.song-list .songs li:hover {
		color: #FFF;
	}
	.song-list .songs li span {
		left: 0;
	}
	#music .bottom-content {
		position: fixed;
		width: 90%;
		bottom: 5%;
		left: 8%;
	}
	.bottom-content div {
		display: inline-block;
	}
	.bottom-content .ui.buttons .button {
		background-color: rgba(0, 0, 0, 0);
		color: #FFF;
	}
	.bottom-content .ui.buttons i {
		font-size: 1.5em;
	}
	.bottom-content .ui.audio-control.buttons i {
		font-size: 1.7em;
	}
	.bottom-content .audio-progress {
		width: 35%;
		position: relative;
		cursor: pointer;
		-webkit-user-select: none;
	}
	.audio-progress .song-name {
		position: absolute;
		left: 0;
		top: -25px;
	}
	.audio-progress .point {
		width: 10px;
		height: 10px;
		margin-bottom: -4px;
		margin-left: 100%;
		border-radius: 5px;
		background-color: #FFF;
		position: absolute;
		left: 0;
		bottom: 0;
	}
	.audio-progress .song-time {
		position: absolute;
		right: 0;
		top: -25px;
	}
	.bottom-content .audio-progress .control-bar {
		width: 100%;
		height: 3px;
		left: 0;
		padding: 15px 0;
		bottom: 0;
		position: absolute;
	}
	.bottom-content .audio-progress .bar {
		width: 100%;
		height: 3px;
		margin-bottom: 0px;
		background-color: #FFF;
		left: 0;
		bottom: 0;
		position: absolute;
	}
	.bottom-content .audio-progress .up.bar {
		width: 100%;
		background-color: #AAA;
	}
	#music .right-content {
		position: absolute;
		width: 35%;
		right: 0;
		min-width: 400px;
	}
	#music .right-content .song-image img {
		width: 50%;
		margin-left: 25%;
	}
	#music .right-content .song-info ul {
		width: 50%;
		margin-left: 25%;
		list-style-type: none;
	}
	#music .right-content .song-lyric {
		width: 50%;
		margin-left: 25%;
		margin-top: 40px;
		color: #31c27c;
		text-align: center;
		height: 100px;
		overflow: hidden;
		-webkit-mask-image: linear-gradient(to bottom,rgba(255,255,255,0) 0,rgba(255,255,255,.6) 15%,rgba(255,255,255,1) 25%,rgba(255,255,255,1) 75%,rgba(255,255,255,.6) 85%,rgba(255,255,255,0) 100%);
	}
	.onDragging {
		cursor: pointer;
		-webkit-user-select: none;
	}
</style>
@endsection
@section('content')
<div id="music">
	<div class="content">
		<div class="left-content">
			<div class="ui buttons">
				<div class="ui button">
					<i class="heart icon"></i>收藏
				</div>
				<div class="ui button">
					<i class="plus square outline icon"></i>添加到
				</div>
				<div class="ui button">
					<i class="download icon"></i>下载
				</div>
				<div class="ui button">
					<i class="trash outline icon"></i>删除
				</div>
				<div class="ui button">
					<i class="erase icon"></i>清空列表
				</div>
			</div>
			<div class="ui divider"></div>
			<div class="song-list">
				<ul class="song-title">
					<li>
						<span class="song-check">
							<input type="checkbox" name="">
						</span>
						<span>歌曲</span>
						<span style="visibility: hidden;">操作</span>
						<span>歌手</span>
						<span>时长</span>
					</li>
				</ul>
				<div class="ui divider"></div>
				<ul class="songs">
				@foreach($songs as $song)
					<li data-src="{{ $song['url'] }}" data-img="{{ $song['img'] }}" data-name="{{ $song['name'] }}" data-author="{{ $song['author'] }}">
						<span class="song-check">
							<input type="checkbox" name="">
						</span>
						<span>{{ ($loop->index + 1) .  ' ' . $song['name'] }}</span>
						<span style="visibility: hidden;"><i class="circular play icon"></i></span>
						<span>{{ $song['author'] }}</span>
						<span>{{ $song['time'] }}</span>
					</li>
				@endforeach
				</ul>
			</div>
		</div>
		<div class="right-content">
			<div class="song-image">
				<img src="https://y.gtimg.cn/music/photo_new/T002R300x300M000001chqbE4XIqfR.jpg?max_age=2592000">
			</div>
			<div class="song-info">
				<ul>
					<li class="name">
						歌曲名：<span></span>
					</li>
					<li class="author">
						歌手名：<span></span>
					</li>
				</ul>
			</div>
			<div class="song-lyric">
				<div>
					<p>你我皆凡人 生在人世间</p>
					<p>终日奔波苦 一刻不得闲</p>
					<p>既然不是仙 难免有杂念</p>
					<p>道义放两边 利字摆中间</p>
				</div>
			</div>
		</div>
		<div class="bottom-content">
			<div class="ui audio-control buttons">
				<div class="ui button">
					<i class="step backward icon"></i>
				</div>
				<div class="ui play button">
					<i class="play icon"></i>
				</div>
				<div class="ui button">
					<i class="step forward icon"></i>
				</div>
			</div>
			<div class="audio-progress">
				<div class="song-name"></div>
				<div class="song-time"></div>
				<div class="control-bar">
					<div class="up bar"></div>
					<div class="drag bar"></div>
					<div class="point"></div>
				</div>
			</div>
			<div class="ui audio-set buttons">
				<div class="ui button">
					<i class="refresh icon"></i>循环
				</div>
				<div class="ui button">
					<i class="heart icon"></i>收藏
				</div>
				<div class="ui button">
					<i class="download icon"></i>下载
				</div>
				<div class="ui button">
					<i class="volume up icon"></i>音量
				</div>
			</div>
			<audio id="myAudio">
			</audio>
		</div>
	</div>
	<div class="bg-wrapper">
		<img class="blur" src="https://az616578.vo.msecnd.net/files/responsive/cover/main/desktop/2016/05/02/635977520242240689-2036849578_music-rainbow.jpg">
		<div class="mask"></div>
	</div>
</div>
@endsection

@section('script')
<script type="text/javascript">
$(function() {
	var mouseDown = false;
	var changeAudioTimer;
	var myAudio = document.getElementById("myAudio");
	var lyricOffset = 1;
	var isPause = false;

	function formatTime(time)
	{
		var minute = (time / 60).toFixed();
		var second = (time % 60).toFixed();
		minute = minute >= 10 ? minute.toString() : '0' + minute.toString();
		second = second >= 10 ? second.toString() : '0' + second.toString();
		return minute + ':' + second;
	}

	function changeAudioTime()
	{
		clearTimeout(changeAudioTimer);
		var time = formatTime(myAudio.currentTime);
		var duration = formatTime(myAudio.duration);
		var percent = myAudio.currentTime / myAudio.duration;
		var $this = $('.audio-progress .control-bar');
		$this.children('.drag.bar').css('width', percent * 100 + '%');
		$this.children('.point').css('marginLeft', percent * 100 + '%');
		$('.audio-progress .song-time').text(time + ' / ' + duration);
		changeAudioTimer = setTimeout(function() {
			return changeAudioTime();
		}, 1000);
		$('.song-lyric div').css('transform', 'translate3d(0px, ' + lyricOffset * -10 + 'px' + ', 0px)');
		lyricOffset++;
	}

	$('.song-list li:not(:first)').hover(function() {
		$(this).children('span').eq(2).css('visibility', 'visible');
	}, function() {
		$(this).children('span').eq(2).css('visibility', 'hidden');
	});
	$('.song-list').on('click', '.song-check', function() {
		$(this).toggleClass('check');
		$(this).parent().toggleClass('check-item');
	});
	$('.audio-progress .control-bar').mousedown(function() {
		mouseDown = true;
		$('body').addClass('onDragging');
	});
	$('body').mouseup(function() {
		mouseDown = false;
		$('body').removeClass('onDragging');
	}).mousemove(function() {
		if(mouseDown == true)
		{
			$this = $('.audio-progress .control-bar');
			var width = $this.width();
			var left = $this.offset().left;
			var mousePosition = event.pageX;
			var percent = (mousePosition - left) / width;
			percent = percent < 0 ? 0 : percent;
			percent = percent > 1 ? 1 : percent;
			console.log(percent * 100);
			$this.children('.drag.bar').css('width', percent * 100 + '%');
			$this.children('.point').css('marginLeft', percent * 100 + '%');
		}
	});

	$('.bottom-content').on('click', '.ui.play.button', function() {
		$(this).removeClass('play').addClass('pause');
		$(this).children().eq(0).removeClass('play').addClass('pause');

		var $song = $('.songs').children('.check-item').eq(0);
		if($song.length == 0)
		{
			$song = $('.songs').children().eq(0);
		}
		$('.audio-progress .song-name').text($song.attr('data-name'));
		if(!isPause || (myAudio.src != $song.attr('data-src')))
		{
			myAudio.src = $song.attr('data-src');
		}

		$('.right-content .song-image img').attr('src', $song.attr('data-img'));
		$('.right-content .song-info .name span').text($song.attr('data-name'));
		$('.right-content .song-info .author span').text($song.attr('data-author'));
		
		myAudio.play();
		changeAudioTimer = setTimeout(function() {
			return changeAudioTime();
		}, 1000);
	}).on('click', '.ui.pause.button', function() {
		$(this).removeClass('pause').addClass('play');
		$(this).children().eq(0).removeClass('pause').addClass('play');
		myAudio.pause();
		isPause = true;
		clearTimeout(changeAudioTimer);
	});
});
</script>
@endsection