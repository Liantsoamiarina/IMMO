<main>
    <!DOCTYPE html>
<html lang="fr">

<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>VillaAgency - Votre Partenaire Immobilier de Confiance</title>

<!-- Bootstrap 5 CDN -->
<link rel="stylesheet" href="{{ asset("assets/bootstrap/css/bootstrap.min.css") }}">

<!-- FontAwesome CDN -->
<link rel="stylesheet" href="{{ asset("assets/fontawesome/css/all.min.css") }}">
   {{-- popup login --}}
<link rel="stylesheet" href="{{ asset("assets/notyf/notyf.min.css") }}">

<style>
:root {
  --primary-orange: #ff6b35;
  --secondary-orange: #ff8c42;
  --dark-black: #1a1a1a;
  --light-gray: #f8f9fa;
  --white: #ffffff;
  --gradient: linear-gradient(135deg, var(--primary-orange) 0%, var(--secondary-orange) 100%);
}

body {
  font-family: 'Poppins', sans-serif;
  background-color: var(--light-gray);
  color: var(--dark-black);
  line-height: 1.6;
}

html { scroll-behavior: smooth; }

/* Navigation */
.navbar {
  background: var(--white) !important;
  box-shadow: 0 2px 20px rgba(0,0,0,0.1);
  padding: 1rem 0;
  transition: all 0.3s ease;
}

.navbar-brand {
  font-size: 2rem;
  font-weight: 800;
  color: var(--dark-black) !important;
}

.navbar-brand i {
  color: var(--primary-orange);
  margin-right: 10px;
}

.navbar-nav .nav-link {
  color: var(--dark-black) !important;
  font-weight: 500;
  margin: 0 15px;
  position: relative;
  transition: all 0.3s ease;
}

.navbar-nav .nav-link:hover,
.navbar-nav .nav-link.active {
  color: var(--primary-orange) !important;
}

.navbar-nav .nav-link::after {
  content: '';
  position: absolute;
  bottom: -5px;
  left: 50%;
  width: 0;
  height: 2px;
  background: var(--gradient);
  transition: all 0.3s ease;
  transform: translateX(-50%);
}

.navbar-nav .nav-link:hover::after,
.navbar-nav .nav-link.active::after {
  width: 100%;
}

/* Hero Section */
.hero-section {
  background: linear-gradient(135deg, var(--dark-black) 0%, #2d2d2d 100%);
  color: var(--white);
  padding: 120px 0 80px;
  position: relative;
  overflow: hidden;
}

.hero-section::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: radial-gradient(circle at 50% 50%, rgba(255,107,53,0.2) 0%, transparent 60%);
}

.hero-content {
  position: relative;
  z-index: 2;
}

.hero-title {
  font-size: 3.5rem;
  font-weight: 800;
  margin-bottom: 1.5rem;
  background: var(--gradient);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}

.hero-subtitle {
  font-size: 1.2rem;
  color: #cccccc;
  margin-bottom: 2rem;
  max-width: 600px;
}

.btn-hero {
  padding: 15px 35px;
  font-weight: 600;
  border-radius: 50px;
  text-decoration: none;
  transition: all 0.3s ease;
  display: inline-flex;
  align-items: center;
  gap: 10px;
  margin: 5px;
}

.btn-primary-hero {
  background: var(--gradient);
  color: var(--white);
  border: 2px solid transparent;
  box-shadow: 0 8px 25px rgba(255, 107, 53, 0.3);
}

.btn-primary-hero:hover {
  transform: translateY(-3px);
  box-shadow: 0 12px 35px rgba(255, 107, 53, 0.4);
  color: var(--white);
}

.btn-outline-hero {
  background: transparent;
  color: var(--white);
  border: 2px solid var(--white);
}

.btn-outline-hero:hover {
  background: var(--white);
  color: var(--dark-black);
}

/* Stats Section */
.stats-section {
  background: var(--white);
  padding: 4rem 0;
  margin-top: -50px;
  position: relative;
  z-index: 3;
}

.stats-container {
  background: var(--white);
  border-radius: 20px;
  box-shadow: 0 10px 30px rgba(0,0,0,0.1);
  padding: 2rem;
}

.stat-item {
  text-align: center;
  padding: 1rem;
}

.stat-number {
  font-size: 3rem;
  font-weight: 800;
  color: var(--primary-orange);
  display: block;
}

.stat-label {
  font-size: 1rem;
  color: #666;
  font-weight: 500;
}

/* Section Styles */
.section-title {
  font-size: 2.5rem;
  font-weight: 700;
  text-align: center;
  margin-bottom: 1rem;
  position: relative;
}

.section-title::after {
  content: '';
  position: absolute;
  bottom: -10px;
  left: 50%;
  transform: translateX(-50%);
  width: 80px;
  height: 4px;
  background: var(--gradient);
  border-radius: 2px;
}

.section-subtitle {
  text-align: center;
  color: #666;
  margin-bottom: 3rem;
  font-size: 1.1rem;
}

/* About Section */
.about-section {
  padding: 5rem 0;
  background: var(--light-gray);
}

.about-card {
  background: var(--white);
  padding: 2rem;
  border-radius: 15px;
  box-shadow: 0 10px 30px rgba(0,0,0,0.1);
  height: 100%;
  text-align: center;
  transition: transform 0.3s ease;
  margin-bottom: 30px;
}

.about-card:hover {
  transform: translateY(-10px);
}

.about-icon {
  width: 80px;
  height: 80px;
  background: var(--gradient);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 0 auto 1.5rem;
  font-size: 2rem;
  color: var(--white);
}

/* Properties Section */
.properties-section {
  padding: 5rem 0;
  background: var(--white);
}

.property-card {
  background: var(--white);
  border-radius: 20px;
  overflow: hidden;
  box-shadow: 0 10px 30px rgba(0,0,0,0.1);
  transition: all 0.3s ease;
  height: 100%;
  position: relative;
  margin-bottom: 30px;
}

.property-card:hover {
  transform: translateY(-10px);
  box-shadow: 0 20px 40px rgba(0,0,0,0.15);
}

.property-image {
  height: 280px;
  background-size: cover;
  background-position: center;
  position: relative;
}

.property-badge {
  position: absolute;
  top: 15px;
  left: 15px;
  background: var(--gradient);
  color: var(--white);
  padding: 5px 15px;
  border-radius: 25px;
  font-size: 0.85rem;
  font-weight: 600;
}

.property-menu {
  position: absolute;
  top: 15px;
  right: 15px;
}

.property-menu .btn {
  background: rgba(255, 255, 255, 0.95);
  border: none;
  border-radius: 50%;
  width: 40px;
  height: 40px;
  display: flex;
  align-items: center;
  justify-content: center;
  color: var(--dark-black);
  backdrop-filter: blur(10px);
  transition: all 0.3s ease;
}

.property-menu .btn:hover {
  background: var(--primary-orange);
  color: var(--white);
  transform: scale(1.1);
}

.property-content {
  padding: 1.5rem;
}

.property-title {
  font-size: 1.3rem;
  font-weight: 700;
  margin-bottom: 0.5rem;
  color: var(--dark-black);
}

.property-price {
  font-size: 1.5rem;
  font-weight: 800;
  color: var(--primary-orange);
  margin-bottom: 0.5rem;
}

.property-address {
  color: #666;
  font-size: 0.95rem;
  display: flex;
  align-items: center;
  gap: 5px;
}

/* Testimonials Section */
.testimonials-section {
  padding: 5rem 0;
  background: var(--light-gray);
}

.testimonial-card {
  background: var(--white);
  padding: 2rem;
  border-radius: 15px;
  box-shadow: 0 10px 30px rgba(0,0,0,0.1);
  text-align: center;
  height: 100%;
  margin-bottom: 30px;
}

.testimonial-text {
  font-style: italic;
  margin-bottom: 1.5rem;
  font-size: 1.1rem;
  color: #555;
}

.testimonial-author {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 15px;
}

.author-avatar {
  width: 60px;
  height: 60px;
  border-radius: 50%;
  background: var(--gradient);
  display: flex;
  align-items: center;
  justify-content: center;
  color: var(--white);
  font-size: 1.5rem;
  font-weight: bold;
}

.stars {
  color: #ffc107;
  margin-top: 1rem;
}

/* Contact Section */
.contact-section {
  padding: 5rem 0;
  background: var(--white);
}

.contact-card {
  background: var(--light-gray);
  padding: 2rem;
  border-radius: 15px;
  text-align: center;
  height: 100%;
  margin-bottom: 30px;
}

.contact-icon {
  width: 60px;
  height: 60px;
  background: var(--gradient);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 0 auto 1rem;
  color: var(--white);
  font-size: 1.5rem;
}

/* Footer */
.footer {
  background: var(--dark-black);
  color: var(--white);
  padding: 3rem 0 1rem;
}

.footer-section h5 {
  color: var(--primary-orange);
  margin-bottom: 1rem;
}

.footer-section ul {
  list-style: none;
  padding: 0;
}

.footer-section ul li {
  margin-bottom: 0.5rem;
}

.footer-section ul li a {
  color: #ccc;
  text-decoration: none;
  transition: color 0.3s ease;
}

.footer-section ul li a:hover {
  color: var(--primary-orange);
}

.social-links {
  display: flex;
  gap: 15px;
  justify-content: center;
}

.social-links a {
  width: 40px;
  height: 40px;
  background: var(--gradient);
  color: var(--white);
  display: flex;
  align-items: center;
  justify-content: center;
  border-radius: 50%;
  text-decoration: none;
  transition: transform 0.3s ease;
}

.social-links a:hover {
  transform: scale(1.1);
}

.footer-bottom {
  border-top: 1px solid #333;
  padding-top: 1rem;
  margin-top: 2rem;
  text-align: center;
  color: #ccc;
}

/* Button Styles */
.btn-primary {
  background: var(--gradient);
  border: none;
  color: white;
  font-weight: 600;
  padding: 12px 30px;
  border-radius: 25px;
  transition: all 0.3s ease;
  box-shadow: 0 4px 15px rgba(255, 107, 53, 0.3);
}

.btn-primary:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 20px rgba(255, 107, 53, 0.4);
  background: linear-gradient(135deg, var(--secondary-orange) 0%, var(--primary-orange) 100%);
  color: white;
}

/* Modal Styles */
.modal-content {
  border: none;
  border-radius: 20px;
  box-shadow: 0 20px 50px rgba(0,0,0,0.3);
}

.modal-header {
  background: var(--gradient);
  color: var(--white);
  border-radius: 20px 20px 0 0;
  border: none;
}

.btn-close {
  filter: invert(1);
}

.form-control {
  border-radius: 10px;
  border: 2px solid #eee;
  padding: 12px 15px;
  transition: all 0.3s ease;
}

.form-control:focus {
  border-color: var(--primary-orange);
  box-shadow: 0 0 0 0.2rem rgba(255, 107, 53, 0.25);
}

.btn-success {
  background: var(--gradient);
  border: none;
  border-radius: 10px;
  padding: 10px 25px;
  font-weight: 600;
}

.btn-danger {
  background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
  border: none;
  border-radius: 10px;
}

/* Responsive */
@media (max-width: 768px) {
  .hero-title {
    font-size: 2.5rem;
  }

  .navbar-brand {
    font-size: 1.5rem;
  }

  .stat-number {
    font-size: 2rem;
  }
}
</style>
</head>

<body>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg fixed-top">
  <div class="container d-flex">
 <a href="/" class="navbar-brand logo ">
     <img src="{{ asset("assets/images/Logo/image.png") }}" alt="logo"">

 </a>

 <style>
     /* logo navbar */
.logo img{
    height: 68px;
    width: auto;
    object-fit: contain;

  margin-left: -75px;
}

                    </style>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link active" href="#home">Accueil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#about">À Propos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#properties">Biens</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#testimonials">Témoignages</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#contact">Contact</a>

        </li>
        @if(Auth::check())
    {{-- popup Notyf --}}
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const notyf = new Notyf({
            duration: 5000,
            position: { x: 'right', y: 'top' },
            dismissible: true
        });
        notyf.success("Bonjour, {{ Auth::user()->name }} !");
    });
    </script>
    @endif

  @auth
        <!-- Menu Profil Connecté -->
        <li class="nav-item dropdown">
          <a class="nav-link d-flex align-items-center profile-dropdown" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <div class="profile-avatar me-2">
              {{ strtoupper(substr(Auth::user()->name, 0, 1) . (strpos(Auth::user()->name, ' ') ? substr(Auth::user()->name, strpos(Auth::user()->name, ' ') + 1, 1) : substr(Auth::user()->name, 1, 1))) }}
            </div>
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
            <!-- Header du profil -->
            <li class="profile-header">
              <div class="d-flex align-items-center">
                <div class="profile-avatar profile-avatar-large me-3">
                  {{ strtoupper(substr(Auth::user()->name, 0, 1) . (strpos(Auth::user()->name, ' ') ? substr(Auth::user()->name, strpos(Auth::user()->name, ' ') + 1, 1) : substr(Auth::user()->name, 1, 1))) }}
                </div>
                <div class="profile-info">
                  <h6>{{ Auth::user()->name }}</h6>
                  <small>{{ Auth::user()->email }}</small>
                </div>
              </div>
            </li>
            <li>
              <a class="dropdown-item" href="#profile">
                <i class="fas fa-user me-2"></i>Mon Profil
              </a>
            </li>
            <li>
              <a class="dropdown-item" href="#settings">
                <i class="fas fa-cog me-2"></i>Paramètres
              </a>
            </li>
            <li>
              <a class="dropdown-item" href="#favorites">
                <i class="fas fa-heart me-2"></i>Mes Favoris
              </a>
            </li>
            <li>
              <a class="dropdown-item" href="#messages">
                <i class="fas fa-envelope me-2"></i>Messages
                <span class="badge bg-danger ms-2">3</span>
              </a>
            </li>
            <li>
              <a class="dropdown-item" href="#history">
                <i class="fas fa-history me-2"></i>Historique
              </a>
            </li>
            <li><hr class="dropdown-divider"></li>
            <li>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:flex;">
        @csrf
        <button class="dropdown-item text-danger" type="button" id="logout-btn" href="{{ route('logout') }}">
            <i class="fas fa-sign-out-alt me-2"></i>Déconnexion
        </button>
    </form>
            </li>
          </ul>
        </li>
        @endauth
      </ul>
    </div>
  </div>
</nav>

<*
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

<style>
/* Styles pour le menu profil */
.profile-avatar {
  width: 32px;
  height: 32px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  color: white;
  cursor: pointer;
}

.dropdown-menu {
  border: none;
  box-shadow: 0 10px 30px rgba(0,0,0,0.1);
  border-radius: 10px;
  padding: 0.5rem 0;
  min-width: 200px;
}

.dropdown-item {
  padding: 0.7rem 1.2rem;
  transition: all 0.3s ease;
  border: none;
}

.dropdown-item:hover {
  background-color: #f8f9fa;
  transform: translateX(5px);
}

.dropdown-item i {
  width: 20px;
  text-align: center;
}

.dropdown-divider {
  margin: 0.5rem 0;
}

/* Responsive */
@media (max-width: 991px) {
  .profile-avatar {
    display: none;
  }

  .dropdown-menu {
    position: static !important;
    transform: none !important;
    box-shadow: none;
    border: 1px solid #dee2e6;
    margin-top: 0.5rem;
  }

  .dropdown-item:hover {
    transform: none;
  }
}

/* Animation pour le dropdown */
.dropdown-menu {
  opacity: 0;
  transform: translateY(-10px);
  transition: all 0.3s ease;
  display: block;
  visibility: hidden;
}

.dropdown-menu.show {
  opacity: 1;
  transform: translateY(0);
  visibility: visible;
}
</style>

<!-- Form de déconnexion (caché) -->
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
  @csrf
</form>

<style>
/* Styles pour le menu profil */
.profile-avatar {
  width: 32px;
  height: 32px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  color: white;
  font-weight: bold;
  font-size: 14px;
  text-transform: uppercase;
}

.dropdown-menu {
  border: none;
  box-shadow: 0 10px 30px rgba(0,0,0,0.1);
  border-radius: 10px;
  padding: 0.5rem 0;
  min-width: 200px;
}

.dropdown-item {
  padding: 0.7rem 1.2rem;
  transition: all 0.3s ease;
  border: none;
}

.dropdown-item:hover {
  background-color: #f8f9fa;
  transform: translateX(5px);
}

.dropdown-item i {
  width: 20px;
  text-align: center;
}

.dropdown-divider {
  margin: 0.5rem 0;
}

/* Responsive */
@media (max-width: 991px) {
  .profile-avatar {
    display: none;
  }

  .dropdown-menu {
    position: static !important;
    transform: none !important;
    box-shadow: none;
    border: 1px solid #dee2e6;
    margin-top: 0.5rem;
  }

  .dropdown-item:hover {
    transform: none;
  }
}

/* Animation pour le dropdown */
.dropdown-menu {
  opacity: 0;
  transform: translateY(-10px);
  transition: all 0.3s ease;
  display: block;
  visibility: hidden;
}

.dropdown-menu.show {
  opacity: 1;
  transform: translateY(0);
  visibility: visible;
}
</style>
      </ul>
    </div>
  </div>
</nav>

<!-- Form de déconnexion (caché) -->
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
  @csrf
</form>

<style>
/* Styles pour le menu profil */
.profile-avatar {
  width: 32px;
  height: 32px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  color: white;
}

.dropdown-menu {
  border: none;
  box-shadow: 0 10px 30px rgba(0,0,0,0.1);
  border-radius: 10px;
  padding: 0.5rem 0;
  min-width: 200px;
}

.dropdown-item {
  padding: 0.7rem 1.2rem;
  transition: all 0.3s ease;
  border: none;
}

.dropdown-item:hover {
  background-color: #f8f9fa;
  transform: translateX(5px);
}

.dropdown-item i {
  width: 20px;
  text-align: center;
}

.dropdown-divider {
  margin: 0.5rem 0;
}

/* Responsive */
@media (max-width: 991px) {
  .profile-avatar {
    display: none;
  }

  .dropdown-menu {
    position: static !important;
    transform: none !important;
    box-shadow: none;
    border: 1px solid #dee2e6;
    margin-top: 0.5rem;
  }

  .dropdown-item:hover {
    transform: none;
  }
}

/* Animation pour le dropdown */
.dropdown-menu {
  opacity: 0;
  transform: translateY(-10px);
  transition: all 0.3s ease;
  display: block;
  visibility: hidden;
}

.dropdown-menu.show {
  opacity: 1;
  transform: translateY(0);
  visibility: visible;
}
</style>

<!-- Hero Section -->
<section id="home" class="hero-section">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-6">
        <div class="hero-content">
          <h1 class="hero-title">Construisons Ensemble l'Avenir de l'immobilier</h1>
          <p class="hero-subtitle">
           Profitez d'une plateforme dédier pour valoriser vos biens,trouver plus de clients et booster votre activité
          </p>
          <div class="hero-cta">
            <a href="#properties" class="btn-hero btn-primary-hero">
              <i class="fas fa-search"></i>Explorer nos biens
            </a>
            <a href="#contact" class="btn-hero btn-outline-hero">
              <i class="fas fa-phone"></i>Nous contacter
            </a>
          </div>
        </div>
      </div>
      <div class="col-lg-6 text-center">
        <img src="https://picsum.photos/600/500?random=house" alt="Villa de luxe" class="img-fluid rounded" style="border-radius: 20px; box-shadow: 0 20px 40px rgba(0,0,0,0.3);">
      </div>
    </div>
  </div>
</section>

<!-- Stats Section -->
<section class="stats-section">
  <div class="container">
    <div class="stats-container">
      <div class="row">
        <div class="col-lg-3 col-md-6">
          <div class="stat-item">
            <span class="stat-number">850+</span>
            <span class="stat-label">Propriétés Vendues</span>
          </div>
        </div>
        <div class="col-lg-3 col-md-6">
          <div class="stat-item">
            <span class="stat-number">320+</span>
            <span class="stat-label">Clients Satisfaits</span>
          </div>
        </div>
        <div class="col-lg-3 col-md-6">
          <div class="stat-item">
            <span class="stat-number">45+</span>
            <span class="stat-label">Villes Couvertes</span>
          </div>
        </div>
        <div class="col-lg-3 col-md-6">
          <div class="stat-item">
            <span class="stat-number">15+</span>
            <span class="stat-label">Années d'Expérience</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- About Section -->
<section id="about" class="about-section">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 mx-auto">
        <h2 class="section-title">Pourquoi Choisir VillaAgency ?</h2>
        <p class="section-subtitle">
          Notre expertise, notre réseau et notre passion pour l'immobilier font de nous le partenaire idéal pour tous vos projets
        </p>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-4 col-md-6">
        <div class="about-card">
          <div class="about-icon">
            <i class="fas fa-medal"></i>
          </div>
          <h5>15+ Années d'Expérience</h5>
          <p>Une expertise reconnue dans le marché immobilier avec un track record exceptionnel de transactions réussies.</p>
        </div>
      </div>

      <div class="col-lg-4 col-md-6">
        <div class="about-card">
          <div class="about-icon">
            <i class="fas fa-users"></i>
          </div>
          <h5>Équipe d'Experts</h5>
          <p>Des conseillers qualifiés et passionnés qui vous accompagnent à chaque étape de votre projet immobilier.</p>
        </div>
      </div>

      <div class="col-lg-4 col-md-6">
        <div class="about-card">
          <div class="about-icon">
            <i class="fas fa-map-marked-alt"></i>
          </div>
          <h5>Couverture Nationale</h5>
          <p>Un réseau étendu dans plus de 45 villes pour vous offrir le plus grand choix de propriétés.</p>
        </div>
      </div>

      <div class="col-lg-4 col-md-6">
        <div class="about-card">
          <div class="about-icon">
            <i class="fas fa-handshake"></i>
          </div>
          <h5>Service Personnalisé</h5>
          <p>Un accompagnement sur mesure adapté à vos besoins et à votre budget, du premier contact à la signature.</p>
        </div>
      </div>

      <div class="col-lg-4 col-md-6">
        <div class="about-card">
          <div class="about-icon">
            <i class="fas fa-shield-alt"></i>
          </div>
          <h5>Garantie Qualité</h5>
          <p>Toutes nos propriétés sont rigoureusement sélectionnées et vérifiées pour votre sécurité et satisfaction.</p>
        </div>
      </div>

      <div class="col-lg-4 col-md-6">
        <div class="about-card">
          <div class="about-icon">
            <i class="fas fa-clock"></i>
          </div>
          <h5>Disponibilité 24/7</h5>
          <p>Notre équipe est disponible à tout moment pour répondre à vos questions et vous assister dans vos démarches.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Properties Section -->

<section id="properties" class="properties-section">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 mx-auto text-center mb-5">
        <h2 class="section-title">Vos Propriétés </h2>
        <p class="section-subtitle">
          Découvrez votre biens immobiliers
        </p>
        <a class="btn btn-primary btn-lg" href="{{ route("Cproperty.agence") }}" >
        <i class="fas fa-plus me-2"></i>Publier un nouveau bien
        </a>

      </div>
    </div>

    <!-- Liste des propriétés (dynamique) -->
    <div class="row" wire:loading.remove>
      @forelse($properties as $property)
        <div class="col-lg-4 col-md-6">
          <div class="property-card">
            <div class="property-image" style="background-image: url('{{ $property->getFirstImage() }}')">
              <span class="property-badge">{{ ucfirst($property->transaction_type) }}</span>
              <div class="property-menu dropdown">
                <button class="btn" type="button" data-bs-toggle="dropdown">
                  <i class="fas fa-ellipsis-h"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                  <li><button class="dropdown-item" wire:click="edit({{ $property->id }})">
                    <i class="fas fa-edit me-2"></i>Modifier
                  </button></li>
                  <li><button class="dropdown-item" wire:click="confirmDelete({{ $property->id }})">
                    <i class="fas fa-trash me-2"></i>Supprimer
                  </button></li>
                  <li><button class="dropdown-item" onclick="showQuickView(@js($property->load('images')))">
                    <i class="fas fa-eye me-2"></i>Voir
                  </button></li>
                </ul>
              </div>
            </div>
            <div class="property-content">
              <h5 class="property-title">{{ $property->title }}</h5>
              <div class="property-price">{{ $property->getFormattedPrice() }}</div>
              <div class="property-address">
                <i class="fas fa-map-marker-alt"></i>
                {{ $property->getFullAddress() }}
              </div>
              @if($property->surface || $property->rooms)
                <div class="property-features mt-2">
                  @if($property->surface)
                    <small class="badge bg-light text-dark me-1">{{ $property->surface }}m²</small>
                  @endif
                  @if($property->rooms)
                    <small class="badge bg-light text-dark me-1">{{ $property->rooms }} pièces</small>
                  @endif
                  @if($property->parking)
                    <small class="badge bg-success">Parking</small>
                  @endif
                </div>
              @endif
            </div>
          </div>
        </div>
      @empty
        <div class="col-12 text-center">
          <div class="alert alert-info">
            <i class="fas fa-info-circle me-2"></i>
            Aucune propriété disponible pour le moment.
          </div>
        </div>
      @endforelse
    </div>

    <!-- Loading Spinner -->
    <div class="row" wire:loading>
      <div class="col-12 text-center py-5">
        <div class="spinner-border text-primary" role="status">
          <span class="visually-hidden">Chargement...</span>
        </div>
        <p class="mt-2">Chargement des propriétés...</p>
      </div>
    </div>
  </div>
</section>

{{-- <!-- Modal Création -->
<div class="modal fade" id="createPropertyModal" tabindex="-1" aria-hidden="true" wire:ignore.self>
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">
          <i class="fas fa-plus me-2"></i> Publier un nouveau bien
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <form wire:submit.prevent="save">
          <!-- Message d'erreurs globales -->
          @if ($errors->any())
            <div class="alert alert-danger">
              <ul class="mb-0">
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          <!-- Titre -->
          <div class="mb-3">
            <label class="form-label">
              <i class="fas fa-heading me-1 text-primary"></i> Titre du bien <span class="text-danger">*</span>
            </label>
            <input type="text" class="form-control @error('title') is-invalid @enderror"
                   placeholder="Ex: Villa luxueuse avec vue mer"
                   wire:model.defer="title" required>
            @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>

          <!-- Prix -->
          <div class="mb-3">
            <label class="form-label">
              <i class="fas fa-dollar-sign me-1 text-success"></i> Prix ($) <span class="text-danger">*</span>
            </label>
            <input type="number" class="form-control @error('price') is-invalid @enderror"
                   placeholder="450000"
                   wire:model.defer="price" required>
            @error('price') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>

          <!-- Description -->
          <div class="mb-3">
            <label class="form-label">
              <i class="fas fa-align-left me-1 text-info"></i> Description
            </label>
            <textarea class="form-control @error('description') is-invalid @enderror" rows="4"
                      placeholder="Décrivez votre propriété..."
                      wire:model.defer="description"></textarea>
            @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>

          <!-- Type & Transaction -->
          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label"><i class="fas fa-home me-1 text-warning"></i> Type</label>
              <select class="form-select @error('type') is-invalid @enderror" wire:model="type">
                <option value="appartement">Appartement</option>
                <option value="maison">Maison</option>
                <option value="terrain">Terrain</option>
              </select>
              @error('type') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label"><i class="fas fa-exchange-alt me-1 text-secondary"></i> Transaction</label>
              <select class="form-select @error('transaction_type') is-invalid @enderror" wire:model="transaction_type">
                <option value="vente">Vente</option>
                <option value="location">Location</option>
              </select>
              @error('transaction_type') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
          </div>

          <!-- Détails techniques -->
          <div class="row" @if($type === 'terrain') style="display:none;" @endif>
            <div class="col-md-4 mb-3">
              <label class="form-label"><i class="fas fa-ruler-combined me-1 text-muted"></i> Surface (m²)</label>
              <input type="number" class="form-control @error('surface') is-invalid @enderror"
                     wire:model.defer="surface" min="0">
              @error('surface') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="col-md-4 mb-3">
              <label class="form-label"><i class="fas fa-door-open me-1 text-muted"></i> Pièces</label>
              <input type="number" class="form-control @error('rooms') is-invalid @enderror"
                     wire:model.defer="rooms" min="0">
              @error('rooms') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="col-md-4 mb-3">
              <label class="form-label"><i class="fas fa-layer-group me-1 text-muted"></i> Étages</label>
              <input type="number" class="form-control @error('floors') is-invalid @enderror"
                     wire:model.defer="floors" min="0">
              @error('floors') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
          </div>

          <!-- Parking -->
          <div class="form-check form-switch mb-3" @if($type === 'terrain') style="display:none;" @endif>
            <input class="form-check-input" type="checkbox" role="switch" id="parkingSwitch" wire:model="parking">
            <label class="form-check-label" for="parkingSwitch"><i class="fas fa-parking me-1 text-primary"></i> Parking disponible</label>
          </div>

          <!-- Adresse -->
          <div class="mb-3">
            <label class="form-label"><i class="fas fa-map-marker-alt me-1 text-danger"></i> Adresse</label>
            <input type="text" class="form-control @error('address') is-invalid @enderror" wire:model.defer="address">
            @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>

          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label"><i class="fas fa-city me-1 text-secondary"></i> Ville</label>
              <input type="text" class="form-control @error('city') is-invalid @enderror" wire:model.defer="city">
              @error('city') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label"><i class="fas fa-flag me-1 text-dark"></i> Pays</label>
              <input type="text" class="form-control @error('country') is-invalid @enderror" wire:model.defer="country">
              @error('country') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
          </div>

          <!-- Images -->
          <div class="mb-3">
            <label class="form-label"><i class="fas fa-images me-1 text-success"></i> Images (max {{ $maxFiles }})</label>
            <input type="file" class="form-control @error('images.*') is-invalid @enderror"
                   wire:model="images" multiple accept="image/*">
            @error('images.*') <div class="invalid-feedback">{{ $message }}</div> @enderror

            <!-- Preview -->
            @if($images)
              <div class="mt-2 d-flex flex-wrap gap-2">
                @foreach($images as $index => $img)
                  <div class="position-relative">
                    <img src="{{ $img->temporaryUrl() }}" class="img-thumbnail rounded shadow" width="100" height="100" style="object-fit: cover;">
                    <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0 rounded-circle"
                            wire:click="removeTempImage({{ $index }})" style="width: 20px; height: 20px; padding: 0; font-size: 12px;">
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                @endforeach
              </div>
            @endif
          </div>

          <!-- Bouton submit -->
          <button type="submit" class="btn btn-success w-100" wire:loading.attr="disabled" wire:target="save">
            <span wire:loading.remove wire:target="save">
              <i class="fas fa-upload me-2"></i> Publier la propriété
            </span>
            <span wire:loading wire:target="save">
              <i class="fas fa-spinner fa-spin me-2"></i> Publication en cours...
            </span>
          </button>
        </form>
      </div>
    </div>
  </div>
</div> --}}


<!-- Modal Edit -->
<div class="modal fade" id="editPropertyModal" tabindex="-1" aria-hidden="true" wire:ignore.self>
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><i class="fas fa-edit me-2"></i>Modifier le bien</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        @if($editingProperty)
        <form wire:submit.prevent="update">
          <!-- Même structure que le formulaire de création -->
          <div class="mb-3">
            <label class="form-label">Titre du bien <span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" wire:model="title" required>
            @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>

          <div class="mb-3">
            <label class="form-label">Prix ($) <span class="text-danger">*</span></label>
            <input type="number" class="form-control @error('price') is-invalid @enderror" wire:model="price" required>
            @error('price') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>

          <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea class="form-control @error('description') is-invalid @enderror" rows="4" wire:model="description"></textarea>
            @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>

          <!-- Images existantes -->
          @if($editingProperty->images->count() > 0)
            <div class="mb-3">
              <label class="form-label">Images actuelles</label>
              <div class="d-flex flex-wrap gap-2 mb-2">
                @foreach($editingProperty->images as $image)
                  <img src="{{ asset('storage/' . $image->image_path) }}" class="img-thumbnail" width="100" height="100" style="object-fit: cover;">
                @endforeach
              </div>
            </div>
          @endif

          <!-- Nouvelles images -->
          <div class="mb-3">
            <label class="form-label">Nouvelles images (optionnel)</label>
            <input type="file" class="form-control @error('images.*') is-invalid @enderror"
                   wire:model="images" multiple accept="image/*">
            <small class="form-text text-muted">Laisser vide pour conserver les images actuelles</small>
            @error('images.*') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>

          <button type="submit" class="btn btn-success w-100" wire:loading.attr="disabled">
            <span wire:loading.remove><i class="fas fa-save me-2"></i>Enregistrer les modifications</span>
            <span wire:loading><i class="fas fa-spinner fa-spin me-2"></i>Sauvegarde...</span>
          </button>
        </form>
        @endif
      </div>
    </div>
  </div>
</div>

<!-- Modal Delete -->
<div class="modal fade" id="deletePropertyModal" tabindex="-1" aria-hidden="true" wire:ignore.self>
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title"><i class="fas fa-exclamation-triangle me-2"></i>Supprimer le bien</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
        @if($deletingProperty)
          <div class="mb-3">
            <i class="fas fa-trash-alt text-danger" style="font-size: 3rem;"></i>
          </div>
          <h6 class="mb-3">Êtes-vous sûr de vouloir supprimer ce bien ?</h6>
          <p class="text-muted mb-4">
            "<strong>{{ $deletingProperty->title }}</strong>"<br>
            <small>Cette action est irréversible et supprimera toutes les images associées.</small>
          </p>
          <div class="d-flex gap-2 justify-content-center">
            <button type="button" class="btn btn-danger" wire:click="delete" wire:loading.attr="disabled">
              <span wire:loading.remove><i class="fas fa-trash me-2"></i>Supprimer définitivement</span>
              <span wire:loading><i class="fas fa-spinner fa-spin me-2"></i>Suppression...</span>
            </button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
              <i class="fas fa-times me-2"></i>Annuler
            </button>
          </div>
        @endif
      </div>
    </div>
  </div>
</div>

<!-- Modal Quick View -->
<div class="modal fade" id="quickViewModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><i class="fas fa-eye me-2"></i>Détails du bien</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <img src="" class="img-fluid mb-3 rounded" id="quickViewImage" style="width: 100%; height: 300px; object-fit: cover;">
        <div class="row">
          <div class="col-md-6">
            <h6><i class="fas fa-dollar-sign me-2 text-success"></i>Prix</h6>
            <p id="quickViewPrice" class="h4 text-primary"></p>
          </div>
          <div class="col-md-6">
            <h6><i class="fas fa-map-marker-alt me-2 text-danger"></i>Adresse</h6>
            <p id="quickViewAddress" class="text-muted"></p>
          </div>
        </div>
        <div id="quickViewDescription" class="mt-3"></div>
      </div>
    </div>
  </div>
</div>

<!-- Scripts pour les événements Livewire -->
@script
<script>
// Fonction pour la vue rapide
function showQuickView(property) {
    document.getElementById('quickViewModal').querySelector('.modal-title').innerHTML =
        '<i class="fas fa-eye me-2"></i>' + property.title;

    // Utiliser la première image ou une image par défaut
    const firstImage = property.images && property.images.length > 0
        ? '/storage/' + property.images[0].image_path
        : 'https://picsum.photos/600/400?random=' + property.id;

    document.getElementById('quickViewImage').src = firstImage;
    document.getElementById('quickViewPrice').textContent = parseInt(property.price).toLocaleString() + ' $';


    const address = [property.address, property.city, property.country].filter(Boolean).join(', ') || 'Adresse non spécifiée';
    document.getElementById('quickViewAddress').textContent = address;

    document.getElementById('quickViewDescription').innerHTML = '<p>' + (property.description || 'Aucune description disponible.') + '</p>';

    var modal = new bootstrap.Modal(document.getElementById('quickViewModal'));
    modal.show();
}

// Écouter les événements Livewire
$wire.on('close-modal', function() {
    // Fermer tous les modals ouverts
    document.querySelectorAll('.modal').forEach(modal => {
        let modalInstance = bootstrap.Modal.getInstance(modal);
        if (modalInstance) {
            modalInstance.hide();
        }
    });
});

$wire.on('open-modal', function(data) {
    var modal = new bootstrap.Modal(document.getElementById(data[0].modal));
    modal.show();
});

$wire.on('show-toast', function(data) {
    const notyf = new Notyf({
        duration: 5000,
        position: { x: 'right', y: 'top' },
        dismissible: true
    });

    if (data[0].type === 'success') {
        notyf.success(data[0].message);
    } else {
        notyf.error(data[0].message);
    }
});

// Réinitialiser l'état de chargement à l'ouverture du modal
document.addEventListener('DOMContentLoaded', function() {
    // Écouter l'ouverture du modal de création
    var createModal = document.getElementById('createPropertyModal');
    if (createModal) {
        createModal.addEventListener('shown.bs.modal', function () {
            // Forcer le bouton à revenir à l'état normal
            const submitBtn = createModal.querySelector('button[type="submit"]');
            if (submitBtn) {
                submitBtn.removeAttribute('disabled');
                // Cacher l'état loading et montrer l'état normal
                const loadingDiv = submitBtn.querySelector('[wire\\:loading][wire\\:target="save"]');
                const normalDiv = submitBtn.querySelector('[wire\\:loading\\.remove][wire\\:target="save"]');

                if (loadingDiv) {
                    loadingDiv.style.display = 'none';
                }
                if (normalDiv) {
                    normalDiv.style.display = 'block';
                }

                // Remettre le contenu original si nécessaire
                if (!normalDiv && !loadingDiv) {
                    submitBtn.innerHTML = '<i class="fas fa-upload me-2"></i> Publier la propriété';
                }
            }
        });

        // Aussi à l'ouverture (show)
        createModal.addEventListener('show.bs.modal', function () {
            setTimeout(() => {
                const submitBtn = createModal.querySelector('button[type="submit"]');
                if (submitBtn) {
                    submitBtn.removeAttribute('disabled');
                }
            }, 100);
        });
    }

    // Charger les propriétés après le chargement de la page
    if (typeof $wire !== 'undefined') {
        $wire.call('loadPropertiesData');
    }
});
</script>
@endscript

<!-- Bootstrap Bundle JS -->
<script src="{{ asset("assets/bootstrap/js/bootstrap.bundle.min.js") }}"></script>
<script src="{{ asset("assets/js/all.min.js") }}"></script>
<script src="{{ asset("assets/notyf/notyf.min.js") }}"></script>
<script src="{{ asset("assets/js/sweetalert2.min.js") }}"></script>

<script>
// Navigation scroll effect
window.addEventListener('scroll', function() {
  const navbar = document.querySelector('.navbar');
  if (window.scrollY > 50) {
    navbar.classList.add('scrolled');
  } else {
    navbar.classList.remove('scrolled');
  }
});

// QuickView functionality
document.querySelectorAll('.dropdown-item[data-bs-target="#quickViewModal"]').forEach(btn => {
  btn.addEventListener('click', (e) => {
    const propertyCard = e.target.closest('.property-card');
    const title = propertyCard.querySelector('.property-title').textContent;
    const price = propertyCard.querySelector('.property-price').textContent;
    const address = propertyCard.querySelector('.property-address').textContent.trim();
    const imageUrl = propertyCard.querySelector('.property-image').style.backgroundImage.slice(5, -2);

    document.getElementById('quickViewModal').querySelector('.modal-title').innerHTML =
      '<i class="fas fa-eye me-2"></i>' + title;
    document.getElementById('quickViewImage').src = imageUrl;
    document.getElementById('quickViewPrice').textContent = price;
    document.getElementById('quickViewAddress').textContent = address;
  });
});

// Smooth scrolling for navigation links
document.querySelectorAll('.nav-link, .btn-hero').forEach(link => {
  link.addEventListener('click', function(e) {
    const href = this.getAttribute('href');
    if (href && href.startsWith('#')) {
      e.preventDefault();
      const target = document.querySelector(href);
      if (target) {
        const offsetTop = target.offsetTop - 80;
        window.scrollTo({
          top: offsetTop,
          behavior: 'smooth'
        });
      }
    }
  });
});

// Active navigation link update
window.addEventListener('scroll', function() {
  const sections = document.querySelectorAll('section');
  const navLinks = document.querySelectorAll('.nav-link');

  let current = '';
  sections.forEach(section => {
    const sectionTop = section.offsetTop - 100;
    if (pageYOffset >= sectionTop) {
      current = section.getAttribute('id');
    }
  });

  navLinks.forEach(link => {
    link.classList.remove('active');
    if (link.getAttribute('href') === '#' + current) {
      link.classList.add('active');
    }
  });
});

// Form submissions
// document.querySelectorAll('form').forEach(form => {
//   form.addEventListener('submit', function(e) {
//     e.preventDefault();
//     alert('Fonctionnalité à implémenter !');
//   });
});
</script>

</body>
</html>

</main>
