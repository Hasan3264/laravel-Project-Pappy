<?php

namespace App\Http\Controllers;
use App\Models\categoryadd;
use App\Models\sub_category;
use App\Models\product;
use App\Models\thumbnails;
use Carbon\Carbon;
// use Image;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    function index(){
        $selectcat= categoryadd::all();
        $selectsubcat= sub_category::all();
        return view('admin.product.index',[
            'categoryes'=>$selectcat,
            'subcategory'=>$selectsubcat,
         ]);
    }


    function getsubcategory(Request $request){
       $sub_categories=  sub_category::where('category_id', $request->category_id)->get();
       $str='<option value="">----- Select Sub Category -----</option>';
       foreach($sub_categories as $sub_category){
           $str .='<option value="'.$sub_category->id.'">'.$sub_category->subcategory_name.'</option>';
       }
      echo $str;
    }
    function insert(Request $request){
        $product_id=product::insertGetId([
            'category_id'=>$request->category_id,
            'subcategory_id'=>$request->subcategory_id,
            'product_name'=>$request->product_name,
            'product_price'=>$request->product_price,
            'discount'=>$request->discount,
            'after_discount'=>$request->product_price - ($request->product_price*$request->discount)/100,
            'short_des'=>$request->short_des,
            'long_des'=>$request->long_des,
            'created_at'=>Carbon::now(),

         ]);
                    $uploded_file= $request->Product_preview;
                    $extentaion= $uploded_file->getClientOriginalExtension();
                    $file_name=$product_id.'.'.$extentaion;
                    Image::make($uploded_file)->resize(680,680)->save(public_path('/uploads/product/preview/'.$file_name));

                    Product::find($product_id)->update([
                    'Product_preview'=>$file_name,

                ]);
                $loop = 1;
                $thumbnail_Image=$request->thumbnails;
                foreach($thumbnail_Image as $thumb){
                    $extentaion_thumbnails = $thumb->getClientOriginalExtension();
                    $thumbnail_name=$product_id.'-'.$loop.'.'.$extentaion_thumbnails;
                    Image::make($thumb)->resize(680,680)->save(public_path('/uploads/product/thumbnails/'.$thumbnail_name));

                                thumbnails::insert([
                                    'product_id'=>$product_id,
                                    'thumbnail'=>$thumbnail_name,
                                    'created_at'=>Carbon::now(),
                                ]);

                    $loop++;

                }
         return back()->with('update','Updated done');
     }

            function get_product(){
                $all_product = product::all();
                return view('admin.product.product_list',[
                    'all_product'=> $all_product,
                ]);
            }
            function product_delete($product_id){
                $product_image= Product::find($product_id);
                $delete_from=public_path('/uploads/product/preview/'.$product_image->Product_preview);
                unlink($delete_from);
                Product::find($product_id)->delete();
                return back()->with('deleted','Deletion successed');
            }
            function edit_product_page($product_id){
                $selectcat= categoryadd::all();
                $sub_categoryes= sub_category::all();
                $product_info= product::find($product_id);
                return view('admin.product.edit',[
                    'selectcat'=>$selectcat,
                    'sub_categoryes'=>$sub_categoryes,
                    'product_info'=>$product_info,
                ]);
            }
            function edit_product(Request $request){
            product::find($request->product_id)->update([
                    'category_id'=>$request->category_id,
                    'subcategory_id'=>$request->subcategory_id,
                    'product_name'=>$request->product_name,
                    'product_price'=>$request->product_price,
                    'discount'=>$request->discount,
                    'after_discount'=>$request->product_price - ($request->product_price*$request->discount)/100,
                    'short_des'=>$request->short_des,
                    'long_des'=>$request->long_des,
                    'updated_at'=>Carbon::now(),
            ]);
            
            $product_id = $request->product_id;
            $product_image= Product::find($product_id);
           
            $delete_from=public_path('/uploads/product/preview/'.$product_image->Product_preview);
             unlink($delete_from);     
            $uploded_file= $request->Product_preview;
                            $extentaion= $uploded_file->getClientOriginalExtension();
                            $file_name=$product_id.'.'.$extentaion;
                            Image::make($uploded_file)->resize(680,680)->save(public_path('/uploads/product/preview/'.$file_name));
                            Product::find($product_id)->update([
                                'Product_preview'=>$file_name,       
                                
             ]);
                        // $loop = 1;
                        // $thumbnail_Image=$request->thumbnails;
                        // foreach($thumbnail_Image as $thumb){
                        //     $extentaion_thumbnails = $thumb->getClientOriginalExtension();
                        //     $thumbnail_name=$product_id.'-'.$loop.'.'.$extentaion_thumbnails;
                        //     Image::make($thumb)->resize(680,680)->save(public_path('/uploads/product/thumbnails/'.$thumbnail_name));

                        //                 thumbnails::update([
                        //                     'product_id'=>$product_id,
                        //                     'thumbnail'=>$thumbnail_name,
                        //                     'updated_at'=>Carbon::now(),
                        //                 ]);

                        //     $loop++;

                        // }
                 return back()->with('update','Updated done');
            }

}


// $delete_from=public_path('/uploads/users/'.Auth::user()->profile_photo);
            //     unlink($delete_from);
            //     Image::make($upload_photo)->save(public_path('/uploads/users/'.$file_name));
            //     User::find(Auth::id())->update([
            //         'profile_photo'=>$file_name,
            //     ]);