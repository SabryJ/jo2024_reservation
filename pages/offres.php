<?php
// Inclure la connexion à la base de données
include '../includes/db_connexion.php';

// Définir le CSS spécifique pour cette page
$page_css = '../assets/css/offres_styles.css';

// Inclure le header
include '../includes/header.php';

// Récupérer les offres depuis la base
$sql = "SELECT * FROM offre";
$stmt = $pdo->query($sql);
$offres = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- Banner -->
<div class="banner">
  <img src="../assets/images/arc2.jpg" alt="Bannière JO 2024" class="banner-bg">

  <div class="banner-content">
    <img src="../assets/images/logojo2024.png" alt="Logo JO 2024" class="logo-banner">
    <h1 class="banner-title">Billetterie Officielle des Jeux de Paris 2024</h1>
    <p class="banner-description">
      Vous pouvez composer dès maintenant votre (vos) pack(s) sur mesure<br>
      et personnaliser votre expérience olympique
    </p>
    <a href="#titreoffres" class="banner-button">J’achète mon pack</a>
  </div>
</div>
<!-- Fin Banner-->

<h1 id="titreoffres">Nos Offres pour les JO 2024</h1>
<?php
if (isset($_GET['ajoute']) && $_GET['ajoute'] == 1) {
    echo "<div class='alert alert-success'>L'offre a été ajoutée au panier avec succès !</div>";
}
?>
<!-- Cardes -->
<div class="offres-container">
    <?php foreach ($offres as $offre) : ?>
        <div class="card-offre">
            <img src="../assets/images/<?= strtolower($offre['nom_offre']) ?>.png" alt="<?= $offre['nom_offre'] ?>">
            <h3><?= htmlspecialchars($offre['nom_offre']) ?></h3>
            <p><?= htmlspecialchars($offre['description_offre']) ?></p>
            <div class="offre-footer">
                <span class="prix"><?= number_format($offre['prix_offre'], 2) ?> €</span>
                <form action="reserver.php" method="GET">
    <input type="hidden" name="id_offre" value="<?= $offre['id_offre'] ?>">
    <button type="submit" class="btn btn-primary">Réserver</button>
</form>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<!-- Fin Cardes -->
<script>
  document.addEventListener("DOMContentLoaded", function () {
    const cards = document.querySelectorAll(".card");
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add("appear");
        }
      });
    }, {
      threshold: 0.2
    });

    cards.forEach(card => observer.observe(card));
  });

  document.addEventListener("DOMContentLoaded", function () {
    const cards = document.querySelectorAll(".card");
    const banner = document.querySelector(".banner");

    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add("appear");
        }
      });
    }, {
      threshold: 0.2
    });

    cards.forEach(card => observer.observe(card));
    if (banner) observer.observe(banner);
  });

</script>

<?php include '../includes/footer.php'; ?>