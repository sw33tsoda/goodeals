@extends('user.index')
@section('announce-active','active')
@section('post')

<style>
	.categories {
		margin-bottom: 30px;
	}

	.post-categories {
		height: 40px;
		width: auto;
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

	.post-categories-custom {
		height: 40px;
		width: auto;
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
		position: absolute;
		left: 15px;
		bottom: 15px;
	}

	.post-categories:hover,.post-categories-custom:hover {
		text-decoration: none;
		color:#421C52;
		background:white;
	}

	.post {
		-webkit-box-shadow: -5px 0px 22px 6px rgba(0,0,0,0.26);
		-moz-box-shadow: -5px 0px 22px 6px rgba(0,0,0,0.26);
		box-shadow: -5px 0px 22px 6px rgba(0,0,0,0.26);
		margin-bottom: 25px;
	}

	.post-right {
		background-image: linear-gradient(45deg, #50325c 25%, #421c52 25%, #421c52 50%, #50325c 50%, #50325c 75%, #421c52 75%, #421c52 100%);
		background-size: 56.57px 56.57px;
		color: white;
		padding: 20px;
	}

	.post-left {
		padding: 0;
	}

	#post-tab {
		margin-bottom: 50px;
		color: white;
	}

	.post-title {
		color: white;
		font-size: 18pt;
	}

	.post-title:hover {
		text-decoration: none;
		color: white;
	}

	.post-desc {
		font-style: italic;
		font-size: 10pt;
	}

	.post-comment {
		position: absolute;
		bottom: 15px;
		right: 15px;
	}

	.post-image-to-be-uploaded {
		width: auto;
		height: 200px;
		line-height: 200px;
		font-size: 30pt;
		font-style: bold
	}

	.post-image-to-be-uploaded {
		color: white;
	}
</style>

<h1 id="content-title">THÔNG BÁO</h1>
<br>
<div class="categories">
	<a class="post-categories" href="{{route('post_view')}}">Tất cả</a>
	@foreach ($getCategories as $show)
		<a class="post-categories" href="{{route('post_category',['id'=>$show->id])}}">{{$show->category_name}}</a>
	@endforeach
</div>
<h5 id="post-tab">MỚI CẬP NHẬT</h5>
@if (count($getPosts) == 0) <center><p id="post-tab">{{"Không có bài viết."}}</p></center> @else
	<div style="padding: 15px">
	@foreach ($getPosts as $show)
	<div class="post row">
		<div class="col-lg-4 post-left">
			@if ($show->image == 'to_be_uploaded')
				<div class="post-image-to-be-uploaded">
					<div class="text-center">THÔNG BÁO</div>
				</div>
			@else
				<img src="/storage/uploads/post_images/{{$show->image}}" width="100%">
			@endif
		</div>
		<div class="col-lg-8 post-right">
			<a class="post-title" href="{{route('thePost_view',['id'=>$show->id,'title'=>str_slug($show->title,'-')])}}" >{{$show->title}}</a>
			<br>
			<small>({{$show->created_at}})</small>

	  		<a class="post-categories-custom" href="#">
		  		@foreach ($getCategories->where('id',$show->category_id) as $category)
					{{$category->category_name}}
					@break;
				@endforeach
			</a>
			<small class="post-comment">
				@if(count($getComments->where('post_id',$show->id)) > 0)
					Có {{count($getComments->where('post_id',$show->id))}} bình luận.
				@else
					{{"Không có bình luận nào."}}
				@endif
			</small>
		</div>
    </div>
	@endforeach
	</div>
</div>
{{$getPosts->links()}}
@endif
@endsection