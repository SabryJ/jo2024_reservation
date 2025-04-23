<?php
session_start();

// Inclure la connexion à la base de données
include '../includes/db_connexion.php';
include '../includes/header.php';

// Vérifier si le panier est vide
if (!isset($_SESSION['panier']) || empty($_SESSION['panier'])) {
    echo "<h3>Votre panier est vide.</h3>";
    echo "<p>Veuillez ajouter des billets à votre panier avant de procéder au paiement.</p>";
    echo "<a href='index.php' class='btn btn-primary'>Retourner à la page d'offres</a>";
    include '../includes/footer.php';
    exit();
}

// Si le panier est rempli, on affiche le formulaire de paiement
echo "<h2>Procédez au paiement</h2>";
$totalPanier = 0;

// Afficher les éléments du panier
foreach ($_SESSION['panier'] as $key => $item) {
    if (!isset($item['total'])) {
        $item['total'] = $item['prix'] * $item['nombre'];
        $_SESSION['panier'][$key]['total'] = $item['total'];
    }

    echo "<div class='offre-panier' data-id='$key'>";
    echo "<strong>Offre:</strong> " . htmlspecialchars($item['offre']) . "<br>";
    echo "<strong>Sport:</strong> " . htmlspecialchars($item['sport']) . "<br>";
    echo "<strong>Nombre de billets:</strong> " . htmlspecialchars($item['nombre']) . "<br>";
    echo "<strong>Total:</strong> " . number_format($item['total'], 2) . " €<br>";
    echo "</div><hr>";

    $totalPanier += $item['total'];
}

// Afficher le total du panier
echo "<h3>Total: " . number_format($totalPanier, 2) . " €</h3>";

// Formulaire de validation finale du paiement
echo "<form action='traitement_paiement.php' method='POST'>";
echo "<input type='hidden' name='montant' value='" . $totalPanier . "'>";
echo "<button type='submit' class='btn btn-success'>Confirmer et Payer</button>";
echo "</form>";

//include '../includes/footer.php';
?>
