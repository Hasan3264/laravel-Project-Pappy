<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Coupon;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    function cart_insert(Request $request){
        if(Cart::where('product_id', $request->product_id)->where('color_id', $request->color_id)->where('size_id', $request->size_id)->exists()){
            Cart::where('product_id', $request->product_id)->where('color_id', $request->color_id)->where('size_id', $request->size_id)->increment('quantity', $request->quantity);
            return back()->with('added', 'Cart Added Success');
        }
        else{
             Cart::insert([
                  'customer_id'=>Auth::guard('customerlogin')->id(),
                  'product_id'=>$request->product_id,
                  'color_id'=>$request->color_id,
                  'size_id'=>$request->size_id,
                  'quantity'=>$request->quantity,
                  'created_at'=>Carbon::now(),
            ]);
            return back()->with('added', 'Cart Added Success');
        }
    }
    function cart_remove($cart_id){
        Cart::find($cart_id)->delete();
        return back()->with('delete','Deletion Done!');
    }
    function cart(Request $request){
        $copun_code= $request->coupon;
        $massage= null;
        $discount_type= null;
        $carts = Cart::where('customer_id', Auth::guard('customerlogin')->id())->get();
        if($copun_code == ''){
             $discount = 0;
        }
        else{
            if(Coupon::where('coupon', $copun_code)->exists()){
                if(Carbon::now()->format('Y-m-d')> Coupon::where('coupon',$copun_code)->first()->validity){
                    $massage='This Coupon is Expaired';
                    $discount = 0;
                }
                else{
                   $discount= Coupon::where('coupon',$copun_code)->first()->discount;
                   $discount_type= Coupon::where('coupon',$copun_code)->first()->discount_type;
                }
            }
            else{
                $massage='This Coupon is Not Valide';
                $discount = 0;
            }
        }

                return view('frontend.cart',[
                    'carts'=>$carts,
                    'massage'=>$massage,
                    'discount'=>$discount,
                    'discount_type'=>$discount_type,
        ]);
    }
    function update_cart(Request $request){
        foreach($request->quantity as $cart_id=>$quantity){
             $cart =  Cart::find($cart_id)->update([
                 'quantity'=>$quantity,
             ]);
             return back()->with('update', 'Updated');
        }
    }
}
