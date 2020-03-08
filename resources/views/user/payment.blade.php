@extends('user.index')

<style>
	div.payment {
		color: white;
		text-align: center;
	}

	.goodeals {
		font-family: 'Pacifico', cursive;
		font-style: normal;
	}
</style>

@section('payment')
	<div class="payment">
		<h1>
			@if ($status) 
				{{"Thanh toán thành công !"}}
			@else 
				{{"Thanh toán thất bại vì bạn không đủ tiền trong tài khoản."}}
			@endif
		</h1>
		<p>
			@if ($status) 
				<i>Cảm ơn bạn đã mua hàng ở <span class='goodeals'>GooDeals</span>, bấm vào <a href="{{route('yourOrders_view')}}">đây</a> để xem trạng thái giao hàng.</i>
			@endif
		</p>
	</div>
@endsection