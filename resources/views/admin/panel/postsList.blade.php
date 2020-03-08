@extends('admin.index')
@section('panel_title','Danh sách bài viết')
@section('panel_highlight_postsList','bolder')
@section('panel')
@if (session()->get( 'enableMessage' ))
<div class="alert alert-{{ session()->get( 'alert' ) }}">
   <strong>Thông báo : </strong>{{ session()->get( 'message' ) }}
</div>
@endif

<div class="row">
  <div class="col-lg-10">
    @if ($postsList->total() === 0)
      <center>Không có bài viết</center>
    @else
    <div class="panel-group" id="accordion">
      @foreach ($postsList as $show)
      <div class="panel panel-default" style="margin-top: 5px;">
        <div class="panel-heading">
          <h4 class="panel-title">
            <a data-toggle="collapse" data-parent="#accordion" href="#posts_{{$show->id}}">
            {{$show->title}}</a> 
          </h4>
        </div>
        <div id="posts_{{$show->id}}" class="panel-collapse collapse">
          <div class="panel-body">
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
            <p style="font-style: italic;margin-top: 25px;">( Ngày đăng : {{\Carbon\Carbon::parse($show->created_at)->format('h:m A (d/m/Y)')}} @if($show->updated_at != NULL), Đã sửa ngày : {{$show->updated_at}}@endif )</p>
            <a class="btn btn-default" href="{{url('/admin/editPosts/'.$show->id)}}">Sửa</a> <a class="btn btn-danger" data-toggle="modal" data-target="#modal_{{$show->id}}" style="cursor: pointer;">Xóa</a> 
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
                    <a type="button" class="btn btn-default" href="{{url('/admin/editPosts/'.$show->id)}}">Sửa</a>
                    <a type="button" class="btn btn-danger" href="{{url('/admin/deletePosts/'.$show->id)}}">Xóa</a>
                  </div>
                </div>      
              </div>
            </div>
            <br>
            <br>
            <form method="POST" action="{{ route('addComments',['post_id' => $show->id]) }}" class="commentId_{{$show->id}}">
              @csrf
              <div class="row">
                <div class="col-lg-10" style="padding-right:0px;">
                  <input class="form-control ajax_input_{{$show->id}}" name="comment" placeholder="Bình luận...">
                </div>
                <div class="col-lg-2">
                  <button class="form-control ajax_btn_{{$show->id}}" type="submit">Gửi</button>
                </div>
              </div>
            </form>
            <!-- <br> -->
            <!-- <a class="ajax_showComments_{{$show->id}}" style="cursor: pointer;">Bấm vào đây để xem các bình luận</a> -->
            <!-- <br> -->
            <div id="ajax_theComments_{{$show->id}}" style="margin-top: 10px;">
              <br>
            </div>
            <a href="{{url('viewPosts/'.$show->id)}}" style="cursor: pointer;margin-top: 10px;">Xem đầy đủ</a>
          </div>
        </div>
      </div>
      <script>       
        // Khai báo biến input_ và btn_ cho Ajax
        var input_{{$show->id}} = $('.ajax_input_{{$show->id}}');
        var btn_{{$show->id}} = $('.ajax_btn_{{$show->id}}');
        var load_{{$show->id}} = $('.ajax_showComments_{{$show->id}}');
        var theComments_{{$show->id}} = $('#ajax_theComments_{{$show->id}}');
          ///////////////////////////// ADD COMMENT /////////////////////////////////
          theComments_{{$show->id}}.load('{{ action('Admin\AjaxController@autoRefreshComments',['id' => $show->id]) }}'); // AUTO REFRESH
          $('.commentId_{{$show->id}}').on('submit',function(e){
            e.preventDefault();
            $.ajax({ // nhập comment -> (post) -> db
              type: "POST",
              url: "{{url('admin/addComments/post?post_id='.$show->id)}}",
              data: $('.commentId_{{$show->id}}').serialize(),
              success: function(response) { // Nếu gửi bình luận thành công thì , cooldown 1 giây cho bình luân tiếp theo
                theComments_{{$show->id}}.load('{{ action('Admin\AjaxController@autoRefreshComments',['id' => $show->id]) }}');
                input_{{$show->id}}.prop('disabled', true).val('Đã gửi. Đợi 1 giây để bình luận lại');
                btn_{{$show->id}}.prop('disabled', true);
                setTimeout(function(){ // cooldown timer
                    input_{{$show->id}}.prop('disabled' ,false).val(null);
                    btn_{{$show->id}}.prop('disabled', false);
                }, 1000);
              },
              error: function(error) {
                // console.log(error)
                alert('Thêm bình luận thất bại');
              }
            });
          });
          ////////////////////////////// LOAD COMMENTS //////////////////////////////
          // theComments_{{$show->id}}.hide();
          // load_{{$show->id}}.on('click',function(){
          //   theComments_{{$show->id}}.show();
          // });
      </script>
      @endforeach
    </div>
    @endif
  </div>
  <div class="col-lg-2">
    <a href="#">Hôm nay</a><br>
    <a href="#">Tuần trước</a><br>
    <a href="#">Tháng trước</a><br>
    <a href="#">Tất cả</a><br>
  </div>
</div>

<script>
  
</script>
{{$postsList->links()}}
@endsection