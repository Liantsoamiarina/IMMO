@extends('layouts.auth')
@section('body')
<div class="min-vh-100 d-flex align-items-center position-relative"
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
        <div class="row justify-content-center align-items-center">
            <!-- Message d'accueil à gauche (caché sur mobile) -->
            <div class="col-lg-6 d-none d-lg-block text-white">
                <div class="pe-5">
                    <h1 class="display-4 fw-bold mb-4" style="text-shadow: 2px 2px 4px rgba(0,0,0,0.3);">
                        Bienvenue sur <span style="color: #ff6b35;">EMMO</span>
                    </h1>
                    <p class="lead mb-4" style="text-shadow: 1px 1px 2px rgba(0,0,0,0.3);">
                        Découvrez une nouvelle façon de gérer vos propriétés et de trouver votre logement idéal.
                    </p>

                    <!-- Avantages avec icônes -->
                    <div class="row g-4 mb-5">
                        <div class="col-6">
                            <div class="d-flex align-items-center">
                                <div class="bg-gradient-orange rounded-circle p-3 me-3 shadow"
                                     style="background: linear-gradient(135deg, #ff6b35, #f7931e);">
                                    <i class="fas fa-search text-white fs-5"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1 fw-semibold">Recherche facile</h6>
                                    <small class="text-white-50">Trouvez rapidement</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex align-items-center">
                                <div class="bg-gradient-orange rounded-circle p-3 me-3 shadow"
                                     style="background: linear-gradient(135deg, #ff6b35, #f7931e);">
                                    <i class="fas fa-shield-alt text-white fs-5"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1 fw-semibold">100% Sécurisé</h6>
                                    <small class="text-white-50">Données protégées</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex align-items-center">
                                <div class="bg-gradient-orange rounded-circle p-3 me-3 shadow"
                                     style="background: linear-gradient(135deg, #ff6b35, #f7931e);">
                                    <i class="fas fa-clock text-white fs-5"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1 fw-semibold">Support 24/7</h6>
                                    <small class="text-white-50">Aide disponible</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex align-items-center">
                                <div class="bg-gradient-orange rounded-circle p-3 me-3 shadow"
                                     style="background: linear-gradient(135deg, #ff6b35, #f7931e);">
                                    <i class="fas fa-users text-white fs-5"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1 fw-semibold">Communauté</h6>
                                    <small class="text-white-50">Plus de 10k membres</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Formulaire de connexion à droite -->
            <div class="col-md-8 col-lg-5">
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

                <!-- Carte de Connexion -->
                <div class="card border-0 shadow-xl"
                     style="backdrop-filter: blur(20px); background: rgba(255, 255, 255, 0.95); border-radius: 20px;">

                    <!-- En-tête accueillant -->
                    <div class="card-header border-0 text-center py-5"
                         style="background: linear-gradient(135deg, #2c3e50 0%, #1a1a1a 100%); border-radius: 20px 20px 0 0;">
                        <div class="mb-3">
                            <div class="bg-gradient-orange rounded-circle d-inline-flex align-items-center justify-content-center shadow-lg"
                                 style="width: 70px; height: 70px; background: linear-gradient(135deg, #ff6b35, #f7931e);">
                                <i class="fas fa-home text-white" style="font-size: 1.8rem;"></i>
                            </div>
                        </div>
                        <h3 class="text-white mb-2 fw-light">Content de vous revoir !</h3>
                        <p class="text-white-50 small mb-0">Connectez-vous pour accéder à votre espace</p>
                    </div>

                    <!-- Corps du formulaire -->
                    <div class="card-body p-5">
                        <form action="{{ route('login') }}" method="POST" id="loginForm">
                            @csrf

                            <!-- Champ Email avec animation -->
                            <div class="mb-4">
                                <label for="email" class="form-label text-dark small fw-semibold mb-2">
                                    <i class="fas fa-envelope me-2" style="color: #ff6b35;"></i>Adresse email
                                </label>
                                <div class="position-relative">
                                    <input type="email"
                                           name="email"
                                           id="email"
                                           class="form-control form-control-lg @error('email') is-invalid @enderror"
                                           value="{{ old('email') }}"
                                           placeholder="exemple@email.com"
                                           style="border-radius: 15px; border: 2px solid #e8e8e8; padding-left: 20px; transition: all 0.3s ease;"
                                           required>
                                    <div class="position-absolute top-0 start-0 w-100 h-100 rounded-3"
                                         style="background: linear-gradient(90deg, transparent, rgba(255, 107, 53, 0.1), transparent);
                                                transform: translateX(-100%); transition: transform 0.6s ease;" id="emailGlow"></div>
                                </div>
                                @error('email')
                                    <div class="invalid-feedback d-block">
                                        <i class="fas fa-exclamation-triangle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Champ Mot de passe avec animation -->
                            <div class="mb-4">
                                <label for="password" class="form-label text-dark small fw-semibold mb-2">
                                    <i class="fas fa-lock me-2" style="color: #ff6b35;"></i>Mot de passe
                                </label>
                                <div class="position-relative">
                                    <input type="password"
                                           name="password"
                                           id="password"
                                           class="form-control form-control-lg @error('password') is-invalid @enderror"
                                           placeholder="••••••••"
                                           style="border-radius: 15px; border: 2px solid #e8e8e8; padding-left: 20px; padding-right: 55px; transition: all 0.3s ease;"
                                           required>
                                    <button type="button"
                                            class="btn position-absolute top-50 end-0 translate-middle-y border-0 bg-transparent"
                                            onclick="togglePassword()"
                                            style="margin-right: 15px;">
                                        <i class="fas fa-eye" style="color: #ff6b35;" id="toggleIcon"></i>
                                    </button>
                                    <div class="position-absolute top-0 start-0 w-100 h-100 rounded-3"
                                         style="background: linear-gradient(90deg, transparent, rgba(255, 107, 53, 0.1), transparent);
                                                transform: translateX(-100%); transition: transform 0.6s ease;" id="passwordGlow"></div>
                                </div>
                                @error('password')
                                    <div class="invalid-feedback d-block">
                                        <i class="fas fa-exclamation-triangle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Options avec style amélioré -->
                            <div class="row mb-4 align-items-center">
                                <div class="col">
                                    <div class="form-check">
                                        <input type="checkbox"
                                               name="remember"
                                               id="remember"
                                               class="form-check-input"
                                               style="border-radius: 6px; border: 2px solid #e8e8e8;">
                                        <label for="remember" class="form-check-label small text-muted">
                                            <i class="fas fa-heart me-1" style="color: #ff6b35;"></i>Se souvenir de moi
                                        </label>
                                    </div>
                                </div>
                                <div class="col text-end">
                                    <a href=""
                                       class="small text-decoration-none fw-semibold"
                                       style="color: #ff6b35;">
                                        <i class="fas fa-key me-1"></i>Mot de passe oublié ?
                                    </a>
                                </div>
                            </div>

                            <!-- Bouton de connexion attrayant -->
                            <button type="submit"
                                    class="btn btn-lg w-100 text-white fw-semibold shadow-lg mb-3"
                                    id="loginBtn"
                                    style="background: linear-gradient(135deg, #ff6b35 0%, #f7931e 100%);
                                           border-radius: 15px; border: none; transition: all 0.3s ease;
                                           transform: perspective(1px) translateZ(0);">
                                <span id="loginText">
                                    <i class="fas fa-sign-in-alt me-2"></i>Se connecter
                                </span>
                                <span id="loginSpinner" class="d-none">
                                    <span class="spinner-border spinner-border-sm me-2" role="status"></span>
                                    Connexion en cours...
                                </span>
                            </button>

                            {{-- <!-- Connexion rapide -->
                            <div class="text-center mb-3">
                                <small class="text-muted">ou connectez-vous avec</small>
                            </div>
                            <div class="row g-2">
                                <div class="col-6">
                                    <button type="button" class="btn btn-outline-dark w-100 py-2"
                                            style="border-radius: 10px; border-width: 2px;">
                                        <i class="fab fa-google me-1" style="color: #ff6b35;"></i>Google
                                    </button>
                                </div>
                                <div class="col-6">
                                    <button type="button" class="btn btn-outline-dark w-100 py-2"
                                            style="border-radius: 10px; border-width: 2px;">
                                        <i class="fab fa-facebook-f me-1" style="color: #ff6b35;"></i>Facebook
                                    </button>
                                </div>
                            </div> --}}
                        </form>
                    </div>

                    <!-- Pied de carte accueillant -->
                    <div class="card-footer border-0 text-center py-4"
                         style="background: linear-gradient(135deg, rgba(255, 107, 53, 0.1), rgba(247, 147, 30, 0.1));
                                border-radius: 0 0 20px 20px;">
                        <p class="text-dark mb-3 small fw-semibold">
                            <i class="fas fa-user-plus me-2" style="color: #ff6b35;"></i>
                            Nouveau sur notre plateforme ?
                        </p>
                        <div class="d-grid gap-2 d-md-block">
                            <a href="{{ route("register") }}"
                               class="btn btn-outline-primary btn-sm px-4 shadow-sm"
                               style="border-radius: 25px; border-width: 2px; border-color: #ff6b35; color: #ff6b35;">
                                <i class="fas fa-user-plus me-1"></i>Créer un compte
                            </a>

                        </div>
                    </div>
                </div>

                <!-- Témoignages rapides (mobile uniquement) -->
                <div class="text-center mt-4 d-lg-none">
                    <div class="row g-3 text-white">
                        <div class="col-4">
                            <div class="p-3">
                                <i class="fas fa-star fs-4 mb-2" style="color: #f7931e;"></i>
                                <p class="small mb-0">4.8/5 étoiles</p>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="p-3">
                                <i class="fas fa-users fs-4 mb-2" style="color: #f7931e;"></i>
                                <p class="small mb-0">10k+ membres</p>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="p-3">
                                <i class="fas fa-home fs-4 mb-2" style="color: #f7931e;"></i>
                                <p class="small mb-0">5k+ propriétés</p>
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

    .form-control:focus {
        border-color: #ff6b35 !important;
        box-shadow: 0 0 0 0.25rem rgba(255, 107, 53, 0.25) !important;
        transform: translateY(-2px);
    }

    .form-control:focus + div {
        transform: translateX(0) !important;
    }

    .btn:hover {
        transform: translateY(-3px) scale(1.02);
        box-shadow: 0 8px 25px rgba(255, 107, 53, 0.3) !important;
    }

    .btn-outline-dark:hover {
        background-color: #2c3e50;
        border-color: #2c3e50;
        transform: translateY(-2px);
    }

    .card {
        transition: all 0.3s ease;
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

    .form-control {
        transition: all 0.3s ease;
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

    /* Hover effects pour les avantages - REMOVED */

    /* Style pour les boutons de connexion rapide */
    .btn-outline-dark {
        transition: all 0.3s ease;
    }

    /* Animation pulse pour l'icône de connexion */
    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.05); }
        100% { transform: scale(1); }
    }

    #loginBtn:hover i {
        animation: pulse 1s infinite;
    }
</style>

<!-- Scripts améliorés -->
<script>
    // Toggle password visibility avec animation
    function togglePassword() {
        const passwordField = document.getElementById('password');
        const toggleIcon = document.getElementById('toggleIcon');

        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            toggleIcon.className = 'fas fa-eye-slash';
            toggleIcon.style.color = '#f7931e';
        } else {
            passwordField.type = 'password';
            toggleIcon.className = 'fas fa-eye';
            toggleIcon.style.color = '#ff6b35';
        }
    }

    // Animations sur focus des inputs
    document.getElementById('email').addEventListener('focus', function() {
        document.getElementById('emailGlow').style.transform = 'translateX(0)';
    });

    document.getElementById('password').addEventListener('focus', function() {
        document.getElementById('passwordGlow').style.transform = 'translateX(0)';
    });

    // Handle form submission avec animation
    document.getElementById('loginForm').addEventListener('submit', function(e) {
        const loginBtn = document.getElementById('loginBtn');
        const loginText = document.getElementById('loginText');
        const loginSpinner = document.getElementById('loginSpinner');

        // Show loading state avec animation
        loginText.classList.add('d-none');
        loginSpinner.classList.remove('d-none');
        loginBtn.disabled = true;
        loginBtn.style.cursor = 'not-allowed';
        loginBtn.style.transform = 'scale(0.98)';

        // Re-enable after 5 seconds (fallback)
        setTimeout(() => {
            loginText.classList.remove('d-none');
            loginSpinner.classList.add('d-none');
            loginBtn.disabled = false;
            loginBtn.style.cursor = 'pointer';
            loginBtn.style.transform = 'scale(1)';
        }, 5000);
    });

    // Auto-dismiss alerts avec animation améliorée
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
    }, 4000);

    // Effet de typing sur le titre (pour les grands écrans)
    if (window.innerWidth > 992) {
        const title = document.querySelector('.display-4');
        if (title) {
            const text = title.textContent;
            title.textContent = '';
            let i = 0;
            const typing = setInterval(() => {
                if (i < text.length) {
                    title.textContent += text.charAt(i);
                    i++;
                } else {
                    clearInterval(typing);
                }
            }, 50);
        }
    }
</script>
@endsection
