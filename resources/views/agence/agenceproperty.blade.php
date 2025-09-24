<!DOCTYPE html>
<html lang="fr">

<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Publier un Bien - VillaAgency</title>

<!-- Bootstrap 5 CDN -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">

<!-- FontAwesome CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<!-- Notyf for notifications -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/notyf/3.10.0/notyf.min.css" rel="stylesheet">

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
  padding-top: 100px;
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

<!-- Navigation -->
<nav class="navbar navbar-expand-lg fixed-top">
  <div class="container d-flex">
    <a href="/" class="navbar-brand logo">
      <img src="{{ asset('assets/images/Logo/image.png') }}" alt="logo">
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link" href="/">Accueil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/#about">À Propos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/#properties">Biens</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/#testimonials">Témoignages</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/#contact">Contact</a>
        </li>
        <!-- Menu Profil -->
        <li class="nav-item dropdown">
          <a class="nav-link d-flex align-items-center profile-dropdown" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <div class="profile-avatar me-2">
              JD
            </div>
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
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
            <li><hr class="dropdown-divider"></li>
            <li>
              <a class="dropdown-item text-danger" href="#" onclick="handleLogout()">
                <i class="fas fa-sign-out-alt me-2"></i>Déconnexion
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- Page Header -->
<section class="page-header">
  <div class="container">
    <div class="page-header-content">
      <h1 class="page-title">Publier un Nouveau Bien</h1>
      <p class="page-subtitle">Créez une annonce attractive pour votre propriété</p>
    </div>
  </div>
</section>

<!-- Main Content -->
<div class="container create-property-container">
  <div class="row justify-content-center">
    <div class="col-lg-10">

      <!-- Formulaire -->
      <div class="property-form-card">
        <form id="propertyForm">

          <!-- Informations Générales -->
          <div class="form-section">
            <h3 class="section-title">
              <i class="fas fa-info-circle"></i>
              Informations Générales
            </h3>

            <div class="row">
              <div class="col-md-8 mb-3">
                <label class="form-label">
                  <i class="fas fa-heading text-primary"></i>
                  Titre du bien <span class="required">*</span>
                </label>
                <input type="text" class="form-control" name="title" placeholder="Ex: Villa luxueuse avec vue mer" required>
                <div class="invalid-feedback">Veuillez saisir un titre pour votre bien.</div>
              </div>

              <div class="col-md-4 mb-3">
                <label class="form-label">
                  <i class="fas fa-dollar-sign text-success"></i>
                  Prix ($) <span class="required">*</span>
                </label>
                <input type="number" class="form-control" name="price" placeholder="450000" required>
                <div class="invalid-feedback">Veuillez saisir un prix valide.</div>
              </div>
            </div>

            <div class="mb-3">
              <label class="form-label">
                <i class="fas fa-align-left text-info"></i>
                Description
              </label>
              <textarea class="form-control" name="description" rows="4" placeholder="Décrivez votre propriété en détail..."></textarea>
            </div>
          </div>

          <!-- Type et Transaction -->
          <div class="form-section">
            <h3 class="section-title">
              <i class="fas fa-tags"></i>
              Type et Transaction
            </h3>

            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label">
                  <i class="fas fa-home text-warning"></i>
                  Type de bien
                </label>
                <select class="form-select" name="type" id="propertyType">
                  <option value="appartement">Appartement</option>
                  <option value="maison">Maison</option>
                  <option value="terrain">Terrain</option>
                </select>
              </div>

              <div class="col-md-6 mb-3">
                <label class="form-label">
                  <i class="fas fa-exchange-alt text-secondary"></i>
                  Type de transaction
                </label>
                <select class="form-select" name="transaction_type">
                  <option value="vente">Vente</option>
                  <option value="location">Location</option>
                </select>
              </div>
            </div>
          </div>

          <!-- Caractéristiques -->
          <div class="form-section" id="characteristicsSection">
            <h3 class="section-title">
              <i class="fas fa-ruler-combined"></i>
              Caractéristiques
            </h3>

            <div class="row">
              <div class="col-md-4 mb-3">
                <label class="form-label">
                  <i class="fas fa-expand-arrows-alt text-muted"></i>
                  Surface (m²)
                </label>
                <input type="number" class="form-control" name="surface" min="0" placeholder="150">
              </div>

              <div class="col-md-4 mb-3">
                <label class="form-label">
                  <i class="fas fa-door-open text-muted"></i>
                  Nombre de pièces
                </label>
                <input type="number" class="form-control" name="rooms" min="0" placeholder="5">
              </div>

              <div class="col-md-4 mb-3">
                <label class="form-label">
                  <i class="fas fa-layer-group text-muted"></i>
                  Nombre d'étages
                </label>
                <input type="number" class="form-control" name="floors" min="0" placeholder="2">
              </div>
            </div>

            <!-- Parking Switch -->
            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" role="switch" id="parkingSwitch" name="parking">
              <label class="form-check-label" for="parkingSwitch">
                <i class="fas fa-parking text-primary"></i>
                Parking disponible
              </label>
            </div>
          </div>

          <!-- Localisation -->
          <div class="form-section">
            <h3 class="section-title">
              <i class="fas fa-map-marker-alt"></i>
              Localisation
            </h3>

            <div class="mb-3">
              <label class="form-label">
                <i class="fas fa-road text-danger"></i>
                Adresse complète
              </label>
              <input type="text" class="form-control" name="address" placeholder="123 Rue de la Paix">
            </div>

            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label">
                  <i class="fas fa-city text-secondary"></i>
                  Ville
                </label>
                <input type="text" class="form-control" name="city" placeholder="Paris">
              </div>

              <div class="col-md-6 mb-3">
                <label class="form-label">
                  <i class="fas fa-flag text-dark"></i>
                  Pays
                </label>
                <input type="text" class="form-control" name="country" placeholder="France" value="France">
              </div>
            </div>
          </div>

          <!-- Images -->
          <div class="form-section">
            <h3 class="section-title">
              <i class="fas fa-images"></i>
              Images du bien
            </h3>

            <div class="image-upload-zone" id="imageUploadZone">
              <div class="upload-icon">
                <i class="fas fa-cloud-upload-alt"></i>
              </div>
              <h5>Glissez vos images ici ou cliquez pour sélectionner</h5>
              <p class="text-muted mb-3">Formats acceptés: JPG, PNG, WEBP (max 5MB par image)</p>
              <input type="file" class="form-control d-none" id="imageInput" name="images[]" multiple accept="image/*">
              <button type="button" class="btn btn-primary" onclick="document.getElementById('imageInput').click()">
                <i class="fas fa-plus me-2"></i>Sélectionner des images
              </button>
            </div>

            <div class="image-preview-grid" id="imagePreviewGrid">
              <!-- Les images preview seront ajoutées ici dynamiquement -->
            </div>
          </div>

          <!-- Boutons -->
          <div class="d-flex gap-3 justify-content-end">
            <a href="/" class="btn btn-secondary btn-lg">
              <i class="fas fa-times me-2"></i>Annuler
            </a>
            <button type="submit" class="btn btn-primary btn-lg">
              <i class="fas fa-upload me-2"></i>Publier la propriété
            </button>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>

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

<!-- Scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/notyf/3.10.0/notyf.min.js"></script>

<script>
// Notification system
const notyf = new Notyf({
  duration: 5000,
  position: { x: 'right', y: 'top' },
  dismissible: true
});

// Variables globales
let selectedImages = [];
const maxImages = 10;

// Gestion du type de propriété
document.getElementById('propertyType').addEventListener('change', function() {
  const characteristicsSection = document.getElementById('characteristicsSection');
  if (this.value === 'terrain') {
    characteristicsSection.style.opacity = '0.5';
    characteristicsSection.querySelectorAll('input, .form-check-input').forEach(input => {
      input.disabled = true;
    });
  } else {
    characteristicsSection.style.opacity = '1';
    characteristicsSection.querySelectorAll('input, .form-check-input').forEach(input => {
      input.disabled = false;
    });
  }
});

// Gestion de l'upload d'images
const imageUploadZone = document.getElementById('imageUploadZone');
const imageInput = document.getElementById('imageInput');
const imagePreviewGrid = document.getElementById('imagePreviewGrid');

// Drag and drop
imageUploadZone.addEventListener('dragover', (e) => {
  e.preventDefault();
  imageUploadZone.classList.add('dragover');
});

imageUploadZone.addEventListener('dragleave', (e) => {
  e.preventDefault();
  imageUploadZone.classList.remove('dragover');
});

imageUploadZone.addEventListener('drop', (e) => {
  e.preventDefault();
  imageUploadZone.classList.remove('dragover');

  const files = Array.from(e.dataTransfer.files);
  handleImageSelection(files);
});

// Click sur la zone
imageUploadZone.addEventListener('click', (e) => {
  if (e.target === imageUploadZone || e.target.closest('.upload-icon, h5, p')) {
    imageInput.click();
  }
});

// Selection via input
imageInput.addEventListener('change', (e) => {
  const files = Array.from(e.target.files);
  handleImageSelection(files);
});

// Fonction de gestion des images
function handleImageSelection(files) {
  const validFiles = files.filter(file => {
    if (!file.type.startsWith('image/')) {
      notyf.error(`${file.name} n'est pas une image valide`);
      return false;
    }
    if (file.size > 5 * 1024 * 1024) { // 5MB
      notyf.error(`${file.name} est trop volumineux (max 5MB)`);
      return false;
    }
    return true;
  });

  if (selectedImages.length + validFiles.length > maxImages) {
    notyf.error(`Vous ne pouvez sélectionner que ${maxImages} images maximum`);
    return;
  }

  validFiles.forEach(file => {
    const reader = new FileReader();
    reader.onload = (e) => {
      const imageData = {
        file: file,
        url: e.target.result,
        id: Date.now() + Math.random()
      };
      selectedImages.push(imageData);
      displayImagePreview(imageData);
    };
    reader.readAsDataURL(file);
  });

  updateImageInput();
}

function displayImagePreview(imageData) {
  const previewItem = document.createElement('div');
  previewItem.className = 'image-preview-item';
  previewItem.dataset.id = imageData.id;

  previewItem.innerHTML = `
    <img src="${imageData.url}" alt="Preview">
    <button type="button" class="remove-image-btn" onclick="removeImage('${imageData.id}')">
      <i class="fas fa-times"></i>
    </button>
  `;

  imagePreviewGrid.appendChild(previewItem);
}

function removeImage(imageId) {
  selectedImages = selectedImages.filter(img => img.id != imageId);
  const previewItem = document.querySelector(`[data-id="${imageId}"]`);
  if (previewItem) {
    previewItem.remove();
  }
  updateImageInput();
}

function updateImageInput() {
  // Créer un nouveau DataTransfer pour mettre à jour l'input file
  const dt = new DataTransfer();
  selectedImages.forEach(img => {
    dt.items.add(img.file);
  });
  imageInput.files = dt.files;
}

// Validation du formulaire
function validateForm(formData) {
  const errors = [];

  if (!formData.get('title') || formData.get('title').trim() === '') {
    errors.push('Le titre est requis');
  }

  if (!formData.get('price') || parseFloat(formData.get('price')) <= 0) {
    errors.push('Le prix doit être supérieur à 0');
  }

  return errors;
}

// Soumission du formulaire
document.getElementById('propertyForm').addEventListener('submit', async function(e) {
  e.preventDefault();

  const formData = new FormData(this);
  const errors = validateForm(formData);

  if (errors.length > 0) {
    errors.forEach(error => notyf.error(error));
    return;
  }

  // Simulation d'envoi
  const submitButton = this.querySelector('button[type="submit"]');
  const originalText = submitButton.innerHTML;

  submitButton.disabled = true;
  submitButton.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Publication en cours...';

  try {
    // Simulation d'une requête AJAX
    await new Promise(resolve => setTimeout(resolve, 2000));

    notyf.success('Propriété publiée avec succès !');

    // Redirection vers la page d'accueil après 2 secondes
    setTimeout(() => {
      window.location.href = '/';
    }, 2000);

  } catch (error) {
    notyf.error('Erreur lors de la publication. Veuillez réessayer.');
    submitButton.disabled = false;
    submitButton.innerHTML = originalText;
  }
});

// Fonction de déconnexion
function handleLogout() {
  if (confirm('Êtes-vous sûr de vouloir vous déconnecter ?')) {
    notyf.success('Déconnexion réussie');
    setTimeout(() => {
      window.location.href = '/login';
    }, 1500);
  }
}

// Animation du navbar au scroll
window.addEventListener('scroll', function() {
  const navbar = document.querySelector('.navbar');
  if (window.scrollY > 50) {
    navbar.style.background = 'rgba(255, 255, 255, 0.95) !important';
    navbar.style.backdropFilter = 'blur(10px)';
  } else {
    navbar.style.background = 'var(--white) !important';
    navbar.style.backdropFilter = 'none';
  }
});

// Smooth scrolling pour les liens d'ancrage
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
  anchor.addEventListener('click', function (e) {
    e.preventDefault();
    const target = document.querySelector(this.getAttribute('href'));
    if (target) {
      target.scrollIntoView({
        behavior: 'smooth',
        block: 'start'
      });
    }
  });
});

// Animation au chargement de la page
document.addEventListener('DOMContentLoaded', function() {
  // Fade in des éléments
  const elements = document.querySelectorAll('.property-form-card, .form-section');
  elements.forEach((element, index) => {
    element.style.opacity = '0';
    element.style.transform = 'translateY(30px)';

    setTimeout(() => {
      element.style.transition = 'all 0.6s ease';
      element.style.opacity = '1';
      element.style.transform = 'translateY(0)';
    }, index * 100);
  });

  // Message de bienvenue
  setTimeout(() => {
    notyf.success('Bienvenue ! Remplissez le formulaire pour publier votre bien.');
  }, 1000);
});

// Sauvegarde automatique dans le localStorage (optionnel)
function saveFormData() {
  const formData = new FormData(document.getElementById('propertyForm'));
  const data = {};
  for (let [key, value] of formData.entries()) {
    data[key] = value;
  }
  localStorage.setItem('propertyFormData', JSON.stringify(data));
}

// Restaurer les données du formulaire
function restoreFormData() {
  const savedData = localStorage.getItem('propertyFormData');
  if (savedData) {
    const data = JSON.parse(savedData);
    const form = document.getElementById('propertyForm');

    Object.keys(data).forEach(key => {
      const input = form.querySelector(`[name="${key}"]`);
      if (input && input.type !== 'file') {
        if (input.type === 'checkbox') {
          input.checked = data[key] === 'on';
        } else {
          input.value = data[key];
        }
      }
    });
  }
}

// Sauvegarder à chaque modification
document.getElementById('propertyForm').addEventListener('input', saveFormData);

// Restaurer au chargement
// restoreFormData(); // Décommentez si vous voulez cette fonctionnalité
