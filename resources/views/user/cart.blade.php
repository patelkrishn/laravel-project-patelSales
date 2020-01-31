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
                <h2>Cart</h2>
                <p>Very us move be blessed multiply night</p>
              </div>
              <div class="page_link">
                <a href="index.html">Home</a>
                <a href="cart.html">Cart</a>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!--================End Home Banner Area =================-->
  
      @if ($cartSum==0)
         <div class="container">
            <div class="mb-5 mt-5">
                <center> <h1>Cart is empty</h1></center>
            </div>
         </div>
      @else
          <!--================Cart Area =================-->
      <section class="cart_area">
        <div class="container">
          <div class="cart_inner">
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Product</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Total</th>
                  </tr>
                </thead>
                <tbody>
                @foreach ($data as $item)
                  <tr>
                    <td>
                      <div class="media">
                        <div class="d-flex">
                          <img
                            src="{{asset($item->productImage)}}"
                            alt=""
                          />
                        </div>
                        <div class="media-body">
                          <p>{{$item->productTitle}}</p>
                        </div>
                      </div>
                    </td>
                    <td>
                      <h5>₹{{$item->salePrice!=0?$item->salePrice:$item->productPrice}}</h5>
                    </td>
                    <td>
                      <div class="product_count">
                          <form action="/cart/{{$item->id}}" method="POST">
                            @method('PUT')
                            @csrf
                        <input
                          type="text"
                          name="qty[]"
                          id="sst{{$item->id}}"
                          maxlength="12"
                          value="{{$item->quantity}}"
                          title="Quantity:"
                          class="input-text qty"
                        />
                        <button
                          onclick="var result = document.getElementById('sst{{$item->id}}'); var sst = result.value; if( !isNaN( sst )) result.value++;return false;"
                          class="increase items-count"
                          type="button"
                        >
                          <i class="lnr lnr-chevron-up"></i>
                        </button>
                        <button
                          onclick="var result = document.getElementById('sst{{$item->id}}'); var sst = result.value; if( !isNaN( sst ) &amp;&amp; sst > 0 ) result.value--;return false;"
                          class="reduced items-count"
                          type="button"
                        >
                          <i class="lnr lnr-chevron-down"></i>
                        </button>
                      </div>
                    </td>
                    <td>
                      <h5>₹{{$item->totalAmount}}</h5>
                    </td>
                  </tr>
                  <input type="hidden" name="cartId[]" value="{{$item->id}}">
                  <input type="hidden" name="price[]" value="{{$item->salePrice!=0?$item->salePrice:$item->productPrice}}">
                  @endforeach
                  <tr class="bottom_button">
                    <td>
                      <button type="submit" class="gray_btn">Update Cart</button>
                    </form>
                    </td>
                    <td></td>
                    <td></td>
                    <td>
                      <div class="cupon_text">
                        <input type="text" placeholder="Coupon Code" />
                        <a class="main_btn" href="#">Apply</a>
                        <a class="gray_btn" href="#">Close Coupon</a>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td></td>
                    <td></td>
                    <td>
                      <h5>Subtotal</h5>
                    </td>
                    <td>
                      <h5>₹{{$cartSum}}</h5>
                    </td>
                  </tr>
                  <tr class="out_button_area">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                      <div class="checkout_btn_inner">
                        <a class="gray_btn" href="/home">Continue Shopping</a>
                        <a class="main_btn" href="{{route('payment.index')}}">Proceed to checkout</a>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </section>
      <!--================End Cart Area =================-->
      @endif
@endsection
@section('extra-js')
@if(session()->has('success'))
<script>
	$(document).ready(function(){
      toastr.success('{{ session()->get('success') }}')
    });
</script>
@endif
@endsection