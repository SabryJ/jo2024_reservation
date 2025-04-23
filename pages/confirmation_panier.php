<?php
ob_start();
include 'verif_connexion.php'; // au lieu de session_start() + vérif manuelle

include '../includes/db_connexion.php';
include '../includes/header.php';

// ✅ Vérifier si le panier est vide
if (!isset($_SESSION['panier']) || empty($_SESSION['panier'])) {
    echo "Votre panier est vide.";
    include '../includes/footer.php';
    exit();
}

echo "<h2>Confirmation de votre Panier</h2>";

$totalPanier = 0;

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

echo "<h3>Total: " . number_format($totalPanier, 2) . " €</h3>";

// ✅ Bouton de paiement
echo "<form action='paiement.php' method='POST'>";
echo "<button type='submit' class='btn btn-success'>Procéder au paiement</button>";
echo "</form>";

include '../includes/footer.php';
ob_end_flush(); // Vide le tampon et envoie les headers
?>
