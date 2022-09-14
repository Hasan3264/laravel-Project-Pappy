<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Coupon;
use Illuminate\Support\Facades\Auth;
class CuponController extends Controller
{
    function index(){
        $couponall = Coupon::all();
        return view('admin.coupon.index',[
            'couponall'=>$couponall,
        ]);
    }
    function insert(Request $request){
        Coupon::insert([
          'coupon'=>$request->coupon,
          'discount'=>$request->discount,
          'discount_type'=>$request->discount_type,
          'validity'=>$request->validity,
          'created_at'=>Carbon::now(),
        ]);
        return back()->with('succes', 'Coupon Added');
    }
    // function getall(Request $request){
    //    $couponall = Coupon::all();
    //     return back();
    // }
}
