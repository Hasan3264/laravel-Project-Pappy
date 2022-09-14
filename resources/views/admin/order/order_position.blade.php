@extends('layouts.dashboard')
@section('home1')
<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">Order Position</a></li>
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
                        <th>Product</th>
                        <th>Customer Name</th>
                        <th>Customer Location</th>
                        <th>Customer Email</th>
                        <th>Customer Phone</th>
                        <th>Customer Address</th>
                        <th>Delivary Charge</th>
                        <th>Position</th>
                       </tr>
                       @foreach ($order_position as $order)
                           
                       @endforeach
                           <tr>
                            <td width="80"><img class="img-fluid" src="{{asset('/uploads/product/preview')}}/{{ $order->relation_product->Product_preview }}" alt="No"></td>
                            @foreach (App\Models\BillingDetails::where('order_id',$order->relation_order->id)->get() as $item)
                            <td>{{$item->name}}</td>
                            <td>
                                    {{$item->relation_district->name}},{{$item->relation_upazila->name}}
                             </td>
                            <td>
                                    {{$item->email}}
                             </td>
                            <td>
                                    {{$item->phone}}
                             </td>
                            <td>
                                    {{$item->address}}
                             </td>
                             @endforeach
                             <td>{{$order->relation_order->delivary_charge}}</td>
                             <td></td>
                           </tr>
                    
                       
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
 
<script>

</script>

@endsection
