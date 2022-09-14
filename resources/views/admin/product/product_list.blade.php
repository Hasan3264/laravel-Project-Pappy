@extends('layouts.dashboard')
@section('home1')
<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">sub_category</a></li>
    </ol>
</div>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3>Product List</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th class="text-black">Sl</th>
                            <th class="text-blue">Product Name</th>
                            <th class="text-green">Price</th>
                            <th class="text-red">Discount</th>
                            <th class="text-violet">After discount</th>
                            <th class="text-orange">Short desp</th>
                            <th class="text-primary">Long desp</th>
                            <th class="text-pink">Preview</th>
                            <th class="text-green">Action</th>
                        </tr>
                        @foreach ($all_product as $key => $product)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{$product->product_name  }}</td>
                            <td>{{$product->product_price  }}</td>
                            <td>{{$product->discount  }}</td>
                            <td>{{$product->after_discount  }}</td>
                            <td>{{substr($product->short_des, 0,20).'  .....more'}}</td>
                            <td>{{substr($product->long_des,  0,50).'  more....'}}</td>
                            <td width="80"><img class="img-fluid" src="{{asset('/uploads/product/preview')}}/{{ $product->Product_preview }}" alt=""></td>
                            <td width="120">
                                <a href="{{ route('product.dlt',$product->id) }}"  type="button" class="btn btn-danger shadow btn-xs sharp delete"><i class="fa fa-trash"></i></a>
                                <a href="{{route('edit.product_page',$product->id)}}" class="btn btn-info shadow btn-xs sharp mt-2"><i class="fa fa-pencil"></i></a>
                                <a href="{{ route('inventory', $product->id) }}" class="btn btn-info shadow btn-xs sharp mt-2"><i class="fa fa-archive"></i></a>
                            </td>
                        </tr>
                        @endforeach

                    </table>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection
@section('fotter_js')
 @if (session('deleted'))
 <script>
     Swal.fire({
  position: 'top-end',
  icon: 'success',
  title: '{{session('deleted')}}',
  showConfirmButton: false,
  timer: 1500
})
        Swal.fire(
    'done!',
    '{{session('deleted')}}',
    'Deleted'
    )
</script>
 @endif

{{-- <script>
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
</script> --}} 

@endsection
