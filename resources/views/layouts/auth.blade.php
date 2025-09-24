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
    @livewireStyles

    <link rel="stylesheet" href="{{ asset("assets/css/Style.css") }}">

    <link rel="stylesheet" href="{{ asset("assets/css/owl.css") }}">
    <link rel="stylesheet" href="{{ asset("assets/css/animate.css") }}">
    <link rel="stylesheet"href="{{ asset("assets/css/swiper-bundle.min.css") }}"/>
   {{-- popup login --}}
<link rel="stylesheet" href="{{ asset("assets/notyf/notyf.min.css") }}">


  </head>

<body>

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



@yield("body")


@livewireScripts



  <script src="{{ asset("assets/jquery/jquery.min.js") }}"></script>
  <script src="{{ asset("assets/bootstrap/js/bootstrap.min.js") }}"></script>

<script src="{{ asset("assets/notyf/notyf.min.js") }}"></script>
<script src="{{ asset("assets/js/sweetalert2.min.js") }}"></script>


  <script src="{{ asset("assets/js/isotope.min.js") }}"></script>
  <script src="{{ asset("assets/js/owl-carousel.js") }}"></script>
  <script src="{{ asset("assets/js/counter.js") }}"></script>
  <script src="{{ asset("assets/js/custom.js") }}"></script>


  </body>
</html>
