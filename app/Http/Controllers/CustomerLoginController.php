<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
 use Illuminate\Support\Facades\Auth;
 use App\Models\CustomerLogin;
use App\Models\CustomerPasswordReset;
use App\Notifications\PassResateNotificate;
use Carbon\Carbon;
use Illuminate\Support\Facades\Notification;
use Illuminate\Validation\Rules\Password;
class CustomerLoginController extends Controller
{
    function login(Request $request){
        if(Auth::guard('customerlogin')->attempt(['email'=>$request->email, 'password'=>$request->password])){
            if(Auth::guard('customerlogin')->user()->email_varifaied_at == null){
                
                 Auth::guard('customerlogin')->logout();
                 return redirect()->route('customer.register');
            }
            else{
                return redirect('/');
            }
        }
        else{
            return redirect()->route('customer.register');
        }
    }
    function resat_pass(){
        return view('frontend.customer_pass_reset');
    }
    function resat_pass_store(Request $request){
        $customer_email = CustomerLogin::where('email', $request->email)->firstOrFail();
        CustomerPasswordReset::where('customer_id', $customer_email->id)->delete();

        $customer = CustomerPasswordReset::create([
            'customer_id'=>$customer_email->id,
            'reset_token'=>uniqid(),
            'created_at'=>Carbon::now(),
        ]);
        Notification::send($customer_email, new PassResateNotificate($customer));
        return back()->with('Send', 'Confirmation Massage Send');
    }
    function resat_pass_form($token){
        return view('frontend.customer_pass_resate_form',[
            'token'=>$token,
        ]);
    }
    function resat_pass_update(Request $request){
         $reset_tocen_con =CustomerPasswordReset::where('reset_token', $request->reset_token)->firstOrFail();
         $customer = CustomerLogin::findOrFail($reset_tocen_con->customer_id);
         $customer->update([
            'password'=>bcrypt($request->password),
         ]);
         $reset_tocen_con->delete();
         return redirect()->route('customer.register');
    }
}
//$2y$10$JNuRP.OFhmaDkU5n1v9rDucYAg/fNx1KGttKqYUGFL02r7mbPOt.6
