<?php
ob_start(); // Active la mise en tampon de sortie

// Démarrer la session uniquement si elle n'est pas déjà active
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

error_reporting(E_ALL);
ini_set('display_errors', 1);
include '../includes/db_connexion.php';

// Définir le CSS spécifique pour cette page
$page_css = '../assets/css/inscription_style.css';
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Récupérer les valeurs envoyées du formulaire
    $nom_utilisateur = $_POST['username'] ?? '';  // Nom d'utilisateur
    $mdp = $_POST['motdepasse'] ?? '';  // Mot de passe

    if (!empty($nom_utilisateur) && !empty($mdp)) {
        // Préparation de la requête SQL pour vérifier l'existence de l'utilisateur
        $stmt = $pdo->prepare("SELECT * FROM utilisateur WHERE nom_utilisateur = ?");
        $stmt->execute([$nom_utilisateur]);
        $user = $stmt->fetch();

        if ($user && password_verify($mdp, $user['mot_de_passe'])) {
            $_SESSION['id_utilisateur'] = $user['id_utilisateur'];
            $_SESSION['username'] = $user['nom_utilisateur'];
        
            // ✅ Redirection après connexion
            $redirect = $_SESSION['redirect_after_login'] ?? 'index.php';
            unset($_SESSION['redirect_after_login']);
            header("Location: $redirect");
            exit();
        }
        
         else {
            $error = "Nom d’utilisateur ou mot de passe incorrect.";
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
    <title>Connexion - JO 2024</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/inscription_style.css">
</head>
<body>
    <div class="form-container">
        <h2>Connexion</h2>

        <?php if (!empty($error)): ?>
            <div class="message error"><?php echo $error; ?></div>
        <?php endif; ?>

        <form method="post" action="">
            <input type="text" name="username" placeholder="Nom d'utilisateur" required>
            <input type="password" name="motdepasse" placeholder="Mot de passe" required>
            <button type="submit">Se connecter</button>
        </form>

        <div class="mt-3">
            <p>Pas encore de compte ? <a href="inscription.php">Inscrivez-vous ici</a></p>
        </div>
    </div>
</body>
</html>
