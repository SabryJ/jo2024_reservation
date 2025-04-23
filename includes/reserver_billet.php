<?php
include('db_connection.php');  // Inclure la connexion à la base de données

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $id_sport = $_POST['id_sport'];
    $id_offre = $_POST['id_offre'];
    $nom = $_POST['nom'];
    $email = $_POST['email'];

    // Générer une clé d'authentification et une clé de paiement (aléatoires)
    $cle_authentification = rand(1000, 9999);  // Exemple de génération de clef aléatoire
    $cle_paiement = rand(1000, 9999);           // Exemple de génération de clef aléatoire

    // Concaténer les clés pour créer le billet authentique
    $cle_definitive = $cle_authentification . $cle_paiement;

    // Insérer la réservation dans la table `billet`
    $query = "INSERT INTO billet (id_sport, id_offre, lieu, date, reference, id_utilisateur, statut, id_poste) 
              VALUES (:id_sport, :id_offre, 'Stade de France', CURDATE(), :reference, 1, 'réservé', 1)";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id_sport', $id_sport);
    $stmt->bindParam(':id_offre', $id_offre);
    $stmt->bindParam(':reference', $cle_definitive);  // Utilisation de la clé combinée comme référence
    
    $stmt->execute();

    echo "Réservation effectuée avec succès !";
}
?>
