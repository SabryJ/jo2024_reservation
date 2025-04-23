<?php
session_start();

// Vérifier que les champs nécessaires sont envoyés
if (isset($_POST['offre'], $_POST['sport'], $_POST['nombre'])) {
    $offre = $_POST['offre'];
    $sport = $_POST['sport'];
    $nombre = intval($_POST['nombre']);

    // Connexion à la BDD pour récupérer le prix
    include '../includes/db_connexion.php';

    // Récupérer le prix de l'offre sélectionnée
    $stmt = $pdo->prepare("SELECT prix_offre FROM offre WHERE nom_offre = ?");
    $stmt->execute([$offre]);
    $offreDetails = $stmt->fetch(PDO::FETCH_ASSOC);

    // Si l'offre n'existe pas
    if (!$offreDetails) {
        header("Location: ../pages/offres.php?ajoute=0");
        exit;
    }

    $prixOffre = $offreDetails['prix_offre']; // Récupérer le prix de l'offre

    // Initialiser le panier si pas encore créé
    if (!isset($_SESSION['panier'])) {
        $_SESSION['panier'] = [];
    }

    // Vérifie si cette combinaison existe déjà dans le panier
    $deja_existe = false;

    foreach ($_SESSION['panier'] as &$item) {
        if ($item['offre'] === $offre && $item['sport'] === $sport) {
            // Si même offre + même sport : on additionne les quantités
            $item['nombre'] += $nombre;
            $deja_existe = true;
            break;
        }
    }

    // Sinon, on ajoute une nouvelle ligne au panier
    if (!$deja_existe) {
        $_SESSION['panier'][] = [
            'offre' => $offre,
            'sport' => $sport,
            'nombre' => $nombre,
            'prix' => $prixOffre  // Ajouter le prix ici
        ];
    }

    // Rediriger avec un message de succès
    header("Location: ../pages/offres.php?ajoute=1");
    exit;
} else {
    // Si des champs sont manquants, rediriger avec un message d'erreur
    header("Location: ../pages/offres.php?ajoute=0");
    exit;
}

?>
