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
            duration: 3000,        // Durée d'affichage en ms
            position: { x: 'right', y: 'top' },
            dismissible: true       // Possibilité de fermer manuellement
        });

        notyf.success("Bonjour, {{ Auth::user()->name }} !");
    });
</script>
@endif

    <div class="topbar">
      <div class="page-title">Bonjour, Liantsoa</div>

      <div id="currentDateTime" class="text-center badge bg-primary p-3"></div>



      <div style="display:flex; gap:15px; align-items:center;">
        <svg id="themeToggle" class="toggle-icon" viewBox="0 0 24 24">
          <path d="M21.64 13.65A9 9 0 1110.35 2.36a7 7 0 0011.29 11.29z"/>
        </svg>
        <div class="avatar">KJ</div>
      </div>
    </div>

    <div class="kpis">
      <div class="card">
        <div><div class="label">Properties for Sale</div><div class="value">680</div></div>
        <div class="donut"><canvas id="donut1"></canvas></div>
      </div>
      <div class="card">
        <div><div class="label">Properties for Rent</div><div class="value">550</div></div>
        <div class="donut"><canvas id="donut2"></canvas></div>
      </div>
      <div class="card">
        <div><div class="label">Total Customers</div><div class="value">5684</div></div>
        <div class="donut"><canvas id="donut3"></canvas></div>
      </div>
      <div class="card">
        <div><div class="label">Properties for Cities</div><div class="value">555</div></div>
        <div class="donut"><canvas id="donut4"></canvas></div>
      </div>
    </div>

    <div class="charts-row">
      <div class="chart-card">
        <h3>Total Revenue</h3>
        <p style="color:var(--muted); font-size:13px; margin-bottom:5px;">
          <span style="color:var(--accent); font-weight:600;">+10%</span> Since last month
        </p>
        <h2>$1,000,000</h2>
        <canvas id="revenueChart" height="140"></canvas>
      </div>

      <div class="progress-list">
        <h3>Property Referrals</h3>
        <div class="progress-item">
          <div class="progress-header"><span>Social Media</span><span>64%</span></div>
          <div class="progress-bar"><div class="progress-fill" data-width="64%" style="background:#f97316;"></div></div>
        </div>
        <div class="progress-item">
          <div class="progress-header"><span>Marketplace</span><span>56%</span></div>
          <div class="progress-bar"><div class="progress-fill" data-width="56%" style="background:#22c55e;"></div></div>
        </div>
        <div class="progress-item">
          <div class="progress-header"><span>Websites</span><span>50%</span></div>
          <div class="progress-bar"><div class="progress-fill" data-width="50%" style="background:#facc15;"></div></div>
        </div>
        <div class="progress-item">
          <div class="progress-header"><span>Digital Ads</span><span>80%</span></div>
          <div class="progress-bar"><div class="progress-fill" data-width="80%" style="background:#3b82f6;"></div></div>
        </div>
        <div class="progress-item">
          <div class="progress-header"><span>Others</span><span>15%</span></div>
          <div class="progress-bar"><div class="progress-fill" data-width="15%" style="background:#ef4444;"></div></div>
        </div>
      </div>
    </div>
     <!-- Latest Properties -->
    <section class="latest-properties">
      <h2>Latest Properties</h2>
      <div class="properties-grid">
        <div class="property-card">
          <img src="https://picsum.photos/300/200?random=1" alt="Property 1">
          <div class="property-info">
            <h3>Modern Hotel</h3>
            <p><i class="fa-solid fa-location-dot"></i> New York, USA</p>
            <span class="price">$1349</span>
          </div>
        </div>

        <div class="property-card">
          <img src="https://picsum.photos/300/200?random=2" alt="Property 2">
          <div class="property-info">
            <h3>Lavender Apartment</h3>
            <p><i class="fa-solid fa-location-dot"></i> California, USA</p>
            <span class="price">$1999</span>
          </div>
        </div>

        <div class="property-card">
          <img src="https://picsum.photos/300/200?random=3" alt="Property 3">
          <div class="property-info">
            <h3>Skyline Condo</h3>
            <p><i class="fa-solid fa-location-dot"></i> Miami, USA</p>
            <span class="price">$999</span>
          </div>
        </div>
      </div>
    </section>
  </main>
</div>
@endsection
@section("scripts")
<script>
      const varAccent = '#f97316';

  function createDonut(id, percent) {
    new Chart(document.getElementById(id), {
      type: 'doughnut',
      data: { datasets: [{ data: [percent, 100 - percent], backgroundColor: [varAccent, '#eee'], borderWidth: 0 }] },
      options: { cutout: '70%', responsive: false, plugins: { legend: { display: false }, tooltip: { enabled: false } } }
    });
  }

  createDonut('donut1', 75);
  createDonut('donut2', 60);
  createDonut('donut3', 85);
  createDonut('donut4', 50);

  const revenueChart = new Chart(document.getElementById('revenueChart'), {
    type: 'bar',
    data: {
      labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
      datasets: [
        { label: 'Last Month', data: [200, 150, 130, 170, 160, 90, 20], backgroundColor: '#f97316', borderRadius: 6 },
        { label: 'Running Month', data: [120, 100, 90, 140, 120, 70, 10], backgroundColor: '#fdba74', borderRadius: 6 }
      ]
    },
    options: {
      plugins: { legend: { display: true } },
      scales: {
        y: { beginAtZero: true, ticks: { callback: value => value + 'k' } },
        x: { grid: { display: false } }
      }
    }
  });
   // Animation des barres de progression
    window.addEventListener('load', () => {
    document.querySelectorAll('.progress-fill').forEach(bar => {
      setTimeout(() => { bar.style.width = bar.dataset.width; }, 300);
    });
  });

</script>
@endsection
