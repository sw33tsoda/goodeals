<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>GooDeals</title>
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
	
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script src="/vendor/unisharp/laravel-ckeditor/adapters/jquery.js"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
    <!-- <script src="{{URL::asset('js\jquery-ui-1.12.1\jquery-ui.js')}}"></script>
    <link rel="stylesheet" href="{{URL::asset('js\jquery-ui-1.12.1\jquery-ui.css')}}"> -->
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<!-- <script src="{{URL::asset('custom/slicknav/jquery.slicknav.min.js')}}"></script>
    <link rel="stylesheet" href="{{URL::asset('custom/slicknav/slicknav.css')}}"> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

	<!-- IndexCSS -->
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/index.css') }}">

</head>

<body>
	<nav class="navbar navbar-expand-xl navbar-dark nav-bar-custom">
	    <a id="title" class="navbar-brand" href="{{route('index_view')}}">GooDeals</a>
	    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContentXL" aria-controls="navbarSupportedContentXL" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="navbar-toggler-icon"></span>
	    </button>

	    <div class="collapse navbar-collapse" id="navbarSupportedContentXL">
	        <ul class="navbar-nav mr-auto">
	            <li class="nav-item">
	                <a class="nav-link @yield('announce-active')" href="{{route('post_view')}}">THÔNG BÁO</a>
	            </li>
	            <li class="nav-item">
	                <a class="nav-link @yield('store-active')" href="{{route('store_view')}}">CỬA HÀNG</a>
	            </li>
	            <li class="nav-item">
	                <a class="nav-link @yield('cart-active')" href="{{route('cart_view')}}">GIỎ HÀNG</a>
	            </li>
	            <li class="nav-item">
	                <a class="nav-link" href="#" data-toggle="modal" data-target="#search">TÌM KIẾM</a>
	            </li>
	            <div class="modal" id="search">
				  <div class="modal-dialog modal-lg ">
				    <div class="modal-content modal-content-custom">
				      <!-- Modal body -->
				      <div class="modal-body">
				      	<input type="text" id="search" name="search" class="search" placeholder="BẠN MUỐN TÌM GÌ?" autocomplete="off">
				      </div>
				      <div class="modal-result">
				      	
				      </div>
				    </div>
				  </div>
				</div>
	        </ul>

	        <script type="text/javascript">

	        	$('#search').on('keypress',function(key){
	        		if(key.which == 13) {
	        			let keywords = encodeURIComponent($("[name='search']").val());
						$('.modal-result').load("{{route('search')}}"+"?search=" + keywords);
	        		}
	        	});
	        </script>

			<div class="navbar-nav">
				@if (Auth::check())
					<button type="button" class="btn btn-custom" data-toggle="modal" data-target="#user">
						@if (Auth::user()->avatar == 'to_be_uploaded')
							<img class="rounded-circle" src="{{url('/img/')}}/no_avatar.png" style="width:30px;height: 30px;">
						@else
							<img class="rounded-circle" src="/storage/uploads/avatar_images/{{Auth::user()->avatar}}" class="media-object" style="width:30px;height: 30px;">
						@endif
						<span class="user-name">{{Auth::user()->name}}</span>
						@if (Auth::user()->role == 'admin')
							<small>(Admin)</small>
						@else
							<small>(User)</small>
						@endif
						<span class="vnd">{{number_format(Auth::user()->balance)}} VNĐ</span>
					</button>
					<div class="modal" id="user">
					  <div class="modal-dialog modal-sm">
					    <div class="modal-content modal-custom">
					      <!-- Modal Header -->
					      <div class="modal-header" style="border:0">

					      </div>
					      <!-- Modal body -->
					      <div class="modal-body modal-body-custom">
					      		<a href="{{route('yourOrders_view')}}" class="btn btn-custom">
								  TRẠNG THÁI GIAO HÀNG
								</a>
						        <a href="{{route('setting_view')}}" class="btn btn-custom">
								  CÀI ĐẶT
								</a>
								<a href="{{route('logout')}}" class="btn btn-custom" onclick="event.preventDefault();document.getElementById('logout').submit();">
								  ĐĂNG XUẤT
								</a>
								<form id="logout" method="POST" action="{{route('logout')}}">
						      		@csrf
								</form>
					      </div>
					      <!-- Modal footer -->
					      <div class="modal-footer" style="border:0">
					      	<a href="#">Quên mật khẩu ?</a>
					        <button type="button" class="btn btn-custom" data-dismiss="modal">Close</button>
					      </div>
					    </div>
					  </div>
					</div>
				@else
					<a class="btn btn-custom" href="{{route('login_view')}}">
					  ĐĂNG NHẬP
					</a>
				@endif
			</div>
	    </div>
	</nav>

<!-- 	<div id="nav" class="container-fluid">
		<a href="{{route('index_view')}}"><h1 id="title">GooDeals</h1></a>
		<a class="nav_tab" href="{{route('post_view')}}">TIN TỨC</a>
		<a id="loadStore" class="nav_tab" href="{{route('store_view')}}">CỬA HÀNG</a>
		<form id="nav_search">
			<input class="form-control" placeholder="Tìm kiếm">
		</form>
		<a id="loadStore" class="nav_tab" href="{{route('cart_view')}}">GIỎ HÀNG</a>
		@if (Auth::check())
			<ul class="nav_btn user dropdown-toggle" data-toggle="dropdown" href="#"><span style="color:@if(Auth::user()->role=='admin') {{'red'}} @endif">{{Auth::user()->name}}</span>
				@if (Auth::user()->avatar == 'to_be_uploaded')
					<img class="rounded-circle" src="{{url('/img/')}}/no_avatar.png" style="width:45px;height: 45px;margin-left:15px;">
				@else
					<img class="rounded-circle" src="/storage/uploads/avatar_images/{{Auth::user()->avatar}}" class="media-object" style="width:45px;height: 45px;margin-left:15px;">
				@endif
				<div class="dropdown-menu">
			      	<li class="dropdown-item" onclick="window.location = '{{route('setting_view',['id'=>Auth::user()->id])}}';">Cài đặt</li>
			      	<li class="dropdown-item" href="#" onclick="event.preventDefault();document.getElementById('logout').submit();">Đăng xuất</li>
			      	<form id="logout" method="POST" action="{{route('logout')}}">
			      		@csrf
					</form>
			    </div>
			</ul>
		@else
			<a href="{{route('login_view')}}"><button class="btn btn-danger nav_btn" style="margin-left: 5px;">Đăng nhập</button></a>
			<button class="btn btn-danger nav_btn">Đăng ký</button>
		@endif
	</div> -->


	<div id="content" class="container" style="padding: 10px;">
		@yield('store')
		@yield('post')
		@yield('thePost')
		@yield('theProduct')
		@yield('settings')
		@yield('yourComments')
		@yield('yourReviews')
		@yield('updateAvatar')
		@yield('userInformation')
		@yield('cart')
		@yield('yourCart')
		@yield('payment')
		@yield('yourOrders')
	</div>
</body>

<script>
  $(document).ready(function(){
  	// $('#loadStore').on('click',function(){
  	// 	$('#content').load('{{route('store_view')}}');
  	// }); 
  });

  $(document).ready(function() {
    $(".dropdown-toggle").dropdown();
});
</script>

</html>