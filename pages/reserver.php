<?php
// Connexion à la BDD
include '../includes/db_connexion.php';

// Inclure le header
include '../includes/header.php';

// Vérifie si l'id_offre est bien passé
if (!isset($_GET['id_offre'])) {
    echo "<p>Offre non trouvée.</p>";
    include '../includes/footer.php';
    exit;
}

$id_offre = $_GET['id_offre'];

// Récupérer les infos de l'offre
$stmt = $pdo->prepare("SELECT * FROM offre WHERE id_offre = ?");
$stmt->execute([$id_offre]);
$offre = $stmt->fetch(PDO::FETCH_ASSOC);

// Si offre introuvable
if (!$offre) {
    echo "<p>Offre introuvable.</p>";
    include '../includes/footer.php';
    exit;
}

// Récupérer les sports pour la liste déroulante
$sports_stmt = $pdo->query("SELECT * FROM sport");
$sports = $sports_stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="reserver-container">
    <h1>Réserver l'offre : <?= htmlspecialchars($offre['nom_offre']) ?></h1>
    <p><?= htmlspecialchars($offre['description_offre']) ?></p>
    <p><strong>Prix : </strong><?= number_format($offre['prix_offre'], 2) ?> €</p>

    <form action="ajouter_panier.php" method="POST">
        <input type="hidden" name="offre" value="<?= htmlspecialchars($offre['nom_offre']) ?>">

        <label for="sport">Choisissez un sport :</label>
        <select name="sport" id="sport" required>
            <?php foreach ($sports as $sport) : ?>
                <option value="<?= htmlspecialchars($sport['nom_sport']) ?>">
                    <?= htmlspecialchars($sport['nom_sport']) ?> (<?= htmlspecialchars($sport['lieu']) ?>)
                </option>
            <?php endforeach; ?>
        </select>

        <label for="nombre">Nombre de billets :</label>
        <input type="number" name="nombre" id="nombre" value="1" min="1" required>

        <button type="submit" class="btn btn-primary">Ajouter au panier</button>
    </form>
</div>

<?php include '../includes/footer.php'; ?>
