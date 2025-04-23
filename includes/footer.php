<!-- footer.php -->
<footer class="text-center py-4">
  <p>&copy; 2024 Jeux Olympiques - Tous droits réservés</p>
</footer>

<!-- Inclure les fichiers JavaScript de Bootstrap sans les attributs d'intégrité -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>

<script>
  function updateCountdown(id, targetDate) {
    const el = document.getElementById(id);

    function refresh() {
      const now = new Date().getTime();
      const distance = targetDate - now;

      if (distance <= 0) {
        el.innerHTML = "🎉 Les Jeux Olympiques commencent aujourd'hui !";
        return;
      }

      const mois = Math.floor(distance / (1000 * 60 * 60 * 24 * 30));
      const jours = Math.floor((distance % (1000 * 60 * 60 * 24 * 30)) / (1000 * 60 * 60 * 24));
      const heures = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));

      el.innerHTML = `${mois} mois ${jours} jours ${heures} heures`;
    }

    refresh();
    setInterval(refresh, 60000); // Mise à jour toutes les minutes
  }

  const joDate = new Date("2025-07-26T00:00:00").getTime(); // Date des JO

  updateCountdown("countdown1", joDate);
  updateCountdown("countdown2", joDate);
  updateCountdown("countdown3", joDate);
</script>