@extends('admin.index')
@section('panel_title','Danh sách đánh giá')
@section('panel_highlight_reviewsList','bolder')
@section('panel')
<style>
  
</style>
@if (session()->get( 'enableMessage' ))
<div class="alert alert-{{ session()->get( 'alert' ) }}">
   <strong>Thông báo : </strong>{{ session()->get( 'message' ) }}
</div>
@endif

@if (count($reviewsList) > 0)
@php {{$is_match = true;$ratingLimit = 5;}} @endphp
@foreach ($reviewsList as $showReviews)
    <div class="media" style="text-align: left;">
      <div class="media-left">
        @if ($showReviews->avatar == 'to_be_uploaded')
          <img class="img-circle" src="{{url('/img/')}}/no_avatar.png" style="width:60px">
        @else
          <img class="img-circle" src="/storage/uploads/avatar_images/{{$showReviews->avatar}}" class="media-object" style="width:60px">
        @endif
      </div>
      <div class="media-body">
        [ {{$showReviews->product_name}} ]
        {!!str_repeat('<span class="fa fa-star checked"></span>',$showReviews->rate)!!}{!!str_repeat('<span class="fa fa-star"></span>',$ratingLimit - $showReviews->rate)!!}
        @switch($showReviews->rate)
          @case(1) {{"(Rất tệ)"}} @break
          @case(2) {{"(Tệ)"}} @break
          @case(3) {{"(Ổn)"}} @break
          @case(4) {{"(Hay)"}} @break
          @case(5) {{"(Rất hay)"}} @break
        @endswitch
        <h4 class="media-heading">{{$showReviews->name}}</h4>
        <p style="font-size: 12px;">{{$showReviews->review}} <a href="{{route('deleteReviews',['id' => $showReviews->id])}}">Xóa đánh giá này</a></p>
      </div>
    </div>
@endforeach
@if (!$is_match)
  {{"Không có đánh giá nào cả"}}
@endif
@else
  <center>{{ "Không có đánh giá nào cả" }}</center>
@endif


@endsection