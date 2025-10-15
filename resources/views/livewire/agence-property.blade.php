<main>

{{-- <!-- Navigation -->
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
</nav> --}}

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

  {{-- Formulaire principal --}}
  <div class="form-container">
    <div class="card shadow-sm">
      {{-- <div class="card-header bg-primary text-white">
        <h4 class="card-title mb-0">
          <i class="fas fa-plus-circle me-2"></i>Créer une Propriété
        </h4>
      </div> --}}

      <div class="card-body">
        <form wire:submit.prevent="save" enctype="multipart/form-data">

          {{-- Informations de base --}}
          <div class="row mb-4">
            <div class="col-12">
              <h5 class="text-secondary border-bottom pb-2 mb-3">
                <i class="fas fa-info-circle me-2"></i>Informations de base
              </h5>
            </div>
          </div>

          {{-- Nom de la propriété --}}
          <div class="mb-3">
            <label for="title" class="form-label fw-bold">
              <i class="fas fa-home me-2"></i>Nom de la propriété <span class="text-danger">*</span>
            </label>
            <input type="text"
                   id="title"
                   wire:model.live="title"
                   class="form-control @error('title') is-invalid @enderror"
                   placeholder="ex: Antilia Building, Villa Moderne, Terrain Ankatso">
            @error('title')
              <div class="invalid-feedback">
                <i class="fas fa-exclamation-triangle me-1"></i>{{ $message }}
              </div>
            @enderror
          </div>

          {{-- Description --}}
          <div class="mb-3">
            <label for="description" class="form-label fw-bold">
              <i class="fas fa-align-left me-2"></i>Description
            </label>
            <textarea id="description"
                      wire:model="description"
                      class="form-control @error('description') is-invalid @enderror"
                      rows="4"
                      placeholder="Décrivez votre propriété (équipements, état, quartier, etc.)"></textarea>
            @error('description')
              <div class="invalid-feedback">
                <i class="fas fa-exclamation-triangle me-1"></i>{{ $message }}
              </div>
            @enderror
          </div>

          {{-- Type et Prix --}}
          <div class="row mb-3">
            <div class="col-md-4">
              <label for="type" class="form-label fw-bold">
                <i class="fas fa-building me-2"></i>Type de propriété <span class="text-danger">*</span>
              </label>
              <select id="type"
                      wire:model.live="type"
                      class="form-control @error('type') is-invalid @enderror">
                <option value="appartement">🏠 Appartement</option>
                <option value="maison">🏡 Maison</option>
                <option value="terrain">🌍 Terrain</option>
              </select>
              @error('type')
                <div class="invalid-feedback">
                  <i class="fas fa-exclamation-triangle me-1"></i>{{ $message }}
                </div>
              @enderror
            </div>

            <div class="col-md-4">
              <label for="transaction_type" class="form-label fw-bold">
                <i class="fas fa-handshake me-2"></i>Transaction <span class="text-danger">*</span>
              </label>
              <select wire:model="transaction_type"
                      class="form-control @error('transaction_type') is-invalid @enderror">
                <option value="vente">💰 À Vendre</option>
                <option value="location">🔑 À Louer</option>
              </select>
              @error('transaction_type')
                <div class="invalid-feedback">
                  <i class="fas fa-exclamation-triangle me-1"></i>{{ $message }}
                </div>
              @enderror
            </div>

            <div class="col-md-4">
              <label for="price" class="form-label fw-bold">
                <i class="fas fa-money-bill-wave me-2"></i>Prix (Ar) <span class="text-danger">*</span>
              </label>
              <input type="number"
                     id="price"
                     wire:model="price"
                     class="form-control @error('price') is-invalid @enderror"
                     placeholder="ex: 200000000"
                     min="0">
              @error('price')
                <div class="invalid-feedback">
                  <i class="fas fa-exclamation-triangle me-1"></i>{{ $message }}
                </div>
              @enderror
              @if($price)
                <small class="text-muted">
                  Prix formaté: {{ number_format($price, 0, ',', ' ') }} Ar
                </small>
              @endif
            </div>
          </div>

          {{-- Surface --}}
          <div class="mb-3">
            <label for="surface" class="form-label fw-bold">
              <i class="fas fa-ruler-combined me-2"></i>Surface (m²)
            </label>
            <input type="number"
                   id="surface"
                   wire:model="surface"
                   class="form-control @error('surface') is-invalid @enderror"
                   placeholder="ex: 120"
                   min="0">
            @error('surface')
              <div class="invalid-feedback">
                <i class="fas fa-exclamation-triangle me-1"></i>{{ $message }}
              </div>
            @enderror
          </div>

          {{-- Champs spécifiques (masqués pour terrain) --}}
          @if($type !== 'terrain')
            <div class="row mb-4">
              <div class="col-12">
                <h5 class="text-secondary border-bottom pb-2 mb-3">
                  <i class="fas fa-door-open me-2"></i>Détails de la propriété
                </h5>
              </div>
            </div>

            <div class="row mb-3">
              <div class="col-md-4">
                <label for="rooms" class="form-label fw-bold">
                  <i class="fas fa-door-closed me-2"></i>Nombre de pièces
                </label>
                <input type="number"
                       id="rooms"
                       wire:model="rooms"
                       class="form-control @error('rooms') is-invalid @enderror"
                       placeholder="ex: 4"
                       min="0">
                @error('rooms')
                  <div class="invalid-feedback">
                    <i class="fas fa-exclamation-triangle me-1"></i>{{ $message }}
                  </div>
                @enderror
              </div>

              <div class="col-md-4">
                <label for="floors" class="form-label fw-bold">
                  <i class="fas fa-layer-group me-2"></i>Nombre d'étages
                </label>
                <input type="number"
                       id="floors"
                       wire:model="floors"
                       class="form-control @error('floors') is-invalid @enderror"
                       placeholder="ex: 2"
                       min="0">
                @error('floors')
                  <div class="invalid-feedback">
                    <i class="fas fa-exclamation-triangle me-1"></i>{{ $message }}
                  </div>
                @enderror
              </div>

              <div class="col-md-4 d-flex align-items-end">
                <div class="form-check form-switch">
                  <input type="checkbox"
                         id="parking"
                         wire:model="parking"
                         class="form-check-input">
                  <label for="parking" class="form-check-label fw-bold">
                    <i class="fas fa-car me-2"></i>Parking disponible
                  </label>
                </div>
              </div>
            </div>
          @endif

          {{-- Localisation --}}
          <div class="row mb-4">
            <div class="col-12">
              <h5 class="text-secondary border-bottom pb-2 mb-3">
                <i class="fas fa-map-marker-alt me-2"></i>Localisation
              </h5>
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-md-6">
              <label for="address" class="form-label fw-bold">
                <i class="fas fa-map-pin me-2"></i>Adresse complète
              </label>
              <input type="text"
                     id="address"
                     wire:model="address"
                     class="form-control @error('address') is-invalid @enderror"
                     placeholder="ex: Lot 123 Ankatso, Antananarivo">
              @error('address')
                <div class="invalid-feedback">
                  <i class="fas fa-exclamation-triangle me-1"></i>{{ $message }}
                </div>
              @enderror
            </div>

            <div class="col-md-3">
              <label for="city" class="form-label fw-bold">
                <i class="fas fa-city me-2"></i>Ville
              </label>
              <input type="text"
                     id="city"
                     wire:model="city"
                     class="form-control @error('city') is-invalid @enderror"
                     placeholder="ex: Antananarivo">
              @error('city')
                <div class="invalid-feedback">
                  <i class="fas fa-exclamation-triangle me-1"></i>{{ $message }}
                </div>
              @enderror
            </div>

            <div class="col-md-3">
              <label for="country" class="form-label fw-bold">
                <i class="fas fa-flag me-2"></i>Pays
              </label>
              <input type="text"
                     id="country"
                     wire:model="country"
                     class="form-control @error('country') is-invalid @enderror"
                     placeholder="ex: Madagascar">
              @error('country')
                <div class="invalid-feedback">
                  <i class="fas fa-exclamation-triangle me-1"></i>{{ $message }}
                </div>
              @enderror
            </div>
          </div>

          {{-- Upload d'images --}}
          <div class="row mb-4">
            <div class="col-12">
              <h5 class="text-secondary border-bottom pb-2 mb-3">
                <i class="fas fa-images me-2"></i>Images de la propriété
              </h5>
            </div>
          </div>

          <div class="mb-3">
            <label for="images" class="form-label fw-bold">
              <i class="fas fa-camera me-2"></i>Télécharger les images
              <small class="text-muted">(Maximum {{ $maxFiles }} images, 2MB chacune)</small>
            </label>
            <input type="file"
                   id="images"
                   wire:model="images"
                   multiple
                   accept="image/jpeg,image/png,image/jpg,image/webp"
                   class="form-control @error('images.*') is-invalid @enderror">

            @error('images')
              <div class="invalid-feedback d-block">
                <i class="fas fa-exclamation-triangle me-1"></i>{{ $message }}
              </div>
            @enderror

            @error('images.*')
              <div class="invalid-feedback d-block">
                <i class="fas fa-exclamation-triangle me-1"></i>{{ $message }}
              </div>
            @enderror

            <div class="form-text">
              Formats acceptés: JPG, JPEG, PNG, WEBP.
            </div>
          </div>

          {{-- Prévisualisation des images --}}
          @if($images && count($images) > 0)
            <div class="mb-4">
              <h6 class="text-secondary mb-3">
                <i class="fas fa-eye me-2"></i>Aperçu des images ({{ count($images) }}/{{ $maxFiles }})
              </h6>
              <div class="row g-3">
                @foreach($images as $index => $image)
                  <div class="col-md-3 col-sm-4 col-6">
                    <div class="position-relative">
                      <div class="card shadow-sm">
                        <img src="{{ $image->temporaryUrl() }}"
                             class="card-img-top"
                             alt="Preview {{ $index + 1 }}"
                             style="height: 150px; object-fit: cover;">
                        <div class="card-body p-2">
                          <button type="button"
                                  wire:click="removeTempImage({{ $index }})"
                                  class="btn btn-danger btn-sm w-100"
                                  wire:confirm="Êtes-vous sûr de vouloir supprimer cette image ?">
                            <i class="fas fa-trash me-1"></i>Supprimer
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                @endforeach
              </div>
            </div>
          @endif

          {{-- Boutons d'action --}}
          <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
            <div class="text-muted">
              <small><span class="text-danger">*</span> Champs obligatoires</small>
            </div>

            <div class="d-flex gap-2">
              <button type="button"
                      class="btn btn-secondary"
                      onclick="window.history.back()">
                <i class="fas fa-arrow-left me-2"></i>Retour
              </button>

              <button type="submit"
                      class="btn btn-primary btn-lg"
                      wire:loading.attr="disabled"
                      wire:target="save">
                <span wire:loading.remove wire:target="save">
                  <i class="fas fa-save me-2"></i>Créer la Propriété
                </span>
                <span wire:loading wire:target="save">
                  <i class="fas fa-spinner fa-spin me-2"></i>Création en cours...
                </span>
              </button>
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>


    </div>
  </div>
</div>
@if(session('property_created'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const propertyData = @json(session('property_created'));

        Swal.fire({
            icon: 'success',
            title: '<i class="fas fa-home me-2"></i>Propriété créée avec succès !',
            html: `
                <div class="text-start">
                    <p class="mb-2"><strong>Titre:</strong> ${propertyData.title}</p>
                    <p class="mb-2"><strong>Prix:</strong> ${propertyData.price} Ar</p>
                    <p class="mb-2"><strong>Type:</strong> ${propertyData.type}</p>
                    <p class="mb-0"><strong>Transaction:</strong> ${propertyData.transaction}</p>
                </div>
            `,
            confirmButtonText: '<i class="fas fa-check me-2"></i>Super !',
            confirmButtonColor: '#28a745',
            timer: 5000,
            timerProgressBar: true,
            showClass: {
                popup: 'animate__animated animate__fadeInDown'
            },
            hideClass: {
                popup: 'animate__animated animate__fadeOutUp'
            }
        });
    });
</script>
@endif
<style>
    @keyframes slideInDown {
    from {
        transform: translateY(-100%);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}

.alert-success {
    animation: slideInDown 0.5s ease-out;
    border-left: 5px solid #28a745;
    box-shadow: 0 4px 15px rgba(40, 167, 69, 0.2);
}
</style>
</main>
