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
<form method="POST" action="{{Route('addUsers')}}" enctype="multipart/form-data">
	{{ csrf_field() }}
  <div style="margin-bottom: 40px;">
  <div class="form-group">
    <center><label for="exampleInputPassword1">Ảnh đại diện</label></center>
    <input type='file' class="form-control" id="imgInput" name="avatar" value="NULL" style="display: none;" accept=".jpg,.jpeg,.png"/><br>
    <center><a id="upload_image_button" class="btn btn-danger" style="width: auto;">Bấm vào đây để tải ảnh</a></center>
  </div>
  <center><img id="preview_img" style=";border-radius: 6px;" src="#" width="30.5%" /></center>
  <center><div id="preview_ghost" class="rounded-circle" style="border:3px dashed black;border-radius:10px;width:50%;height:50%;opacity: 0.3"><p style="line-height:100.938px;text-align: center;font-size: 25px; font-weight: bolder;">Chưa có ảnh</p></div></center>
</div>

  <div class="row">
    <div class="col-lg-6">
      <div class="form-group">
        <label for="exampleInputPassword1">Tên người dùng</label>
        <input type="name" class="form-control" id="exampleInputName1" placeholder="Name" name="name">
      </div>
    </div>
    <div class="col-lg-6">
      <div class="form-group">
        <label for="exampleInputEmail1">Địa chỉ Email</label>
        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="email">
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-6">
      <div class="form-group">
        <label for="exampleInputPassword1">Mật khẩu</label>
        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password">
      </div>
    </div>
    <div class="col-lg-6">
      <div class="form-group">
        <label for="exampleInputRole1">Vai trò</label>
        <select class="form-control" name="role">
          <option value="user">User</option>
          <option value="admin">Admin</option>
        </select>
      </div>
    </div>
  </div>
  <button type="submit" class="btn btn-primary">Thêm</button>
</form>

<script>
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