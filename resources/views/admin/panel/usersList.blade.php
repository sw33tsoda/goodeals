@extends('admin.index')
@section('panel_title','Danh sách người dùng')
@section('panel_highlight_usersList','bolder')
@section('panel')
@if (session()->get( 'enableMessage' ))
<div class="alert alert-{{ session()->get( 'alert' ) }}">
   <strong>Thông báo : </strong>{{ session()->get( 'message' ) }}
</div>
@endif
<table class="table table-bordered table-hover order-table text-center">
  <thead>
    <tr>
      <th class="text-center" scope="col">Mã</th>
      <th class="text-center" scope="col">Tên người dùng</th>
      <th class="text-center" scope="col">Tiền trong tài khoản</th>
      <th class="text-center" scope="col">Vai trò</th>
      <th class="text-center" scope="col">Mật khẩu</th>
      <th class="text-center" scope="col">Địa chỉ Email</th>
      <th class="text-center" scope="col">Hành động</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($usersList as $show)
    <tr>
      <td class="align-middle">{{$show->id}}</td>
      <td class="align-middle">{{$show->name}}</td>
      <td class="align-middle">{{number_format($show->balance)}} VNĐ</td>
      <td class="align-middle">{{$show->role}}</td>
      <td class="align-middle">Riêng tư</td>
      <td class="align-middle">{{$show->email}}</td>
      <td class="align-middle"><a class="btn btn-warning-custom" href="{{url('/admin/editUsers/'.$show->id)}}">Sửa</a> <a class="btn btn-danger-custom" data-toggle="modal" data-target="#modal_{{$show->id}}" href="#">Xóa</a></td>
    </tr>
    <div class="modal" id="modal_{{$show->id}}" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Xóa người sử dụng này ?</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Bạn có thể sửa lại nếu muốn thay đổi.</p>
          </div>
          <div class="modal-footer" style="border-top:0;">
            <a type="button" class="btn btn-warning-custom" href="{{url('/admin/editUsers/'.$show->id)}}">Sửa</a>
            <a type="button" class="btn btn-danger-custom"  href="{{url('/admin/deleteUsers/'.$show->id)}}">Xóa</a>
          </div>
        </div>
      </div>
    </div>
    @endforeach 
  </tbody>
</table>
{{$usersList->links()}}

@endsection