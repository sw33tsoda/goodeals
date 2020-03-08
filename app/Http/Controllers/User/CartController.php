<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Auth;

class CartController extends Controller
{
    public function __construct() {
        return $this->middleware('auth');
    }

    public function addToCart(Request $request) {
    	$data = array("product_id"=>$request->product_id,"user_id"=>Auth::user()->id);
    	$addToCart = DB::table('cart')->insert($data);
        $message = $addToCart == 1 ? "Thêm vào giỏ thành công" : "Thêm vào giỏ thất bại";
        return $message;
    }

    public function getCart(Request $request) {
    	$user_id = Auth::user()->id;
    	$sql_query = "SELECT cart.id,products.name,products.price FROM products,cart WHERE cart.product_id = products.id AND cart.user_id = $user_id";
    	$cart = DB::select(DB::RAW($sql_query));
    	$pay = 0;
    	foreach ($cart as $cart_) {
    		$pay+=$cart_->price;
    	}
    	$discountByPromo = $pay * ((100-parent::getPromo())/100);
    	return view('user.cart.cart')->with('getCart',$cart)->with('pay',$pay)->with('promo',parent::getPromo())->with('totalpay',$discountByPromo);
    }

    public function removeFromCart(Request $request) {
        $product_id = $request->id;
    	$deleteItem = DB::table('cart')->where('id',$product_id)->delete();
    	$msg = ($deleteItem ? "Đã xóa khỏi giỏ." : "Xóa thất bại.");
    	return redirect()->back();
    }

    public function deleteCart() {
        DB::table('cart')->where('user_id',Auth::user()->id)->delete();
        return redirect()->back();
    }
}
