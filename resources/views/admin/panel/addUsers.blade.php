@extends('admin.index')
@section('panel_title','Thêm người dùng')
@section('panel_highlight_addUsers','bolder')
@section('panel')
@if ($errors->any())
  <div id="errors_ajax" class="alert alert-danger">
    @if ($errors->has('name')) <strong>Tên người dùng : </strong>{{$errors->first('name')}}<br> @endif
    @if ($errors->has('email')) <strong>Địa chỉ Email : </strong>{{$errors->first('email')}}<br> @endif
    @if ($errors->has('password')) <strong>Mật khẩu : </strong>{{$errors->first('password')}}<br> @endif
    @if ($errors->has('avatar')) <strong>Avatar : </strong>{{$errors->first('avatar')}}@endif
  </div>
@endif
<form class="addUsers row" method="POST" action="{{route('addUsers')}}" enctype="multipart/form-data">
	{{ csrf_field() }}
  <div class="col-lg-6">
  <div class="row">
    <div class="col-lg-6">
      <div class="form-group">
        <label for="exampleInputPassword1">Tên người dùng</label>
        <input type="name" class="form-control form-control-custom" id="exampleInputName1" placeholder="Name" name="name">
      </div>
    </div>
    <div class="col-lg-6">
      <div class="form-group">
        <label for="exampleInputEmail1">Địa chỉ Email</label>
        <input type="email" class="form-control form-control-custom" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="email">
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-6">
      <div class="form-group">
        <label for="exampleInputPassword1">Mật khẩu</label>
        <input type="password" class="form-control form-control-custom" id="exampleInputPassword1" placeholder="Password" name="password">
      </div>
    </div>
    <div class="col-lg-6">
      <div class="form-group">
        <label for="exampleInputRole1">Vai trò</label>
        <select class="form-control form-control-custom" name="role">
          <option value="user">User</option>
          <option value="admin">Admin</option>
        </select>
      </div>
    </div>
  </div>
</div>
<div class="col-lg-6" style="margin-bottom: 40px;">
    <div class="form-group">
      <center><label for="exampleInputPassword1">Ảnh đại diện</label></center>
      <input type='file' class="form-control" id="imgInput" name="avatar" value="NULL" style="display: none;" accept=".jpg,.jpeg,.png"/>
      <center><a id="upload_image_button" class="btn btn-danger-custom" style="width: auto;color:white">Bấm vào đây để tải ảnh</a></center>
      <center><div id="preview_ghost" style="border-radius:10px;height:100%;width:100%;opacity: 0.3"><p style="line-height:100.938px;text-align: center;font-size: 25px; font-weight: bolder;">Chưa có ảnh</p></div></center>
    </div>
    <center><img id="preview_img" style=";border-radius: 6px;" src="#" width="30.5%" /></center>
  </div>
</form>
<button type="submit" class="btn btn-primary-custom submit">Thêm</button>
<script>
    $('.submit').on('click',function(){
      $('.addUsers').submit();
    });
    $('#preview_img').hide();
    $('#upload_image_button').click(function(){ 
      $('#imgInput').trigger('click'); 
    });
    function preview_image(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();      
        reader.onload = function (e) {
            $('#preview_img').attr('src', e.target.result);
            $('#preview_img').show(500);
            $('#preview_ghost').hide(100);
        }     
        reader.readAsDataURL(input.files[0]);
      }
    } 
    $("#imgInput").change(function(){
        preview_image(this);
    });
</script>

@endsection