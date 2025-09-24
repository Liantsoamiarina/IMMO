<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

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


  <div class="sub-header">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-8">
          <ul class="info">
            <li><i class="fa fa-envelope"></i> emmotsoa261@gmail.com</li>
            {{-- <li><i class="fa fa-map"></i> Sunny Isles Beach, FL 33160</li> --}}
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


  <header class="header-area header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">

                    <a href="/" class="logo">
                        <img src="{{ asset("assets/images/Logo/Logo (2).png") }}" alt="logo"">
                        <h1>mmo</h1>
                    </a>

                    <ul class="nav">
                      <li><a href="{{ route("homepage") }}" class="{{ Route::is("homepage") ? 'active' : '' }}">Accueil</a></li>
                      <li><a href="{{ route("homepropertie") }}" class="{{ Route::is("homeproperties") ? 'active ' : '' }}">Propriétés</a></li>
                      <li><a href="{{ route("details") }}" class="{{ Route::is("details") ? 'active':'' }}">Property Details</a></li>
                      <li><a href="{{ route("Rent") }}" class="{{ Route::is("Rent") ? 'active':'' }}">Rent Details</a></li>
                        <li>
                        <a href="#Abonnement" class="">Abonnement </a></li>
                        <li>
                        <li>
                        <a href="{{ route("contact") }}" class="{{ Route::is("contact") ? 'active' : '' }}">Contact </a></li>
                        <li>
                            @if(Auth::check())
    {{-- popup Notyf --}}
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const notyf = new Notyf({
            duration: 5000,
            position: { x: 'left', y: 'top' },
            dismissible: true
        });
        notyf.success("Bonjour, {{ Auth::user()->name }} !");
    });
    </script>


    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:flex;">
        @csrf
        <button type="button" id="logout-btn" class="{{ Route::is('login.form') ? 'active' : '' }}"
                style="background:none;border:none;padding:0;cursor:pointer;margin-top:-28px;">
            <i class="fa fa-sign-out"></i>
        </button>
    </form>

    {{-- SweetAlert2 --}}
    <script src="{{ asset("assets/js/sweetalert2@11.js") }}"></script>
    <script>
        document.getElementById('logout-btn').addEventListener('click', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Êtes-vous sûr ?',
                text: "Déconnecté(e) {{ Auth::user()->email }}.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Oui, déconnecter',
                cancelButtonText: 'Annuler'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('logout-form').submit();
                }
            });
        });
    </script>

@else

    <a href="{{ route('login.form') }}" class="{{ Route::is('login.form') ? 'active' : '' }}">
        Se connecter
    </a>
@endif

                      {{-- <li><a href="#"><i class="fa fa-calendar"></i> Schedule a visit</a></li> --}}
                  </ul>
                    <a class='menu-trigger'>
                        <span>Menu</span>
                    </a>

                </nav>
            </div>
        </div>
    </div>
  </header>

@yield("body")


  <footer>
    <div class="container">
      <div class="col-lg-8">
        <p>Copyright © 2025 IMMO., Liantsoa Miarina. All rights reserved.

        Design: <a rel="nofollow" href="https://templatemo.com" target="_blank">TemplateMo</a></p>
      </div>
    </div>
  </footer>
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
