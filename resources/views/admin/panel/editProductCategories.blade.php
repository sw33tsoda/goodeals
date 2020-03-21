@extends('admin.index')
@section('panel_title','Sửa nền tảng sản phẩm')
@section('panel')

<form method="POST" action="{{route('editProductCategories',['id'=>$categoryInfo])}}">
	{{csrf_field()}}
	<div class="">
		<div class=""><input class="form-control form-control-custom" placeholder="Tên mới" name="platform_name" value="{{$categoryInfo->platform_name}}"><br></div>
		<button type="submit" class="btn btn-primary-custom">Sửa</button>
	</div>
</form>

@endsection