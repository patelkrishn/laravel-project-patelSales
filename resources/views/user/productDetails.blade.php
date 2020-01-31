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
				<h2>Product Details</h2>
				<p>Very us move be blessed multiply night</p>
			  </div>
			  <div class="page_link">
				<a href="index.html">Home</a>
				<a href="single-product.html">Product Details</a>
			  </div>
			</div>
		  </div>
		</div>
	  </section>
	  <!--================End Home Banner Area =================-->
  
	  <!--================Single Product Area =================-->
	  <div class="product_image_area">
		<div class="container">
		  <div class="row s_product_inner">
			<div class="col-lg-6">
			  <div class="s_product_img">
				<div
				  id="carouselExampleIndicators"
				  class="carousel slide"
				  data-ride="carousel"
				>
				  {{-- <ol class="carousel-indicators">
					<li
					  data-target="#carouselExampleIndicators"
					  data-slide-to="0"
					  class="active"
					>
					  <img
						src="/user/img/product/single-product/s-product-s-2.jpg"
						alt=""
					  />
					</li>
					<li
					  data-target="#carouselExampleIndicators"
					  data-slide-to="1"
					>
					  <img
						src="/user/img/product/single-product/s-product-s-3.jpg"
						alt=""
					  />
					</li>
					<li
					  data-target="#carouselExampleIndicators"
					  data-slide-to="2"
					>
					  <img
						src="/user/img/product/single-product/s-product-s-4.jpg"
						alt=""
					  />
					</li>
				  </ol> --}}
				  <div class="carousel-inner">
					<div class="carousel-item active">
					  <img
						class="d-block w-100"
						src="{{asset($items['productImage'])}}"
						alt="First slide"
					  />
					</div>
					<div class="carousel-item">
					  <img
						class="d-block w-100"
						src="{{asset($items['productImage'])}}"
						alt="Second slide"
					  />
					</div>
					<div class="carousel-item">
					  <img
						class="d-block w-100"
						src="{{asset($items['productImage'])}}"
						alt="Third slide"
					  />
					</div>
				  </div>
				</div>
			  </div>
			</div>
			<div class="col-lg-5 offset-lg-1">
			  <div class="s_product_text">
				<h3>{{$items['productTitle']}}</h3>
				<h2>₹{{$items['productPrice']}}</h2>
				<ul class="list">
				  <li>
					<a class="active" href="#">
					  <span>Category</span> : {{$items['name']}}</a
					>
				  </li>
				  <li>
					<a href="#"> <span>Availibility</span> : {{$items['stockQuantity'] == 0 ? 'Out of stock' : 'In stock'}}</a>
				  </li>
				</ul>
				<p>
				  {{$items['productShortDescreption']}}
				</p>
				<div class="product_count">
					<form action="{{route('cart.store')}}" method="post">
						@csrf
				  <label for="qty">Quantity:</label>
				  <input
					type="text"
					name="quantity"
					id="sst"
					maxlength="12"
					value="1"
					title="Quantity:"
					class="input-text qty"
				  />
				  <button
					onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst )) result.value++;return false;"
					class="increase items-count"
					type="button"
				  >
					<i class="lnr lnr-chevron-up"></i>
				  </button>
				  <button
					onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst ) &amp;&amp; sst > 1 ) result.value--;return false;"
					class="reduced items-count"
					type="button"
				  >
					<i class="lnr lnr-chevron-down"></i>
				  </button>
				</div>
				<div class="card_area">
					<input type="hidden" name="productId" value="{{$items['id']}}">
					<input type="hidden" name="productPrice" value="{{$items['salePrice']!=0 ? $items['salePrice'] : $items['productPrice']}}">
				  <button type="submit" class="main_btn" href="#">Add to Cart</button>
				  <a class="icon_btn" href="#">
					<i class="lnr lnr lnr-diamond"></i>
				  </a>
				  <a class="icon_btn" href="#">
					<i class="lnr lnr lnr-heart"></i>
				  </a>
				</div>
			  </div>
			</div>
		  </div>
		</div>
	  </div>
	  <!--================End Single Product Area =================-->
  
	  <!--================Product Description Area =================-->
	  <section class="product_description_area">
		<div class="container">
		  <ul class="nav nav-tabs" id="myTab" role="tablist">
			<li class="nav-item">
			  <a
				class="nav-link"
				id="home-tab"
				data-toggle="tab"
				href="#home"
				role="tab"
				aria-controls="home"
				aria-selected="true"
				>Description</a
			  >
			</li>
			<li class="nav-item">
			  <a
				class="nav-link active"
				id="review-tab"
				data-toggle="tab"
				href="#review"
				role="tab"
				aria-controls="review"
				aria-selected="false"
				>Reviews</a
			  >
			</li>
		  </ul>
		  
		  <div class="tab-content" id="myTabContent">
			<div
			  class="tab-pane fade"
			  id="home"
			  role="tabpanel"
			  aria-labelledby="home-tab">
			  <?php echo $items['productDescreption']; ?>
			</div>
			<div
			  class="tab-pane fade show active"
			  id="review"
			  role="tabpanel"
			  aria-labelledby="review-tab"
			>
			  <div class="row">
				<div class="col-lg-6">
				  <div class="row total_rate">
					<div class="col-6">
					  <div class="box_total">
						<h5>Overall</h5>
						<h4>4.0</h4>
						<h6>(03 Reviews)</h6>
					  </div>
					</div>
				  </div>
				  <div class="review_list">
{{-- ===================== this is our dynamic part of review list =======================  --}}
					<div class="review_item">
					  <div class="media">
						<div class="d-flex">
						  <img
							src="img/product/single-product/review-1.png"
							alt=""
						  />
						</div>
						<div class="media-body">
						  <h4>Krishn Patel</h4>
						  <i class="fa fa-star"></i>
						  <i class="fa fa-star"></i>
						  <i class="fa fa-star"></i>
						  <i class="fa fa-star"></i>
						  <i class="fa fa-star"></i>
						</div>
					  </div>
					  <p>
						Lorem ipsum dolor sit amet, consectetur adipisicing elit,
						sed do eiusmod tempor incididunt ut labore et dolore magna
						aliqua. Ut enim ad minim veniam, quis nostrud exercitation
						ullamco laboris nisi ut aliquip ex ea commodo
					  </p>
					</div>
				  {{-- this is our dynamic part of review list  --}}
				  </div>
				</div>
				<div class="col-lg-6">
				  <div class="review_box">
					<h4>Add a Review</h4>
					<p>Your Rating:</p>
					<ul class="list">
					  <li>
						<a href="#">
						  <i class="fa fa-star"></i>
						</a>
					  </li>
					  <li>
						<a href="#">
						  <i class="fa fa-star"></i>
						</a>
					  </li>
					  <li>
						<a href="#">
						  <i class="fa fa-star"></i>
						</a>
					  </li>
					  <li>
						<a href="#">
						  <i class="fa fa-star"></i>
						</a>
					  </li>
					  <li>
						<a href="#">
						  <i class="fa fa-star"></i>
						</a>
					  </li>
					</ul>
					<p>Outstanding</p>
					<form
					  class="row contact_form"
					  action="contact_process.php"
					  method="post"
					  id="contactForm"
					  novalidate="novalidate"
					>
					  <div class="col-md-12">
						<div class="form-group">
						  <input
							type="text"
							class="form-control"
							id="name"
							name="name"
							placeholder="Your Full name"
						  />
						</div>
					  </div>
					  <div class="col-md-12">
						<div class="form-group">
						  <input
							type="email"
							class="form-control"
							id="email"
							name="email"
							placeholder="Email Address"
						  />
						</div>
					  </div>
					  <div class="col-md-12">
						<div class="form-group">
						  <input
							type="text"
							class="form-control"
							id="number"
							name="number"
							placeholder="Phone Number"
						  />
						</div>
					  </div>
					  <div class="col-md-12">
						<div class="form-group">
						  <textarea
							class="form-control"
							name="message"
							id="message"
							rows="1"
							placeholder="Review"
						  ></textarea>
						</div>
					  </div>
					  <div class="col-md-12 text-right">
						<button
						  type="submit"
						  value="submit"
						  class="btn submit_btn"
						>
						  Submit Now
						</button>
					  </div>
					</form>
				  </div>
				</div>
			  </div>
			</div>
		  </div>
		</div>
	  </section>
	  <!--================End Product Description Area =================-->
  

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