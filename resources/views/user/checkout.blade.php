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
                <h3>Billing Details</h3>
                <form
                  class="row contact_form"
                  action="#"
                  method="post"
                  novalidate="novalidate"
                >
                  <div class="col-md-6 form-group p_star">
                    <input
                      type="text"
                      class="form-control"
                      id="first"
                      name="name"
                    />
                    <span
                      class="placeholder"
                      data-placeholder="First name"
                    ></span>
                  </div>
                  <div class="col-md-6 form-group p_star">
                    <input
                      type="text"
                      class="form-control"
                      id="last"
                      name="name"
                    />
                    <span class="placeholder" data-placeholder="Last name"></span>
                  </div>
                  <div class="col-md-12 form-group">
                    <input
                      type="text"
                      class="form-control"
                      id="company"
                      name="company"
                      placeholder="Company name"
                    />
                  </div>
                  <div class="col-md-6 form-group p_star">
                    <input
                      type="text"
                      class="form-control"
                      id="number"
                      name="number"
                    />
                    <span
                      class="placeholder"
                      data-placeholder="Phone number"
                    ></span>
                  </div>
                  <div class="col-md-6 form-group p_star">
                    <input
                      type="text"
                      class="form-control"
                      id="email"
                      name="compemailany"
                    />
                    <span
                      class="placeholder"
                      data-placeholder="Email Address"
                    ></span>
                  </div>
                  <div class="col-md-12 form-group p_star">
                    <select class="country_select">
                      <option value="1">Country</option>
                      <option value="2">Country</option>
                      <option value="4">Country</option>
                    </select>
                  </div>
                  <div class="col-md-12 form-group p_star">
                    <input
                      type="text"
                      class="form-control"
                      id="add1"
                      name="add1"
                    />
                    <span
                      class="placeholder"
                      data-placeholder="Address line 01"
                    ></span>
                  </div>
                  <div class="col-md-12 form-group p_star">
                    <input
                      type="text"
                      class="form-control"
                      id="add2"
                      name="add2"
                    />
                    <span
                      class="placeholder"
                      data-placeholder="Address line 02"
                    ></span>
                  </div>
                  <div class="col-md-12 form-group p_star">
                    <input
                      type="text"
                      class="form-control"
                      id="city"
                      name="city"
                    />
                    <span class="placeholder" data-placeholder="Town/City"></span>
                  </div>
                  <div class="col-md-12 form-group p_star">
                    <select class="country_select">
                      <option value="1">District</option>
                      <option value="2">District</option>
                      <option value="4">District</option>
                    </select>
                  </div>
                  <div class="col-md-12 form-group">
                    <input
                      type="text"
                      class="form-control"
                      id="zip"
                      name="zip"
                      placeholder="Postcode/ZIP"
                    />
                  </div>
                  <div class="col-md-12 form-group">
                    <div class="creat_account">
                      <input type="checkbox" id="f-option2" name="selector" />
                      <label for="f-option2">Create an account?</label>
                    </div>
                  </div>
                  <div class="col-md-12 form-group">
                    <div class="creat_account">
                      <h3>Shipping Details</h3>
                      <input type="checkbox" id="f-option3" name="selector" />
                      <label for="f-option3">Ship to a different address?</label>
                    </div>
                    <textarea
                      class="form-control"
                      name="message"
                      id="message"
                      rows="1"
                      placeholder="Order Notes"
                    ></textarea>
                  </div>
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