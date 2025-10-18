@extends("layouts.app")

@php
    $pageTitle = "IMMO | Propriétés"
@endphp

@section("body")
<div class="page-heading header-text">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <span class="breadcrumb">
          <a href="{{ route('homepage') }}">Accueil</a> / Propriétés
        </span>
        <h3>Nos Propriétés</h3>
      </div>
    </div>
  </div>
</div>

<div class="section properties">
  <div class="container">

    <!-- Barre de recherche et filtres professionnelle -->
    <div class="search-filter-container mb-5">
      <form method="GET" action="{{ route('properties.index') }}" class="row g-3">

        <!-- Barre de recherche -->
        <div class="col-lg-12">
          <div class="search-box">
            <i class="fa fa-search"></i>
            <input type="text"
                   name="search"
                   class="form-control search-input"
                   placeholder="Rechercher par titre, ville ou adresse..."
                   value="{{ request('search') }}">
          </div>
        </div>

        <!-- Filtres rapides -->
        <div class="col-md-3">
          <select name="transaction_type" class="form-select filter-select">
            <option value="">Type de transaction</option>
            <option value="vente" {{ request('transaction_type') == 'vente' ? 'selected' : '' }}>À vendre</option>
            <option value="location" {{ request('transaction_type') == 'location' ? 'selected' : '' }}>À louer</option>
          </select>
        </div>

        <div class="col-md-3">
          <select name="property_type" class="form-select filter-select">
            <option value="">Type de bien</option>
            <option value="appartement" {{ request('property_type') == 'appartement' ? 'selected' : '' }}>Appartement</option>
            <option value="maison" {{ request('property_type') == 'maison' ? 'selected' : '' }}>Maison</option>
            <option value="terrain" {{ request('property_type') == 'terrain' ? 'selected' : '' }}>Terrain</option>
          </select>
        </div>

        <div class="col-md-3">
          <select name="city" class="form-select filter-select">
            <option value="">Toutes les villes</option>
            @foreach($cities as $city)
              <option value="{{ $city }}" {{ request('city') == $city ? 'selected' : '' }}>
                {{ $city }}
              </option>
            @endforeach
          </select>
        </div>

        <div class="col-md-3">
          <div class="filter-actions">
            <button type="submit" class="btn btn-primary btn-search">
              <i class="fa fa-search me-1"></i> Rechercher
            </button>
            @if(request()->hasAny(['search', 'transaction_type', 'property_type', 'city', 'min_price', 'max_price']))
              <a href="{{ route('properties.index') }}" class="btn btn-outline-secondary btn-reset" title="Réinitialiser">
                <i class="fa fa-redo"></i>
              </a>
            @endif
          </div>
        </div>

        <!-- Filtres avancés (repliables) -->
        <div class="col-12">
          <div class="advanced-filters-toggle">
            <a href="#advancedFilters" data-bs-toggle="collapse" class="text-muted">
              <i class="fa fa-sliders-h me-1"></i> Filtres avancés
              <i class="fa fa-chevron-down ms-1"></i>
            </a>
          </div>
        </div>

        <div class="col-12 collapse" id="advancedFilters">
          <div class="advanced-filters-box">
            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label">Prix minimum (Ar)</label>
                <input type="number"
                       name="min_price"
                       class="form-control"
                       placeholder="Ex: 1 000 000"
                       value="{{ request('min_price') }}"
                       step="100000">
              </div>
              <div class="col-md-6">
                <label class="form-label">Prix maximum (Ar)</label>
                <input type="number"
                       name="max_price"
                       class="form-control"
                       placeholder="Ex: 50 000 000"
                       value="{{ request('max_price') }}"
                       step="100000">
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>

    <!-- Résultats et tri -->
    <div class="results-header mb-4">
      <div class="results-info">
        <h5 class="mb-0">
          <strong>{{ $properties->total() }}</strong>
          {{ $properties->total() > 1 ? 'propriétés trouvées' : 'propriété trouvée' }}
        </h5>
        @if(request()->hasAny(['search', 'transaction_type', 'property_type', 'city', 'min_price', 'max_price']))
          <span class="badge bg-primary ms-2">Filtres actifs</span>
        @endif
      </div>
    </div>

    <!-- Liste des propriétés -->
    <div class="row properties-box">
      @forelse($properties as $property)
        <div class="col-lg-4 col-md-6 align-self-center mb-30 properties-items">
          <div class="item">
            <!-- Image avec badges -->
            <div class="property-image-wrapper">
              <a href="{{ route('properties.show', $property->id) }}">
                @if($property->images->count() > 0)
                  <img src="{{ Storage::url($property->images->first()->image_path) }}"
                       alt="{{ $property->title }}"
                       class="property-image">
                @else
                  <img src="https://via.placeholder.com/400x250/f8f9fa/999999?text=Aucune+image"
                       alt="{{ $property->title }}"
                       class="property-image">
                @endif
              </a>

              <!-- Badge Agence -->
              @if($property->user)
                <div class="badge-agency">
                  <i class="fa fa-user-tie"></i> {{ $property->user->name }}
                </div>
              @endif

              <!-- Badge Transaction -->
              <div class="badge-transaction {{ $property->transaction_type }}">
                <i class="fa {{ $property->transaction_type == 'vente' ? 'fa-tag' : 'fa-key' }}"></i>
                {{ $property->transaction_type == 'vente' ? 'Vente' : 'Location' }}
              </div>

              <!-- Compteur d'images -->
              @if($property->images->count() > 1)
                <div class="badge-images">
                  <i class="fa fa-images"></i> {{ $property->images->count() }}
                </div>
              @endif
            </div>

            <!-- Contenu -->
            <span class="category">{{ ucfirst($property->type) }}</span>

            <h6 class="property-price">{{ $property->formatted_price }}</h6>

            <h4>
              <a href="{{ route('properties.show', $property->id) }}">
                {{ Str::limit($property->title, 50) }}
              </a>
            </h4>

            <p class="property-location">
              <i class="fa fa-map-marker-alt"></i>
              {{ $property->city ?? 'Non spécifié' }}
            </p>

            <!-- Caractéristiques -->
            @if($property->type !== 'terrain')
              <ul>
                @if($property->rooms)
                  <li>Chambres: <span>{{ $property->rooms }}</span></li>
                @endif
                @if($property->surface)
                  <li>Surface: <span>{{ $property->surface }}m²</span></li>
                @endif
                <li>Parking: <span>{{ $property->parking ? 'Oui' : 'Non' }}</span></li>
              </ul>
            @else
              <ul>
                @if($property->surface)
                  <li>Surface: <span>{{ $property->surface }}m²</span></li>
                @else
                  <li>Type: <span>Terrain</span></li>
                @endif
              </ul>
            @endif

            <!-- Bouton d'action -->
            <div class="main-button">
              <a href="javascript:void(0)"
                 onclick="openContactModal({{ $property->id }}, '{{ addslashes($property->title) }}', '{{ $property->formatted_price }}', '{{ $property->transaction_type }}')">
                {{ $property->transaction_type == 'location' ? 'Demander une visite' : 'Je suis intéressé(e)' }}
              </a>
            </div>
          </div>
        </div>
      @empty
        <!-- Message si aucune propriété -->
        <div class="col-12">
          <div class="no-results">
            <div class="no-results-icon">
              <i class="fa fa-search"></i>
            </div>
            <h4>Aucune propriété trouvée</h4>
            <p>Essayez de modifier vos critères de recherche</p>
            <a href="{{ route('properties.index') }}" class="btn btn-primary mt-3">
              <i class="fa fa-home me-2"></i>Voir toutes les propriétés
            </a>
          </div>
        </div>
      @endforelse
    </div>

    <!-- Pagination -->
    @if($properties->hasPages())
      <div class="row mt-5">
        <div class="col-lg-12">
          <ul class="pagination justify-content-center">
            @if (!$properties->onFirstPage())
              <li><a href="{{ $properties->previousPageUrl() }}">&lt;&lt;</a></li>
            @endif

            @foreach ($properties->getUrlRange(1, $properties->lastPage()) as $page => $url)
              <li>
                <a href="{{ $url }}" class="{{ $page == $properties->currentPage() ? 'is_active' : '' }}">
                  {{ $page }}
                </a>
              </li>
            @endforeach

            @if ($properties->hasMorePages())
              <li><a href="{{ $properties->nextPageUrl() }}">&gt;&gt;</a></li>
            @endif
          </ul>
        </div>
      </div>
    @endif
  </div>
</div>

<!-- Modal Contact Lead -->
<div class="modal fade" id="contactModal" tabindex="-1" aria-labelledby="contactModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="contactModalLabel">
          <i class="fa fa-envelope me-2"></i>
          <span id="modalTitle">Demande de contact</span>
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="leadForm">
          @csrf
          <input type="hidden" id="propertyId" name="property_id">

          <div class="alert alert-info">
            <h6 class="mb-1" id="propertyTitle"></h6>
            <p class="mb-0 fw-bold text-primary" id="propertyPrice"></p>
          </div>

          <div class="mb-3">
            <label class="form-label">Votre nom <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="client_name" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Votre email <span class="text-danger">*</span></label>
            <input type="email" class="form-control" name="client_email" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Votre téléphone <span class="text-danger">*</span></label>
            <input type="tel" class="form-control" name="client_phone" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Message (optionnel)</label>
            <textarea class="form-control" name="message" rows="3" placeholder="Présentez-vous..."></textarea>
          </div>

          <button type="submit" class="btn btn-primary w-100">
            <i class="fa fa-paper-plane me-2"></i>
            <span class="btn-text">Envoyer ma demande</span>
          </button>
        </form>
      </div>
    </div>
  </div>
</div>

@push('styles')
<style>
/* ===== SYSTÈME DE FILTRES PROFESSIONNEL ===== */
.search-filter-container {
  background: #fff;
  padding: 2rem;
  border-radius: 15px;
  box-shadow: 0 5px 20px rgba(0,0,0,0.08);
}

.search-box {
  position: relative;
}

.search-box i {
  position: absolute;
  left: 20px;
  top: 50%;
  transform: translateY(-50%);
  color: #999;
  font-size: 1.1rem;
}

.search-input {
  padding: 15px 20px 15px 50px;
  border: 2px solid #e8e8e8;
  border-radius: 50px;
  font-size: 1rem;
  transition: all 0.3s ease;
}

.search-input:focus {
  border-color: #f35525;
  box-shadow: 0 0 0 0.2rem rgba(243, 85, 37, 0.1);
}

.filter-select {
  padding: 12px 15px;
  border: 2px solid #e8e8e8;
  border-radius: 10px;
  transition: all 0.3s ease;
  background-color: #fff;
}

.filter-select:focus {
  border-color: #f35525;
  box-shadow: 0 0 0 0.2rem rgba(243, 85, 37, 0.1);
}

.filter-actions {
  display: flex;
  gap: 10px;
}

.btn-search {
  flex: 1;
  padding: 12px 20px;
  background: linear-gradient(135deg, #f35525 0%, #ff6b35 100%);
  border: none;
  border-radius: 10px;
  font-weight: 600;
  transition: all 0.3s ease;
}

.btn-search:hover {
  transform: translateY(-2px);
  box-shadow: 0 5px 15px rgba(243, 85, 37, 0.3);
}

.btn-reset {
  width: 45px;
  padding: 12px;
  border-radius: 10px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.advanced-filters-toggle {
  text-align: center;
  padding-top: 1rem;
  border-top: 1px solid #e8e8e8;
}

.advanced-filters-toggle a {
  text-decoration: none;
  font-weight: 500;
  transition: color 0.3s ease;
}

.advanced-filters-toggle a:hover {
  color: #f35525 !important;
}

.advanced-filters-box {
  background: #f8f9fa;
  padding: 1.5rem;
  border-radius: 10px;
  margin-top: 1rem;
}

/* ===== RÉSULTATS ===== */
.results-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 1rem 0;
  border-bottom: 2px solid #f0f0f0;
}

.results-info h5 {
  color: #333;
  font-weight: 600;
}

/* ===== PROPRIÉTÉS ===== */
.property-image-wrapper {
  position: relative;
  overflow: hidden;
  border-radius: 10px;
  margin-bottom: 1rem;
}

.property-image {
  width: 100%;
  height: 250px;
  object-fit: cover;
  transition: transform 0.5s ease;
}

.item:hover .property-image {
  transform: scale(1.1);
}

/* Badges */
.badge-agency {
  position: absolute;
  top: 15px;
  left: 15px;
  background: linear-gradient(135deg, #f35525 0%, #ff6b35 100%);
  color: white;
  padding: 6px 14px;
  border-radius: 25px;
  font-size: 0.75rem;
  font-weight: 600;
  box-shadow: 0 4px 10px rgba(243, 85, 37, 0.3);
  z-index: 2;
}

.badge-transaction {
  position: absolute;
  bottom: 15px;
  left: 15px;
  color: white;
  padding: 6px 14px;
  border-radius: 25px;
  font-size: 0.75rem;
  font-weight: 600;
  text-transform: uppercase;
  z-index: 2;
}

.badge-transaction.vente {
  background: linear-gradient(135deg, #28a745 0%, #34ce57 100%);
}

.badge-transaction.location {
  background: linear-gradient(135deg, #007bff 0%, #3395ff 100%);
}

.badge-images {
  position: absolute;
  top: 15px;
  right: 15px;
  background: rgba(0, 0, 0, 0.7);
  color: white;
  padding: 6px 12px;
  border-radius: 20px;
  font-size: 0.75rem;
  backdrop-filter: blur(5px);
  z-index: 2;
}

.property-price {
  color: #f35525;
  font-weight: 700;
  font-size: 1.4rem;
  margin: 0.5rem 0;
}

.property-location {
  color: #666;
  font-size: 0.9rem;
  margin-bottom: 1rem;
}

/* Message vide */
.no-results {
  text-align: center;
  padding: 5rem 2rem;
  background: #f8f9fa;
  border-radius: 15px;
}

.no-results-icon {
  font-size: 4rem;
  color: #ddd;
  margin-bottom: 1.5rem;
}

.no-results h4 {
  color: #666;
  margin-bottom: 0.5rem;
}

.no-results p {
  color: #999;
}

/* Modal */
.modal-header {
  background: linear-gradient(135deg, #f35525 0%, #ff6b35 100%);
  color: white;
  border-bottom: none;
  border-radius: 15px 15px 0 0;
}

.modal-content {
  border-radius: 15px;
  border: none;
  box-shadow: 0 10px 40px rgba(0,0,0,0.2);
}

/* Responsive */
@media (max-width: 768px) {
  .search-filter-container {
    padding: 1.5rem;
  }

  .filter-actions {
    flex-direction: column;
  }

  .btn-reset {
    width: 100%;
  }

  .results-header {
    flex-direction: column;
    gap: 1rem;
  }
}
</style>
@endpush

@push('scripts')
<script>
// Notyf
const notyf = new Notyf({
  duration: 5000,
  position: { x: 'right', y: 'top' },
  dismissible: true
});

// Ouvrir modal
function openContactModal(propertyId, title, price, type) {
  document.getElementById('propertyId').value = propertyId;
  document.getElementById('propertyTitle').textContent = title;
  document.getElementById('propertyPrice').textContent = price;

  const modalTitle = type === 'location' ? 'Demande de location' : "Demande d'achat";
  document.getElementById('modalTitle').textContent = modalTitle;

  $('#contactModal').modal('show');
}

// Soumettre lead
document.getElementById('leadForm').addEventListener('submit', async function(e) {
  e.preventDefault();

  const formData = new FormData(this);
  const submitButton = this.querySelector('button[type="submit"]');
  const btnText = submitButton.querySelector('.btn-text');
  const originalText = btnText.innerHTML;
  const icon = submitButton.querySelector('i');

  submitButton.disabled = true;
  btnText.innerHTML = 'Envoi...';
  icon.className = 'fa fa-spinner fa-spin me-2';

  try {
    const propertyId = document.getElementById('propertyId').value;
    const response = await fetch(`/leads/${propertyId}/store`, {
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': '{{ csrf_token() }}',
        'Accept': 'application/json',
      },
      body: formData
    });

    const data = await response.json();

    if (response.ok && data.success) {
      notyf.success(data.message || 'Demande envoyée avec succès !');
      $('#contactModal').modal('hide');
      this.reset();
    } else {
      notyf.error(data.message || 'Une erreur est survenue');
    }
  } catch (error) {
    notyf.error('Erreur de connexion');
  } finally {
    submitButton.disabled = false;
    btnText.innerHTML = originalText;
    icon.className = 'fa fa-paper-plane me-2';
  }
});

// Réinitialiser formulaire à la fermeture
$('#contactModal').on('hidden.bs.modal', function () {
  document.getElementById('leadForm').reset();
});
</script>
@endpush

@endsection
