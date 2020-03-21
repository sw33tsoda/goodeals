<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>@yield('panel_title')</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="{{asset('/css/admin-index.css')}}">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script src="/vendor/unisharp/laravel-ckeditor/adapters/jquery.js"></script>
</head>
<body>

<div class="">
	<nav class="navbar navbar-expand-lg navbar-light navbar-custom">
	  <a class="navbar-brand navbar-brand-custom" href="{{route('admin_view')}}">BẢNG ĐIỀU KHIỂN</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>
	  <div class="collapse navbar-collapse" id="navbarSupportedContent">
	    <ul class="navbar-nav mr-auto">
	    </ul>
	    <form class="form-inline my-2 my-lg-0" method="GET" action="{{url('admin/search')}}">
	    	<input class="form-control form-control-custom" type="text" name="search_input" placeholder="Bạn muốn tìm gì ?">
	    	<button class="btn btn-success-custom my-2 my-sm-0" style="margin-left: 5px;" type="submit">Search</button>
	    </form>
	  </div>
	</nav>

	<div class="content row">
		<div class="content-left col-lg-3 col-xl-2">
			<div id="accordion" class="accordion-custom">
			  <div class="card-custom">
			    <div class="card-header card-header-custom">
			      <a class="card-link-custom" data-toggle="collapse" href="#dashboard-panel">
			        TỔNG QUAN
			      </a>
			    </div>
			    <div id="dashboard-panel" class="collapse collapse-custom" data-parent="#accordion">
			      <div class="card-body card-body-custom">
			        <div class="sub-tab">
			        	<a class="sub-tab-ahref" href="{{route('dashBoard_view')}}">TỔNG QUAN</a>
			        </div>
			      </div>
			    </div>
			  </div>
			</div>
			<div id="accordion" class="accordion-custom">
			  <div class="card-custom">
			    <div class="card-header card-header-custom">
			      <a class="card-link-custom" data-toggle="collapse" href="#order-panel">
			        QUẢN LÝ ĐƠN HÀNG
			      </a>
			    </div>
			    <div id="order-panel" class="collapse collapse-custom" data-parent="#accordion">
			      <div class="card-body card-body-custom">
			        <div class="sub-tab">
			        	<a class="sub-tab-ahref" href="{{route('orders.index')}}">XEM ĐƠN ĐẶT HÀNG</a>
			        </div>
			      </div>
			    </div>
			  </div>
			</div>
			<div id="accordion" class="accordion-custom">
			  <div class="card-custom">
			    <div class="card-header card-header-custom">
			      <a class="card-link-custom" data-toggle="collapse" href="#user-panel">
			        QUẢN LÝ NGƯỜI DÙNG
			      </a>
			    </div>
			    <div id="user-panel" class="collapse collapse-custom" data-parent="#accordion">
			      <div class="card-body card-body-custom">
			        <div class="sub-tab">
			        	<a class="sub-tab-ahref" href="{{route('usersList_view')}}">DANH SÁCH NGƯỜI DÙNG</a>
			        </div>
			        <div class="sub-tab">
			        	<a class="sub-tab-ahref" href="{{route('addUsers_view')}}">THÊM NGƯỜI DÙNG</a>
			        </div>
			      </div>
			    </div>
			  </div>
			</div>
			<div id="accordion" class="accordion-custom">
			  <div class="card-custom">
			    <div class="card-header card-header-custom">
			      <a class="card-link-custom" data-toggle="collapse" href="#product-panel">
			        QUẢN LÝ SẢN PHẨM
			      </a>
			    </div>
			    <div id="product-panel" class="collapse collapse-custom" data-parent="#accordion">
			      <div class="card-body card-body-custom">
			        <div class="sub-tab">
			        	<a class="sub-tab-ahref" href="{{route('productsList_view')}}">DANH SÁCH SẢN PHẨM</a>
			        </div>
			        <div class="sub-tab">
			        	<a class="sub-tab-ahref" href="{{route('addProducts_view')}}">THÊM SẢN PHẨM</a>
			        </div>
			      </div>
			    </div>
			  </div>
			</div>
			<div id="accordion" class="accordion-custom">
			  <div class="card-custom">
			    <div class="card-header card-header-custom">
			      <a class="card-link-custom" data-toggle="collapse" href="#post-panel">
			        QUẢN LÝ BÀI VIẾT
			      </a>
			    </div>
			    <div id="post-panel" class="collapse collapse-custom" data-parent="#accordion">
			      <div class="card-body card-body-custom">
			        <div class="sub-tab">
			        	<a class="sub-tab-ahref" href="{{route('postsList_view')}}">DANH SÁCH BÀI VIẾT</a>
			        </div>
			        <div class="sub-tab">
			        	<a class="sub-tab-ahref" href="{{route('addPosts_view')}}">THÊM BÀI VIẾT</a>
			        </div>
			      </div>
			    </div>
			  </div>
			</div>
			<div id="accordion" class="accordion-custom">
			  <div class="card-custom">
			    <div class="card-header card-header-custom">
			      <a class="card-link-custom" data-toggle="collapse" href="#category-panel">
			        QUẢN LÝ THỂ LOẠI
			      </a>
			    </div>
			    <div id="category-panel" class="collapse collapse-custom" data-parent="#accordion">
			      <div class="card-body card-body-custom">
			      	<div class="sub-tab">
			        	<a class="sub-tab-ahref" href="{{route('showAllCategories_view')}}">DANH SÁCH THỂ LOẠI</a>
			        </div>
			        <div class="sub-tab">
			        	<a class="sub-tab-ahref" href="{{route('addProductCategories_view')}}">THÊM NỀN TẢNG SẢN PHẨM</a>
			        </div>
					<div class="sub-tab">
			        	<a class="sub-tab-ahref" href="{{route('addProductCategories_view')}}">THÊM THỂ LOẠI BÀI VIẾT</a>
			        </div>
			      </div>
			    </div>
			  </div>
			</div>
		</div>
		<div class="content-right col-lg-9 col-xl-10">@yield('panel')</div>
	</div>
</div>

</body>
</html>