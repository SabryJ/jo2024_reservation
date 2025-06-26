<?php
session_start();
include '../includes/db_connexion.php';

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $login = $_POST['login'] ?? '';
    $mdp = $_POST['motdepasse'] ?? '';

    if (!empty($login) && !empty($mdp)) {
        $stmt = $pdo->prepare("SELECT * FROM admin WHERE login = ?");
        $stmt->execute([$login]);
        $admin = $stmt->fetch();

        // Comparaison simple sans hash
        if ($admin && $mdp === $admin['mot_de_passe']) {
            $_SESSION['admin'] = $admin['id_admin'];
            $_SESSION['admin_login'] = $admin['login']; // Ajoute cette ligne si tu veux afficher son nom dans la navbar
            $_SESSION['is_admin'] = true; // ✅ La variable clé
header("Location: ../pages/accueil.php");
            exit();
        } else {
            $error = "Identifiants incorrects.";
        }
    } else {
        $error = "Veuillez remplir tous les champs.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion Admin - JO 2024</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/inscription_style.css">
</head>
<body>
<div class="form-container">
    <h2>Connexion administrateur</h2>

    <?php if (!empty($error)): ?>
        <div class="message error"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <form method="post" action="">
        <input type="text" name="login" placeholder="Identifiant" required>
        <input type="password" name="motdepasse" placeholder="Mot de passe" required>
        <button type="submit">Se connecter</button>
    </form>

    <div class="mt-3">
        <a href="connexion.php" class="text-secondary">Retour à la connexion utilisateur</a>
    </div>
</div>
</body>
</html>
