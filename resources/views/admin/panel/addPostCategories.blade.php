@extends('admin.index')
@section('panel_title','Thêm thể loại bài viết')
@section('panel_highlight_addPostCategories','bolder')
@section('panel')

<form method="POST" action="{{route('addPostCategories')}}">
	{{csrf_field()}}
	<div class="row">
		<div class="col-lg-8"><input class="form-control form-control-custom" placeholder="Tên" name="category_name"><br></div>
		<button type="submit" class="btn btn-primary col-lg-4">Thêm</button>
	</div>
</form>

@endsection