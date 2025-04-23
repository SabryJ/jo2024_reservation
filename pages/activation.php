<?php
session_start();
require_once("config.php"); // ou ta connexion à la BDD

if (isset($_GET['token'])) {
    $token = $_GET['token'];
    $stmt = $bdd->prepare("SELECT * FROM utilisateur WHERE token_confirmation = ?");
    $stmt->execute([$token]);
    $user = $stmt->fetch();

    if ($user) {
        $update = $bdd->prepare("UPDATE utilisateur SET is_active = 1, token_confirmation = NULL WHERE id_utilisateur = ?");
        $update->execute([$user['id_utilisateur']]);
        $_SESSION['message'] = "Votre compte a été activé avec succès !";
    } else {
        $_SESSION['message'] = "Lien invalide ou déjà utilisé.";
    }
}

header("Location: connexion.php");
exit();
