<main>

  <div class="topbar d-flex justify-content-between align-items-center">
    <div class="page-title">Bonjour,  {{ Auth::user()->name ?? 'Utilisateur' }}</div>
    <div id="currentDateTime" class="text-center badge bg-primary p-3"></div>
    <div style="display:flex; gap:15px; align-items:center;">
      <svg id="themeToggle" class="toggle-icon" viewBox="0 0 24 24" width="24" height="24">
        <path d="M21.64 13.65A9 9 0 1110.35 2.36a7 7 0 0011.29 11.29z"/>
      </svg>
      <div class="avatar">KJ</div>
    </div>
  </div>


  {{-- Messages Flash --}}
  @if (session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif

  @if (session()->has('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif

  @if (session()->has('image_removed'))
    <div class="alert alert-info alert-dismissible fade show" role="alert">
      <i class="fas fa-trash me-2"></i>{{ session('image_removed') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif

  {{-- Formulaire principal --}}
  <div class="form-container">
    <div class="card shadow-sm">
      <div class="card-header bg-primary text-white">
        <h4 class="card-title mb-0">
          <i class="fas fa-plus-circle me-2"></i>Créer une Propriété
        </h4>
      </div>

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
              Formats acceptés: JPG, JPEG, PNG, WEBP. Taille max: 2MB par image.
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

  {{-- Script pour la date/heure --}}
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      function updateDateTime() {
        const now = new Date();
        const options = {
          weekday: 'long',
          year: 'numeric',
          month: 'long',
          day: 'numeric',
          hour: '2-digit',
          minute: '2-digit'
        };
        document.getElementById('currentDateTime').textContent =
          now.toLocaleDateString('fr-FR', options);
      }

      updateDateTime();
      setInterval(updateDateTime, 60000); // Update every minute
    });

    // Toggle thème (optionnel)
    document.addEventListener("DOMContentLoaded", function() {
      const themeToggle = document.getElementById('themeToggle');
      if (themeToggle) {
        themeToggle.addEventListener('click', function() {
          document.body.classList.toggle('dark-theme');
        });
      }
    });
  </script>

</main>
    {{-- Topbar --}}

{{-- <main>
  <div class="topbar d-flex justify-content-between align-items-center">
    <div class="page-title">Bonjour, Liantsoa</div>
    <div id="currentDateTime" class="text-center badge bg-primary p-3"></div>
    <div style="display:flex; gap:15px; align-items:center;">
      <svg id="themeToggle" class="toggle-icon" viewBox="0 0 24 24" width="24" height="24">
        <path d="M21.64 13.65A9 9 0 1110.35 2.36a7 7 0 0011.29 11.29z"/>
      </svg>
      <div class="avatar">KJ</div>
    </div>
  </div>

  <div class="form-container mt-4">
    <h2>Create Property</h2>


    <form wire:submit.prevent="save" enctype="multipart/form-data">

      <label for="name">Enter the property name</label>
      <input type="text" id="name" wire:model="title" class="form-control" placeholder="e.g. Antilia Building">
      @error('title') <span class="text-danger">{{ $message }}</span> @enderror

      <label for="description">Enter the property description</label>
      <textarea id="description" wire:model="description" class="form-control" placeholder="Write a description of the property"></textarea>
      @error('description') <span class="text-danger">{{ $message }}</span> @enderror

      <!-- Type + Price -->
      <div class="row mb-3">
        <div class="col">
          <label for="type">Property type</label>
          <select id="type" wire:model="type" class="form-control" required>
            <option value="appartement">Appartement</option>
            <option value="maison">Maison</option>
            <option value="terrain">Terrain</option>
          </select>
          @error('type') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="col">
          <label for="price">Price (Ar)</label>
          <input type="number" id="price" wire:model="price" class="form-control" placeholder="ex: 200000000" required>
          @error('price') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
      </div>

      <!-- Transaction -->
      <label>Transaction</label>
      <select wire:model="transaction_type" class="form-control mb-3" required>
        <option value="vente">À Vendre</option>
        <option value="location">À Louer</option>
      </select>
      @error('transaction_type') <span class="text-danger">{{ $message }}</span> @enderror

      <!-- Surface -->
      <label for="surface">Surface (m²)</label>
      <input type="number" id="surface" wire:model="surface" class="form-control mb-3">
      @error('surface') <span class="text-danger">{{ $message }}</span> @enderror

      <!-- Champs supplémentaires -->
      <div id="extraFields">
        <div class="row mb-3">
          <div class="col">
            <label for="rooms">Nombre de pièces</label>
            <input type="number" id="rooms" wire:model="rooms" class="form-control">
            @error('rooms') <span class="text-danger">{{ $message }}</span> @enderror
          </div>
          <div class="col">
            <label for="floors">Nombre d’étages</label>
            <input type="number" id="floors" wire:model="floors" class="form-control">
            @error('floors') <span class="text-danger">{{ $message }}</span> @enderror
          </div>
        </div>

        <div class="form-check mb-3">
          <input type="checkbox" id="parking" wire:model="parking" class="form-check-input">
          <label for="parking" class="form-check-label">Parking disponible</label>
        </div>
      </div>

      <!-- Adresse -->
      <label for="address">Adresse complète</label>
      <input type="text" id="address" wire:model="address" class="form-control mb-3">
      @error('address') <span class="text-danger">{{ $message }}</span> @enderror

      <label for="city">Ville</label>
      <input type="text" id="city" wire:model="city" class="form-control mb-3">
      @error('city') <span class="text-danger">{{ $message }}</span> @enderror

      <label for="country">Pays</label>
      <input type="text" id="country" wire:model="country" class="form-control mb-3">
      @error('country') <span class="text-danger">{{ $message }}</span> @enderror

      <!-- Image -->
      <label for="images">Upload property images</label>
      <input type="file" id="images" wire:model="images" multiple class="form-control mb-3">
      @error('images.*') <span class="text-danger">{{ $message }}</span> @enderror

      <!-- Preview des images -->
      @if($images)
        <div class="d-flex flex-wrap gap-2 mb-3">
          @foreach($images as $index => $image)
            <div class="position-relative" style="width:120px;">
              <img src="{{ $image->temporaryUrl() }}" class="img-thumbnail" alt="Preview">
              <button type="button" wire:click="removeTempImage({{ $index }})" class="btn btn-sm btn-danger position-absolute top-0 end-0">X</button>
            </div>
          @endforeach
        </div>
      @endif

      <!-- Submit -->
      <button type="submit" class="btn btn-primary">Soumettre</button>
    </form>
  </div>
</main>

<script>
document.addEventListener("DOMContentLoaded", function() {
  const typeSelect = document.getElementById("type");
  const extraFields = document.getElementById("extraFields");

  function toggleExtraFields() {
    if (typeSelect.value === "terrain") {
      extraFields.style.display = "none";
    } else {
      extraFields.style.display = "block";
    }
  }

  toggleExtraFields();
  typeSelect.addEventListener("change", toggleExtraFields);
});
</script>

 --}}
