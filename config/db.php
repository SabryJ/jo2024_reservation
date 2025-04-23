<?php
$host = 'localhost';
$dbname = 'jo2024'; // Mets ici le nom exact de ta base de données
$user = 'root';
$password = ''; // Vide si tu es sur XAMPP par défaut

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
?>
