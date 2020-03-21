@extends('admin.index')
@section('panel_title','Kết quả tìm kiếm')
@section('panel')

<!-- <pre>
@php 
  {{ echo var_dump($usersResults->total()) . '<br>'; }} // Kiểm tra kết quả trả về;
@endphp
</pre> -->

@if (count($usersResults) + count($productsResults) + count($postsResults) > 0)
  <h2>Tổng có {{count($usersResults) + count($productsResults) + count($postsResults)}} kết quả.</h2>
@endif

<center>
  <h3>Danh sách người dùng (Có {{count($usersResults)}} kết quả)</h3>
</center>
@if ($usersResults->total() === 0)
  <center>Không có kết quả</center>
@else
<table class="table table-bordered table-hover order-table text-center">
  <thead>
    <tr>
      <th class="text-center" scope="col">Mã</th>
      <th class="text-center" scope="col">Tên người dùng</th>
      <th class="text-center" scope="col">Tiền trong tài khoản</th>
      <th class="text-center" scope="col">Vai trò</th>
      <th class="text-center" scope="col">Mật khẩu</th>
      <th class="text-center" scope="col">Địa chỉ Email</th>
      <th class="text-center" scope="col">Hành động</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($usersResults as $show)
    <tr>
      <td class="align-middle">{{$show->id}}</td>
      <td class="align-middle">{{$show->name}}</td>
      <td class="align-middle">{{number_format($show->balance)}} VNĐ</td>
      <td class="align-middle">{{$show->role}}</td>
      <td class="align-middle">Riêng tư</td>
      <td class="align-middle">{{$show->email}}</td>
      <td class="align-middle"><a class="btn btn-warning-custom" href="{{url('/admin/editUsers/'.$show->id)}}">Sửa</a> <a class="btn btn-danger-custom" data-toggle="modal" data-target="#modal_{{$show->id}}" href="#">Xóa</a></td>
    </tr>
    <div class="modal" id="modal_{{$show->id}}" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Xóa người sử dụng này ?</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Bạn có thể sửa lại nếu muốn thay đổi.</p>
          </div>
          <div class="modal-footer" style="border-top:0;">
            <a type="button" class="btn btn-warning-custom" href="{{url('/admin/editUsers/'.$show->id)}}">Sửa</a>
            <a type="button" class="btn btn-danger-custom"  href="{{url('/admin/deleteUsers/'.$show->id)}}">Xóa</a>
          </div>
        </div>
      </div>
    </div>
    @endforeach 
  </tbody>
</table>
@endif
{{$usersResults->appends($_GET)->links()}}

<center><h3>Danh sách sản phẩm (Có {{count($productsResults)}} kết quả)</h3></center>
@if ($productsResults->total() === 0)
  <center>Không có kết quả</center>
@else
<table class="table table-bordered table-hover order-table text-center">
  <thead>
    <tr>
      <th class="text-center" scope="col">Mã</th>
      <th class="text-center" scope="col">Tên sản phẩm</th>
      <th class="text-center" scope="col">Nhà phát triển</th>
      <th class="text-center" scope="col">Nhà phát hành</th>
      <th class="text-center" scope="col">Nền tảng</th>
      <th class="text-center" scope="col">Giá thành</th>
      <th class="text-center" scope="col">Hành động</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($productsResults as $show)
    <tr>
      <td class="align-middle">{{$show->id}}</td>
      <td class="align-middle">{{$show->name}}</td>
      <td class="align-middle">{{$show->developer}}</td>
      <td class="align-middle">{{$show->publisher}}</td>
      <td class="align-middle">{{$show->platform_name}}</td>
      <td class="align-middle">{{$show->price}}</td>
      <td class="align-middle"><a class="btn btn-success-custom" data-toggle="modal" data-target="#fullInfo_{{$show->id}}" href="#">Xem đầy đủ</a> <a class="btn btn-warning-custom" href="{{url('/admin/editProducts/'.$show->id)}}">Sửa</a> <a class="btn btn-danger-custom" data-toggle="modal" data-target="#modal_{{$show->id}}" href="#">Xóa</a>
        <!-- DELETE MODAL -->
          <div class="modal" id="modal_{{$show->id}}" role="dialog">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Xóa sản phẩm này ?</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <p style="text-align: left">Bạn có thể sửa lại nếu muốn thay đổi.</p>
                </div>
                <div class="modal-footer" style="border-top:0;">
                  <a type="button" class="btn btn-warning-custom" href="{{url('/admin/editProducts/'.$show->id)}}">Sửa</a>
                  <a type="button" class="btn btn-danger-custom"  href="{{url('/admin/deleteProducts/'.$show->id)}}">Xóa</a>
                </div>
              </div>
            </div>
          </div>
          <!-- FULL INFO MODAL -->

          <div class="modal" id="fullInfo_{{$show->id}}" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Thông tin đầy đủ</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <div class="col-lg-5">
                      @if ($show->image == 'to_be_uploaded')
                        <center>{{"Không có ảnh"}}</center>
                      @else
                        <img src="/storage/uploads/product_images/{{$show->image}}" width="100%">
                      @endif
                    </div>
                    <div class="col-lg-7">
                      <ul class="nav nav-tabs" style="border:none;">
                        <li style="width:50%;"><a class="btn btn-success-custom" style="width: 95%" data-toggle="tab" href="#info_{{$show->id}}">Thông tin</a></li>
                        <li style="width:50%;"><a class="btn btn-success-custom" style="width: 95%" data-toggle="tab" href="#reviews_{{$show->id}}">Đánh giá</a></li>
                      </ul>
                      <div class="tab-content">
                        <div id="info_{{$show->id}}" class="tab-pane fade in active">
                          <br>
                          <table class="table table-bordered" border="0" style="font-size: 12px;">
                            <tr>
                              <td>Tên sản phẩm</td>
                              <td>{{$show->name}}</td>
                            </tr>
                            <tr>
                              <td>Nhà phát triển</td>
                              <td>{{$show->developer}}</td>
                            </tr>
                            <tr>
                              <td>Nhà phát hành</td>
                              <td>{{$show->publisher}}</td>
                            </tr>
                            <tr>
                              <td>Nền tảng</td>
                              <td>{{$show->platform_name}}</td>
                            </tr>
                            <tr>
                              <td>Giá thành</td>
                              <td>{{$show->price}}</td>
                            </tr>
                            <tr>
                              <td>Đánh giá</td>
                              <td>
                                @php {{$sum = 0;$count = 0;$avg = (float) 0;$is_rating = false;$ratingLimit = 5;}} @endphp
                                @foreach ($getRating as $rating)
                                  <?php
                                    $sum = $rating->rate + $sum; $count = $count + 1;
                                    if ($rating->product_id == $show->id) {
                                      $is_rating = true;
                                    }
                                  ?>
                                @endforeach
                                @if ($is_rating) 
                                  {{ round($avg = $sum / $count,2) }}/5
                                  {!! str_repeat('<span style="color: orange" class="fa fa-star checked"></span>',(int)$avg) !!}{!! str_repeat('<span style="color:grey" class="fa fa-star"></span>',$ratingLimit - (int)$avg) !!}
                                  @switch((int)$avg)
                                    @case(1) {{"(Rất tệ)"}} @break
                                    @case(2) {{"(Tệ)"}} @break
                                    @case(3) {{"(Ổn)"}} @break
                                    @case(4) {{"(Hay)"}} @break
                                    @case(5) {{"(Rất hay)"}} @break
                                  @endswitch
                                @else
                                  <center>{{"Chưa có đánh giá nào"}}</center>
                                @endif
                              </td>
                            </tr>
                          </table>
                        </div>
                        <div id="reviews_{{$show->id}}" class="tab-pane fade" style="overflow: scroll;height: 500px;margin-top: 5px;">
                          <h3>Đánh giá</h3>
                          @if (count($reviewsList) > 0)
                            @php {{$is_match = true;}} @endphp
                            @foreach ($reviewsList as $showReviews)
                              @if ($showReviews->product_id == $show->id)
                                <div class="media" style="text-align: left;">
                                  <div class="media-left">
                                    @if ($showReviews->avatar == 'to_be_uploaded')
                                      <img class="img-circle" src="https://www.brandeps.com/icon-download/U/User-02.svg" style="width:60px">
                                    @else
                                      <img class="img-circle" src="/storage/uploads/avatar_images/{{$showReviews->avatar}}" class="media-object" style="width:60px">
                                    @endif
                                  </div>
                                  <div class="media-body" style="padding-left: 5px;">
                                    {!!str_repeat('<span class="fa fa-star checked" style="color: orange"></span>',$showReviews->rate)!!}{!!str_repeat('<span class="fa fa-star" style="color:grey"></span>',$ratingLimit - $showReviews->rate)!!}
                                    @switch($showReviews->rate)
                                      @case(1) {{"(Rất tệ)"}} @break
                                      @case(2) {{"(Tệ)"}} @break
                                      @case(3) {{"(Ổn)"}} @break
                                      @case(4) {{"(Hay)"}} @break
                                      @case(5) {{"(Rất hay)"}} @break
                                    @endswitch
                                    <p style="font-size: 12px;"><span style="font-weight: bold;font-size: 14pt;">{{$showReviews->name}}</span> {{$showReviews->review}} <a href="{{route('deleteReviews',['id' => $showReviews->id])}}">Xóa đánh giá này</a></p>
                                  </div>
                                </div>
                              @else
                                <?php $is_match = false; ?>
                              @endif
                            @endforeach
                            @if (!$is_match)
                              {{"Không có đánh giá nào cả"}}
                            @endif
                          @else
                              <center>{{ "Không có đánh giá nào cả" }}</center>
                          @endif
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="modal-footer" style="border-top:0;">
                  <a type="button" class="btn btn-default" href="" data-dismiss="modal">Đóng</a>
                </div>
              </div>
            </div>
          </div>
      </td>
    </tr>
    @endforeach 
  </tbody>
</table>
@endif
{{$productsResults->appends($_GET)->links()}}

<center><h3>Danh sách bài viết (Có {{count($postsResults)}} kết quả)</h3></center>
@if ($postsResults->total() === 0)
  <center>Không có kết quả</center>
@else

<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="panel-group" id="accordion">
   @foreach ($postsResults as $show)
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
@endif
<br>
{{$postsResults->appends($_GET)->links()}}

@endsection