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
      <div class="form-container">
    <h2>Create Property</h2>

    <label for="name">Enter the property name</label>
    <input type="text" id="name" placeholder="e.g. Antilia Building">

    <label for="description">Enter the property description</label>
    <textarea id="description" placeholder="Write a description of the property"></textarea>

    <div class="form-row">
      <div>
        <label for="type">Select the property type</label>
        <select id="type">
          <option>Apartment</option>
          <option>House</option>
          <option>Villa</option>
          <option>Office</option>
        </select>
      </div>
      <div>
        <label for="price">Enter the property price</label>
        <input type="number" id="price" placeholder="$">
      </div>
    </div>

    <label for="location">Enter the location</label>
    <input type="text" id="location" placeholder="e.g. 123 ABC Street">

    <label for="image">Upload property image</label>
    <input type="file" id="image" hidden>
    <span class="upload" onclick="document.getElementById('image').click()">Upload *</span>

    <button type="submit">Soumettre</button>
  </div>
</main>
