<?php

namespace App\Http\Controllers;

use App\Mail\SendInvoiceMail;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Countries;
use App\Models\Upazilas;
use App\Models\Inventory;
use App\Models\Districts;
use App\Models\Order;
use App\Models\BillingDetails;
use App\Models\OrderProduct;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
class CheckOutController extends Controller
{
    function index(){
        $Districts = Districts::all();
        return view('frontend.checkout',[
            'districts'=>$Districts,
        ]);
    }

    function getcity(Request $request){
         $get_upazilas=  Upazilas::where('district_id', $request->districts_id)->get();
        $str='<option value="">----- Select Upazilas -----</option>';
        foreach($get_upazilas as $get_upazila){
            $str .='<option value="'.$get_upazila->id.'">'.$get_upazila->name.'</option>';
        }
       echo $str;
    }
         function insert(Request $request){
                // print_r($request->all());
                if($request->payment_method == 1){
                  $order_id =  Order::insertGetId([
                        'user_id'=>Auth::guard('customerlogin')->id(),
                        'subtotal'=>$request->sub_total,
                        'discount'=>$request->discount,
                        'delivary_charge'=>$request->charge,
                        'total'=>$request->sub+$request->charge,
                        'delevary_type'=>'Cash',
                        'created_at'=>Carbon::now(),
                    ]);

                    BillingDetails::insert([
                        'user_id'=>Auth::guard('customerlogin')->id(),
                        'order_id'=>$order_id,
                        'name'=>$request->name,
                        'district_id'=>$request->district,
                        'upazila_id'=>$request->upazila,
                        'email'=>$request->email,
                        'phone'=>$request->phone,
                        'address'=>$request->address,
                        'company'=>$request->company,
                        'notes'=>$request->notes,
                        'created_at'=>Carbon::now(),
                    ]);

                    $carts = Cart::where('customer_id', Auth::guard('customerlogin')->id())->get();
                    foreach ($carts as $cart) {
                        OrderProduct::insert([
                            'order_id'=>$order_id,
                            'user_id'=>Auth::guard('customerlogin')->id(),
                            'product_id'=>$cart->product_id,
                            'price'=>$cart ->relation_product->after_discount,
                            'quentity'=>$cart ->quantity,
                            'created_at'=>Carbon::now(),
                        ]);

                    }
                    $totqal_amount=$request->sub_total+$request->charge - ($request->discount);
                    Mail::to($request->email)->send(new SendInvoiceMail($order_id));
                // BALK sms

                                $url = "http://66.45.237.70/api.php";
                                $number=$request->phone;
                                $text="Your order plased, You have to paid".$totqal_amount;
                                $data= array(
                                'username'=>"01859554623",
                                'password'=>"CKXF64GZ",
                                'number'=>"$number",
                                'message'=>"$text"
                                );
                                $ch = curl_init(); // Initialize cURL
                                curl_setopt($ch, CURLOPT_URL,$url);
                                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                $smsresult = curl_exec($ch);
                                $p = explode("|",$smsresult);
                                $sendstatus = $p[0];
                 //balk sms
                    foreach($carts as $cart){
                        Inventory::where('product_id', $cart->product_id)->where('color_id', $cart->color_id)->where('size_id', $cart->size_id)->decrement('quantity', $cart->quantity);
                    }


                    foreach($carts as $cart){
                         Cart::find($cart->id)->delete();
                    }
                    $get_order = Order::where('id', $request->$order_id)->get();
                                      return redirect()->route('order.success',compact('get_order'))->with('order_done','Your order was plased');
                }


                else if($request->payment_method == 2){
                    $data = $request->all();
                    return view('exampleHosted',[
                        'data'=>$data,
                    ]);
                }
                else{
                    $data = $request->all();
                    return view('stripe',[
                        'data'=>$data,
                    ]);
                }
        }
            function order_success(){
                if(session('order_done')){
                    return view('frontend.order_success');
                }
                else{
                    return view('frontend.error');
                }
            }


}
