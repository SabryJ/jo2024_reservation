<?php
session_start();

// Affichage d'un message si il y en a
if (isset($_SESSION['message'])) {
    echo "<div class='message'>" . htmlspecialchars($_SESSION['message']) . "</div>";
    unset($_SESSION['message']);
}

// Inclure la connexion à la base de données
include '../includes/db_connexion.php';

// Inclure le header
include '../includes/header.php';

// Vérifier si le panier est vide
if (!isset($_SESSION['panier']) || empty($_SESSION['panier'])) {
    echo "Votre panier est vide.";
} else {
    echo "<h2>Votre Panier</h2>";

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
        echo "<a href='supprimer_panier.php?key=$key' class='btn btn-danger'>Supprimer</a>";
        echo "</div><hr>";

        $totalPanier += $item['total'];
    }

    echo "<h3>Total: " . number_format($totalPanier, 2) . " €</h3>";

    // Validation du panier
    echo "<form action='' method='POST'>";
    echo "<button type='submit' name='valider_panier' class='btn btn-success'>Valider mon panier</button>";
    echo "</form>";
}

// Si l'utilisateur clique sur "Valider mon panier"
if (isset($_POST['valider_panier'])) {
    if (isset($_SESSION['username'])) {
        header("Location: confirmation_panier.php");
    } else {
        $_SESSION['redirect_after_login'] = "confirmation_panier.php";
        header("Location: connexion.php");
    }
    exit();
}
?>
