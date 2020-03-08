@extends('admin.index')
@section('panel_title','Tổng quan')
@section('panel_highlight_dashBoard','bolder')
@section('panel')
	<style>
		#stats {
			text-align: center;
		} #stats > h1 {
			font-size:40px;
		}
	</style>
	<div class="row">
		<div id="stats" class="col-lg-4"><h1 class="count">{{$array['usersStats']}}</h1><p>Người dùng</p><h1 class="count">{{$array['adminsStats']}}</h1><p>Quản trị viên</p></div>
		<div id="stats" class="col-lg-4"><h1 class="count">{{$array['productsStats']}}</h1><p>Sản phẩm</p><h1 class="count">{{$array['reviewsStats']}}</h1><p>Đánh giá</p></div>
		<div id="stats" class="col-lg-4"><h1 class="count">{{$array['postsStats']}}</h1><p>Bài viết</p><h1 class="count">{{$array['commentsStats']}}</h1><p>Bình luận</p></div>
	</div>

	<script>
		$('.count').each(function () {
		    $(this).prop('Counter',0).animate({
		        Counter: $(this).text()
		    }, {
		        duration: 1000,
		        easing: 'swing',
		        step: function (now) {
		            $(this).text(Math.ceil(now));
		        }
		    });
		});
	</script>
@endsection