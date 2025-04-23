<?php
include('db_connection.php');  // Inclure la connexion à la base de données

// Récupérer l'id du sport sélectionné depuis l'URL
$id_sport = $_GET['id_sport'];

// Requête pour récupérer les informations du sport
$query = "SELECT * FROM sport WHERE id_sport = :id_sport";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':id_sport', $id_sport);
$stmt->execute();
$sport = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réservation de billets - <?php echo $sport['nom_sport']; ?></title>
</head>
<body>
    <h1>Réservez votre billet pour <?php echo $sport['nom_sport']; ?></h1>

    <form action="reserver_billet.php" method="post">
        <input type="hidden" name="id_sport" value="<?php echo $sport['id_sport']; ?>">

        <label for="offre">Choisir une offre :</label>
        <select name="id_offre" id="offre">
            <option value="1">Solo (1 personne)</option>
            <option value="2">Duo (2 personnes)</option>
            <option value="3">Familiale (4 personnes)</option>
        </select>

        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" required />

        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required />

        <input type="submit" value="Réserver" />
    </form>
</body>
</html>
