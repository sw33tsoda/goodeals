@extends('admin.index')
@section('panel_title','Quản lý đơn hàng')
@section('panel')
<meta name="csrf-token" content="{{ csrf_token() }}">
	<small><b>Thông báo </b>: Trường hợp Key kích hoạt không còn trong kho, hoàn tiền lại 100% chi phí sản phẩm cho khách hàng.</small>	
	<br><br>
	<table class="table table-bordered table-hover">
	    <thead>
	        <tr>
	            <th class="text-center">Mã đơn hàng</th>
	            <th class="text-center">Tên người dùng</th>
	            <th class="text-center">Tên sản phẩm</th>
	            <th class="text-center">Giá thành</th>
	            <th class="text-center">Mã kích hoạt</th>
	            <th class="text-center">Hành động</th>
	        </tr>
	    </thead>
	    <tbody>
	    	@if ($orders->count() > 0)
		        @foreach($orders as $o)
		        <tr class="orders_{{$o->id}}">
		            <td class="text-center">{{$o->id}}</td>
		            <td class="text-center">{{$o->users->name}}</td>
		            <td class="text-center">{{$o->products->id}}</td>
		            <td class="text-center">{{number_format($o->order_price)}} VNĐ</td>
		            <td class="text-center">
		            	<input name="product_key" type="input" class="form-control orders_product_key_{{$o->id}}">
		            </td>
		            <td class="text-center">
		            	<button class="btn btn-danger orders_update_{{$o->id}}" onclick="updateOrders({{$o->id}})">Cập nhật</button>
		            	<button class="btn btn-success orders_refund_{{$o->id}}" onclick="refund({{$o->id}})">Hoàn tiền</button>
		            </td>
		        </tr>
		        @endforeach
	        @else
	        	<tr>
	        		<td class="text-center" colspan="6">Không có đơn hàng nào.</td>
	        	</tr>
	        @endif
	    </tbody>
	    <tfoot>
	        <tr>
	            <td colspan="6" class="text-center">Còn <span id="orders-count">{{$orders->count()}}</span> đơn hàng cần được xử lý.</td>
	        </tr>
	    </tfoot>
	</table>
	<script>
		let orders_count = '#orders-count';
		function updateOrders(id) {
			let order_id = id;
			let orders_record = ".orders_" + id;
			let product_key = ".orders_product_key_" + id;
			let url = "{{route('orders.update',['id'=>'_blank'])}}";
			let keyRequiredMsg = "Cần nhập key !";
			if ($(product_key).val() == "") alert(keyRequiredMsg);
			$.ajax({
				url: url, 
				type: 'PUT',
				dataType: 'json',
				data : {
					id:order_id,
					product_key:$(product_key).val(),
				},
				success:function(data) {
					let msg = "Đã cập nhật.";
					if (data.check) {
						$(orders_record).html("<td class='text-center' colspan='6'>"+ msg +"</td>");
						$(orders_count).text(data.ordersHaveNotDelivered);
					} else {
						alert("Lỗi DB ở Controller !");
					}
				},
			});
		}
		
		function refund(id) {
			let url = "{{route('orders.destroy',['id'=>'_blank'])}}";
			let order_id = id;
			let orders_record = ".orders_" + id;
			$.ajax({
				url: url,
				type: 'DELETE',
				dataType: 'json',
				data : {
					id:order_id,
				},
				success:function(data) {
					let msg = "Đã hoàn trả.";
					if (data.check) {
						$(orders_record).html("<td class='text-center' colspan='6'>"+ msg +"</td>");
						$(orders_count).text(data.ordersHaveNotDelivered);
					} else {
						alert("Lỗi DB ở Controller !");
					}
				},
				error:function(err) {
					alert(err);
				}
			});
		}

		$.ajaxSetup({
		  headers: {
		    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		  }
		});
	</script>
@endsection