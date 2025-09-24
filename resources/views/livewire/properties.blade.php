
  <main>
    <div class="topbar">
      <div class="page-title">Bonjour, {{ Auth::user()->name ?? 'Liantsoa' }}</div>
      <div id="currentDateTime" class="text-center badge bg-primary p-3"></div>
      <div style="display:flex; gap:15px; align-items:center;">
        <svg id="themeToggle" class="toggle-icon" viewBox="0 0 24 24">
          <path d="M21.64 13.65A9 9 0 1110.35 2.36a7 7 0 0011.29 11.29z"/>
        </svg>
        <div class="avatar">{{ strtoupper(substr(Auth::user()->name ?? 'KJ', 0, 2)) }}</div>
      </div>
    </div>

    <div class="container py-4">
      <!-- Titre -->
      <h2 class="fw-bold mb-3">
        All Properties
        @if($this->properties->total() > 0)
          <small class="text-muted">({{ $this->properties->total() }})</small>
        @endif
      </h2>

      <!-- Filtres -->
      <div class="d-flex gap-2 flex-wrap mb-4">
        <!-- Tri par prix -->
        <button wire:click="sortBy('price')"
                id="filtre1"
                class="btn fw-bold text-white {{ $sortBy === 'price' ? 'active' : '' }}">
          Sort Price {{ $sortBy === 'price' && $sortDirection === 'desc' ? '↓' : '↑' }}
        </button>

        <!-- Recherche -->
        <input type="text"
               wire:model.live.debounce.300ms="search"
               class="form-control"
               placeholder="Search by title"
               style="min-width: 200px;"
               value="{{ $search }}">

        <!-- Filtre par type -->
        <select wire:model.live="typeFilter"
                class="form-select"
                style="min-width: 120px;">
          <option value="">All Types</option>
          <option value="appartement">Appartement</option>
          <option value="maison">Maison</option>
          <option value="terrain">Terrain</option>
        </select>

        <!-- Filtre par transaction -->
        <select wire:model.live="transactionFilter"
                class="form-select"
                style="min-width: 120px;">
          <option value="">All Status</option>
          <option value="vente">For Sale</option>
          <option value="location">For Rent</option>
        </select>

        <!-- Reset filters -->
        @if($search || $typeFilter || $transactionFilter || $sortBy !== 'created_at')
          <button wire:click="clearFilters" class="btn btn-outline-secondary">
            <i class="fa fa-times"></i> Clear
          </button>
        @endif

        <!-- Add Property -->
        <a href="{{ route('createproperty') }}"
           id="filtre2"
           class="btn fw-bold text-white">
          <i class="fa fa-plus"></i> Add Property
        </a>
      </div>

      <!-- Loading indicator -->
      <div wire:loading.delay class="text-center py-3">
        <div class="spinner-border text-primary" role="status">
          <span class="visually-hidden">Loading...</span>
        </div>
      </div>

      <!-- Grille des propriétés -->
      @if($this->properties->count() > 0)
        <div class="row g-4" wire:loading.remove.delay>
          @foreach($this->properties as $property)
            <div class="col-md-4 col-lg-3">
              <div class="property-card">
                <!-- Image -->
                @if($property->images->count() > 0)
                  <img src="{{ Storage::url($property->images->first()->image_path) }}"
                       alt="{{ $property->title }}"
                       style="width: 100%; height: 200px; object-fit: cover;">
                  @if($property->images->count() > 1)
                    <div class="image-count-badge">
                      <i class="fa fa-images"></i> {{ $property->images->count() }}
                    </div>
                  @endif
                @else
                  <div class="no-image-placeholder" style="height: 200px; background: #f8f9fa; display: flex; align-items: center; justify-content: center;">
                    <i class="fa fa-home fa-2x text-muted"></i>
                  </div>
                @endif

                <div class="p-3">
                  <h5 class="fw-bold mb-1">{{ $property->title }}</h5>
                  <p class="text-muted small mb-2">
                    <i class="fa fa-map-marker-alt"></i>
                    {{ $property->city ?? 'Non spécifié' }}{{ $property->country ? ', ' . $property->country : '' }}
                  </p>

                  <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="price-badge">
                      {{ number_format($property->price, 0, ',', ' ') }}
                      {{ $property->country === 'Madagascar' ? 'Ar' : '$' }}
                    </span>

                    <div class="d-flex gap-1">
                      <span class="badge {{ $property->transaction_type === 'vente' ? 'bg-success' : 'bg-info' }} badge-sm">
                        {{ $property->transaction_type === 'vente' ? 'Sale' : 'Rent' }}
                      </span>
                    </div>
                  </div>

                  <!-- Property details -->
                  @if($property->type !== 'terrain')
                    <div class="property-details mb-2">
                      @if($property->rooms)
                        <small class="text-muted me-2">
                          <i class="fa fa-bed"></i> {{ $property->rooms }}
                        </small>
                      @endif
                      @if($property->surface)
                        <small class="text-muted me-2">
                          <i class="fa fa-expand"></i> {{ $property->surface }}m²
                        </small>
                      @endif
                      @if($property->parking)
                        <small class="text-success">
                          <i class="fa fa-car"></i> Parking
                        </small>
                      @endif
                    </div>
                  @endif

                  <!-- Actions -->
                  <div class="d-flex gap-1 mt-2">
                    <a href="#" class="btn btn-primary btn-sm flex-fill">
                      <i class="fa fa-eye"></i> View
                    </a>
                    <a href="#" class="btn btn-outline-primary btn-sm flex-fill">
                      <i class="fa fa-edit"></i> Edit
                    </a>
                    <button class="btn btn-outline-danger btn-sm"
                            wire:confirm="Are you sure you want to delete this property?"
                            wire:click="deleteProperty({{ $property->id }})">
                      <i class="fa fa-trash"></i>
                    </button>
                  </div>

                  <!-- Date -->
                  <div class="mt-2">
                    <small class="text-muted">
                      <i class="fa fa-calendar"></i> {{ $property->created_at->diffForHumans() }}
                    </small>
                  </div>
                </div>
              </div>
            </div>
          @endforeach
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
          {{ $this->properties->links() }}
        </div>
      @else
        <!-- No results -->
        <div class="text-center py-5" wire:loading.remove.delay>
          <i class="fa fa-search fa-3x text-muted mb-3"></i>
          <h4 class="text-muted">No properties found</h4>
          <p class="text-muted">
            @if($search || $typeFilter || $transactionFilter)
              Try adjusting your search criteria
              <br>
              <button wire:click="clearFilters" class="btn btn-outline-primary mt-2">
                <i class="fa fa-times"></i> Clear Filters
              </button>
            @else
              No properties have been added yet
              <br>
              <a href="{{ route('createproperty') }}" class="btn btn-primary mt-2">
                <i class="fa fa-plus"></i> Add First Property
              </a>
            @endif
          </p>
        </div>
      @endif
    </div>


  <!-- Script pour la date/heure -->
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
      setInterval(updateDateTime, 60000);

      // Toggle thème
      const themeToggle = document.getElementById('themeToggle');
      if (themeToggle) {
        themeToggle.addEventListener('click', function() {
          document.body.classList.toggle('dark-theme');
        });
      }
    });
  </script>

  <!-- Styles CSS -->
  <style>


    .property-card {
      background: #fff;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      transition: all 0.3s ease;
      position: relative;
    }

    .property-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    }

    .price-badge {
      background: linear-gradient(45deg, #ff6b6b, #ee5a52);
      color: white;
      padding: 0.25rem 0.75rem;
      border-radius: 20px;
      font-weight: 600;
      font-size: 0.9rem;
    }

    .image-count-badge {
      position: absolute;
      top: 10px;
      right: 10px;
      background: rgba(0, 0, 0, 0.7);
      color: white;
      padding: 5px 10px;
      border-radius: 15px;
      font-size: 0.8rem;
      z-index: 10;
    }

    .badge-sm {
      font-size: 0.7rem;
      padding: 0.2rem 0.5rem;
    }

    .property-details {
      font-size: 0.85rem;
    }

    .btn-sm {
      font-size: 0.8rem;
      padding: 0.25rem 0.5rem;
    }

    .spinner-border {
      width: 2rem;
      height: 2rem;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .topbar {
        flex-direction: column;
        gap: 1rem;
        padding: 1rem;
      }

      .container {
        padding: 0 1rem;
      }

      .d-flex.gap-2.flex-wrap {
        gap: 0.5rem !important;
      }

      .form-control, .form-select {
        min-width: 150px !important;
      }
    }

    /* Loading animations */
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(10px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .fade-in {
      animation: fadeIn 0.3s ease-out;
    }
  </style>
  </main>
{{-- <main>
   <div class="topbar">
      <div class="page-title">Bonjour, Liantsoa</div>

      <div id="currentDateTime" class="text-center badge bg-primary p-3"></div>


      <div style="display:flex; gap:15px; align-items:center;">
        <svg id="themeToggle" class="toggle-icon" viewBox="0 0 24 24">
          <path d="M21.64 13.65A9 9 0 1110.35 2.36a7 7 0 0011.29 11.29z"/>
        </svg>
        <div class="avatar">KJ</div>
      </div>
    </div>

    <div class="container py-4">
        <!-- Titre -->
        <h2 class="fw-bold mb-3">All Properties</h2>

        <!-- Filtres -->
        <div class="d-flex gap-2 flex-wrap mb-4">
            <button id="filtre1" class="btn fw-bold text-white">Sort Price ↓</button>
            <input type="text" class="form-control" placeholder="Search by title" style="min-width: 200px;">
            <select class="form-select" style="min-width: 100px;">
                <option>All</option>
            </select>
            <a href="{{ route("createproperty") }}" id="filtre2" class="btn  fw-bold text-white" ><i class="fa fa-plus"></i> Add Property</a>
        </div>

        <!-- Grille des propriétés -->
        <div class="row g-4">
            <!-- Card -->
            <div class="col-md-4 col-lg-3">
                <div class="property-card">
                    <img src="https://picsum.photos/400/250?random=1" alt="">
                    <div class="p-3">
                        <h5 class="fw-bold mb-1">Lavender Apartment</h5>
                        <p class="text-muted small mb-2"><i class="fa fa-map-marker-alt"></i> Brooklyn, US</p>
                        <span class="price-badge">$999</span>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-lg-3">
                <div class="property-card">
                    <img src="https://picsum.photos/400/250?random=2" alt="">
                    <div class="p-3">
                        <h5 class="fw-bold mb-1">KJ Hotel & Spa</h5>
                        <p class="text-muted small mb-2"><i class="fa fa-map-marker-alt"></i> North Carolina, USA</p>
                        <span class="price-badge">$1349</span>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-lg-3">
                <div class="property-card">
                    <img src="https://picsum.photos/400/250?random=3" alt="">
                    <div class="p-3">
                        <h5 class="fw-bold mb-1">Star Sun Hotel & Apartment</h5>
                        <p class="text-muted small mb-2"><i class="fa fa-map-marker-alt"></i> Los Angeles, USA</p>
                        <span class="price-badge">$399</span>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-lg-3">
                <div class="property-card">
                    <img src="https://picsum.photos/400/250?random=4" alt="">
                    <div class="p-3">
                        <h5 class="fw-bold mb-1">BlueSky Resort</h5>
                        <p class="text-muted small mb-2"><i class="fa fa-map-marker-alt"></i> Miami, USA</p>
                        <span class="price-badge">$789</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main> --}}
