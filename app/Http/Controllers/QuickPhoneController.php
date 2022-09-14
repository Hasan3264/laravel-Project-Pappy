<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Ipadpart;
use App\Models\Audio;
use App\Models\Audio_list;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
class QuickPhoneController extends Controller
{
    function quick_phone(){
        return view('admin.quick.phone.index');
    }
    function add_phone(Request $request){
        $phone_id =Ipadpart::insertGetId([
                  'product_title'=>$request->product_title,
                  'product_det'=>$request->product_det,
                  'product_preview'=>'alt',
                  'created_at'=>Carbon::now(),
        ]);
        $uploded_file= $request->product_preview;
        $extentaion= $uploded_file->getClientOriginalExtension();
        $file_name=$phone_id.'.'.$extentaion;
         Image::make($uploded_file)->save(public_path('/uploads/quick1/'.$file_name));
         Ipadpart::find($phone_id)->update([
        'product_preview'=>$file_name,

    ]);
    return back()->with('update','Updated done');
    }
    function audio(){
        $audio_lists = Audio_list::all();
        return view('admin.quick.audio.index',[
            'audio_lists'=>$audio_lists,
        ]);
    }
    function add_audiolist(Request $request){
        Audio_list::insert([
              'audio_list'=>$request->audio_list,
              'created_at'=>Carbon::now(),
        ]);
        return back()->with('update','Updated done');
    }
    function add_audio(Request $request){
       
      $getaudioId =  Audio::insertGetId([ 
              'name'=>$request->name,
              'audio_photo'=>'kl',
              'created_at'=>Carbon::now(),
        ]);
        $uploded_file= $request->audio_photo;
        $extentaion= $uploded_file->getClientOriginalExtension();
        $file_name=$getaudioId.'.'.$extentaion;
         Image::make($uploded_file)->save(public_path('/uploads/quick2/'.$file_name));
         Audio::find($getaudioId)->update([
        'audio_photo'=>$file_name,
    ]);
        return back()->with('update','Updated done');
    }
}
