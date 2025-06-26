<?php
include '../includes/db_connexion.php';
$page_css = '../assets/css/offres_styles.css';
include '../includes/header.php';
$isAdmin = isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === true;

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

<h1 id="titreoffres">Nos Offres pour les JO 2024</h1>
<?php if (isset($_GET['ajoute']) && $_GET['ajoute'] == 1): ?>
    <div class='alert alert-success'>L'offre a été ajoutée au panier avec succès !</div>
<?php endif; ?>

<?php if ($isAdmin): ?>
  <div class="text-end me-4 mb-3">
      <a href="ajouter_offre.php" class="btn btn-success">➕ Ajouter une offre</a>
  </div>
<?php endif; ?>

<div class="offres-container">
  <?php foreach ($offres as $offre) : ?>
    <div class="card-offre">
      <?php
  $nomFichier = strtolower($offre['nom_offre']) . '.png';
  $cheminImage = "../assets/images/" . $nomFichier;
  if (!file_exists($cheminImage)) {
      $cheminImage = "../assets/images/solo.png";
  }
?>
<img src="<?= $cheminImage ?>" alt="<?= htmlspecialchars($offre['nom_offre']) ?>">
      <h3><?= htmlspecialchars($offre['nom_offre']) ?></h3>
      <p><?= htmlspecialchars($offre['description_offre']) ?></p>
      <div class="offre-footer">
        <span class="prix"><?= number_format($offre['prix_offre'], 2) ?> €</span>
        <form action="reserver.php" method="GET">
          <input type="hidden" name="id_offre" value="<?= $offre['id_offre'] ?>">
          <button type="submit" class="btn btn-primary">Réserver</button>
        </form>
      </div>

      <?php if ($isAdmin): ?>
        <div class="mt-2 d-flex justify-content-between">
          <a href="modifier_offre.php?id=<?= $offre['id_offre'] ?>" class="btn btn-warning btn-sm">✏️ Modifier</a>
          <a href="supprimer_offre.php?id=<?= $offre['id_offre'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette offre ?');">🗑️ Supprimer</a>
        </div>
      <?php endif; ?>
    </div>
  <?php endforeach; ?>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
  const cards = document.querySelectorAll(".card");
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) entry.target.classList.add("appear");
    });
  }, { threshold: 0.2 });

  cards.forEach(card => observer.observe(card));
});
</script>


