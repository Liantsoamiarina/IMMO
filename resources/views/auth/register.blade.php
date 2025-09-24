@extends('layouts.auth')
@section('body')
<div class="min-vh-100 d-flex align-items-center"  style="background: linear-gradient(135deg, #ff6b35 0%, #f7931e 30%, #2c3e50 70%, #1a1a1a 100%);">
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
            <div class="col-md-6 col-lg-5">
                <!-- Messages Flash -->
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <!-- Carte d'inscription -->
                <div class="card border-0 shadow-lg" style="backdrop-filter: blur(10px); background: rgba(255, 255, 255, 0.95);">
                    <!-- En-tête -->
                    <div class="card-header border-0 text-center py-4" style="background: linear-gradient(135deg, #4299e1 0%, #667eea 100%);">
                        <div class="mb-3">
                            <div class="bg-white rounded-circle d-inline-flex align-items-center justify-content-center"
                                 style="width: 60px; height: 60px;">
                                <i class="fas fa-user-plus text-primary fs-3"></i>
                            </div>
                        </div>
                        <h4 class="text-white mb-0 fw-light">Inscription Client</h4>
                        <p class="text-white-50 small mb-0">Créez votre compte client</p>
                    </div>

                    <!-- Corps du formulaire -->
                    <div class="card-body p-4">
                        <form action="{{ route('register') }}" method="post" id="registerForm">
                            @csrf

                            <!-- Champ Nom complet -->
                            <div class="mb-3">
                                <label for="name" class="form-label text-muted small fw-semibold">
                                    <i class="fas fa-user me-2"></i>Nom complet
                                </label>
                                <input type="text"
                                       name="name"
                                       id="name"
                                       class="form-control form-control-lg @error('name') is-invalid @enderror"
                                       value="{{ old('name') }}"
                                       placeholder="Votre nom complet"
                                       style="border-radius: 10px; border: 2px solid #e3e6f0;"
                                       required>
                                @error('name')
                                    <div class="invalid-feedback">
                                        <i class="fas fa-exclamation-triangle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Champ Email -->
                            <div class="mb-3">
                                <label for="email" class="form-label text-muted small fw-semibold">
                                    <i class="fas fa-envelope me-2"></i>Adresse email
                                </label>
                                <input type="email"
                                       name="email"
                                       id="email"
                                       class="form-control form-control-lg @error('email') is-invalid @enderror"
                                       value="{{ old('email') }}"
                                       placeholder="exemple@email.com"
                                       style="border-radius: 10px; border: 2px solid #e3e6f0;"
                                       required>
                                @error('email')
                                    <div class="invalid-feedback">
                                        <i class="fas fa-exclamation-triangle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Champ Mot de passe -->
                            <div class="mb-3">
                                <label for="password" class="form-label text-muted small fw-semibold">
                                    <i class="fas fa-lock me-2"></i>Mot de passe
                                </label>
                                <div class="position-relative">
                                    <input type="password"
                                           name="password"
                                           id="password"
                                           class="form-control form-control-lg @error('password') is-invalid @enderror"
                                           placeholder="••••••••"
                                           style="border-radius: 10px; border: 2px solid #e3e6f0; padding-right: 45px;"
                                           required>
                                    <button type="button"
                                            class="btn position-absolute top-50 end-0 translate-middle-y border-0 bg-transparent"
                                            onclick="togglePassword('password', 'toggleIcon1')"
                                            style="margin-right: 10px;">
                                        <i class="fas fa-eye text-muted" id="toggleIcon1"></i>
                                    </button>
                                </div>
                                @error('password')
                                    <div class="invalid-feedback d-block">
                                        <i class="fas fa-exclamation-triangle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                                <!-- Indicateur de force du mot de passe -->
                                <div class="mt-2">
                                    <div class="progress" style="height: 4px;">
                                        <div class="progress-bar" id="passwordStrength" role="progressbar" style="width: 0%; transition: all 0.3s ease;"></div>
                                    </div>
                                    <small class="text-muted" id="passwordStrengthText"></small>
                                </div>
                            </div>

                            <!-- Champ Confirmation mot de passe -->
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label text-muted small fw-semibold">
                                    <i class="fas fa-lock me-2"></i>Confirmer le mot de passe
                                </label>
                                <div class="position-relative">
                                    <input type="password"
                                           name="password_confirmation"
                                           id="password_confirmation"
                                           class="form-control form-control-lg"
                                           placeholder="••••••••"
                                           style="border-radius: 10px; border: 2px solid #e3e6f0; padding-right: 45px;"
                                           required>
                                    <button type="button"
                                            class="btn position-absolute top-50 end-0 translate-middle-y border-0 bg-transparent"
                                            onclick="togglePassword('password_confirmation', 'toggleIcon2')"
                                            style="margin-right: 10px;">
                                        <i class="fas fa-eye text-muted" id="toggleIcon2"></i>
                                    </button>
                                </div>
                                <!-- Indicateur de correspondance -->
                                <div class="mt-1">
                                    <small id="passwordMatch" class="d-none">
                                        <i class="fas fa-check text-success me-1"></i>
                                        <span class="text-success">Les mots de passe correspondent</span>
                                    </small>
                                    <small id="passwordNoMatch" class="d-none">
                                        <i class="fas fa-times text-danger me-1"></i>
                                        <span class="text-danger">Les mots de passe ne correspondent pas</span>
                                    </small>
                                </div>
                            </div>

                            <!-- Conditions d'utilisation -->
                            <div class="mb-4">
                                <div class="form-check">
                                    <input type="checkbox"
                                           id="terms"
                                           class="form-check-input"
                                           style="border-radius: 4px;"
                                           required>
                                    <label for="terms" class="form-check-label small text-muted">
                                        J'accepte les
                                        <a href="#" class="text-decoration-none" style="color: #667eea;">conditions d'utilisation</a>
                                        et la
                                        <a href="#" class="text-decoration-none" style="color: #667eea;">politique de confidentialité</a>
                                    </label>
                                </div>
                            </div>

                            <!-- Bouton d'inscription -->
                            <button type="submit"
                                    class="btn btn-lg w-100 text-white fw-semibold"
                                    id="registerBtn"
                                    style="background: linear-gradient(135deg, #4299e1 0%, #667eea 100%); border-radius: 10px; border: none; transition: all 0.3s ease;">
                                <span id="registerText">
                                    <i class="fas fa-user-plus me-2"></i>Créer mon compte
                                </span>
                                <span id="registerSpinner" class="d-none">
                                    <span class="spinner-border spinner-border-sm me-2" role="status"></span>
                                    Création en cours...
                                </span>
                            </button>
                        </form>
                    </div>

                    <!-- Pied de carte -->
                    <div class="card-footer border-0 text-center py-4" style="background: rgba(248, 249, 250, 0.8);">
                        {{-- <p class="text-muted mb-2 small">Déjà inscrit ?</p> --}}
                        <a href="{{ route('login.form') }}"
                           class="btn btn-outline-secondary btn-sm px-4"
                           style="border-radius: 20px; border-width: 2px;">
                            <i class="fas fa-sign-in-alt me-1"></i>Se connecter
                        </a>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>

<!-- Styles personnalisés -->
<style>
    .form-control:focus {
        border-color: #4299e1 !important;
        box-shadow: 0 0 0 0.2rem rgba(66, 153, 225, 0.25) !important;
    }

    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    }

    .card {
        transition: all 0.3s ease;
    }

    .form-control {
        transition: all 0.3s ease;
    }

    .form-control:focus {
        transform: translateY(-1px);
    }

    .password-weak { background-color: #dc3545; }
    .password-medium { background-color: #ffc107; }
    .password-strong { background-color: #28a745; }
</style>

<!-- Scripts -->
<script>
    // Toggle password visibility
    function togglePassword(fieldId, iconId) {
        const passwordField = document.getElementById(fieldId);
        const toggleIcon = document.getElementById(iconId);

        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            toggleIcon.className = 'fas fa-eye-slash text-muted';
        } else {
            passwordField.type = 'password';
            toggleIcon.className = 'fas fa-eye text-muted';
        }
    }

    // Password strength checker
    function checkPasswordStrength(password) {
        let strength = 0;
        let feedback = '';

        if (password.length >= 8) strength++;
        if (/[a-z]/.test(password)) strength++;
        if (/[A-Z]/.test(password)) strength++;
        if (/[0-9]/.test(password)) strength++;
        if (/[^A-Za-z0-9]/.test(password)) strength++;

        const progressBar = document.getElementById('passwordStrength');
        const strengthText = document.getElementById('passwordStrengthText');

        switch(strength) {
            case 0:
            case 1:
                progressBar.style.width = '20%';
                progressBar.className = 'progress-bar password-weak';
                feedback = 'Très faible';
                break;
            case 2:
                progressBar.style.width = '40%';
                progressBar.className = 'progress-bar password-weak';
                feedback = 'Faible';
                break;
            case 3:
                progressBar.style.width = '60%';
                progressBar.className = 'progress-bar password-medium';
                feedback = 'Moyen';
                break;
            case 4:
                progressBar.style.width = '80%';
                progressBar.className = 'progress-bar password-strong';
                feedback = 'Fort';
                break;
            case 5:
                progressBar.style.width = '100%';
                progressBar.className = 'progress-bar password-strong';
                feedback = 'Très fort';
                break;
        }

        strengthText.textContent = feedback;
    }

    // Password confirmation checker
    function checkPasswordMatch() {
        const password = document.getElementById('password').value;
        const confirmation = document.getElementById('password_confirmation').value;
        const matchElement = document.getElementById('passwordMatch');
        const noMatchElement = document.getElementById('passwordNoMatch');

        if (confirmation.length > 0) {
            if (password === confirmation) {
                matchElement.classList.remove('d-none');
                noMatchElement.classList.add('d-none');
            } else {
                matchElement.classList.add('d-none');
                noMatchElement.classList.remove('d-none');
            }
        } else {
            matchElement.classList.add('d-none');
            noMatchElement.classList.add('d-none');
        }
    }

    // Event listeners
    document.getElementById('password').addEventListener('input', function() {
        checkPasswordStrength(this.value);
        checkPasswordMatch();
    });

    document.getElementById('password_confirmation').addEventListener('input', checkPasswordMatch);

    // Handle form submission
    document.getElementById('registerForm').addEventListener('submit', function(e) {
        const registerBtn = document.getElementById('registerBtn');
        const registerText = document.getElementById('registerText');
        const registerSpinner = document.getElementById('registerSpinner');

        // Check if terms are accepted
        const termsCheckbox = document.getElementById('terms');
        if (!termsCheckbox.checked) {
            e.preventDefault();
            alert('Vous devez accepter les conditions d\'utilisation pour continuer.');
            return;
        }

        // Show loading state
        registerText.classList.add('d-none');
        registerSpinner.classList.remove('d-none');
        registerBtn.disabled = true;
        registerBtn.style.cursor = 'not-allowed';

        // Re-enable after 5 seconds (fallback)
        setTimeout(() => {
            registerText.classList.remove('d-none');
            registerSpinner.classList.add('d-none');
            registerBtn.disabled = false;
            registerBtn.style.cursor = 'pointer';
        }, 5000);
    });

    // Auto-dismiss alerts after 5 seconds
    setTimeout(() => {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        });
    }, 5000);
</script>
@endsection
