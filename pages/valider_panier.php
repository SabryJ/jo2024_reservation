<?php 
session_start();
// Inclure la connexion à la base de données
include '../includes/db_connexion.php';

// Inclure le header
include '../includes/header.php';

// ✅ Étape 1 : Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
if (!isset($_SESSION['username'])) {
    $_SESSION['redirect_after_login'] = 'paiement.php'; // 👈 On stocke l’intention
    header("Location: connexion.php");
    exit();
}

// Si l'utilisateur est connecté, on affiche le formulaire de validation/paiement
echo "<h2>Bienvenue, " . $_SESSION['username'] . "</h2>";
echo "<p>Vous êtes connecté. Vous pouvez maintenant procéder au paiement.</p>";
echo "<a href='paiement.php' class='btn btn-success'>Procéder au paiement</a>";

include '../includes/footer.php';
?>
