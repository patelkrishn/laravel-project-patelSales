@extends('user.layouts.app')
@section('content')

    <!--================Home Banner Area =================-->
    <section class="banner_area">
        <div class="banner_inner d-flex align-items-center">
          <div class="container">
            <div
              class="banner_content d-md-flex justify-content-between align-items-center"
            >
              <div class="mb-3 mb-md-0">
                <h2>Product Checkout</h2>
                <p>Very us move be blessed multiply night</p>
              </div>
              <div class="page_link">
                <a href="index.html">Home</a>
                <a href="checkout.html">Product Checkout</a>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!--================End Home Banner Area =================-->
  
      <!--================Checkout Area =================-->
      <section class="checkout_area section_gap">
        <div class="container">
          <div class="cupon_area">
            <div class="check_title">
              <h2>
                Have a coupon?
              </h2>
            </div>
            <form action="/cart/coupen" method="post">
                @csrf
            <input type="text" placeholder="Enter coupon code" name="coupenCode"/>
            <button type="submit" class="tp_btn">Apply Coupon</button>
        </form>
          </div>
          <div class="billing_details">
            <div class="row">
              <div class="col-lg-7">
                <h3>Shiping Details</h3>
                <form
                  class="row contact_form"
                  action="/address"
                  method="post"
                  novalidate="novalidate"
                >
                @csrf
                <div class="col-md-12 form-group p_star">
                  <input
                    type="text"
                    class="form-control"
                    id="name"
                    name="name"
                    placeholder="Your Name"
                    value="{{$address['name']}}"
                  />
                </div>
                <div class="col-md-12 form-group p_star">
                  <input
                    type="text"
                    class="form-control"
                    id="mobile"
                    name="mobile"
                    placeholder="Your Mobile"
                    value="{{$address['mobile']}}"
                  />
                </div>
                <div class="col-md-12 form-group p_star">
                  <input
                    type="text"
                    class="form-control"
                    id="street"
                    name="street"
                    placeholder="Your Street"
                    value="{{$address['street']}}"
                  />
                </div>
                <div class="col-md-12 form-group p_star">
                  <input
                    type="text"
                    class="form-control"
                    id="landmark"
                    name="landmark"
                    placeholder="Your Landmark"
                    value="{{$address['landmark']}}"
                  />
                </div>
                <div class="col-md-12 form-group p_star">
                  <input
                    type="text"
                    class="form-control"
                    id="city"
                    name="city"
                    placeholder="Your Town/City"
                    value="{{$address['city']}}"
                  />
                </div>
                <div class="col-md-12 form-group p_star">
                  <input
                    type="text"
                    class="form-control"
                    id="state"
                    name="state"
                    placeholder="Your State"
                    value="{{$address['state']}}"
                  />
                </div>
                <div class="col-md-12 form-group p_star">
                  <input
                    type="text"
                    class="form-control"
                    id="country"
                    name="country"
                    placeholder="Your Country"
                    value="{{$address['country']}}"
                  />
                </div>
                <div class="col-md-12 form-group p_star">
                  <input
                    type="text"
                    class="form-control"
                    id="pincode"
                    name="pincode"
                    placeholder="Your Pincode"
                    value="{{$address['pincode']}}"
                  />
                </div>
                <input type="hidden" name="userId" value="{{Auth::user()->id}}">
                  <button type="submit" class="main_btn">Update Address</button>
                </form>
              </div>
              <div class="col-lg-5">
                <div class="order_box">
                  <h2>Your Order</h2>
                  <ul class="list">
                    <li>
                      <a href="#"
                        >Product
                        <span>Total</span>
                      </a>
                    </li>
                    @foreach ($cartData as $item)
                        <li>
                            <div class="row">
                                <div class="col-md-7">
                                    <span>{{$item->productTitle}}</span>
                                </div>
                                <div class="col-md-2">
                                    <span class="middle">x {{$item->quantity}}</span>
                                </div>
                                <div class="col-md-3">
                                    <span class="last">₹{{$item->totalAmount}}</span>
                                </div>
                            </div>
                            <hr>
                        </li>
                    @endforeach
                  </ul>
                  <ul class="list list_2">
                    <li>
                      <a href="#"
                        >Subtotal
                        <span>₹{{$totalAmount}}</span>
                      </a>
                    </li>
                    <li>
                        <a href="/cart/removeDiscount/{{$discountAmount['id']}}/?amount={{$discountAmount['totalAmount']}}"
                          >Discount amount
                          <span>₹<?php if($discountAmount['discountAmount']==NULL) { echo 0; } else{echo $discountAmount['discountAmount'].'  &nbsp;<i style="color:red" class="fa fa-times-circle"></i>';} ?></span>
                          
                        </a>
                      </li>
                    <li>
                      <a href="#"
                        >Shipping
                        <span>Flat rate: ₹59</span>
                      </a>
                    </li>
                    <li>
                      <a href="#"
                        >Total
                        <span>₹{{$payableAmount+59}}</span>
                      </a>
                    </li>
                  </ul>
                  <form action="/payment" method="post">
                    @csrf
                    <input type="hidden" name="payableAmount" value="{{$payableAmount+59}}">
                  <div class="payment_item">
                    <div class="radion_btn">
                      <input type="radio" id="f-option5" name="selector" value="cod"/>
                      <label for="f-option5">Cash on delivery</label>
                      <div class="check"></div>
                    </div>
                  </div>
                  <div class="payment_item active">
                    <div class="radion_btn">
                      <input type="radio" id="f-option6" name="selector" value="pwp"/>
                      <div class="row">
                          <div class="col-md-7">
                            <label for="f-option6">Pay with Paytm </label>
                          </div>
                      </div>
                      <div class="check"></div>
                    </div>
                  </div>
                  {{-- <div class="creat_account">
                    <input type="checkbox" id="f-option4" name="selector" />
                    <label for="f-option4">I’ve read and accept the </label>
                    <a href="#">terms & conditions*</a>
                  </div> --}}
                  <button type="submit" class="main_btn">Proceed to Payment</button>
                </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!--================End Checkout Area =================-->
@endsection
@section('extra-js')
@if(session()->has('success'))
<script>
	$(document).ready(function(){
      toastr.success('{{ session()->get('success') }}')
    });
</script>
@endif
@if(session()->has('error'))
<script>
	$(document).ready(function(){
      toastr.error('{{ session()->get('error') }}')
    });
</script>
@endif
@if(session()->has('warning'))
<script>
	$(document).ready(function(){
      toastr.warning('{{ session()->get('warning') }}')
    });
</script>
@endif
@endsection