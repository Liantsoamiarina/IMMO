<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    {{-- <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet"> --}}
    <link rel="shortcut icon" href="{{ asset("assets/images/Logo/favicon.ico") }}" type="image/x-icon">
    <title>{{$pageTitle ?? "Immobilier" }}</title>
    <link rel="stylesheet" href="{{ asset("assets/css/fontawesome.css") }}">
    <link href="{{ asset("assets/bootstrap/css/bootstrap.min.css") }}" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="{{ asset("assets/css/Style.css") }}">

    <link rel="stylesheet" href="{{ asset("assets/css/owl.css") }}">
    <link rel="stylesheet" href="{{ asset("assets/css/animate.css") }}"">
    <link rel="stylesheet"href="{{ asset("assets/css/swiper-bundle.min.css") }}"/>
  </head>

<body>
  <!-- ***** Preloader Start ***** -->
  <div id="js-preloader" class="js-preloader">
    <div class="preloader-inner">
      <span class="dot"></span>
      <div class="dots">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
  </div>
  <!-- ***** Preloader End ***** -->

  <div class="sub-header">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-8">
          <ul class="info">
            <li><i class="fa fa-envelope"></i> Immo261@gmail.com</li>
            <li><i class="fa fa-map"></i> Sunny Isles Beach, FL 33160</li>
          </ul>
        </div>
        <div class="col-lg-4 col-md-4">
          <ul class="social-links">
            <li><a href="#"><i class="fab fa-facebook"></i></a></li>
            <li><a href="#" target="_blank"><i class="fab fa-twitter"></i></a></li>
            <li><a href="#"><i class="fab fa-linkedin"></i></a></li>
            <li><a href="#"><i class="fab fa-instagram"></i></a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>

  <!-- ***** Header Area Start ***** -->
  <header class="header-area header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    <!-- ***** Logo Start ***** -->
                    <a href="/" class="logo">
                        <img src="{{ asset("assets/images/Logo/Logo (2).png") }}" alt="logo"">
                        <h1>mmo</h1>
                    </a>
                    <!-- ***** Logo End ***** -->
                    <!-- ***** Menu Start ***** -->
                    <ul class="nav">
                      <li><a href="{{ route("homepage") }}" class="{{ Route::is("homepage") ? 'active' : '' }}">Home</a></li>
                      <li><a href="{{ route("property") }}" class="{{ Route::is("properties") ? 'active ' : '' }}">Properties</a></li>
                      <li><a href="{{ route("details") }}" class="{{ Route::is("details") ? 'active':'' }}">Property Details</a></li>
                      <li><a href="{{ route("Rent") }}" class="{{ Route::is("Rent") ? 'active':'' }}">Rent Details</a></li>
                        <li>
                        <a href="{{ route("contact") }}" class="{{ Route::is("contact") ? 'active' : '' }}">Contact Us</a></li>
                      <li><a href="#"><i class="fa fa-calendar"></i> Schedule a visit</a></li>
                  </ul>
                    <a class='menu-trigger'>
                        <span>Menu</span>
                    </a>
                    <!-- ***** Menu End ***** -->
                </nav>
            </div>
        </div>
    </div>
  </header>
  <!-- ***** Header Area End ***** -->
@yield("body")


  <footer>
    <div class="container">
      <div class="col-lg-8">
        <p>Copyright © 2025 IMMO., Liantsoa Miarina. All rights reserved.

        Design: <a rel="nofollow" href="https://templatemo.com" target="_blank">TemplateMo</a></p>
      </div>
    </div>
  </footer>

  <!-- Scripts -->
  <script src="{{ asset("assets/jquery/jquery.min.js") }}"></script>
  <script src="{{ asset("assets/bootstrap/js/bootstrap.min.js") }}"></script>
  <script src="{{ asset("assets/js/isotope.min.js") }}"></script>
  <script src="{{ asset("assets/js/owl-carousel.js") }}"></script>
  <script src="{{ asset("assets/js/counter.js") }}"></script>
  <script src="{{ asset("assets/js/custom.js") }}"></script>

  </body>
</html>
