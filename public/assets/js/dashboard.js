// Activer/désactiver mode sombre
  const themeToggle = document.getElementById('themeToggle');

  function setTheme(dark) {
    document.body.classList.toggle('dark', dark);
    themeToggle.innerHTML = dark
      ? `<path d="M21.64 13.65A9 9 0 1110.35 2.36a7 7 0 0011.29 11.29z"/>`
      : `<path d="M12 3.1A1 1 0 0113 4v1a1 1 0 11-2 0V4a1 1 0 011-1zm5.66 2.34a1 1 0 010 1.41l-.71.7a1 1 0 11-1.42-1.41l.71-.7a1 1 0 011.42 0zM21 11a1 1 0 110 2h-1a1 1 0 110-2h1zM17.66 17.66a1 1 0 010-1.42l.71-.7a1 1 0 011.42 1.41l-.71.71a1 1 0 01-1.42 0zM12 18.9a1 1 0 011-1h0a1 1 0 010 2h0a1 1 0 01-1-1zM6.34 17.66a1 1 0 010-1.42l.71-.7a1 1 0 011.42 1.41l-.71.71a1 1 0 01-1.42 0zM4 11a1 1 0 110 2H3a1 1 0 110-2h1zM6.34 6.34a1 1 0 010 1.41l-.71.7A1 1 0 114.21 7l.71-.7a1 1 0 011.42 0zM12 7a5 5 0 100 10 5 5 0 000-10z"/>`;
    localStorage.setItem('darkMode', dark);
    const gridColor = dark ? '#444' : '#eee';
    revenueChart.options.scales.x.grid.color = gridColor;
    revenueChart.options.scales.y.grid.color = gridColor;
    revenueChart.update();
  }

  themeToggle.addEventListener('click', () => {
    const newMode = !document.body.classList.contains('dark');
    setTheme(newMode);
  });

  setTheme(localStorage.getItem('darkMode') !== 'false');




  // Gestion du clic sur menu
  document.querySelectorAll('.nav-item').forEach(item => {
    item.addEventListener('click', () => {
      document.querySelectorAll('.nav-item').forEach(i => i.classList.remove('active'));
      item.classList.add('active');
    });
  });
