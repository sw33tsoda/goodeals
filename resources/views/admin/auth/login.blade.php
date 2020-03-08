<!DOCTYPE html>
<html>
<head>
<title>DMZ</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
	<center><h2>DMZ</h2></center>
	<div class="row">
		<div class="col-lg-4"></div>
		<div class="col-lg-4">
			@if ($errors->any())
				<div class="alert alert-danger">
					<strong>Email : </strong>@if ($errors->has('email'))
						{{$errors->first('email')}}
					@endif<br>
					<strong>Mật khẩu : </strong>@if ($errors->has('password'))
						{{$errors->first('password')}}
					@endif
				</div>
			@endif
			<form method="POST" action="{{Route('login')}}">
				{{ csrf_field() }}
				<div class="form-group">
			    	<label for="exampleInputEmail1">Địa chỉ Email</label>
			    	<input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="email" value="{{ old('email') }}">
			  	</div>
				<div class="form-group">
			    	<label for="exampleInputPassword1">Mật khẩu</label>
			    	<input type="password" class="form-control" id="exampleInputName1" placeholder="Password" name="password">
			  	</div>
			  	<button type="submit" class="btn btn-primary">Đăng nhập</button>
			</form>
		</div>
		<div class="col-lg-4"></div>
	</div>
</div>

</body>
</html>