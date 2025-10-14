<!Doctype html>
<html lang="fr">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title>Dashboard</title>
<link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset("assets/css/all.min.css") }}">
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}">
<!-- Dans le <head> -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">

@yield("style")

</head>
<body>

<div class="wrap">
  <aside>
    <div class="brand">
      <img class="logo" src="{{ asset("assets/images/Logo/Logo (2).png") }}" alt="" >
      <h1>EMMO</h1>
    </div>
    <nav>
      <a href="{{ route("admin.dashboard") }}" class="nav-item {{ Route::is("admin.dashboard") ? 'active' : '' }}"><i class="fa-solid fa-chart-line"></i> Dashboard</a>
      <a href="{{ route("admin.property") }}" class="nav-item {{ Route::is("admin.property") ? 'active' : '' }}"><i class="fa-solid fa-building"></i> Propriétés</a>
      <a class="nav-item"><i class="fa-solid fa-user-tie"></i> Client</a>
      <a href="{{ route("admin.subscriptions.index") }}" class="nav-item {{ Route::is("admin.subscriptions.index") ? 'active' : '' }}"><i class="fa-solid fa-user-tie"></i> Abonnement</a>
      <a class="nav-item"><i class="fa-solid fa-user"></i> My Profile</a>

        <form action="{{ route('logout') }}" method="POST" style="display:flex;">
             @csrf
         <button type="submit" class=" nav-item" style="background:none;border:none;padding:0;cursor:pointer;"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
    </nav>
         </button>
             </form>

    </nav>
  </aside>
  @yield('body')
  <script src="{{ asset("assets/js/dashboard.js") }}"></script>
  <script src="{{ asset("assets/js/chart.min.js") }}"></script>
<script src="{{ asset("assets/js/all.min.js") }}"></script>
<script src="{{ asset("assets/bootstrap/js/bootstrap.min.js") }}"></script>
<!-- Avant la fermeture de </body> -->
<script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>

@yield('scripts')
  </body>
</html>

