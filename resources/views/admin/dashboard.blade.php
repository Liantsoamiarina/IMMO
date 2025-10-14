@extends("admin.layouts.Admin")
@section("body")
@section("style")
<link rel="stylesheet" href="{{ asset("assets/css/realdash.css") }}">
@endsection
<main>
    @if(Auth::check())
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const notyf = new Notyf({
                duration: 3000,
                position: { x: 'right', y: 'top' },
                dismissible: true
            });

            notyf.success("Bonjour, {{ Auth::user()->name }} !");
        });
    </script>
    @endif

    @if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const notyf = new Notyf({
                duration: 4000,
                position: { x: 'right', y: 'top' },
                dismissible: true
            });
            notyf.success("{{ session('success') }}");
        });
    </script>
    @endif

    <div class="topbar">
        <div class="page-title">Bonjour, {{ Auth::user()->name }}</div>
        <div id="currentDateTime" class="text-center badge bg-primary p-3"></div>
        <div style="display:flex; gap:15px; align-items:center;">
            <svg id="themeToggle" class="toggle-icon" viewBox="0 0 24 24">
                <path d="M21.64 13.65A9 9 0 1110.35 2.36a7 7 0 0011.29 11.29z"/>
            </svg>
            <div class="avatar">{{ strtoupper(substr(Auth::user()->name, 0, 2)) }}</div>
        </div>
    </div>

    <div class="kpis">
        <div class="card">
            <div>
                <div class="label">Annonces en Vente</div>
                <div class="value">{{ $stats['properties_sale'] }}</div>
            </div>
            <div class="donut"><canvas id="donut1"></canvas></div>
        </div>
        <div class="card">
            <div>
                <div class="label">Annonces en Location</div>
                <div class="value">{{ $stats['properties_rent'] }}</div>
            </div>
            <div class="donut"><canvas id="donut2"></canvas></div>
        </div>
        <div class="card">
            <div>
                <div class="label">Total Clients</div>
                <div class="value">{{ $stats['total_users'] }}</div>
            </div>
            <div class="donut"><canvas id="donut3"></canvas></div>
        </div>
        <div class="card">
            <div>
                <div class="label">Abonnements Actifs</div>
                <div class="value">{{ $stats['active_subscriptions'] }}</div>
            </div>
            <div class="donut"><canvas id="donut4"></canvas></div>
        </div>
    </div>

    <div class="charts-row">
        <div class="chart-card">
            <h3>Revenus des Abonnements</h3>
            <p style="color:var(--muted); font-size:13px; margin-bottom:5px;">
                <span style="color:var(--accent); font-weight:600;">
                    {{ $stats['revenue_growth'] > 0 ? '+' : '' }}{{ number_format($stats['revenue_growth'], 1) }}%
                </span>
                Depuis le mois dernier
            </p>
            <h2>{{ number_format($stats['revenue_this_month'], 0, ',', ' ') }} Ar</h2>
            <canvas id="revenueChart" height="140"></canvas>
        </div>

        <div class="progress-list">
            <h3>Répartition des Plans</h3>
            <div class="progress-item">
                <div class="progress-header">
                    <span>Plan Gratuit</span>
                    <span>{{ $stats['plan_percentages']['free'] }}%</span>
                </div>
                <div class="progress-bar">
                    <div class="progress-fill" data-width="{{ $stats['plan_percentages']['free'] }}%" style="background:#6b7280;"></div>
                </div>
            </div>
            <div class="progress-item">
                <div class="progress-header">
                    <span>Plan Silver</span>
                    <span>{{ $stats['plan_percentages']['silver'] }}%</span>
                </div>
                <div class="progress-bar">
                    <div class="progress-fill" data-width="{{ $stats['plan_percentages']['silver'] }}%" style="background:#f97316;"></div>
                </div>
            </div>
            <div class="progress-item">
                <div class="progress-header">
                    <span>Plan Gold</span>
                    <span>{{ $stats['plan_percentages']['gold'] }}%</span>
                </div>
                <div class="progress-bar">
                    <div class="progress-fill" data-width="{{ $stats['plan_percentages']['gold'] }}%" style="background:#facc15;"></div>
                </div>
            </div>
            <div class="progress-item">
                <div class="progress-header">
                    <span>En Attente</span>
                    <span>{{ $stats['pending_subscriptions'] }}</span>
                </div>
                <div class="progress-bar">
                    <div class="progress-fill" data-width="{{ ($stats['pending_subscriptions'] / max($stats['total_subscriptions'], 1)) * 100 }}%" style="background:#3b82f6;"></div>
                </div>
            </div>
            <div class="progress-item">
                <div class="progress-header">
                    <span>Expirés</span>
                    <span>{{ $stats['expired_subscriptions'] }}</span>
                </div>
                <div class="progress-bar">
                    <div class="progress-fill" data-width="{{ ($stats['expired_subscriptions'] / max($stats['total_subscriptions'], 1)) * 100 }}%" style="background:#ef4444;"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Latest Properties -->
    <section class="latest-properties">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h2>Dernières Annonces</h2>
            <a href="#" style="color: var(--accent); text-decoration: none; font-size: 14px;">
                Voir tout <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
        <div class="properties-grid">
            @forelse($latestProperties as $property)
            <div class="property-card">
                @if($property->images->count() > 0)
                    <img src="{{ $property->getFirstImage() }}" alt="{{ $property->title }}">
                @else
                    <img src="https://picsum.photos/300/200?random={{ $property->id }}" alt="{{ $property->title }}">
                @endif
                <div class="property-info">
                    <h3>{{ Str::limit($property->title, 30) }}</h3>
                    <p><i class="fa-solid fa-location-dot"></i> {{ $property->getFullAddress() }}</p>
                    <span class="price">{{ number_format($property->price, 0, ',', ' ') }} Ar</span>
                    <span class="badge" style="background: {{ $property->transaction_type == 'vente' ? '#22c55e' : '#3b82f6' }}; color: white; padding: 4px 8px; border-radius: 4px; font-size: 11px; margin-left: 8px;">
                        {{ ucfirst($property->transaction_type) }}
                    </span>
                </div>
            </div>
            @empty
            <div style="grid-column: 1 / -1; text-align: center; padding: 40px; color: var(--muted);">
                <i class="fa-solid fa-home" style="font-size: 48px; opacity: 0.3; margin-bottom: 16px;"></i>
                <p>Aucune annonce disponible pour le moment</p>
            </div>
            @endforelse
        </div>
    </section>

    <!-- Quick Actions -->
    <section class="latest-properties" style="margin-top: 30px;">
        <h2>Actions Rapides</h2>
        <div class="properties-grid">
            <a href="{{ route('admin.subscriptions.index', ['status' => 'pending']) }}" class="property-card" style="text-decoration: none; background: linear-gradient(135deg, #f97316, #fdba74); color: white; display: flex; flex-direction: column; justify-content: center; align-items: center; min-height: 200px;">
                <i class="fa-solid fa-clock" style="font-size: 48px; margin-bottom: 16px;"></i>
                <h3 style="color: white;">{{ $stats['pending_subscriptions'] }}</h3>
                <p style="color: rgba(255,255,255,0.9);">Demandes en attente</p>
            </a>

            <a href="{{ route('admin.subscriptions.index') }}" class="property-card" style="text-decoration: none; background: linear-gradient(135deg, #22c55e, #86efac); color: white; display: flex; flex-direction: column; justify-content: center; align-items: center; min-height: 200px;">
                <i class="fa-solid fa-chart-line" style="font-size: 48px; margin-bottom: 16px;"></i>
                <h3 style="color: white;">{{ $stats['active_subscriptions'] }}</h3>
                <p style="color: rgba(255,255,255,0.9);">Abonnements actifs</p>
            </a>

            <a href="#" class="property-card" style="text-decoration: none; background: linear-gradient(135deg, #3b82f6, #93c5fd); color: white; display: flex; flex-direction: column; justify-content: center; align-items: center; min-height: 200px;">
                <i class="fa-solid fa-users" style="font-size: 48px; margin-bottom: 16px;"></i>
                <h3 style="color: white;">{{ $stats['total_users'] }}</h3>
                <p style="color: rgba(255,255,255,0.9);">Utilisateurs inscrits</p>
            </a>
        </div>
    </section>
</main>

@endsection

@section("scripts")
<script>
    const varAccent = '#f97316';

    function createDonut(id, percent) {
        new Chart(document.getElementById(id), {
            type: 'doughnut',
            data: {
                datasets: [{
                    data: [percent, 100 - percent],
                    backgroundColor: [varAccent, '#eee'],
                    borderWidth: 0
                }]
            },
            options: {
                cutout: '70%',
                responsive: false,
                plugins: {
                    legend: { display: false },
                    tooltip: { enabled: false }
                }
            }
        });
    }

    // Calcul des pourcentages pour les donuts
    const totalProperties = {{ $stats['properties_sale'] + $stats['properties_rent'] }};
    const salePercent = totalProperties > 0 ? ({{ $stats['properties_sale'] }} / totalProperties) * 100 : 0;
    const rentPercent = totalProperties > 0 ? ({{ $stats['properties_rent'] }} / totalProperties) * 100 : 0;
    const usersPercent = {{ $stats['total_users'] > 0 ? ($stats['active_subscriptions'] / $stats['total_users']) * 100 : 0 }};
    const subsPercent = {{ $stats['total_subscriptions'] > 0 ? ($stats['active_subscriptions'] / $stats['total_subscriptions']) * 100 : 0 }};

    createDonut('donut1', salePercent);
    createDonut('donut2', rentPercent);
    createDonut('donut3', usersPercent);
    createDonut('donut4', subsPercent);

    // Graphique des revenus
    const revenueChart = new Chart(document.getElementById('revenueChart'), {
        type: 'bar',
        data: {
            labels: {!! json_encode(array_keys($stats['monthly_revenue'])) !!},
            datasets: [
                {
                    label: 'Revenus',
                    data: {!! json_encode(array_values($stats['monthly_revenue'])) !!},
                    backgroundColor: '#f97316',
                    borderRadius: 6
                }
            ]
        },
        options: {
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: value => new Intl.NumberFormat('fr-FR', {
                            notation: 'compact',
                            compactDisplay: 'short'
                        }).format(value) + ' Ar'
                    }
                },
                x: {
                    grid: { display: false }
                }
            }
        }
    });

    // Animation des barres de progression
    window.addEventListener('load', () => {
        document.querySelectorAll('.progress-fill').forEach(bar => {
            setTimeout(() => {
                bar.style.width = bar.dataset.width;
            }, 300);
        });
    });
</script>
@endsection
