<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;
use App\Models\categoryadd;
use App\Models\color;
use App\Models\Size;
use App\Models\Inventory;
use App\Models\Ipadpart;
use App\Models\OrderProduct;
use App\Models\Promotion;
use App\Models\BrandSection;
use Illuminate\Support\Facades\Auth;
use PHPUnit\Util\Xml\SchemaFinder;
use Carbon\Carbon;
use Cookie;
use Arr;
use function Ramsey\Uuid\v1;

class Frontendcontrollar extends Controller
{
    function index(){
        $get_promotion = Promotion::where('active_status',1)->get();
        $grt_all_product=product::take(6)->get();
        $get_quick=Ipadpart::latest()->take(1)->get();
        $get_brands=BrandSection::latest()->take(5)->get();
        $New_arivel=product::latest()->take(4)->get();
        $latest=product::latest()->take(6)->get();
        $get_all_category=categoryadd::all();
        $reviews = OrderProduct::whereNotNull('review')->get();
        $total_star = OrderProduct::whereNotNull('review')->sum('star');
        $bestselling = OrderProduct::groupBy('product_id')
        ->selectRaw('sum(quentity) as sum, product_id')
        ->orderBy('quentity','DESC')
        ->havingRaw('sum >=5')
        ->get();
        $get_recent = json_decode(Cookie::get('recent_view'), true);
        if($get_recent == null){
            $get_recent = [];   
            $after_unique = array_unique($get_recent);
        }
        else{
            $after_unique = array_unique($get_recent);
        }
        $all_recent_product = Product::find($after_unique);
        return view('frontend.index',[
            'promotions'=>$get_promotion,
            'all_product'=>$grt_all_product,
            'all_category'=>$get_all_category,
            'get_brands'=>$get_brands,
            'latest'=>$latest,
            'New_arivel'=>$New_arivel,
            'get_quick'=>$get_quick,
            'reviews'=>$reviews,
            'total_star'=>$total_star,
            'all_recent_product'=>$all_recent_product,
            'bestselling'=>$bestselling,
        ]);
    }
    function about(){
        return view('about');
    }
    function Pro_details($product_id){
       $pro_info =product::find($product_id);
       $related_product=product::where('id','!=', $product_id)->where('category_id', $pro_info->category_id)->get();
       $reviews = OrderProduct::where('product_id', $product_id)->whereNotNull('review')->get();
       $total_reviews = OrderProduct::where('product_id', $product_id)->whereNotNull('review')->count();
       $total_star = OrderProduct::where('product_id', $product_id)->whereNotNull('review')->sum('star');
       $al = Cookie::get('recent_view');
       if(!$al){
           $al = "[]";
       }

       $all_info = json_decode($al, true);
       $all_info = Arr::prepend($all_info, $product_id);
       $recent_product_id = json_encode($all_info);

       Cookie::queue('recent_view', $recent_product_id, 1000);
        return view('frontend.shop_details',[
            'pro_info'=>$pro_info,
            'related_product'=>$related_product,
            'reviews'=>$reviews,
            'total_reviews'=>$total_reviews,
            'total_star'=>$total_star,
        ]);
    }
    function getsize(Request $request){
        $str='<option class="clr_id" value="'.$request->color_id.'">Choose A Option</option>';
        $sizes=  Inventory::where('product_id', $request->product_id)->where('color_id', $request->color_id)->get();
        foreach($sizes as $size){
            $str .='<option value="'.$size->size_id.'">'. $size->relation_size->size_name.'</option>';
        }
        echo $str;
     }
    function getsizes(Request $request){
        $str='<option value="">Choose A Option</option>';
        $sizes=  Inventory::where('product_id', $request->product_id)->where('color_id', $request->color_id)->get();
        foreach($sizes as $size){
            $str .='<option value="'.$size->size_id.'">'. $size->relation_size->size_name.'</option>';
        }
        echo $str;
     }
     function error(){
         return view('frontend.error');
     }
     function review(Request $request){
        OrderProduct::where('user_id', Auth::guard('customerlogin')->id())->where('product_id', $request->product_id)->update([
            'review'=>$request->review,
            'star'=>$request->star,
            'updated_at'=>Carbon::now(),
        ]);
        return back();
     }
     function shop(Request $request){
        $data = $request->all();
        $get_all_product=product::where(function($q) use($data){
            if(!empty($data['q']) && $data['q'] != '' && $data['q'] != 'undefined'){
                $q->where(function ($q) use ($data){
                     $q->where('product_name', 'like','%'.$data['q'].'%');
                     $q->orWhere('short_des', 'like','%'.$data['q'].'%');
                     $q->orWhere('after_discount', 'like','%'.$data['q'].'%');
                });
            }
            if(!empty($data['category_id']) && $data['category_id'] != '' && $data['category_id'] != 'undefined'){
                     $q->where('category_id',$data['category_id']);
            }
            // if(!empty($data['product_id']) && $data['product_id'] != '' && $data['product_id'] != 'undefined'){
            //          $q->where('product_id',$data['product_id']);
            // }

            if(!empty($data['amount']) && $data['amount'] != '' && $data['amount'] != 'undefined'){
                  $amount = explode('-', $data['amount']);
                     $q->whereBetween('after_discount',[$amount[0],$amount[1]]);
            }

            if(!empty($data['color_id']) && $data['color_id'] != '' && $data['color_id'] != 'undefined' || !empty($data['Size_id']) && $data['Size_id'] != '' && $data['Size_id'] != 'undefined'){
                     $q->whereHas('to_inventoryes', function ($q) use($data){
                           if(!empty($data['color_id']) && $data['color_id'] != '' && $data['color_id'] != 'undefined'){
                            $q->whereHas('relation_color', function($q) use($data){
                                $q->where('color_id',$data['color_id']);  
                            });      
                           }
                           if(!empty($data['Size_id']) && $data['Size_id'] != '' && $data['Size_id'] != 'undefined'){
                            $q->whereHas('relation_size', function($q) use($data){
                                $q->where('Size_id',$data['Size_id']);  
                            });      
                           }
                     });
            }
        })->get();
        $get_all_category=categoryadd::all();
        $colors=color::all();
        $Sizes=Size::all();
        return view('frontend.shop',[
            'get_all_product'=>$get_all_product,
            'get_all_category'=>$get_all_category,
            'colors'=>$colors,
            'Sizes'=>$Sizes,
        ]);
     }
     function stockout(Request $request){
        if(Inventory::where('product_id', $request->product_id)->where('color_id',$request->color_id)->where('size_id', $request->size_id)->first()->quantity==0){
              echo '<h1 class="btn btn-warning">Out of Stock</h1>';
        }
        else{
            echo '<button class="btn btn_primary addtocart_btn" type="submit">Add To Cart</button>';
        }
     }
    
}
