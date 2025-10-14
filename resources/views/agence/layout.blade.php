<!DOCTYPE html>
<html lang="fr">

<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Publier un Bien - VillaAgency</title>
@livewireStyles
<!-- Bootstrap 5 CDN -->
<link href="{{ asset("assets/bootstrap/css/bootstrap.min.css") }}" rel="stylesheet">

<!-- FontAwesome CDN -->
<link rel="stylesheet" href="{{ asset("assets/css/all.min.css") }}">

<!-- Notyf for notifications -->
<link href="{{ asset("assets/notyf/notyf.min.css") }}" rel="stylesheet">

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
  /* padding-top: 100px; */
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

/* Main Container */
.create-property-container {
  padding: 2rem 0 4rem;
}

.page-header {
  background: linear-gradient(135deg, var(--dark-black) 0%, #2d2d2d 100%);
  color: var(--white);
  padding: 3rem 0;
  margin-bottom: 3rem;
  position: relative;
  overflow: hidden;
}

.page-header::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: radial-gradient(circle at 50% 50%, rgba(255,107,53,0.2) 0%, transparent 60%);
}

.page-header-content {
  position: relative;
  z-index: 2;
  text-align: center;
}

.page-title {
  font-size: 2.5rem;
  font-weight: 800;
  margin-bottom: 1rem;
  background: var(--gradient);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}

.page-subtitle {
  font-size: 1.1rem;
  color: #cccccc;
  margin-bottom: 0;
}

/* Form Styles */
.property-form-card {
  background: var(--white);
  border-radius: 20px;
  box-shadow: 0 10px 30px rgba(0,0,0,0.1);
  padding: 2rem;
  margin-bottom: 2rem;
}

.form-section {
  margin-bottom: 2rem;
  padding-bottom: 2rem;
  border-bottom: 1px solid #eee;
}

.form-section:last-child {
  border-bottom: none;
  margin-bottom: 0;
}

.section-title {
  font-size: 1.3rem;
  font-weight: 700;
  color: var(--dark-black);
  margin-bottom: 1.5rem;
  display: flex;
  align-items: center;
  gap: 10px;
}

.section-title i {
  color: var(--primary-orange);
  font-size: 1.1rem;
}

.form-control {
  border-radius: 10px;
  border: 2px solid #eee;
  padding: 12px 15px;
  transition: all 0.3s ease;
  font-size: 0.95rem;
}

.form-control:focus {
  border-color: var(--primary-orange);
  box-shadow: 0 0 0 0.2rem rgba(255, 107, 53, 0.25);
}

.form-select {
  border-radius: 10px;
  border: 2px solid #eee;
  padding: 12px 15px;
  transition: all 0.3s ease;
}

.form-select:focus {
  border-color: var(--primary-orange);
  box-shadow: 0 0 0 0.2rem rgba(255, 107, 53, 0.25);
}

.form-label {
  font-weight: 600;
  color: var(--dark-black);
  margin-bottom: 0.5rem;
  display: flex;
  align-items: center;
  gap: 8px;
}

.form-label i {
  font-size: 0.9rem;
}

.required {
  color: #dc3545;
}

/* Switch Styles */
.form-check-input:checked {
  background-color: var(--primary-orange);
  border-color: var(--primary-orange);
}

.form-check-input:focus {
  box-shadow: 0 0 0 0.2rem rgba(255, 107, 53, 0.25);
}

.form-check-label {
  font-weight: 500;
  display: flex;
  align-items: center;
  gap: 8px;
}

/* Image Upload */
.image-upload-zone {
  border: 2px dashed #ddd;
  border-radius: 10px;
  padding: 2rem;
  text-align: center;
  transition: all 0.3s ease;
  background: #fafafa;
}

.image-upload-zone:hover {
  border-color: var(--primary-orange);
  background: rgba(255, 107, 53, 0.05);
}

.image-upload-zone.dragover {
  border-color: var(--primary-orange);
  background: rgba(255, 107, 53, 0.1);
}

.upload-icon {
  font-size: 3rem;
  color: #ccc;
  margin-bottom: 1rem;
}

.image-preview-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
  gap: 15px;
  margin-top: 20px;
}

.image-preview-item {
  position: relative;
  border-radius: 10px;
  overflow: hidden;
  box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.image-preview-item img {
  width: 100%;
  height: 120px;
  object-fit: cover;
  transition: transform 0.3s ease;
}

.image-preview-item:hover img {
  transform: scale(1.05);
}

.remove-image-btn {
  position: absolute;
  top: 5px;
  right: 5px;
  background: rgba(220, 53, 69, 0.9);
  color: white;
  border: none;
  border-radius: 50%;
  width: 25px;
  height: 25px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 12px;
  cursor: pointer;
  transition: all 0.3s ease;
}

.remove-image-btn:hover {
  background: #dc3545;
  transform: scale(1.1);
}

/* Buttons */
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

.btn-secondary {
  background: #6c757d;
  border: none;
  color: white;
  font-weight: 600;
  padding: 12px 30px;
  border-radius: 25px;
  transition: all 0.3s ease;
}

.btn-secondary:hover {
  background: #5a6268;
  transform: translateY(-2px);
  color: white;
}

.btn-lg {
  padding: 15px 40px;
  font-size: 1.1rem;
}

/* Alerts */
.alert {
  border-radius: 10px;
  border: none;
  padding: 1rem 1.5rem;
}

.alert-danger {
  background: rgba(220, 53, 69, 0.1);
  color: #721c24;
  border-left: 4px solid #dc3545;
}

.alert-success {
  background: rgba(25, 135, 84, 0.1);
  color: #0f5132;
  border-left: 4px solid #198754;
}

/* Footer */
.footer {
  background: var(--dark-black);
  color: var(--white);
  padding: 3rem 0 1rem;
  margin-top: 4rem;
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

/* Responsive */
@media (max-width: 768px) {
  .page-title {
    font-size: 2rem;
  }

  .property-form-card {
    padding: 1.5rem;
  }

  .image-preview-grid {
    grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
  }
}

/* Profile Avatar Styles */
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

.logo img {
  height: 68px;
  width: auto;
  object-fit: contain;
  margin-left: -75px;
}
</style>
</head>

<body>
    @yield("body")


    <!-- Footer -->
<footer class="footer">
  <div class="container">
    <div class="row">
      <div class="col-lg-4 mb-4">
        <div class="footer-section">
          <h5><i class="fas fa-home me-2"></i>VillaAgency</h5>
          <p>Votre partenaire de confiance pour tous vos projets immobiliers. Une expertise reconnue depuis plus de 15 ans.</p>
        </div>
      </div>
      <div class="col-lg-2 col-md-6 mb-4">
        <div class="footer-section">
          <h5>Navigation</h5>
          <ul>
            <li><a href="/">Accueil</a></li>
            <li><a href="/#about">À Propos</a></li>
            <li><a href="/#properties">Biens</a></li>
            <li><a href="/#contact">Contact</a></li>
          </ul>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 mb-4">
        <div class="footer-section">
          <h5>Services</h5>
          <ul>
            <li><a href="#">Vente</a></li>
            <li><a href="#">Location</a></li>
            <li><a href="#">Estimation</a></li>
            <li><a href="#">Gestion</a></li>
          </ul>
        </div>
      </div>
      <div class="col-lg-3 mb-4">
        <div class="footer-section">
          <h5>Contact</h5>
          <ul>
            <li><i class="fas fa-phone me-2"></i>+33 1 23 45 67 89</li>
            <li><i class="fas fa-envelope me-2"></i>contact@villaagency.fr</li>
            <li><i class="fas fa-map-marker-alt me-2"></i>123 Avenue des Champs</li>
          </ul>
        </div>
      </div>
    </div>
    <div class="footer-bottom">
      <div class="row align-items-center">
        <div class="col-md-6">
          <p>&copy; 2024 VillaAgency. Tous droits réservés.</p>
        </div>
        <div class="col-md-6">
          <div class="social-links">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-linkedin-in"></i></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</footer>
@livewireScripts
<!-- Scripts -->
<script src="{{ asset("assets/bootstrap/js/bootstrap.bundle.min.js") }}"></script>
<script src="{{ asset("assets/notyf/notyf.min.js") }}"></script>
<script src="{{ asset("assets/js/all.min.js") }}"></script>

<script>
// Notification system
const notyf = new Notyf({
  duration: 5000,
  position: { x: 'right', y: 'top' },
  dismissible: true
});

