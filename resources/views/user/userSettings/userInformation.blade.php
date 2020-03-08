@extends('user.index') 
@section('userInformation')

<style type="text/css">
    .userInformation tbody tr td {
        border-top: 0;
        padding-top: 0;
        color: white;
    }
    
    .userInformation tbody tr td.info {
        padding-bottom: 0;
    }
    
    .profile_btn {
    	background: none;
    	border:white 2px solid;
    	width: 80px;
    	height: 40px;
    	line-height: 37px;
    	margin-left:10px;
    	margin-top:0;
    }

    .text-err {
    	color:red;
    }

    .text-msg {
    	color:white;font-size: 18pt;float:right;
    	margin-right:12px: 
    }

</style>

<div id="settings">
    <h1 id="store_title">SỬA THÔNG TIN CÁ NHÂN</h1>
    <br>
    <h5 id="store_title">THÔNG TIN CỦA BẠN</h5>
    <hr>
    <form method="POST" action="{{route('editProfile',['id'=>Auth::user()->id])}}">
    	@csrf
        <table class="table userInformation">
            <tr>
                <td class="info">Mã người dùng</td>
                <td class="info">
                    <input class="form-control" value="{{Auth::user()->id}}" name="id" disabled>
                </td>
            </tr>
            <tr>
                <td></td>
                <td><small class="form-text text-muted">Mã người dùng.</small></td>
            </tr>
            <tr>
                <td class="info">Tên người dùng</td>
                <td class="info">
                    <input class="form-control" value="{{Auth::user()->name}}" name="name">
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                	@if ($errors->has('name'))
                		<small class="form-text text-err">{{$errors->first('name')}}.</small>
                	@else
                		<small class="form-text text-muted">Không cần thiết phải sử dụng tên thật.</small>
                	@endif
                </td>
            </tr>
            <tr>
                <td class="info">Địa chỉ Email</td>
                <td class="info">
                    <input class="form-control" value="{{Auth::user()->email}}" type="Email" name="email">
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                	@if ($errors->has('email'))
                		<small class="form-text text-err">{{$errors->first('email')}}.</small>
                	@else
                		<small class="form-text text-muted">Cần thiết cho việc tìm kiếm lại tài khoản và nhận thông báo mới nhất từ cửa hàng.</small>
                	@endif
                </td>
            </tr>
            <tr>
                <td class="info">Mật khẩu</td>
                <td class="info">
                    <input class="form-control" value="" type="password" name="password">
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                	@if ($errors->has('password'))
                		<small class="form-text text-err">{{$errors->first('password')}}.</small>
                	@else
                		<small class="form-text text-muted">Mật khẩu càng dài, bảo mật càng cao.</small>
                	@endif
                </td>
            </tr>
        </table>
        <button type="submit" class="nav_tab profile_btn">SỬA</button>
        @if (\Session::has('msg'))
        	<p class="text-msg">{!! \Session::get('msg') !!}</p>
        @endif
     </form>

</div>

@endsection