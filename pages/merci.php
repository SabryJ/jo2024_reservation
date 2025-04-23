<?php
ob_start();
session_start();

// Assurez-vous que la connexion à la base de données est incluse avant tout
include '../includes/db_connexion.php'; // Si ce n'est pas déjà inclus plus haut
include '../includes/header.php'; // Inclusion de l'en-tête

// Vérification de la session et récupération des billets
if (isset($_SESSION['id_billets']) && !empty($_SESSION['id_billets'])) {
    $totalPanier = 0;
    $billetDetails = [];

    foreach ($_SESSION['id_billets'] as $id_billet) {
        $stmt = $pdo->prepare("SELECT 
                                   offre.nom_offre, 
                                   offre.prix_offre, 
                                   sport.nom_sport, 
                                   billet.date, 
                                   billet.reference 
                               FROM billet 
                               JOIN offre ON billet.id_offre = offre.id_offre
                               JOIN sport ON billet.id_sport = sport.id_sport
                               WHERE billet.id_billet = ?");
        $stmt->execute([$id_billet]);
        $billet = $stmt->fetch();

        if ($billet) {
            $billetDetails[] = $billet;
            $totalPanier += $billet['prix_offre']; // Additionner les prix
        }
    }

    // Vérification si des billets ont été récupérés
    if (!empty($billetDetails)) {
        echo "<div class='container mt-5'>";
        echo "<div class='card'>";
        echo "<div class='card-header'><h4>Merci pour votre réservation !</h4></div>";
        echo "<div class='card-body'>";

        foreach ($billetDetails as $billet) {
            echo "<div class='mb-4'>";
            echo "<strong>Offre:</strong> " . htmlspecialchars($billet['nom_offre']) . "<br>";
            echo "<strong>Sport:</strong> " . htmlspecialchars($billet['nom_sport']) . "<br>";
            echo "<strong>Date:</strong> " . htmlspecialchars($billet['date']) . "<br>";
            echo "<strong>Référence:</strong> " . htmlspecialchars($billet['reference']) . "<br>";
            echo "<strong>Prix:</strong> " . number_format($billet['prix_offre'], 2) . " €<br>";
            echo "</div>";
        }

        echo "<h4>Total à payer: " . number_format($totalPanier, 2) . " €</h4>";

        // Générer le QR code
        $qrData = json_encode($billetDetails); // Encoder les informations des billets pour générer un QR code
        $qrCodeUrl = "https://api.qrserver.com/v1/create-qr-code/?data=" . urlencode($qrData) . "&size=150x150";

        echo "<div class='text-center mt-4'>";
        echo "<h5>Votre code QR :</h5>";
        echo "<img src='" . $qrCodeUrl . "' alt='Code QR' class='img-fluid'>";
        echo "</div>";

        echo "</div>"; // Fermeture de card-body
        echo "</div>"; // Fermeture de la card
        echo "</div>"; // Fermeture de la container
    } else {
        echo "<p>Aucune information de commande trouvée.</p>";
    }
} else {
    echo "<p>Erreur : aucun billet dans la session.</p>";
}

include '../includes/footer.php'; // Inclusion du pied de page
ob_end_flush();
?>
