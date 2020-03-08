<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;
use App\User;
use DB;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::where('delivery_status',false)->get();
        return view('admin.panel.ordersList',['orders'=>$orders]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $orders = Order::where('delivery_status',false)->get();
        $ordersCount = count($orders);
        return $ordersCount;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (!empty($request->product_key) && !empty($request->id)) {
            $getOrder = Order::find($request->id);
            $getOrder->product_key = $request->product_key;
            $getOrder->delivery_status = true;
            $finish = $getOrder->save();
            $check = false;
            if ($finish) $check = true;
            return response()->json(['ordersHaveNotDelivered'=>$this->show(),'check'=>$check]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request) // refund
    {
        if (!empty($request->id)) {
            $order_id = $request->id;
            $check = false;
            try {
                //Bất đầu giao dịch
                DB::beginTransaction();
                //Lấy đơn hàng
                $getOrder = Order::find($order_id);
                //Tìm chủ nhân đơn hàng
                $getUser = User::find($getOrder->user_id);
                //Lấy giá đơn hàng
                $getProductPriceFromOrder = $getOrder->order_price;
                //Tiến hành hoàn trả
                $getUser->balance = $getUser->balance + $getProductPriceFromOrder;
                $getUser->save();
                $getOrder->delete();
                $check = true;
                DB::commit();
            } catch (\PDOException $e) {
                DB::rollBack();
            }
        }
        return response()->json(['ordersHaveNotDelivered'=>$this->show(),'check'=>$check]);
    }
}
