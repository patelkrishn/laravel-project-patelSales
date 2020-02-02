@extends('user.layouts.app')
@section('content')
    <!--================Home Banner Area =================-->
  <section class="home_banner_area mb-40">
    <div class="banner_inner d-flex align-items-center">
      <div class="container">
        <div class="banner_content row">
          <div class="col-lg-12">
            <p class="sub text-uppercase">men Collection</p>
            <h3><span>Show</span> Your <br />Personal <span>Style</span></h3>
            <h4>Fowl saw dry which a above together place.</h4>
            <a class="main_btn mt-40" href="#">View Collection</a>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--================End Home Banner Area =================-->

  <!-- Start feature Area -->
  <section class="feature-area section_gap_bottom_custom">
    <div class="container">
      <div class="row">
        <div class="col-lg-3 col-md-6">
          <div class="single-feature">
            <a href="#" class="title">
              <i class="flaticon-money"></i>
              <h3>Money back gurantee</h3>
            </a>
            <p>Shall open divide a one</p>
          </div>
        </div>

        <div class="col-lg-3 col-md-6">
          <div class="single-feature">
            <a href="#" class="title">
              <i class="flaticon-truck"></i>
              <h3>Free Delivery</h3>
            </a>
            <p>Shall open divide a one</p>
          </div>
        </div>

        <div class="col-lg-3 col-md-6">
          <div class="single-feature">
            <a href="#" class="title">
              <i class="flaticon-support"></i>
              <h3>Alway support</h3>
            </a>
            <p>Shall open divide a one</p>
          </div>
        </div>

        <div class="col-lg-3 col-md-6">
          <div class="single-feature">
            <a href="#" class="title">
              <i class="flaticon-blockchain"></i>
              <h3>Secure payment</h3>
            </a>
            <p>Shall open divide a one</p>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End feature Area -->

  <!--================ Inspired Product Area =================-->
  <section class="inspired_product_area section_gap_bottom_custom">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-12">
          <div class="main_title">
            <h2><span>Inspired products</span></h2>
            <p>Bring called seed first of third give itself now ment</p>
          </div>
        </div>
      </div>

      <div class="row">
		
		@foreach ($data as $item)
		<div class="col-lg-3 col-md-6">
			<div class="single-product">
			  <div class="product-img">
				<img class="img-fluid w-100" src="{{asset($item->productImage)}}" alt="" />
				<div class="p_icon">
				  <a href="#">
					<i class="ti-eye"></i>
				  </a>
				  <a href="#">
					<i class="ti-heart"></i>
				  </a>
				  <a href="#">
					<i class="ti-shopping-cart"></i>
				  </a>
				</div>
			  </div>
			  <div class="product-btm">
				<a href="/product/{{$item->id}}" class="d-block">
				  <h4>{{$item->productTitle}}</h4>
				</a>
				<div class="mt-3">
				  <span class="mr-4">₹{{$item->salePrice!=NULL ? $item->salePrice : $item->productPrice}}</span>
				  <?php if ($item->salePrice!=NULL) {
					  echo "<del>₹".$item->productPrice."</del>";
				  } ?>
				  
				</div>
			  </div>
			</div>
		  </div>
  
		@endforeach
        
      </div>
    </div>
  </section>
  <!--================ End Inspired Product Area =================-->

   
@endsection