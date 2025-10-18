@extends("layouts.app")
@php
$pageTitle ="Immo | Acceuil";
@endphp
@section("body")
  <div class="main-banner">
    <div class="owl-carousel owl-banner">
      <div class="item item-1">
        <div class="header-text">
          <span class="category">Antanarivo, <em>Madagascar</em></span>
          <h2><br> la meilleure propriété est à vous ! </h2>
        </div>
      </div>
      <div class="item item-2">
        <div class="header-text">
          <span class="category">Antanarivo, <em>Madagascar</em></span>
          <h2><br>le meilleur bien à louer part vite </h2>
        </div>
      </div>
      <div class="item item-3">
        <div class="header-text">
          <span class="category">Miami, <em>South Florida</em></span>
          <h2><br>Obtenez le penthouse le plus prestigieux.</h2>
        </div>
      </div>
    </div>
  </div>

  <div class="featured section">
    <div class="container">
      <div class="row">
        <div class="col-lg-4">
          <div class="left-image">
            <img src="assets/images/featured.jpg" alt="">
            <a href="property-details.html"><img src="assets/images/featured-icon.png" alt="" style="max-width: 60px; padding: 0px;"></a>
          </div>
        </div>
        <div class="col-lg-5">
          <div class="section-heading">
            <h6>| Mis en avant</h6>
            <h2>Meilleur appartement &amp; vue sur la mer</h2>
          </div>
          <div class="accordion" id="accordionExample">
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                  A la une?
                </button>
              </h2>
              <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                Profitez <strong>d’un cadre unique avec une vue imprenable sur la mer</strong> Des appartements modernes alliant confort, design et emplacement de rêve.</div>
              </div>
            </div>
            {{-- <div class="accordion-item">
              <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                  How does this work ?
                </button>
              </h2>
              <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  Dolor <strong>almesit amet</strong>, consectetur adipiscing elit, sed doesn't eiusmod tempor incididunt ut labore consectetur <code>adipiscing</code> elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                  Why is Villa Agency the best ?
                </button>
              </h2>
              <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  Dolor <strong>almesit amet</strong>, consectetur adipiscing elit, sed doesn't eiusmod tempor incididunt ut labore consectetur <code>adipiscing</code> elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                </div>
              </div>
            </div> --}}
          </div>
        </div>
        <div class="col-lg-3">
          <div class="info-table">
            <ul>
              <li>
                <img src="assets/images/info-icon-01.png" alt="" style="max-width: 52px;">
                <h4>250 m2<br><span>Total Flat Space</span></h4>
              </li>
              <li>
                <img src="assets/images/info-icon-02.png" alt="" style="max-width: 52px;">
                <h4>Contract<br><span>Contract Ready</span></h4>
              </li>
              <li>
                <img src="assets/images/info-icon-03.png" alt="" style="max-width: 52px;">
                <h4>Payment<br><span>Payment Process</span></h4>
              </li>
              <li>
                <img src="assets/images/info-icon-04.png" alt="" style="max-width: 52px;">
                <h4>Safety<br><span>24/7 Under Control</span></h4>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- <div class="video section">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 offset-lg-4">
          <div class="section-heading text-center">
            <h6>| Video View</h6>
            <h2>Get Closer View & Different Feeling</h2>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="video-content">
    <div class="container">
      <div class="row">
        <div class="col-lg-10 offset-lg-1">
          <div class="video-frame">
            <img src="assets/images/video-frame.jpg" alt="">
            <a href="https://youtube.com" target="_blank"><i class="fa fa-play"></i></a>
          </div>
        </div>
      </div>
    </div>
  </div> --}}
<style>
        .section-heading {
            text-align: center;
            margin-bottom: 70px;
        }

        .section-heading h6 {
            font-size: 15px;
            color: #f35525;
            text-transform: uppercase;
            font-weight: 600;
            margin-bottom: 15px;
        }

        .section-heading h2 {
            font-size: 42px;
            font-weight: 700;
            color: #2a2a2a;
            line-height: 54px;
        }

        /* Container des cartes */
        .pricing-cards {
            display: flex;
            justify-content: center;
            gap: 30px;
            flex-wrap: wrap;
        }

        /* Style de base pour toutes les cartes */
        .pricing-card {
            background: white;
            border-radius: 15px;
            padding: 40px 30px;
            width: 100%;
            max-width: 350px;
            position: relative;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            border: 2px solid transparent;
            overflow: hidden;
        }

        .pricing-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: #f35525;
        }

        .pricing-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
        }

        /* Carte Gratuite */
        .pricing-card.free {
            border-color: #e5e7eb;
        }

        .pricing-card.free::before {
            background: linear-gradient(135deg, #6b7280 0%, #9ca3af 100%);
        }

        .pricing-card.free .plan-icon {
            background: linear-gradient(135deg, #6b7280 0%, #9ca3af 100%);
        }

        /* Carte Silver */
        .pricing-card.silver {
            border-color: #d1d5db;
            transform: scale(1.05);
        }

        .pricing-card.silver::before {
            background: linear-gradient(135deg, #9ca3af 0%, #d1d5db 100%);
        }

        .pricing-card.silver .plan-icon {
            background: linear-gradient(135deg, #9ca3af 0%, #d1d5db 100%);
        }

        .pricing-card.silver .popular-badge {
            position: absolute;
            top: -1px;
            right: 30px;
            background: #f35525;
            color: white;
            padding: 8px 20px;
            border-radius: 0 0 10px 10px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Carte Gold */
        .pricing-card.gold {
            border-color: #fbbf24;
            background: linear-gradient(145deg, #fefce8 0%, #fef3c7 100%);
        }

        .pricing-card.gold::before {
            background: linear-gradient(135deg, #f59e0b 0%, #fbbf24 100%);
        }

        .pricing-card.gold .plan-icon {
            background: linear-gradient(135deg, #f59e0b 0%, #fbbf24 100%);
        }

        /* Header des cartes */
        .plan-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .plan-icon {
            width: 70px;
            height: 70px;
            margin: 0 auto 20px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 24px;
        }

        .plan-name {
            font-size: 24px;
            font-weight: 700;
            color: #2a2a2a;
            margin-bottom: 10px;
        }

        .plan-description {
            color: #666;
            font-size: 14px;
            line-height: 1.6;
        }

        /* Prix */
        .plan-price {
            text-align: center;
            margin-bottom: 30px;
        }

        .price {
            font-size: 48px;
            font-weight: 800;
            color: #f35525;
            line-height: 1;
        }

        .price-currency {
            font-size: 24px;
            vertical-align: top;
        }

        .price-period {
            color: #666;
            font-size: 16px;
            margin-top: 5px;
        }

        /* Liste des fonctionnalités */
        .features-list {
            list-style: none;
            padding: 0;
            margin-bottom: 35px;
        }

        .features-list li {
            padding: 12px 0;
            color: #555;
            font-size: 15px;
            display: flex;
            align-items: center;
            border-bottom: 1px solid #f0f0f0;
        }

        .features-list li:last-child {
            border-bottom: none;
        }

        .feature-icon {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: #10b981;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            font-size: 10px;
            flex-shrink: 0;
        }

        .feature-icon.disabled {
            background: #e5e7eb;
            color: #9ca3af;
        }

        /* Boutons */
        .plan-button {
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }

        /* Bouton plan gratuit */
        .free .plan-button {
            background: #f8f9fa;
            color: #6b7280;
            border: 2px solid #e5e7eb;
        }

        .free .plan-button:hover {
            background: #e5e7eb;
            color: #374151;
        }

        /* Bouton plan silver */
        .silver .plan-button {
            background: #f35525;
            color: white;
        }

        .silver .plan-button:hover {
            background: #e04411;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(243, 85, 37, 0.3);
        }

        /* Bouton plan gold */
        .gold .plan-button {
            background: linear-gradient(135deg, #f59e0b 0%, #fbbf24 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(245, 158, 11, 0.3);
        }

        .gold .plan-button:hover {
            background: linear-gradient(135deg, #d97706 0%, #f59e0b 100%);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(245, 158, 11, 0.4);
        }

        /* Badge recommandé */
        .recommended-badge {
            position: absolute;
            top: 20px;
            right: -35px;
            background: #10b981;
            color: white;
            padding: 5px 40px;
            font-size: 12px;
            font-weight: 600;
            transform: rotate(45deg);
            text-transform: uppercase;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .pricing-cards {
                gap: 20px;
            }

            .pricing-card.silver {
                transform: scale(1);
            }

            .section-heading h2 {
                font-size: 32px;
                line-height: 42px;
            }
        }

        @media (max-width: 768px) {
            .section {
                padding: 60px 0;
            }

            .pricing-card {
                padding: 30px 25px;
                max-width: 100%;
            }

            .price {
                font-size: 36px;
            }
        }

        /* Animation d'entrée */
        .pricing-card {
            opacity: 0;
            transform: translateY(50px);
            animation: slideInUp 0.6s ease-out forwards;
        }

        .pricing-card:nth-child(2) {
            animation-delay: 0.1s;
        }

        .pricing-card:nth-child(3) {
            animation-delay: 0.2s;
        }

        @keyframes slideInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>


{{--
  <div class="fun-facts">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="wrapper">
            <div class="row">
              <div class="col-lg-4">
                <div class="counter">
                  <h2 class="timer count-title count-number" data-to="34" data-speed="1000"></h2>
                   <p class="count-text ">Buildings<br>Finished Now</p>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="counter">
                  <h2 class="timer count-title count-number" data-to="12" data-speed="1000"></h2>
                  <p class="count-text ">Years<br>Experience</p>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="counter">
                  <h2 class="timer count-title count-number" data-to="24" data-speed="1000"></h2>
                  <p class="count-text ">Awwards<br>Won 2023</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div> --}}

  <div class="section best-deal">
    <div class="container">
      <div class="row">
        <div class="col-lg-4">
          <div class="section-heading">
            <h6>| Meilleure Offre</h6>
            <h2>Trouvez votre meilleure offre dès maintenant!</h2>
          </div>
        </div>
        <div class="col-lg-12">
          <div class="tabs-content">
            <div class="row">
              <div class="nav-wrapper ">
                <ul class="nav nav-tabs" role="tablist">
                  <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="appartment-tab" data-bs-toggle="tab" data-bs-target="#appartment" type="button" role="tab" aria-controls="appartment" aria-selected="true">Appartment</button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="nav-link" id="villa-tab" data-bs-toggle="tab" data-bs-target="#villa" type="button" role="tab" aria-controls="villa" aria-selected="false">Villa House</button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="nav-link" id="penthouse-tab" data-bs-toggle="tab" data-bs-target="#penthouse" type="button" role="tab" aria-controls="penthouse" aria-selected="false">Penthouse</button>
                  </li>
                </ul>
              </div>
              <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="appartment" role="tabpanel" aria-labelledby="appartment-tab">
                  <div class="row">
                    <div class="col-lg-3">
                      <div class="info-table">
                        <ul>
                          <li>Total Flat Space <span>185 m2</span></li>
                          <li>Floor number <span>26th</span></li>
                          <li>Number of rooms <span>4</span></li>
                          <li>Parking Available <span>Yes</span></li>
                          <li>Payment Process <span>Bank</span></li>
                        </ul>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <img src="assets/images/deal-01.jpg" alt="">
                    </div>
                    <div class="col-lg-3">
                      <h4>Informations supplémentaires sur la propriété</h4>
                      <p>
                        Découvrez cette magnifique propriété alliant confort moderne et élégance intemporelle.
                        Située dans un quartier calme et recherché, elle offre des espaces lumineux, une cuisine entièrement équipée,
                        ainsi qu’un grand séjour donnant sur une terrasse ensoleillée.
                        <br>
                        Idéale pour une famille ou pour un investissement, cette maison se distingue par sa qualité de finition,
                        sa proximité avec les commodités (écoles, commerces, transports) et son environnement paisible.
                        Venez la visiter et laissez-vous séduire par son charme unique.
                        </p>

                      {{-- <div class="icon-button">
                        <a href="property-details.html"><i class="fa fa-calendar"></i> Schedule a visit</a>
                      </div> --}}
                    </div>
                  </div>
                </div>
                <div class="tab-pane fade" id="villa" role="tabpanel" aria-labelledby="villa-tab">
                  <div class="row">
                    <div class="col-lg-3">
                      <div class="info-table">
                        <ul>
                          <li>Total Flat Space <span>250 m2</span></li>
                          <li>Floor number <span>26th</span></li>
                          <li>Number of rooms <span>5</span></li>
                          <li>Parking Available <span>Yes</span></li>
                          <li>Payment Process <span>Bank</span></li>
                        </ul>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <img src="assets/images/deal-02.jpg" alt="">
                    </div>
                    <div class="col-lg-3">
                      <h4>Detail Info About Villa</h4>
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, do eiusmod tempor pack incididunt ut labore et dolore magna aliqua quised ipsum suspendisse. <br><br>Swag fanny pack lyft blog twee. JOMO ethical copper mug, succulents typewriter shaman DIY kitsch twee taiyaki fixie hella venmo after messenger poutine next level humblebrag swag franzen.</p>
                      <div class="icon-button">
                        <a href="property-details.html"><i class="fa fa-calendar"></i> Schedule a visit</a>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="tab-pane fade" id="penthouse" role="tabpanel" aria-labelledby="penthouse-tab">
                  <div class="row">
                    <div class="col-lg-3">
                      <div class="info-table">
                        <ul>
                          <li>Total Flat Space <span>320 m2</span></li>
                          <li>Floor number <span>34th</span></li>
                          <li>Number of rooms <span>6</span></li>
                          <li>Parking Available <span>Yes</span></li>
                          <li>Payment Process <span>Bank</span></li>
                        </ul>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <img src="assets/images/deal-03.jpg" alt="">
                    </div>
                    <div class="col-lg-3">
                      <h4>Extra Info About Penthouse</h4>
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, do eiusmod tempor pack incididunt ut labore et dolore magna aliqua quised ipsum suspendisse. <br><br>Swag fanny pack lyft blog twee. JOMO ethical copper mug, succulents typewriter shaman DIY kitsch twee taiyaki fixie hella venmo after messenger poutine next level humblebrag swag franzen.</p>
                      <div class="icon-button">
                        <a href="property-details.html"><i class="fa fa-calendar"></i> Schedule a visit</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="properties section">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 offset-lg-4">
          <div class="section-heading text-center">
            <h6>| Propriétés</h6>
            <h2>Fraîchement ajoutées.</h2>
          </div>
        </div>
      </div>
<div class="row">
  @foreach ($properties as $property)
  <div class="col-lg-4 col-md-6">
    <div class="item property-card" style="cursor: pointer; transition: all 0.3s ease;"
         onclick="window.location.href='{{ route('properties.show', $property->id) }}'">
      <!-- Image avec badges superposés -->
      <div style="position: relative;">
        @if($property->images->count() > 0)
          <img src="{{ Storage::url($property->images->first()->image_path) }}"
               alt="{{ $property->title }}"
               style="width: 100%; height: 200px; object-fit: cover;">
        @else
          <div class="no-image-placeholder" style="height: 200px; background: #f8f9fa; display: flex; align-items: center; justify-content: center;">
            <i class="fa fa-home fa-2x text-muted"></i>
          </div>
        @endif

        <!-- Badge agence superposé sur l'image (en haut à gauche) -->
        @if($property->user)
          <div style="position: absolute; top: 10px; left: 10px; background: linear-gradient(135deg, #ff6b35 0%, #ff8c42 100%); color: white; padding: 6px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 600; box-shadow: 0 4px 10px rgba(255, 107, 53, 0.4);">
            <i class="fa fa-user-tie"></i> {{ $property->user->name }}
          </div>
        @endif

        <!-- Badge type de transaction (en bas à gauche) -->
        @if($property->transaction_type)
          <div style="position: absolute; bottom: 10px; left: 10px; background: {{ $property->transaction_type == 'vente' ? 'linear-gradient(135deg, #28a745 0%, #20c997 100%)' : 'linear-gradient(135deg, #007bff 0%, #0dcaf0 100%)' }}; color: white; padding: 6px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 600; box-shadow: 0 4px 10px rgba(0,0,0,0.3); text-transform: uppercase;">
            <i class="fa {{ $property->transaction_type == 'vente' ? 'fa-tag' : 'fa-key' }}"></i>
            {{ $property->transaction_type == 'vente' ? 'À Vendre' : 'À Louer' }}
          </div>
        @endif

        <!-- Compteur d'images (en haut à droite) -->
        @if($property->images->count() > 1)
          <div class="image-count-badge" style="position: absolute; top: 10px; right: 10px; background: rgba(0, 0, 0, 0.7); color: white; padding: 5px 10px; border-radius: 5px; font-size: 0.8rem; backdrop-filter: blur(5px);">
            <i class="fa fa-images"></i> {{ $property->images->count() }}
          </div>
        @endif
      </div>

      <!-- Catégorie/Titre -->
      <span class="category">{{ $property->title }}</span>

      <!-- Prix en Ariary -->
      <h6>{{ $property->formatted_price_short }}</h6>

      <!-- Adresse -->
      <h4>
        <a href="{{ route('properties.show', $property->id) }}" onclick="event.stopPropagation();">
          {{ $property->address . ', ' . $property->city }}
        </a>
      </h4>

      <!-- Caractéristiques -->
      <ul>
        <li>Chambres: <span>{{ $property->rooms ?? 'N/A' }}</span></li>
        <li>Salles de bain: <span>{{ $property->bathrooms ?? 'N/A' }}</span></li>
        <li>Surface: <span>{{ $property->surface ?? 'N/A' }}m²</span></li>
        <li>Étages: <span>{{ $property->floors ?? 'N/A' }}</span></li>
        <li>Parking: <span>{{ $property->parking ? 'Oui' : 'Non' }}</span></li>
      </ul>

      <!-- Bouton d'action -->
      <div class="main-button">
        <a href="{{ route('properties.show', $property->id) }}" onclick="event.stopPropagation();">
          {{ $property->transaction_type == 'location' ? 'Louer maintenant' : 'Acheter maintenant' }}
        </a>
      </div>
    </div>
  </div>
  @endforeach
</div>
      <!-- Bouton Voir Toutes les Propriétés -->
      @if($properties->count() > 0)
      <div class="row mt-5">
        <div class="col-12 text-center">
          <a href="{{ route('properties.index') }}"
             class="btn btn-lg text-white fw-semibold shadow-lg"
             style="background: linear-gradient(135deg, #ff6b35 0%, #f7931e 100%);
                    border-radius: 50px;
                    border: none;
                    padding: 18px 60px;
                    font-size: 18px;
                    text-transform: uppercase;
                    letter-spacing: 1px;
                    transition: all 0.3s ease;
                    text-decoration: none;
                    display: inline-block;">
            <i class="fas fa-th-large me-2"></i>
            Voir Toutes les Propriétés
            <i class="fas fa-arrow-right ms-2"></i>
          </a>
        </div>
      </div>
      @endif

<style>
/* Effet hover sur la carte */
.property-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15) !important;
}

/* Éviter le double soulignement au survol */
.property-card h4 a {
  text-decoration: none;
}

.property-card h4 a:hover {
  color: #ff6b35;
}
</style>

<script>
// Alternative JavaScript si vous préférez
document.addEventListener('DOMContentLoaded', function() {
  // Cette section est optionnelle, le onclick inline suffit
  const propertyCards = document.querySelectorAll('.property-card');

  propertyCards.forEach(card => {
    card.addEventListener('click', function(e) {
      // Si le clic est sur un lien, ne rien faire (laisser le lien fonctionner)
      if (e.target.tagName === 'A' || e.target.closest('a')) {
        return;
      }

      // Sinon, rediriger vers les détails
      const url = this.getAttribute('onclick').match(/'([^']+)'/)[1];
      window.location.href = url;
    });
  });
});
</script>

<style>
.item {
  position: relative;
  transition: all 0.3s ease;
}

/* Effet hover sur tous les badges */
.item:hover [style*="position: absolute"] {
  transform: scale(1.05);
  transition: transform 0.3s ease;
}

/* Animation d'apparition des badges */
[style*="position: absolute"] {
  animation: fadeInBadge 0.5s ease-in-out;
}

@keyframes fadeInBadge {
  from {
    opacity: 0;
    transform: scale(0.8);
  }
  to {
    opacity: 1;
    transform: scale(1);
  }
}
</style>
    </div>
  </div>


   {{-- Abonnement --}}
      <div class="section">
        <div class="container">
            <div class="section-heading">
                <h6 id="Abonnement">| Nos Plans</h6>
                <h2>Choisissez le Plan Qui Vous Convient</h2>
            </div>

            <div class="pricing-cards">
                <!-- Plan Gratuit -->
                <div class="pricing-card free">
                    <div class="plan-header">
                        <div class="plan-icon">
                            <i class="fas fa-home"></i>
                        </div>
                        <h3 class="plan-name">Gratuit</h3>
                        <p class="plan-description">Parfait pour découvrir nos services et explorer le marché immobilier</p>
                    </div>

                    <div class="plan-price">
                        <div class="price">
                           0 <span class="price-currency">Ar</span>
                        </div>
                        <div class="price-period">par mois</div>
                    </div>

                    <ul class="features-list">
                        <li>
                            <span class="feature-icon">
                                <i class="fas fa-check"></i>
                            </span>
                            Accès aux annonces publiques
                        </li>
                        <li>
                            <span class="feature-icon">
                                <i class="fas fa-check"></i>
                            </span>
                          Filtres de recherche basiques
                        </li>
                        <li>
                            <span class="feature-icon">
                                <i class="fas fa-check"></i>
                            </span>
                            5 annonces par mois
                        </li>
                        <li>
                            <span class="feature-icon disabled">
                                <i class="fas fa-times"></i>
                            </span>
                            Support prioritaire
                        </li>
                        <li>
                            <span class="feature-icon disabled">
                                <i class="fas fa-times"></i>
                            </span>
                            Annonces exclusives
                        </li>
                    </ul>

                    <a href="#" class="plan-button">Commencer Gratuitement</a>
                </div>

                <!-- Plan Silver -->
                <div class="pricing-card silver">
                    <div class="popular-badge">Populaire</div>

                    <div class="plan-header">
                        <div class="plan-icon">
                            <i class="fas fa-building"></i>
                        </div>
                        <h3 class="plan-name">Silver</h3>
                        <p class="plan-description">Idéal pour les investisseurs sérieux qui veulent accéder à plus d'opportunités</p>
                    </div>

                    <div class="plan-price">
                        <div class="price">
                           39 000 <span class="price-currency">Ar</span>
                        </div>
                        <div class="price-period">par mois</div>
                    </div>

                    <ul class="features-list">
                        <li>
                            <span class="feature-icon">
                                <i class="fas fa-check"></i>
                            </span>
                            Tout du plan Gratuit
                        </li>
                        <li>
                            <span class="feature-icon">
                                <i class="fas fa-check"></i>
                            </span>
                            20 annonces par mois
                        </li>
                        <li>
                            <span class="feature-icon">
                                <i class="fas fa-check"></i>
                            </span>
                            Filtres de recherche avancés
                        </li>

                        <li>
                            <span class="feature-icon disabled">
                                <i class="fas fa-times"></i>
                            </span>
                            Conseiller personnel
                        </li>
                    </ul>

                    <a href="{{ route("Abonnement") }}" class="plan-button">Choisir Silver</a>
                </div>

                <!-- Plan Gold -->
                <div class="pricing-card gold">
                    <div class="recommended-badge">Recommandé</div>

                    <div class="plan-header">
                        <div class="plan-icon">
                            <i class="fas fa-crown"></i>
                        </div>
                        <h3 class="plan-name">Gold</h3>
                        <p class="plan-description">Pour les professionnels qui veulent un accès complet et un service premium</p>
                    </div>

                    <div class="plan-price">
                        <div class="price">
                           79 000 <span class="price-currency">Ar</span>
                        </div>
                        <div class="price-period">par mois</div>
                    </div>

                    <ul class="features-list">
                        <li>
                            <span class="feature-icon">
                                <i class="fas fa-check"></i>
                            </span>
                            Tout du plan Silver
                        </li>
                        <li>
                            <span class="feature-icon">
                                <i class="fas fa-check"></i>
                            </span>
                            Annonces illimités
                        </li>
                        {{-- <li>
                            <span class="feature-icon">
                                <i class="fas fa-check"></i>
                            </span>
                            Annonces exclusives 24h avant
                        </li> --}}
                        <li>
                            <span class="feature-icon">
                                <i class="fas fa-check"></i>
                            </span>
                            Conseiller personnel dédié
                        </li>
                        <li>
                            <span class="feature-icon">
                                <i class="fas fa-check"></i>
                            </span>
                            Analyses de marché privées
                        </li>
                    </ul>

                    <a href="{{ route("Abonnement") }}" class="plan-button">Choisir Gold</a>
                </div>
            </div>
        </div>
    </div>

  <div class="contact section">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 offset-lg-4">
          <div class="section-heading text-center">
            <h6>| Contact Us</h6>
            <h2>Nos conseillers sont à votre écoute</h2>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="contact-content">
    <div class="container">
      <div class="row">
        <div class="col-lg-7">
          <div id="map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d12469.776493332698!2d-80.14036379941481!3d25.907788681148624!2m3!1f357.26927939317244!2f20.870722720054623!3f0!3m2!1i1024!2i768!4f35!3m3!1m2!1s0x88d9add4b4ac788f%3A0xe77469d09480fcdb!2sSunny%20Isles%20Beach!5e1!3m2!1sen!2sth!4v1642869952544!5m2!1sen!2sth" width="100%" height="500px" frameborder="0" style="border:0; border-radius: 10px; box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.15);" allowfullscreen=""></iframe>
          </div>
          <div class="row">
            <div class="col-lg-6">
              <div class="item phone">
                <img src="assets/images/phone-icon.png" alt="" style="max-width: 52px;">
                <h6>038 57 564 24<br><span>Infoline</span></h6>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="item email">
                <img src="assets/images/email-icon.png" alt="" style="max-width: 52px;">
                <h6>emmotsoa261@gmail.com<br></h6>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-5">
          <form id="contact-form" action="" method="post">
            <div class="row">
              <div class="col-lg-12">
                <fieldset>
                  <label for="name">Full Name</label>
                  <input type="name" name="name" id="name" placeholder="Your Name..." autocomplete="on" required>
                </fieldset>
              </div>
              <div class="col-lg-12">
                <fieldset>
                  <label for="email">Email Address</label>
                  <input type="text" name="email" id="email" pattern="[^ @]*@[^ @]*" placeholder="Your E-mail..." required="">
                </fieldset>
              </div>
              <div class="col-lg-12">
                <fieldset>
                  <label for="subject">Subject</label>
                  <input type="subject" name="subject" id="subject" placeholder="Subject..." autocomplete="on" >
                </fieldset>
              </div>
              <div class="col-lg-12">
                <fieldset>
                  <label for="message">Message</label>
                  <textarea name="message" id="message" placeholder="Your Message"></textarea>
                </fieldset>
              </div>
              <div class="col-lg-12">
                <fieldset>
                  <button type="submit" id="form-submit" class="orange-button">Send Message</button>
                </fieldset>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <script src="{{ asset("assets/js/sweetalert2@11.js") }}"></script>

<script>
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Parfait !',
            html: '<p style="font-size: 16px;">{{ session('success') }}</p>',
            showConfirmButton: true,
            confirmButtonColor: '#ff6b35',
            confirmButtonText: '<i class="fas fa-check"></i> Compris',
            timer: 6000,
            timerProgressBar: true,
            backdrop: `
                rgba(255,107,53,0.2)
                left top
                no-repeat
            `,
            customClass: {
                popup: 'animated fadeInDown'
            }
        });
    @endif

    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Oups !',
            html: '<p style="font-size: 16px;">{{ session('error') }}</p>',
            confirmButtonColor: '#dc3545',
            confirmButtonText: '<i class="fas fa-times"></i> Fermer',
            customClass: {
                popup: 'animated shake'
            }
        });
    @endif
</script>
<script>
        // Animation au scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -100px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.animationPlayState = 'running';
                }
            });
        }, observerOptions);

        document.querySelectorAll('.pricing-card').forEach(card => {
            card.style.animationPlayState = 'paused';
            observer.observe(card);
        });

        // Gestion des clics sur les boutons
        // document.querySelectorAll('.plan-button').forEach(button => {
        //     button.addEventListener('click', function(e) {
        //         e.preventDefault();

        //         const card = this.closest('.pricing-card');
        //         const planName = card.querySelector('.plan-name').textContent;

        //         // Animation du bouton
        //         const originalText = this.textContent;
        //         this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Traitement...';
        //         this.disabled = true;

        //         setTimeout(() => {
        //             this.innerHTML = '<i class="fas fa-check"></i> Plan sélectionné !';

        //             setTimeout(() => {
        //                 this.innerHTML = originalText;
        //                 this.disabled = false;

        //                 // Ici vous pouvez ajouter votre logique de redirection ou d'ouverture de modal
        //                 console.log(`Plan ${planName} sélectionné`);
        //             }, 2000);
        //         }, 1500);
        //     });
        // });

        // Effet de survol amélioré
        document.querySelectorAll('.pricing-card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.zIndex = '10';
            });

            card.addEventListener('mouseleave', function() {
                this.style.zIndex = '1';
            });
        });
    </script>

  @endsection
