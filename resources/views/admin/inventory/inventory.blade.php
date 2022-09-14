@extends('layouts.dashboard')
@section('home1')
<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">sub_category</a></li>
    </ol>
</div>
@can('show-inventory')

<div class="container">
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                        <h3>Inventory</h3>
                </div>
                <div class="card-body">
        <table class="table table-bordered">
             <tr>
                 <th>Sl</th>
                 <th>Peoduct Name</th>
                 <th>color name</th>
                 <th>Size name</th>
                 <th>Quantity</th>
                 <th>Action</th>
             </tr>
             @foreach ($inventory as $key=> $inventoryes)
             <tr>
                 <td>{{ $key+1 }}</td>
                 <td>{{ $inventoryes->relation_product->product_name }}</td>
                 <td>{{ $inventoryes->relation_color->color_name}}</td>
                 <td>{{ $inventoryes->relation_size->size_name}}</td>
                 <td>{{ $inventoryes->quantity}}</td>
                 <td>
                    <button value=""  type="button" class="btn btn-danger shadow btn-xs sharp delete"><i class="fa fa-trash"></i></button>
                    <a href="" class="btn btn-info shadow btn-xs sharp mt-2"><i class="fa fa-pencil"></i></a>
                 </td>
             </tr>

             @endforeach
        </table>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
         <div class="card">
             <div class="card-header">
                        <h3>Add Inventory</h3>
             </div>
             <div class="card-body">
                 <form action="{{ url('/inventory/insert') }}" method="POST">
                    @csrf
                     <div class="mt-3">
                         <input type="hidden" name="product_id" class="form-control" value="{{ $product->id }}">
                         <input type="text" readonly class="form-control" value="{{ $product->product_name }}">
                     </div>
                     <div class="mt-3">
                         <select name="color_id" class="form-control">
                             <label for="" class="form-label">select Color</label>
                             <option value="">----- select color------</option>
                             @foreach ($color as $colors)
                                <option value="{{ $colors->id }}">{{ $colors->color_name }}</option>
                             @endforeach
                         </select>
                     </div>
                     <div class="mt-3">
                         <select name="size_id" class="form-control">
                             <label for="" class="form-label">Select Size</label>
                             <option value="">----- select size------</option>
                             @foreach ($size as $sizes)
                                <option value="{{ $sizes->id }}">{{ $sizes->size_name }}</option>
                             @endforeach
                         </select>
                     </div>
                     <div class="mt-3">
                        <input type="text"  class="form-control" placeholder="Quantity" name="quantity">
                    </div>
                     <div class="mt-3">
                         <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                 </form>
             </div>
         </div>
        </div>
    </div>
</div>
    @else
    <div class="alert alert-warning">You Have No Permission</div>
@endcan


@endsection
@section('fotter_js')
@if (session('success'))
<script>
    Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: '{{session('
        success ')}}',
        showConfirmButton: false,
        timer: 1500
    })
    //     Swal.fire(
    // 'done!',
    // '{{session('update')}}',
    // 'success'
    // )

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
