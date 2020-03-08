@extends('user.index')

@section('updateAvatar')

<h1 id="store_title">THAY ĐỔI ẢNH ĐẠI DIỆN</h1>
<br>
<h5 id="store_title">CẬP NHẬT ẢNH ĐẠI DIỆN</h5>
<hr>
<div style="text-align: center;">
	<div>
		<h5 id="store_title" style="margin-bottom: 25px;">ẢNH HIỆN TẠI</h5>
		@if (Auth::user()->avatar == 'to_be_uploaded')
			<center><img class="rounded-circle" src="{{url('/img/')}}/no_avatar.png" style="width:200px;height: 200px;"></center>
		@else
			<center><img class="rounded-circle" src="/storage/uploads/avatar_images/{{Auth::user()->avatar}}" class="media-object" style="width:200px;height: 200px;margin-left:15px;"></center>
		@endif
		<br>
		<form method="post" action="{{route('changeAvatar',['id'=>Auth::user()->id])}}" enctype="multipart/form-data" style="margin-bottom: 25px">
			@csrf
		  <input type="file" id="customFile" name="avatar">
		  <button class="btn btn-custom" type="submit">Upload</button>
		</form>
	</div>
</div>



@endsection