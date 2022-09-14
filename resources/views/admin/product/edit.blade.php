@extends('layouts.dashboard')
@section('home1')
<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">sub_category Edit</a></li>
    </ol>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3>add product</h3>
            </div>
            <div class="card-body">
                <form action="{{url('/product/edit/update')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label">category</label>
                                <select name="category_id" class="form-control" id="category">
                                    <option value="">--- Select Category -------</option>
                                    @foreach($selectcat as  $category)
                                    <option value="{{$category->id}}" {{($category->id == $product_info->category_id?'selected':'')}}>{{$category->category_name}}</option>
                                  @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="" class="form-label">Sub category Name</label>
                                <select name="subcategory_id" class="form-control" id="subcategory">
                                    {{-- <option value="">----- Select Sub Category -----</option> --}}
                                    @foreach($sub_categoryes as  $sub_category)
                                    <option value="{{$sub_category->id}}" {{($sub_category->id == $product_info->subcategory_id?'selected':'')}}>{{$sub_category->subcategory_name}}</option>
                                  @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="" class="form-label">product name</label>
                                <input type="hidden" name="product_id" value="{{$product_info->id}}" class="form-control">
                                <input type="text" name="product_name" value="{{$product_info->product_name}}" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="" class="form-label">product price</label>
                                <input type="number" name="product_price" value="{{$product_info->product_price}}" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="" class="form-label">Discount %</label>
                                <input type="number" name="discount" class="form-control" value="{{$product_info->discount}}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="" class="form-label">Short description</label>
                                <input type="text" name="short_des" class="form-control" value="{{$product_info->short_des}}">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="" class="form-label">Long description</label>
                                <textarea type="text" name="long_des" class="form-control" id="summernote"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="" class="form-label">Product Preview</label>
                                <input type="file" name="Product_preview" class="form-control" value="{{$product_info->Product_preview}}">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <span ><img class="img-fluid" src="{{asset('/uploads/product/preview')}}/{{ $product_info->Product_preview }}" alt=""></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="" class="form-label">Product Thumbnails</label>
                                <input type="file" name="thumbnails[]" multiple class="form-control">
                            </div>
                        </div>
                        

                    </div>
                    <div class="col-lg-12 mt-2">
                        <div class="form-group text-center">
                          <button type="submit" class="btn btn-primary">update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

@endsection
@section('fotter_js')
 @if (session('update'))
 <script>
     Swal.fire({
  position: 'top-end',
  icon: 'success',
  title: '{{session('update')}}',
  showConfirmButton: false,
  timer: 1500
})
        Swal.fire(
    'done!',
    '{{session('update')}}',
    'success'
    )
</script>
 @endif
 //summer note
<script>
    $(document).ready(function() {
  $('#summernote').summernote();
});
</script>
//summer note
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
