<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  {{-- <link rel="icon" href="{{asset('/user/img/fevicon.png')}}" type="image/png" /> --}}
  <title>Patel Sales</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="{{ asset('user/css/bootstrap.css') }}" />
  <link rel="stylesheet" href="{{ asset('user/vendors/linericon/style.css') }}" />
  <link rel="stylesheet" href="{{ asset('user/css/font-awesome.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('user/css/themify-icons.css') }}" />
  <link rel="stylesheet" href="{{ asset('user/css/flaticon.css') }}" />
  <link rel="stylesheet" href="{{ asset('user/vendors/owl-carousel/owl.carousel.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('user/vendors/lightbox/simpleLightbox.css') }}" />
  <link rel="stylesheet" href="{{ asset('user/vendors/nice-select/css/nice-select.css') }}" />
  <link rel="stylesheet" href="{{ asset('user/vendors/animate-css/animate.css') }}" />
  <link rel="stylesheet" href="{{ asset('user/vendors/jquery-ui/jquery-ui.css') }}" />
  <!-- main css -->
  <link rel="stylesheet" href="{{ asset('user/css/style.css') }}" />
  <link rel="stylesheet" href="{{ asset('user/css/responsive.css') }}" />
   <!-- Toastr -->
   <link rel="stylesheet" href="{{ asset('user/toastr/toastr.min.css') }}">
   @yield('extra-css')
</head>

<body>
  <!--================Header Menu Area =================-->
  <header class="header_area">
    <div class="top_menu">
      <div class="container">
        <div class="row">
          <div class="col-lg-7">
            <div class="float-left">
              <p>Phone: +94 997 967 8595</p>
              <p>email: patelkrishn00@gmail.com</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="main_menu">
      <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light w-100">
          <!-- Brand and toggle get grouped for better mobile display -->
          <a class="navbar-brand logo_h" href="index.html">
            <img src="img/logo.png" alt="" />
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse offset w-100" id="navbarSupportedContent">
            <div class="row w-100 mr-0">
              <div class="col-lg-7 pr-0">
                <ul class="nav navbar-nav center_nav pull-right">
                  <li class="nav-item active">
                    <a class="nav-link" href="/home">Home</a>
                  </li>
                  <li class="nav-item">
                        <a class="nav-link" href="/product">Shop</a>
                  </li>
                  <li class="nav-item">
                        <a class="nav-link" href="/cart">Shopping Cart</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="/orders">My Orders</a>
                  </li>
                  {{-- <li class="nav-item submenu dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                      aria-expanded="false">My Orders</a>
                    <ul class="dropdown-menu">
                      <li class="nav-item">
                        <a class="nav-link" href="tracking.html">Tracking</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="elements.html">Elements</a>
                      </li>
                    </ul>
                  </li> --}}
                  <li class="nav-item">
                    <a class="nav-link" href="/profile">My Account</a>
                  </li>
                </ul>
              </div>

              <div class="col-lg-5 pr-0">
                <ul class="nav navbar-nav navbar-right right_nav pull-right">
                  <li class="nav-item">
                    <a href="/product" class="icons">
                      <i class="ti-search" aria-hidden="true"></i>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="/cart" class="icons">
                      <i class="ti-shopping-cart"></i>
                    </a>
                  </li>

                  {{-- <li class="nav-item">
                    <a href="#" class="icons">
                      <i class="ti-user" aria-hidden="true"></i>
                    </a>
                  </li> --}}

                  <li class="nav-item submenu dropdown">
                    <a href="#" class="icons dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                      aria-expanded="false"><i class="ti-user" aria-hidden="true"></i></a>
                    <ul class="dropdown-menu">
                      @guest
                        <li class="nav-item">
                          <a class="nav-link" href="{{asset('/login')}}">Login</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="{{asset('/register')}}">Register</a>
                        </li>
                      @else
                        <li class="nav-item">
                            <a class="nav-link" 
                            href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                              @csrf
                            </form>
                        </li>
                      @endguest
                    </ul>
                  </li>

                </ul>
              </div>
            </div>
          </div>
        </nav>
      </div>
    </div>
  </header>
  <!--================Header Menu Area =================-->

@yield('content')
  
  <!--================ start footer Area  =================-->
  <footer class="footer-area section_gap">
    <div class="container">
      <div class="row">
        <div class="col-lg-2 col-md-6 single-footer-widget">
          <h4>Top Products</h4>
          <ul>
            <li><a href="#">Managed Website</a></li>
            <li><a href="#">Manage Reputation</a></li>
            <li><a href="#">Power Tools</a></li>
            <li><a href="#">Marketing Service</a></li>
          </ul>
        </div>
        <div class="col-lg-2 col-md-6 single-footer-widget">
          <h4>Quick Links</h4>
          <ul>
            <li><a href="#">Jobs</a></li>
            <li><a href="#">Brand Assets</a></li>
            <li><a href="#">Investor Relations</a></li>
            <li><a href="#">Terms of Service</a></li>
          </ul>
        </div>
        <div class="col-lg-2 col-md-6 single-footer-widget">
          <h4>Features</h4>
          <ul>
            <li><a href="#">Jobs</a></li>
            <li><a href="#">Brand Assets</a></li>
            <li><a href="#">Investor Relations</a></li>
            <li><a href="#">Terms of Service</a></li>
          </ul>
        </div>
        <div class="col-lg-2 col-md-6 single-footer-widget">
          <h4>Resources</h4>
          <ul>
            <li><a href="#">Guides</a></li>
            <li><a href="#">Research</a></li>
            <li><a href="#">Experts</a></li>
            <li><a href="#">Agencies</a></li>
          </ul>
        </div>
        <div class="col-lg-4 col-md-6 single-footer-widget">
          <h4>Newsletter</h4>
          <p>You can trust us. we only send promo offers,</p>
          <div class="form-wrap" id="mc_embed_signup">
            <form target="_blank" action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01"
              method="get" class="form-inline">
              <input class="form-control" name="EMAIL" placeholder="Your Email Address" onfocus="this.placeholder = ''"
                onblur="this.placeholder = 'Your Email Address '" required="" type="email">
              <button class="click-btn btn btn-default">Subscribe</button>
              <div style="position: absolute; left: -5000px;">
                <input name="b_36c4fd991d266f23781ded980_aefe40901a" tabindex="-1" value="" type="text">
              </div>

              <div class="info"></div>
            </form>
          </div>
        </div>
      </div>
      <div class="footer-bottom row align-items-center">
        <p class="footer-text m-0 col-lg-8 col-md-12"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> | All rights reserved by <a href="https://lninfosystem.com" target="_blank">Krishn Patel</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
        <div class="col-lg-4 col-md-12 footer-social">
          <a href="#"><i class="fa fa-facebook"></i></a>
          <a href="#"><i class="fa fa-twitter"></i></a>
          <a href="#"><i class="fa fa-dribbble"></i></a>
          <a href="#"><i class="fa fa-behance"></i></a>
        </div>
      </div>
    </div>
  </footer>
  <!--================ End footer Area  =================-->

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="{{ asset('user/js/jquery-3.2.1.min.js') }}"></script>
  <script src="{{ asset('user/js/popper.js') }}"></script>
  <script src="{{ asset('user/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('user/js/stellar.js') }}"></script>
  <script src="{{ asset('user/vendors/lightbox/simpleLightbox.min.js') }}"></script>
  <script src="{{ asset('user/vendors/nice-select/js/jquery.nice-select.min.js') }}"></script>
  <script src="{{ asset('user/vendors/isotope/imagesloaded.pkgd.min.js') }}"></script>
  <script src="{{ asset('user/vendors/isotope/isotope-min.js') }}"></script>
  <script src="{{ asset('user/vendors/owl-carousel/owl.carousel.min.js') }}"></script>
  <script src="{{ asset('user/js/jquery.ajaxchimp.min.js') }}"></script>
  <script src="{{ asset('user/vendors/counter-up/jquery.waypoints.min.js') }}"></script>
  <script src="{{ asset('user/vendors/counter-up/jquery.counterup.js') }}"></script>
  <script src="{{ asset('user/js/mail-script.js') }}"></script>
  <script src="{{ asset('user/js/theme.js') }}"></script>
  <!-- Toastr -->
<script src="{{ asset('user/toastr/toastr.min.js') }}"></script>
</body>

</html>

@yield('extra-js')