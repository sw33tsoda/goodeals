@extends('user.index')


@section('recharge')

<style>
.register{
    -webkit-box-shadow: -5px 0px 22px 6px rgba(0,0,0,0.26);
	-moz-box-shadow: -5px 0px 22px 6px rgba(0,0,0,0.26);
	box-shadow: -5px 0px 22px 6px rgba(0,0,0,0.26);
	background-image: linear-gradient(45deg, #50325c 25%, #421c52 25%, #421c52 50%, #50325c 50%, #50325c 75%, #421c52 75%, #421c52 100%);
	background-size: 56.57px 56.57px;
    margin-top: 3%;
    padding: 3%;
}
.register-left{
    text-align: center;
    color: #fff;
    margin-top: 4%;
}
.register-left input{
    border: none;
    border-radius: 1.5rem;
    padding: 2%;
    width: 60%;
    background: #f8f9fa;
    font-weight: bold;
    color: #383d41;
    margin-top: 30%;
    margin-bottom: 3%;
    cursor: pointer;
}
.register-right{
    background: #421C52;
    border-top-left-radius: 10% 50%;
    border-bottom-left-radius: 10% 50%;
    color: white;
}
.register-left img{
    margin-top: 15%;
    margin-bottom: 5%;
    width: 25%;
    -webkit-animation: mover 2s infinite  alternate;
    animation: mover 1s infinite  alternate;
}
@-webkit-keyframes mover {
    0% { transform: translateY(0); }
    100% { transform: translateY(-20px); }
}
@keyframes mover {
    0% { transform: translateY(0); }
    100% { transform: translateY(-20px); }
}
.register-left p{
    font-weight: lighter;
    padding: 12%;
    margin-top: -9%;
}
.register .register-form{
    padding: 10%;
    margin-top: 10%;
}
.btnRegister{
    float: right;
    margin-top: 10%;
    border: none;
    border-radius: 1.5rem;
    padding: 2%;
    font-weight: 600;
    width: 50%;
    cursor: pointer;
}
.register .nav-tabs{
    margin-top: 3%;
    border: none;
    background: none;
    border-radius: 1.5rem;
    width: 28%;
    float: right;
}
.register .nav-tabs .nav-link{
    padding: 2%;
    height: 34px;
    font-weight: 600;
    color: #fff;
    border-top-right-radius: 1.5rem;
    border-bottom-right-radius: 1.5rem;
}
.register .nav-tabs .nav-link:hover{
    border: none;
}
.register .nav-tabs .nav-link.active{
    width: 100px;
    color: #421C52;
    border: 2px solid #421C52;
    border-top-left-radius: 1.5rem;
    border-bottom-left-radius: 1.5rem;
}
.register-heading{
    text-align: center;
    margin-top: 8%;
    margin-bottom: -15%;
    color: white;
}
</style>

<style>
	select option {
		color:black;
	}
</style>

<h1 id="store_title">NẠP TIỀN</h1>
<br>
<div class="register">
    <div class="row">
        <div class="col-md-3 register-left">
            <img src="/public/img/coin-icon.png" alt=""/>
            <h3>NẠP TIỀN</h3>
            <p>Nạp tiền vào tài khoản để mua bất cứ Game nào mà bạn thích!</p>
        </div>
        <div class="col-md-9 register-right">
            <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">BANK</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">DONATE</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <h3 class="register-heading">Thanh toán bằng thẻ ngân hàng</h3>
                    <div class="row register-form">
                        <div class="col-md-6">
                        	<div class="row">
	                            <div class="form-group col-lg-6" style="padding-right: 0">
	                                <input type="text" class="form-control" placeholder="Họ của bạn" value="" />
	                            </div>
	                            <div class="form-group col-lg-6">
	                                <input type="text" class="form-control" placeholder="Tên của bạn" value="" />
	                            </div>
                        	</div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Địa chỉ thanh toán" value="" />
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Tên thành phố" value="" />
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Mã bưu điện" value="" />
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Số điện thoại" value="" />
                            </div>
                            <div class="form-group countries">
                                <script>
                                	$(document).ready(function(){
                                		$('.countries').load('https://raw.githubusercontent.com/sw33tsoda/html-country-dropdown-list/master/countries.html');
                                	});
                                </script>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <select class="form-control select" style="color:white">
                                    <option>Chọn loại thẻ</option>
                                    <option value="VISA">VISA</option>
                                    <option value="MasterCard">MasterCard</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Số thẻ" value="" />
                                <small class="form-text text-muted">Số thẻ trên thẻ thanh toán, vd: XXXX-XXXX-XXXX-XXXX</small>
                            </div>
                            <div class="form-group row" style="padding: 0px 15px 0px 15px">
                                <input type="text" class="form-control col-lg-4" placeholder="Tháng" value="" />
                                <input type="text" class="form-control col-lg-4" placeholder="Năm" value="" />
                                <input type="text" class="form-control col-lg-4" placeholder="Mã" value="" />
                                <small class="form-text text-muted">Tháng và năm hết hạn, mã an ninh nằm mặt sau.</small>
                            </div>
                            <input type="submit" class="btn btn-light btnRegister"  value="THANH TOÁN"/>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade show" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <h3  class="register-heading">Nạp tiền qua Donate</h3>
                    <div class="row register-form">
                        <ul class="col-md-6">
                            <li>Nạp bằng <a href="#">MOMO Donation</a></li>
                            <li>Nạp bằng <a href="#">PayPal Donation</a></li>
                            <li>Nạp bằng <a href="#">VTCPay Donation</a></li>
                        </ul>
                        <div class="col-md-6">
                            <h7>Các bước để nạp tiền thông qua Donate :</h7>
                            <ol>
                            	<li><small><i>Nhập số tiền cần nạp</i></small></li>
                            	<li><small><i>Ở phần nội dung điền : </i> email_số tiền cần nạp</small></li>
                            	<li><small><i>Đợi trong vòng 6 giờ.</i></small></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection