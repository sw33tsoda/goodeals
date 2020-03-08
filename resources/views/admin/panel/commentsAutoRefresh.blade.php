@foreach ($getComments as $showComments)
	<div id="ajax_thisComment_{{$showComments->id}}">
	<div style="margin-bottom: 7px ;">
		@if ($showComments->avatar == 'to_be_uploaded')
			<img class="img-circle" src="https://www.brandeps.com/icon-download/U/User-02.svg" width="30px" height="30px">
		@else
			<img class="img-circle" src="{{'/storage/uploads/avatar_images/'.$showComments->avatar}}" width="30px" height="30px">
		@endif
		<strong style="color:@if ($showComments->role == 'admin') {{'red'}} @endif">{{$showComments->name}}</strong>
		<i>({{$showComments->created_at}})</i> : {{$showComments->comment}}
		@if (Auth::user()->role == 'admin')
			<sup><a id="deleteComments_{{$showComments->id}}">Xóa bình luận</a></sup>
		@endif
	</div>
	<script>
		$('#deleteComments_{{$showComments->id}}').on('click',function(){
			$('#ajax_thisComment_{{$showComments->id}}').fadeOut(500);
			setTimeout(function(){ 
				$('#ajax_thisComment_{{$showComments->id}}').load('{{ action('Admin\AjaxController@deleteComments',['id' => $showComments->id]) }}');
				$('#ajax_thisComment_{{$showComments->id}}').popup(); //anti glitch
				$('#ajax_theComments_{{$showComments->post_id}}').load('{{ action('Admin\AjaxController@autoRefreshComments',['id' => $showComments->post_id]) }}');
			}, 500);		
		});
	</script>
	</div>
@endforeach