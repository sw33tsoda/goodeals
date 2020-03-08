@extends('admin.index')
@section('panel_title','Thêm sản phẩm')
@section('panel_highlight_addProducts','bolder')
@section('panel')
@if ($errors->any())
  <div class="alert alert-danger">
    @if ($errors->has('name')) <strong>Tên sản phẩm : </strong>{{$errors->first('name')}}<br> @endif
    @if ($errors->has('developer')) <strong>Nhà phát triển : </strong>{{$errors->first('developer')}}<br> @endif
    @if ($errors->has('publisher')) <strong>Nhà phát hành : </strong>{{$errors->first('publisher')}}<br> @endif
    @if ($errors->has('platform_id')) <strong>Nền tảng : </strong>{{$errors->first('platform_id')}}<br> @endif
    @if ($errors->has('price')) <strong>Giá thành : </strong>{{$errors->first('price')}}<br> @endif
    @if ($errors->has('image')) <strong>Ảnh sản phẩm : </strong>{{$errors->first('image')}}<br> @endif
    @if ($errors->has('desc')) <strong>Mô tả sản phẩm : </strong>{{$errors->first('desc')}} @endif
  </div>
@endif
<form method="POST" action="{{Route('addProducts')}}" enctype="multipart/form-data">
	{{ csrf_field() }}
  <div class="row">
    <div class="col-lg-6">
      <div class="form-group">
        <label for="exampleInputPassword1">Tên sản phẩm</label>
        <input type="text" class="form-control" id="exampleInputName1" placeholder="Name" name="name">
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Nhà sản xuất</label>
        <input type="text" class="form-control" id="exampleInputName1" placeholder="Developer" name="developer">
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Nhà phát hành</label>
        <input type="text" class="form-control" id="exampleInputName1" placeholder="Publisher" name="publisher">
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Nền tảng</label>
        <select class="form-control" name="platform_id">
          <option value="">Chưa chọn nền tảng</option>
          @foreach ($showCategories as $show)
            <option value="{{$show->id}}">{{$show->platform_name}}</option>
          @endforeach
        </select>
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Giá</label>
        <input type="text" class="form-control" id="exampleInputName1" placeholder="Price" name="price">
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Mô tả sản phẩm</label>
        <textarea type="text" class="form-control" id="exampleInputName1" placeholder="Description" name="desc"></textarea>
      </div>
    </div>
    <div class="col-lg-6">
      <div class="form-group">
        <label for="exampleInputPassword1">Ảnh đính kèm</label>
        <input type='file' class="form-control" id="imgInput" name="image" value="NULL" style="display: none;" accept=".jpg,.jpeg,.png"/><br>
        <a id="upload_image_button" class="btn btn-danger" style="width: 100%;">Bấm vào đây để tải ảnh</a>
      </div>
      <center><img id="preview_img" style="margin-top:25px;border-radius: 6px;" src="#" width="62.5%" /></center>
      <center><div id="preview_ghost" style="margin-top:40px;border:3px dashed black;border-radius:10px;height:349.953px;width:62.5%;opacity: 0.3"><p style="line-height:100.938px;text-align: center;font-size: 25px; font-weight: bolder;">Chưa có ảnh</p></div></center>
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