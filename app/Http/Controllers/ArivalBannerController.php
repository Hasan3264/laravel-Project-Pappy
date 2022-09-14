<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\ArivalBannr;
use App\Models\BrandSection;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
class ArivalBannerController extends Controller
{
    
    function arivalbanner(){
        $getbanners =ArivalBannr::all();
        return view('admin.newarivalbanner.index',[
            'getbanners'=>$getbanners,
        ]);
    }
    
        function arival_add(Request $request){
            $arivalbannerid = ArivalBannr::insertGetId([
                 'title1'=>$request->title1,
                 'title2'=>$request->title2,
                 'title3'=>$request->title3,
                 'details'=>$request->details,
                 'photo'=>'kl',
                 'created_at'=>Carbon::now(),
            ]);
            $uploded_file= $request->photo;
            $extentaion= $uploded_file->getClientOriginalExtension();
            $file_name=$arivalbannerid.'.'.$extentaion;
             Image::make($uploded_file)->save(public_path('/uploads/arivalbanner/'.$file_name));
             ArivalBannr::find($arivalbannerid)->update([
            'photo'=>$file_name,
            ]);
             return back()->with('update','Updated done');
        }
        function arivalbannerstatus($aribanbanner_id){
            $getstatus =ArivalBannr::select('active_status')->where('id',$aribanbanner_id)->first();
            if ($getstatus->active_status == 1) {
                $status = 0;
            } else {
               $status = 1;
            }
            ArivalBannr::where('id',$aribanbanner_id)->update([
                'active_status'=>$status,      
            ]);
            return back();
       }







       // brand section codes addin breand deleting
       function brand(){
         return view('admin.brnadsection.index');
       }
       function brand_add(Request $request){
        $brandid = BrandSection::insertGetId([
            'img_name'=>'kl',
            'created_at'=>Carbon::now(),
       ]);
       $uploded_file= $request->img_name;
       $extentaion= $uploded_file->getClientOriginalExtension();
       $file_name=$brandid.'.'.$extentaion;
        Image::make($uploded_file)->save(public_path('/uploads/brandsection/'.$file_name));
        BrandSection::find($brandid)->update([
       'img_name'=>$file_name,
       ]);
        return back()->with('update','Updated done');
       }
    
}
