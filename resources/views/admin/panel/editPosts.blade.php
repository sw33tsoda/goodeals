@extends('admin.index')
@section('panel_title','Sửa bài viêt')
@section('panel')

@if ($errors->any())
  <div class="alert alert-danger">
    @if ($errors->has('title')) <strong>Tiêu đề : </strong>{{$errors->first('title')}}<br> @endif
    @if ($errors->has('image')) <strong>Ảnh minh họa : </strong>{{$errors->first('image')}}<br> @endif
    @if ($errors->has('content')) <strong>Nội dung : </strong>{{$errors->first('content')}}<br> @endif
    @if ($errors->has('author')) <strong>Tác giả : </strong>{{$errors->first('author')}}<br> @endif
  </div>
@endif
<form method="POST" action="{{url('/admin/editPosts/post/')}}/{{$postInfo->id}}" enctype="multipart/form-data">
	{{ csrf_field() }}
  <div class="row">
    <div class="col-lg-6">
      <div class="form-group">
        <label for="exampleInputPassword1">Tiêu đề</label>
        <input type="text" class="form-control" id="exampleInputName1" placeholder="Tiêu đề" name="title" value="{{$postInfo->title}}">
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Tác giả<sup>(Không nhất thiết khai tên thật.)</sup></label>
        <input type="text" class="form-control" id="exampleInputName1" placeholder="Tác giả" name="author" value="{{$postInfo->author}}">
      </div>
    </div>
    <div class="col-lg-6">
      <div class="form-group">
        <div class="row">
          <div class="col-lg-6">
            <div class="form-group">
              <label for="exampleInputPassword1">Ảnh đính kèm</label>
              <input type='file' class="form-control" id="imgInput" name="image" value="NULL" style="display: none;" accept=".jpg,.jpeg,.png"/><br>
              <a id="upload_image_button" class="btn btn-danger-custom" style="width: 100%;color:white">Bấm vào đây để thay ảnh</a>
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Loại tin</label>
              <select class="form-control" name="category_id">
                <option value="{{$postCategoriesById->id}}">Mặc định : {{$postCategoriesById->category_name}}</option>
                @foreach ($showCategories as $show)
                  <option value="{{$show->id}}">{{$show->category_name}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="col-lg-6">
            @if ($postInfo->image == "to_be_uploaded")
              <div id="preview_ghost" style="border-radius:10px;height:107.938px;width:100%;opacity: 0.3"><p style="line-height:100.938px;text-align: center;font-size: 25px; font-weight: bolder;">Chưa có ảnh</p></div>
            @else
              <img id="preview_ghost" style="margin-top:25px;border-radius: 6px;" src="/storage/uploads/post_images/{{$postInfo->image}}" width="95%" />
            @endif
            <img id="preview_img" style="margin-top:25px;border-radius: 6px;" src="#" width="95%" />
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Nội dung</label>
    <textarea type="text" class="form-control" id="ckeditor" placeholder="Nội dung" name="content">{{$postInfo->content}}</textarea>
  </div>
  <button type="submit" class="btn btn-primary-custom">Sửa</button>
</form>

<script>
    $('#ckeditor').ckeditor();
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