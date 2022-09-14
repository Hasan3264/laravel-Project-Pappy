        @extends('frontend.master')
       @section('content')

       <!-- header_section - end
        ================================================== -->

        <!-- main body - start
        ================================================== -->


           


            <!-- product quick view modal - start
            ================================================== -->

            <!-- product quick view modal - end
            ================================================== -->


            <!-- slider_section - start
            ================================================== -->
            <section class="slider_section">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-9 offset-lg-3">
                            <div class="main_slider" data-slick='{"arrows": false}'>
                                @foreach (App\Models\banner::where('active_status',1)->get() as $banner)
                                    
                                <div class="slider_item set-bg-image" data-background="{{asset('/uploads/banner/')}}/{{$banner->banner_preview}}">
                                    <div class="slider_content">
                                        <h3 class="small_title" data-animation="fadeInUp2" data-delay=".2s">{{$banner->small_title}}</h3>
                                        <h4 class="big_title" data-animation="fadeInUp2" data-delay=".4s">{{$banner->big_title}}  <span>{{$banner->big_title_sub}}</span></h4>
                                        <p data-animation="fadeInUp2" data-delay=".6s">{{$banner->banner_details}}</p>
                                        <div class="item_price" data-animation="fadeInUp2" data-delay=".6s">
                                            <del>{{$banner->price}}</del>
                                            <span class="sale_price">{{$banner->after_discount}}</span>
                                        </div>
                                        <a class="btn btn_primary" href="shop_details.html" data-animation="fadeInUp2" data-delay=".8s">Start Buying</a>
                                    </div>
                                </div>
                                @endforeach
                                {{-- product::latest()->take(4)->get() --}}
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- slider_section - end
            ================================================== -->

            <!-- policy_section - start
            ================================================== -->
            <section class="policy_section">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="policy-wrap">
                                <div class="policy_item">
                                    <div class="item_icon">
                                        <i class="icon icon-Truck"></i>
                                    </div>
                                    <div class="item_content">
                                        <h3 class="item_title">Free Shipping</h3>
                                        <p>
                                            Free shipping on all US order
                                        </p>
                                    </div>
                                </div>

                                <div class="policy_item">
                                    <div class="item_icon">
                                        <i class="icon icon-Headset"></i>
                                    </div>
                                    <div class="item_content">
                                        <h3 class="item_title">Support 24/ 7</h3>
                                        <p>
                                            Contact us 24 hours a day
                                        </p>
                                    </div>
                                </div>

                                <div class="policy_item">
                                    <div class="item_icon">
                                        <i class="icon icon-Wallet"></i>
                                    </div>
                                    <div class="item_content">
                                        <h3 class="item_title">100% Money Back</h3>
                                        <p>
                                            You have 30 days to Return
                                        </p>
                                    </div>
                                </div>

                                <div class="policy_item">
                                    <div class="item_icon">
                                        <i class="icon icon-Starship"></i>
                                    </div>
                                    <div class="item_content">
                                        <h3 class="item_title">90 Days Return</h3>
                                        <p>
                                            If goods have problems
                                        </p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </section>
            <!-- policy_section - end
            ================================================== -->


            <!-- products-with-sidebar-section - start
            ================================================== -->
            <section class="products-with-sidebar-section">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-9 order-lg-3">
                            <div class="best-selling-products">
                                <div class="sec-title-link">
                                    <h3>latest Product</h3>
                                    <div class="view-all"><a href="{{route('shop.in')}}">View all<i class="fal fa-long-arrow-right"></i></a></div>
                                </div>
                                <div class="product-area row clearfix">
                                    @foreach ($latest as $product)
                                    <div class="grid col-lg-3 mt-2"style="mergin-left:10px;">
                                        <div class="product-pic">
                                            <img src="{{asset('/uploads/product/preview')}}/{{$product->Product_preview}}" alt>
                                            @if ($product->discount)
                                                <span class="theme-badge-2">{{ $product->discount}}%off</span>    
                                            @endif
                                            <div class="actions">
                                                <ul>
                                                    @auth('customerlogin')
                                                    <li><a href="{{route('wishlist.insert', $product->id)}}"><svg role="img" xmlns="http://www.w3.org/2000/svg" width="48px" height="48px" viewBox="0 0 24 24"  stroke="#2329D6" stroke-width="1" stroke-linecap="square" stroke-linejoin="miter" fill="none" color="#2329D6"> <title>Favourite</title> <path d="M12,21 L10.55,19.7051771 C5.4,15.1242507 2,12.1029973 2,8.39509537 C2,5.37384196 4.42,3 7.5,3 C9.24,3 10.91,3.79455041 12,5.05013624 C13.09,3.79455041 14.76,3 16.5,3 C19.58,3 22,5.37384196 22,8.39509537 C22,12.1029973 18.6,15.1242507 13.45,19.7149864 L12,21 Z"/> </svg></a>
                                                        @else 
                                                        <li><a href="{{route('customer.register', $product->id)}}"><svg role="img" xmlns="http://www.w3.org/2000/svg" width="48px" height="48px" viewBox="0 0 24 24"  stroke="#2329D6" stroke-width="1" stroke-linecap="square" stroke-linejoin="miter" fill="none" color="#2329D6"> <title>Favourite</title> <path d="M12,21 L10.55,19.7051771 C5.4,15.1242507 2,12.1029973 2,8.39509537 C2,5.37384196 4.42,3 7.5,3 C9.24,3 10.91,3.79455041 12,5.05013624 C13.09,3.79455041 14.76,3 16.5,3 C19.58,3 22,5.37384196 22,8.39509537 C22,12.1029973 18.6,15.1242507 13.45,19.7149864 L12,21 Z"/> </svg></a></li>
                                                        @endauth
                                                        
                                                    </li>
                                                    <li>
                                                        <a href="#"><svg role="img" xmlns="http://www.w3.org/2000/svg" width="48px" height="48px" viewBox="0 0 24 24"  stroke="#2329D6" stroke-width="1" stroke-linecap="square" stroke-linejoin="miter" fill="none" color="#2329D6"> <title>Shuffle</title> <path d="M21 16.0399H17.7707C15.8164 16.0399 13.9845 14.9697 12.8611 13.1716L10.7973 9.86831C9.67384 8.07022 7.84196 7 5.88762 7L3 7"/> <path d="M21 7H17.7707C15.8164 7 13.9845 8.18388 12.8611 10.1729L10.7973 13.8271C9.67384 15.8161 7.84196 17 5.88762 17L3 17"/> <path d="M19 4L22 7L19 10"/> <path d="M19 13L22 16L19 19"/> </svg></a>
                                                    </li>
                                                    <li>
                                                        <a class="quickview_btn" data-bs-toggle="modal" href="#quickview_popup{{$product->id}}" role="button" tabindex="0"><svg width="48px" height="48px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" stroke="#2329D6" stroke-width="1" stroke-linecap="square" stroke-linejoin="miter" fill="none" color="#2329D6"> <title>Visible (eye)</title> <path d="M22 12C22 12 19 18 12 18C5 18 2 12 2 12C2 12 5 6 12 6C19 6 22 12 22 12Z"/> <circle cx="12" cy="12" r="3"/> </svg></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="details">
                                            <h4><a href="{{ route('Product.details', $product->id) }}">{{$product->product_name}}</a></h4>
                                            <p><a href="{{ route('Product.details', $product->id) }}">{{$product->short_des}} </a></p>
                                            @if (App\Models\OrderProduct::where('product_id',$product->id)->whereNotNull('review')->whereNotNull('star')->exists())
                                           
                                            @php
                                                $ahs= round((App\Models\OrderProduct::where('product_id',$product->id)->whereNotNull('review')->sum('star'))/(App\Models\OrderProduct::where('product_id',$product->id)->whereNotNull('review')->count())) 
                                            @endphp
                                              <div class="rating">
                                                @for ($i=0;$i<$ahs; $i++)
                                                <i class="fas fa-star"></i>
                                                @endfor
                                            </div>
                                            @else
                                                <h6 class="text-orenge">No-review</h6>
                                            @endif
                                            
                                            <span class="price">
                                                <ins>
                                                    <span class="woocommerce-Price-amount amount">
                                                        <bdi>
                                                            <span class="woocommerce-Price-currencySymbol">Tk</span>{{$product->after_discount}}
                                                        </bdi>
                                                    </span>
                                                </ins>
                                            </span>
                                            <div class="add-cart-area">
                                                
                                            </div>
                                        </div>
                                    </div>
                                    {{-- ========================== Product Quiq View --}}
                                         <div class="modal fade" id="quickview_popup{{$product->id}}"               aria-hidden="true"aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
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
                                                                                <img src="{{asset('uploads/product/preview')}}/{{$product->Product_preview}}" alt>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-lg-6">
                                                            <div class="product_details_content">
                                                                <h2 class="item_title">{{$product->product_name}}</h2>
                                                                <p>{!!$product->long_des!!}</p>
                                                                <div class="item_price">
                                                                    <span  id="price">{{$product->after_discount}}</span>
                                                                    <del>{{$product->product_price}}</del>
                                                                </div>
                                                                @if (App\Models\OrderProduct::where('product_id', $product->id)->whereNotNull('review')->whereNotNull('star')->exists())
                                                                    
                                                                @foreach ($reviews as $review)      
                                                                <div class="item_review">
                                                                    <ul class="rating_star ul_li">
                                                                                     @for ($i=0;$i<$review->star; $i++) <li><i class="fas fa-star"></i></li>
                                                                                     @endfor </ul>
                                                                               
                                                                </div>
                                                                @endforeach
                                                                @else
                                                                <h4 class="mt-2">No Review</h4>
                                                                
                                                                @endif
                                                                <span class="review_value">{{$total_star}}Rating(s)</span>  

                                                                <hr>

                                                                <div class="item_attribute">
                                                                    <form action="{{ route('cart.insert') }}" method="POST">
                                                                        @csrf
                                                                        <div class="row">
                                                                            <div class="col col-md-6">
                                                                                <input type="hidden" name="product_id" value="{{ $product->id }}" class="form-control">
                                                                                <div class="select_option clearfix">
                                                                                    <h4 class="input_title">Color *</h4>
                                                                                    <select data-id="{{$product->id}}" id="color" name="color_id" class="form-control color_select">
                                                                                        <option data-display="- Please select -">Choose A Option</option>
                                                                                        @foreach (App\Models\Inventory::where('product_id',
                                                                                        $product->id)->groupBy('color_id')->selectRaw('count(*) as total,
                                                                                        color_id')->get() as $color)
                                                                                        <option value="{{ $color->color_id }}">
                                                                                            {{ $color->relation_color->color_name }}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                                    <div class="col col-md-6">
                                                                                        <div class="select_option clearfix">
                                                                                            <h4 class="input_title">Size *</h4>
                                                                                            <select id="size{{$product->id}}" name="size_id" class="form-control">
                                                                                                <option>Choose A Option</option>
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
                                                                        <div class="total_price">Total: <span id="Total_p">{{ $product->after_discount }}</span>
                                                                        </div>
                                                                    </div>

                                                                    <ul class="default_btns_group ul_li">
                                                                        @auth('customerlogin')
                                                                        <li><button class="btn btn_primary addtocart_btn" type="submit">Add To Cart</button></li>
                                                                        @else
                    
                                                                        <li><a href="{{ route('customer.register')}}" class="btn btn_primary addtocart_btn" type="submit">Add To Cart</a></li>
                                                                    @endauth
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
                                    {{-- ========================== Product Quiq View --}}
                                    @endforeach
                                </div>
                            </div>

                            <div class="top_category_wrap">
                                <div class="sec-title-link">
                                    <h3>Top categories</h3>
                                </div>
                                <div class="top_category_carousel2" data-slick='{"dots": false}'>
                                    @foreach ($all_category as $category)

                                    <div class="slider_item">
                                        <div class="category_boxed">
                                            <a href="#!">
                                                  <span class="item_image">
                                                      <img src="{{asset('/frontend/images/categories/category_1.png')}}" alt="image_not_found">
                                                  </span>
                                                <span class="item_title">{{$category->category_name}}</span>
                                            </a>
                                        </div>
                                    </div>
                                    @endforeach




                                </div>
                                <div class="carousel_nav carousel-nav-top-right">
                                    <button type="button" class="tc_left_arrow"><i class="fal fa-long-arrow-alt-left"></i></button>
                                    <button type="button" class="tc_right_arrow"><i class="fal fa-long-arrow-alt-right"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 order-lg-9">
                            <div class="product-sidebar">
                                <div class="widget latest_product_carousel">
                                    <div class="title_wrap">
                                        <h3 class="area_title">Best selling</h3>
                                        <div class="carousel_nav">
                                            <button type="button" class="vs4i_left_arrow"><i class="fal fa-angle-left"></i></button>
                                            <button type="button" class="vs4i_right_arrow"><i class="fal fa-angle-right"></i></button>
                                        </div>
                                    </div>
                                    <div class="vertical_slider_4item" data-slick='{"dots": false}'>
                                        @foreach ($bestselling as $bestsell)
                                            
                                        <div class="slider_item">
                                            <div class="small_product_layout">
                                                <a class="item_image" href="shop_details.html">
                                                    <img src="{{asset('uploads/product/preview')}}/{{$bestsell->relation_product->Product_preview}}" alt="image_not_found">
                                                </a>
                                                <div class="item_content">
                                                    <h3 class="item_title">
                                                        <a href="shop_details.html">{{$bestsell->relation_product->product_name}}</a>
                                                    </h3>
                                                    @if (App\Models\OrderProduct::where('product_id',$bestsell->product_id)->whereNotNull('review')->whereNotNull('star')->exists())
                                                    @php
                                                        $ahs= (App\Models\OrderProduct::where('product_id',$bestsell->product_id)->whereNotNull('review')->sum('star'))/(App\Models\OrderProduct::where('product_id',$bestsell->product_id)->whereNotNull('review')->count())
                                                    @endphp
                                                      <ul class="rating_star ul_li_center">
                                                        @for ($i=0;$i<$ahs; $i++)
                                                        <li><i class="fas fa-star"></i></li>
                                                      @endfor
                                                      </ul>
                                                    @else
                                                        <h6 class="text-orenge">No-review</h6>
                                                    @endif
                                                    <div class="item_price">
                                                        <span>{{$bestsell->relation_product->after_discount}}</span>
                                                        <del>{{$bestsell->relation_product->product_price}}</del>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach

                                       
                                    </div>
                                </div>
                                <div class="widget product-add">
                                    @foreach ($get_quick as $quick)
                                    <div class="product-img">
                                        <img src="{{asset('uploads/quick1')}}/{{$quick->product_preview}}" alt>
                                    </div>
                                    <div class="details">
                                        <h4>{{$quick->product_title}}</h4>
                                        <p>{{$quick->product_det}}</p>  
                                        @endforeach
                                        <a class="btn btn_primary" href="#" >Start Buying</a>
                                    </div>
                                </div>
                                @foreach (App\Models\audio::all() as $Quick2)   
                                <div class="widget audio-widget" style="background: url({{asset('uploads/quick2/')}}/{{$Quick2->audio_photo}}) center center/cover no-repeat ">
                                    <h5>{{$Quick2->name}}<span>5</span></h5>
                                    @endforeach
                                    <ul>
                                        @foreach (App\Models\audio_list::all() as $lists)
                                       
                                       <li><a href="#">{{$lists->audio_list}}</a></li>
                                       @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- end container  -->
            </section>
            <!-- products-with-sidebar-section - end
            ================================================== -->


            <!-- promotion_section - start
            ================================================== -->
            <section class="promotion_section">
                <div class="container">
                    <div class="row promotion_banner_wrap">
                        @foreach ($promotions as $promotion)
                            
                        <div class="col col-lg-6">
                            <div class="promotion_banner">
                                <div class="item_image">
                                    <img src="{{asset('/uploads/promotion/')}}/{{$promotion->promotion_preview}}" alt>
                                </div>
                                <div class="item_content">
                                    <h3 class="item_title">{{$promotion->promotion_title}} <span>{{$promotion->promotion_subtitle}}</span></h3>
                                    <p>{{$promotion->promotion_det}}</p>
                                    <a class="btn btn_primary" href="shop_details.html">Shop Now</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </section>
            <!-- promotion_section - end
            ================================================== -->

            <!-- new_arrivals_section - start
            ================================================== -->
            <section class="new_arrivals_section section_space">
                <div class="container">
                    <div class="sec-title-link">
                        <h3>New Arrivals</h3>
                    </div>

                    <div class="row newarrivals_products">
                        <div class="col col-lg-5">
                            @foreach (App\Models\ArivalBannr::where('active_status',1)->get() as $arival_baner)
                                
                            <div class="deals_product_layout1">
                                <div class="bg_area" style="background: url({{asset('/uploads/arivalbanner')}}/{{$arival_baner->photo}}) center center/cover no-repeat local;">
                                    <h3 class="item_title">{{$arival_baner->title1}} <span>{{$arival_baner->title2}}</span> {{$arival_baner->title3}}</h3>
                                    <p>
                                        {{$arival_baner->details}}
                                    </p>
                                    <a class="btn btn_primary" href="shop_details.html">Shop Now</a>
                                </div>
                            </div>
                        @endforeach
                        </div>

                        <div class="col col-lg-7">
                            <div class="new-arrivals-grids row clearfix">
                                @foreach ($New_arivel as $arivel)
                                <div class="grid">
                                    <div class="product-pic">
                                        <img src="{{asset('/uploads/product/preview')}}/{{ $arivel->Product_preview}}" alt>
                                        @if ($arivel->discount)
                                        <span class="theme-badge-2">{{ $arivel->discount}}% off</span>    
                                        @endif
                                        <div class="actions">
                                            <ul>
                                                <li>
                                                    <a href="#"><svg role="img" xmlns="http://www.w3.org/2000/svg" width="48px" height="48px" viewBox="0 0 24 24" stroke="#2329D6" stroke-width="1" stroke-linecap="square" stroke-linejoin="miter" fill="none" color="#2329D6"> <title>Favourite</title> <path d="M12,21 L10.55,19.7051771 C5.4,15.1242507 2,12.1029973 2,8.39509537 C2,5.37384196 4.42,3 7.5,3 C9.24,3 10.91,3.79455041 12,5.05013624 C13.09,3.79455041 14.76,3 16.5,3 C19.58,3 22,5.37384196 22,8.39509537 C22,12.1029973 18.6,15.1242507 13.45,19.7149864 L12,21 Z"/> </svg></a>
                                                </li>
                                                <li>
                                                    <a href="#"><svg role="img" xmlns="http://www.w3.org/2000/svg" width="48px" height="48px" viewBox="0 0 24 24" stroke="#2329D6" stroke-width="1" stroke-linecap="square" stroke-linejoin="miter" fill="none" color="#2329D6"> <title>Shuffle</title> <path d="M21 16.0399H17.7707C15.8164 16.0399 13.9845 14.9697 12.8611 13.1716L10.7973 9.86831C9.67384 8.07022 7.84196 7 5.88762 7L3 7"/> <path d="M21 7H17.7707C15.8164 7 13.9845 8.18388 12.8611 10.1729L10.7973 13.8271C9.67384 15.8161 7.84196 17 5.88762 17L3 17"/> <path d="M19 4L22 7L19 10"/> <path d="M19 13L22 16L19 19"/> </svg></a>
                                                </li>
                                                <li>
                                                    <a class="quickview_btn" data-bs-toggle="modal" href="#arivel_popup{{$arivel->id}}" href="#"><svg width="48px" height="48px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" stroke="#2329D6" stroke-width="1" stroke-linecap="square" stroke-linejoin="miter" fill="none" color="#2329D6"> <title>Visible (eye)</title> <path d="M22 12C22 12 19 18 12 18C5 18 2 12 2 12C2 12 5 6 12 6C19 6 22 12 22 12Z"/> <circle cx="12" cy="12" r="3"/> </svg></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="details">
                                        <h4><a href="#">{{ $arivel->product_name }}</a></h4>
                                        <p><a href="#">{{ $arivel->short_des }}</a></p>
                                        <span class="price">
                                            <ins>
                                                <span class="woocommerce-Price-amount amount">
                                                    <bdi>
                                                        <span class="woocommerce-Price-currencySymbol">Tk</span>{{ $arivel->after_discount }}
                                                    </bdi>
                                                </span>
                                            </ins>
                                        </span>
                                        <div class="add-cart-area">
                                            @auth('customerlogin')
                                            <li><button class="btn btn_primary addtocart_btn" type="submit">Add To Cart</button></li>
                                            @else

                                            <li><a href="{{ route('customer.register')}}" class="btn btn_primary addtocart_btn" type="submit">Add To Cart</a></li>
                                        @endauth
                                        </div>
                                    </div>
                                </div>

                                {{-- model --}}
                                <div class="modal fade" id="arivel_popup{{$arivel->id}}"               aria-hidden="true"aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
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
                                                            <div class="col col-lg-6 ">
                                                                <div class="product_details_image p-0">
                                                                    <img src="{{asset('uploads/product/preview')}}/{{$arivel->Product_preview}}" alt>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-6">
                                                <div class="product_details_content">
                                                    <h2 class="item_title">{{ $arivel->Product_name }}</h2>
                                                    <p>{{ $arivel->short_des }}</p>
                                                        @if (App\Models\OrderProduct::where('product_id',$arivel->id)->whereNotNull('review')->whereNotNull('star')->exists())
                                           
                                                        @php
                                                            $ahs= round((App\Models\OrderProduct::where('product_id',$arivel->id)->whereNotNull('review')->sum('star'))/(App\Models\OrderProduct::where('product_id',$arivel->id)->whereNotNull('review')->count())) 
                                                        @endphp
                                                          <div class="item_review">
                                                            <ul class="rating_star ul_li">
                                                            @for ($i=0;$i<$ahs; $i++)
                                                            <i class="fas fa-star"></i>
                                                            @endfor
                                                        </ul>
                                                        </div>
                                                        @else
                                                            <h6 class="text-orenge">No-review</h6>
                                                        @endif
                                                        

                                                    <div class="item_price">
                                                        <span id="price{{$arivel->id}}">{{$arivel->after_discount}}</span>
                                                        <del>{{$arivel->product_price}}</del>
                                                    </div>
                                                    <hr>

                                                    <div class="item_attribute">
                                                        <form action="#">
                                                            <div class="row">
                                                                <div class="col col-md-5" style="margin-left:8px;">
                                                                    <div class="select_option clearfix">
                                                                        <h4 class="input_title">Color *</h4>
                                                                        <select data-id="{{$arivel->id}}"  name="color_id" class="form-control color_sed">   
                                                                            <option>Choose A Option</option>
                                                                            @foreach (App\Models\Inventory::where('product_id',
                                                                            $arivel->id)->groupBy('color_id')->selectRaw('count(*) as total,
                                                                            color_id')->get() as $color)
                                                                            <option value="{{ $color->color_id }}">
                                                                                {{ $color->relation_color->color_name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col col-md-5">
                                                                    <div class="select_option clearfix">
                                                                        <h4 class="input_title">Size *</h4>
                                                                        <select id="sizes{{$arivel->id}}" name="size_id" class="form-control">
                                                                            <option value="">Choose A Option</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="quantity_wrap">
                                                            <div class="quantity_input">
                                                                <button type="button" class="input_number_decrement"  Data_pro_id="{{$arivel->id}}">
                                                                    <i class="fal fa-minus"></i>
                                                                </button>
                                                                <input class="input_number{{$arivel->id}}" type="text" value="1" name="quantity">
                                                                <button type="button" class="input_number_increment" Data_pro_id="{{$arivel->id}}">
                                                                    <i class="fal fa-plus"></i>
                                                                </button>
                                                            </div>
                                                            <div class="total_price">Total: <span id="Total_p{{$arivel->id}}">{{ $arivel->after_discount }}</span>
                                                            </div>
                                                        </div>

                                                        <ul class="default_btns_group ul_li">
                                                            @auth('customerlogin')
                                                                        <li><button class="btn btn_primary addtocart_btn" type="submit">Add To Cart</button></li>
                                                                        @else
                    
                                                                        <li><a href="{{ route('customer.register')}}" class="btn btn_primary addtocart_btn" type="submit">Add To Cart</a></li>
                                                         @endauth
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
                                {{-- model --}}
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- new_arrivals_section - end
            ================================================== -->

            <!-- brand_section - start
            ================================================== -->
            <div class="brand_section pb-0">
                <div class="container">
                    <div class="brand_carousel">
                        @foreach ($get_brands as $brand)
                        <div class="slider_item">
                            <a class="product_brand_logo" href="#!">
                                <img src="{{asset('/uploads/brandsection')}}/{{$brand->img_name}}" alt="image_not_found">
                                <img src="{{asset('/uploads/brandsection')}}/{{$brand->img_name}}" alt="image_not_found">
                            </a>
                        </div>
                        @endforeach
                        
                    </div>
                </div>
            </div>
            <!-- brand_section - end
            ================================================== -->

            <!-- viewed_products_section - start
            ================================================== -->
            <section class="viewed_products_section section_space">
                <div class="container">

                    <div class="sec-title-link mb-0">
                        <h3>Recently Viewed Products</h3>
                    </div>

                    <div class="viewed_products_wrap arrows_topright">
                        <div class="viewed_products_carousel row" data-slick='{"dots": false}'>
                            @foreach ($all_recent_product as $recent_viewd)
                            <div class="slider_item col">
                                <div class="viewed_product_item">
                                    <div class="item_image">
                                        <img src="{{asset('/uploads/product/preview')}}/{{$recent_viewd->Product_preview}}" alt="image_not_found">
                                    </div>
                                    <div class="item_content">
                                        <h3 class="item_title">{{$recent_viewd->product_name}}</h3>
                                        <h3 class="item_title" style="font-size: 12px; font-wight:100;">{{$recent_viewd->short_des}}</h3>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="carousel_nav">
                            <button type="button" class="vpc_left_arrow"><i class="fal fa-long-arrow-alt-left"></i></button>
                            <button type="button" class="vpc_right_arrow"><i class="fal fa-long-arrow-alt-right"></i></button>
                        </div>
                    </div>
                </div>
            </section>
            <!-- viewed_products_section - end
            ================================================== -->

            <!-- newsletter_section - start
            ================================================== -->
            <section class="newsletter_section">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col col-lg-6">
                            <h2 class="newsletter_title text-white">Sign Up for Newsletter </h2>
                            <p>Get E-mail updates about our latest products and special offers.</p>
                        </div>
                        <div class="col col-lg-6">
                            <form action="#!">
                                <div class="newsletter_form">
                                    <input type="email" name="email" placeholder="Enter your email address">
                                    <button type="submit" class="btn btn_secondary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
            <!-- newsletter_section - end
            ================================================== -->

       @endsection

    @section('javascrift')
    <script>
        $('.color_sed').change(function () {
        var color_id = $(this).val();
        var product_id = $(this).attr('data-id');
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: '/getsizes',
            data: {
                'color_id': color_id,
                'product_id': product_id
            },
            success: function (data) {
                $('#sizes'+product_id).html(data);
            }
        });
    });
 </script>


       <script>
        $('.color_select').change(function () {
        var color_id = $(this).val();
        var product_id = $(this).attr('data-id');
        
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
                $('#size'+product_id).html(data);
            }
        });
    });
       </script>
       <script>
        //    var quantity = $('.input_number').val();
        //    $('.input_number_decrement').click(function () {
        //        if (quantity > 1) {
        //            quantity--
        //        }
        //        $('.input_number').val(quantity);
        //        var price = $('#price').html();
        //        var total = price * quantity;
        //        $('#Total_p').html(total);
        //    });
    $('.input_number_increment').click(function () {
        var product_id= $(this).attr('Data_pro_id')
        var quantity= $('.input_number'+product_id).val()
         quantity++
         
         $('.input_number'+product_id).val(quantity);
         var price = $('#price'+product_id).html();
         var total = price * quantity;
         $('#Total_p'+product_id).html(total);
    });
    $('.input_number_decrement').click(function () {
        var product_id= $(this).attr('Data_pro_id')
        var quantity= $('.input_number'+product_id).val()
        if (quantity > 1) {
                   quantity--
               }
         $('.input_number'+product_id).val(quantity);
         var price = $('#price'+product_id).html();
         var total = price * quantity;
         $('#Total_p'+product_id).html(total);
    });
    //Increment decrement endmai
</script>
   
           <script>
           $('#search_btn').click(function () {
            var search_input = $('#search_input').val();
            var category_id = $('#category_id :selected').val();
            var color_id = $('#color_id :selected').val();
            var Size_id = $('#Size_id :selected').val();
            var amount = $('#amount :selected').val();
            var link = "{{route('shop.in')}}"+"?q="+search_input+"&category_id="+category_id+"&color_id="+color_id+"&Size_id="+Size_id+"&amount="+amount;
           window.location.href = link;
        });
        $('#category_id').change(function () {
            var search_input = $('#search_input').val();
            var category_id = $('#category_id').val();
            var color_id = $('#color_id :selected').val();
            var Size_id = $('#Size_id :selected').val();
            var amount = $('#amount :selected').val();
            var link = "{{route('shop.in')}}"+"?q="+search_input+"&category_id="+category_id+"&color_id="+color_id+"&Size_id="+Size_id+"&amount="+amount;
           window.location.href = link;
        });
        </script>
     @endsection
