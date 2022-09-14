<div class="container mt-5 mb-5">
    <div class="row d-flex justify-content-center">

        <div class="col-md-8">
            <div class="card">
                <div class="text-left logo p-2 px-5"> <img src="" width="50"> </div>
                <div class="invoice p-5">
                    <h5>Your order Confirmed!</h5>
                    <span class="font-weight-bold d-block mt-4">{{ App\Models\BillingDetails::where('order_id', $order_id)->first()->name}}</span>
                    <span class="font-weight-bold d-block mt-4">{{ App\Models\BillingDetails::where('order_id', $order_id)->first()->email}}</span>
                    <span>You order has been confirmed and will be shipped in next two days!</span>
                    <div class="payment border-top mt-3 mb-3 border-bottom table-responsive">
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="py-2"> <span class="d-block text-muted"></span>
                                             Order Date:
                                             <br>
                                            <span>{{ App\Models\Order::where('id', $order_id)->first()->created_at}}</span> </div>
                                    </td>
                                    <br/>
                                    <td>
                                        <div class="py-2"> <span class="d-block text-muted">Order No:</span>
                                            <br>
                                            <span>{{ $order_id }}</span> </div>
                                    </td>
                                    <br/>
                                    <td>
                                        <div class="py-2"> <span class="d-block text-muted">Payment</span>
                                            <br>
                                            <span>
                                                    @php
                                                        if(App\Models\Order::where('id', $order_id)->first()->delevary_type == 'Cash'){
                                                              echo 'Cash on Delevary';
                                                        }
                                                        elseif (App\Models\Order::where('id', $order_id)->first()->delevary_type == 'ssl') {
                                                            echo 'Online Payment';
                                                        }
                                                        else {
                                                            echo 'PayPal';
                                                        }
                                                    @endphp
                                                </span> </div>
                                    </td>
                                    <br/>
                                    <td>
                                        <div class="py-2"> <span class="d-block text-muted">Shiping Address</span>
                                            <br>
                                            <span>{{ App\Models\BillingDetails::where('order_id', $order_id)->first()->address}}</span> </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="product border-bottom table-responsive">
                        <table class="table table-borderless">
                            <tbody>
                                @foreach (App\Models\OrderProduct::where('order_id', $order_id)->get() as $key => $product)
                                <tr>
                                    <td width="20%"> <img src="{{ asset('/uploads/product/preview')}}/{{$product->relation_product->Product_preview }}" width="90"> </td>
                                    <td width="60%"> <span class="font-weight-bold">{{ $product->relation_product->product_name }}</span>
                                        <div class="product-qty"> <span class="d-block">Quantity:{{ $product->quentity }}</span>
                                            <span>Color:Dark</span> </div>
                                    </td>
                                    <td width="20%">
                                        <div class="text-right"> <span class="font-weight-bold">{{ $product->after_discount *  $product->quentity }}</span> </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row d-flex justify-content-end">
                        <div class="col-md-5">
                            <table class="table table-borderless">
                                <tbody class="totals">
                                    <tr>
                                        <td>
                                            <div class="text-left"> <span class="text-muted">Subtotal</span> </div>
                                        </td>
                                        <td>
                                            <div class="text-right"> <span>{{ App\Models\Order::where('id', $order_id)->first()->total }}</span> </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="text-left"> <span class="text-muted">Shipping Fee</span> </div>
                                        </td>
                                        <td>
                                            <div class="text-right"> <span>{{ App\Models\Order::where('id', $order_id)->first()->delivary_charge }}</span> </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="text-left"> <span class="text-muted">Discount</span> </div>
                                        </td>
                                        <td>
                                            <div class="text-right"> <span class="text-success">{{ App\Models\Order::where('id', $order_id)->first()->discount }} </span> </div>
                                        </td>
                                    </tr>
                                    <tr class="border-top border-bottom">
                                        <td>
                                            <div class="text-left"> <span class="font-weight-bold">Subtotal</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="text-right"> <span class="font-weight-bold">{{(App\Models\Order::where('id', $order_id)->first()->total+App\Models\Order::where('id', $order_id)->first()->delivary_charge)- App\Models\Order::where('id', $order_id)->first()->discount }}</span>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <p>We will be sending shipping confirmation email when the item shipped successfully!</p>
                    <p class="font-weight-bold mb-0">Thanks for shopping with us!</p> <span>Nike Team</span>
                </div>
                <div class="d-flex justify-content-between footer p-3"> <span>Need Help? visit our <a href="#"> help
                            center</a></span> <span>12 June, 2020</span> </div>
            </div>
        </div>
    </div>
</div>

