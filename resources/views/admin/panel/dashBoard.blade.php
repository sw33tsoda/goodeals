@extends('admin.index')
@section('panel_title','Tổng quan')
@section('panel_highlight_dashBoard','bolder')
@section('panel')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>

	<style>
		#stats {
			text-align: center;
		}

		#stats > div {
			margin-bottom: 15px;
			padding: 15px;
			background-color: rgba(255, 255, 255, 0.25);
		}

		#stats div h1 {
			font-size:40px;
			margin:0;
		}

		#stats div p {
			margin:0;
		}
	</style>
	<div class="row">
		<div id="stats" class="col-lg-12">
			<div>
				<h1>Doanh số</h1>
				<div class="row">
					<div class="col-lg-6">
						<h1 class="count">{{$salesCount->count()}}</h1>
						<p>Sản phẩm đã bán</p>
						<canvas id="sales-chart"></canvas>
						<br>
						<h1>{{number_format($salesDaysAgo[0]->revenue)}} VNĐ</h1>
						<p>Thu được</p>
						<br>
					</div>
					<div class="col-lg-6">
						<h1 class="count">{{$refundCount->count()}}</h1>
						<p>Đã hoàn tiền</p>
						<canvas id="refund-chart"></canvas>
						<br>
						<h1>{{number_format($refundDaysAgo[0]->money_back)}} VNĐ</h1>
						<p>Hoàn lại</p>
						<br>
					</div>
				</div>
				<script>
					let sales_chart = document.getElementById('sales-chart').getContext('2d');
					let createSaleChart = new Chart(sales_chart, {
					    "type": "bar",
					    "data": {
					        "labels": [
					        	@foreach($sales as $sale)
					        		"{{\Carbon\Carbon::parse($sale->day)->format('d/m')}} - {{number_format($sale->revenue)}} VNĐ",
					        	@endforeach
					        ],
					        "datasets": [{
					            "label": "Bán được",
					            "data": [
					            	@foreach($sales as $sale)
					        			"{{$sale->copy_sold}}",
					        		@endforeach
					            ],
					            "fill": false,
					            "backgroundColor": [
					            	@foreach($sales as $sale)
					            		"rgba(54, 162, 235, 0.9)",
					            	@endforeach
					            ],
					            "borderWidth": 1
					        }]
					    },
					    "options": {
					    	plugins: {
							    datalabels: {
							        color: 'white',
							        anchor: 'end',
							        align: 'start',
							        offset: -10,
							        borderWidth: 2,
							        borderColor: '#fff',
							        borderRadius: 25,
							        backgroundColor: (context) => {
							          return context.dataset.backgroundColor;
							        },
							        font: {
							          weight: 'bold',
							          size: '10'
							        },
							        // formatter: (value) => {
							        //   return value + ' sản phẩm';
							        // }
							      }
							    },
					    	title: {
					    		display:true,
					    		text: 'Số lượng sản phẩm đã bán được gần đây'
					    	},
					        "scales": {
					            "yAxes": [{
					                "ticks": {
					                    "beginAtZero": true
					                }
					            }],
					            "xAxes": [{
					                "ticks": {
					                    fontSize:9
					                }
					            }]
					        }
					    }
					});

					let refund_chart = document.getElementById('refund-chart').getContext('2d');
					let createRefundChart = new Chart(refund_chart,{
						type: 'line',
					    "data": {
					        "labels": [
					        	@foreach($refund as $rf)
									"{{\Carbon\Carbon::parse($rf->day)->format('d/m')}} - {{number_format($rf->cost)}} VNĐ",
								@endforeach
					        ],
					        "datasets": [{
					            "label": "Hoàn tiền",
					            "data": [
					            	@foreach($refund as $rf)
										"{{$rf->copy_refund}}",
									@endforeach
					            ],
					            "fill": false,
					            "borderColor": "#f64f59",
					            "lineTension": 0.1,
					        },]
					    },
					    options: {
					    	title : {
					    		display:true,
					    		text:'Hoàn tiền vì không đủ nguồn cung gần đây',
					    	},
					    	responsive:true,
					    	plugins: {
							    datalabels: {
							        color: 'white',
							        anchor: 'end',
							        align: 'start',
							        offset: -10,
							        borderWidth: 2,
							        borderColor: 'white',
							        borderRadius: 25,
							        backgroundColor: (context) => {
							          return 'red';
							        },
							        font: {
							          weight: 'bold',
							          size: '10'
							        },
							      }
							    },
							"scales": {
					            "yAxes": [{
					                "ticks": {
					                    "beginAtZero": true
					                }
					            }],
					            "xAxes": [{
					                "ticks": {
					                    fontSize:9
					                }
					            }]
					        }
					    }
					});
				</script>
			</div>
		</div>
		<div id="stats" class="col-lg-4">
			<div>
				<h1 class="count">{{$usersStats->count()}}</h1>
				<p>Người dùng</p>
			</div>
			<div>
				<h1 class="count">{{$adminsStats->count()}}</h1>
				<p>Quản trị viên</p>
			</div>
		</div>
		<div id="stats" class="col-lg-4">
			<div>
				<h1 class="count">{{$productsStats->count()}}</h1>
				<p>Sản phẩm</p>
				<canvas id="product-chart"></canvas>
				<script>
					let product_chart = document.getElementById('product-chart').getContext('2d');
					let product_chart_labels = [
						@foreach($productQuantitiesByCategoryName as $categories)
							"{{$categories->platform_name}}",
						@endforeach
					];
					let colorHex = ['#f64f59','#c471ed','#12c2e9'];
					let createProductChart = new Chart(product_chart,{
						type:'doughnut',
						data:{
							datasets:[{
								data:[
									@foreach($productQuantitiesByCategoryName as $platform)
										"{{$platform->quantity}}",
									@endforeach
								],
								backgroundColor:colorHex,
							}],
							labels:product_chart_labels,
						},
						options: {
							title : {
								display:true,
								text: 'Số lượng sản phẩm theo loại'
							},
							responsive: true,
							elements: {
						        arc: {
						            borderWidth: 0,
						        }
						    },
						    legend: {
						    	position: 'bottom',
						    },
						    plugins: {
							    datalabels: {
							        color: '#fff',
							        // anchor: 'end',
							        // align: 'start',
							        // offset: 10,
							        //borderWidth: 2,
							        //borderColor: '#fff',
							        //borderRadius: 25,
							        // backgroundColor: (context) => {
							        //   return context.dataset.backgroundColor;
							        // },
							        font: {
							          weight: 'bold',
							          size: '10'
							        },
							        // formatter: (value) => {
							        //   return value + ' sản phẩm';
							        // }
							      }
							    }
						},
					});
				</script>
			</div>
			<div>
				<h1 class="count">{{$reviewsStats->count()}}</h1>
				<p>Đánh giá</p>
			</div>
		</div>
		<div id="stats" class="col-lg-4">
			<div>
				<h1 class="count">{{$postsStats->count()}}</h1>
				<p>Bài viết</p>
			</div>
			<div>
				<h1 class="count">{{$commentsStats->count()}}</h1>
				<p>Bình luận</p>
				<canvas id="comment-chart"></canvas>
				<script>
					let comment_chart = document.getElementById('comment-chart').getContext('2d');
					let createCommentChart = new Chart(comment_chart,{
						type: 'line',
					    "data": {
					        "labels": [
					        	@foreach($commentsByDay as $posts)
									"{{\Carbon\Carbon::parse($posts->day)->format('d/m')}}",
								@endforeach
					        ],
					        "datasets": [{
					            "label": "số lượng",
					            "data": [
					            	@foreach($commentsByDay as $posts)
										"{{$posts->num_of_comments}}",
									@endforeach
					            ],
					            "fill": false,
					            "borderColor": "#f64f59",
					            "lineTension": 0.1
					        }]
					    },
					    options: {
					    	title : {
					    		display:true,
					    		text:'Lượng bình luận hằng ngày'
					    	},
					    	responsive:true,
					    	plugins: {
							    datalabels: {
							        color: 'black',
							        anchor: 'end',
							        align: 'start',
							        offset: -20,
							        // borderWidth: 2,
							        // borderColor: '#fff',
							        // borderRadius: 25,
							        backgroundColor: (context) => {
							          return context.dataset.backgroundColor;
							        },
							        font: {
							          weight: 'bold',
							          size: '10'
							        },
							        // formatter: (value) => {
							        //   return value + ' sản phẩm';
							        // }
							      }
							    }
					    }
					});
				</script>
			</div>
		</div>
	</div>

	

	<script>
		$('.count').each(function () {
		    $(this).prop('Counter',0).animate({
		        Counter: $(this).text()
		    }, {
		        duration: 1000,
		        easing: 'swing',
		        step: function (now) {
		            $(this).text(Math.ceil(now));
		        }
		    });
		});
	</script>
@endsection