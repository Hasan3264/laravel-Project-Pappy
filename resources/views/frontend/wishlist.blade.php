@extends('frontend.master')
@section('content')
<section class="cart_section section_space">
    <div class="container">
        <div class="cart_table">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th>PRODUCT</th>
                        <th class="text-center">PRICE</th>
                        <th class="text-center">STOCK STATUS</th>
                        <th class="text-center">ADD TO CART</th>
                        <th class="text-center">REMOVE</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($getwishs as $getwish)    
                    <tr>
                        <td>
                            <div class="cart_product">
                                <img src="{{asset('/uploads/product/preview')}}/{{$getwish->rel_to_product->Product_preview}}" alt="image_not_found" />
                                <h3>{{$getwish->rel_to_product->product_name}}</h3>
                            </div>
                        </td>
                        <td class="text-center"><span class="price_text">{{$getwish->rel_to_product->after_discount}}</span></td>
                        <td class="text-center"><span class="price_text text-success"></span></span></td>
                        <td class="text-center">
                            <a href="{{ route('Product.details', $getwish->product_id) }}" class="btn btn_primary">Add To Cart</a>
                           
                        </td>
                        <td class="text-center">
                            <button type="button" value="{{route('wishlist.delete',$getwish->id)}}" class="remove_btn delete"><i class="fal fa-trash-alt"></i></button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection
@section('javascrift')
    <script>
        $(document).ready(function(){
         $('.delete').click(function(){
            var link=$(this).val();
            Swal.fire({
                  title: 'Are you sure?',
                  text: "You won't be able to revert this!",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Yes, delete it!'
                  }).then((result) => {
                  if (result.isConfirmed) {
                     window.location.href = link;

                  }
                  })
         })
   });
    </script>
@endsection