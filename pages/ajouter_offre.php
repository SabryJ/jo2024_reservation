<?php
session_start();
include '../includes/db_connexion.php';

if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    header("Location: ../pages/accueil.php");
    exit();
}

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nom = $_POST['nom_offre'] ?? '';
    $description = $_POST['description_offre'] ?? '';
    $prix = $_POST['prix_offre'] ?? '';

    if (!empty($nom) && !empty($description) && is_numeric($prix)) {
        $stmt = $pdo->prepare("INSERT INTO offre (nom_offre, description_offre, prix_offre) VALUES (?, ?, ?)");
        $stmt->execute([$nom, $description, $prix]);
        $success = "✅ Offre ajoutée avec succès.";
    } else {
        $error = "❌ Tous les champs sont obligatoires et le prix doit être un nombre.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter une offre - Admin</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" 
          integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/admin_style.css">
</head>
<body class="p-4">
    <h2>➕ Ajouter une nouvelle offre</h2>

    <?php if ($error): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>
    <?php if ($success): ?>
        <div class="alert alert-success"><?= $success ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="mb-3">
            <label>Nom de l'offre</label>
            <input type="text" name="nom_offre" class="form-control" value="<?= htmlspecialchars($_POST['nom_offre'] ?? '') ?>" required>
        </div>
        <div class="mb-3">
            <label>Description</label>
            <textarea name="description_offre" class="form-control" required><?= htmlspecialchars($_POST['description_offre'] ?? '') ?></textarea>
        </div>
        <div class="mb-3">
            <label>Prix (€)</label>
            <input type="number" step="0.01" name="prix_offre" class="form-control" value="<?= htmlspecialchars($_POST['prix_offre'] ?? '') ?>" required>
        </div>
        <button type="submit" class="btn btn-success">Ajouter</button>
        <a href="offres.php" class="btn btn-secondary ms-2">Retour</a>
    </form>
</body>
</html>
