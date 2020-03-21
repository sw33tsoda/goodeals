@extends('admin.index')
@section('panel_title','Danh sách thể loại')
@section('panel_highlight_showAllCategories','bolder')
@section('panel')
@if (session()->get( 'enableMessage' ))
<div class="alert alert-{{ session()->get( 'alert' ) }}">
   <strong>Thông báo : </strong>{!! session()->get( 'message' ) !!}
</div>
@endif
<div class="row">
	<div class="col-lg-6">
		<center>
			<h3>Loại sản phẩm</h3>
			@if (count($productCategories) > 0)
				@foreach($productCategories as $showProductCategories)
					<p>{{$showProductCategories->platform_name}}  <a class="btn btn-warning-custom" href="{{route('editProductCategories_view',['id'=>$showProductCategories->id])}}">Sửa</a> <a class="btn btn-danger-custom" data-toggle="modal" data-target="#modal_{{$showProductCategories->id}}" href="">Xóa</a></p>
		            <div class="modal" id="modal_{{$showProductCategories->id}}" role="dialog">
				      <div class="modal-dialog" role="document">
				        <div class="modal-content">
				          <div class="modal-header">
				            <h5 class="modal-title">Xóa  ?</h5>
				            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				              <span aria-hidden="true">&times;</span>
				            </button>
				          </div>
				          <div class="modal-body">
				            <p>Bạn có thể sửa lại nếu muốn thay đổi.</p>
				          </div>
				          <div class="modal-footer" style="border-top:0;">
		                    <a type="button" class="btn btn-warning-custom" href="{{route('editProductCategories_view',['id'=>$showProductCategories->id])}}">Sửa</a>
		                    <a type="button" class="btn btn-danger-custom" href="{{route('deleteProductCategories',['id'=>$showProductCategories->id])}}">Xóa</a>
		                  </div>
				        </div>
				      </div>
				    </div>
				@endforeach
			@else
			{{"Không có nền tảng nào"}}
			@endif
		</center>
	</div>
	<div class="col-lg-6">
		<center>
		<h3>Loại bài viết ({{count($postCategories)}})</h3>
			@if (count($postCategories) > 0)
				@foreach($postCategories as $showPostCategories)
					<p>{{$showPostCategories->category_name}}  <a class="btn btn-warning-custom" href="{{route('editPostCategories_view',['id'=>$showPostCategories->id])}}">Sửa</a> <a class="btn btn-danger-custom" data-toggle="modal" data-target="#modal_{{$showPostCategories->id}}" href="">Xóa</a></p>
		            <div class="modal" id="modal_{{$showPostCategories->id}}" role="dialog">
				      <div class="modal-dialog" role="document">
				        <div class="modal-content">
				          <div class="modal-header">
				            <h5 class="modal-title">Xóa  ?</h5>
				            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				              <span aria-hidden="true">&times;</span>
				            </button>
				          </div>
				          <div class="modal-body">
				            <p>Bạn có thể sửa lại nếu muốn thay đổi.</p>
				          </div>
				          <div class="modal-footer" style="border-top:0;">
		                    <a type="button" class="btn btn-warning-custom" href="{{route('editPostCategories_view',['id'=>$showPostCategories->id])}}">Sửa</a>
		                    <a type="button" class="btn btn-danger-custom" href="{{route('deletePostCategories',['id'=>$showPostCategories->id])}}">Xóa</a>
		                  </div>
				        </div>
				      </div>
				    </div>
				@endforeach
			@else
			{{"Không có thể loại nào"}}
			@endif
		</center>
	</div>
</div>

@endsection