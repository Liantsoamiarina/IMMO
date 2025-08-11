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
<div class="wrap">
  <aside>
    <div class="brand">
      <div class="logo">Y</div>
      <h1>EMMO</h1>
    </div>
    <nav>
      <div class="nav-item active"><i class="fa-solid fa-chart-line"></i> Dashboard</div>
      <div class="nav-item"><i class="fa-solid fa-building"></i> Properties</div>
      <div class="nav-item"><i class="fa-solid fa-user-tie"></i> Agents</div>
      <div class="nav-item"><i class="fa-solid fa-user"></i> My Profile</div>
      <div class="nav-item"><i class="fa-solid fa-right-from-bracket"></i> Logout</div>
    </nav>
  </aside>
  @yield('body')
  </body>
</html>
