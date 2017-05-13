@extends('frontend.layouts.master')

@section('style')
<style type="text/css">
	.test-content {
		top: 100px;
		position: relative;
		background-color: black;
	}
	.box-1 {
		background-color: #222;
		width: 100%;
		height: 300px;
		border-top: 60px green solid;
		border-left: 60px red solid;
		border-right: 60px blue solid;;
		border-bottom: 60px pink solid;
	}
	.box-1:after {
		position: absolute;
		left: 2%;
		right: auto;
		bottom: 60px;
		content: '';
		border-top: 60px green solid;
		border-left: red 20px solid;

	}
	.box-2 {
		background-color: #AAA;
		width: 100%;
		height: 100px;
	}
	.svg-test {
		width: 100%;
		height: 200px;
	}
	#someID {
		width: 500px;
		height: 500px;
		margin-left: 200px;
	}
</style>
@endsection
@section('content')
<div class="test-content">
	<svg id="someID">
	</svg>
	<svg version="1.1" class="grey" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="35px" height="37px" viewBox="0 0 35 37" enable-background="new 0 0 35 37" xml:space="preserve">
              <path fill="none" stroke="#d3d6de" stroke-width="2" stroke-miterlimit="10" d="M29.531,29.896l-8.252,4.803
                c-2.336,1.365-5.222,1.365-7.559,0l-8.249-4.803c-2.337-1.367-3.78-3.869-3.78-6.604v-9.589c0-2.72,1.443-5.235,3.78-6.602
                l8.249-4.801c2.337-1.367,5.223-1.367,7.559,0l8.252,4.801c2.335,1.367,3.778,3.868,3.778,6.602v9.589
                C33.31,26.027,31.866,28.543,29.531,29.896z" style="stroke-dashoffset: 106.067; stroke-dasharray: 106.067, 116.067;"></path>
              </svg>
<svg id="test" x="0px" y="0px" width="35px" height="37px" viewBox="0 0 35 37" enable-background="new 0 0 35 37" xml:space="preserve">
<path fill="none" stroke="#FF4C4E" stroke-width="2" stroke-miterlimit="10" d="M20.911,2.042l9.031,5.214
  c2.111,1.219,3.411,3.471,3.411,5.908v10.429c0,2.438-1.3,4.689-3.411,5.908l-9.031,5.214c-0.93,0.537-1.956,0.838-2.993,0.901
  c-1.314,0.081-2.648-0.22-3.829-0.901l-9.031-5.214c-2.111-1.219-3.411-3.471-3.411-5.908V13.165c0-2.437,1.3-4.689,3.411-5.908
  l9.031-5.214c1.056-0.609,2.233-0.914,3.411-0.914C18.678,1.129,19.856,1.434,20.911,2.042z" style="stroke-dashoffset: 50; stroke-dasharray: 106.433, 116.433;"></path>
              </svg>
</div>
@endsection

@section('script')
<script type="text/javascript">
	var s = Snap("#test");
	s.animate(0, 100, function(val) {
		
	});

</script>
@endsection