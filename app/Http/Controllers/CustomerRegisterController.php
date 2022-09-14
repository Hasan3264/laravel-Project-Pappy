<?php

namespace App\Http\Controllers;

use App\Models\CustomerEmailVarificate;
use Illuminate\Http\Request;
use App\Models\CustomerLogin;
use App\Notifications\CustomerEmailvarifyNotification;
use Carbon\Carbon;
use Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
class CustomerRegisterController extends Controller
{
    function register(){
        return view('frontend.register_login');
    }
    function insert(Request $request){
         $request->validate([
            'password'=>'required',
            'password'=>Password::min(8)
                       ->letters()
                       ->numbers(),
            'password'=>'confirmed',
        ]);
        CustomerLogin::insert([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
            'created_at'=>Carbon::now(),
        ]);
        $customer_login  = CustomerLogin::where('email', $request->email)->firstOrFail();
        $delete_info  = CustomerEmailVarificate::where('customer_id', $customer_login->id)->delete();
        $varify_info =CustomerEmailVarificate::create([
             'customer_id' =>$customer_login->id,
             'token' => uniqid(),
             'created_at'=>Carbon::now(),
        ]);
    Notification::send($customer_login,new CustomerEmailvarifyNotification($varify_info));
        return back()->with('verify_email', 'We Sent an Email For Varification');
    }

    function logout(){
        Auth::guard('customerlogin')->logout();
        return redirect('/');
    }

}
