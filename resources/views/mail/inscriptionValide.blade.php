<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votre abonnement a été activé !</title>
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
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        }
        .email-container {
            max-width: 650px;
            margin: 30px auto;
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
        }
        .header {
            background: linear-gradient(135deg, #ff6b35 0%, #f7931e 100%);
            color: white;
            padding: 50px 40px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 300px;
            height: 300px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }
        .header::after {
            content: '';
            position: absolute;
            bottom: -30%;
            left: -10%;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.08);
            border-radius: 50%;
            animation: float 8s ease-in-out infinite reverse;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        .header-content {
            position: relative;
            z-index: 1;
        }
        .header-icon {
            width: 80px;
            height: 80px;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 36px;
            margin: 0 auto 20px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            line-height: 1;
            overflow: hidden;
        }
        .header-icon img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            padding: 10px;
        }
        .header h1 {
            font-size: 34px;
            margin-bottom: 10px;
            font-weight: 700;
        }
        .header p {
            font-size: 18px;
            opacity: 0.95;
            font-weight: 300;
        }
        .content {
            padding: 50px 40px;
        }
        .greeting {
            font-size: 24px;
            color: #2c3e50;
            margin-bottom: 25px;
            font-weight: 600;
        }
        .intro-text {
            font-size: 16px;
            color: #6c757d;
            margin-bottom: 35px;
            line-height: 1.8;
        }
        .success-banner {
            background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
            border: 2px solid #28a745;
            border-radius: 16px;
            padding: 30px;
            margin: 35px 0;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .success-banner::before {
            content: '✨';
            position: absolute;
            top: -10px;
            right: -10px;
            font-size: 80px;
            opacity: 0.1;
        }
        .success-icon {
            width: 70px;
            height: 70px;
            background: #28a745;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 32px;
            margin: 0 auto 20px;
            box-shadow: 0 8px 25px rgba(40, 167, 69, 0.3);
            line-height: 70px;
        }
        .success-banner h3 {
            color: #155724;
            margin-bottom: 10px;
            font-size: 24px;
            font-weight: 700;
        }
        .success-banner p {
            color: #155724;
            font-size: 15px;
            margin-bottom: 25px;
        }
        .plan-card {
            background: linear-gradient(135deg, #ff6b35 0%, #f7931e 100%);
            border-radius: 20px;
            padding: 40px;
            margin: 40px 0;
            text-align: center;
            color: white;
            position: relative;
            box-shadow: 0 15px 45px rgba(255, 107, 53, 0.3);
        }
        .plan-badge {
            font-size: 56px;
            margin-bottom: 15px;
            filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.2));
            line-height: 1;
        }
        .plan-name {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 2px;
        }
        .plan-price {
            font-size: 42px;
            font-weight: 800;
            margin-bottom: 8px;
        }
        .plan-period {
            font-size: 16px;
            opacity: 0.9;
            font-weight: 300;
        }
        .details-section {
            background: #f8f9fa;
            border-radius: 16px;
            padding: 35px;
            margin: 40px 0;
        }
        .details-title {
            font-size: 20px;
            color: #2c3e50;
            margin-bottom: 25px;
            font-weight: 700;
            display: flex;
            align-items: center;
        }
        .details-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #ff6b35, #f7931e);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            margin-right: 15px;
            font-size: 18px;
            flex-shrink: 0;
            line-height: 40px;
        }
        .detail-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 18px 0;
            border-bottom: 2px solid #e9ecef;
        }
        .detail-row:last-child {
            border-bottom: none;
        }
        .detail-label {
            font-weight: 600;
            color: #495057;
            font-size: 15px;
        }
        .detail-value {
            color: #ff6b35;
            font-weight: 700;
            font-size: 15px;
        }
        .features-section {
            margin: 45px 0;
        }
        .features-title {
            font-size: 22px;
            color: #2c3e50;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            font-weight: 700;
        }
        .features-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #ffc107, #ff9800);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            margin-right: 15px;
            font-size: 18px;
            flex-shrink: 0;
            line-height: 40px;
        }
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 15px;
        }
        .feature-item {
            display: flex;
            align-items: center;
            padding: 18px;
            background: white;
            border-radius: 12px;
            border: 2px solid #e9ecef;
            transition: all 0.3s ease;
        }
        .feature-item:hover {
            border-color: #ff6b35;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(255, 107, 53, 0.15);
        }
        .feature-check {
            width: 28px;
            height: 28px;
            background: #28a745;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            margin-right: 15px;
            font-size: 14px;
            flex-shrink: 0;
            line-height: 28px;
        }
        .feature-text {
            color: #495057;
            font-size: 14px;
            line-height: 1.5;
            font-weight: 500;
        }
        .cta-section {
            text-align: center;
            margin: 50px 0;
            padding: 40px;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 20px;
        }
        .cta-title {
            font-size: 28px;
            color: #2c3e50;
            margin-bottom: 15px;
            font-weight: 700;
        }
        .cta-description {
            color: #6c757d;
            margin-bottom: 30px;
            font-size: 16px;
            line-height: 1.6;
        }
        .btn-primary {
            display: inline-block;
            padding: 18px 45px;
            background: linear-gradient(135deg, #ff6b35 0%, #f7931e 100%);
            color: white;
            text-decoration: none;
            border-radius: 50px;
            font-weight: 700;
            font-size: 16px;
            transition: all 0.3s ease;
            box-shadow: 0 8px 25px rgba(255, 107, 53, 0.3);
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(255, 107, 53, 0.4);
        }
        .btn-secondary {
            display: inline-block;
            padding: 14px 30px;
            background: white;
            border: 2px solid #6c757d;
            color: #6c757d;
            text-decoration: none;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
            margin: 0 8px;
            font-size: 14px;
        }
        .btn-secondary:hover {
            background: #6c757d;
            color: white;
            transform: translateY(-2px);
        }
        .warning-box {
            margin-top: 45px;
            padding: 25px;
            background: linear-gradient(135deg, #fff3cd 0%, #ffe69c 100%);
            border-radius: 12px;
            border-left: 5px solid #ffc107;
        }
        .warning-box strong {
            color: #856404;
            font-size: 16px;
        }
        .warning-box p {
            color: #856404;
            margin-top: 8px;
            line-height: 1.6;
        }
        .footer {
            background: #2c3e50;
            color: white;
            padding: 50px 40px;
            text-align: center;
        }
        .footer-logo {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 15px;
            color: #ff6b35;
        }
        .footer-content p {
            margin-bottom: 30px;
            font-size: 14px;
            color: #bdc3c7;
        }
        .footer-links {
            margin: 30px 0;
        }
        .footer-links a {
            color: #bdc3c7;
            text-decoration: none;
            margin: 0 15px;
            font-size: 14px;
            font-weight: 500;
            transition: color 0.3s ease;
        }
        .footer-links a:hover {
            color: #ff6b35;
        }
        .disclaimer {
            font-size: 12px;
            color: #95a5a6;
            margin-top: 25px;
            line-height: 1.6;
        }
        @media (max-width: 600px) {
            .email-container {
                margin: 15px;
            }
            .content, .header {
                padding: 30px 25px;
            }
            .header h1 {
                font-size: 26px;
            }
            .greeting {
                font-size: 20px;
            }
            .plan-price {
                font-size: 32px;
            }
            .features-grid {
                grid-template-columns: 1fr;
            }
            .btn-primary {
                display: block;
                margin: 10px 0;
            }
            .btn-secondary {
                display: block;
                margin: 10px 0;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header -->
        <div class="header">
            <div class="header-content">
                <h1>E-MMO</h1>
                <p>Bienvenue dans votre espace professionnel</p>
            </div>
        </div>
        <!-- Content -->
        <div class="content">
            <div class="greeting">
                Félicitations <strong>{{ $agencyName }}</strong> ! 🎉
            </div>
            <p class="intro-text">
                Nous sommes ravis de vous accueillir ! Votre abonnement a été activé avec succès et vous pouvez maintenant profiter de toutes les fonctionnalités de notre plateforme immobilière.
            </p>
            <!-- Success Banner -->
            <div class="success-banner">
                <div class="success-icon">✓</div>
                <h3>Votre compte est maintenant actif !</h3>
                <p>Vous pouvez dès à présent accéder à votre tableau de bord et commencer à gérer vos annonces immobilières.</p>
            </div>
            <!-- Plan Card -->
            <div class="plan-card">
                <div class="plan-badge">{{ $planIcon }}</div>
                <div class="plan-name">Plan {{ $subscriptionPlan }}</div>
                <div class="plan-price">{{ number_format($subscriptionPrice, 0, ',', ' ') }} Ar</div>
                <div class="plan-period">Par mois</div>
            </div>
            <!-- Details Section -->
            <div class="details-section">
                <h3 class="details-title">
                    <span class="details-icon">📋</span>
                    Détails de votre abonnement
                </h3>
                <div class="detail-row">
                    <span class="detail-label">Plan souscrit</span>
                    <span class="detail-value">{{ $subscriptionPlan }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Date d'activation</span>
                    <span class="detail-value">{{ $startDate }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Prochaine facturation</span>
                    <span class="detail-value">{{ $endDate }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Annonces par mois</span>
                    <span class="detail-value">{{ $maxListings }}</span>
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
            <!-- CTA Section -->
            <div class="cta-section">
                <h3 class="cta-title">🚀 Prêt à démarrer ?</h3>
                <p class="cta-description">
                    Accédez à votre tableau de bord et découvrez tous les outils pour gérer vos annonces immobilières de manière professionnelle.
                </p>
                <a href="{{ $dashboardUrl }}" class="btn-primary">
                    Accéder au tableau de bord
                </a>
                <br><br>
                <a href="{{ $supportUrl }}" class="btn-secondary">Centre d'aide</a>
                <a href="#" class="btn-secondary">Documentation</a>
            </div>
            <!-- Warning Box -->
            <div class="warning-box">
                <strong>💡 Conseil :</strong>
                <p>Complétez votre profil et ajoutez votre première annonce dès maintenant pour maximiser votre visibilité. Notre équipe support est disponible pour vous accompagner !</p>
            </div>
            <p style="margin-top: 40px; color: #6c757d;">
                Nous sommes impatients de voir votre activité se développer sur notre plateforme.
            </p>
            <p style="margin-top: 25px; font-weight: 600; color: #2c3e50;">
                Cordialement,<br>
                <span style="color: #ff6b35;">L'équipe E-MMO</span>
            </p>
        </div>
        <!-- Footer -->
        <div class="footer">
            <div class="footer-logo">🏠 E-MMO</div>
            <div class="footer-content">
                <p>Votre partenaire pour une gestion immobilière professionnelle et efficace.</p>
            </div>
            <div class="footer-links">
                <a href="{{ $dashboardUrl }}">Tableau de bord</a>
                <a href="{{ $supportUrl }}">Support</a>
                <a href="#">CGU</a>
                <a href="#">Confidentialité</a>
            </div>
            <div class="disclaimer">
                Cet email a été envoyé à {{ $agencyEmail }}.<br>
                Si vous n'avez pas créé de compte, veuillez ignorer cet email.<br>
                &copy; {{ date('Y') }} E-MMO. Tous droits réservés.
            </div>
        </div>
    </div>
</body>
</html>
