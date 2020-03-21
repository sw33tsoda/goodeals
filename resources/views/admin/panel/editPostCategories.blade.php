@extends('admin.index')
@section('panel_title','Sửa thể loại bài viết')
@section('panel')

<form method="POST" action="{{route('editPostCategories',['id'=>$categoryInfo])}}">
	{{csrf_field()}}
	<div class="">
		<div class=""><input class="form-control form-control-custom" placeholder="Tên mới" name="category_name" value="{{$categoryInfo->category_name}}"><br></div>
		<button type="submit" class="btn btn-primary-custom">Sửa</button>
	</div>
</form>

@endsection