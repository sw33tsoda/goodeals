<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Admin</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script src="/vendor/unisharp/laravel-ckeditor/adapters/jquery.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<style>
		@import url(https://fonts.googleapis.com/css?family=Roboto:400,100,300,500);
		* {font-family: "Roboto", sans-serif;}

		.pagination>.active>a, .pagination>.active>a:focus, .pagination>.active>a:hover, .pagination>.active>span, .pagination>.active>span:focus, .pagination>.active>span:hover {
			background-color: white;
			color:black;
			border-color:black;

		}

		.pagination>li>a, .pagination>li>span {
			color:black;
		}

		.checked {
  			color: orange;
		}
	</style>
</head>
<body>


@include('admin.layout.header')
<div class="container" >
	<hr>
	<div class="row">
		<div class="col-lg-3">
			<form method="GET" action="{{url('admin/search')}}"><input class="form-control" type="text" name="search_input" placeholder="Bạn muốn tìm gì ?"></form>
		</div>
		<div class="col-lg-9 align-self-center">
			<center><h3 style="line-height: 0px;">@yield('panel_title')</h3></center>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-3">
			<h3>Tổng quan</h3>
			<a style="font-weight: @yield('panel_highlight_dashBoard')" href="{{route('dashBoard_view')}}">Thống kê</a><br>
			<hr>
			<h3>Quản lý người dùng</h3>
			<a style="font-weight: @yield('panel_highlight_usersList')" href="{{route('usersList_view')}}">Danh sách người dùng</a><br>
			<a style="font-weight: @yield('panel_highlight_addUsers')" href="{{route('addUsers_view')}}">Thêm người dùng</a>
			<hr>
			<h3>Quản lý sản phẩm</h3>
			<a style="font-weight: @yield('panel_highlight_productsList')" href="{{route('productsList_view')}}">Danh sách sản phẩm</a><br>
			<a style="font-weight: @yield('panel_highlight_reviewsList')" href="{{route('reviewsList_view')}}">Danh sách đánh giá</a><br>
			<a style="font-weight: @yield('panel_highlight_addProducts')" href="{{route('addProducts_view')}}">Thêm sản phẩm</a>
			<hr>
			<h3>Quản lý bài viết</h3>
			<a style="font-weight: @yield('panel_highlight_postsList')" href="{{route('postsList_view')}}">Danh sách bài viết</a><br>
			<a style="font-weight: @yield('panel_highlight_addPosts')" href="{{route('addPosts_view')}}">Thêm thể bài viết</a>
			<hr>
			<h3>Quản lý thể loại</h3>
			<a style="font-weight: @yield('panel_highlight_showAllCategories')" href="{{route('showAllCategories_view')}}">Danh sách thể loại</a><br>
			<a style="font-weight: @yield('panel_highlight_addPostCategories')" href="{{route('addPostCategories_view')}}">Thêm thể loại bài viết</a>
			<br>
			<a style="font-weight: @yield('panel_highlight_addProductCategories')" href="{{route('addProductCategories_view')}}">Thêm nền tảng sản phẩm</a>
			<h3>Tùy chọn cá nhân</h3>
			<hr>
			<div class="row">
				<div class="col-lg-4">
					@if (Auth::user()->avatar != "to_be_uploaded")
						<img src="/storage/uploads/avatar_images/{{Auth::user()->avatar}}" width="100%">
					@else
						<p>Không có ảnh đại diện</p>
					@endif
				</div>
				<div class="col-lg-8">
					<a style="text-decoration: none;color:black">{{Auth::user()->name}}</a><br>
					<a href="{{route('editUsers_view',['id'=>Auth::user()->id])}}">Thay đổi thông tin</a>
				</div>
			</div>
			<form method="POST" action="{{route('logout')}}">
				@csrf
				<button type="submit" style="margin-top: 25px;" class="btn">Đăng xuất</button>
			</form>
		</div>
		<div class="col-lg-9" style="padding-top: 25px;" id="main">@yield('panel')</div>
	</div>
	<hr>
</div>
@include('admin.layout.footer')


</body>
</html>