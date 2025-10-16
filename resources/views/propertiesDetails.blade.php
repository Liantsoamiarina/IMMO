@extends("layouts.app")
@php
$pageTitle = "IMMO | " . $property->title;
@endphp
@section("body")
  <div class="page-heading header-text">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <span class="breadcrumb">
            <a href="{{ route('homepage') }}">Accueil</a> /
            <a href="{{ route('properties.index') }}">Propriétés</a> /
            {{ $property->title }}
          </span>
          <h3>{{ $property->title }}</h3>
        </div>
      </div>
    </div>
  </div>

  <div class="single-property section">
    <div class="container">
      <div class="row">
        <!-- Colonne principale -->
        <div class="col-lg-8">
          <!-- Image principale -->
          <div class="main-image" style="position: relative;">
            @if($property->images->count() > 0)
              <img src="{{ Storage::url($property->images->first()->image_path) }}"
                   alt="{{ $property->title }}"
                   style="width: 100%; height: 500px; object-fit: cover; border-radius: 10px;">

              <!-- Badge type de transaction -->
              <div style="position: absolute; top: 20px; left: 20px; background: {{ $property->transaction_type == 'vente' ? 'linear-gradient(135deg, #28a745 0%, #20c997 100%)' : 'linear-gradient(135deg, #007bff 0%, #0dcaf0 100%)' }}; color: white; padding: 10px 20px; border-radius: 25px; font-size: 0.9rem; font-weight: 700; box-shadow: 0 4px 15px rgba(0,0,0,0.3); text-transform: uppercase;">
                <i class="fa {{ $property->transaction_type == 'vente' ? 'fa-tag' : 'fa-key' }}"></i>
                {{ $property->transaction_type == 'vente' ? 'À Vendre' : 'À Louer' }}
              </div>
            @else
              <div style="width: 100%; height: 500px; background: #f8f9fa; display: flex; align-items: center; justify-content: center; border-radius: 10px;">
                <i class="fa fa-home fa-5x text-muted"></i>
              </div>
            @endif
          </div>

          <!-- Galerie d'images (si plusieurs) -->
          @if($property->images->count() > 1)
            <div class="row mt-3">
              @foreach($property->images->skip(1)->take(4) as $image)
                <div class="col-3">
                  <img src="{{ Storage::url($image->image_path) }}"
                       alt="{{ $property->title }}"
                       style="width: 100%; height: 120px; object-fit: cover; border-radius: 8px; cursor: pointer;"
                       onclick="document.querySelector('.main-image img').src='{{ Storage::url($image->image_path) }}'">
                </div>
              @endforeach
              @if($property->images->count() > 5)
                <div class="col-3">
                  <div style="width: 100%; height: 120px; background: rgba(0,0,0,0.7); border-radius: 8px; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; cursor: pointer;">
                    +{{ $property->images->count() - 5 }} photos
                  </div>
                </div>
              @endif
            </div>
          @endif

          <!-- Contenu principal -->
          <div class="main-content">
            <span class="category">{{ $property->type ?? 'Propriété' }}</span>
            <h4>{{ $property->address . ', ' . $property->city }}</h4>

            <!-- Prix -->
            <div class="mb-4">
              <h3 style="color: #ff6b35; font-weight: 700;">
                {{ $property->formatted_price }}
                @if($property->transaction_type == 'location')
                  <span style="font-size: 0.6em; color: #666;">/ mois</span>
                @endif
              </h3>
            </div>

            <!-- Description -->
            <p style="text-align: justify; line-height: 1.8;">
              {{ $property->description ?? 'Description non disponible pour cette propriété.' }}
            </p>

            <!-- Caractéristiques détaillées -->
            @if($property->features)
              <div class="mt-4">
                <h5 class="mb-3"><i class="fa fa-check-circle me-2" style="color: #28a745;"></i>Équipements et caractéristiques</h5>
                <div class="row">
                  @foreach(explode(',', $property->features) as $feature)
                    <div class="col-md-6 mb-2">
                      <i class="fa fa-check text-success me-2"></i>{{ trim($feature) }}
                    </div>
                  @endforeach
                </div>
              </div>
            @endif
          </div>

          <!-- Accordéon FAQ -->
          <div class="accordion mt-5" id="accordionExample">
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                  <i class="fa fa-info-circle me-2"></i> Informations sur la propriété
                </button>
              </h2>
              <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  <strong>Référence :</strong> #{{ $property->id }}<br>
                  <strong>Type :</strong> {{ $property->type ?? 'N/A' }}<br>
                  <strong>État :</strong> {{ $property->status ?? 'N/A' }}<br>
                  <strong>Année de construction :</strong> {{ $property->year_built ?? 'N/A' }}<br>
                  <strong>Publié le :</strong> {{ $property->created_at->format('d/m/Y') }}
                </div>
              </div>
            </div>

            <div class="accordion-item">
              <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                  <i class="fa fa-map-marker-alt me-2"></i> Localisation
                </button>
              </h2>
              <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  <strong>Adresse complète :</strong><br>
                  {{ $property->address }}<br>
                  {{ $property->city }}, {{ $property->zip_code ?? '' }}<br>
                  @if($property->region)
                    {{ $property->region }}
                  @endif
                </div>
              </div>
            </div>

            <div class="accordion-item">
              <h2 class="accordion-header" id="headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                  <i class="fa fa-building me-2"></i> À propos de l'agence
                </button>
              </h2>
              <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  <strong>Agence :</strong> {{ $property->user->name ?? 'N/A' }}<br>
                  @if($property->user && $property->user->email)
                    <strong>Email :</strong> {{ $property->user->email }}<br>
                  @endif
                  @if($property->user && $property->user->phone)
                    <strong>Téléphone :</strong> {{ $property->user->phone }}<br>
                  @endif
                  <strong>Membre depuis :</strong> {{ $property->user->created_at->format('d/m/Y') ?? 'N/A' }}
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Colonne latérale -->
        <div class="col-lg-4">
          <!-- Carte informations rapides -->
          <div class="info-table">
            <ul>
              <li>
                <img src="{{ asset('assets/images/info-icon-01.png') }}" alt="" style="max-width: 52px;">
                <h4>{{ $property->surface ?? 'N/A' }} m²<br><span>Surface totale</span></h4>
              </li>
              <li>
                <img src="{{ asset('assets/images/info-icon-02.png') }}" alt="" style="max-width: 52px;">
                <h4>{{ $property->rooms ?? 'N/A' }}<br><span>Chambres</span></h4>
              </li>
              <li>
                <img src="{{ asset('assets/images/info-icon-03.png') }}" alt="" style="max-width: 52px;">
                <h4>{{ $property->bathrooms ?? 'N/A' }}<br><span>Salles de bain</span></h4>
              </li>
              <li>
                <img src="{{ asset('assets/images/info-icon-04.png') }}" alt="" style="max-width: 52px;">
                <h4>{{ $property->parking ? 'Oui' : 'Non' }}<br><span>Parking</span></h4>
              </li>
            </ul>
          </div>

          <!-- Carte Agence avec bouton de contact -->
          <div class="card border-0 shadow-sm mt-4" style="border-radius: 15px;">
            <div class="card-header bg-white border-0 py-3">
              <h5 class="mb-0 fw-bold">
                <i class="fas fa-building me-2" style="color: #ff6b35;"></i>
                Agence
              </h5>
            </div>
            <div class="card-body p-4">
              <div class="d-flex align-items-center mb-3">
                <div class="rounded-circle p-3 me-3"
                     style="background: linear-gradient(135deg, #ff6b35, #f7931e);">
                  <i class="fas fa-building text-white fs-4"></i>
                </div>
                <div>
                  <h6 class="mb-1 fw-bold">{{ $property->user->name ?? 'Agence' }}</h6>
                  <small class="text-muted">
                    <i class="fas fa-certificate me-1" style="color: #28a745;"></i>
                    Agence vérifiée
                  </small>
                </div>
              </div>

              @if($property->user && $property->user->email)
                <div class="mb-2">
                  <i class="fas fa-envelope me-2" style="color: #ff6b35;"></i>
                  <small>{{ $property->user->email }}</small>
                </div>
              @endif

              @if($property->user && $property->user->phone)
                <div class="mb-3">
                  <i class="fas fa-phone me-2" style="color: #ff6b35;"></i>
                  <small>{{ $property->user->phone }}</small>
                </div>
              @endif

              <hr class="my-3">

              <!-- Bouton Contacter l'agence -->
              @auth
                <a href="{{ route('leads.create', $property->id) }}"
                   class="btn w-100 text-white fw-semibold shadow"
                   style="background: linear-gradient(135deg, #ff6b35 0%, #f7931e 100%);
                          border-radius: 12px; border: none; padding: 12px;">
                  <i class="fas fa-envelope me-2"></i>Contacter l'agence
                </a>
              @else
                <a href="{{ route('login') }}"
                   class="btn w-100 text-white fw-semibold shadow"
                   style="background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
                          border-radius: 12px; border: none; padding: 12px;">
                  <i class="fas fa-sign-in-alt me-2"></i>Connectez-vous pour contacter
                </a>
              @endauth

              <!-- Informations supplémentaires -->
              <div class="mt-3 p-3" style="background: #f8f9fa; border-radius: 10px;">
                <small class="text-muted">
                  <i class="fas fa-shield-alt me-2" style="color: #28a745;"></i>
                  Vos informations sont protégées et ne seront partagées qu'avec cette agence.
                </small>
              </div>
            </div>
          </div>

          <!-- Statistiques de la propriété -->
          <div class="card border-0 shadow-sm mt-4" style="border-radius: 15px;">
            <div class="card-body p-4">
              <h6 class="fw-bold mb-3">
                <i class="fas fa-chart-line me-2" style="color: #ff6b35;"></i>
                Statistiques
              </h6>
              {{-- <div class="d-flex justify-content-between mb-2">
                <span class="text-muted small">Vues</span>
                <span class="fw-bold">{{ $property->views ?? 0 }}</span>
              </div> --}}
              <div class="d-flex justify-content-between mb-2">
                <span class="text-muted small">Publié</span>
                <span class="fw-bold">{{ $property->created_at->diffForHumans() }}</span>
              </div>
              <div class="d-flex justify-content-between">
                <span class="text-muted small">Référence</span>
                <span class="fw-bold">#{{ $property->id }}</span>
              </div>
            </div>
          </div>

          <!-- Partage social -->
          <div class="card border-0 shadow-sm mt-4" style="border-radius: 15px;">
            <div class="card-body p-4">
              <h6 class="fw-bold mb-3">
                <i class="fas fa-share-alt me-2" style="color: #ff6b35;"></i>
                Partager
              </h6>
              <div class="d-flex gap-2">
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}"
                   target="_blank"
                   class="btn btn-outline-primary flex-fill">
                  <i class="fab fa-facebook-f"></i>
                </a>
                <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($property->title) }}"
                   target="_blank"
                   class="btn btn-outline-info flex-fill">
                  <i class="fab fa-twitter"></i>
                </a>
                <a href="https://wa.me/?text={{ urlencode($property->title . ' ' . request()->url()) }}"
                   target="_blank"
                   class="btn btn-outline-success flex-fill">
                  <i class="fab fa-whatsapp"></i>
                </a>
                <button onclick="copyLink()" class="btn btn-outline-secondary flex-fill">
                  <i class="fas fa-link"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Section propriétés similaires -->
  @if($similarProperties && $similarProperties->count() > 0)
  <div class="section best-deal">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="section-heading text-center">
            <h6>| Propriétés similaires</h6>
            <h2>Découvrez d'autres biens</h2>
          </div>
        </div>
      </div>
      <div class="row mt-4">
        @foreach($similarProperties as $similar)
          <div class="col-lg-4 col-md-6 mb-4">
            <div class="item property-card" style="cursor: pointer;"
                 onclick="window.location.href='{{ route('properties.show', $similar->id) }}'">
              <div style="position: relative;">
                @if($similar->images->count() > 0)
                  <img src="{{ Storage::url($similar->images->first()->image_path) }}"
                       alt="{{ $similar->title }}"
                       style="width: 100%; height: 200px; object-fit: cover; border-radius: 10px;">
                @endif
                <div style="position: absolute; top: 10px; right: 10px; background: {{ $similar->transaction_type == 'vente' ? '#28a745' : '#007bff' }}; color: white; padding: 5px 15px; border-radius: 20px; font-size: 0.75rem;">
                  {{ $similar->transaction_type == 'vente' ? 'Vente' : 'Location' }}
                </div>
              </div>
              <h5 class="mt-3">{{ $similar->title }}</h5>
              <p class="text-muted"><i class="fa fa-map-marker-alt me-2"></i>{{ $similar->city }}</p>
              <h6 style="color: #ff6b35;">{{ $similar->formatted_price_short }}</h6>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
  @endif

  <script>
    function copyLink() {
      navigator.clipboard.writeText(window.location.href);
      alert('Lien copié dans le presse-papiers !');
    }
  </script>

  <style>
    .property-card:hover {
      transform: translateY(-5px);
      transition: all 0.3s ease;
    }

    .btn:hover {
      transform: translateY(-2px);
      transition: all 0.3s ease;
    }
  </style>
@endsection
