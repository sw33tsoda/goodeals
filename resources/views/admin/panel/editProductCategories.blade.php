@extends('admin.index')
@section('panel_title','Sửa nền tảng sản phẩm')
@section('panel')

<form method="POST" action="{{route('editProductCategories',['id'=>$categoryInfo])}}">
	{{csrf_field()}}
	<div class="row">
		<div class="col-lg-8"><input class="form-control" placeholder="Tên mới" name="platform_name" value="{{$categoryInfo->platform_name}}"><br></div>
		<button type="submit" class="btn btn-primary col-lg-4">Sửa</button>
	</div>
</form>

@endsection