@extends('frontend.master')
@section('content')
<!-- cart_section - start
    ================================================== -->
<section class="cart_section section_space">
    @if (App\Models\Cart::where('customer_id', Auth::guard('customerlogin')->id())->count() > 0)
    <!-- breadcrumb_section - start
        ================================================== -->
    <div class="breadcrumb_section">
        <div class="container">
            <ul class="breadcrumb_nav ul_li">
                <li><a href="{{ route('homepage') }}">Home</a></li>
                <li>Cart</li>
            </ul>
        </div>
    </div>
    <!-- breadcrumb_section - end
        ================================================== -->
    <div class="container">

        <div class="cart_table">
            <table class="table">
                <thead>
                    <tr>
                        <th>Product </th>
                        <th class="text-center">Price</th>
                        <th class="text-center">Quantity</th>
                        <th class="text-center">Total</th>
                        <th class="text-center">Stock</th>
                        <th class="text-center">Remove</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $sub_total=0;
                    $abc =true;
                    @endphp
                    @foreach ($carts as $key=> $cart )
                    <tr>
                        <td>
                            <div class="cart_product">
                                <img
                                src="{{ asset('/uploads/product/preview')}}/{{ $cart->relation_product->Product_preview }}">
                                <h3><a href="shop_details.html">{{ $cart->relation_product->product_name }}</a></h3>
                            </div>
                        </td>
                        <td class="text-center sus"><span
                            class="price_text">{{$cart->relation_product->after_discount}}</span></td>
                            <td class="text-center sus">
                                    <form action="{{ route('cart.update') }}" method="POST">
                                        @csrf
                                    <div class="quantity_input">
                                        <button type="button" class="input_number_decrement" id="dec">
                                            <i data-price={{ $cart->relation_product->after_discount }}
                                                class="fal fa-minus"></i>
                                            </button>
                                            <input class="input_number" type="text" name="quantity[{{ $cart->id }}]" value="{{ $cart->quantity }}">
                                            <button type="button" class="input_number_increment" id="inc">
                                                <i data-price={{ $cart->relation_product->after_discount }}
                                                    class="fal fa-plus"></i>
                                            </button>
                                            </div>
                                        </td>
                                        <td class="text-center sus"><span class="price_text">{{ $cart->relation_product->after_discount*$cart->quantity }}</span>
                                        </td>
                                        <td>
                                            @if ($abc == false)
                                                <li class="alert alert-danger">Stock out Product Added</li>
                                            @endif
                                            @if (App\Models\Inventory::where('product_id',$cart->product_id)->where('color_id',$cart->color_id)->where('size_id', $cart->size_id)->first()->quantity <= $cart->quantity)
                                            <button class="btn btn-danger">Out-stock</button>
                                            @php
                                                $abc=false
                                            @endphp
                                            @else
                                            <button class="btn btn-primary">in-stock</button>
                                            @endif
                                        </td>
                                        <td class="text-center"><a href="{{ route('cart.remove', $cart->id) }}" class="remove_btn"><i
                                            class="fal fa-trash-alt"></i></a></td>
                                            @php
                                    $sub_total += $cart->relation_product->after_discount*$cart->quantity
                                    @endphp
                                    @endforeach
                                </tr>
                                    <td>
                                        <li><button disabled id="update" type="submit" class="btn border_black">Update Cart</button></li>
                                    </td>


                                </form>
                            </tbody>


                        </table>

        </div>

        <div class="cart_btns_wrap">
            <div class="row">
                @if ($massage)
                <div class="alert alert-danger" role="alert">
                    {{$massage}}
                    
                </div>
                @endif
                
                <div class=" col-lg-12" style="margin-top: 20px;">
                    <form action="{{ url('/customer/cart') }}" method="GET">
                        <div class="coupon_form form_item mb-0">
                            <input type="text" name="coupon" placeholder="Coupon Code..." value="{{@$_GET['coupon']}}">
                            <button type="submit" class="btn btn_dark">Apply Coupon</button>
                            <div class="info_icon">
                                <i class="fas fa-info-circle" data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Your Info Here"></i>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>


        <div class="row">


            <div class="col col-lg-8 m-auto">
                <div class="cart_total_table">
                    <h3 class="wrap_title">Cart Totals</h3>
                    <ul class="ul_li_block">
                        <li>
                            <span>Cart Subtotal</span>
                            <span>{{ $sub_total }}</span>
                        </li>
                        <li>
                            <span>Discount</span>
                            <span>{{ $discount }}@php
                                if($discount_type == 'parcentage'){
                                 $dis_type = '%';
                                 echo $dis_type;
                                session([
                                   'dis_type'=>$dis_type
                                ]);
                                }
                                elseif ($discount_type == 'amount') {
                                 echo $dis_type ='Cash';
                                session([
                                   'dis_type'=>$dis_type
                                ]);
                                }
                                elseif($discount_type == 'stripe') {
                                    echo $dis_type = 'PayPal';
                                    session([
                                   'dis_type'=>$dis_type
                                ]);
                              }
                                else {
                                    echo $dis_type = '0';
                                    session([
                                   'dis_type'=>$dis_type
                                   ]);
                                }
                            @endphp</span>
                            
                        </li>
                        <li>
                            <span>Order Total</span>
                            <span class="total_price">
                                @php
                                if($discount_type == 'parcentage'){
                                $sub = $sub_total -($sub_total*$discount)/100;
                                echo $sub;
                                session([
                                   'sub'=>$sub
                                ]);
                                }
                                elseif ($discount_type == 'amount') {
                                $sub= $sub_total - $discount;
                                echo $sub;
                                session([
                                   'sub'=>$sub
                                ]);
                                }
                                else {
                                    $sub =$sub_total;
                                    echo $sub;
                                    session([
                                   'sub'=>$sub
                                ]);
                                }
                                @endphp
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        @php
         session([
             'discount'=> $discount,
             'discount_type'=> $discount_type,
             'sub_total'=> $sub_total,
         ])
        @endphp
        <div class="row justify-content-end">
            <div class="col-lg-6 btns_group ul_li_right">
                @if ($abc==false)
                <li class="alert alert-danger">Stock Out Product added</li>
                @else
                <li><a class="btn btn_dark" href="{{ route('checkout') }}">Prceed To Checkout</a></li>
                @endif
            </div>
        </div>
    </div>

    @else
    <div class="breadcrumb_section">
        <div class="container">
            <ul class="breadcrumb_nav ul_li">
                <li><a href="{{ route('homepage') }}">Home</a></li>
                <li>Empty Cart</li>
            </ul>
        </div>
    </div>
    <!-- breadcrumb_section - end
                ================================================== -->
    <!-- empty_cart_section - start
                ================================================== -->
    <section class="empty_cart_section section_space">
        <div class="container">
            <div class="empty_cart_content text-center">
                <span class="cart_icon">
                    <i class="icon icon-ShoppingCart"></i>
                </span>
                <h3>There are no more items in your cart</h3>
                <a class="btn btn_secondary" href="{{ route('homepage') }}"><i class="far fa-chevron-left"></i> Continue
                    shopping </a>
            </div>
        </div>
    </section>
    <!-- empty_cart_section - end
                ================================================== -->
    @endif
</section>
@endsection

@section('javascrift')
<script>
    // $('.remove_btn').click(function () {
    //     let cart_id = $(this).attr('data-cartId');
    //     $.ajaxSetup({
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         }
    //     });
    //     $.ajax({
    //         type: 'POST',
    //         url: '/cartgetId',
    //         data: {
    //             'cart_id': cart_id
    //         },
    //     });
    // });

</script>
<script>
     let quantity_input = document.querySelectorAll('.sus');
     let arr= Array.from(quantity_input);
      arr.map(item=>{
          item.addEventListener('click', function(e){
             if(e.target.className == 'fal fa-plus'){
                e.target.parentElement.previousElementSibling.value++
                let quantity= e.target.parentElement.previousElementSibling.value
                let price = e.target.dataset.price;
                item.nextElementSibling.innerHTML = price*quantity
             }
             if(e.target.className == 'fal fa-minus'){
                 if(e.target.parentElement.nextElementSibling.value > 1){
                     e.target.parentElement.nextElementSibling.value--
                     let quantity= e.target.parentElement.nextElementSibling.value
                     let price = e.target.dataset.price;
                     item.nextElementSibling.innerHTML = price*quantity
                 }
             }
          });
      });

</script>
<script>
    document.getElementById('inc').addEventListener('click',function(){
          const Update_bt=document.getElementById('update');
          Update_bt.removeAttribute('disabled');
    });
    document.getElementById('dec').addEventListener('click',function(){
          const Update_bt=document.getElementById('update');
          Update_bt.removeAttribute('disabled');
    });
</script>
@endsection
