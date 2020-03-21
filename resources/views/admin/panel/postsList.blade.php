@extends('admin.index')
@section('panel_title','Danh sách bài viết')
@section('panel_highlight_postsList','bolder')
@section('panel')
@if (session()->get( 'enableMessage' ))
<div class="alert alert-{{ session()->get( 'alert' ) }}">
   <strong>Thông báo : </strong>{{ session()->get( 'message' ) }}
</div>
@endif
<meta name="csrf-token" content="{{ csrf_token() }}">
<div>
   <div>
      @if ($postsList->total() === 0)
      <center>Không có bài viết</center>
      @else
      <div class="panel-group" id="accordion">
         @foreach ($postsList as $show)
         <div class="panel panel-default" style="margin-top: 5px;">
            <div class="panel-heading panel-heading-custom">
               <h4 class="panel-title" style="margin:0">
                  <a class="align-middle" style="text-decoration: none;" onclick="loadComment({{$show->id}})" data-toggle="collapse" data-parent="#accordion" href="#posts_{{$show->id}}">
                  {{$show->title}}</a>
                  <span style="float:right">{{\Carbon\Carbon::parse($show->created_at)->format('h:i A (d/m/Y)')}}</span>
               </h4>
            </div>
            <div id="posts_{{$show->id}}" class="panel-collapse collapse">
               <div class="panel-body row" style="padding: 15px">
                  <div class="col-lg-8 post-section">
                     <center style="font-weight: bold;font-size: 20px;">
                        {{$show->title}}
                     </center>
                     <center style="margin-top: 25px;">
                        @if ($show->image != "to_be_uploaded")
                        <img src="/storage/uploads/post_images/{{$show->image}}" class="img-rounded" height="20%" width="50%"> 
                        @endif
                     </center>
                     <p style="margin-top: 25px;text-indent:50px;">{!!$show->content!!}</p>
                     <p style="text-align: right;font-style:italic;margin-top: 25px;">{{$show->author}} (user_id : {{$show->user_id}})</p>
                     <p style="font-style: italic;margin-top: 25px;"> Ngày đăng : {{\Carbon\Carbon::parse($show->created_at)->format('h:i A (d/m/Y)')}} @if($show->updated_at != NULL), Đã sửa ngày : {{$show->updated_at}}@endif </p>
                     <a class="btn btn-warning-custom" href="{{url('/admin/editPosts/'.$show->id)}}">Sửa</a> <a class="btn btn-danger-custom" style="color: white" data-toggle="modal" data-target="#modal_{{$show->id}}" style="cursor: pointer;">Xóa</a>
                     <div class="modal fade" id="modal_{{$show->id}}" role="dialog">
                        <div class="modal-dialog modal-sm">
                           <div class="modal-content">
                              <div class="modal-header" style="border-bottom:0;">
                                 <button type="button" class="close" data-dismiss="modal">&times;</button>
                                 <h4 class="modal-title">Xóa bài viết này ?</h4>
                              </div>
                              <div class="modal-body">
                                 <p>Bạn có thể sửa lại nếu muốn thay đổi.</p>
                              </div>
                              <div class="modal-footer" style="border-top:0;">
                                 <a type="button" class="btn btn-warning-custom" href="{{url('/admin/editPosts/'.$show->id)}}">Sửa</a>
                                 <a type="button" class="btn btn-danger-custom" href="{{url('/admin/deletePosts/'.$show->id)}}">Xóa</a>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-4 comment-section">
                     <div class="row">
                        <div class="col-10 col-sm-10 col-lg-10" style="padding-right:0px;">
                           <input class="form-control form-control-custom ajax_input_{{$show->id}}" name="comment" placeholder="Bình luận...">
                        </div>
                        <div class="col-2 col-sm-2 col-lg-2">
                           <button class="ajax_btn_{{$show->id}} btn btn-primary-custom" type="submit" onclick="addComment({{$show->id}})">Gửi</button>
                        </div>
                     </div>
                     <div id="ajax_theComments_{{$show->id}}" style="margin-top: 10px;">
                        <br>
                     </div>
                     <a onclick="loadMoreComments({{$show->id}})" style="cursor: pointer;margin-top: 10px;">Xem đầy đủ</a>
                  </div>
               </div>
            </div>
         </div>
         <input type="hidden" class="max_comments_{{$show->id}}" value="5">
         @endforeach
      </div>
      @endif
   </div>
</div>

<script>
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  function loadComment(id) {
    let theComments = $('#ajax_theComments_'+id);
    let max_comments = $('.max_comments_'+id);
    theComments.load("{{route('getComments')}}?id="+id+"&number_of_comments="+max_comments.val());
  }

  function loadMoreComments(id) {
    let theComments = $('#ajax_theComments_'+id);
    let max_comments = $('.max_comments_'+id);
    let more_comments = parseInt(max_comments.val()) + 5;
    console.log(more_comments);
    theComments.load("{{route('getComments')}}?id="+id+"&number_of_comments="+more_comments);
    max_comments.val(more_comments);
  }

  function addComment(id) {
    let input = $('.ajax_input_'+id);
    let btn = $('.ajax_btn_'+id);
    let load = $('.ajax_showComments_'+id);
    let theComments = $('#ajax_theComments_'+id);
    let max_comments = $('.max_comments_'+id);
    $.ajax({
      type: "POST",
      url: "{{route('addComments')}}?post_id="+id,
      data: {
        comment:input.val(),
      },
      success: function(response) { // cooldown 1 giây cho bình luân tiếp theo
        let increase_max_comments = parseInt(max_comments.val()) + 1;
        max_comments.val(increase_max_comments);
        theComments.load("{{route('getComments')}}?id="+id+"&number_of_comments="+increase_max_comments);
        input.prop('disabled', true).val('Đã gửi. Đợi 1 giây để bình luận lại');
        btn.prop('disabled', true);
        setTimeout(function(){ // cooldown timer
            input.prop('disabled' ,false).val(null);
            btn.prop('disabled', false);
        }, 1000);
      },
      error: function(error) {
        alert('Thêm bình luận thất bại');
      }
    });
  }

  function deleteComment(id,post_id) {
    let deleteComment = $('#deleteComments_'+id);
    let thisComment = $('#ajax_thisComment_'+id);
    let theComments = $('#ajax_theComments_'+post_id);
    thisComment.fadeOut(500);
    setTimeout(function(){ 
      thisComment.load("{{route('deleteComments')}}?id="+id);
      thisComment.popup(); //anti glitch
      theComments.load("{{route('getComments')}}?id="+post_id);
    }, 500);    
  }
</script>
<br>
{{$postsList->links()}}
@endsection