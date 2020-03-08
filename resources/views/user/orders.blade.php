@extends('user.index')

<style>
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

	thead.cart-head tr th {
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

	.has {
		color: green;
		font-weight: bolder;
	}

	.pending {
		color: red;
	}

	.product_key {
		background: white;
	}

	.product_key:hover {
		background: none;
	}
</style>

@section('yourOrders')
	<h1 id="store_title">TRẠNG THÁI GIAO HÀNG</h1>
	<br>
	

	<table class="table cart-table">
	  <thead class="cart-head">
	    <tr>
	      <th class="cart-id">Mã</th>
	      <th class="cart-name">Tên</th>
	      <th class="cart-price">Giá thành</th>
	      <th class="cart-name">Trạng thái</th>
	      <th class="cart-name">Mã kích hoạt</th>
	      <th class="cart-tool">Ngày mua</th>
	    </tr>
	  </thead>
	  <tbody>
		@foreach($orders as $yourOrders)
			<tr>
		      <td class="cart-id">{{$yourOrders->id}}</td>
		      <td class="cart-name">{{$yourOrders->name}}</td>
		      <td class="cart-price">{{number_format($yourOrders->order_price)}} VNĐ</td>
		      <td class="cart-name">
	      		@if($yourOrders->delivery_status)
	      			<span class="status has">{{"Đã có"}}</span>
	      		@else
	      			<span class="status pending">{{"Chờ"}}</span>
	      		@endif
		      </td>
		      <td class="cart-name">
		      	@if($yourOrders->delivery_status)
		      		<span class="product_key">{{$yourOrders->product_key}}</span>
		      	@else
		      		{{"Chưa có"}}
		      	@endif
		      </td>
		      <td class="cart-tool">{{\Carbon\Carbon::parse($yourOrders->created_at)->format('h:m A (d/m/Y)')}}</td>
		    </tr>
		@endforeach
	  </tbody>
	</table>
	@if ($orders->count() == 0)
		<p style="color:white;text-align: center;">Không có đơn đặt hàng nào.</p>
	@endif

@endsection