<?php
session_start();
include '../includes/db_connexion.php';
include '../includes/header.php';

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header('Location: connexion.php');
    exit;
}

// Récupère les informations du panier depuis la session
$offre = $_SESSION['panier']['offre'] ?? 'Non défini';
$sport = $_SESSION['panier']['sport'] ?? 'Non défini';
$nbBillets = $_SESSION['panier']['quantite'] ?? 1;
$total = $_SESSION['panier']['total'] ?? 0.00;

// Affiche les informations du panier depuis la session
echo "<h2>Confirmation de votre panier</h2>";
echo "<pre>";
var_dump($_SESSION['panier']); // Vérifie les données du panier
echo "</pre>";

$offre = $_SESSION['panier']['offre'] ?? 'Non défini';
$sport = $_SESSION['panier']['sport'] ?? 'Non défini';
$nbBillets = $_SESSION['panier']['quantite'] ?? 1;
$total = $_SESSION['panier']['total'] ?? 0.00;

echo "<p><strong>Offre :</strong> $offre</p>";
echo "<p><strong>Sport :</strong> $sport</p>";
echo "<p><strong>Nombre de billets :</strong> $nbBillets</p>";
echo "<p><strong>Total :</strong> $total €</p>";

// Bouton pour valider le panier et aller vers paiement
echo "<a href='paiement.php' class='btn btn-success'>Payer maintenant</a>";

// Si le paiement a été confirmé (via une variable GET ou POST)
if (isset($_POST['payment_confirmed']) && $_POST['payment_confirmed'] == true) {
    // On suppose que les billets sont stockés dans la session avant la validation
    if (isset($_SESSION['panier']) && !empty($_SESSION['panier'])) {
        // Récupérer l'ID de l'utilisateur
        $id_utilisateur = $_SESSION['user_id'];

        try {
            // Commencer une transaction
            $pdo->beginTransaction();

            // Insertion des billets dans la base de données
            for ($i = 0; $i < $nbBillets; $i++) {
                $sql = "INSERT INTO billet (id_utilisateur, id_offre, id_sport, date) 
                        VALUES (?, ?, ?, NOW())";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                    $id_utilisateur,
                    $_SESSION['panier']['offre_id'],  // ID de l'offre
                    $_SESSION['panier']['sport_id'],  // ID du sport
                ]);
            }

            // Commit la transaction si tout est correct
            $pdo->commit();

            // Réinitialiser le panier après l'achat
            unset($_SESSION['panier']);

            // Rediriger l'utilisateur vers une page de confirmation
            header('Location: confirmation_achat.php');
            exit();
        } catch (Exception $e) {
            // Si une erreur se produit, annuler la transaction
            $pdo->rollBack();
            echo "Erreur lors de l'enregistrement des billets : " . $e->getMessage();
        }
    } else {
        echo "Aucun billet à enregistrer.";
    }
}

include '../includes/footer.php';
?>
