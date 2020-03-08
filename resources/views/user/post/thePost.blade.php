@extends('user.index')

@section('thePost')
	<style>
		* {
			color: white;
		}

		#thePost {
			-webkit-box-shadow: -5px 0px 22px 6px rgba(0,0,0,0.26);
			-moz-box-shadow: -5px 0px 22px 6px rgba(0,0,0,0.26);
			box-shadow: -5px 0px 22px 6px rgba(0,0,0,0.26);
			padding: 50px;
			margin-top:25px;
		}

		#thePost a img {
			width: 200px;
		}

		#postTitle {
			text-align: center;
			margin-bottom: 25px;
		}

		#postAuthor {
			float:right;
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



	<div id="thePost">
		<center>
			<h1 id="postTitle">{{$thisPost->title}}</h1>
			<img src="/storage/uploads/post_images/{{$thisPost->image}}" style="max-width: 100%;">
		</center>
		<p id="postContent">{!!$thisPost->content!!}</p>
		<p id="postAuthor">{{$thisPost->author}}</p>
		<br>
		<hr>
		<form id="comment_input" class="form-group" action="{{route('addComment_post',['post_id'=>$thisPost->id])}}" method="POST">
			@csrf
			<label for="comment">Bình luận của bạn (Với tư cách : {{(Auth::check() == true ? Auth::user()->name : "Khách")}})
				@if(Auth::check())<img class="rounded-circle" src="/storage/uploads/avatar_images/{{Auth::user()->avatar}}" class="media-object" style="width:45px;height:45px;margin-left: 12px;">
				@endif
			</label>
		  	<textarea name="comment" class="form-control" rows="5" id="comment" spellcheck="false"></textarea>
		  	<br>
		  	<button id="postCommentSubmit" type="submit" class="btn btn-light">Gửi bình luận</button>
		</form>
		<br>
			<div id="comment_section">

			</div>
		<script>
			$(document).ready(function(){
				var cmt = $('#comment');
				var cmt_sct = $('#comment_section');
				var cmt_inpt = $('#comment_input');
				var cmt_btn = $('#postCommentSubmit');
				cmt_sct.load('{{ action('User\AjaxController@theComment',['id'=> $thisPost->id]) }}');
				cmt_inpt.on('submit',function(e){
					e.preventDefault();
					$.ajax({
						type: "POST",
						url: "{{url('/user/the-post/the-comment/post/?post_id='.$thisPost->id)}}",
						data: cmt_inpt.serialize(),
						success: function(response) {
							cmt_sct.load('{{ action('User\AjaxController@theComment',['id'=> $thisPost->id]) }}');
							cmt.prop('disabled',true).val('Đã gửi bình luận thành công , vui lòng đợi 1 giây để được tiếp tục.').css('color','black');
							cmt_btn.prop('disabled',true);
							setTimeout(function(){
								cmt.prop('disabled',false).val('').css('color','white');
								cmt_btn.prop('disabled',false);
							},1*1000);
						},
						error: function(error) {
							alert('Thất bại.');
						}
					});
				});
			});
		</script>
	</div>		
		
	
@endsection