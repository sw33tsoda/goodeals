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

		#left_section {
			background: url(https://zicxa.com/hinh-anh/wp-content/uploads/2020/02/Tổng-hợp-hình-nền-Game-Wallpaper-đẹp-nhất-49.jpg);
		}

		#right_section {
			height: 100vh;
			vertical-align: middle;
			color: white;
			/*background:#421C52;*/
			background-size: 282.84px 282.84px;
			-webkit-box-shadow: -5px 0px 22px 6px rgba(0,0,0,0.26);
-moz-box-shadow: -5px 0px 22px 6px rgba(0,0,0,0.26);
box-shadow: -5px 0px 22px 6px rgba(0,0,0,0.26);
		}

		#title {
			font-size: 85px;
			font-family: 'Pacifico', cursive;
			margin-top: 50px;
			height: 150px;
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


	</style>
</head>
<body>
	<div class="container-fluid h-100">
		<div class="row h-100">
			<div class="col-lg-9" id="left_section">
			</div>
			<div class="col-lg-3" id="right_section">
				<div class="row h-100">
					<div class="col-lg-1"></div>
					<div class="col-lg-10">
						<center><p id="title">GooDeals</p><!-- <p style="font-style: italic;">Đúng loại , đúng rẻ !</p> --></center>
						<form id="log_form" method="POST" action="{{ route('login') }}">
							{{csrf_field()}}
							<center><h2>Đăng nhập</h2></center>
						  <div class="form-group">
						    <label for="exampleInputEmail1">Địa chỉ Email</label>
						    <input name="email" type="email" class="form-control" aria-describedby="emailHelp" placeholder="Nhập địa chỉ Email" spellcheck="false" value="{{old('email')}}" autocomplete="off">
						    <small class="form-text" style="font-style: italic;">Xin giữ bí mặt thông tin tài khoản. <a id="register" href="{{route('register_view')}}" tabindex="-1">Chưa đăng ký ?</a></small>
						  </div>
						  @if($errors->has('email'))
						  	<small class="form-text error">{{$errors->first('email')}}</small>
						  	<br>
						  @endif
						  <div class="form-group">
						    <label for="exampleInputPassword1">Mật khẩu</label>
						    <input name="password" type="password" class="form-control" placeholder="Nhập mật khẩu" spellcheck="false" value="{{old('password')}}">
						    <small class="form-text" style="font-style: italic;">Bấm vào <a href="#" tabindex="-1">đây</a> nếu quên mật khẩu.</small>
						  </div>
						  @if($errors->has('password'))
						  	<small class="form-text error">{{$errors->first('password')}}</small>
						  	<br>
						  @endif
						  <button type="submit" class="btn btn-light">Đăng nhập</button>
						</form>
					</div>
					<a class="material-icons setting_btn">&#xe894;</a>
					<div class="col-lg-1"></div>
				</div>
			</div>
		</div>
	</div>
</body>

<script>
	$(document).ready(function(){
		var l = $('#left_section');
		var r = $('#right_section');
		var title = $('#title');
		var log_form = $('#log_form');
		var reg_form = $('#reg_form');
		var reg = $('#register');
		var form_sec = 0.75; // Thời gian hiện form
		var r_sec = 1.075/1.2; // Thời gian slideDown()
		var setting_btn = $('.setting_btn');
		var effect = 'slide';
	    var options = { direction: 'right' };
	    var duration = 500;
		r.hide();
		log_form.hide();
		reg_form.hide();
		title.hide();
		setting_btn.hide();
		r.slideDown(r_sec*1000).css({'background-image':'linear-gradient(45deg, #421c52 25%, #50325c 25%, #50325c 50%, #421c52 50%, #421c52 75%, #50325c 75%, #50325c 100%)'});  //#421C52 //rgba(66, 28, 82, 0.75)
		setTimeout(function(){
			title.animate({width: 'toggle'},form_sec*1000);
			setTimeout(function(){
				log_form.fadeIn(form_sec*1000);
				setting_btn.fadeIn(form_sec*1000);
			},r_sec*1000);
		},r_sec*1000);
		// reg.on('click',function(){
		// 	log_form.fadeOut(form_sec*1000);
		// 	setTimeout(function(){
		// 		reg_form.fadeIn(form_sec*1000);
		// 	},form_sec*1000);
		// });
		// setting_btn.click(function () {
		//     r.toggle(effect, options, duration);
		// });
	});

	
</script>


</html>