@extends('admin.index')
@section('panel_title','Thêm thể nền tảng sản phẩm')
@section('panel_highlight_addProductCategories','bolder')
@section('panel')

<form method="POST" action="{{route('addProductCategories')}}">
	{{csrf_field()}}
	<div class="row">
		<div class="col-lg-8"><input class="form-control" placeholder="Tên" name="platform_name"><br></div>
		<button type="submit" class="btn btn-primary col-lg-4">Thêm</button>
	</div>
</form>

@endsection