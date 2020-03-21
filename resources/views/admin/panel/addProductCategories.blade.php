@extends('admin.index')
@section('panel_title','Thêm thể nền tảng sản phẩm')
@section('panel_highlight_addProductCategories','bolder')
@section('panel')

<form method="POST" action="{{route('addProductCategories')}}">
	{{csrf_field()}}
	<div class="">
		<div class=""><input class="form-control form-control-custom" placeholder="Tên" name="platform_name"><br></div>
		<button type="submit" class="btn btn-primary-custom">Thêm</button>
	</div>
</form>

@endsection