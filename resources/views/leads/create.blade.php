@extends("layouts.app")

@section("body")
<div class="page-heading header-text">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <span class="breadcrumb">
          <a href="{{ route('homepage') }}">Accueil</a> /
          <a href="{{ route('properties.show', $property->id) }}">{{ $property->title }}</a> /
          Contacter l'agence
        </span>
        <h3>Contacter l'agence</h3>
      </div>
    </div>
  </div>
</div>

<div class="contact-page section" style="padding: 80px 0;">
  <div class="container">
    <div class="row">
      <!-- Colonne formulaire -->
      <div class="col-lg-7">
        <div class="card border-0 shadow-lg" style="border-radius: 20px;">
          <div class="card-body p-5">
            <h4 class="mb-4 fw-bold" style="color: #333;">
              <i class="fas fa-envelope me-2" style="color: #ff6b35;"></i>
              Envoyer un message
            </h4>

            @if(session('success'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
              </div>
            @endif

            @if(session('error'))
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
              </div>
            @endif

            <form action="{{ route('leads.store', $property->id) }}" method="POST" class="needs-validation" novalidate>
              @csrf

              <!-- Nom -->
              <div class="mb-4">
                <label for="client_name" class="form-label fw-semibold">
                  <i class="fas fa-user me-2" style="color: #ff6b35;"></i>Nom complet *
                </label>
                <input type="text"
                       class="form-control form-control-lg @error('client_name') is-invalid @enderror"
                       id="client_name"
                       name="client_name"
                       value="{{ old('client_name', Auth::user()->name) }}"
                       required
                       style="border-radius: 12px; padding: 14px 20px;">
                @error('client_name')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <!-- Email -->
              <div class="mb-4">
                <label for="client_email" class="form-label fw-semibold">
                  <i class="fas fa-envelope me-2" style="color: #ff6b35;"></i>Email *
                </label>
                <input type="email"
                       class="form-control form-control-lg @error('client_email') is-invalid @enderror"
                       id="client_email"
                       name="client_email"
                       value="{{ old('client_email', Auth::user()->email) }}"
                       required
                       style="border-radius: 12px; padding: 14px 20px;">
                @error('client_email')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <!-- Téléphone -->
              <div class="mb-4">
                <label for="client_phone" class="form-label fw-semibold">
                  <i class="fas fa-phone me-2" style="color: #ff6b35;"></i>Téléphone *
                </label>
                <input type="tel"
                       class="form-control form-control-lg @error('client_phone') is-invalid @enderror"
                       id="client_phone"
                       name="client_phone"
                       value="{{ old('client_phone', Auth::user()->phone ?? '') }}"
                       placeholder="+261 34 00 000 00"
                       required
                       style="border-radius: 12px; padding: 14px 20px;">
                @error('client_phone')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <!-- Message -->
              <div class="mb-4">
                <label for="message" class="form-label fw-semibold">
                  <i class="fas fa-comment-dots me-2" style="color: #ff6b35;"></i>Votre message *
                </label>
                <textarea class="form-control @error('message') is-invalid @enderror"
                          id="message"
                          name="message"
                          rows="6"
                          required
                          style="border-radius: 12px; padding: 14px 20px;">{{ old('message', $property->transaction_type == 'vente'
    ? "Bonjour,\n\nJe suis intéressé(e) par votre propriété \"" . $property->title . "\" à " . $property->city . ".\n\nPuis-je obtenir plus d'informations et organiser une visite ?\n\nCordialement,"
    : "Bonjour,\n\nJe souhaite louer votre bien \"" . $property->title . "\" à " . $property->city . ".\n\nQuand est-il disponible ? Puis-je le visiter ?\n\nCordialement,") }}</textarea>
                <small class="text-muted d-flex justify-content-between">
                  <span><i class="fas fa-lightbulb me-1"></i>Message pré-rempli - Personnalisez-le</span>
                  <span id="charCount">0/1000</span>
                </small>
                @error('message')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <!-- Informations de protection -->
              <div class="alert alert-light border" style="border-radius: 12px; background: #f8f9fa;">
                <i class="fas fa-shield-alt me-2" style="color: #28a745;"></i>
                <small>
                  <strong>Protection des données :</strong> Vos informations personnelles sont sécurisées et ne seront partagées qu'avec l'agence concernée par cette propriété.
                </small>
              </div>

              <!-- Boutons -->
              <div class="d-flex gap-3 mt-4">
                <button type="submit"
                        class="btn btn-lg text-white fw-semibold shadow-lg flex-fill"
                        style="background: linear-gradient(135deg, #ff6b35 0%, #f7931e 100%);
                               border-radius: 12px; border: none; padding: 14px;">
                  <i class="fas fa-paper-plane me-2"></i>Envoyer le message
                </button>
                <a href="{{ route('properties.show', $property->id) }}"
                   class="btn btn-outline-secondary btn-lg"
                   style="border-radius: 12px; padding: 14px 30px;">
                  <i class="fas fa-times me-2"></i>Annuler
                </a>
              </div>
            </form>
          </div>
        </div>
      </div>

      <!-- Colonne propriété -->
      <div class="col-lg-5">
        <!-- Carte propriété -->
        <div class="card border-0 shadow-lg mb-4" style="border-radius: 20px;">
          <div class="card-body p-0">
            @if($property->images->count() > 0)
              <img src="{{ Storage::url($property->images->first()->image_path) }}"
                   alt="{{ $property->title }}"
                   style="width: 100%; height: 250px; object-fit: cover; border-radius: 20px 20px 0 0;">
            @endif
            <div class="p-4">
              <span class="badge px-3 py-2 mb-3"
                    style="background: {{ $property->transaction_type == 'vente' ? 'linear-gradient(135deg, #28a745, #20c997)' : 'linear-gradient(135deg, #007bff, #0dcaf0)' }};
                           border-radius: 20px; font-size: 0.85rem;">
                <i class="fa {{ $property->transaction_type == 'vente' ? 'fa-tag' : 'fa-key' }} me-1"></i>
                {{ $property->transaction_type == 'vente' ? 'À Vendre' : 'À Louer' }}
              </span>

              <h5 class="fw-bold mb-3">{{ $property->title }}</h5>

              <p class="text-muted mb-3">
                <i class="fas fa-map-marker-alt me-2" style="color: #ff6b35;"></i>
                {{ $property->address }}, {{ $property->city }}
              </p>

              <h4 class="fw-bold mb-0" style="color: #ff6b35;">
                {{ $property->formatted_price }}
                @if($property->transaction_type == 'location')
                  <span style="font-size: 0.6em; color: #666;">/ mois</span>
                @endif
              </h4>

              <hr class="my-3">

              <!-- Caractéristiques rapides -->
              <div class="row g-2">
                <div class="col-6">
                  <small class="text-muted d-block">Surface</small>
                  <strong>{{ $property->surface ?? 'N/A' }} m²</strong>
                </div>
                <div class="col-6">
                  <small class="text-muted d-block">Chambres</small>
                  <strong>{{ $property->rooms ?? 'N/A' }}</strong>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Carte agence -->
        <div class="card border-0 shadow-lg" style="border-radius: 20px;">
          <div class="card-body p-4">
            <h6 class="fw-bold mb-3">
              <i class="fas fa-building me-2" style="color: #ff6b35;"></i>
              Informations de l'agence
            </h6>

            <div class="d-flex align-items-center mb-3">
              <div class="rounded-circle p-3 me-3"
                   style="background: linear-gradient(135deg, #ff6b35, #f7931e);">
                <i class="fas fa-building text-white fs-5"></i>
              </div>
              <div>
                <strong class="d-block">{{ $property->user->name }}</strong>
                <small class="text-muted">
                  <i class="fas fa-certificate me-1" style="color: #28a745;"></i>
                  Agence vérifiée
                </small>
              </div>
            </div>

            @if($property->user->email)
              <div class="mb-2">
                <i class="fas fa-envelope me-2" style="color: #ff6b35;"></i>
                <small>{{ $property->user->email }}</small>
              </div>
            @endif

            @if($property->user->phone)
              <div class="mb-2">
                <i class="fas fa-phone me-2" style="color: #ff6b35;"></i>
                <small>{{ $property->user->phone }}</small>
              </div>
            @endif

            <div class="mt-3 p-3" style="background: #f8f9fa; border-radius: 12px;">
              <small class="text-muted">
                <i class="fas fa-clock me-2" style="color: #ff6b35;"></i>
                Temps de réponse moyen : <strong>24h</strong>
              </small>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<style>
  .form-control:focus {
    border-color: #ff6b35;
    box-shadow: 0 0 0 0.2rem rgba(255, 107, 53, 0.15);
  }

  .btn:hover {
    transform: translateY(-2px);
    transition: all 0.3s ease;
  }

  .card {
    transition: all 0.3s ease;
  }
</style>

<script>
  // Validation Bootstrap
  (function() {
    'use strict';
    const forms = document.querySelectorAll('.needs-validation');
    Array.from(forms).forEach(form => {
      form.addEventListener('submit', event => {
        if (!form.checkValidity()) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  })();

  // Compteur de caractères
  const messageField = document.getElementById('message');
  const charCount = document.getElementById('charCount');

  function updateCharCount() {
    const length = messageField.value.length;
    charCount.textContent = length + '/1000';

    if (length > 1000) {
      charCount.style.color = '#dc3545';
      charCount.innerHTML = '<i class="fas fa-exclamation-triangle me-1"></i>' + length + '/1000 - Trop long !';
    } else if (length < 10) {
      charCount.style.color = '#ffc107';
    } else {
      charCount.style.color = '#28a745';
      charCount.innerHTML = '<i class="fas fa-check me-1"></i>' + length + '/1000';
    }
  }

  // Initialiser le compteur
  updateCharCount();

  // Mettre à jour à chaque frappe
  messageField.addEventListener('input', updateCharCount);
  messageField.addEventListener('keyup', updateCharCount);
</script>
@endsection
