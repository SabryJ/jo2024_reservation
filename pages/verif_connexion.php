<?php
// Vérification de la session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['username'])) {
    $_SESSION['redirect_after_login'] = $_SERVER['PHP_SELF'];
    header("Location: connexion.php");
    exit();
}
?>
