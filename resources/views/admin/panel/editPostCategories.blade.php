@extends('admin.index')
@section('panel_title','Sửa thể loại bài viết')
@section('panel')

<form method="POST" action="{{route('editPostCategories',['id'=>$categoryInfo])}}">
	{{csrf_field()}}
	<div class="row">
		<div class="col-lg-8"><input class="form-control" placeholder="Tên mới" name="category_name" value="{{$categoryInfo->category_name}}"><br></div>
		<button type="submit" class="btn btn-primary col-lg-4">Sửa</button>
	</div>
</form>

@endsection