@extends("layouts.app")
@php
$pageTitle ="IMMO | Details"
@endphp
@section("body")
  <div class="page-heading header-text">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <span class="breadcrumb"><a href="#">Home</a>  /  Single Property</span>
          <h3>Single Property</h3>
        </div>
      </div>
    </div>
  </div>

  <div class="single-property section">
    <div class="container">
      <div class="row">
        <div class="col-lg-8">
          <div class="main-image">
            <img src="assets/images/single-property.jpg" alt="">
          </div>
          <div class="main-content">
            <span class="category">Apparment</span>
            <h4>24 New Street Miami, OR 24560</h4>
            <p>Get <strong>the best villa agency</strong> Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat delectus exercitationem omnis hic, nisi vitae vel quidem blanditiis adipisci! Tenetur dolorem saepe atque nobis nisi sunt fugit excepturi sapiente doloribus!</p>
          </div>
          <!-- Accordions -->
          <div class="accordion" id="accordionExample">
            <!-- ... ton contenu existant ... -->
          </div>
        </div>

        <div class="col-lg-4">
          <div class="info-table mb-4">
            <ul>
              <li>
                <img src="assets/images/info-icon-01.png" alt="" style="max-width: 52px;">
                <h4>450 m2<br><span>Total Flat Space</span></h4>
              </li>
              <li>
                <img src="assets/images/info-icon-02.png" alt="" style="max-width: 52px;">
                <h4>Contract<br><span>Contract Ready</span></h4>
              </li>
              <li>
                <img src="assets/images/info-icon-03.png" alt="" style="max-width: 52px;">
                <h4>Payment<br><span>Payment Process</span></h4>
              </li>
              <li>
                <img src="assets/images/info-icon-04.png" alt="" style="max-width: 52px;">
                <h4>Safety<br><span>24/7 Under Control</span></h4>
              </li>
            </ul>
          </div>

          <!-- Formulaire de Location -->
          <div class="card shadow-sm">
            <div class="card-body">
              <h5 class="card-title mb-3">Réserver ce bien</h5>
              <form action="" method="POST">
                @csrf
                <div class="mb-3">
                  <label for="name" class="form-label">Nom complet</label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="Entrez votre nom complet" required>
                </div>
                <div class="mb-3">
                  <label for="email" class="form-label">Adresse Email</label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="exemple@email.com" required>
                </div>
                <div class="mb-3">
                  <label for="phone" class="form-label">Téléphone</label>
                  <input type="tel" class="form-control" id="phone" name="phone" placeholder="+33 6 12 34 56 78" required>
                </div>
                <div class="mb-3">
                  <label for="address" class="form-label">Adresse</label>
                  <input type="text" class="form-control" id="address" name="address" placeholder="Votre adresse complète" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Envoyer ma demande</button>
              </form>
            </div>
          </div>
          <!-- Fin Formulaire -->
        </div>
      </div>
    </div>
  </div>


@endsection
