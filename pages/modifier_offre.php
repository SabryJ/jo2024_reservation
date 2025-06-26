<?php
session_start();
include '../includes/db_connexion.php';

if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    header("Location: ../pages/accueil.php");
    exit();
}

$id = $_GET['id'] ?? null;
$error = "";
$success = "";

if (!$id || !is_numeric($id)) {
    header("Location: offres.php");
    exit();
}

// 🟡 On récupère l'offre existante
$stmt = $pdo->prepare("SELECT * FROM offre WHERE id_offre = ?");
$stmt->execute([$id]);
$offre = $stmt->fetch();

if (!$offre) {
    header("Location: offres.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nom = $_POST['nom_offre'] ?? '';
    $description = $_POST['description_offre'] ?? '';
    $prix = $_POST['prix_offre'] ?? '';

    if (!empty($nom) && !empty($description) && is_numeric($prix)) {
        // ✅ On ne touche pas à l'image (puisqu'elle est dans assets/images/)
        $stmt = $pdo->prepare("UPDATE offre SET nom_offre = ?, description_offre = ?, prix_offre = ? WHERE id_offre = ?");
        $stmt->execute([$nom, $description, $prix, $id]);
        $success = "✅ Offre modifiée avec succès.";
    } else {
        $error = "❌ Tous les champs sont obligatoires et le prix doit être un nombre.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier une offre - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/admin_style.css">
</head>
<body>
<div class="form-container">
    <h2>✏️ Modifier l'offre</h2>

    <?php if ($error): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <?php if ($success): ?>
        <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="mb-3">
            <label for="nom">Nom de l'offre</label>
            <input type="text" name="nom_offre" id="nom" class="form-control" value="<?= htmlspecialchars($offre['nom_offre']) ?>" required>
        </div>

        <div class="mb-3">
            <label for="description">Description</label>
            <textarea name="description_offre" id="description" class="form-control" rows="4" required><?= htmlspecialchars($offre['description_offre']) ?></textarea>
        </div>

        <div class="mb-3">
            <label for="prix">Prix (€)</label>
            <input type="number" step="0.01" name="prix_offre" id="prix" class="form-control" value="<?= $offre['prix_offre'] ?>" required>
        </div>

        <button type="submit" class="btn btn-warning w-100">💾 Enregistrer les modifications</button>
        <a href="offres.php" class="btn btn-secondary w-100 mt-2">⬅️ Retour aux offres</a>
    </form>
</div>
</body>
</html>
