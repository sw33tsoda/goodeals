@extends('user.index')
@section('store')

<style>
	#theProduct {
		-webkit-box-shadow: -5px 0px 22px 6px rgba(0,0,0,0.26);
		-moz-box-shadow: -5px 0px 22px 6px rgba(0,0,0,0.26);
		box-shadow: -5px 0px 22px 6px rgba(0,0,0,0.26);
		padding: 50px;
		margin-top:25px;
	}

	#theProduct_name {
		color: white;
	}

	#theProduct_box_art {
		-webkit-box-shadow: -5px 0px 22px 6px rgba(0,0,0,0.26);
		-moz-box-shadow: -5px 0px 22px 6px rgba(0,0,0,0.26);
		box-shadow: -5px 0px 22px 6px rgba(0,0,0,0.26);
	}

	#theProduct_desc {
		color: white;
		font-weight: normal;
		font-size: 10pt;
	}

	#theProduct_pub_dev {
		font-style: italic;
		color: white;
		font-weight: bold;
	}

	#theProduct_plat {
		color: white;
		font-size: 30px;
	}

	#theProduct_price {
		color: #82c65a;
		font-size: 30px;
	}

	#theProduct_date {
		color: white;
		position: absolute;
	    bottom: 0;
	    right: 20px;
	    font-size: 12px;
	    font-style: italic;
	    margin: 0;
	}

	.theProduct_btn {
		height: 40px;
	    width: auto;
	    padding: 5px 10px 5px 10px;
	    line-height: 37px;
	    text-align: center;
	    text-decoration: none;
	    font-size: 20px;
	    color: white;
	    border-radius: 45px;
	    margin-top: 7px;
	    margin-right: 7px;
	    transition: 0.1s;
	    border: 2px solid white;
	}

	.theProduct_btn:hover {
		text-decoration: none;
		color:#421C52;
		background:white;
	}

	#theProduct_btn_group {
		margin-top: 10px;
	}

	#postCommentSubmit {
		border-radius: 24px;
		float: right;
	}

	#comment {
		padding: 20px;
	}

	#commentsList {
		height: auto;
	}

	#commentsList:hover {
		
	}

	.rating {
		width: 5em;
		float:left;
	}

	.rating option {
		background:#421C52;
		
	}

	.dropdown-item.cmt {
		height: 30px;
		width: 100%;
		line-height: 20px;
		font-size: 15px;
		color: white;
	}

	.dropdown-menu.cmt {
		-webkit-box-shadow: -5px 0px 22px 6px rgba(0,0,0,0.26);
		-moz-box-shadow: -5px 0px 22px 6px rgba(0,0,0,0.26);
		box-shadow: -5px 0px 22px 6px rgba(0,0,0,0.26);
		background-color: #50325c;
		width: 195px;
	}

	.dropdown-item.cmt:hover {
		background-image: linear-gradient(45deg, #50325c 25%, #421c52 25%, #421c52 50%, #50325c 50%, #50325c 75%, #421c52 75%, #421c52 100%);
		background-size: 56.57px 56.57px;
		color: white;
	}

	.dropdown-toggle.cmt {
		margin-bottom: 0;
	}

	.dropdown-toggle.cmt:hover {
		margin-bottom: 0;
		background: 0;
		color: white;
	}
</style>

<div id="theProduct">
	<div class="row">
	<div class="col-lg-4" ><img src="/storage/uploads/product_images/{{$thisProduct->image}}" width="100%"></div>
	<div class="col-lg-8" >
		<h1 id="theProduct_name">{{$thisProduct->name}}</h1>
		<h4 id="theProduct_plat">{{$thisProduct->platform_id}}</h4>
		<h6 style="color:white">
			@php
				$avg = (float)0;
				$sum = 0;
				$count = 0;
				$ratingLimit = 5;
				foreach ($getReviews as $getRate) {
					$sum += $getRate->rate;
					$count += 1;
				}
				if ($count > 0) {
					$avg = $sum/$count;
				}
				$stars = round($avg);
			@endphp
			@if ($count > 0)
				{!!str_repeat('<span class="fa fa-star checked" style="font-size: 25px;"></span> ',$stars)!!}{!!str_repeat('<span class="fa fa-star" style="font-size: 25px;"></span> ',$ratingLimit - $stars)!!}
		        @switch($stars)
		          @case(1) {{"(Rất tệ)"}} @break
		          @case(2) {{"(Tệ)"}} @break
		          @case(3) {{"(Ổn)"}} @break
		          @case(4) {{"(Hay)"}} @break
		          @case(5) {{"(Rất hay)"}} @break
		        @endswitch - {{round($avg,2)}}
		    @else
	    		{{"Chưa được đánh giá"}}
	        @endif
		</h6>

		<h6 id="theProduct_price">{{number_format($thisProduct->price)}} VNĐ</h6>
		<h6 id="theProduct_pub_dev">{{$thisProduct->developer}}</h6>
		<h6 id="theProduct_pub_dev">{{$thisProduct->publisher}}</h6>
		<p id="theProduct_desc">{{$thisProduct->desc}}</p>
		<br>
		<div id="theProduct_btn_group">
			<a href="#" onclick="addToCart({{$thisProduct->id}})" class="theProduct_btn">Thêm vào giỏ</a>
		</div>
		<br>
		<p id="theProduct_date">{{$thisProduct->created_at}}</p>
	</div>
	</div>
	<br>
	<hr>

	@if(Auth::check() == 1)
		<p style="color:white">Đánh giá của bạn : </p>
		<form id="comment_input" class="form-group" action="{{route('addReview_post',['product_id'=>$thisProduct->id])}}" method="POST">
			@csrf
		  	<textarea name="review" class="form-control" rows="5" id="comment" spellcheck="false"></textarea>
		  	<br>
		  	<div>
			  	<select name="rate" class="form-control rating">
			  		<option value="">Điểm</option>
			      <option>1</option>
			      <option>2</option>
			      <option>3</option>
			      <option>4</option>
			      <option>5</option>
			    </select>
			  	<button id="postCommentSubmit" type="submit" class="btn btn-light">Gửi đánh giá</button>
			  	@if ($errors->has('rate'))
			  		<br><br>
			  		<p style="color:white;">{{$errors->first('rate')}}</p>
			  	@endif
		  	</div>
		</form>
	@endif
	<br>
	<br>
	<h6 style="color:white">
		@if (count($getReviews) > 0)
			@foreach($getReviews as $reviews)
				<div class="media">
					<div class="media-left" style="margin-right: 10px">
						@if ($reviews->users->avatar == 'to_be_uploaded')
				          <img class="rounded-circle" src="{{url('/img/')}}/no_avatar.png" style="width:60px;height: 60px">
				        @else
				          <img class="rounded-circle" src="/storage/uploads/avatar_images/{{$reviews->users->avatar}}" class="media-object" style="width:60px;height: 60px">
				        @endif
			    	</div>
			    	<div class="media-body">
			    		<div class="" style="float:left">
							<span style="font-size: 20px;">{{$reviews->users->name}}</span> <span style="font-weight: normal; font-size: 12px">đã đánh giá</span>
							{!!str_repeat('<span class="fa fa-star checked" style="font-size: 20px;"></span> ',$reviews->rate)!!}{!!str_repeat('<span class="fa fa-star" style="font-size: 20px;"></span>',$ratingLimit - $reviews->rate)!!}
					        @switch($reviews->rate)
					          @case(1) {{"(Rất tệ)"}} @break
					          @case(2) {{"(Tệ)"}} @break
					          @case(3) {{"(Ổn)"}} @break
					          @case(4) {{"(Hay)"}} @break
					          @case(5) {{"(Rất hay)"}} @break
					        @endswitch
					        <span style="font-weight: normal; font-size: 12px">vào lúc </span> {{\Carbon\Carbon::parse($reviews->created_at)->format('h:m A (d/m/Y)')}}
					        <br>
					        <span style="font-weight: normal; font-style: italic;font-size: 12px;">{{$reviews->review}}</span>
				    	</div>
				        @if (Auth::check() && Auth::user()->id == $reviews->user_id || Auth::check() && Auth::user()->role == 'admin')
						<div style="padding-left: 0;float:right">
							<ul class="nav_btn user dropdown-toggle cmt" data-toggle="dropdown" href="#">
								<div class="dropdown-menu cmt">
						      		<li class="dropdown-item" href="#" onclick="deleteReview({{$reviews->id}})">Xóa</li>
							    </div>
							</ul>
						</div>
						@endif
			    	</div>
		    	</div>
				<br>
				<br>
			@endforeach
		@else
			{{"Hiện không có đánh giá nào cả."}}
		@endif
	</h4>
</div>



<script>
	function addToCart(id) {
		$.ajax({
			url:"{{route('cart_addToCart',['product_id'=>'_blank'])}}",
			method:"GET",
			data: {
				product_id:id,
			},
			success:function(msg){
				alert(msg);
			},
		});
	}
</script>

@endsection