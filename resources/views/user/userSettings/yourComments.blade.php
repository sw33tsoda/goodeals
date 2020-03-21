@extends('user.index')

@section('yourComments')

<style>
	#span {
		text-decoration: none;
		color: white;
	}

	#yourComments_comment {
		color: white;
	}
</style>

<div id="accordion">
	<h1 id="store_title">TẤT CẢ BÌNH LUẬN</h1>
	<a href="{{route('deleteAllComments')}}" style="color:white">Xóa tất cả bình luận từ trước đến nay</span></a>
	<h5 id="store_title">HÔM NAY</h5>
	<br>
	@if ($todayComments->count() > 0)
		@foreach ($todayComments as $today)
			@php 
				$getPostName = DB::table('posts')->find($today->post_id);
			@endphp
			<div class="card" style="background-color: rgba(0,0,0,.03);margin-bottom: 3px;">
			    <div class="card-header" style="height: 30px;font-size: 14px;line-height: 0.5;">
			      <a class="collapsed card-link" data-toggle="collapse" href="#collapseThree_comment_id_{{$today->id}}">
			        <span id="span">Bạn đã bình luận vào bài viết </span><a href="{{route('thePost_view',['id'=>$getPostName->id,'title'=>str_slug($getPostName->title,'-')])}}">{{$getPostName->title}}</a><span id="span"></span><span style="color:white;float:right">{{\Carbon\Carbon::parse($today->created_at)->format('h:i A (d/m/Y)')}}</span>
			      </a>
			    </div>
			    <div id="collapseThree_comment_id_{{$today->id}}" class="collapse" data-parent="#accordion">
			      <div class="card-body">
			       	<span id="yourComments_comment">{{$today->comment}}</span>
			       		<br><br>
		       			<a href="{{route('setting_deleteComment',['id'=>$today->id])}}" style="color:white;">Xóa</a>
			      </div>
			    </div>
			  </div>
		@endforeach
	@else
		<span style="color: white;font-style: italic;font-size: 14px;">{{"Không có bình luận nào trong ngày hôm nay."}}</span><br>
	@endif
	<br>
	<h5 id="store_title">TRƯỚC ĐẾN NAY</h5>
	<br>
	@if ($comments->count() > 0)
		@foreach ($comments as $comments)
			@php 
				$getPostName = DB::table('posts')->find($comments->post_id);
			@endphp
		  <div class="card" style="background-color: rgba(0,0,0,.03);margin-bottom: 3px;">
		    <div class="card-header" style="height: 30px;font-size: 14px;line-height: 0.5;">
		      <a class="collapsed card-link" data-toggle="collapse" href="#collapseThree_comment_id_{{$comments->id}}">
		        <span id="span">Bạn đã bình luận vào bài viết </span><a href="{{route('thePost_view',['id'=>$getPostName->id,'title'=>str_slug($getPostName->title,'-')])}}">{{$getPostName->title}}</a><span id="span"></span><span style="float:right;color: white;">{{\Carbon\Carbon::parse($comments->created_at)->format('h:i A (d/m/Y)')}}</span>
		      </a>
		    </div>
		    <div id="collapseThree_comment_id_{{$comments->id}}" class="collapse" data-parent="#accordion">
		      <div class="card-body">
		       	<span id="yourComments_comment">{{$comments->comment}}
		       		<br><br>
		       		<a href="{{route('setting_deleteComment',['id'=>$comments->id])}}" style="color:white;">Xóa</a>
		       	</span>
		      </div>
		    </div>
		  </div>
	  	@endforeach
  	@else
		<span style="color: white;font-style: italic;font-size: 14px;">{{"Bạn không có bình luận nào."}}</span><br>
	@endif
</div>

@endsection