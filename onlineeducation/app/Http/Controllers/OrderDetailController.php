<?php

namespace App\Http\Controllers;
use App\OrderDetail;
use Illuminate\Http\Request;
use App\Order;

class OrderDetailController extends Controller
{
    //
	public function getOrderDetails(request $request){
		 $order_details = \App\OrderDetail::with(['product','unit'])->where(['order_id'=>$request->cid,'status'=>1])->get();
		
		return json_encode(['status'=>true,'result'=>$order_details]);
	}
	
	public function orderStatus(request $request){
		//return $request;
		$order = \App\Order::findOrFail($request->orderid); 
        $order->status = $request->delivery_status;
        $order->description = $request->description;
		if($request->delivery_status==5){
	    $order->payment_status = $request->payment_status;
		}
		$flag = $order->save();
        if($flag) {
            return redirect()->route('order.index')->with('message','Order Update successfully.');
        }else{
            return redirect()->route('order.index')->with('message','Action Failed Please try again.');
        }
		
	}
}
