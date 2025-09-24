<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activation de votre compte</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f8f9fa;
        }

        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .header {
            background: linear-gradient(135deg, #C0C0C0 0%, #FFD700 100%);
            color: white;
            padding: 40px 30px;
            text-align: center;
            position: relative;
        }

        .header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 20"><defs><radialGradient id="a" cx="50%" cy="0%" r="100%"><stop offset="0%" style="stop-color:white;stop-opacity:0.1"/><stop offset="100%" style="stop-color:white;stop-opacity:0"/></radialGradient></defs><rect width="100" height="20" fill="url(%23a)"/></svg>');
        }

        .header-content {
            position: relative;
            z-index: 1;
        }

        .header h1 {
            font-size: 32px;
            margin-bottom: 10px;
            font-weight: 300;
        }

        .header p {
            font-size: 18px;
            opacity: 0.95;
        }

        .content {
            padding: 40px 30px;
        }

        .greeting {
            font-size: 20px;
            color: #2c3e50;
            margin-bottom: 25px;
            font-weight: 500;
        }

        .activation-box {
            background: linear-gradient(135deg, #e8f8ff 0%, #f0f8ff 100%);
            border: 2px solid #007bff;
            border-radius: 12px;
            padding: 25px;
            margin: 30px 0;
            text-align: center;
        }

        .activation-icon {
            width: 60px;
            height: 60px;
            background: #007bff;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 24px;
            margin-bottom: 15px;
        }

        .activation-box h3 {
            color: #0056b3;
            margin-bottom: 15px;
            font-size: 22px;
        }

        .activation-btn {
            display: inline-block;
            padding: 18px 35px;
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
            color: white;
            text-decoration: none;
            border-radius: 30px;
            font-weight: 600;
            font-size: 16px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 123, 255, 0.3);
            margin: 15px 0;
        }

        .activation-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 123, 255, 0.4);
        }

        .plan-highlight {
            background: {{ strtolower($subscriptionPlan) === 'silver' ? 'linear-gradient(135deg, #E5E5E5, #C0C0C0)' : 'linear-gradient(135deg, #FFE55C, #FFD700)' }};
            padding: 25px;
            border-radius: 12px;
            margin: 30px 0;
            text-align: center;
            color: #333;
            position: relative;
        }

        .plan-badge {
            font-size: 48px;
            margin-bottom: 10px;
        }

        .plan-name {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .plan-price {
            font-size: 36px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .plan-period {
            font-size: 16px;
            opacity: 0.8;
        }

        .subscription-details {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 25px;
            margin: 30px 0;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            padding-bottom: 12px;
            border-bottom: 1px solid #e9ecef;
        }

        .detail-row:last-child {
            border-bottom: none;
            margin-bottom: 0;
        }

        .detail-label {
            font-weight: 600;
            color: #495057;
            display: flex;
            align-items: center;
        }

        .detail-icon {
            margin-right: 8px;
            font-size: 16px;
        }

        .detail-value {
            color: #6c757d;
            font-weight: 500;
        }

        .features-section {
            margin: 35px 0;
        }

        .features-title {
            font-size: 22px;
            color: #2c3e50;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
        }

        .features-icon {
            color: #ffc107;
            margin-right: 10px;
            font-size: 24px;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 15px;
        }

        .feature-item {
            display: flex;
            align-items: flex-start;
            padding: 12px;
            background: #f8f9fa;
            border-radius: 8px;
            border-left: 4px solid #28a745;
        }

        .feature-check {
            color: #28a745;
            font-weight: bold;
            margin-right: 10px;
            font-size: 16px;
            margin-top: 2px;
        }

        .feature-text {
            color: #495057;
            font-size: 14px;
            line-height: 1.4;
        }

        .cta-section {
            text-align: center;
            margin: 40px 0;
            padding: 30px;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 12px;
        }

        .cta-title {
            font-size: 24px;
            color: #2c3e50;
            margin-bottom: 15px;
            font-weight: 600;
        }

        .cta-description {
            color: #6c757d;
            margin-bottom: 25px;
            font-size: 16px;
        }

        .btn-secondary {
            display: inline-block;
            padding: 12px 25px;
            background: transparent;
            border: 2px solid #6c757d;
            color: #6c757d;
            text-decoration: none;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease;
            margin: 0 10px;
        }

        .btn-secondary:hover {
            background: #6c757d;
            color: white;
            transform: translateY(-2px);
        }

        .footer {
            background: #2c3e50;
            color: white;
            padding: 40px 30px;
            text-align: center;
        }

        .footer-content {
            margin-bottom: 25px;
        }

        .footer-links {
            margin: 25px 0;
        }

        .footer-links a {
            color: #bdc3c7;
            text-decoration: none;
            margin: 0 15px;
            font-size: 14px;
        }

        .footer-links a:hover {
            color: white;
        }

        .disclaimer {
            font-size: 12px;
            color: #95a5a6;
            margin-top: 20px;
            line-height: 1.5;
        }

        @media (max-width: 600px) {
            .email-container {
                margin: 10px;
            }

            .content {
                padding: 25px 20px;
            }

            .header {
                padding: 30px 20px;
            }

            .header h1 {
                font-size: 26px;
            }

            .detail-row {
                flex-direction: column;
                text-align: left;
                align-items: flex-start;
            }

            .detail-value {
                margin-top: 5px;
                font-weight: 600;
            }

            .features-grid {
                grid-template-columns: 1fr;
            }

            .plan-price {
                font-size: 28px;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header -->
        <div class="header">
            <div class="header-content">
                <h1>🏢 ImmoConnect Pro</h1>
                <p>Activation de votre compte professionnel</p>
            </div>
        </div>

        <!-- Content -->
        <div class="content">
            <div class="greeting">
                Bonjour <strong>{{ $agencyName }}</strong> !
            </div>

            <p>Félicitations ! Votre inscription à notre plateforme immobilière a été validée. Il ne vous reste plus qu'une étape pour activer votre compte et commencer à utiliser toutes nos fonctionnalités.</p>

            <!-- Activation Box -->
            <div class="activation-box">
                <div class="activation-icon">🔐</div>
                <h3>Activez votre compte maintenant</h3>
                <p>Cliquez sur le bouton ci-dessous pour activer votre compte et accéder immédiatement à votre tableau de bord.</p>
                <a href="{{ $activationUrl }}" class="activation-btn">
                    ✨ Activer mon compte
                </a>
            </div>

            <!-- Plan Highlight -->
            <div class="plan-highlight">
                <div class="plan-badge">{{ $planIcon }}</div>
                <div class="plan-name">Plan {{ $subscriptionPlan }}</div>
                <div class="plan-price">{{ number_format($subscriptionPrice, 2) }} {{ $subscriptionCurrency }}</div>
                <div class="plan-period">{{ $subscriptionPeriod === 'monthly' ? 'par mois' : 'par an' }}</div>
            </div>

            <!-- Subscription Details -->
            <div class="subscription-details">
                <div class="detail-row">
                    <span class="detail-label">
                        <span class="detail-icon">📋</span>
                        Plan souscrit
                    </span>
                    <span class="detail-value">{{ $subscriptionPlan }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">
                        <span class="detail-icon">📅</span>
                        Date d'activation
                    </span>
                    <span class="detail-value">{{ $startDate }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">
                        <span class="detail-icon">🔄</span>
                        Prochaine facturation
                    </span>
                    <span class="detail-value">{{ $endDate }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">
                        <span class="detail-icon">🏠</span>
                        Annonces incluses
                    </span>
                    <span class="detail-value">{{ $maxListings }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">
                        <span class="detail-icon">🎧</span>
                        Support client
                    </span>
                    <span class="detail-value">{{ $supportLevel }}</span>
                </div>
            </div>

            <!-- Features Section -->
            @if(!empty($planFeatures))
            <div class="features-section">
                <h3 class="features-title">
                    <span class="features-icon">⭐</span>
                    Vos fonctionnalités incluses
                </h3>
                <div class="features-grid">
                    @foreach($planFeatures as $feature)
                    <div class="feature-item">
                        <span class="feature-check">✓</span>
                        <span class="feature-text">{{ $feature }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Call to Action Section -->
            <div class="cta-section">
                <h3 class="cta-title">🚀 Prêt à commencer ?</h3>
                <p class="cta-description">
                    Une fois votre compte activé, vous aurez accès à tous les outils pour gérer vos annonces immobilières de manière professionnelle.
                </p>
                <a href="{{ $supportUrl }}" class="btn-secondary">Centre d'aide</a>
                <a href="{{ $dashboardUrl }}" class="btn-secondary">Découvrir la plateforme</a>
            </div>

            <div style="margin-top: 40px; padding: 20px; background: #fff3cd; border-radius: 8px; border-left: 4px solid #ffc107;">
                <p><strong>⏰ Important :</strong> Ce lien d'activation expirera dans 24 heures. Si vous avez des difficultés, contactez notre support technique.</p>
            </div>

            <p style="margin-top: 30px;">
                Nous sommes ravis de vous accueillir dans la famille ImmoConnect Pro !
            </p>

            <p style="margin-top: 20px;">
                Cordialement,<br>
                <strong>L'équipe ImmoConnect Pro</strong>
            </p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <div class="footer-content">
                <p>Merci d'avoir choisi ImmoConnect Pro pour développer votre activité immobilière.</p>
            </div>

            <div class="footer-links">
                <a href="{{ $dashboardUrl }}">Tableau de bord</a>
                <a href="{{ $supportUrl }}">Support</a>
                <a href="#">Conditions d'utilisation</a>
                <a href="#">Confidentialité</a>
            </div>

            <div class="disclaimer">
                Cet email a été envoyé à {{ $agencyEmail }}.<br>
                Si vous n'êtes pas à l'origine de cette inscription, veuillez ignorer cet email.<br>
                &copy; {{ date('Y') }} ImmoConnect Pro. Tous droits réservés.
            </div>
        </div>
    </div>
</body>
</html>
