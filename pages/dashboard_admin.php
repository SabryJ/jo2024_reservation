<?php
session_start();
include '../includes/db_connexion.php';

// Vérifier si admin est connecté, sinon redirection vers la page de connexion admin
if (!isset($_SESSION['admin'])) {
    header("Location: admin_connexion.php");
    exit();
}

// Récupérer les infos de l'admin connecté depuis la base pour affichage (optionnel)
$idAdmin = $_SESSION['admin'];
$stmt = $pdo->prepare("SELECT login FROM admin WHERE id_admin = ?");
$stmt->execute([$idAdmin]);
$admin = $stmt->fetch();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Tableau de bord Admin - JO 2024</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom shadow-sm">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Dashboard Admin</a>
    <form method="post" class="d-flex" action="logout.php">
        <button type="submit" class="btn btn-outline-danger">Déconnexion</button>
    </form>
  </div>
</nav>

<div class="container mt-5">
    <h1>Bienvenue, <?= htmlspecialchars($admin['login']) ?> !</h1>
    <p>Vous êtes connecté à l'espace administration des Jeux Olympiques 2024.</p>

    <!-- Ici tu pourras ajouter tes fonctionnalités admin : gestion des offres, utilisateurs, billets, etc. -->

</div>

</body>
</html>
