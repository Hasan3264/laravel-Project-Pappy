@extends('layouts.dashboard')
@section('home1')
<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">Orders</a></li>
    </ol>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3>Orders</h3>
            </div>
            <div class="card-body">
                <table class="table table-border">
                       <tr>
                        <th>sl</th>
                        <th>Product</th>
                        <th>Customer Name</th>
                        <th>Product Name</th>
                        <th>Qnt</th>
                        <th>Discount</th>
                        <th>Total</th>
                        <th>Order position</th>
                        <th>Action</th>
                       </tr>
                       @foreach ($orders as $key=> $item)
                       <tr>
                          <td>{{$key+1}}</td>
                          <td width="80"><img class="img-fluid" src="{{asset('/uploads/product/preview')}}/{{ $item->relation_product->Product_preview }}" alt="No"></td>
                           <td>{{$item->relation_customer->name}}</td>
                           <td>{{$item->relation_product->product_name}}</td>
                           <td>{{$item->quentity}}</td>
                           <td>{{$item->relation_order->discount}}</td>
                           <td>{{$item->relation_order->subtotal}}</td>
                           <td><a href="{{route('order.position',$item->id)}}">See</a></td>
                           <td><button class="btn btn-danger">Delete</button></td>
                       </tr>
                       @endforeach
                </table>
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
    //     Swal.fire(
    // 'done!',
    // '{{session('update')}}',
    // 'success'
    // )
</script>
 @endif
@endsection
