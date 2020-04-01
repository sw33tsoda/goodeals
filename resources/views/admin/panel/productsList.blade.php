@extends('admin.index')
@section('panel_title','Danh sách sản phẩm')
@section('panel_highlight_productsList','bolder')
@section('panel')

@if (session()->get( 'enableMessage' ))
<div class="alert alert-{{ session()->get( 'alert' ) }}">
   <strong>Thông báo : </strong>{{ session()->get( 'message' ) }}
</div>
@endif
<table class="table table-bordered table-hover order-table text-center">
  <thead>
    <tr>
      <th class="text-center" scope="col">Mã</th>
      <th class="text-center" scope="col">Tên sản phẩm</th>
      <th class="text-center" scope="col">Nhà phát triển</th>
      <th class="text-center" scope="col">Nhà phát hành</th>
      <th class="text-center" scope="col">Nền tảng</th>
      <th class="text-center" scope="col">Giá thành</th>
      <th class="text-center" scope="col">Ngày đăng</th>
      <th class="text-center" scope="col">Hành động</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($productsList as $show)
    <tr>
      <td class="align-middle">{{$show->id}}</td>
      <td class="align-middle">{{$show->name}}</td>
      <td class="align-middle">{{$show->developer}}</td>
      <td class="align-middle">{{$show->publisher}}</td>
      <td class="align-middle">{{$show->platform_name}}</td>
      <td class="align-middle">{{$show->price}}</td>
      <td class="align-middle">{{\Carbon\Carbon::parse($show->created_at)->format('h:i A (d/m/Y)')}}</td>
      <td class="align-middle"><a class="btn btn-success-custom" data-toggle="modal" data-target="#fullInfo_{{$show->id}}" href="#">Xem đầy đủ</a> <a class="btn btn-warning-custom" href="{{url('/admin/editProducts/'.$show->id)}}">Sửa</a> <a class="btn btn-danger-custom" data-toggle="modal" data-target="#modal_{{$show->id}}" href="#">Xóa</a>
        <!-- DELETE MODAL -->
          <div class="modal" id="modal_{{$show->id}}" role="dialog">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Xóa sản phẩm này ?</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <p style="text-align: left">Bạn có thể sửa lại nếu muốn thay đổi.</p>
                </div>
                <div class="modal-footer" style="border-top:0;">
                  <a type="button" class="btn btn-warning-custom" href="{{url('/admin/editProducts/'.$show->id)}}">Sửa</a>
                  <a type="button" class="btn btn-danger-custom"  href="{{url('/admin/deleteProducts/'.$show->id)}}">Xóa</a>
                </div>
              </div>
            </div>
          </div>
          <!-- FULL INFO MODAL -->

          <div class="modal" id="fullInfo_{{$show->id}}" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Thông tin đầy đủ</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <div class="col-lg-5">
                      @if ($show->image == 'to_be_uploaded')
                        <center>{{"Không có ảnh"}}</center>
                      @else
                        <img src="/storage/uploads/product_images/{{$show->image}}" width="100%">
                      @endif
                    </div>
                    <div class="col-lg-7">
                      <ul class="nav nav-tabs" style="border:none;">
                        <li style="width:50%;"><a class="btn btn-success-custom" style="width: 95%" data-toggle="tab" href="#info_{{$show->id}}">Thông tin</a></li>
                        <li style="width:50%;"><a class="btn btn-success-custom" style="width: 95%" data-toggle="tab" href="#reviews_{{$show->id}}">Đánh giá</a></li>
                      </ul>
                      <div class="tab-content">
                        <div id="info_{{$show->id}}" class="tab-pane fade in active">
                          <br>
                          <table class="table table-bordered" border="0" style="font-size: 12px;">
                            <tr>
                              <td>Tên sản phẩm</td>
                              <td>{{$show->name}}</td>
                            </tr>
                            <tr>
                              <td>Nhà phát triển</td>
                              <td>{{$show->developer}}</td>
                            </tr>
                            <tr>
                              <td>Nhà phát hành</td>
                              <td>{{$show->publisher}}</td>
                            </tr>
                            <tr>
                              <td>Nền tảng</td>
                              <td>{{$show->platform_name}}</td>
                            </tr>
                            <tr>
                              <td>Giá thành</td>
                              <td>{{$show->price}}</td>
                            </tr>
                            <tr>
                              <td>Đánh giá</td>
                              <td>
                                @php {{$sum = 0;$count = 0;$avg = (float) 0;$is_rating = false;$ratingLimit = 5;}} @endphp
                                @foreach ($getRating as $rating)
                                  <?php
                                    $sum = $rating->rate + $sum; $count = $count + 1;
                                    if ($rating->product_id == $show->id) {
                                      $is_rating = true;
                                    }
                                  ?>
                                @endforeach
                                @if ($is_rating) 
                                  {{ round($avg = $sum / $count,2) }}/5
                                  {!! str_repeat('<span style="color: orange" class="fa fa-star checked"></span>',(int)$avg) !!}{!! str_repeat('<span style="color:grey" class="fa fa-star"></span>',$ratingLimit - (int)$avg) !!}
                                  @switch((int)$avg)
                                    @case(1) {{"(Rất tệ)"}} @break
                                    @case(2) {{"(Tệ)"}} @break
                                    @case(3) {{"(Ổn)"}} @break
                                    @case(4) {{"(Hay)"}} @break
                                    @case(5) {{"(Rất hay)"}} @break
                                  @endswitch
                                @else
                                  <center>{{"Chưa có đánh giá nào"}}</center>
                                @endif
                              </td>
                            </tr>
                          </table>
                        </div>
                        <div id="reviews_{{$show->id}}" class="tab-pane fade" style="overflow: scroll;height: 500px;margin-top: 5px;">
                          <h3>Đánh giá</h3>
                          @if (count($reviewsList) > 0)
                            @php {{$is_match = true;}} @endphp
                            @foreach ($reviewsList as $showReviews)
                              @if ($showReviews->product_id == $show->id)
                                <div class="media" style="text-align: left;">
                                  <div class="media-left">
                                    @if ($showReviews->avatar == 'to_be_uploaded')
                                      <img class="img-circle" src="https://www.brandeps.com/icon-download/U/User-02.svg" style="width:60px">
                                    @else
                                      <img class="img-circle" src="/storage/uploads/avatar_images/{{$showReviews->avatar}}" class="media-object" style="width:60px">
                                    @endif
                                  </div>
                                  <div class="media-body" style="padding-left: 5px;">
                                    {!!str_repeat('<span class="fa fa-star checked" style="color: orange"></span>',$showReviews->rate)!!}{!!str_repeat('<span class="fa fa-star" style="color:grey"></span>',$ratingLimit - $showReviews->rate)!!}
                                    @switch($showReviews->rate)
                                      @case(1) {{"(Rất tệ)"}} @break
                                      @case(2) {{"(Tệ)"}} @break
                                      @case(3) {{"(Ổn)"}} @break
                                      @case(4) {{"(Hay)"}} @break
                                      @case(5) {{"(Rất hay)"}} @break
                                    @endswitch
                                    <p style="font-size: 12px;"><span style="font-weight: bold;font-size: 14pt;">{{$showReviews->name}}</span> {{$showReviews->review}} <a href="{{route('deleteReviews',['id' => $showReviews->id])}}">Xóa đánh giá này</a></p>
                                  </div>
                                </div>
                              @else
                                <?php $is_match = false; ?>
                              @endif
                            @endforeach
                            @if (!$is_match)
                              {{"Không có đánh giá nào cả"}}
                            @endif
                          @else
                              <center>{{ "Không có đánh giá nào cả" }}</center>
                          @endif
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="modal-footer" style="border-top:0;">
                  <a type="button" class="btn btn-default" href="" data-dismiss="modal">Đóng</a>
                </div>
              </div>
            </div>
          </div>
      </td>
    </tr>
    @endforeach 
  </tbody>
</table>
{{$productsList->links()}}

@endsection