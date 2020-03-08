@foreach($result as $rs)
	<div class="result-box">
		<a href="{{route('theProduct_view',['product_id'=>$rs->id])}}">
			<p class="h3">{{$rs->name}}</p>
			<p>{{$rs->developer}} / {{$rs->publisher}}</p>
		</a>
	</div>
@endforeach