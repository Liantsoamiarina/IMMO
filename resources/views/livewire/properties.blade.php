<main>
   <div class="topbar">
      <div class="page-title">Bonjour, Liantsoa</div>

      <div id="currentDateTime" class="text-center badge bg-primary p-3"></div>


<script>
    function fetchServerTime() {
        fetch('/current-time')
            .then(response => response.json())
            .then(data => {
                document.getElementById('currentDateTime').textContent = data.time;
            });
    }

    setInterval(fetchServerTime, 1000); // toutes les secondes
    fetchServerTime();
</script>

      <div style="display:flex; gap:15px; align-items:center;">
        <svg id="themeToggle" class="toggle-icon" viewBox="0 0 24 24">
          <path d="M21.64 13.65A9 9 0 1110.35 2.36a7 7 0 0011.29 11.29z"/>
        </svg>
        <div class="avatar">KJ</div>
      </div>
    </div>

    <div class="container py-4">
        <!-- Titre -->
        <h2 class="fw-bold mb-3">All Properties</h2>

        <!-- Filtres -->
        <div class="d-flex gap-2 flex-wrap mb-4">
            <button id="filtre1" class="btn fw-bold text-white">Sort Price ↓</button>
            <input type="text" class="form-control" placeholder="Search by title" style="min-width: 200px;">
            <select class="form-select" style="min-width: 100px;">
                <option>All</option>
            </select>
            <button id="filtre2" class="btn  fw-bold text-white"><i class="fa fa-plus"></i> Add Property</button>
        </div>

        <!-- Grille des propriétés -->
        <div class="row g-4">
            <!-- Card -->
            <div class="col-md-4 col-lg-3">
                <div class="property-card">
                    <img src="https://picsum.photos/400/250?random=1" alt="">
                    <div class="p-3">
                        <h5 class="fw-bold mb-1">Lavender Apartment</h5>
                        <p class="text-muted small mb-2"><i class="fa fa-map-marker-alt"></i> Brooklyn, US</p>
                        <span class="price-badge">$999</span>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-lg-3">
                <div class="property-card">
                    <img src="https://picsum.photos/400/250?random=2" alt="">
                    <div class="p-3">
                        <h5 class="fw-bold mb-1">KJ Hotel & Spa</h5>
                        <p class="text-muted small mb-2"><i class="fa fa-map-marker-alt"></i> North Carolina, USA</p>
                        <span class="price-badge">$1349</span>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-lg-3">
                <div class="property-card">
                    <img src="https://picsum.photos/400/250?random=3" alt="">
                    <div class="p-3">
                        <h5 class="fw-bold mb-1">Star Sun Hotel & Apartment</h5>
                        <p class="text-muted small mb-2"><i class="fa fa-map-marker-alt"></i> Los Angeles, USA</p>
                        <span class="price-badge">$399</span>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-lg-3">
                <div class="property-card">
                    <img src="https://picsum.photos/400/250?random=4" alt="">
                    <div class="p-3">
                        <h5 class="fw-bold mb-1">BlueSky Resort</h5>
                        <p class="text-muted small mb-2"><i class="fa fa-map-marker-alt"></i> Miami, USA</p>
                        <span class="price-badge">$789</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
