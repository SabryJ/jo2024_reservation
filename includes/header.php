<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Démarrer la session si elle n'est pas déjà active
}
if (isset($page_css)): ?>
    <link rel="stylesheet" href="<?php echo $page_css; ?>">
<?php endif; ?>
<?php if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: accueil.php"); // ou index.php si c'est ta page d'accueil
    exit();
} ?>
<?php 
$nombreArticles = isset($_SESSION['panier']) ? count($_SESSION['panier']) : 0;
?>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Jeux Olympiques 2024</title>

  <!-- Lien vers le fichier CSS -->
  <link rel="stylesheet" href="../assets/css/style.css">

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
</head>
<!-- Début Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top border-bottom shadow-sm">
  <div class="container-fluid">
    <!-- Logo -->
    <a class="navbar-brand" href="#">
      <img src="../assets/images/logojo2024.png" alt="Logo JO" width="40" height="40" class="d-inline-block align-text-top">
      JO 2024
    </a>

    <!-- Bouton burger -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Liens + boutons -->
    <div class="collapse navbar-collapse" id="navbarNav">
      <!-- Liens gauche -->
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'accueil.php' ? 'active' : '' ?>" href="accueil.php">Accueil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'offres.php' ? 'active' : '' ?>" href="offres.php">Offres</a>
        </li>
      </ul>

      <!-- Zone droite -->
      <div class="d-flex align-items-center gap-2">
        <?php if (isset($_SESSION['username'])): ?>
          <!-- Affichage du message de bienvenue et de l'icône utilisateur après la connexion -->
          <span class="me-2">👋 Bonjour, <strong><?= htmlspecialchars($_SESSION['username']) ?></strong></span>
          <span class="btn btn-outline-secondary" style="cursor: default;">
  <i class="bi bi-person"></i>
</span>
          <form method="POST" style="display:inline;">
  <button type="submit" name="logout" class="btn btn-outline-danger">Déconnexion</button>
</form>
        <?php else: ?>
          <!-- Boutons de connexion et d'inscription si l'utilisateur n'est pas connecté -->
          <a href="connexion.php" class="btn btn-outline-primary">Connexion</a>
          <a href="inscription.php" class="btn btn-primary">Créer un compte</a>
        <?php endif; ?>

        <!-- Icône panier -->
        <a href="panier.php" class="btn btn-light d-flex align-items-center">
          <i class="bi bi-cart fs-4"></i> <!-- Taille de l'icône ajustée -->
          <span class="badge bg-danger ms-2"><?php echo $nombreArticles > 0 ? $nombreArticles : ''; ?></span> <!-- Badge affiché à côté de l'icône -->
        </a>
      </div>
    </div>
  </div>
</nav>
<!-- Fin Navbar -->