<?php

namespace App\Http\Controllers;
use App\Models\CustomerLogin;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\product;
use App\Models\wishlist;
use App\Models\Inventory;
use Illuminate\Support\Facades\Auth;
class WishlistController extends Controller
{
   function wishlist_page(){
    $getwishs= wishlist::all();
      return view('frontend.wishlist',[
              'getwishs'=>$getwishs,
      ]);
   }
   function wishlist_insert($product_id){
     $pro_info =product::find($product_id);
     wishlist::insert([
        'customer_id'=>Auth::guard('customerlogin')->id(),
        'product_id'=>$pro_info->id,
        'created_at'=>Carbon::now(),
    ]);
     return back()->with('added', 'Cart Added Success');
   }
   function wishlist_delete($wishlist_id){
      wishlist::find($wishlist_id)->delete();
      return back()->with('deleted','Deletion successed');
   }
}
