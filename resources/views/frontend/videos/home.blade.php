@extends('frontend.layouts.master')

@section('style')
<style type="text/css">
	#home-content {
		position: absolute;
		padding: 0px;
		margin: 0px;
		overflow: hidden;
		width: 100%;
		height: 100%;
		text-align: center;
	}
	#home-content .section h3 {
		position: absolute;
		top: 40%;
		left: 30%;
		width: 40%;
		letter-spacing: 4px;
		color: white;
		font-size: 4em;
	}
	#home-content .btn-bg {
		position: absolute;
		bottom: 30%;
		left: 50%;
		width: 280px;
		height: 60px;
		margin-left: -140px;
		transition: all 0.3s ease;
		transform: scale(0, 1.1);
	}
	#home-content .btn-bg.animate {
		transform: scale(1.1, 1.1);
	}
	#home-content .discover {
		width: 280px;
		height: 60px;
		color: black;
		background-color: black;
	}
	#home-content .discover:hover {
		color: #fb724d;
		background-color: black;
	}
	.section .discover strong {
		position: absolute;
		bottom: 30%;
		left: 50%;
		z-index: 100;
		line-height: 60px;
		margin-left: -140px;
		width: 280px;
		height: 60px;
		font-family: sans-serif;
		letter-spacing: 1px;
	}
	.discover svg {
		z-index: 90;
	}
	#home-content .bg-wrapper video {
		top: 0px;
		left: 0px;
		width: 100%;
		height: 100%;
	}
	#home-content .bg-wrapper {
		transform: scale(1.1, 1.1);
		transition: all 0.3s ease-out;
	}
	#home-content .bg-wrapper.video-animate {
		transform: scale(1, 1);
	}
	#main-nav {
		position: fixed;
		bottom: 0;
		left: 0;
		width: 100%;
		height: 80px;
		display: block;
		background-color: white;
		color: #6e737f;
		margin: 0px;
		padding: 0px;
		z-index: 200;
	}
	#main-nav .nav-content {
		margin: 0;
		padding: 0;
		position: absolute;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		float: left;
		display: block;
	}
	#main-nav .nav-content strong {
		line-height: 80px;
		display: inline-block;
		margin: 0px 30px;
		position: static;
		float: left;
	}
	#main-nav svg {
		position: absolute;
		top: 0;
		padding: 21px 20px;
		position: relative;
		display: block;
	}
	#main-nav ul {
		list-style-type: none;
		display: inline-block;
		height: 100%;
		width: calc(100% - 130px);
		max-width: 500px;
		text-align: center;
		margin: 0;
		padding: 0;
		float: left;
		padding-top: 21px;
	}
	#main-nav ul li {
		width: 10%;
		height: 100%;
		display: inline-block;
		width: 15%;
		height: 38px;
	}
	#main-nav ul li .shape {
		width: 100%;
		height: 100%;
		z-index: 0;
		position: absolute;
	}
	#main-nav ul li .shape svg {
		padding: 0;
		margin: 0;
		width: 100%;
		height: 100%;
		position: absolute;
		top: 0;
		left: 0;
	}
	#main-nav ul li a {
		display: inline-block;
		position: relative;
		color: #6e737f;
		margin: 0 auto;
		width: 36px;
		height: 38px;
		text-align: center;
		line-height: 38px;
	}
	#main-nav ul li a:hover {
		color: #fb724d;
	}

</style>
@endsection

@section('content')
<div id="home-content">
	<div class="section" data-order="1">
		<h3>HEADER 1</h3>
		<a href="#" class="discover">
			<strong>DISCOVER PART 1</strong>
			<svg class="btn-bg" x="0px" y="0px"
				 width="280px" height="60px" viewBox="0 0 280 60" enable-background="new 0 0 280 60" xml:space="preserve">
				<path fill="#FFFFFF" d="M27.138,55.5c-3.3,0-7.35-2.338-9-5.196L9.415,35.196c-1.65-2.858-1.65-7.534,0-10.392l8.722-15.108
					c1.65-2.858,5.7-5.196,9-5.196h225.445c3.3,0,7.35,2.338,9,5.196l8.722,15.108c1.65,2.858,1.65,7.534,0,10.392l-8.722,15.108
					c-1.65,2.858-5.7,5.196-9,5.196H27.138z"/>
			</svg>
		</a>
		<div class="bg-wrapper">
			<video preload="metadata" src="http://cdn.iceandsky.com/2015/04/PI-01_A_Charcot_Bateau-Globe_sans-son_EN.mp4"></video>
		</div>
	</div>
	<div class="section" data-order="2">
		<h3>HEADER 2</h3>
		<a href="#" class="discover">
			<strong>DISCOVER PART 2</strong>
			<svg class="btn-bg" x="0px" y="0px"
				 width="280px" height="60px" viewBox="0 0 280 60" enable-background="new 0 0 280 60" xml:space="preserve">
				<path fill="#FFFFFF" d="M27.138,55.5c-3.3,0-7.35-2.338-9-5.196L9.415,35.196c-1.65-2.858-1.65-7.534,0-10.392l8.722-15.108
					c1.65-2.858,5.7-5.196,9-5.196h225.445c3.3,0,7.35,2.338,9,5.196l8.722,15.108c1.65,2.858,1.65,7.534,0,10.392l-8.722,15.108
					c-1.65,2.858-5.7,5.196-9,5.196H27.138z"/>
			</svg>
		</a>
		<div class="bg-wrapper">
			<video preload="metadata" src="http://cdn.iceandsky.com/2015/04/PI-03_A_Vostok_mammouth_sans-son-sans-fondu_EN.mp4"></video>
		</div>
	</div>
	<div class="section" data-order="3">
		<h3>HEADER 3</h3>
		<a href="#" class="discover">
			<strong>DISCOVER PART 3</strong>
			<svg class="btn-bg" x="0px" y="0px"
				 width="280px" height="60px" viewBox="0 0 280 60" enable-background="new 0 0 280 60" xml:space="preserve">
				<path fill="#FFFFFF" d="M27.138,55.5c-3.3,0-7.35-2.338-9-5.196L9.415,35.196c-1.65-2.858-1.65-7.534,0-10.392l8.722-15.108
					c1.65-2.858,5.7-5.196,9-5.196h225.445c3.3,0,7.35,2.338,9,5.196l8.722,15.108c1.65,2.858,1.65,7.534,0,10.392l-8.722,15.108
					c-1.65,2.858-5.7,5.196-9,5.196H27.138z"/>
			</svg>
		</a>
		<div class="bg-wrapper">
			<video preload="metadata" src="http://cdn.iceandsky.com/2015/02/PI-03_A_Vostok_Bulles-labo_sans-son.mp4"></video>
		</div>
	</div>
	<div class="section" data-order="4">
		<h3>HEADER 4</h3>
		<a href="#" class="discover">
			<strong>DISCOVER PART 4</strong>
			<svg class="btn-bg" x="0px" y="0px"
				 width="280px" height="60px" viewBox="0 0 280 60" enable-background="new 0 0 280 60" xml:space="preserve">
				<path fill="#FFFFFF" d="M27.138,55.5c-3.3,0-7.35-2.338-9-5.196L9.415,35.196c-1.65-2.858-1.65-7.534,0-10.392l8.722-15.108
					c1.65-2.858,5.7-5.196,9-5.196h225.445c3.3,0,7.35,2.338,9,5.196l8.722,15.108c1.65,2.858,1.65,7.534,0,10.392l-8.722,15.108
					c-1.65,2.858-5.7,5.196-9,5.196H27.138z"/>
			</svg>
		</a>
		<div class="bg-wrapper">
			<video preload="metadata" src="http://cdn.iceandsky.com/2015/04/PI-06_P_RC_Effet-serre_naturel_sans-son_EN.mp4"></video>
		</div>
	</div>
	<div class="section" data-order="5">
		<h3>HEADER 5</h3>
		<a href="#" class="discover">
			<strong>DISCOVER PART 5</strong>
			<svg class="btn-bg" x="0px" y="0px"
				 width="280px" height="60px" viewBox="0 0 280 60" enable-background="new 0 0 280 60" xml:space="preserve">
				<path fill="#FFFFFF" d="M27.138,55.5c-3.3,0-7.35-2.338-9-5.196L9.415,35.196c-1.65-2.858-1.65-7.534,0-10.392l8.722-15.108
					c1.65-2.858,5.7-5.196,9-5.196h225.445c3.3,0,7.35,2.338,9,5.196l8.722,15.108c1.65,2.858,1.65,7.534,0,10.392l-8.722,15.108
					c-1.65,2.858-5.7,5.196-9,5.196H27.138z"/>
			</svg>
		</a>
		<div class="bg-wrapper">
			<video preload="metadata" src="http://cdn.iceandsky.com/2015/03/PII-11_P_Coraux_sans-son.mp4"></video>
		</div>
	</div>
	<div class="section" data-order="6">
		<h3>HEADER 6</h3>
		<a href="#" class="discover">
			<strong>DISCOVER PART 6</strong>
			<svg class="btn-bg" x="0px" y="0px"
				 width="280px" height="60px" viewBox="0 0 280 60" enable-background="new 0 0 280 60" xml:space="preserve">
				<path fill="#FFFFFF" d="M27.138,55.5c-3.3,0-7.35-2.338-9-5.196L9.415,35.196c-1.65-2.858-1.65-7.534,0-10.392l8.722-15.108
					c1.65-2.858,5.7-5.196,9-5.196h225.445c3.3,0,7.35,2.338,9,5.196l8.722,15.108c1.65,2.858,1.65,7.534,0,10.392l-8.722,15.108
					c-1.65,2.858-5.7,5.196-9,5.196H27.138z"/>
			</svg>
		</a>
		<div class="bg-wrapper">
			<video preload="metadata" src="http://cdn.iceandsky.com/2015/03/intro_061.mp4"></video>
		</div>
	</div>
	<div id="main-nav">
		<div class="nav-content">
			<strong>PARTS</strong>
			<ul>
			@for($i = 1; $i <= 6; ++$i)
				<li>
					<a href="#" data-order="{{ $i }}">
						<div class="shape">
							<svg x="0px" y="0px" width="35px" height="37px" viewBox="0 0 35 37" enable-background="new 0 0 35 37" xml:space="preserve">
	              				<path fill="none" stroke="#d3d6de" stroke-width="2" stroke-miterlimit="10" d="M29.531,29.896l-8.252,4.803
	                			c-2.336,1.365-5.222,1.365-7.559,0l-8.249-4.803c-2.337-1.367-3.78-3.869-3.78-6.604v-9.589c0-2.72,1.443-5.235,3.78-6.602
	                			l8.249-4.801c2.337-1.367,5.223-1.367,7.559,0l8.252,4.801c2.335,1.367,3.778,3.868,3.778,6.602v9.589
	                			C33.31,26.027,31.866,28.543,29.531,29.896z" style="stroke-dashoffset: 1; stroke-dasharray: 106.067, 116.067;"></path>
	              			</svg>
							<svg class="orange-svg" x="0px" y="0px" width="35px" height="37px" viewBox="0 0 35 37" enable-background="new 0 0 35 37" xml:space="preserve">
								<path fill="none" stroke="#FF4C4E" stroke-width="2" stroke-miterlimit="10" d="M20.911,2.042l9.031,5.214
	  							c2.111,1.219,3.411,3.471,3.411,5.908v10.429c0,2.438-1.3,4.689-3.411,5.908l-9.031,5.214c-0.93,0.537-1.956,0.838-2.993,0.901
	  							c-1.314,0.081-2.648-0.22-3.829-0.901l-9.031-5.214c-2.111-1.219-3.411-3.471-3.411-5.908V13.165c0-2.437,1.3-4.689,3.411-5.908
	  							l9.031-5.214c1.056-0.609,2.233-0.914,3.411-0.914C18.678,1.129,19.856,1.434,20.911,2.042z" style="stroke-dashoffset: 106.433; stroke-dasharray: 106.433, 116.433;"></path>
	              			</svg>
						</div>
						<span>{{ $i }}</span>
					</a>
				</li>
			@endfor
			</ul>
		</div>
	</div>
</div>
@endsection

@section('script')
<script type="text/javascript">
$(function() {
	var animateId, animateNum;
	function myAnimateStart(sec)
	{
		clearInterval(animateId);
		console.log(animateNum);
		if(animateNum > 6)
		{
			animateNum = 1;
		}
		console.log(animateNum);
		$('.section').removeClass('on').hide();
		$('.section').eq(animateNum - 1).addClass('on').show();

		var $target = $('.section.on');

		$('.section .bg-wrapper').removeClass('video-animate');
		$('.section .btn-bg').removeClass('animate');
		$('.section.on .btn-bg').addClass('animate');
		$('.section.on strong').hide().show(300);
		$target.children('.bg-wrapper').addClass('video-animate');
		$('.section .bg-wrapper.video-animate video')[0].play();
		$('#main-nav .orange-svg path').stop();
		$('#main-nav .orange-svg path').stop().animate({
			'strokeDashoffset': 106.433
		}, 100);
		$('#main-nav .shape').eq(animateNum - 1).find('.orange-svg path').animate({
			'strokeDashoffset': 0
		}, sec);
		animateNum = Number(animateNum) + 1;
		animateId = setTimeout(function() {
			return myAnimateStart(sec)
		}, 5000);
	}

	animateNum = 1;
	myAnimateStart(5000);

	$('#main-nav .shape').hover(function() {
		var hoverNumber = $(this).next().text();
		animateNum = hoverNumber;
		myAnimateStart(5000);
	}, function() {});
});
</script>
@endsection