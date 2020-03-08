@extends('user.index')

@section('settings')

<style>
	#settings>a , #settings>div>div>a {
		color: white;
		font-style: italic;
	}

	#settings>div.media>div.media-left {
		margin-right: 10px;
	}
</style>

<div id="settings">
	<h1 id="store_title">CÀI ĐẶT</h1>
	<br>
	<h5 id="store_title">CÀI ĐẶT THÔNG TIN CÁ NHÂN</h5>
	<hr>
	<div class="media">
		<div class="media-left">
			@if (Auth::user()->avatar == 'to_be_uploaded')
	          <img class="rounded-circle" src="{{url('/img/')}}/no_avatar.png" style="width:150px;height:150px;">
	        @else
	          <img class="rounded-circle" src="/storage/uploads/avatar_images/{{Auth::user()->avatar}}" class="media-object" style="width:150px;height:150px;">
	        @endif
		</div>
		<div class="media-right">
			<a href="{{route('userInformation_view')}}">Sữa thông tin cá nhân</a><br>
			<a href="{{route('changeAvatar_view')}}">Thay đổi Avatar</a>
		</div>
	</div>
	<br><br>
	<div class="row">
		<div class="col-lg-6">
	<h5 id="store_title">GIỎ HÀNG</h5>
	<hr>
	<a href="{{route('cart_view')}}">Xem tất cả sản phẩm trong giỏ hàng</a>
	<br>
	<br>
	<br>
	<br>
</div>
	<div class="col-lg-6">
	<h5 id="store_title">BÌNH LUẬN VÀ ĐÁNH GIÁ</h5>
	<hr>
	<a href="{{route('yourComments_view',['id'=>Auth::user()->id])}}">Xem tất cả các bình luận của bạn</a><br>
	<a href="{{route('yourReviews_view',['id'=>Auth::user()->id])}}">Xem tất cả các đánh giá của bạn</a>
	<br><br><br></div>
</div>
	<h5 id="store_title">TÀI KHOẢN</h5>
	<hr>
	<a href="#" data-toggle="modal" data-target="#setDefault">Đặt tài khoản về lại mặc định</a>
	<div class="modal" id="setDefault">
	  <div class="modal-dialog modal-sm">
	    <div class="modal-content modal-custom">
	      <!-- Modal Header -->
	      <div class="modal-header" style="border:0">
	      	<p>Bạn có chắc chắn muốn đặt tài khoản về lại mặc định ?</p>
	      </div>
	      <!-- Modal body -->
	      <div class="modal-body modal-body-custom">
	      		<a href="{{route('setDefault')}}" class="btn btn-custom">
				  CÓ
				</a>
		        <a href="#" class="btn btn-custom" data-dismiss="modal">
				  KHÔNG
				</a>
	      </div>
	      <!-- Modal footer -->
	      <div class="modal-footer" style="border:0">
	        <button type="button" class="btn btn-custom" data-dismiss="modal">Đóng</button>
	      </div>
	    </div>
	  </div>
	</div>
	<small id="emailHelp" class="form-text text-muted">Toàn bộ sản phẩm bạn đã thêm vào giỏ hàng , các bình luận và đánh giá của bạn từ trước đến nay sẽ bị xóa.</small>
	<br>
	<a href="">Xóa tài khoản này</a>
	<small id="emailHelp" class="form-text text-muted">Tài khoản của bạn sẽ bị xóa vĩnh viễn ra khỏi dữ liệu.</small>
</div>

@endsection