@extends('user.index')
@section('store-active','active')
@section('glow-tag','')
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
		border-radius: 3px;
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
		margin-bottom: 25px;
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
		text-align:;
	}

	.post-categories:hover {
		text-decoration: none;
		color:#421C52;
		background:white;
	}

.team-grid {
  color:#313437;
  width: 100%;
}

.team-grid p {
  color:white;
}

.team-grid h2 {
  font-weight:bold;
  margin-bottom:40px;
  padding-top:40px;
  color:inherit;
}

@media (max-width:767px) {
  .team-grid h2 {
    margin-bottom:25px;
    padding-top:25px;
    font-size:24px;
  }
}

.team-grid .intro {
  font-size:16px;
  max-width:500px;
  margin:0 auto;
}

.team-grid .intro p {
  margin-bottom:0;
}

.team-grid .people {
  padding:0px 0;
}

.team-grid .item {
  margin-bottom:30px;
}

.team-grid .item .box {
  text-align:center;
  background-repeat:no-repeat;
  background-size:cover;
  background-position:center;
  height:350px;
  position:relative;
  overflow:hidden;
  -webkit-box-shadow: -5px 0px 22px 6px rgba(0,0,0,0.26);
	-moz-box-shadow: -5px 0px 22px 6px rgba(0,0,0,0.26);
	box-shadow: -5px 0px 22px 6px rgba(0,0,0,0.26);
	border-radius: 5px;
}

.team-grid .item .cover {
  position:absolute;
  top:0;
  left:0;
  width:100%;
  height:100%;
  background-color:rgba(66,28,82,0.75);
  transition:opacity 0.15s ease-in;
  opacity:0;
  padding-top:80px;
  color:#fff;
  text-shadow:1px 1px 1px rgba(0,0,0,0.15);
}

.team-grid .item:hover .cover {
  opacity:1;
  transition: 0.5s;
}

.team-grid .item .name {
  font-weight:bold;
  margin-bottom:8px;
}

.team-grid .item .title {
  text-transform:uppercase;
  font-weight:bold;
  color:#bbd8fb;
  letter-spacing:2px;
  font-size:13px;
  margin-bottom:20px;
}

.team-grid .social {
  font-size:18px;
}

.team-grid .social a {
  color:inherit;
  margin:0 10px;
  display:inline-block;
  opacity:0.7;
}

.team-grid .social a:hover {
  opacity:1;
}

.lastest-products {
	padding: 15px;
}
</style>

<div id="store">
	<h1 id="content-title">CỬA HÀNG</h1>
	<br>
	<div class="categories">
		<a class="post-categories" href="{{route('store_view')}}">Tất cả</a>
		@foreach ($getCategories as $show)
			<a class="post-categories" href="{{route('store_category',['id'=>$show->id,'platform_name'=>str_slug($show->platform_name)])}}">{{$show->platform_name}}</a>
		@endforeach
	</div>
	@if ($getProducts->count() == 0)
		<center><p style="color:white;">{{"Không có sản phẩm."}}</p></center>
	@else
	<h5 id="store-tab">MỚI CẬP NHẬT</h5>
	<div class="row lastest-products">
		<div class="team-grid">
            <div class="row people">
            	@foreach ($getProducts->take(4) as $lastest)
                <div class="col-6 col-sm-6 col-md-6 col-xl-3 item" style="cursor: pointer;" onclick="window.location='{{route('theProduct_view',['id'=>$lastest->id])}}';">
                    <div class="box" style="background-image:url(/storage/uploads/product_images/{{$lastest->image}})">
                        <div class="cover">
                            <h3 class="name">{{$lastest->name}}</h3>
                            <p class="title">{{$lastest->categories->platform_name}}</p>
                            <p class="product-item-price">{{number_format($lastest->price)}} VNĐ</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
    	</div>
	</div>
	<h5 id="store-tab">TẤT CẢ</h5>
	<div class="row">
		@foreach ($getProducts as $lastest)
		<div class="col-6 col-sm-4 col-md-3 col-xl-2 product-item">
			<center><a href="{{route('theProduct_view',['id'=>$lastest->id])}}"><img class="product-item-image" src="/storage/uploads/product_images/{{$lastest->image}}"></a></center><br>
			<p class="product-item-price">{{number_format($lastest->price)}} VNĐ</p>
		</div>
		@endforeach
	</div>
	{{$getProducts->links()}}
	@endif
</div>
@endsection