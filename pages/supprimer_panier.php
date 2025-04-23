<?php
session_start();

// Inclure la connexion à la base de données
include '../includes/db_connexion.php';

// Inclure le header
include '../includes/header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $key = $_POST['key']; // Récupérer la clé de l'article à supprimer

    // Supprimer l'élément du panier
    if (isset($_SESSION['panier'][$key])) {
        unset($_SESSION['panier'][$key]);
    }

    header('Location: panier.php'); // Rediriger vers la page du panier
    exit();
}

// Vérifie si un indice est passé dans l'URL (via ?key=...)
if (isset($_GET['key'])) {
    $key = $_GET['key'];

    // Vérifie si la session 'panier' existe et si l'indice est valide
    if (isset($_SESSION['panier'][$key])) {
        // Supprimer l'article du panier
        unset($_SESSION['panier'][$key]);
    }
}

// Rediriger l'utilisateur vers la page panier après suppression
header('Location: offres.php');
exit();

?>