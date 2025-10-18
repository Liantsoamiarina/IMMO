@extends("admin.layouts.Admin")
@section("body")
@section("style")
<link rel="stylesheet" href="{{ asset("assets/css/realdash.css") }}">
<style>
    .clients-section {
        background: var(--card-bg);
        border-radius: 12px;
        padding: 24px;
        margin-top: 24px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    .clients-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .clients-header h2 {
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

    .clients-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 16px;
    }

    .clients-table thead {
        background: var(--hover);
    }

    .clients-table th {
        padding: 12px 16px;
        text-align: left;
        font-weight: 600;
        font-size: 13px;
        color: var(--muted);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .clients-table td {
        padding: 16px;
        border-bottom: 1px solid var(--border);
        font-size: 14px;
        color: var(--text);
    }

    .clients-table tbody tr {
        transition: background 0.2s;
    }

    .clients-table tbody tr:hover {
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
        background: #fee2e2;
        color: #dc2626;
    }

    .status-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: currentColor;
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
    <div class="topbar">
        <div class="page-title">Liste des Clients</div>
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
            <h3>{{ $clients->count() }}</h3>
            <p>Total Clients</p>
        </div>
        <div class="stat-card">
            <h3 style="color: #22c55e;">{{ $clients->where('status', 'active')->count() }}</h3>
            <p>Actifs</p>
        </div>
        <div class="stat-card">
            <h3 style="color: #ef4444;">{{ $clients->where('status', 'inactive')->count() }}</h3>
            <p>Inactifs</p>
        </div>
        <div class="stat-card">
            <h3 style="color: #3b82f6;">{{ $clients->where('created_at', '>=', now()->startOfMonth())->count() }}</h3>
            <p>Nouveaux ce mois</p>
        </div>
    </div>

    <!-- Tableau des clients -->
    <section class="clients-section">
        <div class="clients-header">
            <h2>Liste des Clients</h2>
            <div class="filter-buttons">
                <button class="filter-btn active" data-filter="all">Tous</button>
                <button class="filter-btn" data-filter="active">Actifs</button>
                <button class="filter-btn" data-filter="inactive">Inactifs</button>
            </div>
        </div>

        <table class="clients-table">
            <thead>
                <tr>
                    <th>Client</th>
                    <th>Téléphone</th>
                    <th>Rôle</th>
                    <th>Statut</th>
                    <th>Date d'inscription</th>
                    <th>Dernière connexion</th>
                </tr>
            </thead>
            <tbody>
                @forelse($clients as $client)
                <tr data-status="{{ $client->status ?? 'active' }}">
                    <td>
                        <div class="user-info">
                            <div class="user-avatar">
                                {{ strtoupper(substr($client->name, 0, 2)) }}
                            </div>
                            <div class="user-details">
                                <h4>{{ $client->name }}</h4>
                                <p>{{ $client->email }}</p>
                            </div>
                        </div>
                    </td>
                    <td>
                        {{ $client->phone ?? '-' }}
                    </td>
                    <td>
                        @if($client->role == 'client')
                            <span style="color: #3b82f6; font-weight: 600;">
                                <i class="fa-solid fa-user"></i> Client
                            </span>
                        @elseif($client->role == 'owner')
                            <span style="color: #f59e0b; font-weight: 600;">
                                <i class="fa-solid fa-building"></i> Propriétaire
                            </span>
                        @else
                            <span style="color: #8b5cf6; font-weight: 600;">
                                <i class="fa-solid fa-crown"></i> Admin
                            </span>
                        @endif
                    </td>
                    <td>
                        @if(($client->status ?? 'active') == 'active')
                            <span class="status-badge status-active">
                                <span class="status-dot"></span> Actif
                            </span>
                        @else
                            <span class="status-badge status-inactive">
                                <span class="status-dot"></span> Inactif
                            </span>
                        @endif
                    </td>
                    <td>
                        {{ $client->created_at->format('d/m/Y') }}
                        <br><small style="color: var(--muted);">
                            {{ $client->created_at->format('H:i') }}
                        </small>
                    </td>
                    <td>
                        @if($client->last_login_at)
                            {{ $client->last_login_at->format('d/m/Y') }}
                            <br><small style="color: var(--muted);">
                                {{ $client->last_login_at->diffForHumans() }}
                            </small>
                        @else
                            <span style="color: var(--muted);">Jamais connecté</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6">
                        <div class="empty-state">
                            <i class="fa-solid fa-users"></i>
                            <p>Aucun client trouvé</p>
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
            document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
            this.classList.add('active');

            const filter = this.dataset.filter;
            const rows = document.querySelectorAll('.clients-table tbody tr');

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

    // Animation au chargement
    window.addEventListener('load', () => {
        const rows = document.querySelectorAll('.clients-table tbody tr');
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
