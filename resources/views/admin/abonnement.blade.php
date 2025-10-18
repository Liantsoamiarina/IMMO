    @extends("admin.layouts.Admin")
    @section("body")
    @section("style")
    <link rel="stylesheet" href="{{ asset("assets/css/realdash.css") }}">
    <style>
        /* Styles pour le tableau des abonnements */
        .subscriptions-section {
            background: var(--card-bg);
            border-radius: 12px;
            padding: 24px;
            margin-top: 24px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .subscriptions-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .subscriptions-header h2 {
            font-size: 20px;
            font-weight: 600;
            color: var(--text);
            margin: 0;
        }

        .filter-buttons {
            display: flex;
            gap: 8px;
        }

        .filter-btn {
            padding: 8px 16px;
            border: 1px solid var(--border);
            background: transparent;
            color: var(--text);
            border-radius: 6px;
            cursor: pointer;
            font-size: 13px;
            transition: all 0.3s;
        }

        .filter-btn:hover {
            background: var(--hover);
        }

        .filter-btn.active {
            background: var(--accent);
            color: white;
            border-color: var(--accent);
        }

        .subscriptions-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 16px;
        }

        .subscriptions-table thead {
            background: var(--hover);
        }

        .subscriptions-table th {
            padding: 12px 16px;
            text-align: left;
            font-weight: 600;
            font-size: 13px;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .subscriptions-table td {
            padding: 16px;
            border-bottom: 1px solid var(--border);
            font-size: 14px;
            color: var(--text);
        }

        .subscriptions-table tbody tr {
            transition: background 0.2s;
        }

        .subscriptions-table tbody tr:hover {
            background: var(--hover);
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--accent), #fdba74);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 14px;
        }

        .user-details h4 {
            margin: 0;
            font-size: 14px;
            font-weight: 600;
            color: var(--text);
        }

        .user-details p {
            margin: 2px 0 0 0;
            font-size: 12px;
            color: var(--muted);
        }

        .plan-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .plan-free {
            background: #f3f4f6;
            color: #6b7280;
        }

        .plan-silver {
            background: #fef3c7;
            color: #f59e0b;
        }

        .plan-gold {
            background: #fef9c3;
            color: #eab308;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .status-active {
            background: #dcfce7;
            color: #16a34a;
        }

        .status-inactive {
            background: #fef3c7;
            color: #f59e0b;
        }

        .status-expired {
            background: #fee2e2;
            color: #dc2626;
        }

        .status-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: currentColor;
        }

        .action-buttons {
            display: flex;
            gap: 8px;
        }

        .btn-action {
            padding: 6px 12px;
            border: none;
            border-radius: 6px;
            font-size: 12px;
            cursor: pointer;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .btn-activate {
            background: #22c55e;
            color: white;
        }

        .btn-activate:hover {
            background: #16a34a;
        }

        .btn-view {
            background: #3b82f6;
            color: white;
        }

        .btn-view:hover {
            background: #2563eb;
        }

        .btn-cancel {
            background: #ef4444;
            color: white;
        }

        .btn-cancel:hover {
            background: #dc2626;
        }

        .empty-state {
            text-align: center;
            padding: 48px 24px;
            color: var(--muted);
        }

        .empty-state i {
            font-size: 48px;
            margin-bottom: 16px;
            opacity: 0.3;
        }

        .stats-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 16px;
            margin-bottom: 24px;
        }

        .stat-card {
            background: var(--card-bg);
            padding: 16px;
            border-radius: 8px;
            border: 1px solid var(--border);
        }

        .stat-card h3 {
            font-size: 24px;
            font-weight: 700;
            margin: 0 0 4px 0;
            color: var(--text);
        }

        .stat-card p {
            font-size: 13px;
            color: var(--muted);
            margin: 0;
        }
    </style>
    @endsection

    <main>
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

        @if(session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const notyf = new Notyf({
                    duration: 4000,
                    position: { x: 'right', y: 'top' },
                    dismissible: true
                });
                notyf.error("{{ session('error') }}");
            });
        </script>
        @endif

        <div class="topbar">
            <div class="page-title">Gestion des Abonnements</div>
            <div id="currentDateTime" class="text-center badge bg-primary p-3"></div>
            <div style="display:flex; gap:15px; align-items:center;">
                <svg id="themeToggle" class="toggle-icon" viewBox="0 0 24 24">
                    <path d="M21.64 13.65A9 9 0 1110.35 2.36a7 7 0 0011.29 11.29z"/>
                </svg>
                <div class="avatar">{{ substr(Auth::user()->name, 0, 2) }}</div>
            </div>
        </div>

        <!-- Statistiques -->
        <div class="stats-row">
            <div class="stat-card">
                <h3>{{ $stats['total'] }}</h3>
                <p>Total Abonnements</p>
            </div>
            <div class="stat-card">
                <h3 style="color: #22c55e;">{{ $stats['active'] }}</h3>
                <p>Actifs</p>
            </div>
            <div class="stat-card">
                <h3 style="color: #f59e0b;">{{ $stats['pending'] }}</h3>
                <p>En Attente</p>
            </div>
            <div class="stat-card">
                <h3 style="color: #ef4444;">{{ $stats['expired'] }}</h3>
                <p>Expirés</p>
            </div>
        </div>

        <!-- Tableau des abonnements -->
        <section class="subscriptions-section">
            <div class="subscriptions-header">
                <h2>Liste des Abonnements</h2>
                <div class="filter-buttons">
                    <button class="filter-btn active" data-filter="all">Tous</button>
                    <button class="filter-btn" data-filter="active">Actifs</button>
                    <button class="filter-btn" data-filter="inactive">En attente</button>
                    <button class="filter-btn" data-filter="expired">Expirés</button>
                </div>
            </div>

            <table class="subscriptions-table">
                <thead>
                    <tr>
                        <th>Client</th>
                        <th>Plan</th>
                        <th>Prix</th>
                        <th>Statut</th>
                        <th>Début</th>
                        <th>Expiration</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($subscriptions as $subscription)
                    <tr data-status="{{ $subscription->status }}">
                        <td>
                            <div class="user-info">
                                <div class="user-avatar">
                                    {{ strtoupper(substr($subscription->user->name, 0, 2)) }}
                                </div>
                                <div class="user-details">
                                    <h4>{{ $subscription->user->name }}</h4>
                                    <p>{{ $subscription->user->email }}</p>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="plan-badge plan-{{ $subscription->type }}">
                                @if($subscription->type == 'free')
                                    <i class="fa-solid fa-home"></i> Gratuit
                                @elseif($subscription->type == 'silver')
                                    <i class="fa-solid fa-building"></i> Silver
                                @else
                                    <i class="fa-solid fa-crown"></i> Gold
                                @endif
                            </span>
                        </td>
                        <td>
                            <strong>{{ number_format($subscription->price, 0, ',', ' ') }} Ar</strong>
                        </td>
                        <td>
                            @if($subscription->status == 'active')
                                <span class="status-badge status-active">
                                    <span class="status-dot"></span> Actif
                                </span>
                            @elseif($subscription->status == 'inactive')
                                <span class="status-badge status-inactive">
                                    <span class="status-dot"></span> En attente
                                </span>
                            @else
                                <span class="status-badge status-expired">
                                    <span class="status-dot"></span> Expiré
                                </span>
                            @endif
                        </td>
                        <td>
                            {{ $subscription->starts_at ? $subscription->starts_at->format('d/m/Y') : '-' }}
                        </td>
                        <td>
                            @if($subscription->expires_at)
                                {{ $subscription->expires_at->format('d/m/Y') }}
                                @if($subscription->isActive())
                                    <br><small style="color: var(--muted);">
                                        ({{ $subscription->getDaysRemaining() }} jours restants)
                                    </small>
                                @endif
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            <div class="action-buttons">
                                @if($subscription->status == 'inactive')
                                    <form action="{{ route('admin.subscriptions.activate', $subscription->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn-action btn-activate" title="Activer">
                                            <i class="fa-solid fa-check"></i> Activer
                                        </button>
                                    </form>
                                @endif

                                <button class="btn-action btn-view" onclick="viewDetails({{ $subscription->id }})" title="Voir détails">
                                    <i class="fa-solid fa-eye"></i>
                                </button>

                                @if($subscription->status == 'active')
                                    {{-- <form action="{{ route('admin.subscriptions.cancel', $subscription->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Êtes-vous sûr de vouloir annuler cet abonnement ?')"> --}}
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action btn-cancel" title="Annuler">
                                            <i class="fa-solid fa-times"></i>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7">
                            <div class="empty-state">
                                <i class="fa-solid fa-inbox"></i>
                                <p>Aucun abonnement trouvé</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </section>
    </main>

    @endsection

    @section("scripts")
    <script>
        // Filtres
        document.querySelectorAll('.filter-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                // Retirer la classe active de tous les boutons
                document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
                // Ajouter la classe active au bouton cliqué
                this.classList.add('active');

                const filter = this.dataset.filter;
                const rows = document.querySelectorAll('.subscriptions-table tbody tr');

                rows.forEach(row => {
                    if (filter === 'all') {
                        row.style.display = '';
                    } else {
                        const status = row.dataset.status;
                        row.style.display = status === filter ? '' : 'none';
                    }
                });
            });
        });

        // Voir les détails
        function viewDetails(id) {
            // Vous pouvez rediriger vers une page de détails ou ouvrir un modal
            alert('Détails de l\'abonnement #' + id);
            // Ou: window.location.href = '/admin/subscriptions/' + id;
        }

        // Animation au chargement
        window.addEventListener('load', () => {
            const rows = document.querySelectorAll('.subscriptions-table tbody tr');
            rows.forEach((row, index) => {
                setTimeout(() => {
                    row.style.opacity = '0';
                    row.style.transform = 'translateY(20px)';
                    row.style.transition = 'all 0.3s ease';

                    setTimeout(() => {
                        row.style.opacity = '1';
                        row.style.transform = 'translateY(0)';
                    }, 50);
                }, index * 50);
            });
        });
    </script>
    @endsection
