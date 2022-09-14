<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\banner;
use Image;
use Illuminate\Support\Facades\Auth;
class bannerController extends Controller
{
    function banner(){
        $get_banners =banner::all();
        return view('admin.banner.banner_add',[
            'get_banners'=>$get_banners,
        ]);
    }
    function banner_add(Request $request){
      $banner_id = banner::insertGetId([
            'cetegory_id'=>$request->category_id,
            'small_title'=>$request->small_title,
            'big_title'=>$request->big_title,
            'big_title_sub'=>$request->big_title_sub,
            'banner_details'=>$request->banner_details,
            'price'=>$request->price,
            'banner_preview'=>'kol',
            'after_discount'=>$request->after_discount,
            'sub_cetegory_id'=>$request->subcategory_id,
            'created_at'=>Carbon::now(),
        ]);
        $uploded_file= $request->banner_preview;
        $extentaion= $uploded_file->getClientOriginalExtension();
        $file_name=$banner_id.'.'.$extentaion;
         Image::make($uploded_file)->resize(900,500)->save(public_path('/uploads/banner/'.$file_name));
        banner::find($banner_id)->update([
        'banner_preview'=>$file_name,

    ]);
    return back()->with('update','Updated done');
    }
    function bannerstatus($banner_id){
         $getstatus =banner::select('active_status')->where('id',$banner_id)->first();
         if ($getstatus->active_status == 1) {
             $status = 0;
         } else {
            $status = 1;
         }
         banner::where('id',$banner_id)->update([
             'active_status'=>$status,
         ]);
         return back();
    }
}
