@extends('user.index')
@section('cart-active','active')
@section('cart')

<style type="text/css">
	table.cart-table {
		color:white;
		-webkit-box-shadow: -5px 0px 22px 6px rgba(0,0,0,0.26);
		-moz-box-shadow: -5px 0px 22px 6px rgba(0,0,0,0.26);
		box-shadow: -5px 0px 22px 6px rgba(0,0,0,0.26);
	}

	thead.cart-head {
		background-image: linear-gradient(45deg, #50325c 25%, #421c52 25%, #421c52 50%, #50325c 50%, #50325c 75%, #421c52 75%, #421c52 100%);
		background-size: 56.57px 56.57px;
	}

	thead.cart-head th {
		border-top: 0;
		border-bottom: 0;
		font-weight: normal;
	}

	table.cart-table tbody tr {
		/*unused*/
	}

	table.cart-table tbody tr td {
		border-top: 0;
	}

	.cart-name,.cart-price {
		text-align: center;
	}

	.cart-tool {
		text-align: right;
	}


	div.payment-title {
		height: 100%;
		width: 100%;
		-webkit-box-shadow: -5px 0px 22px 6px rgba(0,0,0,0.26);
		-moz-box-shadow: -5px 0px 22px 6px rgba(0,0,0,0.26);
		box-shadow: -5px 0px 22px 6px rgba(0,0,0,0.26);
		background-image: linear-gradient(45deg, #50325c 25%, #421c52 25%, #421c52 50%, #50325c 50%, #50325c 75%, #421c52 75%, #421c52 100%);
		background-size: 56.57px 56.57px;
		color:white;
		padding: 15px;
		text-align: center;
	}

	div.payment-title h4 {
		margin:0;
	}

	td.totalpay {
		font-weight: bolder;
	}

	a.cart-btn {
		background: white;
		color:#421C52;
		float:right;
		font-weight: bold;
	}

	a.cart-btn-tool {
		width: 60px;
		height: 25px;
		text-align: center;
		line-height: 25px;
		border-radius: 25px;
		text-decoration: none;
		font-weight: bold;
	}
</style>

<h1 id="content-title">GIỎ HÀNG</h1>
<br>

<table class="table cart-table">
  <thead class="cart-head">
    <tr>
      <th class="cart-id">Mã</th>
      <th class="cart-name">Tên</th>
      <th class="cart-price">Giá thành</th>
      <th class="cart-tool"></th>
    </tr>
  </thead>
  <tbody>
	@foreach($getCart as $cart)
		<tr>
	      <td class="cart-id">{{$cart->id}}</td>
	      <td class="cart-name">{{$cart->name}}</td>
	      <td class="cart-price">{{number_format($cart->price)}} VNĐ</td>
	      <td class="cart-tool"><a href="{{route('removeItemFromCart',['id'=>$cart->id])}}" class="cart-btn cart-btn-tool">Xóa</a></td>
	    </tr>
	@endforeach
  </tbody>
</table>

@if (count($getCart) == 0)
	<p style="color:white;text-align: center;">Không có sản phẩm nào trong giỏ.</p>
@endif

<div>
	<table class="table cart-table">
		<tr>
			<td>Số sản phẩm trong giỏ (Số lượng)</td>
			<td class="cart-tool">{{count($getCart)}}</td>
		</tr>
		<tr>
			<td>Tổng (VNĐ)<br><small>Giá gốc chưa có khuyến mãi.</small></td>
			<td class="cart-tool">{{number_format($pay)}} VNĐ</td>
		</tr>
		<tr>
			<td>Khuyến mãi (%)<br><small>Chương trình khuyến mãi hàng quý.</small></td>
			<td class="cart-tool">{{$promo}}%</td>
		</tr>
	</table>
</div>

<div>
	<table class="table cart-table">
		<tr>
			<td>TỔNG TIỀN CẦN THANH TOÁN</td>
			<td>{{number_format($pay)}} VNĐ</td>
			<td>-</td>
			<td>{{$promo}}%(khuyến mãi)</td>
			<td>=</td>
			<td class="cart-tool totalpay">{{number_format($totalpay)}} VNĐ</td>
		</tr>
	</table>
</div>

<a style="float:left;color:white" href="{{route('delete_cart')}}">Xóa tất cả</a><a href="{{route('pay')}}" class="nav_tab cart-btn">THANH TOÁN</a>

</div>
@endsection