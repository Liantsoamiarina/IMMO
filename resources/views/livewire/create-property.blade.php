<main>
  <div class="topbar d-flex justify-content-between align-items-center">
    <div class="page-title">Bonjour, Liantsoa</div>
    <div id="currentDateTime" class="text-center badge bg-primary p-3"></div>
    <div style="display:flex; gap:15px; align-items:center;">
      <svg id="themeToggle" class="toggle-icon" viewBox="0 0 24 24" width="24" height="24">
        <path d="M21.64 13.65A9 9 0 1110.35 2.36a7 7 0 0011.29 11.29z"/>
      </svg>
      <div class="avatar">KJ</div>
    </div>
  </div>

  <div class="form-container mt-4">
    <h2>Create Property</h2>

    <form action="{{ route('properties.store') }}" method="post" enctype="multipart/form-data">
      @csrf

          <label for="name">Enter the property name</label>
    <input type="text" id="name" placeholder="e.g. Antilia Building">

    <label for="description">Enter the property description</label>
    <textarea id="description" placeholder="Write a description of the property"></textarea>


      <!-- Type + Price -->
      <div class="row mb-3">
        <div class="col">
          <label for="type">Property type</label>
          <select name="type" id="type" class="form-control" required>
            <option value="appartement">Appartement</option>
            <option value="maison">Maison</option>
            <option value="terrain">Terrain</option>
          </select>
        </div>
        <div class="col">
          <label for="price">Price (Ar)</label>
          <input type="number" name="price" id="price" class="form-control" placeholder="ex: 200000000" required>
        </div>
      </div>

      <!-- Transaction -->
      <label>Transaction</label>
      <select name="transaction_type" class="form-control mb-3" required>
        <option value="vente">À Vendre</option>
        <option value="location">À Louer</option>
      </select>

      <!-- Surface -->
      <label for="surface">Surface (m²)</label>
      <input type="number" name="surface" id="surface" class="form-control mb-3">

      <!-- Champs supplémentaires -->
      <div id="extraFields">
        <div class="row mb-3">
          <div class="col">
            <label for="rooms">Nombre de pièces</label>
            <input type="number" name="rooms" id="rooms" class="form-control">
          </div>
          <div class="col">
            <label for="floors">Nombre d’étages</label>
            <input type="number" name="floors" id="floors" class="form-control">
          </div>
        </div>

        <div class="form-check mb-3">
          <input type="checkbox" name="parking" id="parking" class="form-check-input">
          <label for="parking" class="form-check-label">Parking disponible</label>
        </div>
      </div>

      <!-- Adresse -->
      <label for="address">Adresse complète</label>
      <input type="text" name="address" id="address" class="form-control mb-3">

      <label for="city">Ville</label>
      <input type="text" name="city" id="city" class="form-control mb-3">

      <label for="country">Pays</label>
      <input type="text" name="country" id="country" class="form-control mb-3">

      <!-- Image -->
      <label for="image">Upload property image</label>
      <input type="file" name="image" id="image" class="form-control mb-3">

      <!-- Submit -->
      <button type="submit">Soumettre</button>
    </form>
  </div>
</main>

<script>
document.addEventListener("DOMContentLoaded", function() {
  const typeSelect = document.getElementById("type");
  const extraFields = document.getElementById("extraFields");

  function toggleExtraFields() {
    if (typeSelect.value === "terrain") {
      extraFields.style.display = "none";
    } else {
      extraFields.style.display = "block";
    }
  }

  toggleExtraFields();
  typeSelect.addEventListener("change", toggleExtraFields);
});
</script>
