<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Admin</title>
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
	
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script src="/vendor/unisharp/laravel-ckeditor/adapters/jquery.js"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
    <!-- <script src="{{URL::asset('js\jquery-ui-1.12.1\jquery-ui.js')}}"></script>
    <link rel="stylesheet" href="{{URL::asset('js\jquery-ui-1.12.1\jquery-ui.css')}}"> -->
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">



	<style>
		@import url(https://fonts.googleapis.com/css?family=Roboto:400,100,300,500);
		* {font-family: "Roboto", sans-serif;}
		body {
			background:#421C52;
			overflow:hidden;

		}

		.pagination>.active>a, .pagination>.active>a:focus, .pagination>.active>a:hover, .pagination>.active>span, .pagination>.active>span:focus, .pagination>.active>span:hover {
			background-color: white;
			color:black;
			border-color:black;

		}

		.pagination>li>a, .pagination>li>span {
			color:black;
		}

		.checked {
  			color: orange;
		}

		#title {
			font-size: 85px;
			font-family: 'Pacifico', cursive;
			margin-top: 5vh;
			color: white;
			text-align: center;
		}

		.form-control:focus {
			border-color: #FF0000;
			box-shadow:none;
			outline: 3.5px white dashed;
			border: none;
			background: none;
			color:white;
		}

		.form-control {
			background: none;
			color: white;
			border-radius: 24px;
			-webkit-box-shadow:inset 0 0 7.5px #000;
       		-moz-box-shadow:inset 0 0 7.5px #000;
            box-shadow:inset 0 0 7.5px #000;
            border: 0;
		}

		.form-control::placeholder {
			font-size: 10pt;
		}

		.btn-light {
			border-radius: 24px;
		}

		.setting_btn {
			font-size: 25px;
			text-decoration: none;
			color: white;
			position: absolute;
			padding: 10px;
			margin: 5px;
		}

		.setting_btn:hover {
			background-color: white;
			color:#421C52 !important; 
			/*border-radius: 25px;*/

		}

		#setting_btn_bg {
			font-size: 40px;
			font-weight: bolder;
		}

		.error { 
			color:red;
		}

		.register-box {
			color:white;
			padding: 25px;
		}


	</style>
</head>
<body>
    <div class="row">
    	<div class="col-lg-4"></div>
        <div class="register-box col-lg-4">
            <p id="title">GooDeals</p>
            <form method="POST" action="{{route('register')}}">
                {{csrf_field()}}
                <center>
                    <h2>Đăng ký</h2>
                    <hr>
                </center>
                <div class="form-group">
                    <label for="exampleInputEmail1">Tên của bạn</label>
                    <input name="name" type="name" class="form-control" placeholder="Nhập tên của bạn" spellcheck="false" value="{{old('name')}}" autocomplete="off">
                    <small class="form-text" style="font-style: italic;">Không nhất thiết khai tên thật.</small>
                </div>
                @if($errors->has('name'))
                <small class="form-text error">{{$errors->first('name')}}</small>
                <br> 
                @endif
                <div class="form-group">
                    <label for="exampleInputEmail1">Địa chỉ Email</label>
                    <input name="email" type="email" class="form-control" placeholder="Nhập địa chỉ Email" spellcheck="false" value="{{old('email')}}" autocomplete="off">
                    <small class="form-text" style="font-style: italic;">Email cần thiết cho việc liên lạc.</small>
                </div>
                @if($errors->has('email'))
                <small class="form-text error">{{$errors->first('email')}}</small>
                <br> 
                @endif
                <div class="form-group">
                    <label for="exampleInputEmail1">Mật khẩu</label>
                    <input name="password" type="password" class="form-control" placeholder="Nhập mật khẩu" spellcheck="false" value="{{old('password')}}" autocomplete="off">
                    <small class="form-text" style="font-style: italic;">Xin giữ bí mặt thông tin tài khoản.</small>
                </div>
                @if($errors->has('password'))
                <small class="form-text error">{{$errors->first('password')}}</small>
                <br> 
                @endif
                <div class="form-group">
                    <label for="exampleInputEmail1">Nhập lại mật khẩu</label>
                    <input name="password_confirmation" type="password" class="form-control" placeholder="Nhập mật khẩu" spellcheck="false" value="{{old('password')}}" autocomplete="off">
                </div>
                <button type="submit" class="btn btn-light">Đăng ký</button>
            </form>
        </div>
        <div class="col-lg-4"></div>
    </div>
</body>




</html>