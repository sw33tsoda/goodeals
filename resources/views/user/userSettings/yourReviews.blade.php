@extends('user.index')

@section('yourReviews')


<h1 id="store_title">TẤT CẢ ĐÁNH GIÁ</h1>
@php
	$avg = (float)0;
	$sum = 0;
	$count = 0;
	$ratingLimit = 5;
	if ($count > 0) {
		$avg = $sum/$count;
	}
	$stars = round($avg);
@endphp
@if ($reviews->count() > 0)
	@foreach ($reviews as $thisReviews)
		@php 
			$getIdAndUserName = DB::table('users')->find($thisReviews->user_id);
			$getProductById = DB::table('products')->find($thisReviews->product_id);
		@endphp
		<div class="media" style="color:white">
		<div class="media-left" style="margin-right: 10px">
			@if ($getIdAndUserName->avatar == 'to_be_uploaded')
	          <img class="rounded-circle" src="{{url('/img/')}}/no_avatar.png" style="width:60px;height: 60px">
	        @else
	          <img class="rounded-circle" src="/storage/uploads/avatar_images/{{$getIdAndUserName->avatar}}" class="media-object" style="width:60px;height: 60px">
	        @endif
		</div>
		<div class="media-body">
			<span style="font-size: 20px;">{{$getIdAndUserName->name}}</span> <span style="font-weight: normal; font-size: 12px">đã đánh giá</span>
			{!!str_repeat('<span class="fa fa-star checked" style="font-size: 20px;"></span> ',$thisReviews->rate)!!}{!!str_repeat('<span class="fa fa-star" style="font-size: 20px;"></span>',$ratingLimit - $thisReviews->rate)!!}
	        @switch($thisReviews->rate)
	          @case(1) {{"(Rất tệ)"}} @break
	          @case(2) {{"(Tệ)"}} @break
	          @case(3) {{"(Ổn)"}} @break
	          @case(4) {{"(Hay)"}} @break
	          @case(5) {{"(Rất hay)"}} @break
			@endswitch
			<a href="{{route('theProduct_view',['id'=>$getProductById->id])}}">{{$getProductById->name}}</a>
	        <span style="font-weight: normal; font-size: 12px">vào lúc </span> {{\Carbon\Carbon::parse($thisReviews->created_at)->format('h:m A (d/m/Y)')}} <a href="{{route('setting_deleteReview',['id'=>$thisReviews->id])}}">Xóa</a>
	        <br>
	        <span style="font-weight: normal; font-style: italic;font-size: 12px;">{{$thisReviews->review}}</span>
		</div>
		</div>
		<br>
	@endforeach
@else
	<span style="color: white;font-style: italic;font-size: 14px;">{{"Không có đánh giá nào."}}</span><br>
@endif


@endsection