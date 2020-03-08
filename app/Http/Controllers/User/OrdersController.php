<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Carbon\Carbon;
use Auth;

class OrdersController extends Controller
{
    public function create_orders($cart) {
    	//Tạo đơn giao hàng
    	foreach ($cart as $order) {
    		DB::table('orders')->insert([
    			'user_id'	=>	$order->user_id,
    			'product_id'=>	$order->product_id,
                'order_price'=> $order->products->price * ((100-parent::getPromo())/100),
    			'created_at'=>	Carbon::now(),
    		]);
    	}
    }

    public function orders_view(Request $request) {
    	$getOrders = DB::table('orders')
            ->orderBy('created_at','desc')
    		->join('products','products.id','=','orders.product_id')
    		->select(
    			'orders.id',
    			'products.name',
    			'orders.order_price',
    			'orders.delivery_status',
    			'orders.product_key',
    			'orders.created_at')->get();

    	return view('user.orders',['orders'=>$getOrders]);
    }
}
