<?php
$host = "localhost";
$dbname = "jo2024";
$user = "root";
$password = ""; // adapte si nécessaire

try {
    // Vérifier si $pdo existe déjà (pour éviter la redondance)
    if (!isset($pdo)) {
        // Créer la connexion
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
?>
