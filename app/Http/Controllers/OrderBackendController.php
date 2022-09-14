<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderProduct;

class OrderBackendController extends Controller
{
    function order(){
        $orders = OrderProduct::all();
        return view('admin.order.index',[
            'orders'=>$orders,
        ]);
    }
    function order_position($orderposition_id){
       $order_position = OrderProduct::Where('id',$orderposition_id)->get();
        return view('admin.order.order_position',[
            'order_position'=>$order_position,
        ]);
        
    }
}
