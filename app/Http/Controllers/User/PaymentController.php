<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Auth;
use App\User;
use App\Http\Controllers\User\OrdersController;
use App\Http\Controllers\User\CartController;
use App\Cart;

class PaymentController extends Controller
{
    public function pay(Request $request) {
    	// Lấy thông tin người thanh toán
    	$payerId = Auth::user()->id;

    	// Tìm thông tin giỏ hàng người thanh toán
        $payerCart = Cart::where('user_id',$payerId);
    	$getPayerCart = $payerCart->get();
    	// Tính tổng số tiền cần thanh toán
    	$total = 0;
    	foreach ($getPayerCart as $loop) {
    		$getItemPrice = DB::table('products')->where('id',$loop->product_id)->first();
    		$total = $total + $getItemPrice->price;
    	}

		// Tiến hành thanh toán
		$status = false;
    	try {
		    DB::beginTransaction();
		    $payerInfo = User::find($payerId);
		    $payerBalanceBefore = $payerInfo->balance;
            if (parent::getDiscount() > 0) {
                $discounted = parent::discountThis($total);
                $payerInfo->balance = $payerInfo->balance - $discounted;
            } else {
                $payerInfo->balance = $payerInfo->balance - $total; 
            }
    		$payerInfo->save();
		    $status = true;
            // Tạo đơn giao hàng
            if ($status) {
                $orders = new OrdersController;
                $orders->create_orders($getPayerCart);
                parent::transaction_log($getPayerCart,'payment');
                $payerCart->delete();
            }
            DB::commit();
		} catch (\PDOException $e) {
		    DB::rollBack();
		}	
		return redirect()->route('pay_view',['status'=>$status,'payerBalanceBefore'=>$payerBalanceBefore]);
    }

    public function pay_view(Request $request) {
    	return view('user.payment',['status'=>$request->status]);
    }

    public function recharge_view() {
        return view('user.recharge');
    }
}
