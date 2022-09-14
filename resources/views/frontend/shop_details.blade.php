@extends('frontend.master')

@section('content')
<style>

</style>


<!-- product quick view modal - start
================================================== -->
<div class="modal fade" id="quickview_popup" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2"
    tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalToggleLabel2">Product Quick View</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="product_details">
                    <div class="container">
                        <div class="row">
                            <div class="col col-lg-6">
                                <div class="product_details_image p-0">
                                    <img src="assets/images/shop/product_img_12.png" alt>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="product_details_content">
                                    <h2 class="item_title">CURREN 8109 Watches</h2>
                                    <p>It is a long established fact that a reader will be distracted eget velit. Donec
                                        ac tempus ante. Fusce ultricies massa massa. Fusce aliquam, purus eget sagittis
                                        vulputate</p>
                                    <div class="item_review">
                                        <ul class="rating_star ul_li">
                                            <li><i class="fas fa-star"></i>></li>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star-half-alt"></i></li>
                                        </ul>
                                        <span class="review_value">3 Rating(s)</span>
                                    </div>

                                    <div class="item_price">
                                        <span>$620.00</span>
                                        <del>$720.00</del>
                                    </div>
                                    <hr>

                                    <div class="item_attribute">
                                        <form action="#">
                                            <div class="row">
                                                <div class="col col-md-6">
                                                    <div class="select_option clearfix">
                                                        <h4 class="input_title">Size *</h4>
                                                        <select>
                                                            <option data-display="- Please select -">Choose A Option
                                                            </option>
                                                            <option value="1">Some option</option>
                                                            <option value="2">Another option</option>
                                                            <option value="3" disabled>A disabled option</option>
                                                            <option value="4">Potato</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col col-md-6">
                                                    <div class="select_option clearfix">
                                                        <h4 class="input_title">Color *</h4>
                                                        <select>
                                                            <option data-display="- Please select -">Choose A Option
                                                            </option>
                                                            <option value="1">Some option</option>
                                                            <option value="2">Another option</option>
                                                            <option value="3" disabled>A disabled option</option>
                                                            <option value="4">Potato</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>

                                    <div class="quantity_wrap">
                                        <div class="quantity_input">
                                            <button type="button" class="input_number_decrement">
                                                <i class="fal fa-minus"></i>
                                            </button>
                                            <input class="input_number" type="text" value="1">
                                            <button type="button" class="input_number_increment">
                                                <i class="fal fa-plus"></i>
                                            </button>
                                        </div>
                                        <div class="total_price">Total: $620,99</div>
                                    </div>

                                    <ul class="default_btns_group ul_li">
                                        <li><a class="btn btn_primary addtocart_btn" href="#!">Add To Cart</a></li>
                                    </ul>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- product quick view modal - end
================================================== -->

<!-- breadcrumb_section - start
================================================== -->
<div class="breadcrumb_section">
    <div class="container">
        <ul class="breadcrumb_nav ul_li">
            <li><a href="index.html">Home</a></li>
            <li>Product Details</li>
        </ul>
    </div>
</div>
<!-- breadcrumb_section - end
================================================== -->

<!-- product_details - start
================================================== -->
<section class="product_details section_space pb-0">
    <div class="container">
        <div class="row">
            <div class="col col-lg-6">
                <div class="product_details_image">
                    <div class="details_image_carousel">
                        @foreach (App\Models\thumbnails::where('product_id', $pro_info->id)->get() as $thumb)
                             
                        <div class="slider_item">
                            <img src="{{ asset('/uploads/product/thumbnails')}}/{{ $thumb->thumbnail }}"
                                alt="image_not_found">
                        </div>
                        @endforeach
                    </div>

                    <div class="details_image_carousel_nav">
                        @foreach (App\Models\thumbnails::where('product_id', $pro_info->id)->get() as $thumb)

                        <div class="slider_item">
                            <img src="{{ asset('/uploads/product/thumbnails')}}/{{ $thumb->thumbnail }}"
                                alt="image_not_found">
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
             <form action="{{ route('cart.insert') }}" method="POST">
                 @csrf
                <div class="product_details_content">
                        <h2 class="item_title">{{ $pro_info->product_name }}</h2>
                        <input type="hidden" name="product_id" value="{{ $pro_info->id }}" class="form-control">
                        <p>{{ $pro_info->short_des }}</p>
                        <div class="item_review">
                            @if ($total_reviews == 0 && $total_star == 0)
                            <p class="mb-0">
                                <span>No review</span>
                            </p>  
                            @else
                                
                                @php
                                $avg_star=round($total_star /  $total_reviews);
                                
                            @endphp
                            
                            <ul class="rating_star ul_li">
                                @for ($i=0;$i<$avg_star; $i++)
                                <li><i class="fas fa-star"></i></li>
                                @endfor
                            </ul>
                            <p class="mb-0">
                                  ({{$total_reviews}} review)
                            </p> 
                            @endif
                        </div>

                        <div class="item_price">
                            <span>tk<span id="price">{{ $pro_info->after_discount }}</span></span>
                            <del>{{ $pro_info->product_price }}Tk</del>
                        </div>
                        <hr>

                        <div class="item_attribute">

                            <div class="row">
                                <div class="col col-md-6">
                                    <div class="select_option clearfix">
                                        <h4 class="input_title">Color</h4>
                                        <select id="color" name="color_id" class="form-control">
                                            <option data-display="- Please select -">Choose A Option</option>
                                            @foreach (App\Models\Inventory::where('product_id',
                                            $pro_info->id)->groupBy('color_id')->selectRaw('count(*) as total,
                                            color_id')->get() as $color)
                                            <option value="{{ $color->color_id }}">
                                                {{ $color->relation_color->color_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col col-md-6">
                                    <div class="select_option clearfix">
                                        <h4 class="input_title">Size </h4>
                                        <select id="size" name="size_id" class="form-control">
                                            <option data-display="- Please select -">Choose A Option</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="quantity_wrap">
                            <div class="quantity_input">
                                <button type="button" class="input_number_decrement">
                                    <i class="fal fa-minus"></i>
                                </button>
                                <input class="input_number" type="text" value="1" name="quantity">
                                <button type="button" class="input_number_increment">
                                    <i class="fal fa-plus"></i>
                                </button>
                            </div>
                            <div class="total_price">Total: <span id="Total_p">{{ $pro_info->after_discount }}</span>
                            </div>
                        </div>

                        <ul class="default_btns_group ul_li">
                            @auth('customerlogin')
                            <li class="stock" ><button class="btn btn_primary addtocart_btn" type="submit">Add To Cart</button></li>
                            @else

                            <li><a href="{{ route('customer.register')}}" class="btn btn_primary addtocart_btn" type="submit">Add To Cart</a></li>
                            @endauth
                        </ul>
                </div>
            </form>

            </div>
        </div>

        <div class="details_information_tab">
            <ul class="tabs_nav nav ul_li" role=tablist>
                <li>
                    <button class="active" data-bs-toggle="tab" data-bs-target="#description_tab" type="button"
                        role="tab" aria-controls="description_tab" aria-selected="true">
                        Description
                    </button>
                </li>
                <li>
                    <button data-bs-toggle="tab" data-bs-target="#additional_information_tab" type="button" role="tab"
                        aria-controls="additional_information_tab" aria-selected="false">
                        Additional information
                    </button>
                </li>
                <li>
                    <button data-bs-toggle="tab" data-bs-target="#reviews_tab" type="button" role="tab"
                        aria-controls="reviews_tab" aria-selected="false">
                        Reviews({{ $total_reviews }})
                    </button>
                </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane fade show active" id="description_tab" role="tabpanel">
                    <p>
                        {!!$pro_info->long_des!!}
                    </p>
                </div>

                <div class="tab-pane fade" id="additional_information_tab" role="tabpanel">
                    <p>

                    </p>

                    <div class="additional_info_list">
                        <h4 class="info_title">Additional Info</h4>
                        <ul class="ul_li_block">
                            <li>No Side Effects</li>
                            <li>Made in USA</li>
                        </ul>
                    </div>

                    <div class="additional_info_list">
                        <h4 class="info_title">Product Features Info</h4>
                        <ul class="ul_li_block">
                            <li>Compatible for indoor and outdoor use</li>
                            <li>Wide polypropylene shell seat for unrivalled comfort</li>
                            <li>Rust-resistant frame</li>
                            <li>Durable UV and weather-resistant construction</li>
                            <li>Shell seat features water draining recess</li>
                            <li>Shell and base are stackable for transport</li>
                            <li>Choice of monochrome finishes and colourways</li>
                            <li>Designed by Nagi</li>
                        </ul>
                    </div>
                </div>

                <div class="tab-pane fade" id="reviews_tab" role="tabpanel">
                    <div class="average_area">
                        <div class="row align-items-center">
                            <div class="col-md-12 order-last">
                                <div class="average_rating_text">
                                    
                                @if ($total_reviews == 0 && $total_star == 0)
                                <p class="mb-0">
                                    Average Star Rating: <span>No review</span>
                                </p>  
                                @else
                                    
                                    @php
                                    $avg_star=round($total_star /  $total_reviews);
                                    
                                @endphp
                                
                                <ul class="rating_star ul_li_center">
                                    @for ($i=0;$i<$avg_star; $i++)
                                    <li><i class="fas fa-star"></i></li>
                                    @endfor
                                </ul>
                                <p class="mb-0">
                                    Average Star Rating: <span>{{ $avg_star }} out of 5</span> ({{$total_reviews}} vote)
                                </p> 
                                @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="customer_reviews">
                        <h4 class="reviews_tab_title">{{ $total_reviews }} reviews for this product</h4>
                        @if (App\Models\OrderProduct::where('user_id', Auth::guard('customerlogin')->id())->where('product_id', $pro_info->id)->whereNotNull('review')->whereNotNull('star')->exists())
                           @foreach ($reviews as $review)
                           <div class="customer_review_item clearfix">
                               <div class="customer_image">
                                   <img src="assets/images/team/team_1.jpg" alt="image_not_found">
                               </div>
                               <div class="customer_content">
                                   <div class="customer_info">
                                       <ul class="rating_star ul_li">
                                        @for ($i=0;$i<$review->star; $i++)

                                        <li><i class="fas fa-star"></i></li>
                                        @endfor
                                       </ul>
                                       <h4 class="customer_name">{{ $review->relation_customer->name }}</h4>
                                       <span class="comment_date">{{ $review->updated_at }}</span>
                                   </div>
                                   <p class="mb-0">{{ $review->review }}</p>
                               </div>
                           </div>
                           @endforeach
                           @else
                        @endif
                    </div>
@auth('customerlogin')
@if (App\Models\OrderProduct::where('user_id', Auth::guard('customerlogin')->id())->where('product_id', $pro_info->id)->exists())
@if (App\Models\OrderProduct::where('user_id', Auth::guard('customerlogin')->id())->where('product_id', $pro_info->id)->whereNull('review')->exists())

<div class="customer_review_form">
    <h4 class="reviews_tab_title">Add a review</h4>
    <form action="{{ route('product.review') }}" method="POST">
        @csrf
        <div class="form_item">
            <input type="text" name="name" value="{{Auth::guard('customerlogin')->user()->name}}" placeholder="Your name*">
        </div>
        <div class="form_item">
            <input type="email" name="email" value="{{Auth::guard('customerlogin')->user()->email}}" placeholder="Your Email*">
        </div>
        <div class="your_ratings">
            <h5>Your Ratings:</h5>
            <button type="button" class="star" value="1"><i id="st1" class="fal fa-star  review"></i></button>
            <button type="button" class="star" value="2"><i id="st2" class="fal fa-star review"></i></button>
            <button type="button" class="star" value="3"><i  id="st3" class="fal fa-star review"></i></button>
            <button type="button" class="star" value="4"><i  id="st4" class="fal fa-star review"></i></button>
            <button type="button" class="star" value="5"><i  id="st5" class="fal fa-star review"></i></button>
        </div>
        <input type="hidden" name="star" id="star">
        <input type="hidden" name="product_id" value="{{  $pro_info->id }}">
        <div class="form_item">
            <textarea name="review" placeholder="Your Review*"></textarea>
        </div>
        <button type="submit" class="btn btn_primary">Submit Now</button>
    </form>
</div>
@else
  <span> <a href="#">View your Review</a>
  </span>
@endif
@else
<span> Plase Bay This Product and Use This Then Give a review</span>
@endif
@endauth
                </div>
            </div>
        </div>
    </div>
</section>
<!-- product_details - end
================================================== -->

<!-- related_products_section - start
================================================== -->
<section class="related_products_section section_space">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="best-selling-products related-product-area">
                    <div class="sec-title-link">
                        <h3>Related products</h3>
                        <div class="view-all"><a href="#">View all<i class="fal fa-long-arrow-right"></i></a></div>
                    </div>
                    <div class="product-area clearfix">
                 @forelse ($related_product as $rel_product)

                        <div class="grid">
                            <div class="product-pic">
                                <img src="{{ asset('uploads/product/preview')}}/{{ $rel_product->Product_preview }}"
                                    alt>
                                <div class="actions">
                                    <ul>
                                        <li>
                                            <a href="#"><svg role="img" xmlns="http://www.w3.org/2000/svg" width="48px"
                                                    height="48px" viewBox="0 0 24 24" stroke="#2329D6" stroke-width="1"
                                                    stroke-linecap="square" stroke-linejoin="miter" fill="none"
                                                    color="#2329D6">
                                                    <title>Favourite</title>
                                                    <path
                                                        d="M12,21 L10.55,19.7051771 C5.4,15.1242507 2,12.1029973 2,8.39509537 C2,5.37384196 4.42,3 7.5,3 C9.24,3 10.91,3.79455041 12,5.05013624 C13.09,3.79455041 14.76,3 16.5,3 C19.58,3 22,5.37384196 22,8.39509537 C22,12.1029973 18.6,15.1242507 13.45,19.7149864 L12,21 Z" />
                                                </svg></a>
                                        </li>
                                        <li>
                                            <a href="#"><svg role="img" xmlns="http://www.w3.org/2000/svg" width="48px"
                                                    height="48px" viewBox="0 0 24 24" stroke="#2329D6" stroke-width="1"
                                                    stroke-linecap="square" stroke-linejoin="miter" fill="none"
                                                    color="#2329D6">
                                                    <title>Shuffle</title>
                                                    <path
                                                        d="M21 16.0399H17.7707C15.8164 16.0399 13.9845 14.9697 12.8611 13.1716L10.7973 9.86831C9.67384 8.07022 7.84196 7 5.88762 7L3 7" />
                                                    <path
                                                        d="M21 7H17.7707C15.8164 7 13.9845 8.18388 12.8611 10.1729L10.7973 13.8271C9.67384 15.8161 7.84196 17 5.88762 17L3 17" />
                                                    <path d="M19 4L22 7L19 10" />
                                                    <path d="M19 13L22 16L19 19" />
                                                </svg></a>
                                        </li>
                                        <li>
                                            <a class="quickview_btn" data-bs-toggle="modal" href="#quickview_popup"
                                                role="button" tabindex="0"><svg width="48px" height="48px"
                                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                                    stroke="#2329D6" stroke-width="1" stroke-linecap="square"
                                                    stroke-linejoin="miter" fill="none" color="#2329D6">
                                                    <title>Visible (eye)</title>
                                                    <path
                                                        d="M22 12C22 12 19 18 12 18C5 18 2 12 2 12C2 12 5 6 12 6C19 6 22 12 22 12Z" />
                                                    <circle cx="12" cy="12" r="3" />
                                                </svg></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="details">
                                <h4><a href="#">{{ $rel_product->Product_name }}</a></h4>
                                <p><a href="#">{{ $rel_product->short_des }} </a></p>
                                <div class="rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                                <span class="price">
                                    <ins>
                                        <span class="woocommerce-Price-amount amount">
                                            <bdi>
                                                <span
                                                    class="woocommerce-Price-currencySymbol">Tk</span>{{ $rel_product->after_discount }}
                                            </bdi>
                                        </span>
                                    </ins>
                                </span>
                                <div class="add-cart-area">
                                    <button class="add-to-cart">Add to cart</button>
                                </div>
                            </div>
                        </div>
                        @empty
                        <h3>No Related Products </h3>
                        @endempty
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- related_products_section - end
================================================== -->


@endsection
@section('javascrift')
//click star
    <script>

          $('#st1').click(function() {
              $(".review").css("font-weight", "100");
              $("#st1").css("font-weight", "900");

          });
          $("#st2").click(function() {
              $(".review").css("font-weight", "100");
              $("#st1, #st2").css("font-weight", "900");

          });
          $("#st3").click(function() {
              $(".review").css("font-weight", "100")
              $("#st1, #st2, #st3").css("font-weight", "900");

          });
          $("#st4").click(function() {
              $(".review").css("font-weight", "100");
              $("#st1, #st2, #st3, #st4").css("font-weight", "900");

          });
          $("#st5").click(function() {
              $(".review").css("font-weight", "100");
              $("#st1, #st2, #st3, #st4, #st5").css("font-weight", "900");

          });
    </script>
//click star

//star
<script>
    $('.star').click(function(){
       let star= $(this).attr('value');
       $('#star').attr('value', star);
    });
</script>
<script>
    var quantity = $('.input_number').val();
    $('.input_number_increment').click(function () {
        quantity++
        $('.input_number').val(quantity);
        var price = $('#price').html();
        var total = price * quantity;
        $('#Total_p').html(total);
    });
    $('.input_number_decrement').click(function () {
        if (quantity > 1) {
            quantity--
        }
        $('.input_number').val(quantity);
        var price = $('#price').html();
        var total = price * quantity;
        $('#Total_p').html(total);
    });
    //Increment decrement endmai
    $('#color').change(function () {
        var color_id = $(this).val();
        var product_id = '{{$pro_info->id}}';
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: '/getsize',
            data: {
                'color_id': color_id,
                'product_id': product_id
            },
            success: function (data) {
                $('#size').html(data);
            }
        });
    });

</script>
   <script>
    $('#size').change(function () {
         var size_id = $(this).val();
         var color_id = $('.clr_id').val();
         var product_id = '{{$pro_info->id}}';
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: '/stockout',
            data: {
                'size_id': size_id,
                'color_id': color_id,
                'product_id': product_id
            },
            success: function (data) {
                 $('.stock').html(data);
            }
        });
    });
   </script>
@endsection
@section('javascrift')




//alert start
@if(session('added'))
   <script>
        const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.addEventListener('mouseenter', Swal.stopTimer)
          toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
      })

      Toast.fire({
        icon: 'success',
        title: '{{ session('added') }}',
  })
   </script>
 @endif

@endsection
