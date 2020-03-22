@foreach ($getComments as $showComments)
	<div id="ajax_thisComment_{{$showComments->id}}">
		<div style="margin-bottom: 7px ;">
			@if ($showComments->avatar == 'to_be_uploaded')
				<img class="rounded-circle" src="https://www.brandeps.com/icon-download/U/User-02.svg" width="30px" height="30px">
			@else
				<img class="rounded-circle" src="{{'/storage/uploads/avatar_images/'.$showComments->avatar}}" width="30px" height="30px">
			@endif
			<strong style="color:@if ($showComments->role == 'admin') {{'red'}} @endif">{{$showComments->name}}</strong>
			<i>{{\Carbon\Carbon::parse($showComments->created_at)->format('h:i A (d/m/Y)')}}</i> : {{$showComments->comment}}
			@if (Auth::user()->role == 'admin')
				<sup><a href="#" id="deleteComments_{{$showComments->id}}" onclick="deleteComment({{$showComments->id}},{{$showComments->post_id}})">Xóa bình luận</a></sup>
			@endif
		</div>
	</div>
@endforeach