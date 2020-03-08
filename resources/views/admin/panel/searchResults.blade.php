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
  <table class="table text-center">
    <thead>
      <tr>
        <th class="text-center" scope="col">Mã</th>
        <th class="text-center" scope="col">Tên người dùng</th>
        <th class="text-center" scope="col">Vai trò</th>
        <th class="text-center" scope="col">Mật khẩu</th>
        <th class="text-center" scope="col">Địa chỉ Email</th>
        <th class="text-center" scope="col">Hành động</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($usersResults as $users)
      <tr>
        <th scope="row">{{$users->id}}</th>
        <td>{{$users->name}}</td>
        <td>{{$users->role}}</td>
        <td>Riêng tư</td>
        <td>{{$users->email}}</td>
        <td><a class="btn btn-default" href="{{url('/admin/editUsers/'.$users->id)}}">Sửa</a> <a class="btn btn-danger" data-toggle="modal" data-target="#modal_{{$users->id}}" href="#">Xóa</a></td>
      </tr>
      <div class="modal fade" id="modal_{{$users->id}}" role="dialog">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <div class="modal-header" style="border-bottom:0;">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Xóa người sử dụng này ?</h4>
          </div>
          <div class="modal-body">
            <p>Bạn có thể sửa lại nếu muốn thay đổi.</p>
          </div>
          <div class="modal-footer" style="border-top:0;">
            <a type="button" class="btn btn-default" href="{{url('/admin/editUsers/'.$users->id)}}">Sửa</a>
            <a type="button" class="btn btn-danger"  href="{{url('/admin/deleteUsers/'.$users->id)}}">Xóa</a>
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
 <table class="table table-bordered text-center">
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
      <td>{{$show->id}}</th>
      <td>{{$show->name}}</td>
      <td>{{$show->developer}}</td>
      <td>{{$show->publisher}}</td>
      <td>{{$show->platform_name}}</td>
      <td>{{$show->price}}</td>
      <td><a class="btn btn-default" href="{{url('/admin/editProducts/'.$show->id)}}">Sửa</a> <a class="btn btn-danger" data-toggle="modal" data-target="#modal_{{$show->id}}" href="#">Xóa</a></td>
    </tr>
    <div class="modal fade" id="modal_{{$show->id}}" role="dialog">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <div class="modal-header" style="border-bottom:0;">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Xóa sản phẩm này ?</h4>
          </div>
          <div class="modal-body">
            <p>Bạn có thể sửa lại nếu muốn thay đổi.</p>
          </div>
          <div class="modal-footer" style="border-top:0;">
            <a type="button" class="btn btn-default" href="{{url('/admin/editProducts/'.$show->id)}}">Sửa</a>
            <a type="button" class="btn btn-danger"  href="{{url('/admin/deleteProducts/'.$show->id)}}">Xóa</a>
          </div>
        </div>      
      </div>
    </div>
    @endforeach 
  </tbody>
</table>
@endif
{{$productsResults->appends($_GET)->links()}}

<center><h3>Danh sách bài viết (Có {{count($postsResults)}} kết quả)</h3></center>
@if ($postsResults->total() === 0)
  <center>Không có kết quả</center>
@else
<div class="panel-group" id="accordion">
      @foreach ($postsResults as $show)
      <div class="panel panel-default">
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
            <p style="font-style: italic;margin-top: 25px;">( Ngày đăng : {{$show->created_at}} @if($show->updated_at != NULL), Đã sửa ngày : {{$show->updated_at}}@endif )</p>
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
          </div>
        </div>
      </div>
      @endforeach
    </div>
@endif
{{$postsResults->appends($_GET)->links()}}

@endsection