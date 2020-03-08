@extends('user.index')
@section('store-active','active')
@section('store')
<style>
	.product-item {
		margin-bottom: 35px;
	}

	.product-item-image {
		height: 226.3px;
		width: 151.9px;
		-webkit-box-shadow: -5px 0px 22px 6px rgba(0,0,0,0.26);
		-moz-box-shadow: -5px 0px 22px 6px rgba(0,0,0,0.26);
		box-shadow: -5px 0px 22px 6px rgba(0,0,0,0.26);
		transition: 0.5s;
	}

	.product-item-image:hover {
		-webkit-box-shadow: 0px 0px 28px -4px rgba(255,255,255,0.3);
		-moz-box-shadow: 0px 0px 28px -4px rgba(255,255,255,0.3);
		box-shadow: 0px 0px 28px -4px rgba(255,255,255,0.3);
		-webkit-transform: scale(1.1);
		transform: scale(1.1);
	}

	.product-item-price {
		color:white;
		font-size: 20px;
		margin:0;
		padding: 0;
		text-align: center;
	}

	#store-tab {
		margin-bottom: 50px;
		color: white;
	}

	#store-sort {
		
	}

	.categories {
		margin-bottom: 30px;
	}

	.post-categories {
		height: 40px;
		width: 100px;
		padding: 5px 10px 5px 10px;
		line-height: 25px;
		text-align: center;
		text-decoration:none;
		font-size: 15px;
		color:white;
		border-radius: 45px;
		margin-top: 7px;
		margin-left: 5px;
		transition: 0.1s;
		border: 2px solid white;
	}

	.post-categories:hover {
		text-decoration: none;
		color:#421C52;
		background:white;
	}
</style>
<div id="store">
	<h1 id="content-title">CỬA HÀNG</h1>
	<h5 id="store-tab">MỚI CẬP NHẬT</h5>
	<div class="categories">
		<a class="post-categories" href="{{route('store_view')}}">Tất cả</a>
		@foreach ($getCategories as $show)
			<a class="post-categories" href="{{route('store_category',['id'=>$show->id,'platform_name'=>str_slug($show->platform_name)])}}">{{$show->platform_name}}</a>
		@endforeach
	</div>
	@if ($getProducts->count() == 0)
		<center><p style="color:white;">{{"Không có sản phẩm."}}</p></center>
	@else
	<div class="row">
		@foreach ($getProducts->take(6) as $lastest)
		<div class="col-lg-2 product-item">
			<center><a href="{{route('theProduct_view',['id'=>$lastest->id])}}"><img class="product-item-image" src="/storage/uploads/product_images/{{$lastest->image}}"></a></center><br>
			<p class="product-item-price">{{number_format($lastest->price)}} VNĐ</p>
		</div>
		@endforeach
	</div>
	<h5 id="store-tab">TẤT CẢ</h5>
	<div class="row">
		@foreach ($getProducts->take(18) as $lastest)
		<div class="col-lg-2 product-item">
			<center><a href="{{route('theProduct_view',['id'=>$lastest->id])}}"><img class="product-item-image" src="/storage/uploads/product_images/{{$lastest->image}}"></a></center><br>
			<p class="product-item-price">{{number_format($lastest->price)}} VNĐ</p>
		</div>
		@endforeach
	</div>
	@endif
</div>
@endsection