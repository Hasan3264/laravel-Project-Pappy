@extends('layouts.dashboard')

@section('home1')
<style>
    .switch {
      position: relative;
      display: inline-block;
      width: 60px;
      height: 34px;
    }
    
    .switch input { 
      opacity: 0;
      width: 0;
      height: 0;
    }
    
    .slider {
      position: absolute;
      cursor: pointer;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: #ccc;
      -webkit-transition: .4s;
      transition: .4s;
    }
    
    .slider:before {
      position: absolute;
      content: "";
      height: 26px;
      width: 26px;
      left: 4px;
      bottom: 4px;
      background-color: white;
      -webkit-transition: .4s;
      transition: .4s;
    }
    
    input:checked + .slider {
      background-color: #2196F3;
    }
    
    input:focus + .slider {
      box-shadow: 0 0 1px #2196F3;
    }
    
    input:checked + .slider:before {
      -webkit-transform: translateX(26px);
      -ms-transform: translateX(26px);
      transform: translateX(26px);
    }
    
    /* Rounded sliders */
    .slider.round {
      border-radius: 34px;
    }
    
    .slider.round:before {
      border-radius: 50%;
    }
</style>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
               <div class="card">
                <div class="card-header">
                    <h3>Add Card</h3>
                </div>
                <div class="card-body">
                    <form action="{{ url('/banner/added') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mt-2">
                            <label>Add category</label>
                             <select name="category_id" class="form-control" id="category">
                                 @foreach (App\Models\categoryadd::all() as  $category)
                                <option value="{{$category->id}}">{{$category->category_name}}</option>
                                @endforeach
                             </select>
                        </div>
                        <div class="form-group mt-2">
                            <label>Add subcategory</label>
                             <select  name="subcategory_id" class="form-control" id="subcategory">
                                 @foreach (App\Models\sub_category::all() as  $subcategory)
                                <option value="{{$subcategory->id}}">{{$subcategory->category_name}}</option>
                                @endforeach
                             </select>
                        </div>
                        <div class="form-group mt-2">
                            <label>Add bannar Small Title</label>
                           <input type="text" class="form-control" name="small_title">
                        </div>
                        <div class="form-group mt-2">
                            <label>Add bannar Big Title</label>
                           <input type="text" class="form-control" name="big_title">
                        </div>
                        <div class="form-group mt-2">
                            <label>Add bannar Big Sub Title</label>
                           <input type="text" class="form-control" name="big_title_sub">
                        </div>
                        <div class="form-group mt-2">
                            <label>Add bannar Details</label>
                           <input type="text" class="form-control" name="banner_details">
                        </div>
                        <div class="form-group mt-2">
                            <label>Add bannar Main price</label>
                           <input type="number" class="form-control" name="price">
                        </div>
                        <div class="form-group mt-2">
                            <label>Add bannar Discount Price</label>
                           <input type="number" class="form-control" name="after_discount">
                        </div>
                        <div class="form-group mt-2">
                            <label>Add bannar Image</label>
                           <input type="file" name="banner_preview" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
               </div>
                </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <table class="table table-bordered">
                    <tr>
                        <th>SL</th>
                        <th>Small Title</th>
                        <th>Big Titl</th>
                        <th>Big Sub Title</th>
                        <th>Details</th>
                        <th>Discount Price</th>
                        <th>Image</th>
                        <th>Active Status</th>
                        <th>Action</th>
                    </tr>
                    @foreach ($get_banners as $key=> $banner)
                    <tr>
                           <td>{{$key+1}}</td>
                           <td>{{$banner->small_title}}</td>
                           <td>{{$banner->big_title}}</td>
                           <td>{{$banner->big_title_sub}}</td>
                           <td>{{$banner->banner_details}}</td>
                           <td>{{$banner->after_discount}}</td>
                           <td width="80"><img class="img-fluid" src="{{asset('/uploads/banner')}}/{{ $banner->banner_preview }}" alt="No"></td>
                           <td>
                            <a href=""  type="button" class="btn btn-danger shadow btn-xs sharp delete"><i class="fa fa-trash"></i></a>
                            <a href="" class="btn btn-info shadow btn-xs sharp mt-2"><i class="fa fa-pencil"></i></a>
                           </td>
                           <td><!-- Default checked -->
                            @if ($banner->active_status == 1)
                                <a href="{{route('bannerstatus.change', $banner->id)}}" class="btn btn-sm btn-success">Active</a>
                                @else
                                <a href="{{route('bannerstatus.change', $banner->id)}}" class="btn btn-sm btn-danger">Dective</a>
                            @endif
                            </td>
                        </tr>
                       @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
@section('fotter_js')


<script>
    $('#active_sw').click(function(){
      alart();
    });
</script> 


<script>


    $('#category').change(function (){
        var category_id = $(this).val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
                    $.ajax({
                            type:'POST',
                            url:'/getsubcategory',
                            data:{'category_id': category_id},
                            success:function(data){
                                $('#subcategory').html(data);
                            }
                    });
    });
</script>
@endsection
@section('fotter_js')
   
@endsection