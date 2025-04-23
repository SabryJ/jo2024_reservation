<?php
include('db_connection.php');  // Inclure la connexion à la base de données

// Requête pour récupérer tous les sports
$query = "SELECT * FROM sport";
$stmt = $pdo->prepare($query);
$stmt->execute();

// Récupérer tous les résultats
$sports = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réservation de billets - JO 2024</title>
</head>
<body>
    <h1>Réservez vos billets pour les JO 2024</h1>
    <h2>Sélectionnez un sport :</h2>
    <ul>
        <?php foreach ($sports as $sport): ?>
            <li>
                <h3><?php echo $sport['nom_sport']; ?></h3>
                <img src="<?php echo $sport['image_url']; ?>" alt="<?php echo $sport['nom_sport']; ?>" width="200">
                <a href="form_reservation.php?id_sport=<?php echo $sport['id_sport']; ?>">Réserver pour ce sport</a>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
