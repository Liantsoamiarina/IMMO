@extends('layouts.auth')
@section('body')
<div class="min-vh-100 d-flex align-items-center position-relative py-5"
     style="background: linear-gradient(135deg, #ff6b35 0%, #f7931e 30%, #2c3e50 70%, #1a1a1a 100%);">

    <!-- Éléments décoratifs flottants -->
    <div class="position-absolute w-100 h-100 overflow-hidden" style="pointer-events: none;">
        <div class="position-absolute rounded-circle opacity-10"
             style="width: 200px; height: 200px; background: #ff6b35; top: 10%; left: -5%; animation: float 6s ease-in-out infinite;"></div>
        <div class="position-absolute rounded-circle opacity-10"
             style="width: 150px; height: 150px; background: #f7931e; bottom: 15%; right: -5%; animation: float 8s ease-in-out infinite reverse;"></div>
        <div class="position-absolute rounded-circle opacity-5"
             style="width: 300px; height: 300px; background: #ff6b35; top: 50%; left: 80%; animation: float 10s ease-in-out infinite;"></div>
    </div>

    <div class="container position-relative">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <!-- En-tête -->
                <div class="text-center mb-5">
                    <div class="mb-3">
                        <div class="bg-gradient-orange rounded-circle d-inline-flex align-items-center justify-content-center shadow-lg"
                             style="width: 80px; height: 80px; background: linear-gradient(135deg, #ff6b35, #f7931e);">
                            <i class="fas fa-crown text-white" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                    <h1 class="text-white display-5 fw-bold mb-3" style="text-shadow: 2px 2px 4px rgba(0,0,0,0.3);">
                        Finaliser votre abonnement
                    </h1>
                    <p class="text-white-50 lead mb-0">Complétez vos informations pour activer votre plan</p>
                </div>

                <!-- Messages Flash -->
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show mb-4 border-0 shadow"
                         style="border-left: 4px solid #28a745 !important;" role="alert">
                        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show mb-4 border-0 shadow"
                         style="border-left: 4px solid #dc3545 !important;" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('info'))
                    <div class="alert alert-info alert-dismissible fade show mb-4 border-0 shadow"
                         style="border-left: 4px solid #17a2b8 !important;" role="alert">
                        <i class="fas fa-info-circle me-2"></i>{{ session('info') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <div class="row g-4">
                    <!-- Récapitulatif du plan sélectionné -->
                    <div class="col-lg-4">
                        <div class="card border-0 shadow-lg h-100"
                             style="border-radius: 20px; background: rgba(255, 255, 255, 0.95);">
                            <div class="card-header border-0 text-center py-4"
                                 style="background: linear-gradient(135deg, #2c3e50 0%, #1a1a1a 100%); border-radius: 20px 20px 0 0;">
                                <h5 class="text-white mb-0 fw-semibold">
                                    <i class="fas fa-shopping-cart me-2"></i>Votre sélection
                                </h5>
                            </div>
                            <div class="card-body p-4">
                                <!-- Sélecteur de plan -->
                                <div class="mb-4">
                                    <label for="planSelector" class="form-label small fw-semibold mb-2">
                                        <i class="fas fa-layer-group me-2" style="color: #ff6b35;"></i>
                                        Changer de plan
                                    </label>
                                    <select id="planSelector"
                                            class="form-select form-select-lg"
                                            style="border-radius: 12px; border: 2px solid #e8e8e8;"
                                            onchange="changePlan(this.value)">
                                        <option value="free">Gratuit</option>
                                        <option value="silver" selected>Silver</option>
                                        <option value="gold">Gold</option>
                                    </select>
                                </div>

                                <!-- Plan sélectionné -->
                                <div class="text-center mb-4" id="selectedPlanDisplay">
                                    <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                                         id="planIconContainer"
                                         style="width: 70px; height: 70px; background: linear-gradient(135deg, #ff6b35, #f7931e); transition: all 0.3s ease;">
                                        <i class="fas fa-building text-white fs-3" id="planIcon"></i>
                                    </div>
                                    <h4 class="fw-bold mb-2" id="planName">Silver</h4>
                                    <p class="text-muted small mb-0" id="planDescription">Idéal pour les investisseurs sérieux</p>
                                </div>

                                <div class="border-top pt-3 mb-3">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span class="text-muted">Prix mensuel</span>
                                        <span class="fw-bold" style="color: #ff6b35;" id="planPrice">39 000 Ar</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span class="text-muted">Durée</span>
                                        <span class="fw-semibold">1 mois</span>
                                    </div>
                                </div>

                                <div class="border-top pt-3">
                                    <p class="small fw-semibold mb-2">
                                        <i class="fas fa-check-circle me-2" style="color: #28a745;"></i>Fonctionnalités incluses :
                                    </p>
                                    <ul class="list-unstyled small" id="planFeatures">
                                        <li class="mb-2">
                                            <i class="fas fa-check text-success me-2"></i>Tout du plan Gratuit
                                        </li>
                                        <li class="mb-2">
                                            <i class="fas fa-check text-success me-2"></i>20 annonces par mois
                                        </li>
                                        <li class="mb-2">
                                            <i class="fas fa-check text-success me-2"></i>Filtres de recherche avancés
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-footer border-0 text-center py-3"
                                 style="background: linear-gradient(135deg, rgba(255, 107, 53, 0.1), rgba(247, 147, 30, 0.1)); border-radius: 0 0 20px 20px;">
                                <p class="small text-muted mb-0">
                                    <i class="fas fa-shield-alt me-1" style="color: #ff6b35;"></i>
                                    Paiement 100% sécurisé
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Formulaire d'abonnement -->
                    <div class="col-lg-8">
                        <div class="card border-0 shadow-lg"
                             style="border-radius: 20px; background: rgba(255, 255, 255, 0.95);">
                            <div class="card-body p-5">
                                <form action="{{ route('activation.store') }}" method="POST" id="subscriptionForm">
                                    @csrf
                                    <input type="hidden" name="plan" id="planInput" value="silver">

                                    <!-- Section 1: Informations personnelles (Simulées) -->
                                    <div class="mb-5">
                                        <h5 class="fw-bold mb-4" style="color: #2c3e50;">
                                            <i class="fas fa-user me-2" style="color: #ff6b35;"></i>
                                            1. Informations personnelles
                                        </h5>

                                        <div class="alert alert-info border-0 shadow-sm" style="border-left: 4px solid #17a2b8 !important;">
                                            <i class="fas fa-info-circle me-2"></i>
                                            <strong>Utilisateur connecté :</strong> {{ Auth::user()->name }} ({{ Auth::user()->email }})
                                        </div>

                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label for="firstName" class="form-label small fw-semibold mb-2">
                                                    Prénom <span class="text-danger">*</span>
                                                </label>
                                                <input type="text"
                                                       name="first_name"
                                                       id="firstName"
                                                       class="form-control form-control-lg @error('first_name') is-invalid @enderror"
                                                       value="{{ old('first_name',  Auth::user()->name) }}"
                                                       placeholder="Prénom simulé"
                                                       style="border-radius: 12px; border: 2px solid #e8e8e8;"
                                                       required>
                                                @error('first_name')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                <small class="text-muted"> ce champ est pré-rempli</small>
                                            </div>

                                            <div class="col-md-6">
                                                <label for="lastName" class="form-label small fw-semibold mb-2">
                                                    Nom <span class="text-danger">*</span>
                                                </label>
                                                <input type="text"
                                                       name="last_name"
                                                       id="lastName"
                                                       class="form-control form-control-lg @error('last_name') is-invalid @enderror"
                                                       value="{{ old('last_name', 'Doe') }}"
                                                       placeholder="Nom simulé"
                                                       style="border-radius: 12px; border: 2px solid #e8e8e8;"
                                                       required>
                                                @error('last_name')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                <small class="text-muted">ce champ est pré-rempli</small>
                                            </div>

                                            <div class="col-md-6">
                                                <label for="email" class="form-label small fw-semibold mb-2">
                                                    Email <span class="text-danger">*</span>
                                                </label>
                                                <input type="email"
                                                       name="email"
                                                       id="email"
                                                       class="form-control form-control-lg @error('email') is-invalid @enderror"
                                                       value="{{ old('email', Auth::user()->email) }}"
                                                       placeholder="exemple@email.com"
                                                       style="border-radius: 12px; border: 2px solid #e8e8e8;"
                                                       required>
                                                @error('email')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="col-md-6">
                                                <label for="phone" class="form-label small fw-semibold mb-2">
                                                    Téléphone <span class="text-danger">*</span>
                                                </label>
                                                <input type="tel"
                                                       name="phone"
                                                       id="phone"
                                                       class="form-control form-control-lg @error('phone') is-invalid @enderror"
                                                       value="{{ old('phone', '+261340000000') }}"
                                                       placeholder="+261 34 00 000 00"
                                                       style="border-radius: 12px; border: 2px solid #e8e8e8;"
                                                       required>
                                                @error('phone')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Section 2: Méthode de paiement (Simulée) -->
                                    <div class="mb-5">
                                        <h5 class="fw-bold mb-4" style="color: #2c3e50;">
                                            <i class="fas fa-credit-card me-2" style="color: #ff6b35;"></i>
                                            2. Méthode de paiement
                                        </h5>

                                        <div class="alert alert-warning border-0 shadow-sm" style="border-left: 4px solid #ffc107 !important;">
                                            <i class="fas fa-exclamation-triangle me-2"></i>
                                            <strong>Mode de payement :</strong>  L'abonnement sera en attente de validation par un administrateur.
                                        </div>

                                        <div class="row g-3">
                                            <!-- Mobile Money -->
                                            <div class="col-md-6">
                                                <div class="form-check border rounded-3 p-4 h-100"
                                                     style="cursor: pointer; transition: all 0.3s ease;"
                                                     onclick="selectPaymentMethod('mobile_money')">
                                                    <input class="form-check-input"
                                                           type="radio"
                                                           name="payment_method"
                                                           id="mobileMoney"
                                                           value="mobile_money"
                                                           checked>
                                                    <label class="form-check-label w-100" for="mobileMoney" style="cursor: pointer;">
                                                        <div class="d-flex align-items-center">
                                                            <div class="bg-light rounded-circle p-3 me-3">
                                                                <i class="fas fa-mobile-alt fs-4" style="color: #ff6b35;"></i>
                                                            </div>
                                                            <div>
                                                                <h6 class="mb-1 fw-semibold">Mobile Money</h6>
                                                                <small class="text-muted">MVola, Orange Money, Airtel Money</small>
                                                            </div>
                                                        </div>
                                                    </label>
                                                </div>
                                            </div>

                                            <!-- Carte bancaire -->
                                            <div class="col-md-6">
                                                <div class="form-check border rounded-3 p-4 h-100"
                                                     style="cursor: pointer; transition: all 0.3s ease;"
                                                     onclick="selectPaymentMethod('card')">
                                                    <input class="form-check-input"
                                                           type="radio"
                                                           name="payment_method"
                                                           id="card"
                                                           value="card">
                                                    <label class="form-check-label w-100" for="card" style="cursor: pointer;">
                                                        <div class="d-flex align-items-center">
                                                            <div class="bg-light rounded-circle p-3 me-3">
                                                                <i class="fas fa-credit-card fs-4" style="color: #ff6b35;"></i>
                                                            </div>
                                                            <div>
                                                                <h6 class="mb-1 fw-semibold">Carte bancaire</h6>
                                                                <small class="text-muted">Visa, Mastercard</small>
                                                            </div>
                                                        </div>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Mobile Money Details -->
                                        <div id="mobileMoneyDetails" class="mt-3">
                                            <div class="row g-3">
                                                <div class="col-md-6">
                                                    <label for="mobileOperator" class="form-label small fw-semibold mb-2">
                                                        Opérateur <span class="text-danger">*</span>
                                                    </label>
                                                    <select name="mobile_operator"
                                                            id="mobileOperator"
                                                            class="form-select form-select-lg @error('mobile_operator') is-invalid @enderror"
                                                            style="border-radius: 12px; border: 2px solid #e8e8e8;">
                                                        <option value="">Sélectionner un opérateur</option>
                                                        <option value="mvola" {{ old('mobile_operator') == 'mvola' ? 'selected' : '' }}>MVola</option>
                                                        <option value="orange_money" {{ old('mobile_operator') == 'orange_money' ? 'selected' : '' }}>Orange Money</option>
                                                        <option value="airtel_money" {{ old('mobile_operator') == 'airtel_money' ? 'selected' : '' }}>Airtel Money</option>
                                                    </select>
                                                    @error('mobile_operator')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="mobileNumber" class="form-label small fw-semibold mb-2">
                                                        Numéro Mobile Money <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="tel"
                                                           name="mobile_number"
                                                           id="mobileNumber"
                                                           class="form-control form-control-lg @error('mobile_number') is-invalid @enderror"
                                                           value="{{ old('mobile_number') }}"
                                                           placeholder="+261 34 00 000 00"
                                                           style="border-radius: 12px; border: 2px solid #e8e8e8;">
                                                    @error('mobile_number')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Card Details (hidden by default) -->
                                        <div id="cardDetails" class="mt-3 d-none">
                                            <div class="row g-3">
                                                <div class="col-12">
                                                    <label for="cardNumber" class="form-label small fw-semibold mb-2">
                                                        Numéro de carte <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text"
                                                           name="card_number"
                                                           id="cardNumber"
                                                           class="form-control form-control-lg @error('card_number') is-invalid @enderror"
                                                           value="{{ old('card_number') }}"
                                                           placeholder="1234 5678 9012 3456"
                                                           style="border-radius: 12px; border: 2px solid #e8e8e8;">
                                                    @error('card_number')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-8">
                                                    <label for="cardExpiry" class="form-label small fw-semibold mb-2">
                                                        Date d'expiration <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text"
                                                           name="card_expiry"
                                                           id="cardExpiry"
                                                           class="form-control form-control-lg @error('card_expiry') is-invalid @enderror"
                                                           value="{{ old('card_expiry') }}"
                                                           placeholder="MM/AA"
                                                           style="border-radius: 12px; border: 2px solid #e8e8e8;">
                                                    @error('card_expiry')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="cardCvv" class="form-label small fw-semibold mb-2">
                                                        CVV <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text"
                                                           name="card_cvv"
                                                           id="cardCvv"
                                                           class="form-control form-control-lg @error('card_cvv') is-invalid @enderror"
                                                           value="{{ old('card_cvv') }}"
                                                           placeholder="123"
                                                           style="border-radius: 12px; border: 2px solid #e8e8e8;">
                                                    @error('card_cvv')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Conditions générales -->
                                    <div class="mb-4">
                                        <div class="form-check p-3 border rounded-3 @error('terms') border-danger @enderror"
                                             style="background: rgba(255, 107, 53, 0.05);">
                                            <input type="checkbox"
                                                   name="terms"
                                                   id="terms"
                                                   class="form-check-input @error('terms') is-invalid @enderror"
                                                   style="border-radius: 6px; border: 2px solid #e8e8e8;"
                                                   {{ old('terms') ? 'checked' : '' }}
                                                   required>
                                            <label for="terms" class="form-check-label small">
                                                <i class="fas fa-file-contract me-2" style="color: #ff6b35;"></i>
                                                J'accepte les <a href="#" class="fw-semibold" style="color: #ff6b35;">conditions générales</a>
                                                et la <a href="#" class="fw-semibold" style="color: #ff6b35;">politique de confidentialité</a>
                                                <span class="text-danger">*</span>
                                            </label>
                                            @error('terms')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Boutons d'action -->
                                    <div class="d-flex gap-3">
                                        <a href="{{ route('homepage') }}"
                                           class="btn btn-outline-secondary btn-lg flex-fill"
                                           style="border-radius: 12px; border-width: 2px;">
                                            <i class="fas fa-arrow-left me-2"></i>Retour
                                        </a>
                                        <button type="submit"
                                                class="btn btn-lg flex-fill text-white fw-semibold shadow-lg"
                                                id="submitBtn"
                                                style="background: linear-gradient(135deg, #ff6b35 0%, #f7931e 100%);
                                                       border-radius: 12px; border: none; transition: all 0.3s ease;">
                                            <span id="submitText">
                                                <i class="fas fa-lock me-2"></i>Confirmer l'abonnement
                                            </span>
                                            <span id="submitSpinner" class="d-none">
                                                <span class="spinner-border spinner-border-sm me-2" role="status"></span>
                                                Traitement en cours...
                                            </span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Styles personnalisés -->
<style>
    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-20px); }
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #ff6b35 !important;
        box-shadow: 0 0 0 0.25rem rgba(255, 107, 53, 0.25) !important;
        transform: translateY(-2px);
    }

    .form-control,
    .form-select {
        transition: all 0.3s ease;
    }

    #planIconContainer {
        transition: all 0.3s ease;
    }

    #planSelector {
        transition: all 0.3s ease;
    }

    #planSelector:hover {
        border-color: #ff6b35 !important;
        transform: translateY(-2px);
    }

    .btn:hover {
        transform: translateY(-3px) scale(1.02);
        box-shadow: 0 8px 25px rgba(255, 107, 53, 0.3) !important;
    }

    .card {
        animation: slideInUp 0.8s ease-out;
    }

    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .form-check:has(input[type="radio"]:checked) {
        border-color: #ff6b35 !important;
        border-width: 2px !important;
        background: rgba(255, 107, 53, 0.05);
    }

    .form-check:hover {
        border-color: #ff6b35 !important;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(255, 107, 53, 0.2);
    }

    .alert {
        animation: slideInDown 0.5s ease-out;
    }

    @keyframes slideInDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<!-- Scripts -->
<script>
    // Données des plans (synchronisé avec le modèle Subscription)
    const plans = {
        free: {
            name: 'Gratuit',
            price: '0 Ar',
            icon: 'fa-home',
            gradient: 'linear-gradient(135deg, #6c757d, #495057)',
            description: 'Parfait pour découvrir nos services',
            features: [
                'Accès aux annonces publiques',
                'Filtres de recherche basiques',
                '5 annonces par mois'
            ]
        },
        silver: {
            name: 'Silver',
            price: '39 000 Ar',
            icon: 'fa-building',
            gradient: 'linear-gradient(135deg, #ff6b35, #f7931e)',
            description: 'Idéal pour les investisseurs sérieux',
            features: [
                'Tout du plan Gratuit',
                '20 annonces par mois',
                'Filtres de recherche avancés'
            ]
        },
        gold: {
            name: 'Gold',
            price: '79 000 Ar',
            icon: 'fa-crown',
            gradient: 'linear-gradient(135deg, #ffc107, #ff9800)',
            description: 'Pour les professionnels exigeants',
            features: [
                'Tout du plan Silver',
                'Annonces illimitées',
                'Conseiller personnel dédié',
                'Analyses de marché privées'
            ]
        }
    };

    // Fonction pour changer de plan
    function changePlan(planKey) {
        const selectedPlan = plans[planKey];
        const iconContainer = document.getElementById('planIconContainer');

        // Animation de transition
        iconContainer.style.transform = 'scale(0.8)';
        iconContainer.style.opacity = '0.5';

        setTimeout(() => {
            // Mettre à jour les informations
            document.getElementById('planInput').value = planKey;
            document.getElementById('planName').textContent = selectedPlan.name;
            document.getElementById('planPrice').textContent = selectedPlan.price;
            document.getElementById('planDescription').textContent = selectedPlan.description;
            document.getElementById('planIcon').className = `fas ${selectedPlan.icon} text-white fs-3`;
            iconContainer.style.background = selectedPlan.gradient;

            // Mettre à jour les fonctionnalités
            const featuresHtml = selectedPlan.features.map(feature =>
                `<li class="mb-2"><i class="fas fa-check text-success me-2"></i>${feature}</li>`
            ).join('');
            document.getElementById('planFeatures').innerHTML = featuresHtml;

            // Restaurer l'animation
            iconContainer.style.transform = 'scale(1)';
            iconContainer.style.opacity = '1';
        }, 200);
    }

    // Gérer les méthodes de paiement
    function selectPaymentMethod(method) {
        const mobileMoneyDetails = document.getElementById('mobileMoneyDetails');
        const cardDetails = document.getElementById('cardDetails');

        if (method === 'mobile_money') {
            mobileMoneyDetails.classList.remove('d-none');
            cardDetails.classList.add('d-none');
            document.getElementById('mobileMoney').checked = true;

            // Rendre les champs mobile money requis
            document.getElementById('mobileOperator').required = true;
            document.getElementById('mobileNumber').required = true;

            // Enlever le requis des champs carte
            document.getElementById('cardNumber').required = false;
            document.getElementById('cardExpiry').required = false;
            document.getElementById('cardCvv').required = false;
        } else if (method === 'card') {
            mobileMoneyDetails.classList.add('d-none');
            cardDetails.classList.remove('d-none');
            document.getElementById('card').checked = true;

            // Enlever le requis des champs mobile money
            document.getElementById('mobileOperator').required = false;
            document.getElementById('mobileNumber').required = false;

            // Rendre les champs carte requis
            document.getElementById('cardNumber').required = true;
            document.getElementById('cardExpiry').required = true;
            document.getElementById('cardCvv').required = true;
        }
    }

    // Charger les informations du plan depuis l'URL
    window.addEventListener('DOMContentLoaded', function() {
        const urlParams = new URLSearchParams(window.location.search);
        const plan = urlParams.get('plan') || 'silver';

        // Mettre à jour le sélecteur
        document.getElementById('planSelector').value = plan;

        // Charger le plan initial
        changePlan(plan);

        // Initialiser l'état des champs de paiement
        const paymentMethod = document.querySelector('input[name="payment_method"]:checked').value;
        selectPaymentMethod(paymentMethod);
    });

    // Gérer la soumission du formulaire
    document.getElementById('subscriptionForm').addEventListener('submit', function(e) {
        const submitBtn = document.getElementById('submitBtn');
        const submitText = document.getElementById('submitText');
        const submitSpinner = document.getElementById('submitSpinner');

        submitText.classList.add('d-none');
        submitSpinner.classList.remove('d-none');
        submitBtn.disabled = true;
        submitBtn.style.cursor = 'not-allowed';
        submitBtn.style.transform = 'scale(0.98)';

        // Fallback après 10 secondes
        setTimeout(() => {
            submitText.classList.remove('d-none');
            submitSpinner.classList.add('d-none');
            submitBtn.disabled = false;
            submitBtn.style.cursor = 'pointer';
            submitBtn.style.transform = 'scale(1)';
        }, 10000);
    });

    // Auto-dismiss alerts
    setTimeout(() => {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach((alert, index) => {
            setTimeout(() => {
                alert.style.animation = 'slideInUp 0.5s ease-out reverse';
                setTimeout(() => {
                    if (typeof bootstrap !== 'undefined') {
                        const bsAlert = new bootstrap.Alert(alert);
                        bsAlert.close();
                    }
                }, 500);
            }, index * 200);
        });
    }, 5000);

    // Format phone number
    const phoneInputs = document.querySelectorAll('input[type="tel"]');
    phoneInputs.forEach(input => {
        input.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length > 0) {
                if (!value.startsWith('261')) {
                    if (value.startsWith('0')) {
                        value = '261' + value.substring(1);
                    } else {
                        value = '261' + value;
                    }
                }
            }
            e.target.value = value ? '+' + value : '';
        });
    });

    // Format card number
    const cardNumberInput = document.getElementById('cardNumber');
    if (cardNumberInput) {
        cardNumberInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\s/g, '');
            let formattedValue = value.match(/.{1,4}/g)?.join(' ') || value;
            e.target.value = formattedValue;
        });
    }

    // Format card expiry
    const cardExpiryInput = document.getElementById('cardExpiry');
    if (cardExpiryInput) {
        cardExpiryInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length >= 2) {
                value = value.substring(0, 2) + '/' + value.substring(2, 4);
            }
            e.target.value = value;
        });
    }

    // Limit CVV to 3 digits
    const cardCvvInput = document.getElementById('cardCvv');
    if (cardCvvInput) {
        cardCvvInput.addEventListener('input', function(e) {
            e.target.value = e.target.value.replace(/\D/g, '').substring(0, 3);
        });
    }

    // Animation sur les inputs au focus
    document.querySelectorAll('.form-control, .form-select').forEach(input => {
        input.addEventListener('focus', function() {
            this.style.transform = 'translateY(-2px)';
        });

        input.addEventListener('blur', function() {
            this.style.transform = 'translateY(0)';
        });
    });

    // Validation temps réel
    const emailInput = document.getElementById('email');
    if (emailInput) {
        emailInput.addEventListener('blur', function() {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (this.value && !emailRegex.test(this.value)) {
                this.classList.add('is-invalid');
            } else {
                this.classList.remove('is-invalid');
            }
        });
    }

    // Smooth scroll to error
    const firstError = document.querySelector('.is-invalid');
    if (firstError) {
        firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }
</script>
@endsection
