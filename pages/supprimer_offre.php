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

$stmt = $pdo->prepare("SELECT * FROM offre WHERE id_offre = ?");
$stmt->execute([$id]);
$offre = $stmt->fetch();

if (!$offre) {
    header("Location: offres.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['confirmer'])) {
        // Suppression
        $stmt = $pdo->prepare("DELETE FROM offre WHERE id_offre = ?");
        $stmt->execute([$id]);
        $success = "✅ Offre supprimée avec succès.";
    } else {
        // Annuler, redirection
        header("Location: offres.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Supprimer une offre - Admin</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" 
          integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/admin_style.css">
</head>
<body class="p-4">

    <h2>🗑️ Supprimer l'offre</h2>

    <?php if ($error): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>
    <?php if ($success): ?>
        <div class="alert alert-success"><?= $success ?></div>
        <a href="offres.php" class="btn btn-primary mt-3">Retour aux offres</a>
    <?php else: ?>
        <div class="alert alert-warning">
            Êtes-vous sûr de vouloir supprimer l'offre suivante ?<br>
            <strong><?= htmlspecialchars($offre['nom_offre']) ?></strong>
        </div>

        <form method="POST" class="mt-3">
            <button type="submit" name="confirmer" class="btn btn-danger">Oui, supprimer</button>
            <button type="submit" name="annuler" class="btn btn-secondary ms-2">Annuler</button>
        </form>
    <?php endif; ?>

</body>
</html>
