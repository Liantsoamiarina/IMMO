<!Doctype html>
<html lang="fr">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title>Dashboard</title>
<link rel="stylesheet" href="{{ asset("assets/css/all.min.css") }}">
<link rel="stylesheet" href="style.css">
<script src="{{ asset("assets/js/chart.min.js") }}"></script>
<script src="{{ asset("assets/js/all.min.js") }}"></script>
</head>
<body>
    @yield("style")
<div class="wrap">
  <aside>
    <div class="brand">
      <img class="logo" src="{{ asset("assets/images/Logo/Logo (2).png") }}" alt="" >
      <h1>EMMO</h1>
    </div>
    <nav>
      <a class="nav-item active"><i class="fa-solid fa-chart-line"></i> Dashboard</a>
      <a href="{{ route("admin.property") }}" class="nav-item"><i class="fa-solid fa-building"></i> Properties</a>
      <a class="nav-item"><i class="fa-solid fa-user-tie"></i> Agents</a>
      <a class="nav-item"><i class="fa-solid fa-user"></i> My Profile</a>
      <a class="nav-item"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
    </nav>
  </aside>
  @yield('body')
  </body>
</html>
@yield('scripts')
