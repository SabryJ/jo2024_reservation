<?php
session_start();
include '../includes/db_connexion.php'; // assurez-vous que cette ligne est incluse

if (!isset($_SESSION['id_utilisateur'])) {
    $_SESSION['redirect_after_login'] = 'paiement.php';
    header('Location: connexion.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_SESSION['panier'])) {
        $id_utilisateur = $_SESSION['id_utilisateur'];

        // 1. Générer une clé de paiement aléatoire
        $cle_valeur = mt_rand(1000, 9999);

        // 2. Récupérer la clé d'authentification (changer clef_authentification en cle_authentification)
        $stmt = $pdo->prepare("SELECT cle_authentification FROM utilisateur WHERE id_utilisateur = ?");
        $stmt->execute([$id_utilisateur]);
        $clef_authentification = $stmt->fetchColumn();

        if (!$clef_authentification) {
            $_SESSION['erreur_paiement'] = "Erreur : clé d'authentification manquante.";
            header("Location: paiement.php");
            exit();
        }

        // 3. Calcul du total
        $total = 0;
        foreach ($_SESSION['panier'] as $item) {
            $total += $item['total'];
        }

        // 4. Insérer le paiement dans la table 'paiement'
        $stmt = $pdo->prepare("INSERT INTO paiement (id_utilisateur, timestamp_paiement, montant_total) 
                                VALUES (?, NOW(), ?)");
        $stmt->execute([$id_utilisateur, $total]);
        $id_paiement = $pdo->lastInsertId();  // Récupération de l'ID du paiement inséré

        // 5. Combinaison des deux clés
        $clef_finale = $clef_authentification . "-" . $cle_valeur;

        // 6. Enregistrement dans la table cle_paiement
        $stmt = $pdo->prepare("INSERT INTO cle_paiement (id_utilisateur, id_paiement, cle_valeur, cle_finale) 
                                VALUES (?, ?, ?, ?)");
        $stmt->execute([$id_utilisateur, $id_paiement, $cle_valeur, $clef_finale]);

        // 7. Liaison dans utilisateur_paiement
        $stmt = $pdo->prepare("INSERT INTO utilisateur_paiement (id_utilisateur, id_paiement) 
                                VALUES (?, ?)");
        $stmt->execute([$id_utilisateur, $id_paiement]);

        // 8. Génération des billets
        $liste_billets = []; // <-- On va stocker les ID des billets générés ici

        foreach ($_SESSION['panier'] as $item) {
            $offre_nom = $item['offre'];
            $sport_nom = $item['sport'];
            $nombre = $item['nombre'];

            $stmt = $pdo->prepare("SELECT id_sport FROM sport WHERE nom_sport = ?");
            $stmt->execute([$sport_nom]);
            $id_sport = $stmt->fetchColumn();

            $stmt = $pdo->prepare("SELECT id_offre FROM offre WHERE nom_offre = ?");
            $stmt->execute([$offre_nom]);
            $id_offre = $stmt->fetchColumn();

            if (!$id_sport || !$id_offre) continue;

            for ($i = 0; $i < $nombre; $i++) {
                // Chaque billet a comme référence la clef combinée
                $stmt = $pdo->prepare("INSERT INTO billet (date, reference, statut, id_sport, id_offre, id_utilisateur, id_utilisateur_paiement) 
                                        VALUES (CURDATE(), ?, 'payé', ?, ?, ?, ?)");

                $stmt->execute([$clef_finale, $id_sport, $id_offre, $id_utilisateur, $id_paiement]);

                // Récupérer l'ID du billet généré
                $id_billet = $pdo->lastInsertId();
                $liste_billets[] = $id_billet; // Ajouter l'ID à la liste
            }
        }

        // Sauvegarder les billets générés dans la session
        $_SESSION['id_billets'] = $liste_billets;

        // 9. Vider le panier après la génération des billets
        unset($_SESSION['panier']);

        // 10. Redirection finale
        header("Location: merci.php");
        exit();
    } else {
        $_SESSION['erreur_paiement'] = "Votre panier est vide.";
        header("Location: paiement.php");
        exit();
    }
} else {
    $_SESSION['erreur_paiement'] = "Méthode de requête invalide.";
    header("Location: paiement.php");
    exit();
}
?>
